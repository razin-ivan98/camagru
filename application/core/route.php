<?php

class Route
{
	static function start()
	{
		if (!isset($_SESSION))
			session_start();
		$controller_name = 'feeds';
		$action_name = 'index';
		$params = '1';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		if ($controller_name === "link")
		{
			include ("application/controllers/controller_link.php");
			include ("application/models/model_link.php");
			$controller = new controller_link();
			$controller->link($routes[2]);
			return ;
		}
		
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		$model_name = 'model_'.$controller_name;
		$controller_name = 'controller_'.$controller_name;
		$action_name = 'action_'.$action_name;


		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		if(file_exists($model_path))
		{
			include $model_path;
		}

		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include $controller_path;
		}
		else
		{
			Route::ErrorPage404();
		}

		try
		{
			$controller = new $controller_name;
		}
		catch (PDOException $ex)
		{
			header('Location: /db_error');
			exit;
		}
		$params = null;
		if (!empty($routes[3]))
		{
			$params = $routes[3];
		}

		$action = $action_name;
		if(method_exists($controller, $action))
		{
			$controller->$action($params);
		}
		else
		{
			Route::ErrorPage404();
		}
	
	}
	
	function ErrorPage404()
	{

        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		exit();
    }
}

