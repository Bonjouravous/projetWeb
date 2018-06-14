 <?php include('header.php');

$req = $bdd->prepare('SELECT id,pseudo, description, image FROM utilisateur WHERE pseudo = ?');
$req->execute(array($_GET['username']));
$donnees = $req->fetch();
?>
 		<div class="card text-center">
 			<div class="card-header">
 				<ul class="nav nav-tabs card-header-tabs">
 					<li class="nav-item">
 						<a class="nav-link active" href="user_profil.php?username=<?=$_SESSION['pseudo']?>">Profil</a>
 					</li>
 					<?php 
 					if($_GET['username'] == $_SESSION['pseudo']){
 						echo 
 					'<li class="nav-item">
 						<a class="nav-link" href="user_editprofil.php?username='.$_SESSION['pseudo'].'">Editer mon profil</a>
 					</li>';
 				}
 					?>
 				</ul>
 			</div>
 			<div class="card-body">
 				<img height="200" width="200" src="<?php echo $donnees['image']; ?>" class="img-thumbnail mb-3" alt="photo de profil">
 				<h5 class="card-title"><?php echo $donnees['pseudo']; ?></h5>
 				<p class="card-text"><?php echo $donnees['description']; ?></p>
				
						<?php
                    			$badge_commentaire;
                    			$badge_likeDonnes;

                    			$grade_commentaire_query = $bdd->prepare('select count(id) as nb from lieucommentaire where lieucommentaire.idutilisateur=?');
                    			$grade_commentaire_query->execute(array($donnees['id'] ));
                    			$gd = $grade_commentaire_query->fetch(); 
								
								if($gd['nb'] >= 10) {
									$badge_commentaire = 'Tchatcheur sans limite'; 
								} else if($gd['nb'] >= 5) {
									$badge_commentaire = 'Tchatteur actif';
								} else if($gd['nb'] > 0) {
									$badge_commentaire = 'Tchatteur timide';
								} else {
									$badge_commentaire = '';
								}

                    			$grade_likeDonnes_query = $bdd->prepare('select count(id) as nb from likecommentaire where likecommentaire.idutilisateur=?');
                    			$grade_likeDonnes_query->execute(array($donnees['id']));
                    			$gld= $grade_likeDonnes_query->fetch(); 
								
								if($gld['nb'] >= 10) {
									$badge_likeDonnes='Aime Passionement';
								} else if($gld['nb'] >= 5) {
									$badge_likeDonnes='Aime Beaucoup';
								} else if($gld['nb'] > 0) {
									$badge_likeDonnes='Aime un peu';
								} else {
									$badge_likeDonnes='';
								}
						?>
								<span style="color:green;"><?=$badge_commentaire?></span></br>
								<span style="color:green;"><?=$badge_likeDonnes?></span>
								
				
				
<!--  				<a href="#" class="btn btn-outline-success">Voir tout les postes</a>recherche avec comme attribut le nom de l'auteur --> 
 			</div>
 	</div>
	
 <?php include('footer.php'); ?>
