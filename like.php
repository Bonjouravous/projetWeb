<?php include('headermin.php');

if(!isConnected()) {
	exit();
}

if(isset($_GET['like']) && isset($_GET['type']) && isset($_GET['idtype'])){
	$like = $_GET['like'];
	$typelike = $_GET['type'];
	$idtype = $_GET['idtype'];
	$idutilisateur = $_SESSION['id'];
	if(($like == 1 || $like == -1) && in_array($typelike, array('lieu', 'commentaire'))&& is_numeric($idtype)&& is_numeric($idutilisateur)){
		//Avis de l'utilisateur actuel
		$rep = $bdd->prepare('SELECT avis FROM like'.$typelike.' WHERE idutilisateur=? AND id'.$typelike.'=?');
		$rep->execute(array($idutilisateur,$idtype));
		$rep_avis = $rep->fetch(PDO::FETCH_ASSOC);
		if(!$rep_avis) {
			// Si pas d'avis
			$setlike = $bdd->prepare('INSERT INTO like'.$typelike.' VALUES (NULL, ?, ?, ?)');
			$setlike->execute(array($idtype,$idutilisateur,$like));
			echo $like;
		} elseif($like != $rep_avis['avis']) {
			$setlike = $bdd->prepare('UPDATE like'.$typelike.' SET avis=? WHERE id'.$typelike.'=? AND idutilisateur=?');
			$setlike->execute(array($like,$idtype,$idutilisateur));
			echo $like;
		} else{
			$setlike = $bdd->prepare('DELETE FROM like'.$typelike.' WHERE id'.$typelike.'=? AND idutilisateur=?');
			$setlike->execute(array($idtype,$idutilisateur));
			echo 0;
		}
	
	}
	else{
		echo -5;
	}
}

