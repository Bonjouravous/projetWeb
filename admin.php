<?php
    include('header.php');

    if(isset($_POST['ajout'])){
    $pseudo = $_POST['pseudo'];
    $bdd->query('UPDATE utilisateur SET moderateur = 1 WHERE pseudo = '."'$pseudo'");
    }

    if(isset($_POST['supprimer'])){
    $id = $_POST['id'];
    $bdd->query('UPDATE utilisateur SET moderateur = 0 WHERE id = '.$id);
    }
    ?>
    <section>
        <h2>Gestionnaire des Modérateurs</h2>
        <div>
            <form method="post" action="admin.php">
                <select name="pseudo">
                    <?php
                        $req = $bdd->query('SELECT pseudo FROM utilisateur WHERE moderateur = 0');
                        while($donnees = $req->fetch()){
                            $pseudo = $donnees['pseudo'];
                    ?>
                        <option><?php echo $pseudo;?></option>
                    <?php
                         }
                    ?>
                </select>
                <input type="submit" value="Ajouter" name="ajout"/>
            </form>
        </div>
        <div>
            <h3>Liste des Modérateurs</h3>
            <form method="post" action="admin.php">
                <table>
                    <thead>
                          <tr>
                              <th>Pseudo</th>
                              <th></th>
                          </tr>
                    </thead>
                    <tbody>
                        <?php
                            $req = $bdd->query('SELECT pseudo, id FROM utilisateur WHERE moderateur = 1');
                            while($donnees = $req->fetch()){
                                $modo = $donnees['pseudo'];
                                $id = $donnees['id'];
                        ?>
                        <tr>
                            <td><?php echo $modo ?></td>
                            <td>
                                    <input type="submit" value="Supprimer" name="supprimer"/>
                                    <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <?php
                            }
            ?>
        </div>
    </section>
    </html>
<?php include('footer.php');?>