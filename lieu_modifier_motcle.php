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

	if (isset($_POST['tags'])) {
		foreach ($_POST['tags'] as $tag) {
			${'tag'.$tag.'stmt'} = 'INSERT INTO lieumotcle(idlieu, idmot) VALUES (?, ?);';
		}
		foreach ($_POST['tags'] as $tag) {
			try {
				
			} catch (PDOException $e) {
				
			}
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
	<form id="sampleForm" name="sampleForm" method="post" action="lieu_modifier_motcle.php?lieu=<?=$idlieu?>" class="form-group">
		<select class="chosen_select" name="tags[]" multiple>
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
			<button type="submit" class='btn btn-success' name="add">Enregistrer</button>
			<a role="button" onClick="history.go(-1);" class='btn btn-danger' style="color: white;">Annuler</a>
		</div><!--/*.col-md-12-->
	</form>
</div>


<?php
	}
}
	include('footer.php');
?>
