<script src="dialogs.js"></script>
<link rel="stylesheet" href="dialogs.css">
<div class="container">
	<div class="sidebar_left">
		<a href="/feeds"><div class="bar_element" id="first_element">Feeds</div></a>
		<a href="/dialogs"><div class="bar_element">Dialogs<?php if ($count_of_dialogs_events != 0) echo "<div class='unread'>".$count_of_dialogs_events."</div>"; ?></div></a>
		<a href="/settings"><div class="bar_element">Settings</div></a>
		<a href="/feeds/logout"><div class="bar_element">Logout</div></a>
	</div>
	<div class="publishes_block">
		<?php
			print'<div class="publish">';
			print'<div class="publish_header">';
			
			print'<div class="author"><h3 class="title">My Dialogs</h3></div>';
			print'</div>';
			print'<div class="publish_footer" id="dialogs_field" ><div class="dialogs_block">';
			print "<div class='dialog' onclick='new_dialog_choose();'>New Dialog</div>";
			foreach ($dialogs as $dialog)
			{
				print '<div class="dialog" id="'.$dialog['id'].'" onclick="open_dialog(this);">';
				print '<div class="avatar"><img src="avatars/'.$dialog['avatar'].'"></div>';
				print '<div class="author"><h3>'.$dialog['user'].'</h3></div>';
				if ($dialog['unread'] !== 0)
					print '<div class="unread">'.$dialog['unread'].'</div>';
				print '</div>';
			}		
			print'</div></div>';
			print'</div>';
		
		
		?>	
	</div>



</div>