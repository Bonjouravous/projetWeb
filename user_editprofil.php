 <?php include('header.php'); 
 if($_GET['username'] == $_SESSION['pseudo']){

 	?>
	<div class="card text-center">
 	<div class="card-header">
 	<ul class="nav nav-tabs card-header-tabs">
 	<li class="nav-item">
 	<a class="nav-link" href="user_profil.php?username=<?=$_SESSION['pseudo']?>">Mon profil</a>
 	</li>
 	<li class="nav-item">
 	<a class="nav-link active" href="user_editprofil.php?username=<?=$_SESSION['pseudo']?>">Editer mon profil</a>
 	</li>
 	</ul>
 	</div>
 	<div class="card-body">
	<?php
	if(isset($_GET['error']) && !empty($_GET['msg'])) { ?>
		<div style="border: 1px solid black; border-radius: 5px;" class="form-group">
			<p><?=$_GET['msg']?></p>
		</div>
	<?php }
	?>
 	<form action="user_edit.php?username=<?=$_SESSION['pseudo']?>" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="description">Changer ma description</label>
			<textarea id="description" name="description" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<label for="photo">Changer ma photo de profil</label>
			<input name="media_up" class="form-control" id="photo" type="file">
		</div>
		<div class="form-group">
		<label for="oldpass">Changer mon mot de passe</label>
			<input type="password" class="form-control" id="oldpass" placeholder="Mot de passe actuel" name="oldpass">
		<input type="password" class="form-control mt-1" id="pass" placeholder="Nouveau mot de passe" name="pass">

		</div>
		<button name="envoi" type="submit" class="btn btn-primary">Modifier</button>
 	</form> 
 	</div>
 	</div>
	<script>
	$(document).on('ready', function() {
		$("#photo").fileinput({
			showPreview: true,
			showUpload: true,
			elErrorContainer: '#kartik-file-errors',
			allowedFileExtensions: ["jpg", "png", "gif"]
//uploadUrl: '/site/file-upload-single'
});
	});
</script>
	<?php
 }

 ?>

 <?php include('footer.php'); ?>

