<?php
session_start();
if (isset($_SESSION["role"])) {
	$pdo = new PDO("mysql:host=localhost;dbname=SGR_MONO", "root", "");
	switch ($_SESSION["role"]) {
		case "admin": {

				//login ok et admin
				if (isset($_POST) && isset($_POST['action'])) {

					//on est connecté en admin mais on viens d'un formulaire
					switch ($_POST['action']) {
						case "ajouter table": {
								//recuperer les données du formulaire 
								$no_table = $_POST["num_table"];
								$type_t = $_POST["type"];
								// sefinir ma requete a executer
								$statmt = $pdo->prepare('INSERT INTO `sgr_table` (`id_table`, `numero_table`,`type_table`) VALUES (null,' . $no_table . ',"' . $type_t . '")');
								//executer la requete
								$statmt->execute();
								break;
							}
						case "suppr table": {
								$id_t = $_POST["id_table"];
								$statmt = $pdo->prepare('delete from sgr_table where `id_table`=' . $id_t . ';');
								$statmt->execute();
								break;
							}
						case "modif table": {
								$id_t = $_POST["id_table"];
								break;
							}
						case "ajout produit": {
								$nom_p = $_POST["nom_produit"];
								$statmt = $pdo->prepare('INSERT INTO `produit` (`id_produit`, `nom_produit`) VALUES (null,"' . $nom_p . '")');
								$statmt->execute();
								break;
							}
							// Clé etranger
						case "suppr produit": {
								$id_p = $_POST["id_produit"];
								$statmt = $pdo->prepare('delete from contenir_plat_produit where `id_produit`=' . $id_p . ';');
								$statmt->execute();
								$statmt = $pdo->prepare('delete from produit where `id_produit`=' . $id_p . ';');
								$statmt->execute();
								break;
							}
						case "modif produit": {
								$id_p = $_POST["id_produit"];
								break;
							}
						case "ajout boisson": {
								$nom_b = $_POST["nom_boisson"];
								$desc = $_POST["description"];
								$pu = $_POST["PU"];
								$statmt = $pdo->prepare('INSERT INTO `boisson` (`id`, `nom_boisson`,`description`,`PU` ) VALUES (null,"' . $nom_b . '","' . $desc . '",' . $pu . ')');
								$statmt->execute();

								break;
							}
						case "suppr boisson": {
								$id_b = $_POST["id_boisson"];
								//echo 'delete from `boisson` where `id`='.$id_b.';';
								$statmt = $pdo->prepare('delete from `boisson` where `id`=' . $id_b . ';');
								$statmt->execute();
								break;
							}
						case "modif boison": {
								$id_b = $_POST["id_boisson"];
								break;
							}
						case "ajout prod boisson": {
								$id_p = $_POST["id_produit"];
								$id_b = $_POST["id_boisson"];
								//echo 'insert into contenir_boisson_produit (`id_produit`,`id_boisson`) values ('.$id_p.','.$id_b.');';
								$statmt = $pdo->prepare('insert into contenir_boisson_produit (`id_produit`,`id_boisson`) values (' . $id_p . ',' . $id_b . ');');
								$statmt->execute();
								break;
							}
						case "ajouter plat menu": {
								$idm = $_POST["id_menu"];
								$idp = $_POST["id_plat"];
								//echo ("INSERT INTO `contenir_menu_plat` (`id_plat`, `id_menu`) VALUES ('".$idp."', '".$idm."');");
								$statmt = $pdo->prepare("INSERT INTO `contenir_menu_plat` (`id_plat`, `id_menu`) VALUES ('" . $idp . "', '" . $idm . "');");
								$statmt->execute();
								break;
							}
						case "ajout plat": {
								$np = $_POST["nom_plat"];
								$desc = $_POST["description"];
								$puc = $_POST["PU_carte"];
								$tp = $_POST["type_plat"];
								//echo 
								$statmt = $pdo->prepare("INSERT INTO `plat` (`id_plat`, `nom_plat`, `description`, `type_plat`, `PU_carte`) VALUES (NULL, '" . $np . "', '" . $desc . "', '" . $tp . "', '" . $puc . "');");
								$statmt->execute();
								break;
							}
                            //    Modification pour suppression cause: clé étranger qui bloque la suppresion
							case "suppr plat": {
								$idp = $_POST["id_plat"];
								$statmt = $pdo->prepare('delete from contenir_menu_plat where `id_plat`=' . $idp . ';');
								$statmt->execute();
								$statmt = $pdo->prepare('delete from plat where `id_plat`=' . $idp . ';');
								$statmt->execute();
								break;
							}
						case "suppr prod boisson": {
								$id_p = $_POST["id_produit"];
								$id_b = $_POST["id_boisson"];
								$statmt = $pdo->prepare('delete from contenir_boisson_produit where `id_produit`=' . $id_p . ' and `id_boisson`=' . $id_b . ';');
								$statmt->execute();
								break;
							}
						case "ajout menu": {
								$nm = $_POST["nom_menu"];
								$dm = $_POST["description"];
								$Pm = $_POST["PU"];
								$statmt = $pdo->prepare("INSERT INTO `menu` (`id_menu`, `nom_menu`, `PU`, `description`, `date_menu`) VALUES (NULL, '" . $nm . "', '" . $Pm . "', '" . $dm . "', NULL);");
								$statmt->execute();
								break;
							}
							// Clé etranger
						case "suppr menu": {
								$idm = $_POST["id_menu"];
								$statmt = $pdo->prepare('delete from contenir_menu_plat where `id_menu`=' . $idm . ';');
								$statmt->execute();
								$statmt = $pdo->prepare('delete from menu where `id_menu`=' . $idm . ';');
								$statmt->execute();
								break;
							}

							case "suppr user": {
								$idm = $_POST["id_user"];
								$statmt = $pdo->prepare('delete from user where `id_user`=' . $idm . ';');
								$statmt->execute();
								break;
							}
						case "ajout user": {
								$lg = $_POST["login"];
								$rl = $_POST["role"];
								$mdp = $_POST["mdp"];
								$statmt = $pdo->prepare("INSERT INTO `user` (`id_user`, `login`,`role`, `mdp`) VALUES ('', '" . $lg . "', '" . $rl . "', '" . $mdp . "');");
								$statmt->execute();
								break;
							}
						default: {
								echo "erreur d'action: " . $_POST["action"];
							}
					}
				}

				// include("include/entete2.php");   A supprimer

				//recup de la liste des tables
				$statmt = $pdo->prepare('SELECT * FROM sgr_table order by `numero_table`');
				$statmt->execute();
				$tables = $statmt->fetchAll(PDO::FETCH_ASSOC);
				//recup de la liste des produits
				$statmt2 = $pdo->prepare('SELECT * FROM produit');
				$statmt2->execute();
				$produits = $statmt2->fetchAll(PDO::FETCH_ASSOC);
				//recup de la liste des boissons
				$statmt3 = $pdo->prepare('SELECT * FROM boisson');
				$statmt3->execute();
				$boissons = $statmt3->fetchAll(PDO::FETCH_ASSOC);
				//recup de la liste des produits contenus par les boissons
				$statmt4 = $pdo->prepare('SELECT * FROM contenir_boisson_produit C inner join produit P on C.id_produit=P.id_produit');
				$statmt4->execute();
				$prod_boisson = $statmt4->fetchAll(PDO::FETCH_ASSOC);
				//recup de la liste des plats
				$statmt5 = $pdo->prepare('SELECT * FROM plat');
				$statmt5->execute();
				$plats = $statmt5->fetchAll(PDO::FETCH_ASSOC);
				//recup de la liste des produits contenus par les plats
				$statmt6 = $pdo->prepare('SELECT * FROM contenir_plat_produit C inner join produit P on C.id_produit=P.id_produit');
				$statmt6->execute();
				$prod_plats = $statmt6->fetchAll(PDO::FETCH_ASSOC);
				//recup de la liste des menus
				$statmt7 = $pdo->prepare('SELECT * FROM menu');
				$statmt7->execute();
				$menus = $statmt7->fetchAll(PDO::FETCH_ASSOC);
				//recup de la liste desplats des menus
				$statmt8 = $pdo->prepare('SELECT M.id_menu AS id_menu, M.nom_menu AS nom_menu,P.nom_plat AS nom_plat,P.type_plat AS type_plat FROM contenir_menu_plat CMP, menu M, plat P WHERE CMP.id_plat=P.id_plat AND M.id_menu=CMP.id_menu ORDER BY id_menu');
				$statmt8->execute();
				$menuplats = $statmt8->fetchAll(PDO::FETCH_ASSOC);
				//recup de la liste des utilisateurs
				$statmt8 = $pdo->prepare('SELECT * FROM user');
				$statmt8->execute();
				$users = $statmt8->fetchAll(PDO::FETCH_ASSOC);


                // Page de administration
				include("view/admin/tableau_de_bord/tableau_de_bord.php"); // lien modifier
				// include("include/enpied2.php");   A supprimer
				break;
			}
		case "cuisine": {
				//login ok et cuisine
				include("include/entete2.php");

				//recuperation des bons et preparation des données utiles à la vue


				include("view/cuisine.php");
				include("include/enpied2.php");
				break;
			}
		case "bar": {
				//login ok et bar
				include("include/entete2.php");

				//recuperation des bons et preparation des données utiles à la vue
				include("view/bar.php");
				include("include/enpied2.php");
				break;
			}
		case "service": {
				//login ok et sevice
				//if(!isset($_SESSION["id_table"])){$_SESSION["id_table"]=-1;}
				if (isset($_POST) && isset($_POST['action'])) {
					switch ($_POST['action']) {
						case "prendre table": {
								$ids = $_POST["id_serveur"];
								$idt = $_POST["id_table"];
								//echo ('UPDATE sgr_table set id_serveur = '.$ids.' where id_table = '.$idt);
								$statmt4 = $pdo->prepare('UPDATE sgr_table set id_serveur = ' . $ids . ' where id_table = ' . $idt);
								$statmt4->execute();
								break;
							}
						case "modif etat c_b_i": {
								$id_cbi = $_POST["id_commande"];
								$etat = $_POST["etat"];
								//echo ('UPDATE commander_boisson_indiv set etat = "'.$etat.'" where id_commande = '.$id_cbi);
								$statmt4 = $pdo->prepare('UPDATE commander_boisson_indiv set etat = "' . $etat . '" where id_commande = ' . $id_cbi);
								$statmt4->execute();
								break;
							}
						case "modif etat c_b_t": {
								$id_cbt = $_POST["id_commande"];
								$etat = $_POST["etat"];
								//echo ('UPDATE commander_boisson_table set etat = "'.$etat.'" where id_commande = '.$id_cbt);
								$statmt4 = $pdo->prepare('UPDATE commander_boisson_table set etat = "' . $etat . '" where id_commande = ' . $id_cbt);
								$statmt4->execute();
								break;
							}
						case "gestion table": {
								//pour afficher le detail d'une table ou revenir au résumé
								if ($_POST["id_table"] != "-1") {
									$_SESSION["id_table"] = $_POST["id_table"];
								} else {
									unset($_SESSION["id_table"]);
									unset($_SESSION["id_resa"]);
								}
								break;
							}
						case "choix resa": {
								$_SESSION["id_resa"] = $_POST["id_resa"];
								break;
							}
						case "modif type chaise": {
								$idc = $_POST["id_chaise"];
								$idtc = $_POST["id_type_chaise"];
								//echo ('UPDATE chaise set id_type_chaise = '.$idtc.' where id_chaise = '.$idc);
								$statmt7 = $pdo->prepare('UPDATE chaise set id_type_chaise = ' . $idtc . ' where id_chaise = ' . $idc);
								$statmt7->execute();
								break;
							}
						case "ajouter chaise resa": {
								$idr = $_POST["id_resa"];
								$statmt6 = $pdo->prepare("INSERT INTO `chaise` (`id_chaise`, `id_resa`, `id_type_chaise`, `emplacement`, `comentaire`) VALUES (NULL, '" . $idr . "', NULL, NULL, NULL);");
								$statmt6->execute();
								break;
							}
						case "commander menu": {
								$idc = $_POST["id_chaise"];
								$idm = $_POST["id_menu"];
								//echo ("INSERT INTO `commander_menu` (`id_commande`, `id_chaise`, `id_menu`, `quand`) VALUES (NULL, '".$idc."', '".$idm."', '".date("Y-m-d H:i:s")."');");
								$statmt8 = $pdo->prepare("INSERT INTO `commander_menu` (`id_commande`, `id_chaise`, `id_menu`, `quand`) VALUES (NULL, '" . $idc . "', '" . $idm . "', '" . date("Y-m-d H:i:s") . "');");
								$statmt8->execute();
								break;
							}
						case "commander boisson table": {
								$idr = $_POST["id_resa"];
								$idb = $_POST["id_boisson"];

								//echo ("INSERT INTO `commander_boisson_table` (`id_commande`, `id_resa`, `id_boisson`, `quand`) VALUES (NULL, '".$idr."', '".$idb."', '".date("Y-m-d H:i:s")."');");
								$statmt11 = $pdo->prepare("INSERT INTO `commander_boisson_table` (`id_commande`, `id_resa`, `id_boisson`, `quand`) VALUES (NULL, '" . $idr . "', '" . $idb . "', '" . date("Y-m-d H:i:s") . "');");
								$statmt11->execute();

								break;
							}
						case "commander boisson chaise": {
								$idc = $_POST["id_chaise"];
								$idb = $_POST["id_boisson"];

								//echo("INSERT INTO `commander_boisson_indiv` (`id_commande`, `id_chaise`, `id_boisson`, `quand`) VALUES (NULL, '".$idc."', '".$idb."', '".date("Y-m-d H:i:s")."');");
								$statmt12 = $pdo->prepare("INSERT INTO `commander_boisson_indiv` (`id_commande`, `id_chaise`, `id_boisson`, `quand`) VALUES (NULL, '" . $idc . "', '" . $idb . "', '" . date("Y-m-d H:i:s") . "');");
								$statmt12->execute();

								break;
							}
						case "commander plat": {
								$idc = $_POST["id_chaise"];
								$idp = $_POST["id_plat"];

								//echo("INSERT INTO `commander_plat` (`id_commande`, `id_chaise`, `id_plat`, `quand`) VALUES (NULL, '".$idc."', '".$idp."', '".date("Y-m-d H:i:s")."');");
								$statmt12 = $pdo->prepare("INSERT INTO `commander_plat` (`id_commande`, `id_chaise`, `id_plat`, `quand`) VALUES (NULL, '" . $idc . "', '" . $idp . "', '" . date("Y-m-d H:i:s") . "');");
								$statmt12->execute();

								break;
							}
						case "retirer menu": {
								$idcom = $_POST["id_commande"];
								//echo ("DELETE FROM `commander_menu` WHERE `id_commande`='".$idcom."';");
								$statmt8 = $pdo->prepare("DELETE FROM `commander_menu` WHERE `id_commande`='" . $idcom . "';");
								$statmt8->execute();
								break;
							}

						default: {
								echo "erreur d'action";
							}
					}
				}

				if (!isset($_SESSION["id_resa"])) {
					//on a pas encore de reservation choisie
					$_SESSION["id_resa"] = -1;
					if (isset($_SESSION['table_resa'])) {
						unset($_SESSION['table_resa']);
					}
					if (isset($chaises)) {
						unset($chaises);
					}
				} else {
					//on a une reservation choisie
					//echo 'SELECT * FROM reservation where id_resa='.$_SESSION["id_resa"].';';
					$statmt2 = $pdo->prepare('SELECT * FROM reservation where id_resa=' . $_SESSION["id_resa"] . ';');
					$statmt2->execute();
					$resa = $statmt2->fetch(PDO::FETCH_ASSOC);
					$_SESSION['table_resa'] = $resa['id_table'];

					$statmt3 = $pdo->prepare('SELECT * FROM chaise where id_resa=' . $_SESSION["id_resa"] . ';');
					$statmt3->execute();
					$chaises = $statmt3->fetchAll(PDO::FETCH_ASSOC);

					$statmt9 = $pdo->prepare('SELECT * FROM menu');
					$statmt9->execute();
					$menus = $statmt9->fetchAll(PDO::FETCH_ASSOC);

					$statmt10 = $pdo->prepare('SELECT * FROM `commander_menu` cm, chaise c, menu m where cm.id_chaise=c.id_chaise and m.id_menu=cm.id_menu and c.id_resa=' . $_SESSION["id_resa"]);
					$statmt10->execute();
					$commande_menu = $statmt10->fetchAll(PDO::FETCH_ASSOC);

					$statmt11 = $pdo->prepare('SELECT * FROM `commander_boisson_table` cbt, `boisson` b where cbt.`id_boisson`=b.`id` and cbt.`id_resa`=' . $_SESSION["id_resa"]);
					$statmt11->execute();
					$commande_boisson_table = $statmt11->fetchAll(PDO::FETCH_ASSOC);

					$statmt12 = $pdo->prepare('SELECT * FROM `commander_boisson_indiv` cbi, `boisson` b, chaise c where cbi.`id_boisson`=b.`id` and cbi.id_chaise=c.id_chaise and c.`id_resa`=' . $_SESSION["id_resa"]);
					$statmt12->execute();
					$commande_boisson_indiv = $statmt12->fetchAll(PDO::FETCH_ASSOC);

					$statmt13 = $pdo->prepare('SELECT * FROM boisson');
					$statmt13->execute();
					$boissons = $statmt13->fetchAll(PDO::FETCH_ASSOC);

					$statmt15 = $pdo->prepare('SELECT * FROM menu m, `contenir_menu_plat` cmp, plat p where m.id_menu=cmp.id_menu and cmp.id_plat=p.id_plat');
					$statmt15->execute();
					$contenu_menus = $statmt15->fetchAll(PDO::FETCH_ASSOC);

					$statmt16 = $pdo->prepare('SELECT * FROM chaise c, `commander_plat` cp, plat p where cp.id_chaise=c.id_chaise and cp.id_plat=p.id_plat order by c.id_chaise, quand');
					$statmt16->execute();
					$commande_Plats = $statmt16->fetchAll(PDO::FETCH_ASSOC);
				}

				//echo ('SELECT * FROM sgr_table left join user on user.id_user=sgr_table.id_serveur left join reservation r on sgr_table.id_table = r.id_table where r.etat_resa = "place" or r.id_table is null order by `numero_table`');
				$statmt = $pdo->prepare('SELECT *,sgr_table.id_table as idtable FROM sgr_table left join user on user.id_user=sgr_table.id_serveur left join reservation r on sgr_table.id_table = r.id_table where r.etat_resa = "place" or r.id_table is null order by `numero_table`');
				$statmt->execute();
				$tables = $statmt->fetchAll(PDO::FETCH_ASSOC);

				/*$statmt = $pdo->prepare('SELECT r.*,t.*,t.`numero_table` as table_resa FROM reservation r LEFT JOIN sgr_table t on r.`id_table`=t.`id_table` order by r.`nom_resa`');
			$statmt->execute();
			$resa_du_jour = $statmt->fetchAll(PDO::FETCH_ASSOC);*/

				if (isset($_SESSION["id_table"]) && $_SESSION["id_table"] != -1) {
					$statmt = $pdo->prepare('SELECT * FROM reservation r,sgr_table t where r.etat_resa not like "annul" and r.id_table=t.id_table and r.`id_table` = ' . $_SESSION["id_table"] . ' order by r.arrivee;');
				} else {
					$statmt = $pdo->prepare('SELECT * FROM reservation r LEFT JOIN sgr_table t on r.`id_table`=t.`id_table` order by t.`numero_table`');
				}
				$statmt->execute();
				$resas = $statmt->fetchAll(PDO::FETCH_ASSOC);

				//echo ("SELECT * FROM sgr_table t where t.`id_serveur`= ".$_SESSION["id_user"]." order by `numero_table`");
				$statmt = $pdo->prepare("SELECT * FROM sgr_table t where t.`id_serveur`= " . $_SESSION["id_user"] . " order by `numero_table`");
				$statmt->execute();
				$mes_tables = $statmt->fetchAll(PDO::FETCH_ASSOC);

				include("include/entete2.php");
				include("view/service.php");
				include("include/enpied2.php");
				break;
			}
		case "rang": {
				//login ok et sevice
				//if(!isset($_SESSION["id_table"])){$_SESSION["id_table"]=-1;}
				if (isset($_POST) && isset($_POST['action'])) {
					switch ($_POST['action']) {

						case "gestion table": {
								if ($_POST["id_table"] != "-1") {
									$_SESSION["id_table"] = $_POST["id_table"];
								} else {
									unset($_SESSION["id_table"]);
								}
								break;
							}
						case "affect table resa": {
								$idr = $_POST["id_resa"];
								$idt = $_POST["id_table"];
								//echo 'UPDATE reservation set id_table = '.$idt.' where id_resa = '.$idr;
								$statmt4 = $pdo->prepare('UPDATE reservation set id_table = ' . $idt . ' where id_resa = ' . $idr);
								$statmt4->execute();
								break;
							}
						case "arriver resa": {
								$idr = $_POST["id_resa"];
								//echo ('UPDATE reservation set etat_resa = "arriv" where id_resa = '.$idr);
								$statmt4 = $pdo->prepare('UPDATE reservation set etat_resa = "arriv" where id_resa = ' . $idr);
								$statmt4->execute();
								break;
							}
						case "placer resa": {
								$idr = $_POST["id_resa"];
								//echo ('UPDATE reservation set etat_resa = "place" where id_resa = '.$idr);
								$statmt4 = $pdo->prepare('UPDATE reservation set etat_resa = "place" where id_resa = ' . $idr);
								$statmt4->execute();
								break;
							}
						case "annuler resa": {
								$idr = $_POST["id_resa"];
								//echo ('UPDATE reservation set etat_resa = "annul" where id_resa = '.$idr);
								$statmt4 = $pdo->prepare('UPDATE reservation set etat_resa = "annul" where id_resa = ' . $idr);
								$statmt4->execute();
								break;
							}

						case "ajouter resa": {
								$nr = $_POST["nom_resa"];
								$nb_p = $_POST["nb_resa"];
								$heure_arrivee = $_POST["heure_resa"];
								$minute_arrivee = $_POST["minute_resa"];
								//echo("INSERT INTO `reservation` (`id_resa`, `nom_resa`, `nb_pers`,`arrivee`) VALUES (NULL, '".$nr."', '".$nb_p."');");
								$statmt5 = $pdo->prepare("INSERT INTO `reservation` (`id_resa`, `nom_resa`, `nb_pers`,`arrivee`) VALUES (NULL, '" . $nr . "', '" . $nb_p . "', '" . date("Y-m-d ") . $heure_arrivee . ":" . $minute_arrivee . ":00');");
								$statmt5->execute();
								break;
							}
						default: {
								echo "erreur d'action";
							}
					}
				}

				//echo ('SELECT * FROM sgr_table left join user on user.id_user=sgr_table.id_serveur left join reservation r on sgr_table.id_table = r.id_table where r.etat_resa = "place" or r.id_table is null order by `numero_table`');
				$statmt = $pdo->prepare('SELECT *,sgr_table.id_table as idtable FROM sgr_table left join user on user.id_user=sgr_table.id_serveur left join reservation r on sgr_table.id_table = r.id_table where r.etat_resa = "place" or r.id_table is null  order by `numero_table`');
				$statmt->execute();
				$tables = $statmt->fetchAll(PDO::FETCH_ASSOC);

				$statmt = $pdo->prepare('SELECT r.*,t.*,t.`numero_table` as table_resa FROM reservation r LEFT JOIN sgr_table t on r.`id_table`=t.`id_table` order by r.`nom_resa`');
				$statmt->execute();
				$resa_du_jour = $statmt->fetchAll(PDO::FETCH_ASSOC);


				//echo ("SELECT * FROM sgr_table t where t.`id_serveur`= ".$_SESSION["id_user"]." order by `numero_table`");
				$statmt = $pdo->prepare("SELECT * FROM sgr_table t where t.`id_serveur`= " . $_SESSION["id_user"] . " order by `numero_table`");
				$statmt->execute();
				$mes_tables = $statmt->fetchAll(PDO::FETCH_ASSOC);

				include("include/entete2.php");
				include("view/chef_de_rang.php");
				include("include/enpied2.php");
				break;
			}
		default: {
				//login ok mais pas de role défini
				//on kick
				session_destroy();
				header("Location:index.php");
			}
	}
} else {
	if (isset($_POST["login"]) && isset($_POST["mdp"])) {
		//on viens de la page de login
		//on interroge la base et on renseigne les infos utiles au profile

		$pdo = new PDO("mysql:host=localhost;dbname=SGR_MONO", "root", "");


		$statmt = $pdo->prepare("SELECT * FROM user where login=:log AND mdp=:mdp");
		$statmt->bindParam(":log", $_POST["login"], PDO::PARAM_STR);
		$statmt->bindParam(":mdp", $_POST["mdp"], PDO::PARAM_STR);
		$statmt->execute();

		$rep = $statmt->fetchAll(PDO::FETCH_ASSOC);
		//print_r($rep);
		$_SESSION["role"] = $rep[0]["role"];
		$_SESSION["id_user"] = $rep[0]["id_user"];
		$_SESSION["login"] = $rep[0]["login"];
		//echo ("login:".$_POST["login"]."<br>mdp:".$_POST["mdp"]."<br>role:".$_SESSION["role"]."<br>");
		header("Location:index.php");
	} else {
		// login fail et on ne viens pas de la page de login
		//on kick
		// include("include/entete2.php"); A supprimer
		// Page de connexion
		include("view/admin/tableau_de_bord/login.php");
		// include("include/enpied2.php");  A supprimer
	}
}
