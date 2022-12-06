<?php

$dbhost = 'localhost';
$dbname = 'forum_users';
$dbuser = 'root';
$dbpass = '';
try{

    $bdd = new PDO( 'mysql:host='.$dbhost.';dbname='.$dbname.'', $dbuser, $dbpass );
} catch( Exception $e ){
    die( 'Erreur : ' . $e->getMessage() );
}

	$id="";	

	try
	{	

		$bdd=new PDO('mysql:host=localhost;dbname=forum_users','root','');

	}
	catch(Exception $e)
	{
	
		die('<strong>Erreur détectée !!! </strong>' . $e->getMessage());
	}
	
	$requete=$bdd->prepare('SELECT * FROM utilisateurs WHERE id=id') or die (print_r($bdd->errorInfo()));
	
	$requete->execute(array($_POST['suppr_compte']));

	while ($data=$requete->fetch())
	{
		$id=$data['suppr_compte'];
	}
	if ($id=="")
	{	
	
		echo 'Impossible de supprimer les donn�es. Le nom de ce membre n\'est pas enregistr� dans la base.';
	}
	else
	{

		$requete=$bdd->prepare('DELETE FROM utilisateurs WHERE id=:id') or die (print_r($bdd->errorInfo()));

		$requete->execute(array(
		'id' => $_POST['suppr_compte'],
		));
	
		echo 'Les informations concernant le nouveau membre ont bien �t� supprim�es de la base.';
    session_destroy();
	}

	$requete->closeCursor();
echo "glouglou2";
	?>	