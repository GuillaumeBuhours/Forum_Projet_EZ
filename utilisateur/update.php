<?php
session_start();
function isConnect() { 
    if (isset($_SESSION) && isset($_SESSION['loginPostForm']) && isset($_SESSION['passwordPostForm'])) {
        return true;
    }else {
        return false;
    }
}
$dbhost = 'localhost';
$dbname = 'forum_users';
$dbuser = 'root';
$dbpass = '';
try {
    $bdd = new PDO( 'mysql:host='.$dbhost.';dbname='.$dbname.'', $dbuser, $dbpass );
} catch( Exception $e ) {
    die( 'Erreur : ' . $e->getMessage() );
}
if (isConnect()) {
    if ( isset( $_POST[ 'newPseudo' ] ) ) {
        $requete = $bdd->prepare( 'UPDATE utilisateurs SET pseudo = :newPseudo WHERE pseudo = :pseudo AND  mdp = :mdp' );
        $requete->bindParam( ':newPseudo', $_POST[ 'newPseudo' ] );
        $requete->bindParam( ':pseudo', $_SESSION['loginPostForm'] );
        $requete->bindParam( ':mdp', $_SESSION['passwordPostForm']);
        $requete->execute();
        $requete->closeCursor();
        $_SESSION['loginPostForm'] = $_POST[ 'newPseudo' ];
    }
}
if (isConnect()) {
    if ( isset( $_POST[ 'newMdp' ] ) ) {
        $requete = $bdd->prepare( 'UPDATE utilisateurs SET mdp = :newMdp WHERE pseudo = :pseudo AND mdp = :mdp' );
        $requete->bindParam( ':newMdp', $_POST[ 'newMdp' ] );
        $requete->bindParam( ':pseudo', $_SESSION['loginPostForm'] );
        $requete->bindParam( ':mdp', $_SESSION['passwordPostForm']);
        $requete->execute();
        $requete->closeCursor();
        $_SESSION['passwordPostForm'] = $_POST[ 'newMdp' ];

    }
}

header( 'Location:../accueil.php' )
?>