<?php

class controller_reset_password extends controller
{
	function __construct()
	{
		$this->model = new model_reset_password();
		$this->view = new view();
	}

	function action_new_password()
	{
		if (!isset($_SESSION))
			session_start();
		if (isset($_POST['password']) && isset($_POST['confirm_password']) &&
			$_POST['confirm_password'] === $_POST['password'] && $_POST['confirm_password'] !== '' &&
			isset($_POST['link']) && $_POST['link'] !== '')
		{
			$id = $this->model->get_user_from_link($_POST['link']);
			if ($id === false)
				$res = false;
			else
			{
				$this->model->change_password($_POST['password'], $id);
				$res = true;
				$this->model->delete_link($_POST['link']);
			}

			$this->view->response_ajax(array('answer' => $res));
		}
		else
		{
			$this->view->response_ajax(array('answer' => false, 'text' => "error"));
		}
	}

}
?>