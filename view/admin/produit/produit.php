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
		<link rel="stylesheet" href="/SGRC/css/style_admin/produit/produit.css" />
		<link rel="stylesheet" href="/SGRC/css/style_admin/tableau_de_bord/tableau_de_bord.css">
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
					<a href="#" class="active">
						<i class="fa-solid fa-list-check"></i>
						<h3>Produits</h3>
					</a>
					<!-- Commande -->
					<a href="#">
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
				<h1>Produits</h1>
				<?php
				include "../../../include/secu.php";
				?>
				<div class="Produits">
					<!-- Table -->
					<table class="table-grid">
						<caption>
							Les table
						</caption>
						<thead>
							<tr>
								<th>Numéro</th>
								<th>Type de table</th>
								<th>Action</th>
							</tr>
						</thead>

						<?php
						foreach ($tables as $table) {
						?>
							<tbody>
								<tr>
									<td><?php echo $table['numero_table']; ?></td>
									<td><?php echo $table['type_table']; ?></td>
									<td>
										<!-- Supprimer -->
										<a href="supprimer/table.php?id_t=<?php echo $table['id_table']; ?>" onclick="return confirm ('Êtes-vous sûr de vouloir supprimer ?')"><i class="fa-solid fa-trash-can"></i></a>
										<!-- Modifier -->
										<a href="modifier/table.php?id_t=<?php echo $table['id_table']; ?>"><i class="fa-solid fa-file-pen"></i></a>
									</td>
								</tr>
							</tbody>
						<?php
						}
						?>
						<!-- Ligne ajout -->
						<tr class="add">
							<td colspan="4">
								<a href="/SGRC/view/admin/produit/ajouter/table.php">
									<i class="fa-solid fa-plus"></i>
								</a>
							</td>
						</tr>
					</table>
					<!-- Menu -->
					<table class="table-grid">
						<caption>
							Les menus
						</caption>
						<thead>
							<tr>
								<th>Nom du menu</th>
								<th>Description</th>
								<th>Prix unitaire</th>
								<th>Action</th>
							</tr>
						</thead>

						<?php
						foreach ($menus as $menu) {
						?>
							<tbody>
								<tr>
									<td><?php echo $menu['nom_menu']; ?></td>
									<td class="description-text"><?php echo $menu['description']; ?></td>
									<td><?php echo $menu['PU']; ?></td>
									<td>
										<!-- Supprimer -->
										<a href="supprimer/menu.php?id_m=<?php echo $menu['id_menu']; ?>" onclick="return confirm ('Êtes-vous sûr de vouloir supprimer ?')"><i class="fa-solid fa-trash-can"></i></a>
										<!-- Modifier -->
										<a href="modifier/menu.php?id_m=<?php echo $menu['id_menu']; ?>"><i class="fa-solid fa-file-pen"></i></a>
									</td>
								</tr>
							</tbody>
						<?php
						}
						?>
						<!-- Ligne ajout -->
						<tr class="add">
							<td colspan="4">
								<a href="/SGRC/view/admin/produit/ajouter/menu.php">
									<i class="fa-solid fa-plus"></i>
								</a>
							</td>
						</tr>
					</table>
					<!-- Les plat -->
					<table class="table-grid">
						<caption>
							Les plats
						</caption>
						<thead>
							<tr>
								<th>Nom du plat</th>
								<th>Description</th>
								<th>Type de plat</th>
								<th>Prix à la carte</th>
								<th>Produits associés</th>
								<th>Action</th>
							</tr>
						</thead>

						<?php
						foreach ($plats as $plat) {
						?>
							<tbody>
								<tr>
									<td><?php echo $plat['nom_plat']; ?></td>
									<td class="description-text"><?php echo $plat['description']; ?></td>
									<td><?php echo $plat['type_plat']; ?></td>
									<td><?php echo $plat['PU_carte']; ?></td>
									<!-- Liste deroulante -->
									<td>

										<form action="" method="post">
											<select name="id_produit" id="">

												<?php foreach ($produits as $produit) { ?>

													<option value=<?= $produit['id_produit'] ?>>
														<?php echo $produit['nom_produit'] ?>
													</option>
												<?php } ?>
											</select>
											<i class="fa-solid fa-plus"></i>
										</form>
										<!-- FIN LISTE DEROULANT -->
									</td>
									<td>
										<!-- Supprimer -->
										<a href="supprimer/plat.php?id_pl=<?php echo $plat['id_plat']; ?>" onclick="return confirm ('Êtes-vous sûr de vouloir supprimer ?')"><i class="fa-solid fa-trash-can"></i></a>
										<!-- Modifier -->
										<a href="modifier/plat.php?id_pl=<?php echo $plat['id_plat']; ?>"><i class="fa-solid fa-file-pen"></i></a>
									</td>
								</tr>

							</tbody>
						<?php
						}
						?>
						<!-- Ligne ajout -->
						<tr class="add">
							<td colspan="6">
								<a href="/SGRC/view/admin/produit/ajouter/plat.php">
									<i class="fa-solid fa-plus"></i>
								</a>
							</td>
						</tr>
					</table>
					<!-- Les boissons -->
					<table class="table-grid">
						<caption>
							Les boissons
						</caption>
						<thead>
							<tr>
								<th>Nom du menu</th>
								<th>Description</th>
								<th>Prix</th>
								<th>Action</th>
							</tr>
						</thead>

						<?php
						foreach ($boissons as $boisson) {
						?>
							<tbody>
								<tr>
									<td><?php echo $boisson['nom_boisson']; ?></td>
									<td class="description-text"><?php echo $boisson['description']; ?></td>
									<td><?php echo $boisson['PU']; ?></td>
									<td>
										<!-- Supprimer -->
										<a href="supprimer/boisson.php?id_b=<?php echo $boisson['id']; ?>" onclick="return confirm ('Êtes-vous sûr de vouloir supprimer ?')"><i class="fa-solid fa-trash-can"></i></a>
										<!-- Modifier -->
										<a href="modifier/boisson.php?id_b=<?php echo $boisson['id']; ?>"><i class="fa-solid fa-file-pen"></i></a>
									</td>
								</tr>

							</tbody>
						<?php
						}
						?>
						<!-- Ligne ajout -->
						<tr class="add">
							<td colspan="4">
								<a href="/SGRC/view/admin/produit/ajouter/boisson.php">
									<i class="fa-solid fa-plus"></i>
								</a>
							</td>
						</tr>
					</table>
					<!-- Produit allergene -->
					<table class="table-grid">
						<caption>
							Les produits potentiellement allergènes
						</caption>
						<thead>
							<tr>
								<th>Nom du produit</th>
								<th>Action</th>
							</tr>
						</thead>

						<?php
						foreach ($produits as $produit) {
						?>
							<tbody>
								<tr>
									<td><?php echo $produit['nom_produit']; ?></td>
									<td>
										<a href="supprimer/produit-ppa.php?id_ppa=<?php echo $produit['id_produit']; ?>" onclick="return confirm ('Êtes-vous sûr de vouloir supprimer ?')"><i class="fa-solid fa-trash-can"></i></a>
										<a href="modifier/produit-ppa.php?id_ppa=<?php echo $produit['id_produit']; ?>"><i class="fa-solid fa-file-pen"></i></a>
									</td>

								</tr>

								</tr>
							</tbody>
						<?php
						}
						?>
						<!-- Ligne ajout -->
						<tr class="add">
							<td colspan="2">
								<a href="/SGRC/view/admin/produit/ajouter/produit-ppa.php">
									<i class="fa-solid fa-plus"></i>
								</a>
							</td>
						</tr>
					</table>

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