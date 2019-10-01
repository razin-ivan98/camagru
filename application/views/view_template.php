<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=600px">
		<title>PicChat</title>
	
		
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="feeds.css">

		<script src="index.js"></script>
	</head>
	<body>
		<div class="header">
			<div class="head">
				<div class="mobile-menu" onclick="menu();">
					<img class="mibile-menu-image", src="menu.png">
					<div class="alert"></div>
				</div>
				
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
<!-- footer -->
	</body>
</html>