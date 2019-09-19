<?php

class controller_link extends controller
{
	function __construct()
	{
		$this->model = new model_link();
		$this->view = new view();
	}

	function link($link)
	{
		$res = $this->model->check_link($link);
		if ($res === true)
		{
			header("Location: /feeds");
		}
		else
		{
			Route::ErrorPage404();
		}
	}
	
}

?>