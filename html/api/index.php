<?php 

require_once("/var/www/Application/Templates/ajaxHead.php"); 

if (empty($_GET)) {
	echo "
		<html>
			<head>
				<title>Heroscape.org Public API</title>
			</head>
			<body>
				<h1>Heroscape.org Public API</h1>
				
				<h2>Available Options</h2>
				
				<h3>Maps</h3>
				<p>Load data for all maps.</p>
				<p>Ex. <a href='https://heroscape.org/api/?maps' target='_blank'>https://heroscape.org/api/?maps</a></p>
				
				<h3>Map</h3>
				<p>Load data for a single map. Request via name or id.</p>
				<p>Ex. <a href='https://heroscape.org/api/?map=119' target='_blank'>https://heroscape.org/api/?map=119</a></p>
				<p>Ex. <a href='https://heroscape.org/api/?map=Desolation' target='_blank'>https://heroscape.org/api/?map=Desolation</a></p>
				
				<h3>Unit Data</h3>
				<p>Load various data lists associated with Cards.</p>
				<p>Ex. <a href='https://heroscape.org/api/?homeworld' target='_blank'>https://heroscape.org/api/?homeworld</a></p>
				<p>Ex. <a href='https://heroscape.org/api/?species' target='_blank'>https://heroscape.org/api/?species</a></p>
				<p>Ex. <a href='https://heroscape.org/api/?class' target='_blank'>https://heroscape.org/api/?class</a></p>
				<p>Ex. <a href='https://heroscape.org/api/?personality' target='_blank'>https://heroscape.org/api/?personality</a></p>
			</body>
		</html>
	";
}

if (isset($_GET['maps'])) {	
	$joins = array(
		'HeroscapeMapSet.mapID' => array('terrainSetID' => array()),
		'HeroscapeMapTagLink.mapID' => array('tagID' => array()));
	$maps = HeroscapeMap::fetch(array(), $joins);
	
	$publicMaps = array();
	foreach ($maps as $map) {
		array_push($publicMaps, createMapObject($map));
	}
	
	echo json_encode($publicMaps);
}

if (isset($_GET['map'])) {
	$map = null;
	$joins = array(
		'HeroscapeMapSet.mapID' => array('terrainSetID' => array()),
		'HeroscapeMapTagLink.mapID' => array('tagID' => array()));
	if (is_numeric($_GET['map'])) {
		$map = HeroscapeMap::fetch(array('id' => $_GET['map']), $joins)[0];
	} else {
		$map = HeroscapeMap::fetch(array('name' => $_GET['map']), $joins)[0];
	}
	
	$publicMap = createMapObject($map);
	
	echo json_encode($publicMap);
}

if (isset($_GET['homeworld'])) {
	$joins = array('figureSetID' => array());
	$objects = Homeworld::fetch(array(), $joins);
	
	$publicObjects = array();
	foreach ($objects as $object) {
		if ($object->figureSet->public) {
			array_push($publicObjects, createCardDataObject($object));
		}
	}
	
	echo json_encode($publicObjects);
}

if (isset($_GET['species'])) {
	$joins = array('figureSetID' => array());
	$objects = Species::fetch(array(), $joins);
	
	$publicObjects = array();
	foreach ($objects as $object) {
		if ($object->figureSet->public) {
			array_push($publicObjects, createCardDataObject($object));
		}
	}
	
	echo json_encode($publicObjects);
}

if (isset($_GET['class'])) {
	$joins = array('figureSetID' => array());
	$objects = CardClass::fetch(array(), $joins);
	
	$publicObjects = array();
	foreach ($objects as $object) {
		if ($object->figureSet->public) {
			array_push($publicObjects, createCardDataObject($object));
		}
	}
	
	echo json_encode($publicObjects);
}

if (isset($_GET['personality'])) {
	$joins = array('figureSetID' => array());
	$objects = Personality::fetch(array(), $joins);
	
	$publicObjects = array();
	foreach ($objects as $object) {
		if ($object->figureSet->public) {
			array_push($publicObjects, createCardDataObject($object));
		}
	}
	
	echo json_encode($publicObjects);
}

if (isset($_GET['units'])) {
	
	// TODO 
	
}

if (isset($_GET['unit'])) {
	
	// TODO 
	
}

function createCardDataObject($object) {
	$publicObject = new stdClass();
	$publicObject->id = $object->id;
	$publicObject->name = $object->name;
		
	$publicObject->figureSet = new stdClass();
	$publicObject->figureSet->name = $object->figureSet->name;
	$publicObject->figureSet->sDomain = $object->figureSet->sDomain;
	$publicObject->figureSet->includeBase = $object->figureSet->includeBase;
	$publicObject->figureSet->includeDelta = $object->figureSet->includeDelta;
	$publicObject->figureSet->includeVC = $object->figureSet->includeVC;
	$publicObject->figureSet->googleDocId = $object->figureSet->googleDocId;
	$publicObject->figureSet->public = $object->figureSet->public;
	
	return $publicObject;
}

function createMapObject($map) {
	$publicMap = new stdClass();
	$publicMap->id = $map->id;
	$publicMap->name = $map->name;
	$publicMap->authorName = $map->authorName;
	$publicMap->buildInstructionsUrl = $map->buildInstructionsUrl;
	$publicMap->imageUrl = $map->imageUrl;
	$publicMap->numberOfPlayers = $map->numberOfPlayers;
	$publicMap->ohsGdocId = $map->ohsGdocId;
	
	$publicMap->heroscapeMapSets = [];
	foreach ($map->heroscapeMapSets as $heroscapeMapSet) {
		$set = new stdClass();
		$set->id = $heroscapeMapSet->id;
		$set->mapID = $heroscapeMapSet->mapID;
		$set->terrainSetID = $heroscapeMapSet->terrainSetID;
		
		$terrainSet = new stdClass();
		$terrainSet->id = $heroscapeMapSet->terrainSet->id;
		$terrainSet->name = $heroscapeMapSet->terrainSet->name;
		$terrainSet->abbreviation = $heroscapeMapSet->terrainSet->abbreviation;
		$terrainSet->releaseDate = $heroscapeMapSet->terrainSet->releaseDate;
		$terrainSet->masterSet = $heroscapeMapSet->terrainSet->masterSet;
		$terrainSet->terrainExpansion = $heroscapeMapSet->terrainSet->terrainExpansion;
		$set->terrainSet = $terrainSet;
		
		$set->quantity = $heroscapeMapSet->quantity;
		
		array_push($publicMap->heroscapeMapSets, $set);
	}
	
	$publicMap->heroscapeMapTags = [];
	foreach ($map->tags as $heroscapeMapTag) {
		$tag = new stdClass();
		$tag->id = $heroscapeMapTag->id;
		$tag->tag = $heroscapeMapTag->tag;
		
		array_push($publicMap->heroscapeMapTags, $tag);
	}
	
	return $publicMap;
}

function createCardObject($card) {
	$publicCard = new stdClass();
	
	// TODO 
	
	
	return $publicCard;
}

?>