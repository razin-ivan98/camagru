<?php

class controller_login extends controller
{
	function __construct()
	{
		$this->model = new model_login();
		$this->view = new view();
	}

	function action_index($params)
	{	
		$this->view->generate('view_login.php', 'view_template_login.php');
	}
	
	function action_login()
	{
		$error = $this->model->login();
		if ($error === true)
			$this->view->response_ajax(array('answer' => true, 'text' => 'none'));
		else
			$this->view->response_ajax(array('answer' => false, 'text' => $error));
	}


	function generate_random($length = 10)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	function action_reset_password()
	{
		if (!isset($_SESSION))
			session_start();
		if (isset($_POST['login']) AND $_POST['login'] != '')
		{
			try
			{
				$email = $this->model->get_email($_POST['login']);
			}
			catch (PDOException $ex)
			{
				header('Location: /db_error');
				exit;
			}
			$link = $this->generate_random(40);
			$link .= $_POST['login'];
			try
			{
				$this->model->save_link($link, "reset", $_POST['login']);
			}
			catch (PDOException $ex)
			{
				header('Location: /db_error');
				exit;
			}
			try
			{
				$user = $_POST['login'];
			}
			catch (PDOException $ex)
			{
				header('Location: /db_error');
				exit;
			}
			$subject = "Reset password";
			$main = "Dear $user! Click to this link to creset your password: http://".$_SERVER['SERVER_NAME'].":8080/link/$link";
			$main = wordwrap($main, 65, "\r\n");
			$headers = 'From: picchat.manager@gmail.com'."\r\n".
				"Reply-To: picchat.manager@gmail.com"."\r\n".
				"X-Mailer: PHP/".phpversion();
			$res = mail($email, $subject, $main, $headers);
			
			$this->view->response_ajax(array('answer' => $res , 'text' => "error"));
		}
		else
		{
			$this->view->response_ajax(array('answer' => false, 'text' => "error"));
		}
	}
}

?>