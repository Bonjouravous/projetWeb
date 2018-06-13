<?php include('header.php');
	$idutilisateur = 3;
	$idtype = 2;
	$typelike = "lieu"; //lieu ou commentaire
	
	//Compte de tous les avis
	$rep1 = $bdd->prepare('SELECT SUM(avis) as reputation FROM like'.$typelike.' WHERE id'.$typelike.'=?');
	$rep1->execute(array($idtype));
	$likes = $rep1->fetchAll(PDO::FETCH_ASSOC);
	$total_like = 0 + $likes[0]['reputation'];
	echo "reputation: ". $total_like;

	
	//Avis de l'utilisateur actuel
	$rep2 = $bdd->prepare('SELECT avis FROM like'.$typelike.' WHERE idutilisateur=? AND id'.$typelike.'=?');
	$rep2->execute(array($idutilisateur,$idtype));
	$rep2_avis = $rep2->fetch(PDO::FETCH_ASSOC);
	if(!$rep2_avis) {
		// Si pas d'avis
		echo 'Pas d\'avis';
	} else {
		// Si avis
		echo "avis: ". $rep2_avis['avis'];
	}
	?>
	<form action="like.php" method="POST">
		<input type="hidden" name="like" value="1"/>
		<input type="hidden" name="type" value="<?php echo $typelike ?>"/>
		<input type="hidden" name="idtype" value="<?php echo $idtype ?>"/>
		<input type="hidden" name="idutilisateur" value="<?php echo $idutilisateur ?>"/>
		<input type="submit" onclick= 'like(1)' value="Like" />
	</form>
	<form action="like.php" method="POST">
		<input type="hidden" name="like" value="-1"/>
		<input type="hidden" name="type" value="<?php echo $typelike ?>"/>
		<input type="hidden" name="idtype" value="<?php echo $idtype ?>"/>
		<input type="hidden" name="idutilisateur" value="<?php echo $idutilisateur ?>"/>
		<input type="submit" onclick= 'like(-1)' value="Dislike" />
	</form>
	
	
<?php include('footer.php'); ?>