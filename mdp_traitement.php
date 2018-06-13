<?php

	try{
        $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', ''); 
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage()); 
    }
	
if(isset($_POST['reset'])){	
	if(!empty($_POST['mail']))
	{	
		$mail= $_POST['mail'];			
		$m = $bdd->prepare("SELECT mail FROM utilisateur WHERE mail=?"); 
		$m->execute(array($mail));
		$mailverification = $m->fetch();
		
		if(!$mailverification['mail'])
		{
			echo "Adresse mail introuvable";
		}
		else
		{
			$generatedcode ="";
			
			for($i=0;$i<8;$i++)
			{
				$generatedcode .= mt_rand(0,9);
			}
			
			$requete1 = $bdd -> prepare('SELECT * FROM utilisateur WHERE mail =?');
			$requete1 ->execute(array($mail));
			$result = $requete1->fetch(PDO::FETCH_ASSOC);
			
			$iduser = $result['id'];
			$codetape = $_POST['code'];
			$requete = $bdd-> prepare('INSERT INTO resetmdp VALUES(NULL,NULL,"'.$generatedcode.'")');
			$requete ->execute(array($iduser));
			
			echo "Mail : ".$mail." et code : ".$generatedcode;
			
?>

<form method="post" action="mdp_reinitialiser.php" >
	<h4>Veuillez entrer le code que vous avez reçu </h4>
	<p>
	<input type="text" name="code" placeholder="Entrer le code"/>
	</p>
	<p>
	<input type="submit" value="valider" name="valider1"/>
	</p>
	
	<h4> Veuillez entrer votre nouveau mot de passe </h4>

	<p>
	<input type="password" name="newpwd1" placeholder="Votre nouveau mot de passe"/>	
	</p>
	<p>
	<input type="passeword" name="newpwd2" placeholder="Confirmez votre mot de passe"/>	
	</p>
	<p>
	<input type="submit" value="valider" name="valider2"/>
	</p>
</form>	
</form>
	
<?php
		}	
	}	
		
	else
	{
		echo "Veuillez entrer une adresse mail valide";
	}
}
?>