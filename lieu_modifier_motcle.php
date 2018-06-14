<?php
include('header.php');
?>

<?php
$idlieu = isset($_GET['lieu']) ? $_GET['lieu'] : 'alpha';

if(!is_numeric($idlieu)) {
	echo 'Page non trouvée';
} else {
	$hassend = false;
	$haserror = false;

	if (isset($_POST['save']) && isset($_POST['tags'])) {
		try {
			$bdd->beginTransaction();
			$clear_stmt = $bdd->prepare('DELETE FROM lieumotcle WHERE idlieu = ?;');
			$clear_stmt->execute(array($idlieu));
			foreach ($_POST['tags'] as $tag) {
				${$tag.'_stmt'} = $bdd->prepare(
					'INSERT INTO lieumotcle(idlieu, idmot) VALUES (?, ?);'
				);
				${$tag.'_stmt'}->execute(array($idlieu, $tag));
			}
			$bdd->commit();
			$hassend = true;
		} catch (PDOException $e) {
			$bdd->rollback();
			echo '<p>'.$e->getMessage().'</p>';
		}
	}

	if ($hassend && !$haserror) {
		?>
		<p>Mots-clés modifiés.</p>
		<p><a href="lieu_voir.php?lieu=<?php echo $idlieu; ?>">Accéder au lieu</a></p>
		<?php
	} else {
		?>

		<div class="card p-4" >
			<form class="text-center" id="lieu_form" action="lieu_media_ajouter.php?lieu=<?=$idlieu?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<form id="sampleForm" name="sampleForm" method="post" action="lieu_modifier_motcle.php?lieu=<?=$idlieu?>" class="form-group">
						<select class="chosen_select form-control" name="tags[]" multiple>
							<?php
							$lieu_motcles_choice_stmt = $bdd->prepare(
								'SELECT motcle.mot, motcle.id AS idmot, lieumotcle.id AS isselected'
								.' FROM motcle LEFT JOIN lieumotcle ON lieumotcle.idmot = motcle.id AND lieumotcle.idlieu = ?'
								.' ORDER BY motcle.mot ASC;'
							);
							try {
								$bdd->beginTransaction();
								$lieu_motcles_choice_stmt->execute(array($idlieu));
								$bdd->commit();
							} catch (PDOException $e) {
								$bdd->rollback();
								echo '<p>'.$e->getMessage().'</p>';
							}
							$lieu_motcles_choice_fetch = $lieu_motcles_choice_stmt->fetchAll(PDO::FETCH_ASSOC);

							foreach($lieu_motcles_choice_fetch as $row) {
								?>
								<option <?php if (!is_null($row['isselected'])) { echo 'selected'; } ?> value="<?php echo $row['idmot']; ?>"><?php echo $row['mot']; ?></option>
								<?php
							}
							?>
						</select>
						<div class="col-md-12">
							<button type="submit" class='btn btn-success mt-1' name="save">Enregistrer</button>
							<a role="button" onClick="history.go(-1);" class='btn btn-danger mt-1' style="color: white;">Annuler</a>
						</div><!--/*.col-md-12-->
					</form>
				</div><!--/*.row-->
			</form>
		</div>


		<?php
	}
}
include('footer.php');
?>
