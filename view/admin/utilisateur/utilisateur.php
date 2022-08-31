<?php
session_start()
?>
<?php
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
    <html lang="fr">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Tableau de bord</title>
        <!-- Lien CSS -->
        <link rel="stylesheet" href="/SGRC/css/style_admin/utilisateur/utilisateur.css" />
        <link rel="stylesheet" href="../../../css/style_admin/tableau_de_bord//tableau_de_bord.css">
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
                    <a href="/SGRC/view/admin/message/users.php">
                        <i class="fa-solid fa-message"></i>
                        <h3>Message</h3>
                        <span class="message-count">26</span>
                    </a>
                    <!-- Utilisateurs -->
                    <a href="#" class="active">
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
                <h1>Les utilisateur</h1>
                <?php
                include "../../../include/secu.php";
                ?>


                <div class="Utilisateur">
                    <!-- Table -->
                    <table class="table-grid">
                        <caption>
                            Les utilisateur
                        </caption>
                        <thead>
                            <tr>
                                <th>Login</th>
                                <th>Rôle</th>
                                <th>Mot de passe</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <?php
                        foreach ($users as $user) {
                        ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $user['login']; ?></td>
                                    <td><?php echo $user['role']; ?></td>
                                    <td><?php echo $user['mdp']; ?></td>
                                    <td>
                                        <!-- Supprimer -->
                                        <a href="../utilisateur/supprimer.php?id_u=<?php echo $user['id_user']; ?>" onclick="return confirm ('Êtes-vous sûr de vouloir supprimer ?')"><i class="fa-solid fa-trash-can"></i></a>
                                        <!-- Modifier -->
                                        <a href="../utilisateur/modifier.php?id_u=<?php echo $user['id_user']; ?>"><i class="fa-solid fa-file-pen"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        <?php
                        }
                        ?>
                        <!-- Ligne ajout -->
                        <tr class="add">
                            <td colspan="4">
                                <a href="/SGRC/view/admin/utilisateur/ajouter.php">
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
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
                    <!-- Notification -->
                    <div class="notifications">
                        <!-- Icone -->
                        <ul>
                            <li>
                                <?php
                                $sql = "SELECT *, DATE_FORMAT(date, '%d/%m/%Y %H:%i:%S') AS 'date' FROM messages
                INNER JOIN user ON messages.id_expediteur = user.id_user
                WHERE id_destinataire = {$_SESSION['id_user']} 
                ORDER BY id_message DESC LIMIT 3 ;";
                                $res = mysqli_query($link, $sql);
                                ?>
                                <?php
                                $sql_get = mysqli_query($link, "SELECT * FROM messages WHERE lu=0 AND id_destinataire = {$_SESSION['id_user']} ");
                                $count = mysqli_num_rows($sql_get);
                                ?>
                                <a href="#">
                                    <label for="check"><i class="fa-solid fa-bell"></i>
                                        <span class="count"><?php echo $count ?> </span>
                                    </label>
                                </a>
                                <input type="checkbox" class="dropdown-check" id="check">
                                <ul class="dropdown">
                                    <?php

                                    if (mysqli_num_rows($res) > 0) {
                                        foreach ($res as $message) {
                                    ?>
                                            <!-- A remetre -->
                                            <div class="notify_item">
                                                <li>
                                                    <div class="notify_img">
                                                        <a href="/SGRC/view/admin/message/chat.php?id_user=<?php echo $message['id_user']; ?>" target="_blank">
                                                            <img src="../../../php/images/<?php echo $message['image']; ?>" alt="">
                                                    </div>
                                                    <div class="notify_info">
                                                        <p><?php echo $message['login']; ?> vous a envoyé :</p>
                                                        <p> <?php echo $message['message']; ?></p>
                                                        <span class="notify_time">Le <?php echo $message['date']; ?></span>
                                                    </div>
                                                    </a>
                                                </li>
                                            </div>
                                    <?php }
                                    } else {
                                        echo '<li><a href="#" class="text-bold text-italic">Aucune notification trouvée</a></li>';
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
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

        <!-- SCRIPT FONT AWESOME -->
        <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
        <script src="/SGRC/js/source//menu.js"></script>
        <script src="/SGRC/js/source/dark_mode.js"></script>
    </body>

    </html>
<?php
} else {
    echo ("vous n'avez pas le droit d'être là");
}
?>