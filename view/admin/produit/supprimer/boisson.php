<?php
session_start();
if ($_SESSION["role"] == "admin") {
    //connexion a la base de données
    include "../../../../php/connexion.php";

    if (isset($_GET['id_b'])) {
        $id_boisson = $_GET['id_b'];
        $statmt = $pdo->prepare('delete from `boisson` where `id`=' . $id_boisson . ';');
        $statmt->execute();
        header('location: ../produit.php');
    }
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: ../../../../index.php");
    exit();
}
