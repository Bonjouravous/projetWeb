<?php
  $lieu_medias_query = $bdd->query(
    'SELECT idutilisateur, media, date, supprimer FROM lieumedia'
    .' WHERE IdLieu = '.$lieu_id
    .';'
  );
?>