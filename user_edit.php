<?php
include('headermin.php');
if(isset($_POST['envoi'])){
		if (!empty($_POST['description'])){
			$description = $_POST['description'];
			$pseudo = $_SESSION['pseudo'];
			$req = $bdd->prepare("UPDATE utilisateur SET description = :description WHERE pseudo = :pseudo");
			$req->execute(array('description' => $description,'pseudo' => $pseudo));
		}
		if (!empty($_POST['photo'])){
			$image = $_POST['photo'];
			$pseudo = $_SESSION['pseudo'];
			$req = $bdd->prepare("UPDATE utilisateur SET image = :image WHERE pseudo = :pseudo");
			$req->execute(array('image' => $image,'pseudo' => $pseudo));
		}
		header("Location: user_editprofil.php?username=".$_SESSION['pseudo']);
	}
	
?>