<?php
include('header.php');

$idlieu = isset($_GET['lieu']) ? (int) $_GET['lieu'] : 'alpha';

if(!is_numeric($idlieu)) {
	echo 'Page non trouvée';
} else {
	?>

	<?php
	$hassend = false;
	$haserror = false;

	if (isset($_POST['update'])) {
		if (empty($_POST['title'])) {
			$haserror = true;
		}

		if (!$haserror) {
			$lieu_stmt = $bdd->prepare(
				'UPDATE lieu SET nom = ? WHERE id = ?;'
			);
			$lieu_desc_stmt = $bdd->prepare(
				'INSERT INTO lieudescription(date, description, idlieu, idutilisateur)'
				.' VALUES (NOW(), ?, ?, ?)'
				.';'
			);
			try {
				$bdd->beginTransaction();
				$lieu_stmt->execute(array($_POST['title'], $idlieu));
				$lieu_desc_stmt->execute(
					array($_POST['description'], $idlieu, $_SESSION['id'])
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
		<p>Votre lieu a bien été édité.</p>
		<p><a href="lieu_voir.php?lieu=<?php echo $idlieu; ?>">Accéder au lieu</a></p>
		<?php
	} else {
		$lieu_stmt = $bdd->prepare(
			'SELECT lieu.nom AS titre, lieudescription.description AS description'
			.' FROM lieu, lieudescription'
			.' WHERE lieu.id = lieudescription.idlieu'
			.'	AND lieu.id = ?'
			.' ORDER BY lieudescription.date DESC'
			.' LIMIT 1'
			.';'
		);
		try {
			$bdd->beginTransaction();
			$lieu_stmt->execute(array($idlieu));
			$bdd->commit();
		} catch (PDOException $e) {
			$bdd->rollback();
			echo '<p>'.$e->getMessage().'</p>';
		}
		$data = $lieu_stmt->fetch();
		$lieu_titre = $data['titre'];
		$lieu_desc = $data['description'];
		?>

		<div class="card p-4" >
			<form class="text-center" id="lieu_form" action="lieu_edit.php?lieu=<?=$idlieu?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="inputemail">Titre</label>
							<input type="text" class="form-control" id="title" name="title" value=<?php echo '"'.$lieu_titre.'"'; ?> />
						</div><!--/*.form-group-->
					</div><!--/*.col-md-6-->
					<div class="col-md-12">
						<div class="form-group">
							<div>
								<div class="card border-secondary mb-3">
									<div class="card-header">Description</div>
									<div class="card-body text-secondary">
										<h5 class="card-title">La description supporte le formatage suivant</h5>
										<p class="card-text" >						<ul style="list-style-type: none;">
											<li>** titre principal **</li>
											<li>*** titre secondaire ***</li>
											<li>[[<small>http://...</small>|texte à afficher]]</li>
										</ul></p>
									</div>
								</div>
								<label for="description">Description</label>
								<textarea id="description" class="form-control" name="description" form="lieu_form"><?php echo $lieu_desc; ?></textarea>
							</div>
						</div><!--/*.form-group-->
					</div><!--/*.col-md-12-->
					<div class="col-md-12">
						<button type="submit" class='btn btn-success' name="update">Mettre à jour</button>
						<a role="button" href="lieu_voir.php?lieu=<?php echo $_GET['lieu']; ?>" class='btn btn-danger'>Annuler</a>
					</div><!--/*.col-md-12-->
				</div><!--/*.row-->
			</form>
		</div>

		<?php
	}
}

include('footer.php');
?>

