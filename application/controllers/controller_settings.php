<?php

class controller_settings extends controller
{
	function __construct()
	{
		$this->model = new model_settings();
		$this->view = new view();
	}
	
function action_index()
{
	if ($this->model->is_logged() == true)
	{
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
		if (($_FILES['file_av']['error']) == 0)
		{
			$this->model->new_avatar();
			$this->view->response_ajax(array('answer' => true));
		}
		else
			$this->view->response_ajax(array('answer' => false));
	}
}
?>