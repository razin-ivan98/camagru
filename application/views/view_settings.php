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
			print'<div class="publish_footer">';
			print	'<form method="POST" id="settings" enctype="multipart/form-data">';
			print		'Change avatar<input type="file" name="file_av">';
			print		'<button onclick="new_avatar();" type="button">Send</button>';
			print	'</form>';
			print'</div>';
			print'</div>';

		?>	
	</div>



</div>