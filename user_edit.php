<?php
include('headermin.php');
if(isset($_POST['envoi'])){
	if (!empty($_POST['description'])){
		$description = $_POST['description'];
		$pseudo = $_SESSION['pseudo'];
		$req = $bdd->prepare("UPDATE utilisateur SET description = :description WHERE pseudo = :pseudo");
		$req->execute(array('description' => htmlspecialchars($description),'pseudo' => $pseudo));
	}
	if (!empty($_POST['photo'])){
		$image = $_POST['photo'];
		$pseudo = $_SESSION['pseudo'];
		$req = $bdd->prepare("UPDATE utilisateur SET image = :image WHERE pseudo = :pseudo");
		$req->execute(array('image' => htmlspecialchars($image),'pseudo' => $pseudo));
	}
	if (!empty($_POST['pass'])){
		$req = $bdd->prepare('SELECT id, mdp FROM utilisateur WHERE pseudo = :pseudo');
		$req->execute(array('pseudo' => $_SESSION['pseudo']));
		$resultat = $req->fetch();

		if (is_bool($resultat) && !$resultat) {
			echo 
			'<form>
			Mauvais identifiant ou mot de passe
			</form>
			<div class="text-center" style="color:#999;"><a href="user_editprofil.php?username='.$_SESSION['pseudo'].'" style="color:#999;">Réessayer</a></div>';
		}
		else
		{
		// Comparaison du pass envoyé via le formulaire avec la base
			$isPasswordCorrect = password_verify($_POST['oldpass'], $resultat['mdp']);
			if ($isPasswordCorrect) {
				$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);

	// Mise a jour
				$req = $bdd->prepare("UPDATE utilisateur SET mdp = :pass_hache WHERE pseudo = :pseudo");
				$req->execute(array('pass_hache' => $pass_hache,'pseudo' => $_SESSION['pseudo']));
			}
			else {
				echo 
				'<form>
				Mauvais identifiant ou mot de passe
				</form>
				<div class="text-center" style="color:#999;"><a href="user_editprofil.php?username='.$_SESSION['pseudo'].'" style="color:#999;">Réessayer</a></div>';
			}
		}
		
	}
	header("Location: user_editprofil.php?username=".$_SESSION['pseudo']);
}


?>