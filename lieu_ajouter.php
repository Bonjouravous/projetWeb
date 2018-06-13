<?php
	include('header.php');
?>

<?php
	$hassend = false;
	$haserror = false;

	if (isset($_POST['add'])) {
		$haserror = empty($_POST['title']);
		if (!$haserror) {
			$lieu_stmt = $bdd->prepare(
				'INSERT INTO `lieu` (`id`, `nom`, `latitude`, `longitude`, `creation`) VALUES (NULL, ?, ?, ?, CURRENT_DATE())'
			);
			$lieu_desc_stmt = $bdd->prepare(
				'INSERT INTO lieudescription(date, description, idlieu, idutilisateur)'
				.' VALUES (NOW(), ?, ?, ?)'
				.';'
			);
			try {
				$bdd->beginTransaction();
				$lieu_stmt->execute(array($_POST['title'], $_POST['latitude'], $_POST['longitude']));
				$last_idlieu = $bdd->lastInsertId();
				$lieu_desc_stmt->execute(
					array($_POST['description'], $last_idlieu, $_SESSION['id'])
				);
				$bdd->commit();
				$hassend = true;
			} catch (PDOException $e) {
				$bdd->rollback();
				echo '<p>'.$e->getMessage().'</p>';
			}
		}
		$hassend = true;
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
			<div class="col-md-12">
				<div class="form-group">
					<label for="inputemail">Titre</label>
					<input type="text" class="form-control" id="title" name="title"/>
				</div><!--/*.form-group-->
			</div><!--/*.col-md-6-->
			<div>
				Latitude: <input type="number" name="latitude" step="0.01" value="0" min="0." max="90"/>
				Longitute: <input type="number" name="longitude" step="0.01" value="0" min="-180" max="180"/>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="description">Description</label>
					<div>
						<p>La description supporte le formatage suivant:</p>
						<ul>
							<li>Titre principal: ** titre principal **</li>
							<li>Titre secondaire: *** titre secondaire ***</li>
							<li>Lien URL: [[http://...|texte à afficher]]</li>
						</ul>
					</div>
					<div>
						<p>Description:</p>
						<textarea id="description" class="form-control" name="description" form="lieu_form"></textarea>
					</div>
				</div><!--/*.form-group-->
			</div><!--/*.col-md-12-->
			<div class="col-md-12">
				<button type="submit" class='btn btn-success' name="add">Publier</button>
				<a role="button" onClick="history.go(-1);" class='btn btn-danger'>Annuler</a>
			</div><!--/*.col-md-12-->
		</div><!--/*.row-->
	</form>
</div>


<?php
	}

	include('footer.php');
?>
