<?php include('header.php');
if(isMod()){
	?>
	<section>
		<div class="card text-center">
			<div class="card-header">
				<ul class="nav nav-tabs card-header-tabs">
					<li class="nav-item">
						<a class="nav-link" href="admin.php">Gestionnaire des modérateurs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="mod_lieu.php">Signalements lieux</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="mod_com.php">Signalements commentaires</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="mod_uti.php">Signalements utilisateurs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="mod_cle.php">Mots clés</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="mod_contact.php">Messages</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<h5 class="card-title text-left">Contact </h5>
				<div class="card-text">
					<?php
					$rep = $bdd->query('SELECT * FROM contact');
					$rep->execute();
					$contacts = $rep->fetchAll(PDO::FETCH_ASSOC);
					echo "<table style=\"overflow-x:auto;\"  class=\"table table-responsive table-bordered\">";
					echo"<tr>";
					echo"<th>Email </th>";
					echo"<th>Objet </th>";
					echo"<th>Message </th>";
					echo"</tr>";
					foreach($contacts as $contact) {
						echo"<tr>";
						echo"<td>".$contact['email']."</td>";
						echo"<td>".$contact['objet']."</td>";
						echo"<td>".$contact['message']."</td>";
						echo"</tr>";
					}
					echo "</table>";
					?>
				</div>
			</div>
		</div>
	</section>
	<?php }
	include('footer.php');
	?>

	