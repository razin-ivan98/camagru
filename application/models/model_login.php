<?php

class model_login extends model
{
	function save_link($link, $reason, $name)
	{
		$stmt =	$this->perfom_query("SELECT * FROM users WHERE name=?", array($name));
		$id = $stmt->fetchall()[0]['id'];


		$stmt =	$this->perfom_query("SELECT * FROM links WHERE user_id=?", array($id));

		if (count($stmt->fetchall()) != 0)
			$this->perfom_query("DELETE FROM links WHERE user_id=?", array($id));
		$this->perfom_query("INSERT INTO links (user_id, reason, link) VALUES(?, ?, ?)", array($id, $reason, $link));
	}

	public function login()
	{
		if (!isset($_SESSION))
			session_start();
		if ($_POST['login'] != "" && $_POST['password'] != "") //если поля заполнены 	
		{ 		
			$login = $_POST['login']; 
			$password = $_POST['password'];
			$rez = $this->perfom_query("SELECT * FROM users WHERE name=?", array($login)); //запрашиваем строку из БД с логином, введённым пользователем 		
			if (count($fetch = $rez->fetchall()) == 1) //если нашлась одна строка, $значит такой юзер существует в БД 		
			{ 			
				//$row = mysql_fetch_assoc($rez); 			
				if (md5($password) == $fetch[0]['password'])
				{ 
					//пишем логин и хэшированный пароль в cookie, также создаём переменную сессии
					setcookie ("login", $fetch[0]['name'], time() + 50000); 						
					setcookie ("password", md5($fetch[0]['name'].$fetch[0]['password']), time() + 50000); 					
					$_SESSION['uid'] = $fetch[0]['id'];	//записываем в сессию id пользователя 					
				//	lastAct($id); 				
					return true; 			
				} 			
				else //если пароли не совпали 
				{ 				
					$error = "Wrong password"; 										
					return $error; 			
				} 		
			} 		
			else //если такого пользователя не найдено в БД 		
			{ 			
				$error = "Wrong login"; 			
				return $error; 		
			} 	
		}
		else 	
		{ 		
			$error = "Empty"; 				
			return $error; 	
		}
	}

	function get_email($name)
	{
		$rez = $this->perfom_query("SELECT * FROM users WHERE name=?", array($name));
		$email = $rez->fetchall()[0]['email'];
		return $email;
	}
}

?>