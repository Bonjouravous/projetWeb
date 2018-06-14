<?php
include('headermin.php');
?><!DOCTYPE html>
<html lang="fr">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Récupération mot de passe</title>
	<link rel="icon" href="images/icone.png" />

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<style>
	body{
		color: #fff;
		background: white;
		font-family: 'Roboto', sans-serif;
	}
	.form-control{
		height: 40px;
		box-shadow: none;
		color: #969fa4;
	}
	.form-control:focus{
		border-color: #5cb85c;
	}
	.form-control, .btn{        
		border-radius: 3px;
	}
	.login-form{
		width: 400px;
		margin: 0 auto;
		padding: 30px 0;
	}
	.login-form h2{
		color: #636363;
		margin: 0 0 15px;
		position: relative;
		text-align: center;
	}
	.login-form h2:before, .login-form h2:after{
		content: "";
		height: 2px;
		width: 20%;
		background: #d4d4d4;
		position: absolute;
		top: 50%;
		z-index: 2;
	}	
	.login-form h2:before{
		left: 0;
	}
	.login-form h2:after{
		right: 0;
	}
	.login-form .hint-text{
		color: #999;
		margin-bottom: 30px;
		text-align: center;
	}
	.login-form form{
		color: #999;
		border-radius: 3px;
		margin-bottom: 15px;
		background: #f2f3f7;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		padding: 30px;
	}
	.login-form .form-group{
		margin-bottom: 20px;
	}
	.login-form input[type="checkbox"]{
		margin-top: 3px;
	}
	.login-form .btn{        
		font-size: 16px;
		font-weight: bold;		
		min-width: 140px;
		outline: none !important;
	}
	.login-form .row div:first-child{
		padding-right: 10px;
	}
	.login-form .row div:last-child{
		padding-left: 10px;
	}    	
	.login-form a{
		color: #fff;
		text-decoration: underline;
	}
	.login-form a:hover{
		text-decoration: none;
	}
	.login-form form a{
		color: #5cb85c;
		text-decoration: none;
	}	
	.login-form form a:hover{
		text-decoration: underline;
	}  
</style>
</head>
<body>
	<div class="login-form">
	<?php
	if(isset($_POST['mail'])) {
		$mail = $_POST['mail'];
		$req = $bdd->prepare("SELECT id, mail FROM utilisateur WHERE mail=?"); 
		$req->execute(array($mail));
		$data = $req->fetch();
		
		if(!$data) {
			?>
			<form>
				<h2>Erreur</h2>
				<p class="hint-text">Adresse email introuvable! Veuillez réessayer.</p>
			</form>
			<div class="text-center" style="color:#999;"><a href="mdp_recuperation.php" style="color:#999;">Réessayer</a></div>
			<div class="text-center" style="color:#999;"><a href="user_login.php" style="color:#999;">Se connecter</a></div>
			<?php
		} else {
			$generatedcode ="";
			for($i=0;$i<8;$i++)
			{
				$generatedcode .= mt_rand(0,9);
			}
			
			$idutilisateur = $data['id'];
			$requete = $bdd-> prepare('INSERT INTO resetmdp VALUES(NULL, ?, ?)');
			$requete ->execute(array($idutilisateur, $generatedcode));
			?>
			<form>
				<h2>Envoi</h2>
				<p class="hint-text">Un mail avez demandé une réinitialisation de votre mot de passe. Cliquez sur ce lien <a href="mdp_traitement.php?code=<?=$generatedcode?>">mdp_traitement.php?code=<?=$generatedcode?></a> pour réinitialiser votre mot de passe.</p>
			</form>
			<?php
		}
		
	} else {
	?>
		<form method="post" action="mdp_recuperation.php">
			<h2>Réinitialiser</h2>
			<p class="hint-text">Entrez votre adresse mail pour réinitialiser votre mot de passe</p>
			<div class="form-group">
				<input type="email" class="form-control" name="mail" placeholder="Votre adresse mail" required />				
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success btn-lg btn-block">Réinitialiser</button>
			</div>
		</form>
		<div class="text-center" style="color:#999;"><a href="user_login.php" style="color:#999;">Se connecter</a></div>
	<?php } ?>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>