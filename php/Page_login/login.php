<?php
session_start();
include_once "../connexion.php";
$login = mysqli_real_escape_string($link, $_POST['login']);
$password = mysqli_real_escape_string($link, $_POST['mdp']);

if (!empty($login) && !empty($password)) {
    // Verification de user et mot de passe si cela existe dans BDD
    $sql = mysqli_query($link, "SELECT * FROM user WHERE login='{$login}'");
    if (mysqli_num_rows($sql) > 0) { //si existe
        $row = mysqli_fetch_assoc($sql);
        $passwordHash = $row['mdp'];
        if (password_verify($password, $passwordHash)) {
            $status = "En ligne";
            // updating user status to active now if user login successfuly
            $sql2 = mysqli_query($link, "UPDATE user SET status = '{$status}' WHERE id_user = {$row['id_user']}");
            if ($sql2) {
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['role'] = $row['role']; // using this session we user unique_id in other php file
                echo "success";
            }
        }else {
            echo "Login ou mot de passe incorrect";
        }
    } else {
        echo "Login ou mot de passe incorrect";
    }
} else {
    echo "Tous les champs de saisie sont obligatoires !";
}
