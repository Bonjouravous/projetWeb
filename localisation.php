<?php
include('header.php');
?>
<form id="sampleForm" name="sampleForm" method="get" action="recherche.php">
<p>
<label for="lat">Lattitude :</label>
<input type="text" name="lat" id="lat" value="">

<label for="long">Longitude :</label>
<input type="text" name="long" id="long" value="">

<label for="distance">Distance :</label>
<input type="text" name="distance" value="2000">km
</p>
<p>
<input type = 'button' onclick = 'geoloc()' value = 'Me localiser'>
<input type="submit" value="Rechercher" />
</p>
</form>

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