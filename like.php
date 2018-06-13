<?php include('headermin.php');

if(isset($_POST['like']) && isset($_POST['type']) && isset($_POST['idtype']) && isset($_POST['idutilisateur'])){
	if($_POST['like'] == 1 || $_POST['like'] == -1){
		$like = $_POST['like'];
		$typelike = $_POST['type'];
		$idtype = $_POST['idtype'];
		$idutilisateur = $_POST['idutilisateur'];

		//Avis de l'utilisateur actuel
		$rep = $bdd->prepare('SELECT avis FROM like'.$typelike.' WHERE idutilisateur=? AND id'.$typelike.'=?');
		$rep->execute(array($idutilisateur,$idtype));
		$rep_avis = $rep->fetch(PDO::FETCH_ASSOC);
		if(!$rep_avis) {
			// Si pas d'avis
			$setlike = $bdd->prepare('INSERT INTO like'.$typelike.' VALUES (NULL, ?, ?, ?)');
			$setlike->execute(array($idtype,$idutilisateur,$like));
			echo $like."like";
		} else if($like != $rep_avis['avis']) {
			$setlike = $bdd->prepare('UPDATE like'.$typelike.' SET avis=? WHERE id'.$typelike.'=? AND idutilisateur=?');
			$setlike->execute(array($like,$idtype,$idutilisateur));
			echo $like."like";
		} else
			echo "pas de changement";
	
	}
}


 ?>