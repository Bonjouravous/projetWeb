<?php
session_start();
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
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