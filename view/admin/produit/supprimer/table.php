<?php
session_start();
if ($_SESSION["role"] == "admin") {
    //connexion a la base de données
    include "../../../../php/connexion.php";

    if (isset($_GET['id_t'])) {
        $id_table = $_GET['id_t'];
        $statmt = $pdo->prepare('delete from sgr_table where `id_table`=' . $id_table . ';');
        $statmt->execute();
        header('location: ../produit.php');
    }
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: ../../../../index.php");
    exit();
}
