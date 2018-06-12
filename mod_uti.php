<?php include('header.php'); ?>

<section>
	<h2>Utilisateurs les plus signalés</h2>
	<table>
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Nombre de commentaires signalés</th>
            </tr>
        </thead>
		<?php 
			$reponse = $bdd->query('SELECT DISTINCT pseudo FROM utilisateur INNER JOIN signcommentaire ON utilisateur.id = signcommentaire.idutilisateur GROUP BY utilisateur.id ORDER BY count(signcommentaire.id) DESC LIMIT 0,10 ');
			$tmp = $bdd->query('SELECT count(signcommentaire.id) as total FROM utilisateur INNER JOIN signcommentaire ON utilisateur.id = signcommentaire.idutilisateur GROUP BY utilisateur.id ORDER BY count(signcommentaire.id) DESC LIMIT 0,10 ');
			while($donnees = $reponse->fetch()){
			$pseudo = $donnees ['pseudo'];
		?>
        <tbody>
            <tr>
                <td><?php echo $pseudo; ?></td>
				<?php
				$nb=$tmp->fetch()
				?>
				<td><?php echo $nb['total'] ;?></td>
            </tr>
        </tbody>
	<?php 
		} 
	?>
    </table>	
</section>

<?php include('footer.php'); ?>