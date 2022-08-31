<?php
session_start();
include_once "../connexion.php";
$id_expediteur = $_SESSION['id_user'];
$searchTerm = mysqli_real_escape_string($link, $_POST['searchTerm']);
$output = "";
$sql = mysqli_query($link, "SELECT * FROM user WHERE NOT id_user = {$id_expediteur} AND login LIKE '%{$searchTerm}%'");

if (mysqli_num_rows($sql) > 0) {
    include "data.php";
} else {
    $output .= "Aucun utilisateur trouvé lié à votre terme de recherche";
}
echo $output;
