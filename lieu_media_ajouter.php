<?php
include('header.php');

$media_dir = 'media';
$image_exts = array('jpeg', 'jpg', 'png', 'bmp');

$idlieu = isset($_GET['lieu']) ? (int) $_GET['lieu'] : 'alpha';

if(!is_numeric($idlieu)) {
	echo 'Page non trouvée';
} else {


	$hassend = false;
	$haserror = false;

	if (isset($_POST['add'])) {
		if (isset($_FILES['media_up'])) {
			if ($_FILES['media_up']['error'] == 0) {
				if ($_FILES['media_up']['size'] <= 8000000) {
					$info = pathinfo($_FILES['media_up']['name']);
					$ext = $info['extension'];
					if (!in_array($ext, $image_exts)) {
						$haserror = 'Extension invalide ('.$ext.')';
					}
				} else {
					$haserror = 'Fichier trop gros';
				}
			} else {
				$haserror = 'Erreur d\'envoi du fichier';
			}
		} else {
			$haserror = 'Pas de fichier renseigné';
		}

		if ($haserror != false) {
			$lieu_media_stmt = $bdd->prepare(
				'INSERT INTO lieumedia(idlieu, idutilisateur, media, date, supprimer) VALUES (?, ?, ?, NOW(), 0)'
				.';'
			);
			$media_basename = time().'.'.$ext;
			$media_complete_path = $media_dir.DIRECTORY_SEPARATOR.$media_basename;
			@mkdir($media_dir);
			move_uploaded_file($_FILES['media_up']['tmp_name'], $media_complete_path);
			try {
				$bdd->beginTransaction();
				$lieu_media_stmt->execute(
					array($idlieu, $_SESSION['id'], $media_basename)
				);
				$bdd->commit();
				$hassend = true;
			} catch (PDOException $e) {
				$bdd->rollback();
				echo '<p>'.$e->getMessage().'</p>';
			}
		}
	}

	if ($hassend && $haserror != false) {
		?>
		<p>Votre image a bien été importé.</p>
		<img src="<?php echo $media_complete_path ?>" width="300" height="200"/>
		<p><a href="lieu_voir.php?lieu=<?php echo $idlieu; ?>">Accéder au lieu</a></p>
		<?php
	} else {
		?>

		<p>Une erreur est survenue, veuillez réessayer (<?=$haserror?>)</p>
		<p><a href="lieu_voir.php?lieu=<?php echo $idlieu; ?>">Accéder au lieu</a></p>

		<?php
	}
}

include('footer.php');
?>
