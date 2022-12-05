<?php
require_once __DIR__.'/Utilisateur.php';
$sql =
    'SELECT *
    FROM utilisateur
    ';

$lignes_utilisateurs = $connection->query($sql);

if ($lignes_utilisateurs->num_rows > 0) {
            while($row = $lignes_utilisateurs->fetch_assoc()) {
                $utilisateur = new Utilisateur(
                    $row['id'],
                    $row['pseudo'],
                    $row['nom'],
                    $row['prenom']
                );
                $utilisateurs[]=$utilisateur;
            }}

//faire une requête pour remplir le tableau avec des objets
//construits grâce aux résultats de cette requête

echo "<table>\n";
echo "<thead>\n";
echo "<tr>\n";
foreach(['pseudo','prénom','nom'] as $legend){
    echo "<th>${legend}</th>\n";
}
echo "</tr>\n";
echo "</thead>\n";
echo "<tbody>\n";
foreach($utilisateurs as $utilisateur){
    echo "<tr>\n";
    echo '<td>'.$utilisateur->getPseudo()."</td>\n";
    echo '<td>'.$utilisateur->getPrenom()."</td>\n";
    echo '<td>'.$utilisateur->getNom()."</td>\n";
    echo "</tr>\n";
}
echo "</tbody>\n";
echo "</table>\n";