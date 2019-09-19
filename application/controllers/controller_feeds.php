<?php

class controller_feeds extends controller
{
	function __construct()
	{
		$this->model = new model_feeds();
		$this->view = new view();
	}
	
	function action_index()
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
			$data['publishes'] = $this->model->get_publishes();
			$data['my_avatar'] = $this->model->get_my_avatar();
			$data['count_of_dialogs_events'] = $this->model->get_count_of_dialogs_events();
			$this->view->generate('view_feeds.php', 'view_template.php', $data);
		}
		else
		{
			header("Location: /login");
		}
	}
	
	function action_send_mail()
	{
		$email = "razin-ivan98@yandex.ru";
		$subject = "Hey lol";
		$main = "Hello, Lol! It's testing of sendmail";
		$main = wordwrap($main, 65, "\r\n");
		$headers = 'From: picchat.manager@gmail.com'."\r\n".
			"Reply-To: picchat.manager@gmail.com"."\r\n".
			"X-Mailer: PHP/".phpversion();
		$res = mail($email, $subject, $main, $headers);
		$res = array('answer' => $res);
		$this->view->response_ajax($res);
	}

	public function action_logout()
	{
		$this->model->logout();
		header("Location: /login");
	}
	
	public function action_new_publish()
	{
		$new = $this->model->new_publish();
		if ($new !== false)
		{
			$this->view->draw_publish($new);
		}
	}
	
	public function action_delete_publish()
	{
		$answer = $this->model->delete_publish();
		$answer = array('answer' => $answer);
		$this->view->response_ajax($answer);
	}
	
	public function action_new_comment()
	{
		$answer = $this->model->new_comment();
		if ($answer !== false)
		{
			$this->view->draw_publish($answer);
		}
	}
	public function action_delete_comment()
	{
		$answer = $this->model->delete_comment();
		$answer = array('answer' => $answer);
		$this->view->response_ajax($answer);
	}
	public function action_like()
	{
		$this->model->like($_GET['id']);
		$is_liked = $this->model->get_is_liked($_GET['id']);
		$count = $this->model->get_count_of_likes($_GET['id']);
		
		$answer = array('is_liked' => $is_liked, 'count' => $count);
		$this->view->response_ajax($answer);
	}
	public function action_comment_like()
	{
		$this->model->comment_like($_GET['id']);
		$is_liked = $this->model->get_is_comment_liked($_GET['id']);
		$count = $this->model->get_count_of_comment_likes($_GET['id']);
		
		$answer = array('is_liked' => $is_liked, 'count' => $count);
		$this->view->response_ajax($answer);
	}
}

?>