<?php
  $lieu_medias_query = $bdd->query(
    'SELECT IdUtilisateur, Media, Date, Supprimer FROM LieuMedia'
    .' WHERE IdLieu = '.$lieu_id
  );
?>
