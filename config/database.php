<?php

        $host = '172.17.0.3';
	   // $host = 'localhost';
		//$db   = 'id10411394_base';
        $db   = 'base';
		//$user = 'id10411394_root';
		$db_user = 'root';
		//$pass = '1998VONdarm';
		$db_pass = 'root';
		//$pass ='';
		$charset = 'utf8';
		//session_start();
		//if (isset($_SESSION))
		//var_dump( $_SESSION);
		$dsn = "mysql:host=$host;charset=$charset";
		$opt = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];



?>