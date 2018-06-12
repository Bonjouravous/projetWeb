 <?php include('header.php'); ?>
 <!-- FORMULAIRE DE CONTACT  -->

 <div class="container">
 	<div style="background-color: #FAFAFA;
 	padding: 10px 40px 60px;
 	margin: 10px 0px 60px;
 	border: 1px solid #d3d3d3;">
 	<form class="text-center" action="send_form.php" method="post">
 		<div class="row">
 			<div class="col-md-12">
 				<div class="form-group">
 					<label for="inputemail">Votre email</label>
 					<input required type="email" name="email" class="form-control" id="inputemail" value="">
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
 </div><!--/*.container-->
 <!-- FIN DU FORMULAIRE -->
</div>
<div class="fixed-bottom">
	<?php include('footer.php'); ?>
</div>