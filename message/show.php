<?php
$retour = '';
$dbhost = 'localhost';
$dbname = 'forum_users';
$dbuser = 'root';
$dbpass = '';
try {
    $bdd = new PDO( 'mysql:host='.$dbhost.';dbname='.$dbname.'', $dbuser, $dbpass );
} catch( Exception $e ) {
    die( 'Erreur : ' . $e->getMessage() );
}
$query = $bdd->prepare( 'SELECT * FROM message WHERE topic = :topic' );
$query->bindParam( ':topic', $_POST[ 'topic' ] );
if ( $requete->execute() ) {
    $retour .= 'succès.<br />';
    $all = $requete->fetchAll( PDO::FETCH_ASSOC );
    echo json_encode( $all, JSON_PRETTY_PRINT );
} else {
    $retour .= 'blk ca marche pas<br />';
}
$requete->closeCursor();

if ( $retour != '' ) {
    echo '<p>'.$retour.'</p>';
}

?>