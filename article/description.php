<?php
  $lieu_desc_query = $bdd->query(
    'SELECT'
    .' Utilisateur.Pseudo,'
    .' LieuDescription.IdUtilisateur,'
    .' LieuDescription.Description,'
    .' LieuDescription.Date'
    .'  FROM LieuDescription, Utilisateur'
    .'  WHERE LieuDescription.IdLieu = '.$lieu_id
    .'   AND Utilisateur.Id = LieuDescription.IdUtilisateur'
  );
  $lieu_desc_idutilisateur = $lieu_desc_query['idutilisateur'];
  $lieu_desc_utilisateur = $lieu_desc_query['pseudo'];

  $lieu_desc = $lieu_first_infos_query['description'];
  $lieu_desc = preg_replace(
    '[*][*] \\(.*?\\) [*][*]', '<h2>$1<h2>', $lieu_desc
  );
  $lieu_desc = preg_replace(
    '[*][*][*] \\(.*?\\) [*][*][*]' , '<h3>$1<h3>', $lieu_desc
  );
  $lieu_desc = preg_replace(
    '\\[\\[(.*?)[|](.*?)\\]\\]', '<a href="$1">$2</a>', $lieu_desc
  );

  $lieu_desc_date = $lieu_desc_query['date'];
?>
