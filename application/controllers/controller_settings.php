<?php

class controller_settings extends controller
{
	function __construct()
	{
		$this->model = new model_settings();
		$this->view = new view();
	}
	
	function action_index($params)
	{
		if ($this->model->is_logged() == true)
		{
			if ($this->model->is_confirmed() == false)
			{
				header("Location: /confirm");
				return ;
			}
			$data = array();		
			$data['my_name'] = $this->model->get_logged_user();
			$data['count_of_dialogs_events'] = $this->model->get_count_of_dialogs_events();
			$this->view->generate('view_settings.php', 'view_template.php', $data);
		}
		else
		{
			header("Location: /login");
		}
	}


	function action_new_avatar()
	{
		
		if (isset($_FILES['file_av']) && ($_FILES['file_av']['error']) == 0)
		{	
			$mime = mime_content_type($_FILES['file_av']['tmp_name']);
			if ($mime !== 'image/gif' && $mime !== 'image/jpeg' && $mime !== 'image/png'
			&& $mime !== 'image/pjpeg') 
			{
				$this->view->response_ajax(array('answer' => false));
				exit;
			}


			$this->model->new_avatar();
			$this->view->response_ajax(array('answer' => true));
		}
		else
			$this->view->response_ajax(array('answer' => false));
	}

	function action_change_password()
	{
		if ($_POST['new_pass'] === '' ||  $_POST['r_new_pass'] === '' || $_POST['old_pass'] === '')
		{
			$this->view->response_ajax(array('answer' => false, 'text' => 'Empty fields'));
			exit();
		}
		if ($_POST['new_pass'] !== $_POST['r_new_pass'])
		{
			$this->view->response_ajax(array('answer' => false, 'text' => 'Passwords are different'));
			exit();
		}
		if ($this->model->check_password($_POST['old_pass']) === false)
		{
			$this->view->response_ajax(array('answer' => false, 'text' => 'Wrong password'));
			exit();
		}
		$this->model->change_password($_POST['new_pass']);
		$this->view->response_ajax(array('answer' => true));
	}
}
?>