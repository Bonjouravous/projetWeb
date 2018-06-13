<?php
	try{
        $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', ''); 
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage()); 
    }
	
if (isset($_POST['valider']))
{
	if(!empty($_POST['code']))
	{
		$codetape= $_POST['code'];			
		
		$c = $bdd->prepare("SELECT iduser,codegenere FROM resetmdp WHERE codegenere=?"); 
		$c->execute(array($codetape));
		$codeverification = $c->fetch();

		
		if(!empty($_POST['code']))
		{
			if(!empty($_POST['newpwd']))
			{
				if (!$codeverification['codegenere'])
				{
					echo "code incorrect";
				}
				else
				{
					$pass_hache = password_hash($_POST['newpwd'], PASSWORD_DEFAULT);
					$req = $bdd->prepare('DELETE mdp FROM utilisateur WHERE id=?');
					
					//à completer
					
					echo "Votre mot de passe a été changé avec succès";
				
				}
			}
		}
	}
} else {
?>

<form method="post" action="mdp_traitement.php" >
	<h4>Veuillez entrer le code que vous avez reçu </h4>
	<p>
	<input type="text" name="code" placeholder="Entrer le code"/>
	</p>	
	<h4> Veuillez entrer votre nouveau mot de passe </h4>
	<p>
	<input type="password" name="newpwd" placeholder="Votre nouveau mot de passe"/>	
	</p>
	<p>
	<input type="submit" value="valider" name="valider"/>
	</p>
</form>	
</form>

<?php } ?>