<?php
include('header.php');

$media_dir = 'media';
$image_exts = array('jpeg', 'jpg', 'png', 'bmp');

?>

<?php
$hassend = false;
$haserror = false;

if (isset($_POST['add'])) {
	$haserror = empty($_POST['title']);
	if (!$haserror) {
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
		}

		if (!$haserror) {
			$lieu_stmt = $bdd->prepare(
				'INSERT INTO `lieu` (`id`, `nom`, `latitude`, `longitude`, `creation`) VALUES (NULL, ?, ?, ?, CURRENT_DATE())'
			);
			$lieu_desc_stmt = $bdd->prepare(
				'INSERT INTO lieudescription(date, description, idlieu, idutilisateur)'
				.' VALUES (NOW(), ?, ?, ?)'
				.';'
			);
			if (isset($ext)) {
				$lieu_media_stmt = $bdd->prepare(
					'INSERT INTO lieumedia(idlieu, idutilisateur, media, date, supprimer) VALUES (?, ?, ?, NOW(), 0)'
					.';'
				);
				$media_basename = time().'.'.$ext;
				$media_complete_path = $media_dir.DIRECTORY_SEPARATOR.$media_basename;
				@mkdir($media_dir);
				move_uploaded_file($_FILES['media_up']['tmp_name'], $media_complete_path);
			}
			try {
				$bdd->beginTransaction();
				$lieu_stmt->execute(array($_POST['title'], $_POST['latitude'], $_POST['longitude']));
				$last_idlieu = $bdd->lastInsertId();
				$lieu_desc_stmt->execute(array($_POST['description'], $last_idlieu, $_SESSION['id']));
				if (isset($ext)) {
					$lieu_media_stmt->execute(array($last_idlieu, $_SESSION['id'], $media_basename));
				}
				$bdd->commit();
				$hassend = true;
			} catch (PDOException $e) {
				$bdd->rollback();
				echo '<p>'.$e->getMessage().'</p>';
			}
		}
	}
}

if ($hassend && !$haserror) {
	?>
	<p>Votre lieu a bien été ajouté.</p>
	<p><a href="lieu_voir.php?lieu=<?php echo $last_idlieu; ?>">Accéder au lieu</a></p>
	<?php
} else {
	?>

	<div class="card p-4" >
		<form class="text-center" id="lieu_form" action="lieu_ajouter.php" method="post">
			<div class="row">
				<div class="col-xl-12">
					<div class="form-group">
						<label for="inputemail">Titre</label>
						<input type="text" class="form-control" id="title" name="title"/>
					</div><!--/*.form-group-->
				</div><!--/*.col-md-6-->
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<label for="latitude">Latitude</label>
						<input type="number" name="latitude" id="latitude" step="0.0000001" value="0.0" min="0.0" max="90.0" class="form-control"/>
					</div>
					<div class="col-sm-6">
						<label for="longitude">Longitude</label><input type="number" name="longitude" id="longitude" step="0.0000001" value="0.0" min="-180.0" max="180.0" class="form-control"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12">
					<div class="form-group">
						<div class="card border-secondary mb-3">
							<div class="card-header">Description</div>
								<div class="card-body text-secondary">
									<h5 class="card-title">La description supporte le formatage suivant</h5>
									<p class="card-text" >
										<ul style="list-style-type: none;">
											<li>** titre principal **</li>
											<li>*** titre secondaire ***</li>
											<li>[[<small>http://...</small>|texte à afficher]]</li>
										</ul>
									</p>
								</div>
							</div>
						<div>
							<label for="description">Description</label>
							<textarea id="description" class="form-control" name="description"></textarea>
						</div>
					</div><!--/*.form-group-->
				</div><!--/*.col-md-12-->
			</div>
			<div>
				<input type="file" name="media_up"/>
			</div>
			<div class="row">
				<div class="col-md-12">
					<button type="submit" class='btn btn-success' name="add">Publier</button>
					<input class="btn btn-secondary" type = 'button' onclick = 'geoloc()' value = 'Me localiser'>
					<a role="button" onClick="history.go(-1);" class='btn btn-danger' style="color: white;">Annuler</a>
				</div><!--/*.col-md-12-->
			</div><!--/*.row-->
		</div>
	</form>
</div>

<script>
function success(position) {
	var lat = position.coords.latitude;
	var lng = position.coords.longitude;
	$('#latitude').val(parseFloat(lat));
	$('#longitude').val(parseFloat(lng));
};

function error(err) {
	console.warn(`ERROR(${err.code}): ${err.message}`);
};
	
function geoloc() {
	navigator.geolocation.getCurrentPosition(success, error);
};
</script>


<?php
}

include('footer.php');
?>
