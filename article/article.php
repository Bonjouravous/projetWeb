<?php
  /* Avant d'inclure le fichier, définir "$lieu_id" et inclure "header.php". */

  $lieu_first_infos_query = $bdd->query(
    'SELECT Nom, Date, GPS FROM Lieu WHERE Lieu.Id = '.$lieu_id
  );
  $lieu_nom = $lieu_first_infos_query['nom'];
  $lieu_gps = $lieu_first_infos_query['gps'];
  $lieu_date = $lieu_first_infos_query['date'];

  /* Définie "$lieu_medias_query", résultat de la requête:
   * 'SELECT IdUtilisateur, Media, Date, Supprimer FROM LieuMedia WHERE IdLieu = '.$lieu_id
   */
  include('media.php');

  /* Définie "$lieu_desc_idutilisateur", "$lieu_desc_utilisateur",
   * "$lieu_desc", "$lieu_desc_date".
   */
  include('description.php');

  /* Définie "$lieu_commentaires_query", résultat de la requête:
   * 'SELECT Utilisateur.Pseudo, LieuCommentaire.IdUtilisateur, LieuCommentaire.Message, LieuCommentaire.Date, LieuCommentaire.Supprimer FROM LieuCommentaire, Utilisateur WHERE LieuCommentaire.IdLieu = '.$lieu_id.' AND Utilisateur.Id = LieuCommentaire.IdUtilisateur'
   */
  include('commentaires.php');
?>
