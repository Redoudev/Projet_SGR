<?php
session_start();
if ($_SESSION["role"] == "admin") {

    include "../../../../php/connexion.php";

    $id_m = $_GET['id_m'];
    $Requete_edit_menu = "SELECT * FROM `menu` WHERE id_menu = " . $id_m . "";
    $re = $pdo->query($Requete_edit_menu);
    $menu = $re->fetchALL(PDO::FETCH_ASSOC);

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
                <i class="fa-solid fa-circle-half-stroke"></i>
            </div>
        </div>
        <form action="#" method="POST" id="ValidationDuFormulaireMenu">
            <a href="../produit.php" class="back_btn"> Retour</a>
            <h2>Modifier la table </h2>
            <!-- <label for="id_menu">Identifiant</label> -->
            <input name="id_menu" id="id_menu" type="hidden" value=<?php echo  htmlspecialchars(($menu[0]['id_menu'])) ?>>
            <!-- Le nom du menu -->
            <label for="nom_menu">Nom du menu</label>
            <input name="nom_menu" id="nom_menu" type="text" value="<?php echo htmlspecialchars(($menu[0]['nom_menu'])) ?>"> <br>
            <!-- La description du menu -->
            <label for="description">Description du menu</label>
            <input name="description" id="description" type="text" value="<?php echo htmlspecialchars(($menu[0]['description'])) ?>"> <br>
            <!-- Le prix unitaire du menu -->
            <label for="prix_unitaire">Prix unitaire</label>
            <input name="PU" id="prix_unitaire" type="number" value="<?php echo htmlspecialchars(($menu[0]['PU'])) ?>"> <br>
            <!-- Le bouton d'envoi -->
            <input type="submit" name="Validez" value="Modifier">

            <?php
            if (isset($_POST['Validez'])) {
                // Variable des éléments
                $id_m = htmlspecialchars($_POST['id_menu']);
                $nom_m = htmlspecialchars($_POST['nom_menu']);
                $desc_m  = htmlspecialchars($_POST['description']);
                $prix_u = htmlspecialchars($_POST['PU']);
                // Variable de id_menu en GET
                $id_m_get = $_GET['id_m'];

                $reqUP = "UPDATE menu SET nom_menu='$nom_m',description='$desc_m',PU='$prix_u' WHERE id_menu ='$id_m_get'";
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
        <script src="/SGRC/js/admin/produit/ajouter_modifier/verification-menu.js"></script>
    </body>

    </html>
<?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: ../../../../index.php");
    exit();
}
?>