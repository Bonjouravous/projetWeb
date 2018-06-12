<?php include('header.php'); ?>


<?php
	$lieu_stmt = $bdd->prepare(
		'INSERT INTO lieu(nom) VALUES (?);'
	);
	$lieu_desc_stmt = $bdd->prepare(
		'INSERT_INTO lieudescription(description, idutilisateur, idlieu)'
		.' VALUES (?, ?, ?);'
	);
	try {
		$bdd->beginTransaction();
		$lieu_stmt->execute(array($_POST['title']));
		$last_idlieu = $bdd->lastInsertId();
		$lieu_desc_stmt = $bdd->execute(
			array($_POST['description'], $_SESSION['id'], $last_idlieu
		);
		$bdd->commit();
	} catch (PDOException $e) {
		$bdd->rollback();
		echo '<p>'.$e->getMessage().'</p>';
	}
?>


<?php include('footer.php'); ?>
