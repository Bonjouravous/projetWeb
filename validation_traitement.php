<?php	

include('header.php');

if(isset($_POST['valider']))
{
	if(!empty($_POST['code']))
	{
		
		$codegenere= $_POST['code'];			
		$c = $bdd->prepare("UPDATE utilisateur SET codevalidation=? WHERE id=?"); 
		$c->execute(array($codegenere, $_SESSION['id']));
		$codeverification = $c->fetch();
		
		if(!$codeverification['codegenere'])
		{
			echo "code incorrect";
?>					

<form method="post" action="validation_traitement.php" >
	<h4>Veuillez entrer le code que vous avez reçu </h4>
	<p>
	<input type="text" name="code" placeholder="Entrer le code" autocomplete = "off"/>
	</p>	
	<p>
	<input type="submit" value="valider" name="valider"/>
	</p>
</form>			

<?php
		}else
		{
		
			
?>
		<h4>Votre inscription a bien été prise en compte</h4>
		<p>Nous avons bien pris en compte votre inscription et nous vous en remercions.</p>
		<a href="user_login.php">Se connecter</a>
		
<?php
		}
	}
	
}
else
{
?>

<h3>Confirmation de votre inscription<h3>
<form method="post" action="validation_inscription.php" >
	<h6>Veuillez entrer le code que vous avez reçu </h6>
	<p>
	<input type="text" name="code" placeholder="Entrer le code" autocomplete = "off"/>
	</p>
	<p>
	<input type="submit" value="valider" name="valider"/>
	</p>
</form>	



<?php
}
include('footer.php'); 

?>