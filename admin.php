<?php
    include('header.php');

    if(isset($_POST['ajout'])){
        if (!empty($_POST['pseudo'])) {
            $pseudo = $_POST['pseudo'];
            $stat = $bdd->prepare('UPDATE utilisateur SET moderateur = 1 WHERE id = ?');
            $stat->execute(array($pseudo));
        } else {
            echo "Aucun utilisateur sélectionné";
        }

    }

    if(isset($_POST['supprimer'])){
    $id = $_POST['id'];
        $stat = $bdd->prepare('UPDATE utilisateur SET moderateur = 0 WHERE id = ?');
        $stat->execute(array($id));
    }
?>
<?php if(isMod()){
    ?>

    <div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="admin.php">Gestionnaire des modérateurs</a>
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
    </ul>
  </div>
  <div class="card-body">
    <h5 class="card-title text-left">Liste des Modérateurs</h5>
    <p class="card-text"><div>
		<?php
		$req = $bdd->query('SELECT id, pseudo FROM utilisateur WHERE moderateur = 0 AND utilisateur.banni = 0  ORDER BY pseudo ASC');
		$datas = $req->fetchAll(PDO::FETCH_ASSOC);
		if(count($datas) > 0) {
		?>
            <form method="post" action="admin.php">
                <select class="form-control" name="pseudo">
                    <?php
                        foreach($datas as $donnees){
                            $pseudo = $donnees['pseudo'];
                    ?>
                            <option value="<?= $donnees['id'] ?>"><?php echo $pseudo; ?></option>
                    <?php
                         }
                    ?>
                </select>
                <input class="form-control btn-outline-info mb-1 mt-1" type="submit" value="Ajouter" name="ajout"/>
            </form>
		<?php } ?>
        </div>
        <div>
                <table>
                    <thead>
                          <tr>
                              <th>Pseudo</th>
                              <th></th>
                          </tr>
                    </thead>
                    <tbody>
                        <?php
                        $req = $bdd->query('SELECT pseudo, id FROM utilisateur WHERE moderateur = 1 AND utilisateur.banni = 0 ORDER BY pseudo ASC');
                            while($donnees = $req->fetch()){
                                $modo = $donnees['pseudo'];
                                $id = $donnees['id'];
                        ?>
                        <tr>
                            <td><?php echo $modo ?></td>
                            <td>
							<?php if($id != $_SESSION['id']) { ?>
                                <form method="post" action="admin.php">
                                    <input class="form-control btn-danger" type="submit" value="Supprimer" name="supprimer"/>
                                    <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                                </form>
							<?php } ?>
                            </td>
                        </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
        </div></p>
  </div>
</div>
<?php } ?>
<?php include('footer.php');?>