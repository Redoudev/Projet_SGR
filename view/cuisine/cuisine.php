<?php
if($_SESSION["role"]=="cuisine"){
	echo ("<div class=\"bandeau\">vous êtes cuisinier</div>");
	?>
	<div class="row">
	<?php
	//print_r($resa);
	foreach( $resa as $r){
?>
	<div class="col-12 col-xl-2 col-xxl-2 col-md-2 d-flex">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title mb-0">Table <?php echo $r["id_table"];?></h5>
			</div>
			<div class="card-body">
				 reservation :<?php echo $r["nom_resa"];?><br>
				 nb:<?php echo $r["nb_pers"];?>
			</div>
		</div>
	</div>
<?php
	}
	?>
	</div>
	<?php
}else{
	echo ("vous n'avez pas le droit d'être là");
}
?>