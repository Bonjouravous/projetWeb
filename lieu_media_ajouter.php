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
						$haserror = true;
					}
				} else {
					$haserror = true;
				}
			} else {
				$haserror = true;
			}
		} else {
			$haserror = true;
		}

		if (!$haserror) {
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

	if ($hassend && !$haserror) {
		?>
		<p>Votre image a bien été importé.</p>
		<img src="<?php echo $media_complete_path ?>" width="300" height="200"/>
		<p><a href="lieu_voir.php?lieu=<?php echo $idlieu; ?>">Accéder au lieu</a></p>
		<?php
	} else {
		?>

		<div class="card p-4" >
			<form class="text-center" id="lieu_form" action="lieu_media_ajouter.php?lieu=<?=$idlieu?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-12 form-group">
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
							Importer une photo
						</button>

						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Importer</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="file-loading">
											<input id="input-b9" name="media_up" type="file"'>
										</div>
										<div id="kartik-file-errors"></div>
									</div>
									<div class="modal-footer">
										<button type="submit" class='btn btn-success' name="add">Ajouter</button>
										<a role="button" onClick="history.go(-1);" class='btn btn-danger' style="color: white;">Annuler</a>
									</div>
								</div>
							</div>
						</div>


						<script>
							$(document).on('ready', function() {
								$("#input-b9").fileinput({
									showPreview: false,
									showUpload: false,
									elErrorContainer: '#kartik-file-errors',
									allowedFileExtensions: ["jpg", "png", "gif"]
        //uploadUrl: '/site/file-upload-single'
    });
							});
						</script>
					</div>
				</div><!--/*.row-->
			</form>
		</div>

		<?php
	}
}

include('footer.php');
?>
