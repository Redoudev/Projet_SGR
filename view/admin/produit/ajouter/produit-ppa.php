<?php
session_start()
?>
<?php
if ($_SESSION["role"] == "admin") {
?>
    <?php
    include "../../../../php/connexion.php";

    if (isset($_POST["Validez"])) {
        $id_ppa = htmlspecialchars($_POST['id_produit']);
        $nom_ppa = htmlspecialchars($_POST['nom_produit']);
        $pdo->query("INSERT INTO produit (id_produit, nom_produit) VALUE(NULL, '$nom_ppa')");
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
        <form action="#" method="POST" id="ValidationDuFormulaireProduitPA">
            <a href="../produit.php" class="back_btn"> Retour</a>
            <h2>Ajouter un produit </h2>
            <!-- <label for="id_produit">Identifiant</label> -->
            <input name="id_produit" id="id_produit" type="hidden">
            <!-- Le nom du produit -->
            <label for="nom_produit">Nom du produit</label>
            <input name="nom_produit" id="nom_produit" type="text"> <br>
            <!-- Le bouton d'envoi -->
            <input type="submit" name="Validez" value="Ajouter"> <br>


            <p style="color: red;" id="erreur"></p>
        </form>
        <!-- Script DarkMode -->
        <script src="/SGRC/js/source/dark_mode.js"></script>
        <!-- SCRIPT FONT AWESOME -->
        <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
        <!-- Script ValidationJS -->
        <script src="../../../../js//admin//produit//ajouter_modifier//verification-produit-pa.js"></script>
    </body>

    </html>
<?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: ../../../../index.php");
    exit();
}
?>