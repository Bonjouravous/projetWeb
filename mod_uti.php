<?php
include('header.php');

if (isset($_POST['bannir'])) {
    $pseudo = $_POST['pseudo'];
    $stat = $bdd->prepare('UPDATE utilisateur SET banni = 1 WHERE pseudo = ?');
    $stat->execute(array($pseudo));
}
?>

<section>
	<h2>Utilisateurs les plus signalés</h2>
	<table>
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Nombre de commentaires signalés</th>
                <th></th>
            </tr>
        </thead>
        <?php
        $reponse = $bdd->query('SELECT DISTINCT pseudo, count(signcommentaire.id) as total FROM utilisateur INNER JOIN lieucommentaire ON utilisateur.id = lieucommentaire.idutilisateur JOIN signcommentaire ON lieucommentaire.id = signcommentaire.idcommentaire WHERE utilisateur.banni = 0 GROUP BY utilisateur.id ORDER BY count(signcommentaire.id) DESC LIMIT 0,10 ');
			while($donnees = $reponse->fetch()){
                $pseudo = $donnees ['pseudo'];
                $nb = $donnees['total'];
		?>
        <tbody>
            <tr>
                <td><?php echo $pseudo; ?></td>
                <td><?php echo $nb; ?></td>
                <td>
                    <form method="post" action="mod_uti.php">
                        <input type="submit" value="Bannir" name="bannir"/>
                        <input type="hidden" value="<?php echo $pseudo; ?>" name="pseudo"/>
                    </form>
                </td>
            </tr>
        </tbody>
	<?php 
		} 
	?>
    </table>	
</section>

<?php include('footer.php'); ?>