<?php

class controller_link extends controller
{
	function __construct()
	{
		$this->model = new model_link();
		$this->view = new View();
	}

	function link($link)
	{
		$res = $this->model->check_link($link);
		if ($res === true)
		{
			header("Location: /feeds");
		}
		else if ($res === 'reset')
		{
			$this->view->generate('view_reset_password.php', 'view_template_login.php', $link);
		}
		else
		{
			Route::ErrorPage404();
		}
	}
	
}

?>