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
 					<li>
 						<div class="commenterImage">
 							<img src="https://dummyimage.com/50x50/d3d3d3/fff" />
 						</div>
 						<div class="commentText" >
 							<p><span>NomDeL'Auteur</span></p>
 							<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio neque voluptas expedita obcaecati blanditiis distinctio numquam libero est placeat laborum repellendus consequatur, odit veniam corporis rerum iure commodi minus sunt.</p> <span class="date sub-text" style="font-size: 9px" ><a href="#" class="btn">12 J'aime <i class="fa fa-thumbs-up" style="font-size: 13px; padding:0;"></i></a>Le 11/06/2018</span>

 						</div>
 					</li>
 					<li>
 						<div class="commenterImage">
 							<img src="https://dummyimage.com/50x50/d3d3d3/fff" />
 						</div>
 						<div class="commentText" >
 							<p><span>NomDeL'Auteur</span></p>
 							<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio neque voluptas expedita obcaecati blanditiis distinctio numquam libero est placeat laborum repellendus consequatur, odit veniam corporis rerum iure commodi minus sunt.</p> <span class="date sub-text" style="font-size: 9px" ><a href="#" class="btn">12 J'aime <i class="fa fa-thumbs-up" style="font-size: 13px; padding:0;"></i></a>Le 11/06/2018</span>

 						</div>
 					</li>
 					<li>
 						<div class="commenterImage">
 							<img src="https://dummyimage.com/50x50/d3d3d3/fff" />
 						</div>
 						<div class="commentText" >
 							<p><span>NomDeL'Auteur</span></p>
 							<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio neque voluptas expedita obcaecati blanditiis distinctio numquam libero est placeat laborum repellendus consequatur, odit veniam corporis rerum iure commodi minus sunt.</p> <span class="date sub-text" style="font-size: 9px" ><a href="#" class="btn">12 J'aime <i class="fa fa-thumbs-up" style="font-size: 13px; padding:0;"></i></a>Le 11/06/2018</span>

 						</div>
 					</li>
 					<li>
 						<div class="commenterImage">
 							<img src="https://dummyimage.com/50x50/d3d3d3/fff" />
 						</div>
 						<div class="commentText" >
 							<p><span>NomDeL'Auteur</span></p>
 							<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio neque voluptas expedita obcaecati blanditiis distinctio numquam libero est placeat laborum repellendus consequatur, odit veniam corporis rerum iure commodi minus sunt.</p> <span class="date sub-text" style="font-size: 9px" ><a href="#" class="btn">12 J'aime <i class="fa fa-thumbs-up" style="font-size: 13px; padding:0;"></i></a>Le 11/06/2018</span>

 						</div>
 					</li>
 					<li>
 						<div class="commenterImage">
 							<img src="https://dummyimage.com/50x50/d3d3d3/fff" />
 						</div>
 						<div class="commentText" >
 							<p><span>NomDeL'Auteur</span></p>
 							<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio neque voluptas expedita obcaecati blanditiis distinctio numquam libero est placeat laborum repellendus consequatur, odit veniam corporis rerum iure commodi minus sunt.</p> <span class="date sub-text" style="font-size: 9px" ><a href="#" class="btn">12 J'aime <i class="fa fa-thumbs-up" style="font-size: 13px; padding:0;"></i></a>Le 11/06/2018</span>

 						</div>
 					</li>
 				</ul>
 				<form class="form-inline" role="form">
 					<div class="form-group">
 						<input class="form-control" type="text" placeholder="Votre commentaire" />
 					</div>
 					<div class="form-group">
 						<button class="btn btn-outline-default">Commenter</button>
 					</div>
 				</form>
 			</div>
 		</div>
<?php
}

include('footer.php');

?>