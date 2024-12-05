<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Maps</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		article {
			display: flex;
			flex-flow: row;
			justify-content: center;
		}
		
		@media screen and (max-width: 500px) {
			article {
				flex-flow: column;
			}
			#Maps {
				order: 2;
			}
			#MapSearch {
				order: 1;
			}
		}
	
		#Maps, #MapSearch {
			display: inline-block;
			vertical-align: top;
			text-align: left;
			flex-grow: 1;
			max-width: 300px;
		}
		
		#Maps a {
			color: inherit;
			text-decoration: inherit;
		}
		
		#SearchBar, #NumPlayers {
			margin-top: 20px;
			margin-bottom: 20px;
		}
		
		#searchBarInput {
			width: calc(100% - 20px);
		}
		
		h2 {
			text-align: center;
		}
		
		h3 {
			text-align: left;
		}
		
		#TerrainSets label, #Tags label {
			display: block;
		}
		
		#TerrainSets label input, #numPlayersInput {
			margin-right: 10px;
			width: 35px;
		}
		
		#Tags label input {
			
		}
		
		.highlight {
			background-color: yellow;
		}
		
		.authorName {
			color: red;
		}
		
		.mapDiv {
			position: relative;
		}
		
		.mapDiv a:hover + div {
			display: block;
		}
		
		.mapInfoDiv {
			display: none;
			position: absolute;
			top: 25px;
			background-color: tan;
			color: black;
			border: 1px solid black;
			border-radius: 10px;
			z-index: 1000;
			padding-left: 5px;
			padding-right: 5px;
		}
		
		.mapInfoDiv p {
			margin-top: 2px;
			margin-bottom: 2px;
		}
		
		.mapInfoDiv img {
			height: 100px;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	
	<script src="/connect/socket.io/socket.io.js"></script>
	
	<script type='text/javascript'>
		GameMap.options.fieldsToInclude = ["name", "number", "active", "forStreaming"];
		GameMap.options.linksToInclude = [];
		GameMap.options.labelsToIgnore = ["name"];
		
		serverResponses = 0;
		function checkPageLoaded() {
			serverResponses++;
			if (serverResponses >= 3) {
				displayPage();
			} 
		}
		
		function displayPage() {
			_displayMaps();
			_displayMapSearchParams();
		}
		
		function _displayMaps() {
			var parentElem = document.getElementById('Maps');
			parentElem.innerHTML = "";
			parentElem.appendChild(createH2({innerHTML: "Maps"}));
			
			// Search & Filter Data
			var searchText = document.getElementById("searchBarInput").value.toLowerCase();
			var numPlayers = document.getElementById("numPlayersInput").value;
			var terrainSetInputs = document.getElementsByClassName("terrainSet");
			var terrainSets = {};
			for (let i = 0; i < terrainSetInputs.length; i++) {
				const setInput = terrainSetInputs[i];
				if (setInput.value != null && setInput.value.length > 0 /*&& setInput.value > 0*/) {
					terrainSets[setInput.name.split("_")[1]] = setInput.value;
				}
			}
			var tagInputs = document.getElementsByClassName("tag");
			var tags = [];
			for (let i = 0; i < tagInputs.length; i++) {
				const tagInput = tagInputs[i];
				if (tagInput.checked) {
					tags.push(HeroscapeMapTag.get({id: tagInput.value}));
				}
			}
			
			for (let i = 0; i < HeroscapeMap.list.length; i++) {
				const map = HeroscapeMap.list[i];
				
				var mapName = map.name;
				
				// Apply Search & Filter
				if (searchText.length > 0) {
					if (! map.name.toLowerCase().includes(searchText) && 
							(map.authorName === null || ! map.authorName.toLowerCase().includes(searchText))) {
						continue;
					}
					if (map.name.toLowerCase().includes(searchText)) {
						const startIdx = map.name.toLowerCase().indexOf(searchText);
						mapName = mapName.substr(0, startIdx) + 
							"<span class='highlight'>" + 
							mapName.substr(startIdx, searchText.length) + 
							"</span>" + 
							mapName.substr(startIdx + searchText.length);
					} else {
						mapName += " <span class='authorName'>[" + map.authorName + "]</span>";
					}
				}
				if (numPlayers !== null && numPlayers.length > 0 && 
						(map.numberOfPlayers === null || map.numberOfPlayers != numPlayers)) {
					continue;
				}
				if (Object.keys(terrainSets).length > 0) {
					if (map.heroscapeMapSets.length == 0) {
						continue;
					}
					var skipMap = false;
					for (let k = 0; k < map.heroscapeMapSets.length; k++) {
						const setAndQuantity = map.heroscapeMapSets[k];
						var setFound = false;
						for (let j = 0; j < Object.keys(terrainSets).length; j++) {
							const set = HeroscapeSet.get({id: Object.keys(terrainSets)[j]});
							const quantity = terrainSets[set.id];
							if (setAndQuantity.terrainSet.id == set.id) {
								if (quantity >= setAndQuantity.quantity) {
									setFound = true;
								}
								break;
							}
						}
						if ( ! setFound) {
							skipMap = true;
							break;
						}
					}
					if (skipMap) {
						continue;
					}
				}
				if (tags.length > 0) {
					var skipMap = false;
					for (let j = 0; j < tags.length; j++) {
						var tagMatch = false;
						for (let k = 0; k < map.tags.length; k++) {
							if (tags[j].id == map.tags[k].id) {
								tagMatch = true;
								break;
							}
						}
						if (! tagMatch) {
							skipMap = true;
							break;
						}
					}
					if (skipMap) {
						continue;
					}
				}
				
				var mapDiv = createDiv({
					class: "mapDiv"
				});
				parentElem.appendChild(mapDiv);
				
				mapDiv.appendChild(createA({
					innerHTML: mapName,
					href: "/map/view/?HeroscapeMap="+map.id
				}));
				
				var mapInfoDiv = createDiv({
					class: "mapInfoDiv"
				});
				mapInfoDiv.appendChild(createP({innerHTML: "By " + map.authorName}));
				mapInfoDiv.appendChild(createImage({src: map.imageUrl}));
				var mapSetNames = "";
				for (let i = 0; i < map.heroscapeMapSets.length; i++) {
					if (i > 0) {
						mapSetNames += ", ";
					}
					mapSetNames += map.heroscapeMapSets[i].terrainSet.abbreviation + " x" + map.heroscapeMapSets[i].quantity;
				}
				mapInfoDiv.appendChild(createP({innerHTML: mapSetNames}));
				mapDiv.appendChild(mapInfoDiv);
			}
		}
		
		function _displayMapSearchParams() {
			var terrainSetsDiv = document.getElementById("TerrainSets");
			terrainSetsDiv.appendChild(createH3({innerHTML: "Terrain Available"}));
			for (let i = 0; i < HeroscapeSet.list.length; i++) {
				const set = HeroscapeSet.list[i];
				var label = createLabel({});
				terrainSetsDiv.appendChild(label);
				label.appendChild(createInput({
					name: "terrainSet_"+set.id,
					type: "number",
					class: "terrainSet",
					min: "0",
					step: "1",
					oninput: "_displayMaps()"
				}));
				label.appendChild(createText(set.name));
			}
			
			var tagsDiv = document.getElementById("Tags");
			tagsDiv.appendChild(createH3({innerHTML: "Tags"}));
			for (let i = 0; i < HeroscapeMapTag.list.length; i++) {
				const tag = HeroscapeMapTag.list[i];
				var label = createLabel({});
				tagsDiv.appendChild(label);
				label.appendChild(createInput({
					name: "tag_"+tag.id,
					type: "checkbox",
					class: "tag",
					value: tag.id,
					oninput: "_displayMaps()"
				}));
				label.appendChild(createText(tag.tag));
			}
		}
		
		function _reset() {
			document.getElementById("searchBarInput").value = "";
			
			document.getElementById("numPlayersInput").value = "";
			
			var terrainSets = document.getElementsByClassName("terrainSet");
			for (let i = 0; i < terrainSets.length; i++) {
				terrainSets[i].value = "";
			}
			
			var tags = document.getElementsByClassName("tag");
			for (let i = 0; i < tags.length; i++) {
				tags[i].checked = false;
			}
			
			_displayMaps();
		}
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(MapNav); ?>
	
	<div id='pageContent'>		
		<article>
			<div id='Maps'></div>
			<div id='MapSearch'>
				<h2>Search & Filter</h2>
				<div id='SearchBar'>
					<input 
						id='searchBarInput' 
						type='text' 
						placeholder='Search...'
						oninput='_displayMaps()' />
				</div>
				<div id='NumPlayers'>
					<label>
						<input id='numPlayersInput' type='number' 
							min='0' step='1' 
							oninput='_displayMaps()'/>
						# Players
					</label>
				</div>
				<div id='Reset'>
					<button onclick='_reset()'>Reset Search & Filter</button>
				</div>
				<div id='TerrainSets'></div>
				<div id='Tags'></div>
			</div>
			<script>
				HeroscapeSet.load(
					{},
					function (maps) {
						checkPageLoaded();
					},
					{joins: {}}
				);
				HeroscapeMapTag.load(
					{},
					function (maps) {
						checkPageLoaded();
					},
					{joins: {}}
				);
				HeroscapeMap.load(
					{},
					function (maps) {
						checkPageLoaded();
					},
					{joins: {
						"HeroscapeMapSet.mapID" : {
							"terrainSetID": {}
						},
						"HeroscapeMapTagLink.mapID" : {
							"tagID": {}
						}
				}});
			</script>
		</article>
	</div>
	<?php include(Footer); ?>

</div></body>
</html>