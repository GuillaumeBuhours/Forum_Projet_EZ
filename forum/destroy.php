<?php
session_start();
$dbhost = 'localhost';
$dbname = 'forum_users';
$dbuser = 'root';
$dbpass = '';

try {

    $bdd = new PDO( 'mysql:host='.$dbhost.';dbname='.$dbname.'', $dbuser, $dbpass );
} catch( Exception $e ) {
    die( 'Erreur : ' . $e->getMessage() );
}

$id='';
$requete = $bdd->prepare( 'SELECT * FROM topic WHERE pseudo=:pseudo' );
$requete->bindParam( ':pseudo',$_SESSION['loginPostForm']);
$requete->execute();

while ( $data = $requete->fetch() )
{
    $id = $data[ 'id' ];
}
$requete->closeCursor();

if ( $id == '' )
{
    echo 'Impossible de supprimer les données. Le topic de ce membre n\'est pas enregistré dans la base.';
	header("refresh:1;url=../accueil.php");
    }
    else
    {
        $requete=$bdd->prepare('DELETE FROM utilisateurs WHERE topic = :topic') or die (print_r($bdd->errorInfo()));
        $requete->bindParam(':topic',$id);
        $requete->execute();
        echo 'Les informations concernant le topic de membre membre ont bien été supprimées de la base.';

	$requete->closeCursor();
}
?>