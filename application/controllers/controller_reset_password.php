<?php

class controller_reset_password extends controller
{
	function __construct()
	{
		$this->model = new model_reset_password();
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

	function action_reset_password()
	{
		if (!isset($_SESSION))
			session_start();
		if (isset($_POST['email']) AND $_POST['email'] != '')
		{
            $email = $this->model->get_email();


			$subject = "Confirm your account";
			$main = "Dear $user! Click to this link to confirm your account: http://".$_SERVER['SERVER_NAME'].":8080/link/$link";
			$main = wordwrap($main, 65, "\r\n");
			$headers = 'From: picchat.manager@gmail.com'."\r\n".
				"Reply-To: picchat.manager@gmail.com"."\r\n".
				"X-Mailer: PHP/".phpversion();
			$res = mail($email, $subject, $main, $headers);
			$res = array('answer' => $res);
			
			$this->view->response_ajax(array('answer' => $res , 'text' => "error"));
		}
		else
		{
			$this->view->response_ajax(array('answer' => false, 'text' => "error"));
		}
	}


	function action_index()
	{
		$this->view->generate('view_reset_password.php', 'view_template_login.php');
	}


}
?>