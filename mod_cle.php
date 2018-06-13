<?php
    include('header.php');

    if(isset($_POST['ajout'])){
        $mot = $_POST['mot'];
        $stat = $bdd->prepare('INSERT INTO motcle (id, mot) VALUES (NULL, ?)');
        $stat->execute(array($mot));
    }

if (isset($_POST['supprimer'])) {
    $mot = $_POST['mot'];
    $stat = $bdd->prepare('DELETE FROM motcle WHERE mot = ?');
    $stat->execute(array($mot));
}
?>

<section>
    <h2>Mots-clés</h2>
    <div>
        <h3>Ajout d'un mot-clé</h3>
        <form method="post" action="mod_cle.php">
            <input type="text" name="mot" placeholder="Nouveau mot-clé"/>
            <input type="submit" value ="Ajouter" name="ajout"/>
        </form>
    </div>
    <div>
        <h3>Liste des mots-clés</h3>
        <?php
        $req = $bdd->query('SELECT mot FROM motcle ORDER BY mot ASC');
            while($donnees = $req->fetch()) {
                $mot = $donnees['mot'];
        ?>
        <p><?php echo $mot; ?></p>
                <form method="post" action="mod_cle.php">
                    <input type="submit" value="Supprimer" name="supprimer"/>
                    <input type="hidden" value="<?php echo $mot; ?>" name="mot"/>
                </form>
        <?php
            }
        ?>
    </div>
</section>

<?php include('footer.php');?>