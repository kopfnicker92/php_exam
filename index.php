<?php 
ini_set('display_errors', 1);
error_reporting(E_WARNING | E_ERROR);

define('login', 'miaow');

include 'functions.inc.php';

if (($_POST) && isset($_POST['btnSignup'])){

	// 1. Sanitization && Honeypot
	$email = trim(strip_tags($_POST['email']));

	if($_POST['user_email'] !='') {
		die('Degage raclure de toilette de spammeur');
	}

	// 2. Validation
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

	$userID = $db_connection->lastInsertId();
	$subject = "Newsletter confirmation";
	$message = "<a href='http://localhost:8888/phpexam/email/confirm.php?id=$userID'>The Link</a>";

	mail($email, $subject, $message);

	// echo $message;

	echo "Congratulations you are signed up. A verification email is already sent";
}

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
				
				include 'signup.view.php';
				
			 ?>
		</main>
	</body>	
</html>
