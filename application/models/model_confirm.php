<?php

class model_confirm extends model
{
	function set_email($email)
	{
		if (!isset($_SESSION))
			session_start();
		$this->perfom_query("UPDATE users SET email=? WHERE id=?", array($email, $_SESSION['uid']));
	}

	function save_link($link, $reason)
	{
		$stmt =	$this->perfom_query("SELECT * FROM links WHERE user_id=?", array($_SESSION['uid']));
		if (count($stmt->fetchall()) != 0)
			$this->perfom_query("DELETE FROM links WHERE user_id=?", array($_SESSION['uid']));
		$this->perfom_query("INSERT INTO links (user_id, reason, link) VALUES(?, ?, ?)", array($_SESSION['uid'], $reason, $link));
	}
}

?>