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
			'UPDATE lieudescription SET description = ?, idutilisateur = ? WHERE idlieu = ?;'
		);
		try {
			$bdd->beginTransaction();
			$lieu_stmt->execute(array($_POST['title'], $_GET['idlieu']));
			$lieu_desc_stmt = $bdd->execute(
				array($_POST['description'], $_SESSION['id'], $_GET['idlieu']
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
		$lieu_query = $bdd->query(
			'SELECT lieu.nom, lieudescription.description'
			.' FROM lieu, lieudescription'
			.' WHERE lieu.id = lieudescription.idlieu AND lieu.id = '.$lieu_id
			.';'
		);
		$lieu_query->execute();
		$data = $lieu_query->fetch();
		$lieu_titre = $data['nom'];
		$lieu_desc = $data['description'];
?>

<form id="article_form" action="lieu_edit.php" method="post">
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
