<form method="POST">
	<label for="email"></label>
	<input type="text" name="email" id="email" placeholder="Email" />
	<?php if (isset($erreurs['email'])) {
		echo message_erreur($erreurs, 'email');
	} ?>
	
	<div class="hidden-mail">
		<label for="user_email">adresse Mail</label>
		<input type="text" name="user_email" id="user_email" placeholder="mail" />	
	</div>
	
	<input name="btnSignup" type="submit" value="Sign up" />
</form>

