<?php include('header.php'); ?>


<?php
  if ($_POST['create']) {
      $bdd->query('INSERT INTO lieu(nom) VALUES('.$_POST['title'].');');
  } else {
      
  }
?>


<?php include('footer.php'); ?>
