 <?php include('header.php'); ?>
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