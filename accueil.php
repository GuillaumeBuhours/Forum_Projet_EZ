<?php 
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
    <header id="head">
        <div id="banniere">
            <button id="inscription">inscription</button>
            <button id="connection">Connection</button>
            <button id="deconnection">Deconnection</button>
            <button id="profil">Profil</button>
        </div>
        <h1 id="titre">LE FORUM DES GEEKEZ</h1>
    </header>
    <br><hr>
    <form method="" action="" id="inscrire">
        <input type="text" placeholder="E-Mail" name="mail">
        <input type="text" placeholder="Pseudo" name="pseudo">
        <input type="text" placeholder="mot de passe" name="mdp">
        <button>S'inscrire</button>
    </form>
    <form method="" action="" id="connect"> 
        <input type="text" placeholder="Pseudo" name="name1">
        <input type="text" placeholder="mot de passe" name="mdp1">
        <button>Se Connecter</button>
    </form>
    <table id="conteneur">
        <tr id="index">
            <th class="ligne">Icone</th>
            <th class="ligne">Nom du Topic</th>
            <th class="ligne">Créateur</th>
            <th class="ligne">Nombre de Msg</th>
            <th class="ligne">Nombre de vues</th>
        </tr>
    </table>
    <script src="index.js"></script>
</body>
</html>