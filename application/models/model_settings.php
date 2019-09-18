<?php

class model_settings extends model
{
	public function get_data()
	{	
		return true;
	}
	
	function new_avatar()
	{
		if (!isset($_SESSION))
			session_start();
		$basename = basename($_FILES['file_av']['name']);
		preg_match("/\.([a-zA-Z0-9]*)$/", $basename, $matches);
		$type = $matches[1];
		$name = md5($basename) . "." .  $type;
		while(file_exists("avatars/".$name))
		{
			$name = md5($name) . "." .  $type;
		}
		$uploadfile = "avatars/" . $name;
		move_uploaded_file($_FILES['file_av']['tmp_name'], $uploadfile);
		
		$this->perfom_query("UPDATE avatars SET image_name=? WHERE user_id=?", array($name, $_SESSION['uid']));
	}
}
?>