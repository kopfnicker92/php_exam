<?php

ini_set('display_errors', 1);
error_reporting(E_WARNING | E_ERROR);

define('login', 'miaow');

include 'functions.inc.php';

$dateconfirm = time();

$db_connection = db_connect();

// get actual id
$actual_id = ($_GET["id"]);

// select time of user with good id
$selecttime = "SELECT date FROM user WHERE id = '$actual_id'";

$preparedStatement = $db_connection->prepare($selecttime);

//execute
$preparedStatement->execute();

//fetching liefert assoziatives array 
$user = $preparedStatement->fetch(PDO::FETCH_ASSOC);
$registerdate = $user[date];

if (($dateconfirm - 3060) < $registerdate) {
	echo "T'as pris trop de temps pour confirmer le Mail, tu seras supprimer de la base de données";
	$deleteuser = "DELETE FROM user WHERE id = '$actual_id'";
	$preparedStatement = $db_connection->prepare($deleteuser);
	$preparedStatement->execute();
} else {echo "Félicitations, tu es abonnée à notre Newsletter";}

?>

<a href="index.php">Retour au formulaire</a>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php include 'meta.inc.php'; ?>
	</head>

	<body>
		<main>
			<h2>Email confirmed</h2>
		</main>
	</body>	
</html>