<?php include('header.php'); ?>	
					
<div class="card text-center">
		<div class="card-body">
			<form id="sampleForm" name="sampleForm" method="get" action="recherche_recherche.php" class="form-group">
				<p>
					<label class="float-left" for="lat">Latitude :&nbsp;</label><input class="form-control" type="text" name="lat" id="lat" value=""><br>
					<label class="float-left" for="long">Longitude :&nbsp;</label><input type="text" name="long" id="long" class="form-control" value=""><br>

					<label class="float-left"">Distance :&nbsp;</label><small id="help" class="form-text text-muted text-right">en kilomètres</small><input class="form-control" type="text" name="distance" value="20"><br>
					
				
					
					<select class="chosen_select" name="tags[]" multiple>
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
					<input class="btn btn-secondary" type = 'button' onclick = 'geoloc()' value = 'Me localiser'>
					<input class="btn btn-primary" type="submit" value="Rechercher" />
				</p>
			</form>
		</div>
</div>

<script>
$('.chosen_select').chosen({
	width: "95%"
});

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