<?php
include_once('header.php');

?>

<button id="btnlocal" class="btn">Me localiser</button><br><br>
<div id="map" style="height: 600px;"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN2PTU4JQ2s_Ph8u4bo_pQpvVmlZt2s_Y"></script>
<script>
var map;

var features = [
	<?php
	$req = $bdd->query('SELECT id, nom, latitude, longitude FROM lieu');
	while($d = $req->fetch()){
	?>
	{
		position: new google.maps.LatLng(<?=$d['latitude']?>, <?=$d['longitude']?>),
		type: 'info',
		title: '<?=$d['nom']?>',
		id: <?=$d['id']?>
	},
	<?php
	}
	?>
];
var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
var icons = {
	parking: {
		icon: iconBase + 'parking_lot_maps.png'
	},
	library: {
		icon: iconBase + 'library_maps.png'
	},
	info: {
		icon: iconBase + 'info-i_maps.png'
	}
};

var currentloc = null;

function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 6,
		center: new google.maps.LatLng(46.75984,1.738281),
		mapTypeId: 'roadmap'
	});

	// Create markers.
	features.forEach(function(feature) {
		var marker = new google.maps.Marker({
			position: feature.position,
			icon: icons[feature.type].icon,
			map: map,
			title: feature.title
		});
		marker.addListener('click', function() {
			(new google.maps.InfoWindow({
				content: "Titre : " + feature.title + "<br>" + "<a href='lieu_voir.php?lieu=" + feature.id + "'>Voir</a>"
			})).open(map, marker);
		});
	});
	
	google.maps.event.addListener(map, 'dragend', actcenter);
	google.maps.event.addListener(map, 'zoom_changed', actcenter);
	google.maps.event.addListener(map, "rightclick", function( event ) {
		
		var oInfo = new google.maps.InfoWindow({
			'content' : '<a href="lieu_ajouter.php?lat='+event.latLng.lat()+'&lng='+event.latLng.lng()+'">Ajouter un lieu ici</a>', // contenu qui sera affiché  
			'map' : map,                                           // carte sur laquelle est affichée l'InfoWindow    
			'position' : event.latLng       // position d'affichage de l'InfoWindow
		});
	});
}

function actcenter() {
	window.location.hash = map.getCenter().lat()+','+map.getCenter().lng()+','+map.getZoom();
}

function verifcenter() {
	var hash = window.location.hash.substr(1);
	var p = hash.split(',');
	if(p.length == 3) {
		var lat = p[0];
		var lng = p[1];
		map.setCenter(new google.maps.LatLng(lat, lng));
		map.setZoom(parseInt(p[2]));
	}
}

$('#btnlocal').click(function() {
	navigator.geolocation.getCurrentPosition(function(position) {
		var lat = position.coords.latitude;
		var lng = position.coords.longitude;
		window.location.hash = lat+','+lng+','+16;
		verifcenter();
		
		if(currentloc == null) {
			currentloc = new google.maps.Marker({
				position: new google.maps.LatLng(lat, lng),
				map: map,
				title: 'Moi'
			});
			currentloc.addListener('click', function() {
			(new google.maps.InfoWindow({
				content: "Ma position"
			})).open(map, currentloc);
		});
		} else {
			currentloc.setPosition(new google.maps.LatLng(lat, lng));
		}
		
	}, function(err) {console.warn(`ERROR(${err.code}): ${err.message}`);});
});


initMap();
verifcenter();
</script>

<?php include_once('footer.php');
