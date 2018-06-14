 <?php include('header.php'); ?>

      <h1 class="my-4">Let’s Discover
        <small>by Team 2</small>
      </h1>

      <div class="row">

        <div class="col-md-8">
          <img class="img-fluid" src="images/johannes-plenio-629983-unsplash.jpg" height="500" width="750" alt="image de bienvenue">
        </div>

        <div class="col-md-4">
          <h3 class="my-3">Le patrimoine local</h3>
          <p>Le patrimoine regroupe des lieux culturels exceptionnels qui appartiennent à tout le monde, tels que les pyramides d’Égypte, la ville de Venise, le Taj Mahal ou le Machu Picchu. Non seulement le site «Let’s Discover » prend part à la protection de cet héritage unique, mais il s’occupe aussi de le partager et de le faire connaitre.</p>
          <h3 class="my-3">Caractéristiques</h3>
          <ul>
            <li>Géolocalisation</li>
            <li>Partages</li>
            <li>Profils</li>
            <li>Commentaires</li>
            <li>Collaboratif</li>
          </ul>
        </div>

      </div>
      <!-- /.row -->

      <h3 class="my-4">Les plus aimés</h3>
		<div class="row">
      <?php
			$rep = $bdd->query('select lieu.id, lieu.nom, lieu.latitude, lieu.longitude, IFNULL(sum(likelieu.avis),0) as reputation  from lieu left join likelieu on likelieu.idlieu=lieu.id group by lieu.id ORDER BY reputation DESC limit 0,4');
			$rep->execute();
			$reputations = $rep->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($reputations as $reputation){ ?>
				<div class="col-md-3 col-sm-6 mb-4">
					<a href="lieu_voir.php?lieu=<?= $reputation['id']?>">
						<h3><?= $reputation['nom']?></h3></br>
					</a>
						<h3><?= $reputation['longitude']?></h3></br>
						<h3><?= $reputation['latitude']?></h3>
					
				</div>
			<?php } ?>
	  </div>
      <!-- /.row -->

  <?php include('footer.php'); ?>