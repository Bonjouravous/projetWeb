<?php include('header.php');

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

$rep = $bdd->query('SELECT lieu.nom, lieu.latitude, lieu.longitude, lieu.id, SUM(likelieu.avis) as reputation FROM lieu
LEFT JOIN likelieu ON likelieu.idlieu = lieu.id GROUP BY lieu.id'); // gps dans lieu à changer en latitude et longitude ... pour que ça soit plus simple
$rep->execute();
$localisation = $rep->fetchAll();

$lat1 = $_GET['lat']; // latitude de l'endroit ou se trouve l'utilisateur
$lng1 = $_GET['long'];// longitude de l'endroit ou se trouve l'utilisateur
$tags = array();
if(isset($_GET['tags'])) $tags = $_GET['tags'];


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
			$value['reputation'] = empty($value['reputation']) ? 0 : $value['reputation'];
			$distance = distance($latitudeUtilisateur,$longitudeUtilisateur,$value['latitude'],$value['longitude']);
			
			if ($distance <= $r) 
			{
				$value['distance'] = $distance;
				$value['evaluation'] = evaluer($distance, $value['reputation']);
				$rep2 = $bdd->prepare('SELECT motcle.id, motcle.mot FROM motcle JOIN lieumotcle ON motcle.id = lieumotcle.idmot AND lieumotcle.idlieu = ?');
				$rep2->execute(array($value['id']));
				$motsclesbruts = $rep2->fetchAll(PDO::FETCH_ASSOC);
				$value['motcle'] = array();
				$motsclesids = array();
				
				foreach($motsclesbruts as $mcb) {
					$value['motcle'][] = '#'.$mcb['mot'];
					$motsclesids[] = $mcb['id'];
				}
				
				$a_ajouter = true;
				
				foreach($tags as $tag) {
					if(!in_array($tag, $motsclesids)) $a_ajouter = false;
				}
				
				if($a_ajouter)
					$lieux[] = $value;
				//tableau constitué des noms des lieux proches dans un rayon de r km de l'utilisateur 
				//echo $lieux[];
			}
					
		}
	}
}

usort($lieux, function($a, $b) {
	return $a['evaluation'] - $b['evaluation'];
});

?>
<div class="container">
	<div class="row">
	<?php
	//Recherche des lieux les mieux notés aux alentours 
	foreach($lieux as $result)
	{
		?>
		<div class="col-lg-4" style="padding-top: 2%;padding-bottom: 2%">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title"><?=$result['nom']?></h5>
					<h6 class="card-subtitle mb-2 text-muted"><?=$result['distance']?> - <?=$result['reputation']?></h6>
					<a href="lieu_voir.php?lieu=<?=$result['id']?>" class="card-link">Voir</a>
					<a href="lieu_edit.php?lieu=<?=$result['id']?>" class="card-link">Modifier</a>
					<a href="#" class="card-link">Supprimer</a>
					<div class="text-right text-muted"><?=implode(' ', $result['motcle'])?></div>
				</div>
			</div>
		</div>
		<?php
	}
	?>
		
	
</div>

	</div>
	<?php include('footer.php'); ?>