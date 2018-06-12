<?php
  /* Avant d'inclure le fichier, définir "$lieu_id" et inclure "header.php". */

  $lieu_first_infos_query = $bdd->query(
    'SELECT nom, date, gps FROM lieu WHERE id = '.$lieu_id.';'
  )->fetch();
  $lieu_nom = $lieu_first_infos_query['nom'];
  $lieu_gps = $lieu_first_infos_query['gps'];
  $lieu_date = $lieu_first_infos_query['date'];

  /* Boucler sur cette variable pour obtenir chaque mot-clé. */
  $lieu_motcles_query = $bdd->query(
    'SELECT motcle.mot FROM motcle, lieumotcle'
    .' WHERE lieumotcle.idlieu = '.$lieu_id
    .' AND lieumotcle.idmot = motcle.id'
    .';'
  );

  /* Définie "$lieu_medias_query", résultat de la requête:
   * 'SELECT IdUtilisateur, Media, Date, Supprimer FROM LieuMedia WHERE IdLieu = '.$lieu_id
   * Type: array
   */
  include('media.php');

  /* Définie "$lieu_desc_idutilisateur", "$lieu_desc_utilisateur",
   * "$lieu_desc", "$lieu_desc_date".
   * "$lieu_desc" est la description formatée en HTML.
   */
  include('description.php');

  /* Définie "$lieu_commentaires_query", résultat de la requête:
   * 'SELECT Utilisateur.Pseudo, LieuCommentaire.IdUtilisateur, LieuCommentaire.Message, LieuCommentaire.Date, LieuCommentaire.Supprimer FROM LieuCommentaire, Utilisateur WHERE LieuCommentaire.IdLieu = '.$lieu_id.' AND Utilisateur.Id = LieuCommentaire.IdUtilisateur'
   * Type: array
   */
  include('commentaires.php');
?>
