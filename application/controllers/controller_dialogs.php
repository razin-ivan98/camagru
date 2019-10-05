<?php

class controller_dialogs extends controller
{
	function __construct()
	{
		$this->model = new model_dialogs();
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
			$data['dialogs'] = $this->model->get_dialogs();
			$data['count_of_dialogs_events'] = $this->model->get_count_of_dialogs_events();
			$this->view->generate('view_dialogs.php', 'view_template.php', $data);
		}
		else
		{
			header("Location: /login");
		}
	}
	
	function action_new_dialog_choose()
	{
		$users = array();
		$users_tmp = $this->model->get_other_users();
		foreach($users_tmp as $user)
		{
			$avatar = $this->model->get_avatar($user['id']);
			$users[] = array('user_id' => $user['id'],
							'user' => $user['name'],
							'avatar' => $avatar
							);
		}
		$this->view->response_ajax($users);
	}
	
	function action_create_dialog_with()
	{
		$error = $this->model->create_dialog_with($_GET['user_id']);
		if ($error === true)
			$this->view->response_ajax(array('answer' => true, 'text' => 'none'));
		else
			$this->view->response_ajax(array('answer' => false, 'text' => $error));
	}
	
	function action_open_dialog()
	{
		if (!isset($_SESSION))
			session_start();
		$res = $this->model->open_dialog($_GET['dialog_id']);
		$answer = array();
		if ($res === false)
		{
			$answer['answer'] = false;
			return $answer;
		}
		$answer['answer'] = true;
		$opp_id = $this->model->get_opp_user_id($_GET['dialog_id']);
		$answer['user'] = htmlentities($this->model->get_user($opp_id));
		$answer['avatar'] = $this->model->get_avatar($opp_id);
		$messages = array();
		foreach($res as $message)
		{
			$is_my = ($message['user_id'] === $_SESSION['uid'] ? true : false);
			$messages[] = array('is_my' => $is_my,
								'text' => htmlentities($message['message']),
								'date' => $message['date'],
								'id' => $message['id'],
								'is_read' => $message['is_read']
								);
		}
		$answer['messages'] = $messages;
		$this->view->response_ajax($answer);
	}
	
	function action_new_message()
	{
		$this->model->new_message($_POST['dialog_id'], $_POST['text']);
		echo "lol";
	}
	
	function action_check_new_messages()
	{
		if (!isset($_SESSION))
			session_start();
		$messages_tmp = $this->model->get_new_messages($_POST['last_message_id'], $_POST['dialog_id']);
		if ($messages_tmp === false)
			$this->view->response_ajax(array('answer' => false));
		else
		{
			$messages = array();
			foreach ($messages_tmp as $message)
			{
				$is_my = ($message['user_id'] === $_SESSION['uid'] ? true : false);
				$messages[] = array('date' => $message['date'],
									'text' => htmlentities($message['message']),
									'is_my' => $is_my,
									'id' => $message['id']
									);
			}
			$this->view->response_ajax(array('answer' => true, 'messages' => $messages));
		}
	}
}

?>