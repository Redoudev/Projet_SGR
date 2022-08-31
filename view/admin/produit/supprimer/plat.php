<?php
session_start();
if ($_SESSION["role"] == "admin") {
    //connexion a la base de données
    include "../../../../php/connexion.php";

    if (isset($_GET['id_pl'])) {
        $id_plat = $_GET['id_pl'];
        $statmt = $pdo->prepare('delete from contenir_menu_plat where `id_plat`=' . $id_plat . ';');
        $statmt->execute();
        $statmt = $pdo->prepare('delete from contenir_plat_produit where `id_plat`=' . $id_plat . ';');
        $statmt->execute();
        $statmt = $pdo->prepare('delete from plat where `id_plat`=' . $id_plat . ';');
        $statmt->execute();
        header('location: ../produit.php');
    }
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: ../../../../index.php");
    exit();
}
