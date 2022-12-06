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
$query = $bdd->prepare( 'SELECT * FROM utilisateurs WHERE topic = :topic' );
$query->bindParam( ':topic', $_POST[ 'topic' ] );
$query->execute();
foreach ( $query->fetchAll( PDO::FETCH_ASSOC ) as $row ) {
    // Si il y a des résultats...
    $retour .= 'La référence saisie est déjà utilisée !<br />';
    $erreur = true;
    break;
}

if (isset($_POST['topic']) && $_POST['topic'] != '') {
    $longueur_chaine = strlen($_POST['recherche']);
	if($longueur_chaine != 8){
		$erreur = true;
		$retour .= "La référence recherchée doit comporter 8 caractères.<br />";
	}
	// On vérifie à l'aide d'expression régulière que la référence respecte bien la forme ABCD1234
	$exp = "/^[a-zA-Z]{4}[0-9]{4}$/";
	if(!preg_match($exp, $_POST['recherche'])){
		$erreur = true;
		$retour .= "La référence saisie n'est pas valide.<br />";
	}
}else{
	$erreur = true;
	$retour .= "Veuillez renseigner le champ 'Référence recherchée'.<br />";
}
}

if ( !$erreur ) {
    // On insère les informations en base de données
    $sql = "INSERT INTO utilisateurs VALUES(:topic)";
    $requete = $bdd->prepare( $sql );
    $requete->bindParam( ':topic',  $_POST[ 'topic' ] );
    if ( $requete->execute() ) {
        $retour .= "Le topic a été ajouté avec succès.<br />";
        header("refresh:5;url=../accueil.php");
    } else {
        $retour .= "Un erreur est apparue lors de l'ajout du topic.<br />";
        header("refresh:5;url=../accueil.php");
    }
    $requete->closeCursor();
}


if ( $retour != '' ) {
    echo '<p>'.$retour.'</p>';
}