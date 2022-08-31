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
  <html lang="fr">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tableau de bord</title>
    <!-- Lien CSS -->
    <link rel="stylesheet" href="/SGRC/css/style_admin/tableau_de_bord/tableau_de_bord.css" />
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
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
          <a href="#" class="active">
            <i class="fa-solid fa-house"></i>
            <h3>Tableau de bord</h3>
          </a>
          <!-- Statistique -->
          <a href="#">
            <i class="fa-solid fa-chart-line"></i>
            <h3>Statistique</h3>
          </a>
          <!-- Les produits -->
          <a href="/SGRC/view/admin/produit/produit.php">
            <i class="fa-solid fa-list-check"></i>
            <h3>Les produits</h3>
          </a>
          <!-- Commande -->
          <a href="/SGRC/view/admin/commande/commande.php">
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
        <h1>Tableau de bord</h1>
        <?php
        // var_dump($_SESSION['id_user'])
        ?>
        <?php
        // Requette pour afficher les mois et les nombre
        $req = mysqli_query($link, "SELECT COUNT(id_commande) AS 'Nombre de commande',date
          FROM commander
          GROUP BY  EXTRACT(MONTH FROM date),EXTRACT(YEAR FROM date)
          HAVING EXTRACT(YEAR FROM date) = EXTRACT(YEAR FROM CURRENT_DATE) AND 
          EXTRACT(MONTH FROM date) = EXTRACT(MONTH FROM CURRENT_TIMESTAMP);");

        // Boucle pour metrtre les données dans 2 tableaux
        foreach ($req as $data) {
          // $month[] = $data['Mois'];
          $commande[] = $data['Nombre de commande'];
        }
        // var_dump($mois);
        // var_dump($numero);
        ?>
        <div class="statistical">
          <!-- tl-commande -->
          <div class="tl-commande">
            <i class="fa-solid fa-magnifying-glass-chart"></i>
            <!-- middle -->
            <div class="middle">
              <div class="left">
                <h3>Total des commande</h3>
                <h1><?php echo $data['Nombre de commande'] ?></h1>
              </div>
              <div class="progress">
                <svg>
                  <circle cx="38" cy="38" r="36"></circle>
                </svg>
                <div class="number">
                  <p>81%</p>
                </div>
                <!-- <i class="fa-brands fa-shopify iii"></i> -->
              </div>
            </div>
            <small class="text-muted">Ce mois-ci</small>
          </div>
          <!------------Fin statistical commande -------->
          <?php
          // Requette pour afficher les mois et les nombre
          $req = mysqli_query($link, "SELECT COUNT(id_user) AS 'Nombre de connecter'
          FROM user
          WHERE STATUS = 'En ligne'");

          // Boucle pour metrtre les données dans 2 tableaux
          foreach ($req as $data) {
            // $month[] = $data['Mois'];
            $nombre[] = $data['Nombre de connecter'];
          }
          // var_dump($mois);
          // 
          ?>
          <!-- tl-connexion -->
          <div class="tl-connexion">
            <i class="fa-solid fa-chart-bar"></i>
            <!-- middle -->
            <div class="middle">
              <div class="left">
                <h3>Total de membres connecter</h3>
                <h1><?php echo $data['Nombre de connecter'] ?></h1>
              </div>
              <div class="progress">
                <svg>
                  <circle cx="38" cy="38" r="36"></circle>
                </svg>
                <div class="number">
                  <p>52%</p>
                </div>
                <!-- <i class="fa-solid fa-circle-user iii"></i> -->
              </div>
            </div>
            <small class="text-muted">En ce moment</small>
          </div>
          <!------------Fin statistical Total de connexion  -------->
          <?php
          // Requette pour afficher les mois et les nombre
          $req = mysqli_query($link, "SELECT COUNT(id_message) AS 'Nombre de message',date
          FROM messages
          GROUP BY  EXTRACT(MONTH FROM date),EXTRACT(YEAR FROM date)
          HAVING EXTRACT(YEAR FROM date) = EXTRACT(YEAR FROM CURRENT_DATE) AND 
          EXTRACT(MONTH FROM date) = EXTRACT(MONTH FROM CURRENT_TIMESTAMP);");

          // Boucle pour metrtre les données dans 2 tableaux
          foreach ($req as $data) {
            // $month[] = $data['Mois'];
            $numero[] = $data['Nombre de message'];
          }
          // var_dump($mois);
          // var_dump($numero);
          ?>
          <!-- tl-message -->
          <div class="tl-message">
            <i class="fa-solid fa-chart-line"></i>
            <!-- middle -->
            <div class="middle">
              <div class="left">
                <h3>Total des messages</h3>
                <h1><?php echo $data['Nombre de message'] ?></h1>
              </div>
              <div class="progress">
                <svg>
                  <circle cx="38" cy="38" r="36"></circle>
                </svg>
                <div class="number">
                  <p>30%</p>
                </div>
                <!-- <i class="fa-solid fa-comment iii"></i> -->
              </div>
            </div>
            <small class="text-muted">Ce mois-ci</small>
          </div>
          <!------------Fin statistical Total de message -------->
        </div>
        <div class="Commande-rencent">
          <h2>Commande récente</h2>
          <table>
            <thead>
              <th>Nom du produit</th>
              <th>Date de commande</th>
              <th>Prix</th>
              <th>Info</th>
            </thead>
            <tbody>
              <!-- Ligne 1 -->
              <tr>
                <td>Salade de fruit</td>
                <td class="success">28/07/2022</td>
                <td>8.99€</td>
                <td><a href="#">Plus</a></td>
              </tr>
              <!-- Ligne 2 -->
              <tr>
                <td>Riz basmatic</td>
                <td class="success">28/07/2022</td>
                <td>5€</td>
                <td><a href="#">Plus</a></td>
              </tr>
              <!-- Ligne 3 -->
              <tr>
                <td>Pate a la bolonaise</td>
                <td class="danger">15/02/2022</td>
                <td>3.52€</td>
                <td><a href="#">Plus</a></td>
              </tr>
              <!-- Ligne 4 -->
              <tr>
                <td>Oeuf</td>
                <td class="danger">05/02/2022</td>
                <td>15€</td>
                <td><a href="#">Plus</a></td>
              </tr>
              <!-- Ligne 5 -->
              <tr>
                <td>Boeuf</td>
                <td class="danger">12/01/2022</td>
                <td>52€</td>
                <td><a href="#">Plus</a></td>
              </tr>
              <!-- Ligne 6 -->
              <tr>
                <td>Coca zero</td>
                <td class="danger">01/01/2022</td>
                <td>10€</td>
                <td><a href="#">Plus</a></td>
              </tr>
            </tbody>
          </table>
          <a href="#">Afficher tout</a>
        </div>
      </main>
      <!-- Fin du  main -->
      <div class="right">
        <div class="top">
          <button id="menu-btn">
            <i class="fa-solid fa-bars"></i>
          </button>
          <!-- Page notification -->
          <?php include "notification.php" ?>
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
    <!-- Script Dark Mode -->
    <script src="/SGRC/js/source/dark_mode.js"></script>
    <!-- Script Menu -->
    <script src="/SGRC/js/source//menu.js"></script>
    <!-- SCRIPT FONT AWESOME -->
    <script src="https://kit.fontawesome.com/438cd94e6c.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
      // Afficher notification restant
      $(document).ready(function() {
        $(".notifications").on("click", function() {
          $.ajax({
            url: "readNotifications.php",
            success: function(res) {
              console.log(res);
            }
          });
        });
      });
      // Recharger la page avce intervale
      setInterval('load_messages()', 20000);

      function load_messages() {
        // Fonction load permet de charger le contenu un fichier a jquery
        $(".notifications").load("notification.php");
      };
    </script>
    <!-- <script src="/SGRC/js/admin/tableau_de_bord/notification.js"></script> -->
  </body>

  </html>
<?php
} else {
  echo ("vous n'avez pas le droit d'être là");
  header("Location:../../../index.php");
  exit();
}
?>