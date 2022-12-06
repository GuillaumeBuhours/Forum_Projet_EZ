<?php
require_once __DIR__.'/Utilisateur.php';
$retour="";

$dbhost = 'localhost';
$dbname = 'forum_users';
$dbuser = 'root';
$dbpass = '';
try{

    $bdd = new PDO( 'mysql:host='.$dbhost.';dbname='.$dbname.'', $dbuser, $dbpass );
} catch( Exception $e ){
    die( 'Erreur : ' . $e->getMessage() );
}
$sql = "INSERT INTO utilisateurs VALUES(NULL,:mail,:pseudo,:mdp,0,'','',NULL)";
$requete = $bdd->prepare($sql);
$requete->bindParam( ':mail',  $_POST[ 'mail' ] );
$requete->bindParam( ':pseudo', $_POST[ 'pseudo' ] );
$requete->bindParam( ':mdp', $_POST[ 'mdp' ] );
if($requete->execute()){
    $retour .= "L'utilisateur a été ajouté avec succès.<br />";
}else{
    $retour .= "Un erreur est apparue lors de l'ajout de l'utilisateur.<br />";
}
if($retour != ""){
    echo "<p>".$retour."</p>";
}
$requete->closeCursor();


?>