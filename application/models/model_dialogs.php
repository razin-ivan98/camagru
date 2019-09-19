<?php

class model_dialogs extends model
{
	public function get_data()
	{	
		return true;
	}
	
	function get_dialogs()
	{
		if (!isset($_SESSION))
			session_start();
		$dialogs = array();
		$stmt = $this->perfom_query("SELECT * FROM dialogs WHERE (user1_id=? OR user2_id=?) ORDER BY last_active DESC", array($_SESSION['uid'], $_SESSION['uid']));
		$dialogs_tmp = $stmt->fetchall();
		foreach ($dialogs_tmp as $dialog)
		{
			if ($dialog['user1_id'] == $_SESSION['uid'])
				$opp_user = $dialog['user2_id'];
			else
				$opp_user = $dialog['user1_id'];
			$stmt = $this->perfom_query("SELECT * FROM avatars WHERE user_id=?", array($opp_user));
			$avatar = $stmt->fetchall()[0]['image_name'];
			$stmt = $this->perfom_query("SELECT * FROM users WHERE id=?", array($opp_user));
			$opp_user = $stmt->fetch()['name'];
			$stmt = $this->perfom_query("SELECT * FROM messages WHERE dialog_id=? AND user_id!=? AND is_read=0", array($dialog['id'], $_SESSION['uid']));
			$unread = count($stmt->fetchall());
			$dialogs[] = array('id' => $dialog['id'],
								'avatar' => $avatar,
								'user' => $opp_user,
								'unread' => $unread
								);
		}
		return $dialogs;
	}
	function create_dialog_with($user_id)
	{
		if (!isset($_SESSION))
			session_start();
		$error = true;
		
		$stmt = $this->perfom_query("SELECT * FROM dialogs WHERE (user1_id=? AND user2_id=?) OR (user1_id=? AND user2_id=?)", array($_SESSION['uid'], $user_id, $user_id, $_SESSION['uid']));
		if (count($stmt->fetchall()) === 0)
		{
			$stmt = $this->perfom_query("INSERT INTO dialogs (user1_id, user2_id) VALUES (?, ?)", array($_SESSION['uid'], $user_id));
		}
		else
		{
			$error = "Dialog with this User already exist";
		}
		return $error;
	}
	function open_dialog($dialog_id)
	{
		if (!isset($_SESSION))
			session_start();
		$res = false;
		$stmt = $this->perfom_query("SELECT * FROM dialogs WHERE (user1_id=? OR user2_id=?) AND id=?", array($_SESSION['uid'], $_SESSION['uid'], $dialog_id));
		if (count($stmt->fetchall()) === 0)
			return $res;
		$stmt = $this->perfom_query("UPDATE messages SET is_read = 1 WHERE user_id!=? AND dialog_id=?", array($_SESSION['uid'], $dialog_id));
		$stmt = $this->perfom_query("SELECT * FROM messages WHERE dialog_id=? ORDER BY id ASC", array($dialog_id));
		$res = $stmt->fetchall();
		return $res;
	}
	function get_new_messages($last_id, $dialog_id)
	{
		$stmt = $this->perfom_query("UPDATE messages SET is_read = 1 WHERE user_id!=? AND dialog_id=?", array($_SESSION['uid'], $dialog_id));
		$stmt = $this->perfom_query("SELECT * FROM messages WHERE dialog_id=? AND id>? ORDER BY id ASC", array($dialog_id, $last_id));
		$res = $stmt->fetchall();
		if (count($res) === 0)
			return false;
		return $res;
	}
	
	function get_opp_user_id($dialog_id)
	{
		if (!isset($_SESSION))
			session_start();
		$stmt = $this->perfom_query("SELECT * FROM dialogs WHERE id=?", array($dialog_id));
		$res = $stmt->fetchall();
		if ($res[0]['user1_id'] === $_SESSION['uid'])
			return $res[0]['user2_id'];
		else
			return $res[0]['user1_id'];
	}
	
	function new_message($dialog_id, $text)
	{
		if (!isset($_SESSION))
			session_start();
		$stmt = $this->perfom_query("INSERT INTO messages (dialog_id, user_id, message, date) VALUES (?, ?, ?, NOW())", array($dialog_id, $_SESSION['uid'], $text));
		$stmt = $this->perfom_query("UPDATE dialogs SET last_active=NOW() WHERE id=?", array($dialog_id));
		/*$stmt = $this->perfom_query("SELECT * FROM dialogs WHERE id=? AND user1_id=?", array($dialog_id, $_SESSION['uid']));
		
		if (count($stmt->fetchall()) !== 0)
			$stmt = $this->perfom_query("UPDATE dialogs SET new_for_user2 = (new_for_user2 + 1) WHERE id=?", array($dialog_id));
		else
			$stmt = $this->perfom_query("UPDATE dialogs SET new_for_user1 = (new_for_user2 + 1) WHERE id=?", array($dialog_id));*/
	}
	
}

?>