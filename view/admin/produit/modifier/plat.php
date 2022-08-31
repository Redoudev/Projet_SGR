<?php
session_start();
if ($_SESSION["role"] == "admin") {

    include "../../../../php/connexion.php";

    $id_pl = $_GET['id_pl'];
    $Requete_edit_plat = "SELECT * FROM `plat` WHERE id_plat = " . $id_pl . "";
    $re = $pdo->query($Requete_edit_plat);
    $plat = $re->fetchALL(PDO::FETCH_ASSOC);

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
        <form action="#" method="POST" id="ValidationDuFormulairePlat">
            <a href="../produit.php" class="back_btn"> Retour</a>
            <h2>Modifier la table </h2>
            <!-- <label for="id_plat">Identifiant</label> -->
            <input name="id_plat" id="id_plat" type="hidden" value=<?php echo  htmlspecialchars(($plat[0]['id_plat'])) ?>>
            <!-- Le nom du plat -->
            <label for="nom_plat">Nom du plat</label>
            <input name="nom_plat" id="nom_plat" type="text" value="<?php echo  htmlspecialchars(($plat[0]['nom_plat'])) ?>"> <br>
            <!-- La description du plat -->
            <label for="description">Description du plat</label>
            <input name="description" id="description" type="text" value="<?php echo  htmlspecialchars(($plat[0]['description'])) ?>"> <br>
            <!-- Le type de plat -->
            <label for="type_plat">Type de plat</label>
            <input name="type_plat" id="type_plat" type="text" value="<?php echo  htmlspecialchars(($plat[0]['type_plat'])) ?>"> <br>
            <!-- Le prix unitaire du plat -->
            <label for="PU_carte">Prix unitaire</label>
            <input name="PU_carte" id="PU_carte" type="number" value="<?php echo  htmlspecialchars(($plat[0]['PU_carte'])) ?>"> <br>
            <!-- Le bouton d'envoi -->
            <input type="submit" name="Validez" value="Ajouter">

            <?php
            if (isset($_POST['Validez'])) {
                // Variable des éléments
                $id_pl = htmlspecialchars($_POST['id_plat']);
                $nom_pl = htmlspecialchars($_POST['nom_plat']);
                $desc_pl  = htmlspecialchars($_POST['description']);
                $type_pl = htmlspecialchars($_POST['type_plat']);
                $prix_carte = htmlspecialchars($_POST['PU_carte']);
                // Variable de id_menu en GET
                $id_p_get = $_GET['id_pl'];

                $reqUP = "UPDATE plat SET nom_plat='$nom_pl',description='$desc_pl',type_plat='$type_pl' ,PU_carte='$prix_carte' WHERE id_plat ='$id_p_get'";
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
        <script src="/SGRC/js/admin/produit/ajouter_modifier/verification-plat.js"></script>
    </body>

    </html>
<?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: ../../../../index.php");
    exit();
}
?>