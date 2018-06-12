 <?php include('header.php'); ?>
<<<<<<< HEAD
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
=======
<style>
input[type=text], select, textarea {
    width: 100%; /* Full width */
    padding: 12px; /* Some padding */  
    border: 1px solid #ccc; /* Gray border */
    border-radius: 4px; /* Rounded borders */
    box-sizing: border-box; /* Make sure that padding and width stays in place */
    margin-top: 6px; /* Add a top margin */
    margin-bottom: 16px; /* Bottom margin */
    resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

/* Style the submit button with a specific background color etc */
button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

/* When moving the mouse over the submit button, add a darker green color */
.button :hover {
    background-color:darkgreen;
}

/* Add a background color and some padding around the form */
.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

</style>
<h2>Contact</h2>
<form action="traitement.php" method="post">

    <div>
        <label for="mail">Email :</label> <br/>
        <input type="email"  name="mail" placeholder="Votre email">
    </div>
    <div>
         <label for="objet">Objet :</label>
        <input type="text" name="objet" placeholder="Votre objet" />
    
    </div>

    <div>
        <label for="msg">Message :</label>
        <textarea  name="message" rows="15" cols="50" placeholder="Votre message"></textarea>
    </div>
    <div class="button">
        <button type="submit">Envoyer le message</button>
    </div>
</form>
  <?php include('footer.php'); ?>
>>>>>>> 8d6a0896c472eb550046f67f3833fd81accc22f7
