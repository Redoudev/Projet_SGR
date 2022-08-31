<?php
if ($_SESSION["role"] == "bar") {
	echo ("<div class=\"bandeau\">vous êtes barman</div>");
?>
	ici l'interface dédiée au barman
<?php
} else {
	echo ("vous n'avez pas le droit d'être là");
}
?>