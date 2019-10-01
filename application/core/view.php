<?php

class View
{
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	function __construct()
	{
	}
	
	function generate($content_view, $view_template, $data = null)
	{
		if(is_array($data))
		{
			// преобразуем элементы массива в переменные
			extract($data);
		}
		
		include 'application/views/'.$view_template;
	}
	function response_ajax($data = null)
	{
		$data = json_encode($data);
		echo $data;
	}
	function draw_publish($publish)
	{
		$liked = ($publish['is_liked'] === false ? '&#x1F497;' : '&#x1F49D;');
			echo (
			'<div class="publish" id="'.$publish['id'].'">
				<div class="publish_header">
					<div class="avatar"><img src="avatars/'.htmlentities($publish['avatar']).'"></div>
					<div class="author"><h3>'.htmlentities($publish['author']).'</h3></div>'
					.($publish['is_my'] === true ? '<div class="delete_publish" onclick="delete_publish(this);"><img src="delete.png"></div>' : '').
				'</div>
				<div class="publish_body">
					'.htmlentities($publish['description']).
					(($publish['image_name'] === 'non') ? '' : '<img src="images/'.htmlentities($publish['image_name']).'">').
				'<div class="like" onclick="like(this);">'.$liked.htmlentities($publish['likes_count']).'</div></div>
				<div class="publish_footer">');//////////////////
					
					foreach($publish['comments'] as $comment)
					{
						$comment_liked = ($comment['is_liked'] === false ? '&#x1F497;' : '&#x1F49D;');
						echo 	'<div class="comment" id='.htmlentities($comment['id']).'>
									<div class="comment_header">
										<div class="avatar"><img src="avatars/'.htmlentities($comment['avatar']).'"></div>
										<div class="author"><h3>'.htmlentities($comment['author']).'</h3></div>'
										.($comment['is_my'] === true ? '<div class="delete_comment" onclick="delete_comment(this);"><img src="delete.png"></div>' : '').
									'</div>
									<div class="comment_body">
										'.htmlentities($comment['text']).
										'<div class="like" onclick="comment_like(this);">'.$comment_liked.htmlentities($comment['likes_count']).'</div>
									</div>
								</div>';
					}					
						
				echo('	<div class="comment_constructor">
							<form method="POST" class="new_comment">
							<input type="text" autocomplete="off" name="text" class="mess_input">
							<button  type="button" class="mess_submit" onclick="f_new_comment(this);">отправить</button>
							</form>
						</div>
				</div>
				
			</div>');
	}
}

?>