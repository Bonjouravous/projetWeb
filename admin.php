<?php
    include('header.php');

    if(isset($_POST['ajout'])){
    $pseudo = $_POST['pseudo'];
        $stat = $bdd->prepare('UPDATE utilisateur SET moderateur = 1 WHERE id = ?');
        $stat->execute(array($pseudo));
    }

    if(isset($_POST['supprimer'])){
    $id = $_POST['id'];
        $stat = $bdd->prepare('UPDATE utilisateur SET moderateur = 0 WHERE id = ?');
        $stat->execute(array($id));
    }
?>
    <div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="#">Gestionnaire des modérateurs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Signalements</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <h5 class="card-title text-left">Liste des Modérateurs</h5>
    <p class="card-text"><div>
            <form method="post" action="admin.php">
                <select class="form-control" name="pseudo">
                    <?php
                    $req = $bdd->query('SELECT id, pseudo FROM utilisateur WHERE moderateur = 0 AND utilisateur.banni = 0  ORDER BY pseudo ASC');
                        while($donnees = $req->fetch()){
                            $pseudo = $donnees['pseudo'];
                    ?>
                            <option value="<?= $donnees['id'] ?>"><?php echo $pseudo; ?></option>
                    <?php
                         }
                    ?>
                </select>
                <input class="form-control" type="submit" value="Ajouter" name="ajout"/>
            </form>
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
                                <form method="post" action="admin.php">
                                    <input class="form-control" type="submit" value="Supprimer" name="supprimer"/>
                                    <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                                </form>
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
<?php include('footer.php');?>