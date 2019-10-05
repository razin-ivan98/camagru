<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PicChat</title>
	
		
		<link rel="stylesheet" href="/css/style.css">
		<link rel="stylesheet" href="/css/feeds.css">

		<script src="/js/index.js"></script>
	</head>
	<body>
		<div class="header">
			<div class="head">
				<div class="mobile-menu" onclick="menu();">
					<img class="mibile-menu-image", src="/pics/menu.png">
					<div class="alert"></div>
				</div>
				
				<div class="logo"> 
					<a href="/feeds">
						<img class="logo-image", src="/pics/logolong.png">
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