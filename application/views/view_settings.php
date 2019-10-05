<link rel="stylesheet" href="/css/settings.css">

<script src="/js/settings.js"></script>
<div class="container">

	<div class="sidebar_left">
		<a href="/feeds"><div class="bar_element" id="first_element">Feeds</div></a>
		<a href="/dialogs"><div class="bar_element" id="dialogs_link">Dialogs<?php if ($count_of_dialogs_events != 0) echo "<div class='unread'>".$count_of_dialogs_events."</div>"; ?></div></a>
		<a href="/settings"><div class="bar_element">Settings</div></a>
		<a href="/feeds/logout"><div class="bar_element">Logout</div></a>
	</div>
	<div class="publishes_block">
		<?php
			print'<div class="publish">';
			print'<div class="publish_header">';
			print	'<div class="str"><h3>Settings</h3></div>';
			print'</div>';
			print	'<div class="publish_body"><form method="POST" id="change_avatar" enctype="multipart/form-data">';
			print		'<div class="str"><h3>Change avatar</h3></div><label for="av" class="btn">Загрузить файл</label><input type="file" id="av" name="file_av">';
			print		'<div class="str"><button onclick="new_avatar();" class="pass_submit" type="button">Изменить</button></div>';
			print	'</form></div>';
			print 		'<div class="publish_body"><form id="change_password"><div class="str"><h3>Change password</h3></div>';
			print		'<div class="str">Old password <input type="password" class="pass_input" name="old_pass"></div>';
			print		'<div class="str">New password <input type="password" class="pass_input" name="new_pass"></div>';
			print		'<div class="str">Repeat new password <input type="password" class="pass_input" name="r_new_pass"></div>';
			print		'<div class="str"><button class="pass_submit" onclick="change_password();" type="button">Изменить</button></div></form>';

			print'</div>';

		?>	
	</div>



</div>