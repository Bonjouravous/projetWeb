<?php
	include('header.php');
	
	if(isset($_POST['traiter'])){
		$idcom = $_POST['idcom'];
		$bdd->query('UPDATE signdescription SET traite = 1 WHERE iddescription = '.$idcom);
	}

?>
<section>
	<div>
		<h2>Lieux ayant été signalé :</h2>
		<?php
        $req = $bdd->query('SELECT DISTINCT nom, lieu.id as idL, count(signdescription.id), signdescription.id as idD FROM lieu JOIN lieudescription ON lieu.id = lieudescription.idlieu JOIN signdescription ON lieudescription.id = signdescription.iddescription WHERE signdescription.traite = 0 GROUP BY lieu.nom ORDER BY count(signdescription.id) DESC');
			while($donnees = $req->fetch()){
				$nom = $donnees['nom'];
				$idLieu = $donnees['idL'];
				$idcom = $donnees['idD'];
				$nb = $donnees['count(signdescription.id)'];
		?>
		
		<p>Nom : <?php echo $nom; ?></p> 
		<p>Identifiant du lieu : <?php echo $idLieu; ?></p>
		<p>Nombre de signalement : <?php echo $nb; ?></p>
		<a href="">Lien vers la page signalé</a><!-- Lien à ajouté -->
		
		<form method="post" action="mod_lieu.php">
			<input type="submit" value="Traiter" name="traiter"/>
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