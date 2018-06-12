 <?php include('header.php');

$req = $bdd->prepare('SELECT pseudo, description, image FROM utilisateur WHERE pseudo = ?');
$req->execute(array($_GET['username']));
$donnees = $req->fetch();
?>
 		<div class="card text-center">
 			<div class="card-header">
 				<ul class="nav nav-tabs card-header-tabs">
 					<li class="nav-item">
 						<a class="nav-link active" href="user_profil.php">Profil</a>
 					</li>
 					<li class="nav-item">
 						<a class="nav-link" href="user_editprofil.php">Editer mon profil</a>
 					</li>
 				</ul>
 			</div>
 			<div class="card-body">
 				<img height="200" width="200" src="<?php echo $donnees['image']; ?>" class="img-thumbnail mb-3">
 				<h5 class="card-title"><?php echo $donnees['pseudo']; ?></h5>
 				<p class="card-text"><?php echo $donnees['description']; ?></p>
<!--  				<a href="#" class="btn btn-outline-success">Voir tout les postes</a>recherche avec comme attribut le nom de l'auteur --> 
 			</div>
 	</div>
	
 <?php include('footer.php'); ?>
