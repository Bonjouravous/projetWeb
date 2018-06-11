<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
// Vérification de la validité des informations

// Hachage du mot de passe
$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);

// Insertion
$req = $bdd->prepare('INSERT INTO utilisateur(pseudo, mdp, mail, inscription) VALUES(:pseudo, :mdp, :mail, CURDATE())');
$req->execute(array(
    'pseudo' => $_POST['pseudo'],
    'mdp' => $pass_hache,
    'mail' =>$_POST['email']));
header('Location: login.php');
?>
