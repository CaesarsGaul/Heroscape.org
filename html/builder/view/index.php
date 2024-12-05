<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Autoload Builder</title>
	
	<script type="text/javascript">
		document.getElementById("favicon").href = 
			window.location.origin.includes("c3g")
				? "/images/c3gIcon.png"
				: "/images/autoloadIcon.png";
	</script>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		#tournamentBuilderDiv {
			text-align: center;
		}
		
		.UnitDisplayDiv {
			display: inline-block;
			border: 1px solid black;
			padding: 5px;
			margin: 5px;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	
	<script>
		loadUnits();
		
		var army = new Army();
		
		var vcInclusive = false;
		var marvelInclusive = true;
		var deltaPoints = false;
		var banList = null;
		var restrictedList = null;
	
		function setupPage() {
			const armyParam = findGetParameter('army');
			if (armyParam == null) {
				// TODO - some kind of error handling
				return;
			}
			army = JSON.parse(armyParam);
			displayArmy();
		}
		
		function displayArmy() {
			var parentElem = document.getElementById('ArmyDisplayBox');
			
			const armyCardNames = Object.keys(army.units);
			for (let i = 0; i < armyCardNames.length; i++) {
				/*var cardDiv = createDiv({
					class: "cardDiv"
				});
				parentElem.appendChild(cardDiv);*/
				
				var unitDiv = createDiv({
					class: "UnitDisplayDiv"
				});
				parentElem.appendChild(unitDiv);
				
				_displayUnit(unitsMap[armyCardNames[i]], unitDiv);
				//cardDiv.appendChild(createText(armyCardNames[i]));
			}
		}
		
		// https://heroscape.org/builder/view/?army=%7B%22units%22:%7B%2210th%20Regiment%20of%20Foot%22:2,%224th%20Massachusetts%20Line%22:1,%22Acolarh%22:1,%22Air%20Elemental%22:1%7D%7D
		
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<h1>Autoload Builder | View Army</h1>
	
	<article>
	
		<div id='ArmyDisplayBox'></div>
		
	</article>

	<?php include(Footer); ?>

</div></body>
</html>