<?php

class model
{
	protected $pdo;
	
	function __construct()
	{
		$host = '172.17.0.3';
		// $host = 'localhost';
		 //$db   = 'id10411394_base';
		 $db   = 'base';
		 //$user = 'id10411394_root';
		 $db_user = 'root';
		 //$pass = '1998VONdarm';
		 $db_pass = 'root';
		 //$pass ='';
		 $charset = 'utf8';
		 //session_start();
		 //if (isset($_SESSION))
		 //var_dump( $_SESSION);
		 $dsn = "mysql:host=$host;charset=$charset";
		 $opt = [
			 PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			 PDO::ATTR_EMULATE_PREPARES   => false,
		 ];
		$this->pdo = new PDO($dsn, $db_user, $db_pass, $opt);
		$this->pdo->exec("USE $db");
	}
	
	public function logout()
	{
		if (!isset($_SESSION))
			session_start();
		
		if (isset($_SESSION['uid']))
			unset($_SESSION['uid']);
		SetCookie('login', null, -1, "/");
		SetCookie('password', null, -1, "/");
	}
	
	public function is_logged()
	{
		if (!isset($_SESSION))
			session_start();
		if (isset($_SESSION['uid'])) 	
		{
			$rez = $this->perfom_query("SELECT * FROM users WHERE id=?", array($_SESSION['uid']));
			$fetch = $rez->fetchall();
			if (count($fetch) == 0)
				return (false);
			return true;
		} 	
		else
		{ 
			return false;	
		} 
	}

	function check_password($pass)
	{
		$pass = md5($pass);
		$stmt = $this->perfom_query("SELECT * FROM users WHERE password=? AND id=?", array($pass, $_SESSION['uid']));
		if (count($stmt->fetchall()) === 0)
		{
			return false;
		}	
		return true;
	}

	public function is_confirmed()
	{
		if (!isset($_SESSION))
			session_start();
		if (isset($_SESSION['uid'])) 	
		{
			$rez = $this->perfom_query("SELECT * FROM users WHERE id=? AND confirmed=1", array($_SESSION['uid']));
			$fetch = $rez->fetchall();
			if (count($fetch) == 0)
				return (false);
			return true;
		} 	
		else
		{ 
			return false;	
		} 
	}
	
	public function get_logged_user()
	{
		$user;
		if (isset($_SESSION) && isset($_SESSION['uid']))
		{
			$stmt = $this->perfom_query("SELECT * FROM users WHERE id=?", array($_SESSION['uid']));
			$res = $stmt->fetchall();
			if (count($res) !== 0)
			{
				return $res[0]['name'];
			}
			return false;
		}
		else
			return false;
	}
	
	public function perfom_query($str, $arr)
	{
		$stmt = $this->pdo->prepare($str);
		$stmt->execute($arr);
		return ($stmt);
	}
	
	function get_user($id)
	{
		$stmt = $this->perfom_query("SELECT * FROM users WHERE id=?", array($id));
		return $stmt->fetchall()[0]['name'];
	}
	
	function get_avatar($id)
	{
		$stmt = $this->perfom_query("SELECT * FROM avatars WHERE user_id=?", array($id));
		return $stmt->fetchall()[0]['image_name'];
	}
	
	public function get_my_avatar()
	{
		if (!isset($_SESSION))
			session_start();
		return $this->get_avatar($_SESSION['uid'], array());
	}
	
	public function get_other_users()
	{
		if (!isset($_SESSION))
			session_start();
		$stmt = $this->perfom_query("SELECT * FROM users WHERE id!=?", array($_SESSION['uid']));
		return $stmt->fetchall();
	}
	public function get_count_of_dialogs_events()
	{
		if (!isset($_SESSION))
			session_start();
		$stmt = $this->perfom_query("SELECT DISTINCT dialogs.id FROM dialogs JOIN messages ON messages.dialog_id = dialogs.id WHERE (dialogs.user1_id=? OR dialogs.user2_id=?) AND messages.user_id!=? AND messages.is_read=0;", array($_SESSION['uid'], $_SESSION['uid'], $_SESSION['uid']));
		return count($stmt->fetchall());
	}
}

?>
