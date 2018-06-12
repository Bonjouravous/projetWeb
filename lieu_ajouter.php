<?php
	include('header.php');
	
	$idlieu = isset($_GET['lieu']) ? $_GET['lieu'] : 'alpha';

if(!is_numeric($idlieu)) {
	echo 'Page non trouvée';
} else {

?>

<?php
	$hassend = false;
	$haserror = false;

	if (isset($_POST['add'])) {
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
			$hassend = true;
		} catch (PDOException $e) {
			$bdd->rollback();
			echo '<p>'.$e->getMessage().'</p>';
		}
	}

	if ($hassend && !$haserror) {
		
	} else {
?>

<form id="article_form" action="lieu_ajouter.php" method="post">
	<fieldset>
		<p>Titre:</p>
		<input type="text" name="title" value="" />
	</fieldset>
	<fieldset>
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
			<textarea name="description" form="lieu_form">
			</textarea>
	</div>
	</fieldset>
	<fieldset>
		<input type="submit" name="add" value="Ajouter"/>
	</fieldset>
</form>

<input type="button" name="cancel" value="Annuler" onClick="history.go(-1);"/>


<?php
	}
}

	include('footer.php');
?>
