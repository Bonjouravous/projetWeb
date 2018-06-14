<?php include('headermin.php');

	$iddescription = isset($_GET['id']) ? (int) $_GET['id'] : 'alpha';

	if(is_numeric($iddescription)) {
		$rep = $bdd->prepare('SELECT * FROM lieudescription WHERE id=?');
		$rep->execute(array($iddescription));
		$version = $rep->fetch(PDO::FETCH_ASSOC);
		echo $version['description'];
	}
?>