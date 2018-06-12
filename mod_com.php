<?php
	include('header.php');
	
	if(isset($_POST['garder'])){
		$idcom = $_POST['idcom'];
		$bdd->query('UPDATE signcommentaire SET taiter = 1 WHERE idcommentaire = '.$idcom);
	}
	if(isset($_POST['supprimer'])){
		$idcom = $_POST['idcom'];
		$bdd->query('UPDATE lieucommentaire SET supprimer = 1 WHERE id = '.$idcom);
	}
?>
<section>
	<div id="gestion_com">
		<h2>Commentaires ayant été signalé :</h2>
		<?php
			$req = $bdd->query('SELECT count(signcommentaire.id), message, idcommentaire, pseudo FROM lieucommentaire JOIN signcommentaire ON lieucommentaire.id = signcommentaire.idcommentaire JOIN utilisateur ON utilisateur.id = lieucommentaire.idutilisateur WHERE signcommentaire.taiter = 0 AND lieucommentaire.supprimer = 0 GROUP BY utilisateur.id ORDER BY count(signcommentaire.id)');
			while($donnees = $req->fetch()){
				$pseudo = $donnees['pseudo'];
				$commentaire = $donnees['message'];
				$idcom = $donnees['idcommentaire'];
				$nb = $donnees['count(signcommentaire.id)'];
		?>
		<p>Pseudo : <?php echo$pseudo ?></p>
		<p>Nombre de singalement : <?php echo$nb ?></p>
		<p>Commentaire : <?php echo$commentaire?></p>
		
		<form method="post" action="mod_com.php">
			<input type="submit" value="Garder" name="garder"/>
			<input type="submit" value="Supprimer" name="supprimer"/>
			<input type="hidden" value="<?php echo $idcom; ?>" name="idcom"/>
		</form>
		<?php

		}
		?>
		
		
	</div>
</section>
</html>
<?php
	include('footer.php');
?>