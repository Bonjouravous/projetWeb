<?php include('header.php');
	$idutilisateur = 3;
	$idtype = 1;
	$typelike = "description"; //description ou commentaire
		
?>
	<form action="signalement.php" method="GET">
		<input type="hidden" name="type" value="<?php echo $typelike ?>"/>
		<input type="hidden" name="idtype" value="<?php echo $idtype ?>"/>
		<input type="hidden" name="idutilisateur" value="<?php echo $idutilisateur ?>"/>
		<input type="submit" value="Signaler" />
	</form>
	
	<?php include('footer.php'); ?>