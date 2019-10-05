<?php

class controller_create_account extends controller
{
	function __construct()
	{
		$this->model = new model_create_account();
		$this->view = new view();
	}
	function action_index($params)
	{	
		$this->view->generate('view_create_account.php', 'view_template_login.php');
	}
	
	function action_create_account()
	{
		if ($_POST['login'] === "" || $_POST['password'] === "")
		{
			$answer = array('answer' => false, 'text' => 'Empty fields');
			$this->view->response_ajax($answer);
			return;
		}
		$error = $this->model->create_account();
		if ($error === true)
			$this->view->response_ajax(array('answer' => true, 'text' => 'none'));
		else
			$this->view->response_ajax(array('answer' => false, 'text' => $error));
	}
}

?>