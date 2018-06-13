<?php
include('header.php');

if(isset($_POST['traiter'])){
	$idcom = $_POST['idcom'];
	$stat = $bdd->prepare('UPDATE signdescription SET traite = 1 WHERE iddescription = ?');
	$stat->execute(array($idcom));
}

?>
<?php if(isMod()){
	?>
	<section>
		<div class="card text-center">
			<div class="card-header">
				<ul class="nav nav-tabs card-header-tabs">
					<li class="nav-item">
						<a class="nav-link" href="admin.php">Gestionnaire des modérateurs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="mod_lieu.php">Signalements lieux</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="mod_com.php">Signalements commentaires</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="mod_uti.php">Signalements utilisateurs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="mod_cle.php">Mots clés</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<h5 class="card-title text-left">Lieux ayant été signalé</h5>
				<p class="card-text"><div>
					<div>
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
				</div></p>
			</div>
		</div>
	</section>
	<?php } ?>
	<?php
	include('footer.php');
	?>
