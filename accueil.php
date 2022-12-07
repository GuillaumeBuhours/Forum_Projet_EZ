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

function setConnected($loginPostForm, $passwordPostForm) {
    if (isset($_SESSION)) {
        
        $_SESSION['loginPostForm'] = htmlspecialchars(trim($loginPostForm)); 
        $_SESSION['passwordPostForm'] = htmlspecialchars($passwordPostForm);
    }
}

function isConnect() { 
    if (isset($_SESSION) && isset($_SESSION['loginPostForm']) && isset($_SESSION['passwordPostForm'])) {
        return true;
    }else {
        return false;
    }
}

if (isset($_POST) && isset($_POST['pseudo1']) && isset($_POST['mdp1'])) {
    if (!empty($_POST['pseudo1'] && $_POST['mdp1'])) {
        $query = $bdd->prepare( 'SELECT * FROM utilisateurs WHERE pseudo=:pseudo1 AND mdp=:mdp1' );
        $query->bindParam( ':pseudo1', $_POST[ 'pseudo1' ] );
        $query->bindParam( ':mdp1', $_POST[ 'mdp1' ] );
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        if(!count($row)){
            // S'il n'y a pas de résultat...
            $retour .= '<span style="color:red;">L\'utilisateur avec ce mot de passe et ce pseudo n\'existe pas.</span>';
        }else{
            setConnected($_POST['pseudo1'], $_POST['mdp1']);
        }
    }else {
        echo "</br><p style='text-align:center;color:red;'>Vous n'avez pas renseigné les champs !</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Project EZ</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<!-- Bouton du header permettant l'inscription, la connection, la déconnection & la consultation du profil -->
    <header id="head">
        <?php if(isConnect()) { ?>
            <a href="deco.php">Se Deconnecter</a>
            <button id="profil" onclick="openProfil()">Profil</button>
        <?php }else{ ?>
            <button id="inscription" onclick="openInscription()">inscription</button>
            <button id="connection" onclick="openConnect()">Connection</button>
        <?php } ?>
        <h1 id="titre">LE FORUM DES GEEKEZ</h1>
    </header>
    <?php echo $retour; ?>
    <br><hr>
    
<!-- Modal d'inscription -->
    <div class="modal" id="modal1">
    <div style="width:100%;text-align:right"><span class="closeBtn" onclick="closeInscription()">X</span></div>
    <h2 style="text-align:center">-- Formulaire d'Inscription --</h2>
    <form class="form" action="utilisateur/create.php" method="post">
    <input class="pseudoTxtarea" type="text" placeholder="E-Mail" name="mail">
    <input class="pseudoTxtarea" type="text" placeholder="Pseudo" name="pseudo">
    <input class="pseudoTxtarea" type="text" placeholder="mot de passe" name="mdp">
    <div style="text-align:center;"><input type="submit" value="S'Inscrire" class="pseudoBtn"></div>
    </form>
    </div>
    
<!-- Modal de connection -->
    <div class="modal" id="modal2">
    <div style="width:100%;text-align:right"><span class="closeBtn" onclick="closeConnect()">X</span></div>
    <h2 style="text-align:center">-- Formulaire de Connection --</h2>
    <form class="form" action="accueil.php" method="post">
    <input class="pseudoTxtarea" type="text" placeholder="Pseudo" name="pseudo1">
    <input class="pseudoTxtarea" type="text" placeholder="mot de passe" name="mdp1">
    <div style="text-align:center;"><input type="submit" value="Se Connecter" class="pseudoBtn"></div>
    </form>
    </div>
    
<!-- Modal du Profil -->
    <div class="modal" id="modal3">
    <div style="width:100%;text-align:right"><span class="closeBtn" onclick="closeProfil()">X</span></div>
    <h2 style="text-align:center">-- Page du profil --</h2>
    <form action="utilisateur/destroy.php" method="post">
    <div class="icon">
    <h4>Pseudo: <?php echo $_SESSION['loginPostForm']?></h4><div class="tdIcons"><img src="./assets/edit.png" alt="edit" onclick="modifPseudo()"></div>
    </div>
    <div class="icon">
    <h4>Mot de Passe: <?php echo $_SESSION['passwordPostForm']?></h4><div class="tdIcons"><img src="./assets/edit.png" alt="edit" onclick="modifMdp()"></div>
    </div>
    <div style="text-align:center;"><input name="btnDeleteAccount" type="submit" value="Supprimer son Compte" class="pseudoBtn"></div>
    </form>
    </div>
    
<!-- modifPseudo -->
    <div class="modal" id="modal4">
    <div style="width:100%;text-align:right"><span class="closeBtn" onclick="closemodifPseudo()">X</span></div>
    <h2 style="text-align:center">-- Modification de Pseudo --</h2>
    <form class="form" action="utilisateur/update.php" method="post">
    <input class="pseudoTxtarea" type="text" placeholder="newPseudo" name="newPseudo">
    <div style="text-align:center;"><input type="submit" value="modifPseudo" class="pseudoBtn"></div>
    </form>
    </div>
<!-- modifMdp -->
    <div class="modal" id="modal5">
    <div style="width:100%;text-align:right"><span class="closeBtn" onclick="closemodifMdp()">X</span></div>
    <h2 style="text-align:center">-- Modification de mot de passe --</h2>
    <form class="form" action="utilisateur/update.php" method="post">
    <input class="pseudoTxtarea" type="text" placeholder="newMdp" name="newMdp">
    <div style="text-align:center;"><input type="submit" value="modifMdp" class="pseudoBtn"></div>
    </form>
    </div>

    <br>
    <!-- fenêtre de création d'un nouveau Topic -->
    <?php if(isConnect()) { ?>
    <div><button name="createTopic" id="createTopic" onclick="openCreateTopic()">Créer un topic</button></div>
    <?php } ?>
    <div class="modal" id="modal6">
    <div style="width:100%;text-align:right"><span class="closeBtn" onclick="closeCreateTopic()">X</span></div>
    <h2 style="text-align:center">-- creer un nouveau Topic --</h2>
    <p id="content" class="contentTopic" contenteditable>&nbsp;</p>
    <div style="text-align:center;"><input type="submit" value="Créer un nouveau Topic" class="pseudoBtn"></div>
    </div>


<!-- Table des topics & début du forum -->
    <table id="conteneur">
        <tr id="index">
            <td id="colone1">Icone</td>
            <td id="colone2">Nom du Topic</td>
            <td id="colone3">Créateur</td>
            <td id="colone4">Nombre de Msg</td>
            <td id="colone5">Nombre de vues</td>
        </tr>
    </table>
<!-- Tableau ou les topics seront implémenté -->
    <div name="topic" id="topic">
    
    </div>
<!-- Fontion pour les modals -->
    <script>
    function openInscription(){ document.getElementById("modal1").style.display="flex"; }
    function closeInscription(){ document.getElementById("modal1").style.display="none"; }
    function openConnect(){ document.getElementById("modal2").style.display="flex"; }
    function closeConnect(){ document.getElementById("modal2").style.display="none"; }
    function openProfil(){ document.getElementById("modal3").style.display="flex"; }
    function closeProfil(){ document.getElementById("modal3").style.display="none"; }
    function modifPseudo() {document.getElementById("modal4").style.display="flex"; }
    function closemodifPseudo() {document.getElementById("modal4").style.display="none";}
    function modifMdp() {document.getElementById("modal5").style.display="flex"; }
    function closemodifMdp() {document.getElementById("modal5").style.display="none";}
    function openCreateTopic() {document.getElementById("modal6").style.display="flex"; }
    function closeCreateTopic() {document.getElementById("modal6").style.display="none";}
    </script>

    <script src="assets/index.js"></script>
</body>
</html>