<?php
include('header.php');

if (isset($_POST['supprimer'])) {
    $id = $_POST['id'];
    $stat = $bdd->prepare('UPDATE lieumedia SET supprimer = 1 WHERE id = ?');
    $stat->execute(array($id));
}
?>
<?php if (isMod()) {
    ?>
    <?php
    $idlieu = $_GET['lieu'];
    $lieu_medias_stmt = $bdd->prepare('SELECT id, media FROM lieumedia WHERE idlieu = ? AND supprimer != 1 ORDER BY date DESC;');
    $lieu_medias_stmt->execute(array($idlieu));
    $lieu_medias_fetch = $lieu_medias_stmt->fetchAll(PDO::FETCH_ASSOC);
    $media_dir = 'media';

    foreach ($lieu_medias_fetch as $row) {
        $id = $row['id'];
        $media = $row ['media'];
        $media_complete_path = $media_dir . '/' . $media;
        ?>
        <p>Identifiant : <?php echo $media; ?></p>
        <?php
        ?>
        <a href="<?php echo $media_complete_path; ?>" target="_blank"><img class="card-img-top"
                                                                           src="<?php echo $media_complete_path; ?>"
                                                                           style="width : 200px;" alt="Card image cap"></a>
        <?php

        ?>
        <form method="post" action="mod_img.php?lieu=<?php echo $idlieu; ?>">
            <input type="submit" value="Supprimer" name="supprimer"/>
            <input type="hidden" value="<?php echo $id; ?>" name="id"/>
        </form>
        <?php
    }
    ?>
    </div>
<?php } ?>
<?php include('footer.php'); ?>