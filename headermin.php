<?php
session_start();
try
{
	$bdd = new PDO('mysql:host=sql.franceserv.fr;dbname=kant-serveur_db4;charset=utf8', 'kant-serveur', '//63moi');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}

function isConnected(){
	return isset($_SESSION['id']) AND isset($_SESSION['pseudo']);
}

function isMod(){
	global $bdd;
	$req = $bdd->prepare('SELECT moderateur FROM utilisateur WHERE pseudo = :pseudo');
	$req->execute(array('pseudo' => $_SESSION['pseudo']));
	$resultat = $req->fetch();
	return $resultat['moderateur'] == 1;
}