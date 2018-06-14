<?php
include('header.php');

if(isset($_POST['traiter'])){
	$idcom = $_POST['idcom'];
	$stat = $bdd->prepare('UPDATE signlieu SET traite = 1 WHERE idlieu = ?');
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
					<li class="nav-item">
						<a class="nav-link" href="mod_contact.php">Messages</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<h5 class="card-title text-left">Lieux ayant été signalé</h5>
				<div class="card-text">
					<div>
						<?php
						$req = $bdd->query('SELECT DISTINCT nom, lieu.id as idL, count(signlieu.id) FROM lieu
						JOIN signlieu ON lieu.id = signlieu.idlieu
						WHERE signlieu.traite = 0
						GROUP BY lieu.nom
						ORDER BY count(signlieu.id) DESC');
						while($donnees = $req->fetch()){
							$nom = $donnees['nom'];
							$idLieu = $donnees['idL'];
							$nb = $donnees['count(signlieu.id)'];
							?>

							<p>Nom : <?php echo $nom; ?></p> 
							<p>Nombre de signalement : <?php echo $nb; ?></p>
							<a target="_blank" href="lieu_voir.php?lieu=<?=$idLieu?>">Lien vers la page signalé</a><!-- Lien à ajouté -->

							<form method="post" action="mod_lieu.php">
								<input type="submit" class="form-control btn-outline-primary mb-1 mt-1" value="Traiter" name="traiter"/>
								<input type="hidden" value="<?php echo $idLieu; ?>" name="idcom"/>
							</form>

							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php } ?>
	<?php
	include('footer.php');
	?>
