	<form method="POST">
		<label for="login"></label>
		<input type="text" name="login" id="login" placeholder="Login" />
		<?php if (isset($erreurs['login'])) {
			echo message_erreur($erreurs, 'login');
		} ?>
				
		<label for="password"></label>
		<input type="password" name="password" id="password" placeholder="Password" />
		<?php if (isset($erreurs['password'])) {
			echo message_erreur($erreurs, 'password');
		} ?>

		<div class="hidden-mail">
			<label for="user_email">adresse Mail</label>
			<input type="text" name="user_email" id="user_email" placeholder="mail" />
		</div>
				
		<input name="btnLogin" type="submit" value="Login" />
	</form>
