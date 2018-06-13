<?php include('headermin.php');

if(!isConnected()) {
	exit();
}

if(isset($_GET['type']) && isset($_GET['idtype'])){
	$typelike = $_GET['type'];
	$idtype = $_GET['idtype'];
	$idutilisateur = $_SESSION['id'];
	if(in_array($typelike, array('lieu', 'commentaire'))&& is_numeric($idtype)&& is_numeric($idutilisateur)){
		//A déjà signalé ?
		$rep = $bdd->prepare('SELECT * FROM sign'.$typelike.' WHERE idutilisateur=? AND id'.$typelike.'=?');
		$rep->execute(array($idutilisateur,$idtype));
		$rep_ut = $rep->fetch(PDO::FETCH_ASSOC);
		if(!$rep_ut) {
			// Si pas de signalement
			$setsign = $bdd->prepare('INSERT INTO sign'.$typelike.' VALUES (NULL, ?, ?, NOW(),?)');
			$setsign->execute(array($idutilisateur,$idtype,0));
			echo 1;
		}
	
	}
	else{
		echo -5;
	}
}



 ?>