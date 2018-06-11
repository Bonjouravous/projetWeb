<?php 
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
//  Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT id, mdp FROM utilisateur WHERE pseudo = :pseudo');
$req->execute(array(
    'pseudo' => $_POST['pseudo']));
$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($_POST['pass'], $resultat['mdp']);

if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $_POST['pseudo'];
        header('Location: index.php');
    }
    else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}
?>