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
	
$showvalidform = true;

if(isset($_GET['validationcode'])) {
	$validationcode = $_GET['validationcode'];
	if(!empty($validationcode)) {
		$c = $bdd->prepare("UPDATE utilisateur SET codevalidation=0 WHERE codevalidation=?"); 
		$c->execute(array($validationcode));
		
		if($c->rowCount() > 0) {
			$showvalidform = false;
			?>
			<form>
				<h4>Votre inscription a bien été prise en compte</h4>
				<p>Nous avons bien pris en compte votre inscription et nous vous en remercions.</p>
				<a href="user_login.php">Se connecter</a>
			</form>
			<?php
		}
	}
	
	if($showvalidform) {
		?>
		<form>
			<h4>Code invalide</h4>
			<p>Le code que vous avez saisi est invalide. Veuillez réessayer.</p>
			<a href="user_validation.php">Reessayer</a>
		</form>
		<?php
	}
	
	
} else if($showvalidform) {
	?>
<h3>Confirmation de votre inscription<h3>
<form method="GET" action="user_validation.php" >
	<h6>Veuillez entrer le code que vous avez reçu </h6>
	<p>
	<input class="form-control" type="text" name="validationcode" placeholder="Entrer le code" autocomplete = "off"/>
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