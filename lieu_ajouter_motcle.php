<?php
	include('header.php');
?>

<?php
	$idlieu = (int) $_GET['lieu'];
	$hassend = false;
	$haserror = false;
?>

<form id="sampleForm" name="sampleForm" method="post" action="lieu_ajouter_motcle.php" class="form-group">
	<select class="chosen_select" name="tags[]" multiple>
	<?php
		$lieu_motcles_choice_stmt = $bdd->prepare(
			'SELECT motcle.mot as mot, motcle.id as id FROM motcle, lieumotcle'
			.' WHERE lieumotcle.idlieu = ?'
			.'  AND motcle.id NOT IN ('
			.'    SELECT idmot FROM lieumotcle WHERE lieumotcle.idlieu = ?'
			.'  )'
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

		foreach($lieu_motcles_choice_fetch as $motcle) {
		?>
			<option value="<?php echo $motcle['id']; ?>"><?php echo $motcle['mot']; ?></option>
		<?php
		}
	?>
	</select>
</form>


<?php
	include('footer.php');
?>
