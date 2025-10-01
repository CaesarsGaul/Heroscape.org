<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Map</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		.mapImg {
			width: 80%;
			max-width: 600px;
		}
		
		.tournamentDiv {
			text-align: left;
			margin-left: 40px;
		}
		
		.tournamentNameDiv {
			margin-left: -40px;
			text-decoration: underline;
		}
		
		.tournamentNameDiv a {
			color: inherit
		}
		
		.hidden {
			display: none;
		}
		
		.mapVersion {
			position: relative;
		}
		
		.versionChangeIcon {
			position: absolute;
			top: 10px;
		}
		
		.versionChangeIconLeft {
			left: 50px;
		}
		
		.versionChangeIconRight {
			right: 50px;
		}
		
		.versionChangeImage {
			width: 30px;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	
	<script src="/connect/socket.io/socket.io.js"></script>
	
	<script>
		HeroscapeMap.options.fieldsToInclude = ["name", "authorName", "buildInstructionsUrl", "imageUrl", "numberOfPlayers", "ohsGdocId", "hexoscapeUrl"];
		HeroscapeMap.options.linksToInclude = ["heroscapeMapSets", "tags", "heroscapeMapPreviousVersions"];
		HeroscapeMap.options.labelsToIgnore = ["name"];
		
		HeroscapeMapSet.options.fieldsToInclude = ["terrainSet", "quantity"];
		HeroscapeMapSet.options.multiLevelEditsToSkip = ["create"];
		
		GameMap.options.fieldsToInclude = ["name", "number", "active", "forStreaming"];
		GameMap.options.linksToInclude = [];
		GameMap.options.labelsToIgnore = ["name"];
		
		HeroscapeMapPreviousVersion.options.fieldsToInclude = ["versionNumber", "buildInstructionsUrl", "imageUrl", "ohsGdocId", "startDate", "endDate"];
		
		mapsLoaded = false;
		tournamentsLoaded = false;
		
		function checkPageLoaded() {
			displayPage();
			/*if (mapsLoaded && tournamentsLoaded) {
				displayPage();
			}*/
		}
		
		var map = null;
		function displayPage() {
			/*HeroscapeMap.displayDropdownPreloaded(
				"Maps",
				function (selectElem) {
					map = $(selectElem.options[selectElem.selectedIndex])
						.data("databaseObject");
					displayMap();
				},
				null,
				null,
				{includeLabel: false});*/
			map = HeroscapeMap.list[0];
			
			document.getElementsByTagName("title")[0].innerHTML = map.name;
			document.getElementsByTagName("h1")[0].innerHTML = map.name;
			
			displayMap();
			
			if (map.editableByUser) {
				displayEditMap();
			}
		}
		
		function displayMap() {
			var parentElem = document.getElementById("Map");
			parentElem.innerHTML = "";
			if (map != null) {
				if (map.authorName != null) {
					var authorNameDiv = createDiv({});
					parentElem.appendChild(authorNameDiv);
					var authorSpan = createSpan({
						innerHTML: "By "
					});
					authorSpan.appendChild(createA({
						href: "/user/?userName="+map.authorName,
						target: "_blank",
						innerHTML: map.authorName
					}));
					authorNameDiv.appendChild(authorSpan);
				}
				
				var numPlayersDiv = createDiv({});
				parentElem.appendChild(numPlayersDiv);
				numPlayersDiv.appendChild(createSpan({
					innerHTML: map.numberOfPlayers + " Players"
				}));
				
				if (map.heroscapeMapSets.length > 0) {
					var setsDiv = createDiv({});
					parentElem.appendChild(setsDiv);
					//setsDiv.appendChild(createSpan({innerHTML: "Terrain Requirements: "}));
					for (let i = 0; i < map.heroscapeMapSets.length; i++) {
						if (i > 0) {
							setsDiv.appendChild(createSpan({innerHTML: ", "}));
						}
						setsDiv.appendChild(createSpan({
							innerHTML: map.heroscapeMapSets[i].terrainSet.abbreviation + " x" + map.heroscapeMapSets[i].quantity
						}));
					}
				}
				
				var tagsDiv = createDiv({});
				parentElem.appendChild(tagsDiv);
				tagsDiv.appendChild(createSpan({
					innerHTML: "Tags: "
				}));
				for (let i = 0; i < map.tags.length; i++) {
					if (i > 0) {
						tagsDiv.appendChild(createSpan({
							innerHTML: ", "
						}));
					}
					tagsDiv.appendChild(createSpan({
						innerHTML: map.tags[i].tag
					}));
				}
				
				if (map.ohsGdocId != null) {
					var ohsDiv = createDiv({});
					parentElem.appendChild(ohsDiv);
					ohsDiv.appendChild(createA({
						innerHTML: "Create OHS Game",
						class: "createOhsLink",
						href: "/ohs?HeroscapeMap="+map.id+"&create=y",
						target: "_blank"}));
				}
				
				if (map.hexoscapeUrl != null) {
					var hexoscapeDiv = createDiv({});
					parentElem.appendChild(hexoscapeDiv);
					hexoscapeDiv.appendChild(createA({
						innerHTML: "Hexoscape Map Builder",
						/*class: "createOhsLink",*/
						href: map.hexoscapeUrl,
						target: "_blank"}));
				}
				
				var versionDivCount = 0;
				createVersionDiv(parentElem, map, versionDivCount++, map.heroscapeMapPreviousVersions.length+1);
				map.heroscapeMapPreviousVersions.sort(function(a,b){
					if (a.versionNumber < b.versionNumber) {
						return 1;
					} else if (a.versionNumber > b.versionNumber) {
						return -1;
					} else {
						return 0;
					}
				});
				for (let i = 0; i < map.heroscapeMapPreviousVersions.length; i++) {
					createVersionDiv(parentElem, map.heroscapeMapPreviousVersions[i], versionDivCount++, map.heroscapeMapPreviousVersions.length+1);
				}
				
				var tournamentUseDiv = createDiv({});
				parentElem.appendChild(tournamentUseDiv);
				tournamentUseDiv.appendChild(createH2({
					innerHTML: "Tournament Use"
				}));
				if (tournamentsLoaded) {
					Tournament.list.sort(function(a,b) {
						if (a.id < b.id) {
							return -1; 
						} else if (a.id > b.id) {
							return 1;
						}
						return 0;
					})
					for (let i = 0; i < Tournament.list.length; i++) {
						const tournament = Tournament.list[i];
						var mapUsed = false;
						var mapCountInPool = 0;
						var mapGamesPlayed = 0;
						for (let j = 0; j < tournament.gameMaps.length; j++) {
							const gameMap = tournament.gameMaps[j];
							if (gameMap.name.toLowerCase() == map.name.toLowerCase()) {
								mapUsed = true;
								mapCountInPool++;
								/*for (let k = 0; k < gameMap.heroscapeGames.length; k++) {
									if (gameMap.heroscapeGames[k].round.id != undefined) {
										mapGamesPlayed++;
									}
								}*/
								mapGamesPlayed += gameMap.heroscapeGames.length;
							}
						}
						if (mapUsed) {
							var tournamentDiv = createDiv({
								class: "tournamentDiv"
							});
							tournamentUseDiv.appendChild(tournamentDiv);
							var tournamentNameDiv = createDiv({
								class: "tournamentNameDiv"
							});
							tournamentDiv.appendChild(tournamentNameDiv);
							tournamentNameDiv.appendChild(createA({
								innerHTML: tournament.fullDisplayName(),
								href: "https://heroscape.org/events/tournament/?Tournament="+tournament.id
							}));
							tournamentDiv.appendChild(createDiv({
								innerHTML: "# in Map Pool : " + mapCountInPool
							}));
							tournamentDiv.appendChild(createDiv({
								innerHTML: "# Games Played : " + mapGamesPlayed
							}));
						}
					}
				} else {
					parentElem.appendChild(createText("Loading..."));
					manuallyMarkPageLoaded();
				}
			}
		}
		
		function createVersionDiv(parentElem, mapVersion, counter, totalCount) {
			var versionDiv = createDiv({
				id: "MapVersion_"+counter,
				class: "mapVersion"
			});
			parentElem.appendChild(versionDiv);
			if (mapVersion instanceof HeroscapeMap) {				
				if (mapVersion.heroscapeMapPreviousVersions.length > 0) {
					versionDiv.appendChild(createH2({innerHTML: "Current Version"}));
				}
			} else if (mapVersion instanceof HeroscapeMapPreviousVersion) {
				versionDiv.appendChild(createH2({
					innerHTML: "Version " + mapVersion.versionNumber}));
				versionDiv.appendChild(createP({innerHTML: mapVersion.startDate + " - " + mapVersion.endDate}));
				versionDiv.classList.add("hidden");
			}
			
			var instructionsDiv = createDiv({});
			versionDiv.appendChild(instructionsDiv);
			instructionsDiv.appendChild(createA({
				innerHTML: "Build Instructions",
				href: mapVersion.buildInstructionsUrl,
				target: "_blank"
			}));

			var imageDiv = createDiv({});
			versionDiv.appendChild(imageDiv);
			imageDiv.appendChild(createImg({
				src: mapVersion.imageUrl,
				class: "mapImg"
			}));
			
			if (counter > 0) {
				var arrowDiv = createDiv({
					class: "versionChangeIcon versionChangeIconLeft",
					onclick: "changeDisplayVersion("+counter+","+(counter-1)+")"
				});
				versionDiv.appendChild(arrowDiv);
				arrowDiv.appendChild(createImg({
					src: "/images/leftArrow.png",
					class: "versionChangeImage"
				}));
			} 
			if (counter < totalCount-1) {
				var arrowDiv = createDiv({
					class: "versionChangeIcon versionChangeIconRight",
					onclick: "changeDisplayVersion("+counter+","+(counter+1)+")"
				});
				versionDiv.appendChild(arrowDiv);
				arrowDiv.appendChild(createImg({
					src: "/images/rightArrow.png",
					class: "versionChangeImage"
				}));
			}
		}
		
		function changeDisplayVersion(from, to) {
			document.getElementById("MapVersion_"+from).classList.add("hidden");
			document.getElementById("MapVersion_"+to).classList.remove("hidden");
		}
		
		function displayEditMap() {
			document.getElementById("EditMap").innerHTML = "";
			document.getElementById("EditMap").appendChild(createH2({innerHTML: "Edit Map"}));
			map.display("EditMap");
		}
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>		
		<article>
			<h1></h1>
			<!--<div id='Maps'></div>-->
			<div id='Map'></div>
			<div id='EditMap'></div>
			<script>
				HeroscapeSet.load(
					{},
					null,
					{joins: {}}
				);
				HeroscapeMapTag.load(
					{},
					null,
					{joins: {}}
				);
				
				var mapID = findGetParameter("HeroscapeMap");
				if (mapID !== null) {
					HeroscapeMap.load(
						{id: mapID},
						function (maps) {
							mapsLoaded = true;
							
							const map = maps[0];
							MapTournamentUseView.load(
								{GameMap_name: map.name},
								function (viewEntries) {
									DatabaseObject.extractView(MapTournamentUseView.list);
									tournamentsLoaded = true;
									checkPageLoaded();
								},
								{joins: {}}
							);
							
							checkPageLoaded();
						},
						{joins: {
							"HeroscapeMapSet.mapID" : {
								"terrainSetID": {}
							},
							"HeroscapeMapTagLink.mapID" : {
								"tagID": {}
							},
							"HeroscapeMapPreviousVersion.mapID": {}
					}});
					/*Tournament.load(
						{},
						function (tournaments) {
							tournamentsLoaded = true;
							checkPageLoaded();
						},
						{joins: {
							"GameMap.tournamentID": {
								"HeroscapeGame.mapID": {}
							},
							"conventionID": {},
							"TournamentSeasonLink.tournamentID": {
								"seasonID": {
									"leagueID": {}
								}
							}
						}}
					);*/
				} else {
					document.getElementById("Map").innerHTML = "Error : Page was not loaded via a valid link";
				}
			</script>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>