<?php

class Route
{
	static function start()
	{
		// контроллер и действие по умолчанию
		if (!isset($_SESSION))
			session_start();
		$controller_name = 'feeds';
		$action_name = 'index';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// получаем имя контроллера
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
		
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		// добавляем префиксы
		$model_name = 'model_'.$controller_name;
		$controller_name = 'controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		if(file_exists($model_path))
		{
			include $model_path;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include $controller_path;
		}
		else
		{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			Route::ErrorPage404();
		}
		
		// создаем контроллер

		try
		{
			$controller = new $controller_name;
		}
		catch (PDOException $ex)
		{
			header('Location: /db_error');
			exit;
		}

		$action = $action_name;
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			//echo $action;
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	
	}
	
	function ErrorPage404()
	{
		//$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
	//	echo $_SERVER['HTTP_HOST'];
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		//header('Location: /404');
		//echo "krk";
		//include('404.php');
		exit();
    }
}

