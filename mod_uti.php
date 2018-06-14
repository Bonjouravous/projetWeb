<?php
include('header.php');

if (isset($_POST['bannir'])) {
    $pseudo = $_POST['pseudo'];
    $stat = $bdd->prepare('UPDATE utilisateur SET banni = 1 WHERE pseudo = ?');
    $stat->execute(array($pseudo));
}
?>
<?php if(isMod()){
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
                    <a class="nav-link active" href="mod_uti.php">Signalements utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mod_cle.php">Mots clés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mod_contact.php">Messages</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h5 class="card-title text-left">Utilisateurs les plus signalés</h5>
            <div class="card-text">
                <table>
                    <thead>
                        <tr>
                            <th>Pseudo</th>
                            <th>Nombre de commentaires signalés</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                    $reponse = $bdd->query('SELECT DISTINCT pseudo, count(signcommentaire.id) as total FROM utilisateur
                     INNER JOIN lieucommentaire ON utilisateur.id = lieucommentaire.idutilisateur
                     JOIN signcommentaire ON lieucommentaire.id = signcommentaire.idcommentaire
                     WHERE utilisateur.banni = 0 AND signcommentaire.traite = 0
                     GROUP BY utilisateur.id
                     ORDER BY count(signcommentaire.id) DESC
                     LIMIT 0, 10 ');
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
                                        <input class="form-control btn-danger mb-1 mt-1" type="submit" value="Bannir" name="bannir"/>
                                        <input type="hidden" value="<?php echo $pseudo; ?>" name="pseudo"/>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        <?php 
                    } 
                    ?>
                </table>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php include('footer.php'); ?>
