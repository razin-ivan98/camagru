<?php

class controller_confirm extends controller
{
	function __construct()
	{
		$this->model = new model_confirm();
		$this->view = new view();
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

	function action_confirm()
	{
		if (!isset($_SESSION))
			session_start();
		if (isset($_POST['email']) AND $_POST['email'] != '')
		{
			try
			{
				$this->model->set_email($_POST['email']);
			}
			catch (PDOException $ex)
			{
				header('Location: /db_error');
				exit;
			}
			$link = $this->generate_random(40);
			$link .= $_SESSION['uid'];
			try
			{
				$this->model->save_link($link, "confirm");
			}
			catch (PDOException $ex)
			{
				header('Location: /db_error');
				exit;
			}
			$email = $_POST['email'];
			try
			{
				$user = $this->model->get_logged_user();
			}
			catch (PDOException $ex)
			{
				header('Location: /db_error');
				exit;
			}
			$subject = "Confirm your account";
			$main = "Dear $user! Click to this link to confirm your account: http://".$_SERVER['SERVER_NAME'].":8080/link/$link";
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


	function action_index()
	{
		if ($this->model->is_logged() == true)
		{
			if ($this->model->is_confirmed() == true)
			{
				header("Location: /feeds");
				return;
			}
			$data = array();		
			$data['my_name'] = $this->model->get_logged_user();
			$this->view->generate('view_confirm.php', 'view_template_login.php', $data);
		}
		else
		{
			header("Location: /login");
		}
	}


}
?>