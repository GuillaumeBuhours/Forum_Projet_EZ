<?php
	// Paramétres et connexion � la base de donn�es
	$serveur  = "localhost";
	$database = "forum_users"; //exo_diag_php_bdd
	$user     = "root";
	$password = "";

	$conn = new PDO('mysql:host='.$serveur.';dbname='.$database.'', $user, $password);
?>
