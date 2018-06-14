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
						<a class="nav-link" href="mod_lieu.php">Signalements lieux</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="mod_com.php">Signalements commentaires</a>
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
				<h5 class="card-title text-left">Commentaires ayant été signalé </h5>
				<div class="card-text">
					<div id="gestion_com">
						<?php
						$req = $bdd->query('SELECT count(signcommentaire.id), lieucommentaire.message, lieucommentaire.id, utilisateur.pseudo FROM lieucommentaire
							JOIN signcommentaire ON lieucommentaire.id = signcommentaire.idcommentaire
							JOIN utilisateur ON utilisateur.id = lieucommentaire.idutilisateur
							WHERE signcommentaire.traite = 0 AND lieucommentaire.supprime = 0
							GROUP BY lieucommentaire.id
							ORDER BY count(signcommentaire.id) DESC');
						while($donnees = $req->fetch()){
							$pseudo = $donnees['pseudo'];
							$commentaire = $donnees['message'];
							$idcom = $donnees['id'];
							$nb = $donnees['count(signcommentaire.id)'];
							?>
							<p>Pseudo : <?php echo$pseudo ?></p>
							<p>Nombre de signalement : <?php echo$nb ?></p>
							<p>Commentaire : <?php echo$commentaire?></p>

							<form method="post" action="mod_com.php">
								<input type="submit" class="form-control btn-outline-primary mb-1 mt-1" value="Garder" name="garder"/>
								<input type="submit" class="form-control btn-outline-danger mb-1 mt-1" value="Supprimer" name="supprimer"/>
								<input type="hidden" value="<?php echo $idcom; ?>" name="idcom"/>
								
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
