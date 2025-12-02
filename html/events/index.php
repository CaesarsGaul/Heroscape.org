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
		
		#pageContent {
			/*min-height: calc(100vh - 233px) !important;*/
		}	
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script>
		var tournaments = null;
		var conventions = null;
		var map = null;
		
		function populateMap() {
			if (map == null || tournaments == null || conventions == null) {
				return;
			}
			
			var onlineParentElem = document.getElementById("OnlineList");
			onlineParentElem.innerHTML = "";
			
			var eventsByAddress = {};
			for (let i = 0; i < conventions.length; i++) {
				const convention = conventions[i];
				if (convention.address != null && convention.latitude != null && convention.longitude != null) {
					if (eventsByAddress[convention.address.trim()] === undefined) {
						eventsByAddress[convention.address.trim()] = [];
					}
					eventsByAddress[convention.address.trim()].push(convention);
				}
			}
			for (let i = 0; i < tournaments.length; i++) {
				const tournament = tournaments[i];
				if (tournament.address != null && tournament.latitude != null && tournament.longitude != null) {
					if (eventsByAddress[tournament.address.trim()] === undefined) {
						eventsByAddress[tournament.address.trim()] = [];
					}
					eventsByAddress[tournament.address.trim()].push(tournament);
				} else if (tournament.online) {
					var pElem = createP({});
					pElem.appendChild(createA({
						innerHTML: tournament.fullDisplayName(),
						href: "/events/tournament/?Tournament="+tournament.id,
						target: "_blank"
					}));
					onlineParentElem.appendChild(pElem);					
				}
			}			
			
			for (const [address, eventArray] of Object.entries(eventsByAddress)) {
				const pinGlyph = new PinElement({
					glyphColor: eventArray[0] instanceof Convention
						? "white"
						: "black"
				});
				const marker = new AdvancedMarkerElement({
					map: map,
					position: { lat: parseFloat(eventArray[0].latitude), lng: parseFloat(eventArray[0].longitude) },
					title: eventArray[0] instanceof Convention
						? eventArray[0].name
						: eventArray[0].fullDisplayName(),
					zIndex: eventArray[0] instanceof Convention
						? 20
						: 10,
					content: pinGlyph.element,
					gmpClickable: true
				});
				marker.addListener('click', ({ domEvent, latLng }) => {
					const { target } = domEvent;
					infoWindow.close();
					var infoWindowContent = "";
					for (let j = 0; j < eventArray.length; j++) {
						const event = eventArray[j];
						if (event instanceof Convention) {
							infoWindowContent += "<p><a href='https://heroscape.org/events/convention/?Convention="+event.id+"' target='_blank'>"+event.name+"</a></p>";
						} else if (event instanceof Tournament){
							infoWindowContent += "<p><a href='https://heroscape.org/events/tournament/?Tournament="+event.id+"' target='_blank'>"+event.fullDisplayName()+"</a></p>";
						}
					}
					infoWindow.setContent(infoWindowContent);
					infoWindow.open(marker.map, marker);
				});
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
			<div>
				<p>Don't see an event near where you live? View the <a href='/community'>community</a> page to see more resources that might be in your area.</p>
			</div>
			
			<!--The div element for the map -->
			<div id="map"></div>
			<div id="Online">
				<h2>Online Events</h2>
				<div id="OnlineList">
				
				</div>
			</div>

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