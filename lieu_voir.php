<?php include('header.php');

$idlieu = isset($_GET['lieu']) ? (int) $_GET['lieu'] : 'alpha';

if(!is_numeric($idlieu)) {
	echo 'Page non trouvée';
} else {
	$lieu_first_infos_stmt = $bdd->prepare(
		'SELECT lieu.nom, lieu.latitude, lieu.longitude, lieu.creation, lieudescription.description as contenu, lieudescription.id as descriptionid, utilisateur.pseudo as auteur, lieudescription.date as lastupdate, utilisateur.id as idauteur FROM lieu
			LEFT JOIN lieudescription ON lieu.id = lieudescription.idlieu
			LEFT JOIN utilisateur ON utilisateur.id = lieudescription.idutilisateur
			WHERE lieu.id = ?
			ORDER BY lieudescription.date DESC
			LIMIT 1
		;'
	);
	/* Mettre en premier les medias récents ou anciens ? */
	$lieu_medias_stmt = $bdd->prepare(
		'SELECT media FROM media WHERE idlieu = ? AND supprimer != 1 ORDER BY date ASC;'
	);
	$lieu_motcles_stmt = $bdd->prepare(
		'SELECT motcle.mot FROM motcle, lieumotcle'
		.' WHERE lieumotcle.idlieu = ?'
		.'  AND lieumotcle.idmot = motcle.id'
		.';'
	);
	try {
		$bdd->beginTransaction();
		$lieu_first_infos_stmt->execute(array($idlieu));
		$lieu_medias_stmt->execute(array($idlieu));
		$lieu_motcles_stmt->execute(array($idlieu));
		$bdd->commit();
	} catch (PDOException $e) {
		$bdd->rollback();
		echo '<p>'.$e->getMessage().'</p>';
	}

	$lieu_first_infos_fetch = $lieu_first_infos_stmt->fetch(PDO::FETCH_ASSOC);
	$lieu_medias_fetch = $lieu_medias_stmt->fetchAll(PDO::FETCH_ASSOC);
	$lieu_motcles_fetch = $lieu_motcles_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
 	<div class="card">
 		<img class="card-img-top" src="images/700x400.png" alt="Card image cap">
 		<div class="card-body">
 			<h5 class="card-title"><?=$lieu_first_infos_fetch['nom']?></h5>
 			<span class="text-muted"><?=$lieu_first_infos_fetch['latitude'].', '.$lieu_first_infos_fetch['longitude']?></span>
 			<p class="card-text">
				<?php
				$lieu_desc = $lieu_first_infos_fetch['contenu'];
				$lieu_desc = preg_replace('/[*][*][*] (.*?) [*][*][*]/' , '<h3>$1</h3>', $lieu_desc);
				$lieu_desc = preg_replace('/[*][*] (.*?) [*][*]/', '<h2>$1</h2>', $lieu_desc);
				$lieu_desc = preg_replace('/\\[\\[(.*?)[|](.*?)\\]\\]/', '<a href="$1">$2</a>', $lieu_desc);
				echo $lieu_desc;
				?>
			</p>
			<a href="#" class="btn btn-success">1024 <i class="fa fa-thumbs-up" style="font-size: 13px; padding:0;"></i></a>
			<a href="lieu_edit.php?lieu=<?=$idlieu?>" class="btn btn-outline-success">Modifier</a>
			<div class="text-left text-muted">
				<?php
					foreach ($lieu_motcles_fetch as $row) {
						echo '#'.$row['mot'].' ';
					}
				?>
			</div>
			<div class="text-right text-muted">Dernière modification le <?=$lieu_first_infos_fetch['lastupdate']?></div>
			<div class="text-right text-muted">Par <?=$lieu_first_infos_fetch['auteur']?></div>
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