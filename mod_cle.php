<?php
include('header.php');

if(isset($_POST['ajout'])){
    if (!empty($_POST['mot'])) {
        $mot = $_POST['mot'];
        $stat = $bdd->prepare('INSERT INTO motcle (id, mot) VALUES (NULL, ?)');
        $stat->execute(array($mot));
    }
}

if (isset($_POST['supprimer'])) {
    $mot = $_POST['mot'];
    $stat = $bdd->prepare('DELETE FROM motcle WHERE mot = ?');
    $stat->execute(array($mot));
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
                    <a class="nav-link" href="mod_uti.php">Signalements utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="mod_cle.php">Mots clés</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h5 class="card-title text-left">Mots-clés</h5>
            <p class="card-text"><div>
             <div>
                <h5>Ajout d'un mot-clé</h5>
                <form class="form-group" method="post" action="mod_cle.php">
                    <input class="form-control" type="text" name="mot" placeholder="Nouveau mot-clé"/>
                    <input class="form-control btn-outline-primary mb-1 mt-1" type="submit" value ="Ajouter" name="ajout"/>
                </form>
            </div>
            <div>
                <h5>Liste des mots-clés</h5>
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
        </div></p>
    </div>
</div>
</section>
<?php } ?>

<?php include('footer.php');?>
