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
$requete = $bdd->prepare( 'SELECT * FROM utilisateurs WHERE pseudo=:pseudo' );
$requete->bindParam( ':pseudo',$_SESSION['loginPostForm']);
$requete->execute();

while ($data = $requete->fetch())
{
    $id = $data[ 'id' ];
}
$requete->closeCursor();

if ( $id == '' )
{
    echo 'Impossible de supprimer les données. Le nom de ce membre n\'est pas enregistré dans la base.';
}
else
{
    $requete=$bdd->prepare('DELETE FROM utilisateurs WHERE id = :id') or die (print_r($bdd->errorInfo()));
    $requete->bindParam(':id',$id);
    $requete->execute();
    echo 'Les informations concernant le nouveau membre ont bien été supprimées de la base.';
    heaeder('refresh:2;url=../accueil.php');
    $requete->closeCursor();
}
?>