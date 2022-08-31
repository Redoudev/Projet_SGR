<?php
session_start();
if ($_SESSION["role"] == "admin") {

    include "../../../../php/connexion.php";

    if (isset($_POST["Validez"])) {
        $id_b = htmlspecialchars($_POST['id']);
        $nom_b = htmlspecialchars($_POST['nom_boisson']);
        $desc_b  = htmlspecialchars($_POST['description']);
        $prix_u = htmlspecialchars($_POST['PU']);
        $pdo->query("INSERT INTO boisson (id, nom_boisson, description, PU ) VALUE(NULL, '$nom_b' , '$desc_b', '$prix_u')");
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
        <form action="#" method="POST" id="ValidationDuFormulaireBoisson">
            <a href="../produit.php" class="back_btn"> Retour</a>
            <h2>Ajouter une boisson </h2>
            <!-- <label for="id">Identifiant</label> -->
            <input name="id" id="id" type="hidden">
            <!-- Le nom de la boisson -->
            <label for="nom_boisson">Nom de la boisson</label>
            <input name="nom_boisson" id="nom_boisson" type="text"> <br>
            <!-- La description de la boisson -->
            <label for="description">Description de la boisson</label>
            <input name="description" id="description" type="text"> <br>
            <!-- Le prix unitaire de la boisson -->
            <label for="prix_unitaire">Prix unitaire</label>
            <input name="PU" id="prix_unitaire" type="number"> <br>
            <!-- Le bouton d'envoi -->
            <input type="submit" name="Validez" value="Ajouter"> <br>


            <p style="color: red;" id="erreur"></p>
        </form>
        <!-- Script DarkMode -->
        <script src="/SGRC/js/source/dark_mode.js"></script>
        <!-- SCRIPT FONT AWESOME -->
        <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
        <!-- Script ValidationJS -->
        <script src="../../../../js//admin//produit//ajouter_modifier//verification-boisson.js"></script>
    </body>

    </html>
<?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: ../../../../index.php");
    exit();
}
?>