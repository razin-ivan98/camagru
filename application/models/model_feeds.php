<?php

class model_feeds extends model
{
	public function get_publishes()
	{
		$publishes = array();
		if (!isset($_SESSION))
			session_start();
		$res = $this->perfom_query("SELECT * FROM publishes ORDER BY id DESC", array());
		$fetch = $res->fetchall();
		foreach ($fetch as $publ)
		{
			$publishes[] = $this->get_publish($publ);
		}
		return $publishes;
	}
	
	function get_publish($publ)
	{
			$publ_res = $this->perfom_query("SELECT * FROM users WHERE id=?", array($publ['user_id']));
			$author = $publ_res->fetchall()[0]['name'];
			$publ_res = $this->perfom_query("SELECT * FROM avatars WHERE user_id=?", array($publ['user_id']));
			$avatar = $publ_res->fetchall()[0]['image_name'];
			$publ_res = $this->perfom_query("SELECT * FROM publishes_likes WHERE publish_id=? AND user_id=?", array($publ['id'], $_SESSION['uid']));
			$liked = (count($publ_res->fetchall()) == 0 ? false : true);
			$publ_res = $this->perfom_query("SELECT * FROM publishes_likes WHERE publish_id=?", array($publ['id']));
			$likes_count = count($publ_res->fetchall());
			$publ_res = $this->perfom_query("SELECT * FROM comments WHERE publish_id=? ORDER BY id ASC", array($publ['id']));
			$is_my = ($publ['user_id'] === $_SESSION['uid'] ? true : false);
			$comments_tmp = $publ_res->fetchall();
			
			$comments = array();
			
			foreach ($comments_tmp as $comm)
			{
				$comment_res = $this->perfom_query("SELECT * FROM users WHERE id=?", array($comm['user_id']));
				$comment_author = $comment_res->fetchall()[0]['name'];
				$comment_res = $this->perfom_query("SELECT * FROM avatars WHERE user_id=?", array($comm['user_id']));
				$comment_avatar = $comment_res->fetchall()[0]['image_name'];
				$comment_res = $this->perfom_query("SELECT * FROM comments_likes WHERE comment_id=? AND user_id=?", array($comm['id'],$_SESSION['uid']));
				$comment_liked = (count($comment_res->fetchall()) == 0 ? false : true);
				$comment_is_my = ($comm['user_id'] === $_SESSION['uid'] ? true : false);
				$comment_res = $this->perfom_query("SELECT * FROM comments_likes WHERE comment_id=?", array($comm['id']));
				$comment_likes_count = count($comment_res->fetchall());
				
				$comments[] = array('id' => $comm['id'],
								'text' => $comm['text'],
								'author' => $comment_author,
								'avatar' => $comment_avatar,
								'is_liked' => $comment_liked,
								'likes_count' => $comment_likes_count,
								'is_my' => $comment_is_my
									);
			}
			
			$publish = array('id' => $publ['id'],
								'description' => $publ['description'],
								'image_name' => $publ['image_name'],
								'author' => $author,
								'avatar' => $avatar,
								'is_liked' => $liked,
								'likes_count' => $likes_count,
								'comments' => $comments,
								'is_my' => $is_my
								);
		return $publish;
	}
	public function new_publish()
	{
		if (!isset($_SESSION))
			session_start();
		if (isset($_FILES['file']) && ($_FILES['file']['error']) == 0)
		{
			$basename = basename($_FILES['file']['name']);
			preg_match("/\.([a-zA-Z0-9]*)$/", $basename, $matches);
			$type = $matches[1];
			$name = md5($basename) . "." .  $type;
			while(file_exists("images/".$name))
			{
				$name = md5($name) . "." .  $type;
			}
			$uploadfile = "images/" . $name;
			move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
		}
		else
			$name = 'non';
		if (isset($_POST['description']))
			$description = $_POST['description'];
		else
			$description = "";
		$this->perfom_query("INSERT INTO publishes (user_id, image_name, description) VALUES (?, ?, ?)", array($_SESSION['uid'], $name, $description));
		$rez = $this->perfom_query("SELECT MAX(id) FROM publishes", array());
		$publ_id = $rez->fetch()['MAX(id)'];
		$rez = $this->perfom_query("SELECT * FROM publishes WHERE id=?", array($publ_id));
		//draw_publish($_SESSION['uid'], $rez->fetch());
		/////////////////////////////////////////////////////////
		return $this->get_publish($rez->fetch());
	}
	
	function delete_publish()
	{
		if (!isset($_SESSION))
			session_start();
		$answer = false;
		$rez = $this->perfom_query("SELECT * FROM publishes WHERE id=? AND user_id=?", array($_GET['id'],$_SESSION['uid']));
		if (count($rez->fetchall()) == 1)
		{
			$this->perfom_query("DELETE FROM publishes WHERE id=?", array($_GET['id']));
			$this->perfom_query("DELETE FROM publishes_likes WHERE publish_id=?", array($_GET['id']));
			$this->perfom_query("DELETE FROM comments_likes WHERE publish_id=?", array($_GET['id']));
			$this->perfom_query("DELETE FROM comments WHERE publish_id=?", array($_GET['id']));
			$answer = true;
		}
		return $answer;
	}
	function new_comment()
	{
		if (!isset($_SESSION))
			session_start();
		if (isset($_POST['text']))
		{
			$this->perfom_query("INSERT INTO comments (user_id, publish_id, text) VALUES (?, ?, ?)", array($_SESSION['uid'], $_POST['publish_id'], $_POST['text']));
			//$rez = perfom_query($pdo, "SELECT MAX(id) FROM publishes", array());
			$publ_id = $_POST['publish_id'];
			$rez = $this->perfom_query("SELECT * FROM publishes WHERE id=?", array($publ_id));
			return $this->get_publish($rez->fetch());
		}
		return false;
	}

	function delete_comment()
	{
		if (!isset($_SESSION))
			session_start();
		$rez = $this->perfom_query("SELECT * FROM comments WHERE id=? AND user_id=?", array($_GET['id'],$_SESSION['uid']));
		if (count($rez->fetchall()) == 1)
		{
			$this->perfom_query("DELETE FROM comments WHERE id=?", array($_GET['id']));
			$this->perfom_query("DELETE FROM comments_likes WHERE comment_id=?", array($_GET['id']));
			return true;
		}
		return false;
	}
	function get_count_of_likes($publ_id)
	{
		$rez = $this->perfom_query("SELECT * FROM publishes_likes WHERE publish_id=?", array($publ_id));
		return(count($rez->fetchall()));
	}
	function get_is_liked($publ_id)
	{
		if (!isset($_SESSION))
			session_start();
		$rez = $this->perfom_query("SELECT * FROM publishes_likes WHERE publish_id=? AND user_id=?", array($publ_id, $_SESSION['uid']));
		return(count($rez->fetchall()) !== 0);
	}
	function like($publ_id)
	{
		if (!isset($_SESSION))
			session_start();
		if ($this->get_is_liked($publ_id) === false)
		{
			$this->perfom_query("INSERT INTO publishes_likes (publish_id, user_id) VALUES(?, ?)", array($publ_id,  $_SESSION['uid']));
		}
		else
		{
			$this->perfom_query("DELETE FROM publishes_likes WHERE publish_id=? AND user_id=?", array($publ_id, $_SESSION['uid']));
		}
	}
	
	
	function get_count_of_comment_likes($comm_id)
	{
		$rez = $this->perfom_query("SELECT * FROM comments_likes WHERE comment_id=?", array($comm_id));
		return(count($rez->fetchall()));
	}
	function get_is_comment_liked($comm_id)
	{
		if (!isset($_SESSION))
			session_start();
		$rez = $this->perfom_query("SELECT * FROM comments_likes WHERE comment_id=? AND user_id=?", array($comm_id, $_SESSION['uid']));
		return(count($rez->fetchall()) !== 0);
	}
	function comment_like($comm_id)
	{
		if (!isset($_SESSION))
			session_start();
		if ($this->get_is_comment_liked($comm_id) === false)
		{
			$this->perfom_query("INSERT INTO comments_likes (comment_id, user_id) VALUES(?, ?)", array($comm_id, $_SESSION['uid']));
		}
		else
		{
			$this->perfom_query("DELETE FROM comments_likes WHERE comment_id=? AND user_id=?", array($comm_id, $_SESSION['uid']));
		}
	}
}

?>