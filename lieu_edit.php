<?php
  include('header.php');
  
  $idlieu = isset($_GET['lieu']) ? $_GET['lieu'] : 'alpha';

if(!is_numeric($idlieu)) {
	echo 'Page non trouvée';
} else {

?>


<?php
  /* A définir: "$lieu_id". */
  $lieu_query = $bdd->query(
    'SELECT Lieu.Nom, LieuDescription.Description'
    .' FROM Lieu, LieuDescription'
    .' WHERE Lieu.Id = LieuDescription.IdLieu AND Lieu.Id = '.$idlieu
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
<div class="card p-4" >
<form class="text-center" action="editeur_traitement.php" method="post">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="inputemail">Titre</label>
        <input type="text" name="title" class="form-control" id="title" value=<?php echo '"'.$lieu_titre.'"'; ?>/>
      </div><!--/*.form-group-->
    </div><!--/*.col-md-6-->
    <div class="col-md-12">
      <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="desciption" class="form-control"><?php
        echo $lieu_desc;
      ?></textarea>
      </div><!--/*.form-group-->
    </div><!--/*.col-md-12-->
    <div class="col-md-12">
      <button type='submit' class='btn btn-success'>Sauver</button>
      <a role="button" href="lieu_voir.php?lieu=<?php echo $_GET['lieu']; ?>" class='btn btn-danger'>Annuler</a>
    </div><!--/*.col-md-12-->
  </div><!--/*.row-->
</form>
</div>
</div>


<?php
}

  include('footer.php');
?>
