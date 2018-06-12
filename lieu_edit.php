<?php
	include('header.php');
	
	$idlieu = isset($_GET['lieu']) ? $_GET['lieu'] : 'alpha';

if(!is_numeric($idlieu)) {
	echo 'Page non trouvée';
} else {

?>


<?php
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

<form id="article_form" action="lieu_edit_traitement.php" method="post">
	<input type="hidden" name="idlieu" value=<?php echo '"'.$idlieu.'"'; ?> />
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
		<input type="button" name="cancel" value="Annuler"/>
	</fieldset>
</form>


<?php
}

	include('footer.php');
?>
