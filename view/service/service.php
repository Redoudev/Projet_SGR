<?php
if ($_SESSION["role"] == "service") {
	echo ("vous êtes serveur");
?>

	ici l'interface du serveur qui prend les commandes des convives (chaises de la reservation), demande les plats et boissons ...
<?php

} else {
	echo ("vous n'avez pas le droit d'être là");
}
?>