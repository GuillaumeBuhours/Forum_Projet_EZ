<?php
include_once("./connection_bdd.php");

$id='';
$requete = $bdd->prepare( 'SELECT * FROM topic WHERE pseudo=:pseudo AND id=:id' );
$requete->bindParam( ':pseudo',$_SESSION['loginPostForm']);
$requete->bindParam(':id',$_POST[ 'id' ]);
$requete->execute();

while ( $data = $requete->fetch() )
{
    $id = $data[ 'id' ];
}
$requete->closeCursor();

if ( $id == '' )
{
    echo 'Impossible de supprimer les données. Le topic de ce membre n\'est pas enregistré dans la base, ou le topic n\appartient pas au membre.';
	header("refresh:1;url=../accueil.php");
    $requete->closeCursor();
    }
    else
    {
        $requete=$bdd->prepare('DELETE FROM topic WHERE id = :id') or die (print_r($bdd->errorInfo()));
        $requete->bindParam(':id',$id);
        $requete->execute();
        echo 'Les informations concernant le topic de ce membre ont bien été supprimées de la base.';
        header('refresh:2;url=../accueil.php');
	    $requete->closeCursor();
}
?>