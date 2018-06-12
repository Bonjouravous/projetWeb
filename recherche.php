<?php
include('header.php');

/*Recherche des lieux les plus proches de l'utilisateur
attention : coordonnées gps sous forme décimaux en DEGRE 
 composés de 1-latitude et 2-longitude*/

function conversionRadian($angle)
{
	return pi()*$angle/180;
}

//Calcul de la distance (en km) entre deux points 
function distance($lat1, $lng1, $lat2,$lng2) 
{
	$latR1 = conversionRadian($lat1);
	$lngR1 = conversionRadian($lng1);
	$latR2 = conversionRadian($lat2);
	$lngR2 = conversionRadian($lng2);
	$difference = 6371*acos(sin($latR1)*sin($latR2)+cos($latR1)*cos($latR2)*cos($lngR1-$lngR2)); // 6371 : rayon de la terre
	return $difference;
}

function evaluer($distance, $reputation) {
	return $distance - $reputation;
}

$rep = $bdd->query('SELECT lieu.nom, lieu.latitude, lieu.longitude, lieu.id, SUM(likelieu.avis) as reputation FROM lieu JOIN likelieu ON likelieu.idlieu = lieu.id GROUP BY lieu.id'); // gps dans lieu à changer en latitude et longitude ... pour que ça soit plus simple
$rep->execute();
$localisation = $rep->fetchAll();

$lat1 = $_GET['lat']; // latitude de l'endroit ou se trouve l'utilisateur
$lng1 = $_GET['long'];// longitude de l'endroit ou se trouve l'utilisateur 

$r = $_GET['distance'];
$lieux = array();

if(!empty($lat1))
{
	$latitudeUtilisateur = $lat1;
	if(!empty($lng1))
	{
		$longitudeUtilisateur = $lng1;
		foreach($localisation as $value)
		{
			$distance = distance($latitudeUtilisateur,$longitudeUtilisateur,$value['latitude'],$value['longitude']);
			
			if ($distance <= $r) 
			{
				$value['distance'] = $distance;
					$value['evaluation'] = evaluer($distance, $value['reputation']);
				$lieux[] = $value;
				//tableau constitué des noms des lieux proches dans un rayon de r km de l'utilisateur 
				//echo $lieux[];
			}
					
		}
	}
}

/* //sort ( array &$lieux [, int $sort_flags = SORT_REGULAR ] );
foreach ($lieux as $key => $val) 
{
    echo $key." : ".$val."\n";
} */

usort($lieux, function($a, $b) {
	return $a['evaluation'] - $b['evaluation'];
});


//Recherche des lieux les mieux notés aux alentours 
foreach($lieux as $result)
{
	echo $result['nom']. ' ' . $result['distance'] . ' ' . $result['reputation'] . '<br>';
}
include('footer.php');
	?>

