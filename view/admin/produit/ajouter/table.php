<?php
session_start();
if ($_SESSION["role"] == "admin") {

    include "../../../../php/connexion.php";

    if (isset($_POST["Validez"])) {
        $id_t = htmlspecialchars($_POST['id_table']);
        $num_table = htmlspecialchars($_POST['numero_table']);
        $type_table  = htmlspecialchars($_POST['type_table']);
        $pdo->query("INSERT INTO sgr_table (id_table, numero_table, type_table ) VALUE(NULL, '$num_table' , '$type_table')");
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
        <form action="#" method="POST" id="ValidationDuFormulaireTable">
            <a href="../produit.php" class="back_btn"> Retour</a>
            <h2>Ajouter une table </h2>
            <!-- <label for="id_table">Identifiant</label> -->
            <input name="id_table" id="id_table" type="hidden">
            <!-- Le numero de la table -->
            <label for="numero_table">Numero de la table</label>
            <input name="numero_table" id="numero_table" type="number"> <br>
            <!-- Le type de table -->
            <label for="type_table">Type de table</label>
            <select name="type_table" id="type_table">
                <option value="CAR">CAR</option>
                <option value="RON">RON</option>
            </select> <br>
            <!-- Le bouton d'envoi -->
            <input type="submit" name="Validez" value="Ajouter"> <br>


            <p style="color: red;" id="erreur"></p>
        </form>
        <!-- Script DarkMode -->
        <script src="/SGRC/js/source/dark_mode.js"></script>
        <!-- SCRIPT FONT AWESOME -->
        <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
        <!-- Script ValidationJS -->
        <script src="/SGRC/js/admin/produit/ajouter_modifier/verification-table.js"></script>

    </body>

    </html>
<?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: ../../../../index.php");
    exit();
}
?>