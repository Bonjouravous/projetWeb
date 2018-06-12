 <?php include('header.php');
 
$hassend = false;
$haserror = false;
 
if(!empty($_POST['mail'])){
	$mail = htmlspecialchars($_POST['mail']);
	if(!empty ($_POST['objet'])){
		$objet = htmlspecialchars($_POST['objet']);
		if(!empty ($_POST['message'])){			
			$message = htmlspecialchars($_POST['message']);
			$insertion = $bdd->prepare('INSERT INTO contact VALUES (NULL,?,?,?)');
			$insertion->execute(array($mail,$objet,$message));
			$hassend = true;
		}
	}
}

if($hassend && !$haserror) {
	?>
 	<div style="background-color: #FAFAFA;
 	padding: 10px 40px 60px;
 	margin: 10px 0px 60px;
 	border: 1px solid #d3d3d3;">
 	Votre message a bien été envoyé!
 </div>
	<?php
} else if($haserror) {
		?>
 	<div style="background-color: #FAFAFA;
 	padding: 10px 40px 60px;
 	margin: 10px 0px 60px;
 	border: 1px solid #d3d3d3;">
 	Une erreur est survenue! Veuillez réessayer!
 </div>
	<?php
} else {
 ?>
 <!-- FORMULAIRE DE CONTACT  -->

<div style="background-color: #FAFAFA;
padding: 10px 40px 60px;
margin: 10px 0px 60px;
border: 1px solid #d3d3d3;">
<form class="text-center" action="page_contact.php" method="post">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="inputemail">Votre email</label>
				<input required type="email" name="mail" class="form-control" id="inputemail" value="">
			</div><!--/*.form-group-->
		</div><!--/*.col-md-6-->
		<div class="col-md-12">
			<div class="form-group">
				<label for="objet">Objet</label>
				<input required type="text" name="objet" class="form-control" id="objet" value="">
			</div><!--/*.form-group-->
		</div><!--/*.col-md-6-->
		<div class="col-md-12">
			<div class="form-group">
				<label for="inputmessage">Votre message</label>
				<textarea required id="inputmessage" name="message" class="form-control"></textarea>
			</div><!--/*.form-group-->
		</div><!--/*.col-md-12-->
		<div class="col-md-12">
		</div><!--/*.col-md-12-->
		<div class="col-md-12">
			<button type='submit' class='btn btn-success'>Envoyer</button>
		</div><!--/*.col-md-12-->
	</div><!--/*.row-->
</form>
</div>
<!-- FIN DU FORMULAIRE -->
<?php }
include('footer.php'); ?>
