<?php
$nom_du_serveur ="localhost";
$nom_de_la_base ="SGR_MONO";
$nom_utilisateur ="root";
$passe ="";
 
$link = mysqli_connect ($nom_du_serveur,$nom_utilisateur,$passe,$nom_de_la_base);

$pdo = new PDO("mysql:host=localhost;dbname=SGR_MONO", "root", "");
?>
