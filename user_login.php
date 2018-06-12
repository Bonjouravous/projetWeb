<?php
include('headermin.php');
?><!DOCTYPE html>
<html lang="fr">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Se connecter</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="style/bootstrap.min.css">
</head>
<body>
	<style type="text/css">
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

if(isset($_POST['pseudo']) && isset($_POST['pass'])) {
	//  Récupération de l'utilisateur et de son pass hashé
	$req = $bdd->prepare('SELECT id, mdp FROM utilisateur WHERE pseudo = :pseudo');
	$req->execute(array('pseudo' => $_POST['pseudo']));
	$resultat = $req->fetch();

	if (is_bool($resultat) && !$resultat) {
		?>
		<form>
			Mauvais identifiant ou mot de passe
		</form>
		<div class="text-center" style="color:#999;"><a href="user_login.php" style="color:#999;">Réessayer</a></div>
		<?php
	}
	else
	{
		// Comparaison du pass envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($_POST['pass'], $resultat['mdp']);
		if ($isPasswordCorrect) {
			$_SESSION['id'] = $resultat['id'];
			$_SESSION['pseudo'] = $_POST['pseudo'];
			header('Location: index.php');
		}
		else {
			?>
		<form>
			Mauvais identifiant ou mot de passe
		</form>
		<div class="text-center" style="color:#999;"><a href="user_login.php" style="color:#999;">Réessayer</a></div>
			<?php
		}
	}
} else {

?>
		<form action="user_login.php" method="post">
			<h2>Se connecter</h2>
			<p class="hint-text">Connectez vous pour partager de nouveaux lieux !</p>
			<div class="form-group">
				<input type="text" class="form-control" name="pseudo" placeholder="Nom d'utilisateur" required="required">       	
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="pass" placeholder="Mot de passe" required="required">
			</div>       
			<div class="form-group">
				<button type="submit" class="btn btn-success btn-lg btn-block">Se connecter</button>
			</div>
		</form>
		<div class="text-center" style="color:#999;">Vous n'avez pas de compte? <a href="user_signup.php" style="color:#999;">S'enregistrer</a></div>


<?php
}
?>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>