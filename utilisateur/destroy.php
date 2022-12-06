<?php
include_once "index.php";

$pdo = pdo_connect();

if (isset($_POST["id"])) {

    $id=$_POST["id"];

    $delete="DELETE FROM utilisateurs WHERE id=$id";

    if($pdo($delete))
        echo '{"deleted":"true"}';
    else
        echo '{"deleted":"false"}';

}