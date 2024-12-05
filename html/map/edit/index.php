<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Edit Maps</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	
	<script src="/connect/socket.io/socket.io.js"></script>
	
	<script>
		HeroscapeMap.options.fieldsToInclude = ["name", "authorName", "buildInstructionsUrl", "imageUrl", "numberOfPlayers", "ohsGdocId"];
		HeroscapeMap.options.linksToInclude = ["heroscapeMapSets", "tags"];
		HeroscapeMap.options.labelsToIgnore = ["name"];
		
		HeroscapeMapSet.options.fieldsToInclude = ["terrainSet", "quantity"];
		HeroscapeMapSet.options.multiLevelEditsToSkip = ["create"];
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>		
		<article>
			<div id='Maps'>
				<div id='Create-Map'></div>
				<div id='Edit-Maps'></div>
			</div>
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
				
				HeroscapeMap.createAddSection(
					"Create-Map", 
					{targetDivID: "Edit-Maps", 
						sectionDivID: "Maps"});
				HeroscapeMap.fetchAndDisplay(
					"Edit-Maps", 
					{}, 
					{joins: {
						"HeroscapeMapSet.mapID" : {
							"terrainSetID": {}
						},
						"HeroscapeMapTagLink.mapID" : {
							"tagID": {}
						}
					}}, 
					{}, 
					null);
			</script>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>