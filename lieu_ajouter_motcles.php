<?php
	include('header.php');
?>

<?php
	$hassend = false;
	$haserror = false;
?>

<form id="sampleForm" name="sampleForm" method="post" action="lieu_ajouter_motcles.php" class="form-group">
	<select class="chosen_select" name="tags[]" multiple>
	<?php
		$lieu_motcles_stmt = $bdd->prepare('SELECT mot FROM motcle WHERE ');

		$rep = $bdd->query('SELECT * FROM motcle;');
		$rep->execute();
		$motscles = $rep->fetchAll(PDO::FETCH_ASSOC);
		print_r($motscles);
		
		foreach($motscles as $motcle) {
			echo ("<option value=".$motcle['id'].">".$motcle['mot']."</option>");
		}
	?>
	</select>
</form>


<?php
	include('footer.php');
?>
