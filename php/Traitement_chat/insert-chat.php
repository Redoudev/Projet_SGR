<?php
session_start();
if (isset($_SESSION['id_user'])) {
    include_once "../connexion.php";
    $id_expediteur = mysqli_real_escape_string($link, $_POST['id_expediteur']);
    $id_destinataire = mysqli_real_escape_string($link, $_POST['id_destinataire']);
    $message = mysqli_real_escape_string($link, $_POST['message']);

    if (!empty($message)) {
        $sql = mysqli_query($link, "INSERT INTO messages (id_expediteur, id_destinataire, message) 
            VALUE ({$id_expediteur}, {$id_destinataire}, '{$message}')") or die();
    }
} else {
    header("../../index.php");
}
