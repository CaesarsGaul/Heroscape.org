<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>

	<title>Heroscape.org Software</title>
	
	<!-- CSS -->
	<!--<link rel="stylesheet" type="text/css" href="/css/TODO.css">-->
	<style>
		article {
			text-align: left;
		}
		
		.column {
			display: inline-block;
			width: 45%;
			max-width: 400px;
			min-width: min(95%, 300px);
			vertical-align: top;
			margin-left: 10px;
			margin-right: 10px;
		}
		
		@media screen and (max-width: 680px) {
			.column {
				display: block;
				margin: auto;
				max-width: 500px;
				width: calc(100% - 20px);
			}
		}
		
		.section {
			width: 100%;
			min-height: 100px;
		}
		
		/*.betaTesting {
			text-align: center;
			color: red;
			font-size: 20px;
		}*/
		
		.highlightMap {
			width: 100%;
		}
		
		#mapSection p, #mapSection a {
			display: block;
			text-align: center;
			margin: 0;
		}
		
		#createOhsLink {
			display: inline-block;
		}
		
		.mapName {
			font-weight: bold;
		}
		
		#mapUserName a {
			display: inline;
		}
		
		h2 {
			text-align: center;
		}
		
		#Leagues {
			border-bottom: none !important;
		}
	</style>
	
	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	
	<script>
		const today = datetimeToString(new Date());
	</script>
</head>
<body><div id='content'>

	<?php include(Nav); ?>

	<div id='pageContent'>
		<h1>Heroscape.org Software</h1>
		<article>
			<!--<div class='betaTesting'>Warning: Site under active development & beta testing.</div>-->
			
			<div>
				<p>Heroscape.org contains several tools designed to enhance the game of Heroscape. See the <a href='/about'>about</a> page for more information.</p>
			</div>
			
			<div class='column'>
				<div class='section'>
					<h2>Seasons</h2>
					<p>A season tracks tournament results for some pre-determined group of tournaments.</p>
					<div id='Seasons'></div>
					<script>
						Season.load(
							{startBefore: today.substr(0, today.indexOf(' ')),
								endAfter: today.substr(0, today.indexOf(' '))},
							function (seasons) {
								var parentElem = document.getElementById("Seasons");
								for (let i = 0; i < seasons.length; i++) {
									const season = seasons[i];
									var newDiv = createDiv({});
									parentElem.appendChild(newDiv);
									newDiv.appendChild(createA({
										href: "/events/league/season/?Season="+season.id, 
										innerHTML: season.fullDisplayName()}));
								}
							},
							{joins: {
								"leagueID": {}
							}});
					</script>
				</div>
				
				<div class='section'>
					<h2>Leagues</h2>
					<p>A league tracks tournament results a given timeframe within a given season.</p>
					<div id='Leagues'></div>
					<script>			
						League.load(
							{},
							function (leagues) {
								var parentElem = document.getElementById("Leagues");
								for (let i = 0; i < leagues.length; i++) {
									const league = leagues[i];
									var newDiv = createDiv({});
									parentElem.appendChild(newDiv);
									newDiv.appendChild(createA({
										href: "/events/league/?League="+league.id, 
										innerHTML: league.name}));
								}
							},
							{joins: {
								"Season.leagueID": {}
							}}
						);
					</script>
				</div>
				
				<div class='section'>
					<h2>Current Tournaments</h2>
					<div id='currentTournaments'></div>
					<script>
						HeroscapeTournament.load(
							{startBefore: today,
								endAfter: today.substr(0, today.indexOf(' '))
								/*finished: false*/}, 
							function (tournaments) {		
								for (var i = 0; i < tournaments.length; i++) {
									displayTournament(tournaments[i], "currentTournaments");
								}
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
					</script>
				</div>
				
				<div class='section'>
					<h2>Upcoming Tournaments</h2>
					<div id='upcomingTournaments'></div>
					<script>
						HeroscapeTournament.load(
							{startAfter: today,
								convention: null}, 
							function (tournaments) {						
								for (var i = 0; i < tournaments.length; i++) {
									displayTournament(tournaments[i], "upcomingTournaments");
								}
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
					</script>
				</div>
			</div>
			
			<div class='column'>
				<div id='ohsSection' class='section'>
					<h2>Create OHS Game Link</h2>
					<p><a href='/ohs'>Create Link</a></p>
				</div>
				
				<div id='mapSection' class='section'>
					<h2>Highlighted Map</h2>
					<div id='Map'></div>
					<script>
						HeroscapeMap.load(
							{},
							function (maps) {
								const mapIdx = Math.floor(Math.random() * maps.length);
								const map = maps[mapIdx];
								var parentElem = document.getElementById("Map");
								parentElem.appendChild(createP({
									innerHTML: map.name,
									class: "mapName"}));
								if (map.authorName != null) {
									var authorP = createP({innerHTML: "By ", id: "mapUserName"});
									parentElem.appendChild(authorP);
									authorP.appendChild(createA({
										href: "/user/?userName="+map.authorName,
										target: "_blank",
										innerHTML: map.authorName
									}));
								}
								if (map.buildInstructionsUrl != null) {
									parentElem.appendChild(createA({
										innerHTML: "Build Instructions", 
										href: map.buildInstructionsUrl}));
								}
								if (map.numberOfPlayers != null) {
									parentElem.appendChild(createP({innerHTML: map.numberOfPlayers + " Players"}));
								}
								if (map.heroscapeMapSets.length > 0) {
									var setsP = createP({innerHTML: ""});
									parentElem.appendChild(setsP);
									for (let i = 0; i < map.heroscapeMapSets.length; i++) {
										if (i > 0) {
											setsP.innerHTML += ", ";
										}
										setsP.innerHTML += map.heroscapeMapSets[i].terrainSet.abbreviation + 
											" x" + map.heroscapeMapSets[i].quantity;
									}
								}
								if (map.tags.length > 0) {
									var tagsP = createP({innerHTML: "Tags: "});
									parentElem.appendChild(tagsP);
									for (let i = 0; i < map.tags.length; i++) {
										if (i > 0) {
											tagsP.innerHTML += ", ";
										}
										tagsP.innerHTML += map.tags[i].tag;
									}
								}
								if (map.ohsGdocId != null) {
									var ohsDiv = createDiv({});
									parentElem.appendChild(ohsDiv);
									/*ohsDiv.appendChild(createSpan({
										class: "ohsIcon",
										innerHTML: "OHS"
									}));*/
									
									ohsDiv.appendChild(createA({
										innerHTML: "Create OHS Game",
										id: "createOhsLink",
										class: "createOhsLink",
										href: "/ohs?HeroscapeMap="+map.id+"&create=y",
										target: "_blank"}));
								}
								if (map.imageUrl != null) {
									parentElem.appendChild(createImg({
										src: map.imageUrl,

										class: "highlightMap"}));
								}
							},
							{joins: {
								"HeroscapeMapSet.mapID": {
									"terrainSetID": {}
								},
								"HeroscapeMapTagLink.mapID": {
									"tagID": {}
								}
							}}
						);
				</script>
				</div>
				
				<div class='section'>
					<h2>Glyphs</h2>
					<a href='https://heroscape.org/map/glyph/'>Glyphs</a>
				</div>
				
				<div class='section'>
					<h2>Tournament Format Glossary</h2>
					<a href='https://heroscape.org/events/tournament/format-glossary'>Tournament Format Glossary</a>
				</div>
				
				<div class='section'>
					<h2>Conventions</h2>
					<div id='Conventions'></div>
					<script>
						Convention.load(
							{endAfter: today},
							function (conventions) {
								var parentElem = document.getElementById("Conventions");
								for (let i = 0; i < conventions.length; i++) {
									const convention = conventions[i];
									var newDiv = createDiv({});
									parentElem.appendChild(newDiv);
									newDiv.appendChild(createA({
										href: "/events/convention/?Convention="+convention.id, 
										innerHTML: convention.name}));
								}
							},
							{joins: {
								"Season.leagueID": {}
							}}
						);
					</script>
				</div>
				
				<div class='section'>
					<h2>Alt Versions</h2>
					<div id='AltVersions'></div>
					<script>
						FigureSet.load(
							{"public": true},
							function (figureSets) {
								var parentElem = document.getElementById("AltVersions");
								for (let i = 0; i < figureSets.length; i++) {
									const figureSet = figureSets[i];
									//if (figureSet.sDomain.length > 0) {
										var newDiv = createDiv({});
										parentElem.appendChild(newDiv);
										
										const figureSetUrl = figureSet.sDomain.length > 0
											? "https://"+figureSet.sDomain + ".heroscape.org"
											: "https://heroscape.org";
										
										newDiv.appendChild(createA({
											href: figureSetUrl, 
											innerHTML: figureSet.name}));
									//}
								}
							},
							{joins: {
								
							}}
						);
					</script>
				</div>
				
			</div>
			
			
		</article>
	</div>
	
	<?php include(Footer); ?>
</div></body>
</html>