<?php
  include('header.php');
?>


<?php
  /* A définir: "$lieu_id". */
  $lieu_query = $bdd->query('SELECT Lieu.Nom, LieuDescription.Description FROM Lieu, LieuDescription WHERE Lieu.Id = LieuDescription.IdLieu AND Lieu.Id = '.$lieu_id.';');
?>

<form id="article_form" action="traitement.php" method="post">
  <fieldset>
    <p>Titre:</p>
    <input type="text" name="title" value=<?php echo '"'.$lieu_titre.'"' ?>/>
  </fieldset>
    <p>Description:</p>
    <textarea name="description" form="article_form">
      
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
