<?php
session_start();
if ($_SESSION["role"] == "admin") {

    include "../../../../php/connexion.php";

    if (isset($_POST["Validez"])) {
        $id_pl = htmlspecialchars($_POST['id_plat']);
        $nom_pl = htmlspecialchars($_POST['nom_plat']);
        $desc_pl  = htmlspecialchars($_POST['description']);
        $type_pl = htmlspecialchars($_POST['type_plat']);
        $prix_carte = htmlspecialchars($_POST['PU_carte']);
        $pdo->query("INSERT INTO plat (id_plat, nom_plat, description, type_plat, PU_carte ) VALUE(NULL, '$nom_pl' , '$desc_pl', '$type_pl','$prix_carte')");
        header('location: ../produit.php');
    }

?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/SGRC/css/style_admin/produit/edition-ajoute.css" rel="stylesheet">
        <title>Ajoute produit</title>
    </head>

    <body>
        <div class="right">
            <div class="theme-toggler" id="theme-toggler">
                <!-- Dark and Light -->
                <i class="fa-solid fa-circle-half-stroke"></i>
            </div>
        </div>
        <form action="#" method="POST" id="ValidationDuFormulairePlat">
            <a href="../produit.php" class="back_btn"> Retour</a>
            <h2>Ajouter un plat </h2>
            <!-- <label for="id_plat">Identifiant</label> -->
            <input name="id_plat" id="id_plat" type="hidden">
            <!-- Le nom du plat -->
            <label for="nom_plat">Nom du plat</label>
            <input name="nom_plat" id="nom_plat" type="text"> <br>
            <!-- La description du plat -->
            <label for="description">Description du plat</label>
            <input name="description" id="description" type="text"> <br>
            <!-- Le type de plat -->
            <label for="type_plat">Type de plat</label>
            <input name="type_plat" id="type_plat" type="text"> <br>
            <!-- Le prix unitaire du plat -->
            <label for="PU_carte">Prix unitaire</label>
            <input name="PU_carte" id="PU_carte" type="number"> <br>
            <!-- Le bouton d'envoi -->
            <input type="submit" name="Validez" value="Ajouter"> <br>


            <p style="color: red;" id="erreur"></p>
        </form>
        <!-- Script DarkMode -->
        <script src="/SGRC/js/source/dark_mode.js"></script>
        <!-- SCRIPT FONT AWESOME -->
        <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
        <!-- Script ValidationJS -->
        <script src="/SGRC/js/admin/produit/ajouter_modifier/verification-plat.js"></script>
    </body>

    </html>
<?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location:../../../../index.php");
    exit();
}
?>