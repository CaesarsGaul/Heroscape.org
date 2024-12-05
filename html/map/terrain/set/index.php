<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Terrain Set</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		#SetOverview {
			margin: auto;
			max-width: 300px;
		}
		
		.setOverviewP {
			text-align: left;
		}
		
		#TerrainContents {
			margin: auto;
			max-width: 300px;
		}
		
		.terrainContentsP {
			margin: 0;
			text-align: left;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script>
		var set;
		function displayHeroscapeSet() {
			const setName = set.name + " (" + set.abbreviation + ")";
			document.getElementsByTagName("title")[0].innerHTML = setName; 
			document.getElementById("h1").innerHTML = setName;
			
			var overviewDiv = document.getElementById("SetOverview");
			overviewDiv.appendChild(createP({
				class: "setOverviewP",
				innerHTML: "Release Date : " + set.releaseDate
			}));
			if (set.masterSet) {
				overviewDiv.appendChild(createP({
					class: "setOverviewP",
					innerHTML: "Master Set"
				}));
			}
			if (set.terrainExpansion) {
				overviewDiv.appendChild(createP({
					class: "setOverviewP",
					innerHTML: "Terrain Expansion Set"
				}));
			}
			
			displayTerrainContents();
		}
		
		function displayTerrainContents() {
			sortTerrain();
			
			var tableDiv = document.getElementById("TerrainContentsTableRows");
			tableDiv.innerHTML = "";
			for (let i = 0; i < set.heroscapeSetTerrainPieceQuantitys.length; i++) {
				const quantity = set.heroscapeSetTerrainPieceQuantitys[i];
				
				var row = createTr({});
				tableDiv.appendChild(row);
				row.appendChild(createTd({innerHTML: quantity.terrainPiece.terrainType.name}));
				row.appendChild(createTd({innerHTML: quantity.terrainPiece.terrainSize.size + " Hex"}));
				row.appendChild(createTd({innerHTML: quantity.quantity}));
			}
		}
		
		function sortTerrain() {
			set.heroscapeSetTerrainPieceQuantitys.sort(function(a,b) {
				var returnVal = 0;
				
				switch (sortColNum) {
					case 1:
						if (a.terrainPiece.terrainType.name < b.terrainPiece.terrainType.name) {
							returnVal = -1;
						} else if (a.terrainPiece.terrainType.name > b.terrainPiece.terrainType.name) {
							returnVal = 1;
						}
						break;
					case 2:
						if (a.terrainPiece.terrainSize.size > b.terrainPiece.terrainSize.size) {
							returnVal = -1;
						} else if (a.terrainPiece.terrainSize.size < b.terrainPiece.terrainSize.size) {
							returnVal = 1;
						}
						break;
					case 3:
						if (a.quantity > b.quantity) {
							returnVal = -1;
						} else if (a.quantity < b.quantity) {
							returnVal = 1;
						}
						break;
				}
				
				if ( ! sortTopToBottom) {
					returnVal *= -1;
				}
				
				if (returnVal == 0) { // Tie-Breaker 1 : Col 1
					if (a.terrainPiece.terrainType.name < b.terrainPiece.terrainType.name) {
						returnVal = -1;
					} else if (a.terrainPiece.terrainType.name > b.terrainPiece.terrainType.name) {
						returnVal = 1;
					}
				}
				if (returnVal == 0) { // Tie-Breaker 2 : Col 2
					if (a.terrainPiece.terrainSize.size > b.terrainPiece.terrainSize.size) {
						returnVal = -1;
					} else if (a.terrainPiece.terrainSize.size < b.terrainPiece.terrainSize.size) {
						returnVal = 1;
					}
				}
				
				return returnVal;
			});
		}
		
		sortColNum = 1;
		sortTopToBottom = true;
		function _sortTerrainTable(colNum) {
			if (sortColNum == colNum) {
				sortTopToBottom = ! sortTopToBottom;
			}
			sortColNum = colNum;
			
			displayTerrainContents();
		}
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(MapNav); ?>
	
	<div id='pageContent'>		
		<article>	
			<h1 id='h1'></h1>
			<div id='HeroscapeSet'>
				<div id='SetOverview'>
					<h2>Overview</h2>
				</div>
				<div id='TerrainContents'>
					<h2>Terrain Contents</h2>
					<table id='TerrainContentsTable'>
						<tr>
							<th onclick='_sortTerrainTable(1)'>Type</th>
							<th onclick='_sortTerrainTable(2)'>Size</th>
							<th onclick='_sortTerrainTable(3)'>Quantity</th>
						</tr>
						<tbody id='TerrainContentsTableRows'></tbody>
					</table>
				</div>
			</div>
			<script>
				const setID = findGetParameter("HeroscapeSet");
				if (setID != null) {		
					HeroscapeSet.load(
						{id: setID},
						function (sets) {
							if (sets.length == 1) {
									set = sets[0];
									displayHeroscapeSet();							
							} else {
								document.getElementById("HeroscapeSet").appendChild(
									createP({
										innerHTML: "There was an error loading this page; " +
											"make sure you used a valid link to reach this page."}));
							}
						},
						{joins: {
							"HeroscapeSetTerrainPieceQuantity.heroscapeSetID": {
								"terrainPieceID": {
									"terrainTypeID": {},
									"terrainSizeID": {}
								}
							}
					}});
				} else {
					document.getElementById("HeroscapeSet").appendChild(
						createP({
							innerHTML: "There was an error loading this page; " +
								"make sure you used a valid link to reach this page."}));
				}
			</script>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>