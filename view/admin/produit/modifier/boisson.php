<?php
session_start();
if ($_SESSION["role"] == "admin") {

    include "../../../../php/connexion.php";

    $id_b = $_GET['id_b'];
    $Requete_edit_boisson = "SELECT * FROM `boisson` WHERE id = " . $id_b . "";
    $re = $pdo->query($Requete_edit_boisson);
    $boisson = $re->fetchALL(PDO::FETCH_ASSOC);

?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/SGRC/css/style_admin/produit/edition-ajoute.css" rel="stylesheet">
        <title>Modification produit</title>
    </head>

    <body>
        <div class="right">
            <div class="theme-toggler" id="theme-toggler">
                <!-- Dark and Light -->
                <i class="fa-solid fa-circle-half-stroke active"></i>
            </div>
        </div>
        <form action="#" method="POST" id="ValidationDuFormulaireBoisson">
            <a href="../produit.php" class="back_btn"> Retour</a>
            <h2>Modifier la boisson </h2>
            <!-- <label for="id">Identifiant</label> -->
            <input name="id" id="id" type="hidden" value=<?php echo  htmlspecialchars(($boisson[0]['id'])) ?>>
            <!-- Le nom de la boisson -->
            <label for="nom_boisson">Nom de la boisson</label>
            <input name="nom_boisson" id="nom_boisson" type="text" value="<?php echo  htmlspecialchars(($boisson[0]['nom_boisson'])) ?>"> <br>
            <!-- La description de la boisson -->
            <label for="description">Description de la boisson</label>
            <input name="description" id="description" type="text" value="<?php echo  htmlspecialchars(($boisson[0]['description'])) ?>"> <br>
            <!-- Le prix unitaire de la boisson -->
            <label for="prix_unitaire">Prix unitaire</label>
            <input name="PU" id="prix_unitaire" type="number" value="<?php echo  htmlspecialchars(($boisson[0]['PU'])) ?>"> <br>
            <!-- Le bouton d'envoi -->
            <input type="submit" name="Validez" value="Ajouter">

            <?php
            if (isset($_POST['Validez'])) {
                // Variable des éléments
                $id_b = htmlspecialchars($_POST['id']);
                $nom_b = htmlspecialchars($_POST['nom_boisson']);
                $desc_b  = htmlspecialchars($_POST['description']);
                $prix_u = htmlspecialchars($_POST['PU']);
                // Variable de id_menu en GET
                $id_b_get = $_GET['id_b'];

                $reqUP = "UPDATE boisson SET nom_boisson='$nom_b',description='$desc_b',PU='$prix_u' WHERE id ='$id_b_get'";
                $resulat = mysqli_query($link, $reqUP);
                header('location: ../produit.php');
            }
            ?> <br>
            <p style="color: red;" id="erreur"></p>
        </form>
        <!-- Script DarkMode -->
        <script src="/SGRC/js/source/dark_mode.js"></script>
        <!-- SCRIPT FONT AWESOME -->
        <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
        <!-- Script ValidationJS -->
        <script src="/SGRC/js/admin/produit/ajouter_modifier/verification-boisson.js"></script>
    </body>

    </html>
<?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: /Projet_SGR/index.php");
    exit();
}
?>


/Projet_SGR/index.php