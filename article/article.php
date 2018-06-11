<?php
  include('header.php');
?>


<section>
  <div>
    <h1>
      <?php
        /* Piocher le titre (h1) du lieu dans le BDD. */
      ?>
    </h1>
  </div>

  <div>
    <?php
    /* Gestion des médias à la Steam ?
     * Une seule barre défilante: vidéos en premier, images ensuite.
     * Définir une ou plusieurs variables pour remplir avec les bons médias.
     */
      include('media.php');
    ?>
  </div>

  <div>
    <?php
    /* Bibliothèque PHP pour extraire du code HTML d'un code reStructuredText:
     * https://github.com/Gregwar/RST
     * Différents niveaux de titre supportés, images supportées, liens URL aussi.
     */

    /* Définir une ou plusieurs variables pour remplir le contenu.
     */
      include('description.php');
    ?>
  </div>
</section>

<section>
  <?php
    /* Définir une ou plusieurs variables pour savoir quels commentaires charger. */
    include('commentaires.php');
  ?>
</section>

<?php
  include('footer.php');
?>