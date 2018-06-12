<?php
try
{
	include('localisation.php');
	$bdd = new PDO('mysql:host=localhost;dbname=;projetweb;charset=utf8','root','');

}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}	


/*Recherche des lieux les plus proches de l'utilisateur
attention : coordonnées gps sous forme décimaux en DEGRE 
 composés de 1-latitude et 2-longitude*/

function conversionRadian($angle)
{
	return pi()*angle/180;
}

//Calcul de la distance (en km) entre deux points 
function distance($lat1, $lng1, $lat2,$lng2) 
{
	latR1 = conversionRadian($lat1);
	lngR1 = conversionRadian($lng1);
	latR2 = conversionRadian($lat2);
	lngR2 = conversionRadian($lng2);
	$difference = 6371*acos(sin(latR1)*sin(latR2)+cos(latR1)*cos(latR2)*cos(lngR1-lngR2)); // 6371 : rayon de la terre
	return $difference;
}

$localisation = $bdd->query('SELECT nom,latitude, longitude FROM projetweb'); // gps dans lieu à changer en latitude et longitude ... pour que ça soit plus simple

$lat1 // latitude de l'endroit ou se trouve l'utilisateur
$lng1 // longitude de l'endroit ou se trouve l'utilisateur 
$latR1 = conversionRadian($lat1);
$lngR1 = conversionRadian($lng1);

$r // rayon en km choisi par utilisateur
$lieux = array();

if(!empty($_POST['latitude']))
{
	$latitudeUtilisateur = $_POST['latitude'];
	if(!empty($_POST['longitude']))
	{gps
		$longitudeUtilisateur = $_POST['longitude'];
		foreach($latitude as $lat2)
		{			
			foreach($longitude as $lng2)
			{
				$latR2 = conversionRadian($lat2);
				slngR2 = conversionRadian($lng2);
				$distance = distance($latitudeUtilisateur,$longitudeUtilisateur,$latR2,$lngR2);
				
				if ($distance <= $r) 
				{
					$lieux[] = $bdd->query('SELECT nom, latitude,longitude FROM projetweb);
					//tableau constitué des noms des lieux proches dans un rayon de r km de l'utilisateur 
					//echo $lieux[];
				}
				
			}
		}
	}
}

sort ( array &$lieux [, int $sort_flags = SORT_REGULAR ] );
foreach ($lieux as $key => $val) 
{
    echo $key." : ".$val."\n";
}


//Recherche des lieux les mieux notés aux alentours 
foreach($lieux as $key => $val)
{
	
}

	?>

