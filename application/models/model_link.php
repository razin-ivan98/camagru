<?php

class model_link extends model
{
	function check_link($link)
	{
		$stmt = $this->perfom_query("SELECT * FROM links WHERE link=?", array($link));
		$res = $stmt->fetchall();
		
		if (count($res) === 0)
			Route::ErrorPage404();
		if ($res['0']['reason'] === 'confirm')
		{
			if ($res[0]['user_id'] === $_SESSION['uid'])
			{
				$this->perfom_query("UPDATE users SET confirmed=1 WHERE id=?", array($_SESSION['uid']));
				$this->perfom_query("DELETE FROM links WHERE user_id=?", array($_SESSION['uid']));
				return true;
			}
			else
				return false;
		}
	}

}

?>