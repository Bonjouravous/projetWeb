<?php include('header.php');

$idlieu = isset($_GET['lieu']) ? (int) $_GET['lieu'] : 'alpha';

if(!is_numeric($idlieu)) {
	echo 'Page non trouvée';
} else {
	$lieu_first_infos_stmt = $bdd->prepare(
		'SELECT A.*, lieudescription.description as contenu, lieudescription.id as descriptionid, lieudescription.date as lastupdate, utilisateur.pseudo as auteur, utilisateur.id as idauteur FROM
		(SELECT
		LL2.avis as hasvote,
		SUM(IF(SIGN(LL1.avis)= 1, LL1.avis, 0)) as cpositif,
		-1 * SUM(IF(SIGN(LL1.avis)= -1, LL1.avis, 0)) as cnegatif,
		lieu.id,
		lieu.nom,
		lieu.latitude,
		lieu.longitude,
		lieu.creation,
		signlieu.id as hassign
		FROM lieu
		LEFT JOIN likelieu as LL1 ON LL1.idlieu = lieu.id
		LEFT JOIN likelieu as LL2 ON LL2.idlieu = lieu.id AND LL2.idutilisateur = ?
		LEFT JOIN signlieu ON signlieu.idlieu = lieu.id AND signlieu.idutilisateur = ?
		WHERE lieu.id = ?
		GROUP BY lieu.id) AS A
		LEFT JOIN lieudescription ON A.id = lieudescription.idlieu
		LEFT JOIN utilisateur ON utilisateur.id = lieudescription.idutilisateur
		ORDER BY lieudescription.date DESC
		LIMIT 1
		;'
	);
	/* Mettre en premier les medias récents ou anciens ? */
	$lieu_medias_stmt = $bdd->prepare(
		'SELECT media FROM lieumedia WHERE idlieu = ? AND supprimer != 1 ORDER BY date DESC;'
	);
	$lieu_motcles_stmt = $bdd->prepare(
		'SELECT motcle.mot FROM motcle, lieumotcle'
		.' WHERE lieumotcle.idlieu = ?'
		.'  AND lieumotcle.idmot = motcle.id'
		.';'
	);
	try {
		$bdd->beginTransaction();
		$lieu_first_infos_stmt->execute(array($_SESSION['id'], $_SESSION['id'], $idlieu));
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
	
	if($lieu_first_infos_fetch['cpositif'] == null) $lieu_first_infos_fetch['cpositif'] = 0;
	if($lieu_first_infos_fetch['cnegatif'] == null) $lieu_first_infos_fetch['cnegatif'] = 0;
	if($lieu_first_infos_fetch['hasvote'] == null) $lieu_first_infos_fetch['hasvote'] = 0;
	$lieu_first_infos_fetch['hassign'] = ($lieu_first_infos_fetch['hassign'] != null);

	$media_dir = 'media';
	?>
	<div class="card">
		<h5 class="card-title m-2"><?=$lieu_first_infos_fetch['nom']?></h5>
		
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<?php
				$est_premier = true;
				$indice = 0;
				foreach ($lieu_medias_fetch as $row) {
					$media = $row ['media'];
					$media_complete_path = $media_dir . '/' . $media;
					if ($est_premier) {
						?>
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<?php
						$est_premier = false;
					}
					else{ 
						$indice = $indice + 1;?>
						<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $indice; ?>"></li>
					<?php } ?>
					<?php }
					?>
				</ol>
				<div class="carousel-inner">
					<?php
					$est_premier = true;
					foreach ($lieu_medias_fetch as $row) {
						$media = $row ['media'];
						$media_complete_path = $media_dir . '/' . $media;
						if ($est_premier) {
							?>
							<div class="carousel-item active">
								<img width="400" height="700" class="d-block w-100" src="<?php echo $media_complete_path ?>" alt="First slide">
							</div>
							<?php
							$est_premier = false;}
							else{ ?>
							<div class="carousel-item">
								<img width="400" height="700" class="d-block w-100" src="<?php echo $media_complete_path ?>" alt="First slide">
							</div>
							<?php } ?>
							<?php }
							?>
						</div>
						<?php if($indice > 0){ ?>

						
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
						<?php } ?>
					</div>
					<div class="card-body">
						<span class="text-muted"><a href="lieu_carte.php#<?=$lieu_first_infos_fetch['latitude'].','.$lieu_first_infos_fetch['longitude']?>,12" title="Voir sur la carte"><?=$lieu_first_infos_fetch['latitude'].', '.$lieu_first_infos_fetch['longitude']?></a></span>
						<p class="card-text">
							<?php
							$lieu_desc = $lieu_first_infos_fetch['contenu'];
							$lieu_desc = preg_replace('/[*][*][*] (.*?) [*][*][*]/' , '<h3>$1</h3>', $lieu_desc);
							$lieu_desc = preg_replace('/[*][*] (.*?) [*][*]/', '<h2>$1</h2>', $lieu_desc);
							$lieu_desc = preg_replace('/\\[\\[(.*?)[|](.*?)\\]\\]/', '<a href="$1">$2</a>', $lieu_desc);
							echo $lieu_desc;
							?>
						</p>
						<a href="" id="btn_l_like_<?=$idlieu?>" class="btn_l_like btn btn-success<?php if($lieu_first_infos_fetch['hasvote'] > 0) echo ' active'; ?>"><span><?=$lieu_first_infos_fetch['cpositif']?></span> <i class="fa fa-thumbs-up" style="font-size: 13px; padding:0;"></i></a>
						<a href="" id="btn_l_dislike_<?=$idlieu?>" class="btn_l_dislike btn btn-success<?php if($lieu_first_infos_fetch['hasvote'] < 0) echo ' active'; ?>"><span><?=$lieu_first_infos_fetch['cnegatif']?></span> <i class="fa fa-thumbs-down" style="font-size: 13px; padding:0;"></i></a>
						<a href="lieu_edit.php?lieu=<?=$idlieu?>" class="btn btn-outline-success">Modifier</a>
						<a href="lieu_media_ajouter.php?lieu=<?=$idlieu?>" class="btn btn-outline-success">Poster une photo</a>
						<div class="text-left text-muted mt-4">
							<?php
							foreach ($lieu_motcles_fetch as $row) {
								echo '#'.$row['mot'].' ';
							}
							?>
						</div>
						<a href="lieu_modifier_motcle.php?lieu=<?=$idlieu?>" class="btn btn-outline-primary mt-4">Modifier les mots-clés</a>
						<div class="text-right text-muted">Dernière modification le <?=$lieu_first_infos_fetch['lastupdate']?>
						</div>
						<div class="text-right text-muted">Par <?=$lieu_first_infos_fetch['auteur']?>
						</div>
						<a href="#" class="float-right<?php if($lieu_first_infos_fetch['hassign']) echo ' invisible'; ?>" style="color: red; font-size: 9px;" id="btn_signal_lieu">Signaler <i class="fa fa-bell" style="font-size: 9px; padding:0;"></i></a>
					</div>
					<div id="commentary" class="actionBox">
						<ul class="commentList">
							<?php
							if(isset($_POST['submit_commentaire']) ){
								if(isset($_POST['commentaire']) AND !empty($_POST['commentaire']) ){
									$commentaire = htmlspecialchars($_POST['commentaire']);
									$insertion=$bdd->prepare('INSERT INTO `lieucommentaire` (`id`, `idlieu`, `idutilisateur`, `message`, `creation`, `supprime`) VALUES (NULL, ?, ?, ?, NOW(), 0) ');   
									$insertion->execute(array($idlieu,$_SESSION['id'],$commentaire));
									$c_msg = '<span style="color:green;"> Votre commentaire a bien été posté .</span>';
                            echo $c_msg; //
                        }
                        else{
                        	$commenntaire_error ='<span style="color:red;"> ecrire un commentaire .</span>';
                            echo $commenntaire_error;//
                        }
                    }

                    $lieu_commentaires_query = $bdd->prepare('SELECT LC2.avis as hasvote,
                    	signcommentaire.id as hassign,
                    	SUM(IF(SIGN(LC1.avis)= 1, LC1.avis, 0)) as cpositif, -1*SUM(IF(SIGN(LC1.avis)= -1, LC1.avis, 0)) as cnegatif, utilisateur.pseudo, utilisateur.image, lieucommentaire.message, lieucommentaire.creation, lieucommentaire.id FROM lieucommentaire
                    	JOIN utilisateur ON utilisateur.id=lieucommentaire.idutilisateur
                    	LEFT JOIN likecommentaire as LC1 ON LC1.idcommentaire = lieucommentaire.id
                    	LEFT JOIN likecommentaire as LC2 ON LC2.idcommentaire = lieucommentaire.id AND LC2.idutilisateur = ?
                    	LEFT JOIN signcommentaire ON signcommentaire.idcommentaire = lieucommentaire.id AND signcommentaire.idutilisateur = ?
                    	WHERE lieucommentaire.idlieu = ? AND lieucommentaire.supprime = 0
                    	GROUP BY lieucommentaire.id
                    	ORDER BY lieucommentaire.creation DESC LIMIT 0,100');
                    $lieu_commentaires_query->execute(array($_SESSION['id'], $_SESSION['id'], $idlieu)); 
                    ?>


                    <?php while($lieu_com = $lieu_commentaires_query->fetch()){

                    	$date = new DateTime($lieu_com['creation']);
                    	$lieu_com['cpositif'] = ($lieu_com['cpositif'] == null) ? 0 : $lieu_com['cpositif'];
                    	$lieu_com['cnegatif'] = ($lieu_com['cnegatif'] == null) ? 0 : $lieu_com['cnegatif'];
                    	$lieu_com['hasvote'] = ($lieu_com['hasvote'] == null) ? 0 : $lieu_com['hasvote'];
                    	$lieu_com['hassign'] = ($lieu_com['hassign'] != null);
                    	?>
                    	<li>
                    		<div class="commenterImage">
                    			<img src="<?=$lieu_com['image']?>" />
                    		</div>
                    		<div class="commentText" >
                    			<p><span><?= $lieu_com['pseudo'] ?></span></p>
                    			<p class="text-muted">
                    				<style type="text/css">
                    				#text-muted img{
                    					position: relative;
                    					top:2px;
                    				}
                    			</style>
                    			<?php
                    			$emoji_replace = array(':)', ':-)', '(angry)', ':3', ":'(", ':|', ':(', ':-(', ';)', ';-)', ' euh');
                    			$emoji_new = array('<img src="images/emojis/emo_smile.png" />','<img src="images/emojis/emo_smile.png" />','<img src="images/emojis/emo_angry.png" />','<img src="images/emojis/emo_cat.png" />','<img src="images/emojis/emo_cry.png" />','<img src="images/emojis/emo_noreaction.png" />','<img src="images/emojis/emo_sad.png" />','<img src="images/emojis/emo_sad.png" />','<img src="images/emojis/emo_wink.png" />','<img src="images/emojis/emo_wink.png" />','<img src="images/emojis/euh.gif" />');
                    			$lieu_com['message']=str_replace($emoji_replace, $emoji_new, $lieu_com['message']);
                    			?>
                    			<?=$lieu_com['message']?>
                    		</p>
                    		<span class="date sub-text" style="font-size: 9px" >
                    			<a href="" id="btn_like_<?=$lieu_com['id']?>" class="btn_like btn<?php if($lieu_com['hasvote'] > 0) echo ' active'; ?>"><span><?=$lieu_com['cpositif']?></span> J'aime <i class="fa fa-thumbs-up" style="font-size: 13px; padding:0;"></i></a>
                    			<a href="" id="btn_dislike_<?=$lieu_com['id']?>" class="btn_dislike btn<?php if($lieu_com['hasvote'] < 0) echo ' active'; ?>"><span><?=$lieu_com['cnegatif']?></span> J'aime Pas <i class="fa fa-thumbs-down" style="font-size: 13px; padding:0;"></i></a>
                    			Le <?=$date->format('d/m/Y à H:i:s')?>
                    		</span>
                    		<a href="#" class="btn_sign float-right<?php if($lieu_com['hassign']) echo ' invisible '; ?>" id="btn_sign_<?=$lieu_com['id']?>" style="color: red; font-size: 9px;">Signaler <i class="fa fa-bell" style="font-size: 9px; padding:0;"></i></a>

                    	</div>
                    </li>
                    <?php } ?>
                </ul>
                <form class="form-inline" role="form" method="POST" action="lieu_voir.php?lieu=<?=$idlieu?>#commentary">
                	<div class="form-group">
                		<input autocomplete="off" class="form-control" type="text" placeholder="Votre commentaire" name="commentaire" />
                	</div>
                	<div class="form-group">
                		<input class="btn btn-outline-default" type="submit" value="Commenter" name="submit_commentaire"/>
                	</div>
                </form>
            </div>
        </div>

        <style>
        .active{
        	pointer-events: none;
        	cursor: default;
        	text-decoration: none;
        	color: #d3d3d3;
        }
    </style>

    <script>

    	$('.btn_sign').click(function(e) {
    		var id = $(e.currentTarget).attr('id');
    		id = id.substr(9);
    		$.ajax({
			   url : 'signalement.php', // La ressource ciblée
			   type : 'GET', // Le type de la requête HTTP.
			   data : 'type=commentaire&idtype=' + id,
			   success : function(htmlcode, statut) {
			   	$('#btn_sign_'+id).addClass('invisible');
			   	$('#btn_sign_'+id).off('click');
			   }
			});
    		return false;
    	});

    	$('#btn_signal_lieu').click(function(e) {
    		var id = <?=$idlieu?>;
    		$.ajax({
			   url : 'signalement.php', // La ressource ciblée
			   type : 'GET', // Le type de la requête HTTP.
			   data : 'type=lieu&idtype=' + id,
			   success : function(htmlcode, statut) {
			   	$('#btn_signal_lieu').addClass('invisible');
			   	$('#btn_signal_lieu').off('click');
			   }
			});
    		return false;
    	});

    	$('.btn_l_like').click(function(e) {
    		var currenttarget = $(e.currentTarget);
    		var id = currenttarget.attr('id');
    		id = id.substr(11);

    		addlike(1, 'lieu', id, function(htmlcode, statut) {
    			if($('#btn_l_like_'+id).hasClass('active')) {
    				$('#btn_l_like_'+id+' span').first().html(parseInt($('#btn_l_like_'+id+' span').first().html()) - 1);
    				$('#btn_l_like_'+id).removeClass('active');
    			}
    			if($('#btn_l_dislike_'+id).hasClass('active')) {
    				$('#btn_l_dislike_'+id+' span').first().html(parseInt($('#btn_l_dislike_'+id+' span').first().html()) - 1);
    				$('#btn_l_dislike_'+id).removeClass('active');
    			}
    			htmlcode = parseInt(htmlcode);
    			if(htmlcode == 1) {
    				$('#btn_l_like_'+id).addClass('active');
    				$('#btn_l_like_'+id+' span').first().html(parseInt($('#btn_l_like_'+id+' span').first().html()) + 1);
    			}

    		});

    		return false;
    	});

    	$('.btn_l_dislike').click(function(e) {
    		var currenttarget = $(e.currentTarget);
    		var id = currenttarget.attr('id');
    		id = id.substr(14);

    		addlike(-1, 'lieu', id, function(htmlcode, statut) {
    			if($('#btn_l_like_'+id).hasClass('active')) {
    				$('#btn_l_like_'+id+' span').first().html(parseInt($('#btn_l_like_'+id+' span').first().html()) - 1);
    				$('#btn_l_like_'+id).removeClass('active');
    			}
    			if($('#btn_l_dislike_'+id).hasClass('active')) {
    				$('#btn_l_dislike_'+id+' span').first().html(parseInt($('#btn_l_dislike_'+id+' span').first().html()) - 1);
    				$('#btn_l_dislike_'+id).removeClass('active');
    			}
    			htmlcode = parseInt(htmlcode);
    			if(htmlcode == -1) {
    				$('#btn_l_dislike_'+id).addClass('active');
    				$('#btn_l_dislike_'+id+' span').first().html(parseInt($('#btn_l_dislike_'+id+' span').first().html()) + 1);
    			}

    		});

    		return false;
    	});

    	$('.btn_like').click(function(e) {
    		var currenttarget = $(e.currentTarget);
    		var id = currenttarget.attr('id');
    		id = id.substr(9);

    		addlike(1, 'commentaire', id, function(htmlcode, statut) {
    			if($('#btn_like_'+id).hasClass('active')) {
    				$('#btn_like_'+id+' span').first().html(parseInt($('#btn_like_'+id+' span').first().html()) - 1);
    				$('#btn_like_'+id).removeClass('active');
    			}
    			if($('#btn_dislike_'+id).hasClass('active')) {
    				$('#btn_dislike_'+id+' span').first().html(parseInt($('#btn_dislike_'+id+' span').first().html()) - 1);
    				$('#btn_dislike_'+id).removeClass('active');
    			}
    			htmlcode = parseInt(htmlcode);
    			if(htmlcode == 1) {
    				$('#btn_like_'+id).addClass('active');
    				$('#btn_like_'+id+' span').first().html(parseInt($('#btn_like_'+id+' span').first().html()) + 1);
    			}

    		});

    		return false;
    	});

    	$('.btn_dislike').click(function(e) {
    		var currenttarget = $(e.currentTarget);
    		var id = currenttarget.attr('id');
    		id = id.substr(12);

    		addlike(-1, 'commentaire', id, function(htmlcode, statut) {
    			if($('#btn_like_'+id).hasClass('active')) {
    				$('#btn_like_'+id+' span').first().html(parseInt($('#btn_like_'+id+' span').first().html()) - 1);
    				$('#btn_like_'+id).removeClass('active');
    			}
    			if($('#btn_dislike_'+id).hasClass('active')) {
    				$('#btn_dislike_'+id+' span').first().html(parseInt($('#btn_dislike_'+id+' span').first().html()) - 1);
    				$('#btn_dislike_'+id).removeClass('active');
    			}
    			htmlcode = parseInt(htmlcode);
    			if(htmlcode == -1) {
    				$('#btn_dislike_'+id).addClass('active');
    				$('#btn_dislike_'+id+' span').first().html(parseInt($('#btn_dislike_'+id+' span').first().html()) + 1);
    			}

    		});

    		return false;
    	});


    	function addlike(like, type, id, callback) {
    		$.ajax({
			   url : 'like.php', // La ressource ciblée
			   type : 'GET', // Le type de la requête HTTP.
			   data : 'type=' + type + '&like=' + like + '&idtype=' + id,
			   success : callback
			});
    	}

    </script>
    <?php
}

include('footer.php');

?>