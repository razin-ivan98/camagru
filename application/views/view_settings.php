<script src="settings.js"></script>
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
			print	'<div class="author"><h3>Settings</h3></div>';
			print'</div>';
		//	print'<div class="publish_footer">';
			print	'<div class="publish_body"><form method="POST" id="change_avatar" enctype="multipart/form-data">';
			print		'Change avatar<input type="file" name="file_av">';
			print		'<button onclick="new_avatar();" type="button">Send</button>';
			print	'</form></div>';
			print 		'<div class="publish_body"><form id="change_password">Change password<br/>';
			print		'Old password <input type="password" name="old_pass"><br/>';
			print		'New password <input type="password" name="new_pass"><br/>';
			print		'Repeat new password <input type="password" name="r_new_pass"><br/>';
			print		'<button onclick="change_password();" type="button">Send</button></form></div>';

		//	print		'Change avatar<input type="file" name="file_av">';
		//	print		'<button onclick="new_avatar();" type="button">Send</button>';

		//	print'</div>';
			print'</div>';

		?>	
	</div>



</div>