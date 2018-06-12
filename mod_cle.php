<?php
    include('header.php');

    if(isset($_POST['ajout'])){
        $mot = $_POST['mot'];
        $bdd->query('INSERT INTO motcle (id, mot) VALUES (NULL, '."'$mot'".')');
    }
?>

<section>
    <h2>Mots-clés</h2>
    <div>
        <h3>Ajout d'un mot-clé</h3>
        <form method="post" action="mod_cle.php">
            <input type="text" name="mot" placeholder="Nouveau mot-clé"/>
            <input type="submit" value ="Ajouter" name="ajout"/>
    </div>
    <div>
        <h3>Liste des mots-clés</h3>
        <?php
            $req = $bdd->query('SELECT mot FROM motcle');
            while($donnees = $req->fetch()) {
                $mot = $donnees['mot'];
        ?>
        <p><?php echo $mot; ?></p>
        <?php
            }
        ?>
    </div>
</section>




<?php include('footer.php');?>