 <?php include('header.php');

$req = $bdd->prepare('SELECT id,pseudo, description, image FROM utilisateur WHERE pseudo = ?');
$req->execute(array($_GET['username']));
$donnees = $req->fetch();
?>
 		<div class="card text-center">
 			<div class="card-header">
 				<ul class="nav nav-tabs card-header-tabs">
 					<li class="nav-item">
 						<a class="nav-link active" href="user_profil.php">Profil</a>
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

                    			$grade_commentaire_query = $bdd->prepare('select count(id)as nb from lieucommentaire where lieucommentaire.idutilisateur=?');
                    			$grade_commentaire_query->execute(array($donnees['id'] ));
                    			$grade_commentaire = $grade_commentaire_query->fetch(); 
            
                    			if($grade_commentaire['nb']>=1 && $grade_commentaire['nb']<5){
                    				$badge_commentaire='Tchatteur timide';
                    			}
                    			elseif ($grade_commentaire['nb']>=5 AND $grade_commentaire['nb']<10) {
                    				$badge_commentaire='Tchatteur actif';
                    			}
                    			elseif($grade_commentaire['nb']>=10){
                    				$badge_commentaire='Tchateur sans limite';
                    			}


                    			$grade_likeDonnes_query = $bdd->prepare('select count(id) as nb from likecommentaire where likecommentaire.idutilisateur=?');
                    			$grade_likeDonnes_query->execute(array($donnees['id']));
                    			$grade_likeDonnes= $grade_likeDonnes_query->fetch(); 

                    			if($grade_likeDonnes['nb']>=1 && $grade_likeDonnes['nb']<5){
                    				$badge_likeDonnes='aime un peu';
                    			}
                    			elseif ($grade_likeDonnes['nb']>=5 AND $grade_likeDonnes['nb']<10) {
                    				$badge_likeDonnes='aime beaucoup';
                    			}
                    			elseif($grade_likeDonnes['nb']>=10){
                    				$badge_likeDonnes='aime passionement';
                    			}
						?>
								<span style="color:green;"><?=$badge_commentaire?></span></br>
								<span style="color:green;"><?=$badge_likeDonnes?></span>
								
				
				
<!--  				<a href="#" class="btn btn-outline-success">Voir tout les postes</a>recherche avec comme attribut le nom de l'auteur --> 
 			</div>
 	</div>
	
 <?php include('footer.php'); ?>
