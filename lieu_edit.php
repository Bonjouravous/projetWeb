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

	if (isset($_POST['update'])) {
		$lieu_stmt = $bdd->prepare(
			'UPDATE lieu SET nom = ? WHERE id = ?;'
		);
		$lieu_desc_stmt = $bdd->prepare(
			'INSERT INTO lieudescription(date, description, idlieu, idutilisateur)'
			.' VALUES (?, ?, ?, ?)'
			.';'
		);
		try {
			$bdd->beginTransaction();
			$lieu_stmt->execute(array($_POST['title'], $idlieu));
			$lieu_desc_stmt = $bdd->execute(
				array(date('Y-m-d'), $_POST['description'], $idlieu, $_SESSION['id'])
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
		$lieu_stmt = $bdd->prepare(
			'SELECT lieu.nom AS titre, lieudescription.description AS description'
			.' FROM lieu, lieudescription'
			.' WHERE lieu.id = lieudescription.idlieu'
			.'  AND lieu.id = ?'
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

<form id="article_form" action="lieu_edit.php?lieu=<?=$idlieu?>" method="post">
	<fieldset>
		<p>Titre:</p>
		<input type="text" name="title" value=<?php echo '"'.$lieu_titre.'"'; ?> />
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
				<?php
					echo $lieu_desc;
				?>
			</textarea>
	</div>
	</fieldset>
	<fieldset>
		<input type="submit" name="update" value="Mettre à jour"/>
	</fieldset>
</form>

<input type="button" name="cancel" value="Annuler" onClick="history.go(-1);"/>


<?php
	}
}

	include('footer.php');
?>
