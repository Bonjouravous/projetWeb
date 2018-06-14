<?php
include('headermin.php');
?><!DOCTYPE html>
<html lang="fr">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>S'inscrire</title>

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
	.signup-form{
		width: 400px;
		margin: 0 auto;
		padding: 30px 0;
	}
	.signup-form h2{
		color: #636363;
		margin: 0 0 15px;
		position: relative;
		text-align: center;
	}
	.signup-form h2:before, .signup-form h2:after{
		content: "";
		height: 2px;
		width: 20%;
		background: #d4d4d4;
		position: absolute;
		top: 50%;
		z-index: 2;
	}	
	.signup-form h2:before{
		left: 0;
	}
	.signup-form h2:after{
		right: 0;
	}
	.signup-form .hint-text{
		color: #999;
		margin-bottom: 30px;
		text-align: center;
	}
	.signup-form form{
		color: #999;
		border-radius: 3px;
		margin-bottom: 15px;
		background: #f2f3f7;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		padding: 30px;
	}
	.signup-form .form-group{
		margin-bottom: 20px;
	}
	.signup-form input[type="checkbox"]{
		margin-top: 3px;
	}
	.signup-form .btn{        
		font-size: 16px;
		font-weight: bold;		
		min-width: 140px;
		outline: none !important;
	}
	.signup-form .row div:first-child{
		padding-right: 10px;
	}
	.signup-form .row div:last-child{
		padding-left: 10px;
	}    	
	.signup-form a{
		color: #fff;
		text-decoration: underline;
	}
	.signup-form a:hover{
		text-decoration: none;
	}
	.signup-form form a{
		color: #5cb85c;
		text-decoration: none;
	}	
	.signup-form form a:hover{
		text-decoration: underline;
	}  
</style>
</head>
<body>
	<div class="signup-form">
		<?php
		if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['pass'])) {
			$requete = $bdd->prepare('SELECT pseudo from utilisateur WHERE pseudo = :pseudo');
			$requete->execute(array('pseudo' => $_POST['pseudo']));
			$rep = $requete->fetch();
			$requete2 = $bdd->prepare('SELECT pseudo from utilisateur WHERE mail = :email');
			$requete2->execute(array('email' => $_POST['email']));
			$rep2 = $requete2->fetch();
			if($rep){
				echo '		<form>
				Cet utilisateur existe déjà !
				</form>
				<div class="text-center" style="color:#999;"><a href="user_signup.php" style="color:#999;">Réessayer</a></div>';
			}
			if($rep2){
				echo '		<form>
				Cet e-mail est déjà utilisé !
				</form>
				<div class="text-center" style="color:#999;"><a href="user_signup.php" style="color:#999;">Réessayer</a></div>';
			}
			else{
				$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);

	// Insertion
				$req = $bdd->prepare('INSERT INTO `utilisateur` (`id`, `pseudo`, `mdp`, `image`, `description`, `mail`, `inscription`, `moderateur`, `banni`) VALUES (NULL, :pseudo, :mdp, \'"https://dummyimage.com/50x50/d3d3d3/fff"\', \'\', :mail, CURDATE(), 0, 0)');
				$req->execute(array(
					'pseudo' => $_POST['pseudo'],
					'mdp' => $pass_hache,
					'mail' =>$_POST['email']));
				echo '<form>
				Votre compte a bien été créé!
				<div class="form-group">
				<a href="user_login.php" class="btn btn-success btn-lg btn-block">Se connecter</a>
				</div>
				</form>';

			}
		} 
		else {
			?>
			<form action="user_signup.php" method="post">
				<h2>S'inscrire</h2>
				<p class="hint-text">Créer un compte pour partager de nouveaux lieux !</p>
				<div class="form-group">
					<input type="text" class="form-control" name="pseudo" placeholder="Nom d'utilisateur" required="required">       	
				</div>
				<div class="form-group">
					<input type="email" class="form-control" name="email" placeholder="Email" required="required">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="pass" placeholder="Mot de passe" required="required">
				</div>       
				<div class="form-group">
					<button type="submit" class="btn btn-success btn-lg btn-block">S'inscrire</button>
				</div>
			</form>
			<div class="text-center" style="color: #999;">Vous avez deja un compte? <a href="user_login.php" style="color:#999;">Se connecter</a></div>

			<?php } ?>
		</div>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="js/jquery-3.2.1.slim.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
	</html>