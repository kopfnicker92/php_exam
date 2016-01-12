<a class="btn-logout" href="logout.php">Logout</a>
<h2>Hello <?php echo $_SESSION['username']; ?></h2>

<form method="POST">
	<label for="email"></label>
	<input type="text" name="email" id="email" placeholder="Email" />
	<?php if (isset($erreurs['email'])) {
		echo message_erreur($erreurs, 'email');
	} ?>
	
	<input name="btnSignup" type="submit" value="Create a User" />
</form>

<h2>All your current users</h2>

<!-- READ -->
<?php
	$db_connection = db_connect();

	$selectall = "SELECT * FROM user";

	$preparedStatement = $db_connection->prepare($selectall);
	$preparedStatement->execute();

	$allusers = $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
	
	foreach ($allusers as $key => $value) {
		foreach ($allusers[$key] as $key => $value) {
			echo "<p>".$key." ".$value."</p>";	
		}
	}
?>

<!-- UPDATE -->
<h2>Update a User</h2>
<form method="POST">
	
	<label for="idold"></label>
	<input type="text" name="idold" id="idold" placeholder="Choose the ID of the User" />
	<?php if (isset($erreurs['idold'])) {
		echo message_erreur($erreurs, 'idold');
	} ?>

	<label for="loginupd"></label>
	<input type="text" name="loginupd" id="loginupd" placeholder="New Login" />

	<label for="passwordupd"></label>
	<input type="text" name="passwordupd" id="passwordupd" placeholder="New Password" />

	<label for="emailupd"></label>
	<input type="text" name="emailupd" id="emailupd" placeholder="New Email" />
	
	<input name="btnUpdate" type="submit" value="Update a User" />
</form>

<!-- DELETE -->
<h2>Delete a User</h2>
<form method="POST">
	<label for="id"></label>
	<input type="text" name="id" id="id" placeholder="id" />
	<?php if (isset($erreurs['id'])) {
		echo message_erreur($erreurs, 'id');
	} ?>
	
	<input name="btnDelete" type="submit" value="Delete a User" />
</form>