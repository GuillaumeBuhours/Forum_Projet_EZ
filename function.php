<?php
include_once("connection_bdd.php");
$retour = '';
$erreur = false;

function setConnected($loginPostForm, $passwordPostForm) {
    if (isset($_SESSION)) {
        
        $_SESSION['loginPostForm'] = htmlspecialchars(secure_donnee(trim($loginPostForm))); 
        $_SESSION['passwordPostForm'] = htmlspecialchars(secure_donnee($passwordPostForm));
    }
}

function isConnect() { 
    if (isset($_SESSION) && isset($_SESSION['loginPostForm']) && isset($_SESSION['passwordPostForm'])) {
        return true;
    }else {
        return false;
    }
}

function secure_donnee($donnee){
    if(ctype_digit($donnee)){
        return intval($donnee);
    }else{
        return addslashes($donnee);
    }
}
if (!isset($_POST)) {
    $erreur = true;
}

/*********** debut tests ***********/
if(isset($_POST['pseudo1']) && $_POST['pseudo1'] != ''){    
    $longueur_chaine = strlen($_POST['pseudo1']);
    if($longueur_chaine < 8 || $longueur_chaine > 15){
        $erreur = true;
        $retour .= '<p style="color:red; text-align:center;">Le pseudo doit être composé de 4 caractères minimum et ne doit pas dépasser 15 caractères.</p>';
    }
    $exp = "/[a-zA-Z0-9]/";
    if(!preg_match($exp, $_POST['pseudo1'])){
        $erreur = true;
        $retour .= '<p style="color:red; text-align:center;">La pseudo saisie n\'est pas valide.</p>';
    }
}
if(isset($_POST['mdp1']) && $_POST['mdp1'] != ''){    
    $longueur_chaine = strlen($_POST['mdp1']);
    if($longueur_chaine < 8 || $longueur_chaine > 20){
        $erreur = true;
        $retour .= '<p style="color:red; text-align:center;">Le mot de passe doit être composé de 12 caractères minimum et ne doit pas dépasser 20 caractères.</p>';
    }
    $exp = "/[a-zA-Z0-9]/";
    if(!preg_match($exp, $_POST['mdp1'])){
        $erreur = true;
        $retour .= '<p style="color:red; text-align:center;">La mot de passe  saisie n\'est pas valide.</p>';
    }
}
/*********** Fin tests ***********/

if(!$erreur && isset($_POST['pseudo1'],$_POST['mdp1'])){
    $query = $bdd->prepare( 'SELECT * FROM utilisateurs WHERE pseudo=:pseudo1 AND mdp=:mdp1' );
    $query->bindParam( ':pseudo1', $_POST[ 'pseudo1' ] );
    $query->bindParam( ':mdp1', $_POST[ 'mdp1' ] );
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
    if(!count($row)){
        // S'il n'y a pas de résultat...
        $retour .= '<p style="color:red; text-align:center;">L\'utilisateur avec ce mot de passe et ce pseudo n\'existe pas.</p>';
    }else{
        setConnected($_POST['pseudo1'], $_POST['mdp1']);
    }
    }


    $nombre_caracteres = strlen($_SESSION['passwordPostForm']);
    $chaine = '';
    for($i = 1; $i <= $nombre_caracteres; $i ++)
    {
        $chaine .= '*';
    }
?>
