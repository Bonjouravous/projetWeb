<?php
	include('header.php');
?>

<?php
$idlieu = isset($_GET['lieu']) ? (int) $_GET['lieu'] : 'alpha';

if(!is_numeric($idlieu)) {
	echo 'Page non trouvée';
} else {
	$hassend = false;
	$haserror = false;

	if (isset($_POST['tags[]'])) {
		foreach ($_POST['tags[]'] as $id) {
			
		}
		$hassend = true;
	}

	if ($hassend && !$haserror) {
	?>
	<p>Mots-clés ajoutés.</p>
	<p><a href="lieu_voir.php?lieu=<?php echo $idlieu; ?>">Accéder au lieu</a></p>
	<?php
	} else {
?>

</div><!--/*.col-md-12-->
	<form id="sampleForm" name="sampleForm" method="post" action="lieu_ajouter_motcle.php?lieu=<?=$idlieu?>" class="form-group">
		<select class="chosen_select" name="tags[]" multiple>
		<?php
			$lieu_motcles_choice_stmt = $bdd->prepare(
				'SELECT motcle.mot as mot, motcle.id as id FROM motcle, lieumotcle'
				.' WHERE motcle.id NOT IN ('
				.'  SELECT idmot FROM lieumotcle WHERE lieumotcle.idlieu = ?'
				.' )'
				.';'
			);
			try {
				$bdd->beginTransaction();
				$lieu_motcles_choice_stmt->execute($idlieu, $idlieu);
				$bdd->commit();
			} catch (PDOException $e) {
				$bdd->rollback();
				echo '<p>'.$e->getMessage().'</p>';
			}
			$lieu_motcles_choice_fetch = $lieu_motcles_choice_stmt->fetchAll(PDO::FETCH_ASSOC);
			print_r($lieu_motcles_choice_fetch);

			foreach($lieu_motcles_choice_fetch as $motcle) {
			?>
				<option value="<?php echo $motcle['id']; ?>"><?php echo $motcle['mot']; ?></option>
			<?php
			}
		?>
		</select>
		<div class="col-md-12">
			<button type="submit" class='btn btn-success' name="add">Ajouter</button>
			<a role="button" onClick="history.go(-1);" class='btn btn-danger' style="color: white;">Annuler</a>
		</div><!--/*.col-md-12-->
	</form>
</div>


<?php
	}
}
	include('footer.php');
?>
