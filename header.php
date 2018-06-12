<?php
session_start();
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Le nom de notre super site</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
	.banner {

		height: 150px;
		background: url(/images/agriculture-beautiful-view-city-park-1080722.jpg) center center no-repeat;
		background-size: cover;
		color: whitesmoke;


	}
	.fa {
		padding: 10px;
		font-size: 30px;
		text-decoration: none;
		margin: 5px;
		border-radius: 50%;
	}

	.fa:hover {
		opacity: 0.7;
	}
	.fa-twitter {
		background: #55ACEE;
		color: white;
	}
	.fa-snapchat-ghost {
		background: #fffc00;
		color: white;
		text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
	}
	.fa-instagram {
		background: #125688;
		color: white;
	}
	.detailBox {
    width:320px;
    border:1px solid #bbb;
    margin:50px;
}
.titre {
    padding:10px;
}
.titre label{
  margin:0;
  display:inline-block;
}

.suggestion {
    padding:10px;
    border-top:1px dotted #bbb;
}
.suggestion .form-group:first-child, .actionBox .form-group:first-child {
    width:80%;
}
.suggestion .form-group:nth-child(2), .actionBox .form-group:nth-child(2) {
    width:18%;
}
.actionBox .form-group * {
    width:100%;
}
.descriptionCommentaire {
    margin-top:10px 0;
}
.commentList {
    padding:0;
    list-style:none;
    max-height:200px;
    overflow:auto;
}
.commentList li {
    margin:0;
    margin-top:10px;
}
.commentList li > div {
    display:table-cell;
}
.commenterImage {
    width:30px;
    margin-right:5px;
    height:100%;
    float:left;
}
.commenterImage img {
    width:100%;
    border-radius:50%;
}
.commentText p {
    margin:0;
}
.sub-text {
    color:#aaa;
    font-family:verdana;
    font-size:11px;
}
.actionBox {
    border-top:1px dotted #bbb;
    padding:10px;
}
</style>
</head>
<body>
	<header>
		<div class="banner">
		</div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 2%">
			<a class="navbar-brand" href="index.html">Notre Super Nom de Site</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="#">Les lieux</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Autour de moi</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="formulaireContact.php">Contact</a>
					</li>
						<?php 
						if (!isset($_SESSION['id']) AND !isset($_SESSION['pseudo']))
						{
							echo '<li class="nav-item"><a class="nav-link" href="login.php">Se connecter</a></li>';
						}
						else
						{
							echo '<li class="nav-item"><a class="nav-link" href="#">Publier un lieu</a></li>';
							echo '<li class="nav-item"><a class="nav-link" href="profil.php">Mon profil</a></li>';
							echo '<li class="nav-item"><a class="nav-link" href="signOut.php">Se deconnecter</a></li>';
						}
						?>
					
				</ul>
				<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="text" placeholder="Recherche d'un lieu" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
				</form>
			</div>
		</nav>
	</header>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>