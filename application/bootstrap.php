<?php
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
try
{
	Route::start(); // запускаем маршрутизатор
}
catch (PDOException $ex)
{
	header("Status: 204 No Content");
	exit;
}

?>