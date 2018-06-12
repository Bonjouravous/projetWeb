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
    $lieu_titre = $lieu_query['nom'];
    $lieu_desc = $lieu_query['description'];
  }
?>

<form id="article_form" action="traitement.php" method="post">
  <fieldset>
    <p>Titre:</p>
    <input type="text" name="title" value=<?php echo '"'.$lieu_titre.'"'; ?>/>
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
    <input type="submit" name="cancel"/>
  </fieldset>
</form>


<?php
  include('footer.php');
?>
