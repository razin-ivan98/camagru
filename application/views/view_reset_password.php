<script src="/js/reset_password.js"></script>
	<div class="border">
		<div class="form">
			<div class="title">
				<h2>ВОССТАНОВИТЬ ПАРОЛЬ</h2>
			</div>
				<form id="reset_form">
                    <input type="hidden" name="link" value="<?php if (isset($data)) echo $data; ?>">
					<div class="str"><text>ПАРОЛЬ</text><input type="password" name="password"/></div>
					<div class="str"><text>ПОВТОРИТЕ</text><input type="password" name="confirm_password"/></div>
					<div class="str"><button class="button" type="button" onclick="reset_pass();">ИЗМЕНИТЬ</button></div>
				</form>

				<div class="str"><a href="/login">войти</a></div>
			
		</div>
	</div>