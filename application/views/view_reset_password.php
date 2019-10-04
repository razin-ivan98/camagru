<script src="login.js"></script>
	<div class="border">
		<div class="form">
			<div class="title">
				<h2>ВОССТАНОВЛЕНИЕ ПАРОЛЯ</h2>
			</div>
				
				<form id="login_form">
                    <input type="hidden" name="link" value="<?php if (isset($link)) echo $link; ?>">
					<div class="str"><text>ПАРОЛЬ</text><input type="password" name="password"/></div>
					<div class="str"><text>ПОВТОРИТЕ</text><input type="password" name="confirm_passord"/></div>
					<div class="str"><button class="button" type="button" onclick="reset();">ИЗМЕНИТЬ</button></div>
				</form>

				<div class="str"><a href="/login">войти</a></div>
			
		</div>
	</div>