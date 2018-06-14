<?php include('header.php');

if(isMod()){
	echo"<h2>Contact</h2>";
	$rep = $bdd->query('SELECT * FROM contact');
	$rep->execute();
	$contacts = $rep->fetchAll(PDO::FETCH_ASSOC);
	echo "<table>";
	echo"<tr>";
			echo"<td>Email </td>";
			echo"<td>Objet </td>";
			echo"<td>Message </td>";
	echo"</tr>";
	foreach($contacts as $contact) {
		echo"<tr>";
			echo"<td>".$contact['email']."</td>";
			echo"<td>".$contact['objet']."</td>";
			echo"<td>".$contact['message']."</td>";
		echo"</tr>";
	}
	echo "</table>";
}
include('footer.php');
?>