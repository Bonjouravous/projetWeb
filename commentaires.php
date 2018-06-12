<?php
  $lieu_commentaires_query = $bdd->query(
    'SELECT'
    .' utilisateur.pseudo,'
    .' lieuCommentaire.idutilisateur,'
    .' lieucommentaire.message,'
    .' lieucommentaire.date,'
    .' lieucommentaire.supprimer'
    .'  FROM lieucommentaire, utilisateur'
    .'  WHERE lieucommentaire.idlieu = '.$lieu_id
    .'   AND utilisateur.id = lieucommentaire.idutilisateur'
    .';'
  );
?>
