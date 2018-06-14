<?php	

include('header.php');

if(isset($_POST['reset']))
{
	$generatedcode ="";
			
			for($i=0;$i<8;$i++)
			{
				$generatedcode .= mt_rand(0,9);
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
</form>	



<?php
}
include('footer.php'); 

?>