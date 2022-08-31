<?php
session_start();
ini_set('display_errors', 'off');  // Bloque les erreur php
if (!isset($_SESSION['id_user'])) {
    header("location: ../../../index.php");
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
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tableau de bord</title>
    <!-- Lien CSS -->
    <link rel="stylesheet" href="/SGRC/css/style_admin/utilisateur/utilisateur.css" />
    <link rel="stylesheet" href="/SGRC/css/style_admin/message/users.css" />
    <link rel="stylesheet" href="../../../css/style_admin/tableau_de_bord/tableau_de_bord.css">
</head>

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
                <a href="/SGRC/view/admin/produit/produit.php">
                    <i class="fa-solid fa-list-check"></i>
                    <h3>Produits</h3>
                </a>
                <!-- Commande -->
                <a href="#">
                    <i class="fa-solid fa-credit-card"></i>
                    <h3>Commande</h3>
                </a>
                <!-- Message -->
                <a href="/SGRC/view/admin/message/message.php " class="active">
                    <i class="fa-solid fa-message"></i>
                    <h3>Message</h3>
                    <span class="message-count">26</span>
                </a>
                <!-- Utilisateurs -->
                <a href="/SGRC/view/admin/utilisateur/utilisateur.php">
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
            <h1>Messagerie</h1>
            <?php
            include "../../../include/secu.php";
            ?>
            <!-- User-chat -->
            <div class="User-chat">
                <div class="wrapper">
                    <!-- La section titre formuliare -->
                    <section class="user">
                        <header>
                            <?php
                            include_once "../../../php/connexion.php";
                            $sql = mysqli_query($link, "SELECT * FROM user WHERE id_user = {$_SESSION['id_user']}");
                            if (mysqli_num_rows($sql) > 0) {
                                $row = mysqli_fetch_assoc($sql);
                            }
                            ?>
                            <div class="content">
                                <img src="../../../php/images/<?php echo $row['image']; ?>" alt="">
                                <div class="details">
                                    <span><?php echo $row['login'] ?></span>
                                    <p><?php echo $row['status']; ?></p>
                                </div>
                            </div>
                        </header>
                        <div class="search">
                            <span class="text">Sélectionnez un utilisateur</span>
                            <input type="text" placeholder="Entrer un utilisateur" />
                            <button><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                        <div class="user-list">
                        </div>
                    </section>
                </div>
            </div>
            <!-- Fin User-chat -->
        </main>
        <!-- Fin du  main -->
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <i class="fa-solid fa-bars"></i>
                </button>
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
                        <!-- <img src="/SGRC/image/img/image_admin/source/profil.jpg" alt="Profil" /> -->
                        <img src="../../../php/images/<?php echo $row['image']; ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT FONT AWESOME -->
    <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
    <script src="/SGRC/js/source/menu.js"></script>
    <script src="/SGRC/js/source/dark_mode.js"></script>
    <!-- sCRIPT USER MESSAGE -->
    <script src="/SGRC/js/admin//message/users.js"></script>
</body>

</html>