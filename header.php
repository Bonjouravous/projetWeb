<?php
include_once('headermin.php');


?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Let’s Discover</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<link rel="stylesheet" href="style/font-awesome.min.css">
	<link rel="stylesheet" href="style/style.css">
	
</head>
<body>
	<header>
		<div class="banner">
		</div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 2%">
			<a class="navbar-brand" href="index.php">Let’s Discover</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="page_contact.php">Contact</a>
					</li>
						<?php 
						if (!isset($_SESSION['id']) AND !isset($_SESSION['pseudo']))
						{
							echo '<li class="nav-item"><a class="nav-link" href="user_login.php">Se connecter</a></li>';
						}
						if (isConnected())
						{
							echo '<li class="nav-item"><a class="nav-link" href="#">Publier un lieu</a></li>';
							echo '<li class="nav-item"><a class="nav-link" href="user_profil.php'.'?username='.$_SESSION['pseudo'].'">Mon profil</a></li>';
							echo '<li class="nav-item"><a class="nav-link" href="user_signout.php">Se deconnecter</a></li>';
						}
						if (isMod()){
							echo '<li class="nav-item"><a class="nav-link" href="admin.php">Moderation</a></li>';
						}
						?>
					
				</ul>
				<div class="form-inline my-2 my-lg-0">
					<a class="btn btn-outline-success my-2 my-sm-0" href="recherche_localisation.php">Autour de moi</a>
				</div>
			</div>
		</nav>
	</header>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	
<div class="container">
