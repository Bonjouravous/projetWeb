<?php
session_start();
try
{
	$server = '';
	$dbname = '';
	$username = '';
	$password =  '';
	$bdd = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8", $username, $password);
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