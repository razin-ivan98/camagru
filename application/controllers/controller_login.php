<?php

class controller_login extends controller
{
	function __construct()
	{
		$this->model = new model_login();
		$this->view = new view();
	}

	function action_index()
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
}

?>