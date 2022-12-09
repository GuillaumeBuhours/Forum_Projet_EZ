<?php
include_once("./connection_bdd.php");
$retour = '';
$erreur = false;

function secure_donnee( $donnee ) {
    if ( ctype_digit( $donnee ) ) {
        return intval( $donnee );
    } else {
        return addslashes( $donnee );
    }
}

if ( !$erreur ) {
    if ( isset( $_POST[ 'modifMessage' ] ) && $_POST[ 'modifMessage' ] != '' ) {
        $longueur_chaine = strlen( $_POST[ 'modifTopic' ] );
        if ( $longueur_chaine <= 8 ) {
            $erreur = true;
            $retour .= 'La référence recherchée doit comporter 8 caractères.<br />';
        }
        $exp = '/[a-zA-Z0-9]/';
        if ( !preg_match( $exp, $_POST[ 'modifMessage' ] ) ) {
            $erreur = true;
            $retour .= "La référence saisie n'est pas valide.<br />";
        }

    } else {
        $erreur = true;
        $retour .= "Veuillez renseigner le champ 'Référence recherchée'.<br />";
    }
}

if ( !$erreur ) {
    $msg = htmlentities( secure_donnee( $_POST[ 'modifMessage' ] ) );
    $sql = 'UPDATE message SET msg = :msg WHERE pseudo = :pseudo AND id= :id';
    $requete = $bdd->prepare( $sql );
    $requete->bindParam( ':msg',  $msg );
    $requete->bindParam( ':pseudo',  $_SESSION[ 'loginPostForm' ] );
    $requete->bindParam( ':id',  $_POST[ 'id' ] );
    if ( $requete->execute() ) {
        $retour .= 'Le topic a été modifier avec succès.<br />';
        header( 'Location:../accueil.php' );
    } else {
        $retour .= 'Une erreur est apparue lors de la modification du topic.<br />';
        header( 'Location:../accueil.php' );
    }
    $requete->closeCursor();
}

if ( $retour != '' ) {
    echo '<p>'.$retour.'</p>';
}

?>