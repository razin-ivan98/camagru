<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title>PicChat</title>
		<link rel="stylesheet" href="styl.css">
		<link rel="stylesheet" href="feeds.css">
	</head>
	<body>
		<div class="header">
			<div class="head">
				<div class="logo"> 
					<a href="/feeds">
						<img class="logo-image", src="logolong.png">
					</a>
				</div>
				<div class="user">
					<h3><?php echo htmlentities($my_name);?></h3>
				</div>
			</div>
		</div>
		<div class="marg"></div>
			
			<?php include 'application/views/'.$content_view;?>
			
		<div class="footer">
			
		</div>
	</body>
</html>