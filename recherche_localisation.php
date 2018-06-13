<?php include('header.php'); ?>	
					
<div class="card text-center">
		<div class="card-body">
			<form id="sampleForm" name="sampleForm" method="get" action="recherche_recherche.php">
				<p>
					<label for="lat">Lattitude :&nbsp;</label><input type="text" name="lat" id="lat" value=""><br>

					<label for="long">Longitude :&nbsp;</label><input type="text" name="long" id="long" value=""><br>

					<label for="distance">Distance :&nbsp;</label><input type="text" name="distance" value="20">km<br>
					
				
					
					<select name="tags[]" multiple>
					<?php 
						$rep = $bdd->query('SELECT * FROM motcle');
						$rep->execute();
						$motscles = $rep->fetchAll(PDO::FETCH_ASSOC);
						print_r($motscles);
						
						foreach($motscles as $motcle) {
							echo ("<option value=".$motcle['id'].">".$motcle['mot']."</option>");
						}
					?>
					</select>
				</p>
				<p>
					<input type = 'button' onclick = 'geoloc()' value = 'Me localiser'>
					<input type="submit" value="Rechercher" />
				</p>
			</form>
		</div>
</div>

<script>
function success(position) {
	var lat = position.coords.latitude;
	var long = position.coords.longitude;
	document.sampleForm.lat.value = lat;
	document.sampleForm.long.value = long;
};

function error(err) {
	console.warn(`ERROR(${err.code}): ${err.message}`);
};
	
function geoloc() {
	navigator.geolocation.getCurrentPosition(success, error);
};
</script>

<?php
include('footer.php');
?>