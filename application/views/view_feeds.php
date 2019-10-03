<script src="feeds.js"></script>
<link rel="stylesheet" href="feeds.css">
<div class="container">

	<div class="sidebar_left">
		<a href="/feeds"><div class="bar_element" id="first_element">Feeds</div></a>
		<a href="/dialogs"><div class="bar_element" id="dialogs_link">Dialogs<?php if ($count_of_dialogs_events != 0) echo "<div class='unread'>".$count_of_dialogs_events."</div>"; ?></div></a>
		<a href="/settings"><div class="bar_element">Settings</div></a>
		<a href="/feeds/logout"><div class="bar_element">Logout</div></a>
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
			
			print		'<input type="text" class="new_publ_input" name="description">';
			print		'<button onclick="open_image_editor();" class="new_publ_image_button" type="button"><img src="Image.png"></button>';
			print		'<button onclick="new_publish(this);"  class="mess_submit" type="button">Отправить</button>';
			//print '<input type="file" name="file">';
			print	'</form>';
			print '<div class="editor">';
			
			print '<video id="video" width="580" height="435" autoplay></video>';
			
			print '<input type="file" id="file_input" onchange="input_change();" class="input_file" name="file">';
			print '<label class="input_label" for="file_input"><img class="dropzone" src="drop.png"></label>';
			print '<div class="stickers_field"></div>';

			print '<div class="canvases">';
			print '<canvas id="canvas" width="580" height="435"></canvas>';
			print '<canvas id="stickers_canvas" width="580" height="435"></canvas>';
			print '</div>';

			print '<button onclick="camera();" id="src" class="mess_submit" type="button">Камера</button>';
			print '<button onclick="show_stickers();" id="stickers" class="mess_submit" type="button">Стикеры</button>';
			print '<button onclick="reset();" id="reset" class="mess_submit" type="button">Сбросить</button>';
			print '<button onclick="snap();" id="snap" class="mess_submit" type="button">Щелк</button>';
			print '<div class="stickers_pack">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="stickers/pepe.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="stickers/bear.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="stickers/avo.png">';

			print '</div>';
			print '</div>';

			
			print'</div>';
			print'</div>';
		foreach ($publishes as $publish)
		{
			$this->draw_publish($publish);
		}
		
		?>	
	</div>
</div>