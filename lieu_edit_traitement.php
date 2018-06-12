<?php include('header.php'); ?>


<?php
	$lieu_stmt = $bdd->prepare(
	'UPDATE lieu SET nom = ? WHERE id = ?;'
	);
	$lieu_desc_stmt = $bdd->prepare(
		'UPDATE lieudescription SET description = ?, idutilisateur = ? WHERE idlieu = ?;'
	);
	try {
		$bdd->beginTransaction();
		$lieu_stmt->execute(array($_POST['title'], $_GET['idlieu']));
		$lieu_desc_stmt = $bdd->execute(
			array($_POST['description'], $_SESSION['id'], $_GET['idlieu']
		);
		$bdd->commit();
	} catch (PDOException $e) {
		$bdd->rollback();
		echo '<p>'.$e->getMessage().'</p>';
	}
?>


<?php include('footer.php'); ?>
