<?php
session_start();
if ($_SESSION["role"] == "admin") {
    //connexion a la base de données
    include "../../../../php/connexion.php";

    if (isset($_GET['id_ppa'])) {
        $id_ppa = $_GET['id_ppa'];
        $statmt = $pdo->prepare('delete from contenir_plat_produit where `id_produit`=' . $id_ppa . ';');
        $statmt->execute();
        $statmt = $pdo->prepare('delete from contenir_boisson_produit where `id_produit`=' . $id_ppa . ';');
        $statmt->execute();
        $statmt = $pdo->prepare('delete from produit where `id_produit`=' . $id_ppa . ';');
        $statmt->execute();
        header('location: ../produit.php');
    }
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: ../../../../index.php");
    exit();
}
