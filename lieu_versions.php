<?php include('header.php');

	$idlieu = isset($_GET['lieu']) ? (int) $_GET['lieu'] : 'alpha';

	if(is_numeric($idlieu)) {
		$rep = $bdd->prepare('SELECT * FROM lieudescription JOIN lieu ON lieudescription.idlieu = lieu.id JOIN utilisateur ON lieudescription.idutilisateur = utilisateur.id WHERE idlieu=? ORDER BY date DESC');
		$rep->execute(array($idlieu));
		$versions = $rep->fetchAll(PDO::FETCH_ASSOC);
		echo "<h2><a href='lieu_voir.php?lieu=".$idlieu."'>".$versions[0]["nom"]."</a></h2>";
			
		foreach($versions as $version) {
			$date = new DateTime($version['date']);
			echo "<ul>";
				echo"<li>par ".$version["pseudo"]." le ".$date->format('d/m/Y à H:i:s')."</li>";		
			echo "</ul>";
	}
}
	
include('footer.php');
?>