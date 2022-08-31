<?php
session_start();
if ($_SESSION["role"] == "admin") {

    include "../../../../php/connexion.php";

    $id_ppa = $_GET['id_ppa'];
    $Requete_edit_produit_pa = "SELECT * FROM `produit` WHERE id_produit = " . $id_ppa . "";
    $re = $pdo->query($Requete_edit_produit_pa);
    $produit = $re->fetchALL(PDO::FETCH_ASSOC);

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
        <form action="#" method="POST" id="ValidationDuFormulaireProduitPA">
            <a href="../produit.php" class="back_btn"> Retour</a>
            <h2>Modifier la table</h2>
            <!-- <label for="id_produit">Identifiant</label> -->
            <input name="id_produit" id="id_produit" type="hidden" value=<?php echo htmlspecialchars(($produit[0]['id_produit'])) ?>>
            <!-- Le nom du produit -->
            <label for="nom_produit">Nom du produit</label>
            <input name="nom_produit" id="nom_produit" type="text" value="<?php echo htmlspecialchars(($produit[0]['nom_produit'])) ?>"> <br>
            <!-- Le bouton d'envoi -->
            <input type="submit" name="Validez" value="Ajouter">

            <?php
            if (isset($_POST['Validez'])) {
                // Variable des éléments
                $id_ppa = htmlspecialchars($_POST['id_produit']);
                $nom_ppa = htmlspecialchars($_POST['nom_produit']);
                // Variable de id_menu en GET
                $id_ppa_get = $_GET['id_ppa'];

                $reqUP = "UPDATE produit SET nom_produit='$nom_ppa' WHERE id_produit ='$id_ppa_get'";
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
        <script src="/SGRC/js/admin/produit/ajouter_modifier/verification-produit-pa.js"></script>
    </body>

    </html>
<?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location: ../../../../index.php");
    exit();
}
?>