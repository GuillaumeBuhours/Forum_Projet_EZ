<?php
session_start();

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

if (isset($_POST['createTopic']) && $_POST['createTopic'] != '') {
    $longueur_chaine = strlen($_POST['createTopic']);
	if($longueur_chaine <= 8){
		$erreur = true;
		$retour .= "La référence recherchée doit comporter 8 caractères.<br />";
	}
	// On vérifie à l'aide d'expression régulière que la référence respecte bien la forme ABCD1234
	$exp = "/[a-zA-Z]/";
	if(!preg_match($exp, $_POST['createTopic'])){
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
    $sql = " UPDATE utilisateurs SET topic = :topic WHERE pseudo = :pseudo";
    $requete = $bdd->prepare( $sql );
    $requete->bindParam( ':topic',  $_POST[ 'createTopic' ] );
    $requete->bindParam( ':pseudo',  $_SESSION['loginPostForm']);
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

?>