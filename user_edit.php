<?php
include('header.php');
$media_dir = 'media';
$image_exts = array('jpeg', 'jpg', 'png', 'bmp');

$error= false;
$msg = false;
if(isset($_POST['envoi'])){
	if (!empty($_POST['description'])){
		$description = $_POST['description'];
		$pseudo = $_SESSION['pseudo'];
		$req = $bdd->prepare("UPDATE utilisateur SET description = :description WHERE pseudo = :pseudo");
		$req->execute(array('description' => htmlspecialchars($description),'pseudo' => $pseudo));
	}
	
	if (isset($_FILES['media_up'])) {
		if ($_FILES['media_up']['error'] == 0) {
			if ($_FILES['media_up']['size'] <= 800000) {
				$info = pathinfo($_FILES['media_up']['name']);
				$ext = $info['extension'];
				if (in_array($ext, $image_exts)) {
					@mkdir($media_dir);
					$fname = $media_dir.'/profilimage_'.$_SESSION['id'].'.'.$ext;
					move_uploaded_file($_FILES['media_up']['tmp_name'], $fname);
					$req = $bdd->prepare("UPDATE utilisateur SET image = ? WHERE id=?");
					$req->execute(array($fname, $_SESSION['id']));
				}
				else $msg = "Extension invalide (".$ext.")";
			} else {
				$msg = "L'image est trop grosse";
			}
		}
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
			$msg = 'Utilisateur introuvable';
			$error = true;
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
				$msg = 'Mot de passe mis à jour!';
			}
			else {
				$msg = 'Mauvais mot de passe';
				$error = true;
			}
		}
		
	}
	
	header("Location: user_editprofil.php?error=".($error ? 'true' : 'false')."&username=".$_SESSION['pseudo'].'&msg='.$msg);

}
include('footer.php');

?>