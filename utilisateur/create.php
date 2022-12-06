<?php
require_once __DIR__.'/Utilisateur.php';
$retour = '';
$erreur = false;

$dbhost = 'localhost';
$dbname = 'forum_users';
$dbuser = 'root';
$dbpass = '';
try {

    $bdd = new PDO( 'mysql:host='.$dbhost.';dbname='.$dbname.'', $dbuser, $dbpass );
} catch( Exception $e ) {
    die( 'Erreur : ' . $e->getMessage() );
}

// Si les données reçues sont valides, on va les sécuriser en s'aidant de notre fonction créee au début
if(!$erreur){
    // On vérifie que la référence n'existe pas en base de données
$query = $bdd->prepare( 'SELECT * FROM utilisateurs WHERE pseudo = :pseudo' );
$query->bindParam( ':pseudo', $_POST[ 'pseudo' ] );
$query->execute();
foreach ( $query->fetchAll( PDO::FETCH_ASSOC ) as $row ) {
    // Si il y a des résultats...
    $retour .= 'La référence saisie est déjà utilisée !<br />';
    $erreur = true;
    break;
}

if ( !$erreur ) {
    // On insère les informations en base de données
    $sql = "INSERT INTO utilisateurs VALUES(NULL,:mail,:pseudo,:mdp,0,'','',NULL)";
    $requete = $bdd->prepare( $sql );
    $requete->bindParam( ':mail',  $_POST[ 'mail' ] );
    $requete->bindParam( ':pseudo', $_POST[ 'pseudo' ] );
    $requete->bindParam( ':mdp', $_POST[ 'mdp' ] );
    if ( $requete->execute() ) {
        $retour .= "L'utilisateur a été ajouté avec succès.<br />";
        header("refresh:5;url=../accueil.php");
    } else {
        $retour .= "Un erreur est apparue lors de l'ajout de l'utilisateur.<br />";
        header("refresh:5;url=../accueil.php");
    }
    $requete->closeCursor();
}
}

if ( $retour != '' ) {
    echo '<p>'.$retour.'</p>';
}


?>