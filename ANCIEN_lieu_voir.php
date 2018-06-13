<?php include('header.php');

$idlieu = isset($_GET['lieu']) ? $_GET['lieu'] : 'alpha';

if(!is_numeric($idlieu)) {
	echo 'Page non trouvée';
} else {

	$lieu_first_infos_query = $bdd->query('SELECT lieu.nom, lieu.latitude, lieu.longitude, lieu.creation, lieudescription.description as contenu, lieudescription.id as descriptionid, utilisateur.pseudo as auteur, lieudescription.date as lastupdate, utilisateur.id as idauteur FROM lieu
		LEFT JOIN lieudescription ON lieu.id = lieudescription.idlieu
		LEFT JOIN utilisateur ON utilisateur.id = lieudescription.idutilisateur
		WHERE lieu.id = '.$idlieu.'
		ORDER BY lieudescription.date DESC
		LIMIT 1;');
	$lieu_first_infos_query->execute();
	$data = $lieu_first_infos_query->fetch(PDO::FETCH_ASSOC);
	?>
	<div class="card">
		<img class="card-img-top" src="images/700x400.png" alt="Card image cap">
		<div class="card-body">
			<h5 class="card-title"><?=$data['nom']?></h5>
			<span class="text-muted"><?=$data['latitude'].', '.$data['longitude']?></span>
			<p class="card-text">
				<?php
				$lieu_desc = $data['contenu'];
				$lieu_desc = preg_replace('/[*][*][*] (.*?) [*][*][*]/' , '<h3>$1<h3>', $lieu_desc);
				$lieu_desc = preg_replace('/[*][*] (.*?) [*][*]/', '<h2>$1<h2>', $lieu_desc);
				$lieu_desc = preg_replace('/\\[\\[(.*?)[|](.*?)\\]\\]/', '<a href="$1">$2</a>', $lieu_desc);
				echo $lieu_desc;
				?>
			</p>
			<a href="#" class="btn btn-success">1024 <i class="fa fa-thumbs-up" style="font-size: 13px; padding:0;"></i></a>
			<a href="lieu_edit.php?lieu=<?=$idlieu?>" class="btn btn-outline-success">Modifier</a>
			<a href="#" class="btn btn-danger float-right">Signaler <i class="fa fa-bell" style="font-size: 13px; padding:0;"></i></a>
			<div>
				<a href="#" class="float-right text-mu" style="color:red;">Signaler le media<i class="fa fa-bell" style="font-size: 9px; padding:0;"></i></a></div>
				<div class="text-left text-muted">#tag1 #tag2 #tag3</div>
				<div class="text-right text-muted">Dernière modification le <?=$data['lastupdate']?></div>
				<div class="text-right text-muted">Par <?=$data['auteur']?></div>
			</div>
		</div>
		<div id="commentaires">
			<div class="titre">
				<label>Commentaires</label>
			</div>
			<div class="suggestion">

				<p class="descriptionCommentaire">Partagez votre retour d'expérience !</p>
			</div>
			<div class="actionBox">
				<ul class="commentList">
				
				
					
 <!-- code -->
					<?php
					if(isset($_POST['submit_commentaire']) ){
						if(isset($_POST['commentaire']) AND !empty($_POST['commentaire']) ){
								$commentaire = htmlspecialchars($_POST['commentaire']);
				
								$insertion=$bdd->prepare('INSERT INTO `lieucommentaire` (`id`, `idlieu`, `idutilisateur`, `message`, `creation`, `supprime`) VALUES (NULL, ?, ?, ?, NOW(), 0) ');   
								//$a=$_SESSION['id']; //a modifier
								$b=3;
								$insertion->execute(array($_POST['idlieu'],$b,$commentaire));
								$c_msg = '<span style="color:green;"> Votre commentaire a bien été posté .</span>';
								echo $c_msg; //
						}
						else{
							$commenntaire_error ='<span style="color:red;"> ecrire un commentaire .</span>';
							echo $commenntaire_error;//
						}
					}
					
						$lieu_commentaires_query = $bdd->prepare('SELECT utilisateur.pseudo, utilisateur.image,lieucommentaire.message,lieucommentaire.creation  FROM  lieucommentaire INNER JOIN utilisateur ON  utilisateur.id=lieucommentaire.idutilisateur WHERE lieucommentaire.idlieu = ? ORDER BY lieucommentaire.id DESC');		
						$lieu_commentaires_query->execute(array($idlieu)); 
					?>
					
					
					<?php while($lieu_com = $lieu_commentaires_query->fetch()){
					?>
					<li>
						<div class="commenterImage">
							<img width="50px" height="50px" src="<?=$lieu_com['image']?>" />
						</div>
						<div class="commentText" style="width: 100%;">
							<p><span><?=$lieu_com['pseudo']?></span></p>
							<p class="text-muted"><?=$lieu_com['message']?></p> <span class="date sub-text" style="font-size: 9px" ><a href="#" class="btn">12 J'aime <i class="fa fa-thumbs-up" style="font-size: 13px; padding:0;"></i></a>Le <?=$lieu_com['creation']?> par <?=$lieu_com['pseudo']?></span>
							<a href="#" class="float-right" style="color: red; font-size: 9px;">Signaler <i class="fa fa-bell" style="font-size: 9px; padding:0;"></i></a>
						</div>
					</li>
					<?php } ?>	
					
			
			</ul>
				<form class="form-inline" role="form" method="post">
					<div class="form-group">
						<input class="form-control" autocomplete="off" type="text" placeholder="Votre commentaire"   name="commentaire"/>
						<input type="hidden" id="age" name="idlieu" value="<?=$idlieu?>" />
					</div>
					<div class="form-group">
						<input class="btn btn-outline-default" type="submit" value="Commenter" name="submit_commentaire"/>
					</div>
				</form>
 <!-- code -->
				
			</div>
			
		</div>
		<?php
	}

	include('footer.php');

	?>