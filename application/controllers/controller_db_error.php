<?php

class controller_db_error extends controller
{
	function __construct()
	{
		$this->view = new view();
	}

	function action_index()
	{
		$this->view->generate('view_db_error.php', 'view_template_login.php');
	}
	
}

?>