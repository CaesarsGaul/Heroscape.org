<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Events</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		#map {
			margin: auto;
			width: 700px;
			height: 500px;
			max-width: calc(100% - 20px);
		}
		
		#map a {
			color: black;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

	<!--<script src="/connect/socket.io/socket.io.js"></script>-->
	
	<script>
	
		/*socket = null;
		function createSocket() {
			if (socket != null) {
				return;
			}
			
			socket = io.connect("/", {path: "/connect/socket.io"});
			
			socket.on("announcementError", function(objStr) {
				alert("There was an unknown error sending the announcement.");
			});
		}
		createSocket();*/
		
		var tournaments = null;
		var conventions = null;
		var map = null;
		
		function populateMap() {
			if (map == null || tournaments == null || conventions == null) {
				return;
			}
			
			for (let i = 0; i < tournaments.length; i++) {
				const tournament = tournaments[i];
				if (tournament.address != null) {
					geocoder.geocode( { 'address': tournament.address}, function(results, status) {
						if (status == 'OK') {
							const location = results[0].geometry.location;
							const marker = new AdvancedMarkerElement({
								map: map,
								position: { lat: location.lat(), lng: location.lng() },
								title: tournament.fullDisplayName(),
								gmpClickable: true
							});
							marker.addListener('click', ({ domEvent, latLng }) => {
								const { target } = domEvent;
								infoWindow.close();
								infoWindow.setContent("<a href='https://heroscape.org/events/tournament/?Tournament="+tournament.id+"' target='_blank'>"+marker.title+"</a>");
								infoWindow.open(marker.map, marker);
							});
						} else {
							// TODO - Error Handling
						}
					});
				}
			}
			
			for (let i = 0; i < conventions.length; i++) {
				const convention = conventions[i];
				if (convention.address != null) {
					geocoder.geocode( { 'address': convention.address}, function(results, status) {
						if (status == 'OK') {
							const location = results[0].geometry.location;
							const pinGlyph = new PinElement({
								glyphColor: "white",
								//borderColor: "pink",
								//background: "green"
							});
							const marker = new AdvancedMarkerElement({
								map: map,
								position: { lat: location.lat(), lng: location.lng() },
								title: convention.name,
								content: pinGlyph.element,
								gmpClickable: true
							});
							marker.addListener('click', ({ domEvent, latLng }) => {
								const { target } = domEvent;
								infoWindow.close();
								infoWindow.setContent("<a href='https://heroscape.org/events/convention/?Convention="+convention.id+"' target='_blank'>"+marker.title+"</a>");
								infoWindow.open(marker.map, marker);
							});
						} else {
							// TODO - Error Handling
						}
					});
				}
			}
		}
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(EventsNav); ?>
	
	<div id='pageContent'>	
		<h1>Upcoming Events</h1>
		<article>	
			<!--The div element for the map -->
			<div id="map"></div>

			<script>
				(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
				({key: "AIzaSyBFHfaA7c_5YQ5G6GNQWKLAsUxCQOE0FRc", v: "weekly"});
			</script>
			
			<script>
			
			
			// Initialize and add the map
			let infoWindow;
			let geocoder;
			let AdvancedMarkerElement;
			let PinElement;
			async function initMap() {
				// Request needed libraries.
				const { Map, InfoWindow } = await google.maps.importLibrary("maps");
				const MarkerLib = await google.maps.importLibrary("marker");
				AdvancedMarkerElement = MarkerLib.AdvancedMarkerElement;
				PinElement = MarkerLib.PinElement;
				infoWindow = new InfoWindow();
				geocoder = new google.maps.Geocoder();
				// The map
				const centerOfUS = { lat: 40.0, lng: -95.0 };
				map = new Map(document.getElementById("map"), {
					zoom: 4,
					center: centerOfUS,
					mapId: "DEMO_MAP_ID",
				});
				populateMap();
			}
			initMap();

			</script>
			
			<script>			
				const today = datetimeToString(new Date());
				
				Tournament.load(
					{startAfter: today,
						convention: null},
					function (t) {
						tournaments = t;
						populateMap();
					},
					{joins: {
						"conventionID": {
							"conventionSeriesID": {}
						},
						"TournamentSeasonLink.tournamentID": {
							"seasonID": {
								"leagueID": {}
							}
						}
					}}
				);
				
				Convention.load(
					{endAfter: today},
					function (c) {
						conventions = c;
						populateMap();
					},
					{joins: {
						
					}}
				);
			</script>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>