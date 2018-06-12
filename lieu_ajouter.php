<?php
	include('header.php');
?>


<form id="article_form" action="lieu_ajouter_traitement.php" method="post">
	<fieldset>
		<p>Titre:</p>
		<input type="text" name="title" value=""/>
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
		<input type="submit" name="add" value="Créer"/>
	</fieldset>
</form>

<input type="button" name="cancel" value="Annuler" onClick="history.go(-1);"/>


<?php
	}

	include('footer.php');
?>
