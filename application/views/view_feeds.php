

<script src="/js/feeds.js"></script>
<div class="container">

	<div class="sidebar_left">
		<a href="/feeds"><div class="bar_element" id="first_element">Feeds</div></a>
		<a href="/dialogs"><div class="bar_element" id="dialogs_link">Dialogs<?php if ($count_of_dialogs_events != 0) echo "<div class='unread'>".$count_of_dialogs_events."</div>"; ?></div></a>
		<a href="/settings"><div class="bar_element">Settings</div></a>
		<a href="/feeds/logout"><div class="bar_element">Logout</div></a>
	</div>
	<div class="publishes_block">

		<?php
			print'<div id="publish_constructor" class="publish">';
			print'<div class="publish_header">';
			print	'<div class="avatar"><img src="/avatars/'.htmlentities($my_avatar).'"></div>';
			print	'<div class="author"><h3>'.htmlentities($my_name).'</h3></div>';
			print'</div>';
			print'<div class="publish_footer">';
			print	'<form method="POST" id="new_publish" enctype="multipart/form-data">';
			
			print		'<input type="text" class="new_publ_input" name="description">';
			print		'<button onclick="open_image_editor();" class="new_publ_image_button" type="button"><img src="/pics/Image.png"></button>';
			print		'<button onclick="new_publish(this);"  class="mess_submit" type="button">Отправить</button>';

			print	'</form>';
			print '<div class="editor">';
			
			print '<video id="video" width="580" height="435" autoplay></video>';
			
			print '<input type="file" id="file_input" onchange="input_change();" class="input_file" name="file">';
			print '<label class="input_label" for="file_input"><img class="dropzone" src="/pics/drop.png"></label>';


			print '<div class="canvases">';
			print '<canvas id="canvas" width="580" height="435"></canvas>';
			print '<canvas id="stickers_canvas" width="580" height="435"></canvas>';
			print '</div>';

			print '<button onclick="camera();" id="src" class="mess_submit" type="button">Камера</button>';
			print '<button onclick="show_stickers();" id="stickers" class="mess_submit" type="button">Стикеры</button>';
			print '<button onclick="reset();" id="reset" class="mess_submit" type="button">Сбросить</button>';
			print '<button onclick="snap();" id="snap" class="mess_submit" type="button">Щелк</button>';
			print '<div class="stickers_pack">';

			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/pepe.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/bear.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/avo.png">';

			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/2.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/7.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/10.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/11.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/20.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/21.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/29.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/31_1.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/35.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/40.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/41.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/51.png">';

			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/52.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/57.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/66.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/75.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/78.png">';
			print '<img class="sticker_image" onclick="add_sticker(this);" src="/stickers/84.png">';

			print '</div>';
			print '</div>';

			
			print'</div>';
			print'</div>';

		if (is_array($publishes))	
			foreach ($publishes as $publish)
			{
				$this->draw_publish($publish);
			}

		?>	
	</div>
</div>
<div class="navi">
<div class="navigator">
	<img class="arrow_l" src="/pics/arr_l.png" onclick="prev_page();">
	<div class="page_number"> <?php echo $page; ?> </div>
	<img class="arrow_r" src="/pics/arr_r.png" onclick="next_page();">

</div>
</div>