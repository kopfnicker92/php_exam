<?php 
session_start();

ini_set('display_errors', 1);
error_reporting(E_WARNING | E_ERROR);

define('login', 'miaow');

include 'functions.inc.php';

if (($_POST) && isset($_POST['btnLogin'])){

	// 1. Sanitization && Honeypot
	$login = trim(strip_tags($_POST['login']));
	$password = trim(strip_tags($_POST['password']));

	if($_POST['user_email'] !='') {
		die('Degage raclure de toilette de spammeur');
	}

	// 2. Validation

	$erreurs = array();

	// login vide ?
	if ($login == '') {
		$erreurs['login'] = "Impossible de s'inscrire sans Login";
	}

	// password vide ?
	if ($password == '') {
		$erreurs['password'] = "Pas de mot de passe pas de Login";
	}

	if(empty($erreurs)) {
		//db connection
		$db_connection = db_connect();
		//db selection, searching for username and password match
		$select = "SELECT login, password FROM user WHERE login = '$login' AND password = '$password'";
		$preparedStatement = $db_connection->prepare($select);

		//execute
		$preparedStatement->execute();

		//fetching liefert assoziatives array 
		$user = $preparedStatement->fetch(PDO::FETCH_ASSOC);

		//kein match gefunden
		if($user === false){
	        echo('Incorrect username / password combination!');

	    } else{
	    	$_SESSION['logged_in'] = 'ok';
	    	$_SESSION['username'] = $login;
	    	$_SESSION['role'] = $user['role'];
	    }
	}
}

//CREATE
if (($_POST) && isset($_POST['btnSignup'])) {

// 1. Sanitization && Honeypot
	$email = trim(strip_tags($_POST['email']));

	$erreurs = array();

	// email vide ?
	if ($email == '') {
		$erreurs['email'] = "Impossible de s'inscrire sans Mail";
	}

	// email invalide ?
	if (!is_valid_email($email)) {
		$erreurs['invalidmail'] = "Email pas valide";
	}

	if(empty($erreurs)) {
		//db connection
		$db_connection = db_connect();
		$date = time();
		//db insert
		$eintrag = "INSERT INTO user (email, role, date) VALUES ('$email', 'guest', '$date')";
		//bind values
		// $preparedStatement->bindValue(":email", $email);
		// $preparedStatement->bindValue(":date", $date);

		$preparedStatement = $db_connection->prepare($eintrag);
		$preparedStatement->execute();

	}
}

//DELETE

if (($_POST) && isset($_POST['btnDelete'])) {

$id = trim(strip_tags($_POST['id']));

$erreurs = array();

// id vide ?
if ($id == '') {
	$erreurs['id'] = "Please enter an ID";
}

	if(empty($erreurs)) {
		//db connection
		$db_connection = db_connect();
		//db insert
		$delete = "DELETE FROM user WHERE id = '$id'";
		$preparedStatement = $db_connection->prepare($delete);
		$preparedStatement->execute();

	}
}

if (($_POST) && isset($_POST['btnUpdate'])) {
	$idold = trim(strip_tags($_POST['idold']));
	$loginupd = trim(strip_tags($_POST['loginupd']));
	$passwordupd = trim(strip_tags($_POST['passwordupd']));
	$emailupd = trim(strip_tags($_POST['emailupd']));

if ($idold == '') {
	$erreurs['id'] = "Please enter an ID";
}

		//db connection
		$db_connection = db_connect();
		//db insert
		$delete = "UPDATE user SET login = '$loginupd', password = '$passwordupd', email = '$emailupd' WHERE id = '$idold'";
		$preparedStatement = $db_connection->prepare($delete);
		$preparedStatement->execute();

}
?>


<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php include 'meta.inc.php'; ?>
	</head>

	<body>
		<main>
			<?php 
				if($_SESSION['logged_in'] == 'ok'){
					include 'directory.view.php';
				} else { 
					include 'login.view.php';
				}
			 ?>
		</main>
	</body>	
</html>