<?php
session_start();
if (isset($_SESSION['id_user'])) {  //if user is logged in then come to this page otherwise go to login page
    include_once "connexion.php";
    $deconnexion = mysqli_real_escape_string($link, $_GET['deconnexion']);
    if (isset($deconnexion)) { // if logout id is set
        $status = "Hors ligne";
        // once user logout the we'll update this status to offline and in the login
        // form we'll again update the status to active now if user logged in successfuly
        $sql = mysqli_query($link, "UPDATE user SET status = '{$status}' WHERE id_user = {$deconnexion}");
        if ($sql) {
            session_unset();
            session_destroy();
            header("Location: ../index.php");
        }
    } else {
        // header("location: ../inculde/user.php");   voir le technique a quoi sa sert
    }
} else {
    header("location: Location: ../index.php");
}
