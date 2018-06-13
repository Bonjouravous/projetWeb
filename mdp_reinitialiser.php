<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', ''); 
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage()); 
}

//$requete->execute(array($code));
//$codegenere = $requete->fetch();


if (isset($_POST['valider1']))
{	

	if(!empty($_POST['code']))
	{		
		$codetape= $_POST['code'];
		//$requete = $bdd-> prepare('INSERT INTO 'resetmdp'(NULL,NULL,"'.$codegenere.'",'codetape','nouveaumdp')');
		
		
	}
	else
	{
			echo "Veuillez rentrer le code";
	}
}

?>