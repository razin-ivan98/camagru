
<script src="confirm.js"></script>
	<div class="border">
		<div class="form">
			<div class="title">
				<h4>Dear <?php echo $my_name;?>! Your account was not confirmed</h4>
			</div>
				
				<form id="confirm_form">
					<div class="str""><text>EMAIL</text><input type="text" name="email"/></div>
					
					<div class="str"><button class="button" type="button" onclick="confirm();">Submit</button></div>
				</form>
				<div class="str"></div>
				<div class="str"><a href="/feeds/logout">LOGOUT</a></div>
			
		</div>
	</div>