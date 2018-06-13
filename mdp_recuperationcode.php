<?php
try{
        $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', ''); 
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage()); 
    }

if(isset($_POST['reset'])) {
	if(!empty($_POST['mail']))
	{
		$mail= $_POST['mail'];			
		$m = $bdd->prepare("SELECT id, mail FROM utilisateur WHERE mail=?"); 
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
			
			$iduser = $mailverification['id'];
			$requete = $bdd-> prepare('INSERT INTO resetmdp VALUES(NULL,?,?)');
			$requete ->execute(array($iduser, $generatedcode));
			
			echo "Mail : ".$mail." et code : ".$generatedcode;
			?>
			</br>
			<p>Taper votre code <a href = "mdp_traitement.php"> ici </a></p>
			<?php
		}
	}
	else {
		echo 'Un problème est survenu';
	}
	
} else {
?>

<h4>Réinitialisation de votre mot de passe</h4>
<form method="post" action="mdp_recuperationcode.php">
	
	<input type="email" name="mail" placeholder="Votre adresse mail"/>
	
	<input type="submit" value="Réinilialiser votre mot de passe" name="reset"/>
</form>

<?php } ?>