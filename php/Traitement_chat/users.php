<?php
session_start();
include_once "../connexion.php";
$id_expediteur = $_SESSION['id_user'];
$sql =  mysqli_query($link, "SELECT * FROM user WHERE NOT id_user = {$id_expediteur}");
$output = "";



if (mysqli_num_rows($sql) == 1) {
    $output .= "Aucun utilisateur n'est disponible pour discuter";
} elseif (mysqli_num_rows($sql) > 0) {
    include "data.php";
}
echo $output;
