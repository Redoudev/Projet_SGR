<?php

if ($_SESSION["role"] == "rang") {

    echo ("vous êtes chef de rang");




?>

    ici l'interface du chef de rang, il prend les reservations et decide du placement des reservation sur les tables. il indique si la reservation est arrivée et placée à table

    <?php

} else {

    echo ("vous n'avez pas le droit d'être là");
}

    ?><?php
