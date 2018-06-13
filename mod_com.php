<?php
	include('header.php');
	
	if(isset($_POST['garder'])){
		$idcom = $_POST['idcom'];
        $stat = $bdd->prepare('UPDATE signcommentaire SET traite = 1 WHERE idcommentaire = ?');
        $stat->execute(array($idcom));
    }

if (isset($_POST['supprimer'])) {
    $idcom = $_POST['idcom'];
    $stat = $bdd->prepare('UPDATE lieucommentaire SET supprime = 1 WHERE id = ' . $idcom);
    $stat->execute(array($idcom));
}
?>
<section>
	<div id="gestion_com">
		<h2>Commentaires ayant été signalé :</h2>
		<?php
			$req = $bdd->query('SELECT count(signcommentaire.id), message, idcommentaire, pseudo FROM lieucommentaire JOIN signcommentaire ON lieucommentaire.id = signcommentaire.idcommentaire JOIN utilisateur ON utilisateur.id = lieucommentaire.idutilisateur WHERE signcommentaire.traite = 0 AND lieucommentaire.supprime = 0 GROUP BY utilisateur.id ORDER BY count(signcommentaire.id)');
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