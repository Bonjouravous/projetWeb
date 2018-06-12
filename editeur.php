<?php
  include('header.php');
?>


<?php
  /* A définir: "$lieu_id". */
  $lieu_query = $bdd->query(
    'SELECT Lieu.Nom, LieuDescription.Description'
    .' FROM Lieu, LieuDescription'
    .' WHERE Lieu.Id = LieuDescription.IdLieu AND Lieu.Id = '.$lieu_id
    .';'
  );
  if ($lieu_query->rowCount() == 0) {
    $lieu_titre = '';
    $lieu_desc = '';
  } else {
    $data = $lieu_query->fetch();
    $lieu_titre = $data['nom'];
    $lieu_desc = $data['description'];
  }
?>

<form id="article_form" action="editeur_traitement.php" method="post">
  <fieldset>
    <p>Titre:</p>
    <input type="text" name="title" value=<?php echo '"'.$lieu_titre.'"'; ?> />
  </fieldset>
    <p>Description:</p>
    <textarea name="description" form="article_form">
      <?php
        echo $lieu_desc;
      ?>
    </textarea>
  <fieldset>
  </fieldset>
  <fieldset>
    <input type="submit" name="save"/>
    <input type="button" name="cancel"/>
  </fieldset>
</form>


<?php
  include('footer.php');
?>
