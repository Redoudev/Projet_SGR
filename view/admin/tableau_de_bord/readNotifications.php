<?php
session_start();
include("../../../php/connexion.php");

$sql = "UPDATE messages SET lu ='1'
WHERE id_destinataire = {$_SESSION['id_user']} ";
$res = mysqli_query($link, $sql);
if ($res) {
    echo "Success";
} else {
    echo "Failed";
}
