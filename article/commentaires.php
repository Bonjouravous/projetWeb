<?php
  $lieu_commentaires_query = $bdd->query(
    'SELECT'
    .' Utilisateur.Pseudo,'
    .' LieuCommentaire.IdUtilisateur,'
    .' LieuCommentaire.Message,'
    .' LieuCommentaire.Date,'
    .' LieuCommentaire.Supprimer'
    .'  FROM LieuCommentaire, Utilisateur'
    .'  WHERE LieuCommentaire.IdLieu = '.$lieu_id
    .'   AND Utilisateur.Id = LieuCommentaire.IdUtilisateur'
    .';'
  );
?>
