<?php
  $lieu_desc_query = $bdd->query(
    'SELECT'
    .' utilisateur.pseudo,'
    .' lieudescription.idutilisateur,'
    .' lieudescription.description,'
    .' lieudescription.date'
    .'  FROM lieudescription, utilisateur'
    .'  WHERE lieudescription.idlieu = '.$lieu_id
    .'   AND utilisateur.id = lieudescription.idutilisateur'
    .';'
  )->fetch();
  $lieu_desc_idutilisateur = $lieu_desc_query['idutilisateur'];
  $lieu_desc_utilisateur = $lieu_desc_query['pseudo'];

  $lieu_desc = $lieu_desc_query['description'];
  $lieu_desc = preg_replace(
    '/[*][*][*] (.*?) [*][*][*]/' , '<h3>$1<h3>', $lieu_desc
  );
  $lieu_desc = preg_replace(
    '/[*][*] (.*?) [*][*]/', '<h2>$1<h2>', $lieu_desc
  );
  $lieu_desc = preg_replace(
    '/\\[\\[(.*?)[|](.*?)\\]\\]/', '<a href="$1">$2</a>', $lieu_desc
  );

  $lieu_desc_date = $lieu_desc_query['date'];
?>
