<?php
  /* A définir avant d'inclure le fichier: $lieu_id . */
  try {
    $DB = new PDO('mysql:host=localhost;dbname=projetweb', 'root', '');

    include('../header.php');
?>


<section>
  <?php
    $lieu_id=
    $lieu_header_query = $DB->query('SELECT Nom, Date, GPS FROM Lieu WHERE Lieu.Id = '.$lieu_id);
  ?>
  <div>
    <h1>
      <?php
        /* Piocher le titre (h1) du lieu dans la BDD. */
        echo $lieu_header_query['Nom'];
      ?>
    </h1>
    <p>
      <!-- Date de dernière modification. -->
      <?php
        echo $lieu_header_query['Date'];
      ?>
    </p>
      <!-- Mots-clés à afficher sur 1 ligne. -->
      <?php
        foreach($DB->query('SELECT Motcle.Mot FROM WHERE Lieumotcle.Idlieu = '.$lieu_id.' AND Lieumotcle.Idmot = Motcle.Id') as $row) {
          echo '<div>'.$row['Mot'].'</div>';
        }
      ?>
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
    $DB = null;
  } catch (PDOException $e) {
    echo '<p>'.$e->getMessage().'</p>';
  }
  include('../footer.php');
?>
