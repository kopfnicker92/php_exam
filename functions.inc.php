<?php 
	if(!defined('login')){
		die('acces interdit');
	}	

	function message_erreur($err, $clef){
		if ( $err[$clef] !== ''){
			return '<p class="error">'.$err[$clef].'<p>';
		}
	}

	function is_valid_email($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	function db_connect() {
	// définition des variables de connexion à la base de données	
	try {
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		// INFORMATIONS DE CONNEXION
		$host = 'localhost';
		$dbname = 'maildb';
		$user = 'root';
		$password = 'root';
		// FIN DES DONNEES
		$connection = new PDO('mysql:host='.$host.';dbname='.$dbname.'', $user, $password, $pdo_options);
		return $connection;
	} catch (Exception $e) {
		die('Erreur de connexion : ' . $e->getMessage());
	}
}





