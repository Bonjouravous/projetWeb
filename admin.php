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
    <section>
        <h2>Gestionnaire des Modérateurs</h2>
        <div>
            <form method="post" action="admin.php">
                <select name="pseudo">
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
                <input type="submit" value="Ajouter" name="ajout"/>
            </form>
        </div>
        <div>
            <h3>Liste des Modérateurs</h3>

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
                                    <input type="submit" value="Supprimer" name="supprimer"/>
                                    <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                                </form>
                            </td>
                        </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>

        </div>
    </section>
<?php include('footer.php');?>