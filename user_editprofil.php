 <?php include('header.php'); 
 if($_GET['username'] == $_SESSION['pseudo']){

 	echo '<div class="card text-center">
 	<div class="card-header">
 	<ul class="nav nav-tabs card-header-tabs">
 	<li class="nav-item">
 	<a class="nav-link" href="user_profil.php?username='.$_SESSION['pseudo'].'">Mon profil</a>
 	</li>
 	<li class="nav-item">
 	<a class="nav-link active" href="user_editprofil.php">Editer mon profil</a>
 	</li>
 	</ul>
 	</div>
 	<div class="card-body">
 	<form action="user_edit.php?username='.$_SESSION['pseudo']. '" method="post">
 	<div class="form-group">
 	<label for="description">Changer ma description</label>
 	<textarea id="description" name="description" class="form-control"></textarea>
 	</div>
 	<div class="form-group">
 	<label for="photo">Changer ma photo de profil</label>
 	<input type="text" class="form-control" id="photo" placeholder="Nouvelle photo de profil" name="photo">
 	<small id="photoHelp" class="form-text text-muted">Entrez une adresse url pour changer votre photo de profil</small>
 	</div>
 	<div class="form-group">
 	<label for="oldpass">Changer mon mot de passe</label>
 	 	<input type="password" class="form-control" id="oldpass" placeholder="Mot de passe actuel" name="oldpass">
 	<input type="password" class="form-control mt-1" id="pass" placeholder="Nouveau mot de passe" name="pass">

 	</div>
 	<button name="envoi" type="submit" class="btn btn-primary">Modifier</button>
 	</form> 
 	</div>
 	</div>';
 }

 ?>

 <?php include('footer.php'); ?>

