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

while ( $data = $requete->fetch() )
{
    $id = $data[ 'id' ];
}
$requete->closeCursor();

if ( $id == '' )
{
    echo 'Impossible de supprimer les données. Le nom de ce membre n\'est pas enregistré dans la base.';
	header("refresh:1;url=../accueil.php");
    }
    else
    {
        $requete=$bdd->prepare('DELETE FROM utilisateurs WHERE id = :id') or die (print_r($bdd->errorInfo()));
        $requete->bindParam(':id',$id);
        $requete->execute();
        echo 'Les informations concernant le nouveau membre ont bien été supprimées de la base.';
		function deconnect() {
			session_destroy();
			unset($_SESSION);
			header('refresh:1;url=../accueil.php');
			exit();
		}		
		deconnect();
	$requete->closeCursor();
}
?>