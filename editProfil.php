 <?php include('header.php'); ?>
 <div class="container">
 	<div class="card text-center">
 		<div class="card-header">
 			<ul class="nav nav-tabs card-header-tabs">
 				<li class="nav-item">
 					<a class="nav-link" href="profil.php">Mon profil</a>
 				</li>
 				<li class="nav-item">
 					<a class="nav-link active" href="editProfil.php">Editer mon profil</a>
 				</li>
 			</ul>
 		</div>
 		<div class="card-body">
 			<form>
 				<div class="form-group">
 					<label for="description">Changer ma description</label>
 					<textarea id="description" name="description" class="form-control"></textarea>
 				</div>
 				<div class="form-group">
 					<label for="description">Changer ma photo de profil</label>
 					<input type="text" class="form-control" id="description" placeholder="Nouvelle photo de profil">
 					<small id="emailHelp" class="form-text text-muted">Entrez une adresse url pour changer votre photo de profil</small>
 				</div>
 				<button type="submit" class="btn btn-primary">Modifier</button>
 			</form>
 			<!--  				<a href="#" class="btn btn-outline-success">Voir tout les postes</a>recherche avec comme attribut le nom de l'auteur --> 
 		</div>
 	</div>
 </div>
 <div class="fixed-bottom">
 <?php include('footer.php'); ?>
 </div>