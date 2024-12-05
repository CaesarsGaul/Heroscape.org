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
			width: 275px;
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
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(MapNav); ?>
	
	<div id='pageContent'>
		<article>	
			<h1>Terrain Sets</h1>
			<div id='HeroscapeSets'>
				<div class='heroscapeSetGroup' id='MasterSets'>
					<h2>Master Sets</h2>
				</div>
				<div class='heroscapeSetGroup' id='TerrainExpansionSets'>
					<h2>Terrain Expansion Sets</h2>
				</div>
				<div class='heroscapeSetGroup' id='OtherSets'>
					<h2>Other Sets</h2>
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
		</article>
	</div>

	<?php include(Footer); ?>

</div></body>
</html>