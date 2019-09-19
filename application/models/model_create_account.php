<?php

class model_create_account extends model
{
	public function get_data()
	{	
		return true;
	}
	
	public function create_account()
	{
		if (!isset($_SESSION))
			session_start();
			
		$name = $_POST['login'];
		$error = true;
		$stmt = $this->perfom_query("SELECT name FROM users WHERE name=?", array($name));
		if (count($stmt->fetchall()) != 0)
			$error = "Login already exist";
		else
		{
			$this->perfom_query("INSERT INTO users (name, password) VALUES (?, ?)", array($name, md5($_POST['password'])));
			$stmt = $this->perfom_query("SELECT * FROM users WHERE name=?", array($name));
			$this->perfom_query("INSERT INTO avatars (user_id, image_name) VALUES (?, 'avatar.gif')", array($stmt->fetchall()[0]['id']));
		}
		return $error;
	}
}

?>