<script src="feeds.js"></script>
<link rel="stylesheet" href="feeds.css">
<div class="container">

	<div class="sidebar_left">
		<a href="/feeds"><div class="bar_element" id="first_element">Feeds</div></a>
		<a href="/dialogs"><div class="bar_element">Dialogs<?php if ($count_of_dialogs_events != 0) echo "<div class='unread'>".$count_of_dialogs_events."</div>"; ?></div></a>
		<a href="/settings"><div class="bar_element">Settings</div></a>
		<a href="/feeds/logout"><div class="bar_element">Logout</div></a>
		<button onclick="send_mail();" type="button">Send Mail</button>
	</div>
	<div class="publishes_block">
	<!--	<video id="video" width="640" height="480" autoplay></video>-->
		<?php
			print'<div id="publish_constructor" class="publish">';
			print'<div class="publish_header">';
			print	'<div class="avatar"><img src="avatars/'.htmlentities($my_avatar).'"></div>';
			print	'<div class="author"><h3>'.htmlentities($my_name).'</h3></div>';
			print'</div>';
			print'<div class="publish_footer">';
			print	'<form method="POST" id="new_publish" enctype="multipart/form-data">';
			print		'<input type="file" name="file">';
			print		'<input type="text" name="description">';
			print		'<button onclick="new_publish(this);" type="button">Send</button>';
			print	'</form>';
			print'</div>';
			print'</div>';
		foreach ($publishes as $publish)
		{
			$this->draw_publish($publish);
		}
		
		?>	
	</div>



</div>