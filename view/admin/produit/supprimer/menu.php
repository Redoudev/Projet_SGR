<?php
session_start();
if ($_SESSION["role"] == "admin") {
    //connexion a la base de données
    include "../../../../php/connexion.php";

    if (isset($_GET['id_m'])) {
        $id_menu = $_GET['id_m'];
        $statmt = $pdo->prepare('delete from contenir_menu_plat where `id_menu`=' . $id_menu . ';');
        $statmt->execute();
        $statmt = $pdo->prepare('delete from menu where `id_menu`=' . $id_menu . ';');
        $statmt->execute();
        header('location: ../produit.php');
    }
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: ../../../../index.php");
    exit();
}
