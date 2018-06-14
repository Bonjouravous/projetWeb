<?php
include('headermin.php');
?><!DOCTYPE html>
<html lang="fr">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Changement de mot de passe</title>
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
	
	if(isset($_POST['code']) && isset($_POST['newpwd'])) {
		$codegenere= $_POST['code'];
		$c = $bdd->prepare("SELECT idutilisateur,codegenere FROM resetmdp WHERE codegenere=?"); 
		$c->execute(array($codegenere));
		$codeverification = $c->fetch();
		
		if(!$codeverification) {
			?>
			<form>
				<h2>Erreur</h2>
				<p class="hint-text">Le code entré est incorrect</p>
			</form>
			<div class="text-center" style="color:#999;"><a href="mdp_traitement.php" style="color:#999;">Réessayer</a></div>
			<?php
		} else {
			// Code valide
			$pass_hache = password_hash($_POST['newpwd'], PASSWORD_DEFAULT);			
		
			$req2 = $bdd->prepare('UPDATE `utilisateur` SET `mdp` = ? WHERE `utilisateur`.`id` = ?');	
			$req2-> execute(array($pass_hache,$codeverification['idutilisateur']));
			
			$req2 = $bdd->prepare('DELETE FROM resetmdp WHERE idutilisateur =?');
			$req2 -> execute(array($codeverification['idutilisateur']));
			?>
			<form>
				<h2>Validation</h2>
				<p class="hint-text">Votre mot de passe a bien été changé</p>
			</form>
			<div class="text-center" style="color:#999;"><a href="user_login.php" style="color:#999;">Se connecter</a></div>
			<?php
		}
		
	} else {
		?>
		<form method="post" action="mdp_traitement.php" >
			<h2>Mot de passe</h2>
			<p class="hint-text">Entrez le code reçu par mail ainsi que votre nouveau mot de passe</p>
			<p>
				<input class="form-control" type="text" name="code" value="<?=isset($_GET['code']) ? $_GET['code'] : '' ?>" placeholder="Entrer le code" autocomplete="off"/>
			</p>
			<p>
				<input class="form-control" type="password" name="newpwd" placeholder="Votre nouveau mot de passe"/>	
			</p>
			<p>
				<input class="btn btn-success btn-lg btn-block" type="submit" value="valider"/>
			</p>
		</form>
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