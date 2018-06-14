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

	try {
		$bdd->beginTransaction();
		if (isset($_POST['save'])) {
			$clear_stmt = $bdd->prepare('DELETE FROM lieumotcle WHERE idlieu = ?;');
			$clear_stmt->execute(array($idlieu));
			if (isset($_POST['tags'])) {
				foreach ($_POST['tags'] as $tag) {
					${$tag.'_stmt'} = $bdd->prepare(
						'INSERT INTO lieumotcle(idlieu, idmot) VALUES (?, ?);'
					);
					${$tag.'_stmt'}->execute(array($idlieu, $tag));
				}
			}
			$hassend = true;
		}

		if ($hassend && !$haserror) {
			?>
			<p>Mots-clés modifiés.</p>
			<p><a href="lieu_voir.php?lieu=<?php echo $idlieu; ?>">Accéder au lieu</a></p>
			<?php
		} else {
			?>
			<div class="card p-4" >
				<div class="row">
					<div class="col-md-12">
						<form id="sampleForm" name="sampleForm" method="post" action="lieu_modifier_motcle.php?lieu=<?=$idlieu?>" class="form-group">
							<select class="chosen_select form-control" name="tags[]" multiple>
							<?php
							$lieu_motcles_choice_stmt = $bdd->prepare(
								'SELECT motcle.mot, motcle.id AS idmot, lieumotcle.id AS isselected'
								.' FROM motcle LEFT JOIN lieumotcle ON lieumotcle.idmot = motcle.id AND lieumotcle.idlieu = ?'
								.' ORDER BY motcle.mot ASC;'
							);
							$lieu_motcles_choice_stmt->execute(array($idlieu));
							$lieu_motcles_choice_fetch = $lieu_motcles_choice_stmt->fetchAll(PDO::FETCH_ASSOC);
							foreach($lieu_motcles_choice_fetch as $row) {
							?>
								<option <?php if (!is_null($row['isselected'])) { echo 'selected'; } ?> value="<?php echo $row['idmot']; ?>"><?php echo $row['mot']; ?></option>
							<?php
							}
							?>
							</select>
							<button type="submit" class='btn btn-success mt-1' name="save">Enregistrer</button>
							<a role="button" onClick="history.go(-1);" class='btn btn-danger mt-1' style="color: white;">Annuler</a>
						</form>
					</div><!--/*.col-md-12-->
				</div><!--/*.row-->
			</div>
			<?php
		}
		$bdd->commit();
	} catch (PDOException $e) {
		$bdd->rollback();
		echo '<p>'.$e->getMessage().'</p>';
	}
}

include('footer.php');
?>

<script>
$('.chosen_select').chosen({
	width: "95%"
});
</script>
