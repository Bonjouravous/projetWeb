<?php	
include('header.php');
	
	
if (isset($_POST['valider']))
{
	if(!empty($_POST['code']))
	{
		$codegenere= $_POST['code'];			
		
		$c = $bdd->prepare("SELECT idutilisateur,codegenere FROM resetmdp WHERE codegenere=?"); 
		$c->execute(array($codegenere));
		$codeverification = $c->fetch();
	
		if(!empty($_POST['code']))
		{
			if(!empty($_POST['newpwd1']) && !empty($_POST['newpwd2']))
			{
				if (!$codeverification['codegenere'])					
				{
					echo "code incorrect";
?>					
<form method="post" action="mdp_traitement.php" >
	<h4>Veuillez entrer le code que vous avez reçu </h4>
	<p>
	<input type="text" name="code" placeholder="Entrer le code" autocomplete = "off"/>
	</p>	
	<h4> Veuillez entrer votre nouveau mot de passe </h4>
	<p>
	<input type="password" name="newpwd" placeholder="Votre nouveau mot de passe"/>	
	</p>
	<h4> Veuillez confirmer le mot de passe </h4>
	<p>
	<input type="password" name="newpwd2" placeholder="Votre nouveau mot de passe"/>
	</p>
	<p>
	<input type="submit" value="valider" name="valider"/>
	</p>
</form>			
<?php					
				}
				else
				{
					if($_POST['newpwd1'] == $_POST['newpwd2'])
					{		
						$pass_hache = password_hash($_POST['newpwd1'], PASSWORD_DEFAULT);			
						
						$req2 = $bdd->prepare('UPDATE `utilisateur` SET `mdp` = ? WHERE `utilisateur`.`id` = ?');	
						$req2-> execute(array($pass_hache,$_SESSION['id']));
						
						$req2 = $bdd->prepare('DELETE FROM resetmdp WHERE idutilisateur =?');
						$req2 -> execute(array($_SESSION['id']));
						echo "Votre mot de passe a été changé avec succès";
					}
					else
					{
						echo"Les deux mots de passes ne correspondent pas. Veuillez réessayer.";						
						
?>

<h4> Veuillez entrer votre nouveau mot de passe </h4>
	<p>
	<input type="password" name="newpwd1" placeholder="Votre nouveau mot de passe"/>	
	</p>
	</p>	
	<h4> Veuillez confirmer le mot de passe </h4>
	<p>
	<input type="password" name="newpwd2" placeholder="Votre nouveau mot de passe"/>
	</p>	
	<p>
	<input type="submit" value="valider" name="valider"/>
	</p>

<?php
						
					}
				}
			}
		}
	}
} else {
?>

<form method="post" action="mdp_traitement.php" >
	<h4>Veuillez entrer le code que vous avez reçu </h4>
	<p>
	<input type="text" name="code" placeholder="Entrer le code" autocomplete = "off"/>
	</p>	
	<h4> Veuillez entrer votre nouveau mot de passe </h4>
	<p>
	<input type="password" name="newpwd1" placeholder="Votre nouveau mot de passe"/>	
	</p>
	</p>	
	<h4> Veuillez confirmer le mot de passe </h4>
	<p>
	<input type="password" name="newpwd2" placeholder="Votre nouveau mot de passe"/>
	</p>	
	<p>
	<input type="submit" value="valider" name="valider"/>
	</p>
</form>	


<?php } 
include('footer.php');
?>