<?php
session_start();
if ($_SESSION["role"] == "admin") {
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/SGRC/css/style_admin/produit/edition-ajoute.css" rel="stylesheet">
    <title>Ajouter utilisateur</title>
</head>

<body>
    <div class="right">
        <div class="theme-toggler" id="theme-toggler">
            <!-- Dark and Light -->
            <i class="fa-solid fa-circle-half-stroke active"></i>
        </div>
    </div>
    <form action="#" enctype="multipart/form-data">
        <div class="error-txt"></div>
        <a href="utilisateur.php" class="back_btn"> Retour</a>
        <h2>Ajouter utilisateur </h2>
        <!-- <label for="id_user">Identifiant</label> -->
        <input name="id_user" id="id_user" type="hidden">
        <!-- Login -->
        <label for="login">Login</label>
        <input name="login" id="login" type="text" autocomplete="off" required> <br>
        <!--Rôle -->
        <label for="role">Rôle</label>
        <input name="role" id="role" type="text" autocomplete="off" required> <br>
        <!-- Le mot de passe -->
        <label for="mdp">Mot de passe</label>
        <input name="mdp" id="mdp" type="password" autocomplete="off" required> <br>
        <!--Image -->
        <label for="image">Image</label>
        <input name="image" id="image" type="file" autocomplete="off" required> <br>
        <!-- Le bouton d'envoi -->
        <input type="submit" name="Validez" value="Ajouter" class="button"> <br>


        <!-- <p style="color: red;" id="erreur"></p> -->
    </form>
    <!-- Script Dark Mode -->
    <script src="../../../js/source/dark_mode.js"></script>
    <!-- SCRIPT FONT AWESOME -->
    <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
    <!-- Script ValidationJs -->
    <!-- <script src="../../../js/admin/utilisateur/verification_utilisateur.js"></script> -->
    <script src="../../../js/admin/utilisateur/verification_utilisateur2.js"></script>
</body>

</html>
<?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location:../../../index.php");
	exit();
}
?>