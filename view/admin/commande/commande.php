<?php
session_start();
if ($_SESSION["role"] == "admin") {
    ini_set('display_errors', 'off');  // Bloque les erreur php
    $nom_du_serveur = "localhost";
    $nom_de_la_base = "SGR_MONO";
    $nom_utilisateur = "root";
    $passe = "";

    $link = mysqli_connect($nom_du_serveur, $nom_utilisateur, $passe, $nom_de_la_base);

    $pdo = new PDO("mysql:host=localhost;dbname=SGR_MONO", "root", "");
    $sql = mysqli_query($link, "SELECT * FROM user WHERE id_user = {$_SESSION['id_user']}");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Produit</title>
        <!-- Lien CSS -->
        <link rel="stylesheet" href="/SGRC/css/style_admin/commande/commande.css" />
        <link rel="stylesheet" href="/SGRC/css/style_admin/tableau_de_bord/tableau_de_bord.css">
        <!-- SCRIPT JQUEY -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <?php
    // On écrit la requête
    $sql = "SELECT description, prix, DATE_FORMAT(date, '%d/%m/%Y %H:%i:%S') AS 'date', status FROM commander";

    // On exécute la requête
    $requete = $pdo->query($sql);

    // On récupère les données
    $commandes = $requete->fetchAll();
    ?>

    <body>
        <!-- Conteneur -->
        <div class="container">
            <aside>
                <!-- MENU (logo & titre & bouton fermer) -->
                <div class="top">
                    <div class="logo">
                        <img src="/SGRC/image/img/image_admin/source/logo.png" alt="logo du site" />
                        <h2>La table <span class="primary">d'Hélène</span></h2>
                    </div>
                    <div class="close" id="close-btn">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>
                <div class="sidebar">
                    <!-- Tableau de bord -->
                    <a href="/SGRC/view/admin/tableau_de_bord/tableau_de_bord.php">
                        <i class="fa-solid fa-house"></i>
                        <h3>Tableau de bord</h3>
                    </a>
                    <!-- Statistique -->
                    <a href="#">
                        <i class="fa-solid fa-chart-line"></i>
                        <h3>Statistique</h3>
                    </a>
                    <!-- Produits -->
                    <a href="#">
                        <i class="fa-solid fa-list-check"></i>
                        <h3>Produits</h3>
                    </a>
                    <!-- Commande -->
                    <a href="#" class="active">
                        <i class="fa-solid fa-credit-card"></i>
                        <h3>Commande</h3>
                    </a>
                    <!-- Message -->
                    <a href="../message/users.php">
                        <i class="fa-solid fa-message"></i>
                        <h3>Message</h3>
                        <span class="message-count">26</span>
                    </a>
                    <!-- Utilisateurs -->
                    <a href="../utilisateur/utilisateur.php">
                        <i class="fa-solid fa-user"></i>
                        <h3>Utilisateurs</h3>
                    </a>
                    <!-- Paramétre -->
                    <a href="#">
                        <i class="fa-solid fa-gear"></i>
                        <h3>Paramétre</h3>
                    </a>
                    <!-- Deconnexion-->
                    <a href="/SGRC/php/deconnexion.php?deconnexion=<?php echo $row['id_user'] ?>">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <h3>Deconnexion</h3>
                    </a>
                </div>
            </aside>
            <!-------------Fin ASIDE  ----------------->
            <main>
                <h1>Commandes</h1>
                <?php
                include "../../../include/secu.php";
                ?>
                <div class="Commandes">
                    <!-- Commande -->
                    <table id="table_id" class="display">
                        <caption>Plat</caption>
                        <thead>
                            <tr>
                                <th>Plat</th>
                                <th>Prix</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($commandes as $commande) : ?>
                                <tr>
                                    <td class="description-text"><?php echo $commande['description'] ?></td>
                                    <td><?php echo $commande['prix'] ?></td>
                                    <td><?php echo $commande['date'] ?></td>
                                    <td><?php echo $commande['status'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <script>
                        $(document).ready(function() {
                            $("#table_id").DataTable();
                        });
                    </script>
                    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
                    <script>
                        $("#table_id").DataTable({
                            // "pageLength": 5,
                            "lengthMenu": [5, 10, 25, 50],
                            language: {
                                sProcessing: "Traitement en cours ...",
                                sLengthMenu: "Afficher _MENU_ lignes",
                                sZeroRecords: "Aucun résultat trouvé",
                                sEmptyTable: "Aucune donnée disponible",
                                sInfo: "Lignes _START_ à _END_ sur _TOTAL_",
                                sInfoEmpty: "Aucune ligne affichée",
                                sInfoFiltered: "(Filtrer un maximum de_MAX_)",
                                sInfoPostFix: "",
                                sSearch: "Rechercher:",
                                sUrl: "",
                                sInfoThousands: ",",
                                sLoadingRecords: "Chargement...",
                                oPaginate: {
                                    sFirst: "Premier",
                                    sLast: "Dernier",
                                    sNext: "Suivant",
                                    sPrevious: "Précédent",
                                },
                                oAria: {
                                    sSortAscending: ": Trier par ordre croissant",
                                    sSortDescending: ": Trier par ordre décroissant",
                                },
                            },
                        });
                    </script>

                </div>
                <!-- END Produits -->
            </main>
            <!-- Fin du  main -->
            <?php
            include_once "../../../php/connexion.php";
            $sql = mysqli_query($link, "SELECT * FROM user WHERE id_user = {$_SESSION['id_user']}");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
            }
            ?>
            <div class="right">
                <div class="top">
                    <button id="menu-btn">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <!-- Page notification -->
                    <?php include "../tableau_de_bord/notification.php" ?>
                    <div class="theme-toggler" id="theme-toggler">
                        <!-- Dark and Light -->
                        <i class="fa-solid fa-circle-half-stroke active"></i>
                    </div>
                    <div class="profil">
                        <div class="info">
                            <p>Bonjour, <b>Redouane</b></p>
                            <small class="text-muted">Admin</small>
                        </div>
                        <div class="profil-photot">
                            <img src="../../../php/images/<?php echo $row['image']; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Script Dark Mode -->
        <script src="/SGRC/js/source/dark_mode.js"></script>
        <!-- Script Menu -->
        <script src="/SGRC/js/source/menu.js"></script>
        <!-- SCRIPT FONT AWESOME -->
        <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
    </body>

    </html>


<?php
} else {
    echo ("vous n'avez pas le droit d'être là");
    header("Location:../../../index.php");
    exit();
}
?>