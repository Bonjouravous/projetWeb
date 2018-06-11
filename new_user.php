<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
// Vérification de la validité des informations

// Hachage du mot de passe
$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);

// Insertion
$req = $bdd->prepare('INSERT INTO utilisateur(pseudo, mdp, email, date_inscription) VALUES(:pseudo, :mdp, :email, CURDATE())');
$req->execute(array(
    'pseudo' => $_POST['pseudo'],
    'mdp' => $pass_hache,
    'email' =>$_POST['email']));
header('Location: login.php');
?>