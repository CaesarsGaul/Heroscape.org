<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Terrain Sets</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		.heroscapeSetGroup {
			display: inline-block;
			width: 310px;
			vertical-align: top;
		}
		
		.heroscapeSetDiv {
			text-align: left;
		}
		
		.heroscapeSetDiv a {
			text-decoration: none;
		}
		
		.heroscapeSetDiv a:visited {
			color: inherit !important; /* Not working - why? */
		}
		
		.heroscapeSetAbbreviation {
			display: inline-block;
			width: 50px;
		}
		
		.heroscapeSetName {
			display: inline-block;
		}
		
		
		#TerrainTypes table th {
			padding-left: 5px;
			padding-right: 5px;
		}
		#TerrainTypes table td:nth-child(1) {
			width: 125px;
		}
		#TerrainTypes table td:nth-child(4) {
			text-align: left;
		}
		.terrainImage {
			width: 40px;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>		
	<script>
		function displayHeroscapeSets(sets) {
			var masterSetParentElem = document.getElementById("MasterSets");
			var terrainExpansionParentElem = document.getElementById("TerrainExpansionSets");
			var otherSetParentElem = document.getElementById("OtherSets");
			
			for (let i = 0; i < sets.length; i++) {
				const set = sets[i];
				
				var parentElem = set.masterSet
					? masterSetParentElem
					: set.terrainExpansion
						? terrainExpansionParentElem
						: otherSetParentElem;
				
				var setDiv = createDiv({
					class: "heroscapeSetDiv"
				});
				parentElem.appendChild(setDiv);
				
				var linkElem = createA({
					href: "/map/terrain/set/?HeroscapeSet="+set.id
				});
				setDiv.appendChild(linkElem);
				
				linkElem.appendChild(createSpan({
					class: "heroscapeSetAbbreviation",
					innerHTML: set.abbreviation
				}));
				linkElem.appendChild(createSpan({
					class: "heroscapeSetName",
					innerHTML: set.name
				}));
			}
		}
		
		function displayTerrainTypes(terrainGroups) {
			var parentElem = document.getElementById('TerrainTypes');

			for (let i = 0; i < terrainGroups.length; i++) {
				const terrainGroup = terrainGroups[i];
				parentElem.appendChild(createH3({innerHTML: terrainGroup.name}));
				var table = createTable({});
				parentElem.appendChild(table);
				var headerRow = createTr({});
				table.appendChild(headerRow);
				headerRow.appendChild(createTh({innerHTML: "Name"}));
				headerRow.appendChild(createTh({innerHTML: "Image"}));
				headerRow.appendChild(createTh({innerHTML: "Height"}));
				headerRow.appendChild(createTh({innerHTML: "Special Rules"}));
				for (let j = 0; j < terrainGroup.terrainTypes.length; j++) {
					const terrainType = terrainGroup.terrainTypes[j];
					var row = createTr({});
					table.appendChild(row);
					row.appendChild(createTd({innerHTML: terrainType.name}));
					var imgTd = createTd({});
					row.appendChild(imgTd);
					if (terrainType.image != null) {
						imgTd.appendChild(createImage({
							src: terrainType.image,
							class: "terrainImage"
						}));
					}
					row.appendChild(createTd({innerHTML: terrainType.height}));
					row.appendChild(createTd({innerHTML: terrainType.rules}));
				}
			}
		}
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(MapNav); ?>
	
	<div id='pageContent'>
		<article>	
			<h2>Terrain Sets</h2>
			<div id='HeroscapeSets'>
				<div class='heroscapeSetGroup' id='MasterSets'>
					<h3>Master Sets</h3>
				</div>
				<div class='heroscapeSetGroup' id='TerrainExpansionSets'>
					<h3>Terrain Expansion Sets</h3>
				</div>
				<div class='heroscapeSetGroup' id='OtherSets'>
					<h3>Other Sets</h3>
				</div>
			</div>
			
			<script>
				// Current Conventions
				HeroscapeSet.load(
					{}, 
					function (sets) {		
						displayHeroscapeSets(sets);
					}, 
					{joins: {
						
					}}
				);
				
			</script>
			
			<h2>Terrain Types</h2>
			<div id='TerrainTypes'></div>
			
			<script>
				TerrainTypeGroup.load(
					{},
					function (groups) {
						displayTerrainTypes(groups);
					},
					{joins: {
						"TerrainType.groupID": {
							/*"TerrainPiece.terrainTypeID": {
								"terrainSizeID": {},
								"HeroscapeSetTerrainPieceQuantity.terrainPieceID": {
									"heroscapeSetID": {}
								}
							}*/
						}
					}}
				);
			</script>
		</article>
	</div>

	<?php include(Footer); ?>

</div></body>
</html>