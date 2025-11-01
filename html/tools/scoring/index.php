<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<link rel="shortcut icon" href="/images/autoloadIcon.png">
	
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Partial Card Scoring</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<link rel="icon" type="image/png" href="/images/autoloadIcon.png">
	
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/tournament.css">
	<link rel="stylesheet" href="/css/builder.css">
	<style>
		
	</style>

	<!-- JS Libraries -->	
	<!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>	
	<!-- Dynamic HTML -->
	<script src='https://caesarsgaul.com/public-libraries/dynamic-html/DynamicHTML.js'></script>
	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	
	<script>
		loadUnits();
		
		function setupPage() {
			checkUrlParameters();
			adjustPartialCardScoringUnits();
			
			//updateArmyDisplay();
			
			const army1 = findGetParameter("army1");
			if (army1 !== null) {
				addArmyFromParameter(army1, partialScoringArmy1);			
			}
			const army2 = findGetParameter("army2");
			if (army2 !== null) {
				addArmyFromParameter(army2, partialScoringArmy2);			
			}
			
			displayUnits();
			
			if (army1 !== null || army2 !== null) {
				updateArmyDisplayPartialScoring();
			}
			
			
		}
		
		function addArmyFromParameter(armyStr, army) {
			const units = armyStr.split(",");
			for (let i = 0; i < units.length; i++) {
				const unit = units[i];
				const unitParts = unit.split(" x");
				const unitName = unitParts[0].trim();
				if (unitParts.length == 1) { // Unique
					army.units[unitName] = unitsMap[unitName].life * unitsMap[unitName].figures;
				} else { // Common
					army.units[unitName] = unitsMap[unitName].life * unitsMap[unitName].figures * parseInt(unitParts[1]);
				}
			}
		}
		
		function checkUrlParameters() {
			var url = new URL(window.location.href);
			var pointsParam = url.searchParams.get("delta");
			if (pointsParam !== undefined && pointsParam !== null && 
					pointsParam.toLowerCase() == "true") {
				var deltaCheckbox = document.getElementById("deltaCheckbox");
				deltaCheckbox.checked = true;
				deltaPoints = true;
				switchClassicDelta(deltaCheckbox);
			}
			
			/*var vcParam = url.searchParams.get("vc");
			if (vcParam !== undefined && vcParam !== null && 
					vcParam.toLowerCase() == "true") {
				var pointsCheckbox = document.getElementById("vcCheckbox");
				pointsCheckbox.checked = true;
				vcInclusive = true;
				switchClassicVc(pointsCheckbox);
			}*/
		}
		
		var partialScoringArmy1 = new Army();
		var partialScoringArmy2 = new Army();
		
		function updatePartialArmy(unitId, leftOrRight, armyNum) {
			const rowDiv = document.getElementById("unitRowPartial_"+unitId);
			//const unit = $(rowDiv).data("unit");
			const unit = units[unitId];
		
			var imgElem = leftOrRight == "left"
				? document.getElementById("leftArrowPartial"+armyNum+"_"+unitId)
				: document.getElementById("rightArrowPartial"+armyNum+"_"+unitId);
			if (imgElem != null) {
				if (imgElem.classList.contains("arrowNoClick")) {
					return;
				}
			}
			
			var numInArmyDiv = document.getElementById("numInArmyPartial"+armyNum+"_"+unitId);
			if (numInArmyDiv != null) {
				var numInArmy = numInArmyDiv.innerHTML;
				if (leftOrRight == "left") {
					numInArmy--;
				} else {
					numInArmy++;
				}
				numInArmyDiv.innerHTML = numInArmy;
			}
			
			var leftArrowImg = document.getElementById("leftArrowPartial"+armyNum+"_"+unitId);
			if (leftArrowImg != null) {
				if (numInArmy == 0) {
					leftArrowImg.classList.add("arrowNoClick");
				} else {
					leftArrowImg.classList.remove("arrowNoClick");
				}
			}
			
			if (rightArrowImg) {
				var rightArrowImg = document.getElementById("rightArrowPartial"+armyNum+"_"+unitId);
				if (unit.uniqueness == "Unique" && 
						((unit.squad && numInArmy == unit.figures * unit.life) ||
							! unit.squad && numInArmy == unit.life)) {
					rightArrowImg.classList.add("arrowNoClick");
				} else {
					rightArrowImg.classList.remove("arrowNoClick");
				}
			}
			
			if (leftOrRight == "left") {
				if (armyNum == 1) {
					partialScoringArmy1.removeUnit(unit);
				} else {
					partialScoringArmy2.removeUnit(unit);
				}
			} else { // leftOrRight == "right"
				if (armyNum == 1) {
					partialScoringArmy1.addUnit(unit);
				} else {
					partialScoringArmy2.addUnit(unit);
				}
			}

			updateArmyDisplayPartialScoring();
		}
		
		function updateArmyDisplayPartialScoring() {
			_updateArmyDisplayPartialScoring(1);
			_updateArmyDisplayPartialScoring(2);
		}
		
		function _updateArmyDisplayPartialScoring(armyNum) {
			updateArmyDisplay(true, armyNum);
		}
		
		var partialScoringMode = false;
		var banList = null;
		var restrictedList = null;
		
		function updateUrlPageSpecific() {
			var urlPart = "";
			var armyParam = findGetParameter('army1');
			if (armyParam != null) {
				urlPart += "&army1="+armyParam;
			}
			armyParam = findGetParameter('army2');
			if (armyParam != null) {
				urlPart += "&army2="+armyParam;
			}
			return urlPart;
		}
		
		function redrawPage() {
			var currentUnit = null;
			if (activeUnitIdx != null) {
				currentUnit = units[activeUnitIdx];
				_toggleActiveUnit(activeUnitIdx);
			}
			displayUnits();
			updateArmyDisplayPartialScoring();
			
			if (currentUnit != null) {
				var tableElem = document.getElementById("unitTable");
				var newUnitIdx = null;
				for (let i = 1; i < tableElem.children.length; i++) {
					var tempUnit = $(tableElem.children[i]).data("unit");
					if (tempUnit.name == currentUnit.name) {
						newUnitIdx = parseInt(tableElem.children[i].id.split("_")[1]);
						break;
					}
				}
				if (newUnitIdx != null) {
					_toggleActiveUnit(newUnitIdx);
				}
			}
		}
	
		function _copyArmy(armyNum) {
			var armyText = "";
			if (armyNum === undefined || armyNum === null) {
				armyText += army.toString().replaceAll("<br>", "\n");
				armyText += "\n" + army.getPoints() + " Points, " + 
					army.getFigures() + " Figures, " + 
					army.getHexes() + " Hexes";
			} else if (armyNum == 1) {
				armyText += partialScoringArmy1.toString().replaceAll("<br>", "\n");
				armyText += "\n" + partialScoringArmy1.getPoints() + " Points, " + 
					partialScoringArmy1.getFigures() + " Figures, " + 
					partialScoringArmy1.getHexes() + " Hexes";	
			} else if (armyNum == 2) {
				armyText += partialScoringArmy2.toString().replaceAll("<br>", "\n");
				armyText += "\n" + partialScoringArmy2.getPoints() + " Points, " + 
					partialScoringArmy2.getFigures() + " Figures, " + 
					partialScoringArmy2.getHexes() + " Hexes";	
			}
			armyText += "\nSettings: " + 
				//(vcInclusive ? "VC" : "Classic") + ", " + 
				(deltaPoints ? "Delta Points " : "Standard Points") + 
				(partialScoringMode ? ", Partial Scoring" : "");
			copyTextToClipboard(armyText);
		}
		
		function copyTextToClipboard(text) {
			var dummy = document.createElement("textarea");
			document.body.appendChild(dummy);
			dummy.value = text;
			dummy.select();
			document.execCommand("copy");
			document.body.removeChild(dummy);
		}
		
		
		
		addEventListener('resize', (event) => {
			checkArmyParent();
		});
		
		$( document ).ready(function() {
			checkArmyParent();			
		});
		
		function checkArmyParent() {
			var width = window.innerWidth;
			var mobileParentDiv = document.getElementById("ArmyStatsDivMobile");
			var desktopParentDiv = document.getElementById("ArmyStatsDivDesktop");
			var armyDiv = document.getElementById("ArmyStatsDiv");
			
			if (width <= 800 && mobileParentDiv.children.length == 0) {
				mobileParentDiv.appendChild(armyDiv);				
			} else if (width > 800 && desktopParentDiv.children.length == 0) {
				desktopParentDiv.appendChild(armyDiv);				
			}
		}
		
		var partialCardScoringUnitsAdjusted = false;
		function adjustPartialCardScoringUnits() {
			if ( ! partialCardScoringUnitsAdjusted) {
				//console.log(unitsMap);
				//console.log(Object.keys(unitsMap).length);
				
				const unitsToDoubleLives = ["Mezzodemon Warmongers", "Axentia", "Vulcanmech Incendiborgs"];
				
				for (const unitName of Object.keys(unitsMap)) {
				//Object.keys(unitsMap).forEach(unitName => function() {
					if (unitsToDoubleLives.includes(unitName)) {
						if (unitsMap[unitName].squad) {
							unitsMap[unitName].figures *= 2;
						} else {
							unitsMap[unitName].life *= 2;
						}
					}
				//});
				}
				
				partialCardScoringUnitsAdjusted = true;
			}
		}
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(ToolsNav); ?>
	
	<h1>Partial Card Scoring</h1>
	
	<div id='ArmyStatsDivMobile'></div>
	
	<div id='ToggleSwitches'>
		<div id='Tier1SubGroups' class='row1Group tierSubGroup'></div>
		<div id='Tier2SubGroups' class='row1Group tierSubGroup'></div>
		<script>
			FigureSetSubGroup.load(
				{/*figureSet: */},
				function (figureSetSubGroups) {
					createFigureSetCheckboxes(figureSetSubGroups);
				}, 
				{joins: {}}
			);
		</script>
		
		<div class='row1Group'>
			<span class='toggleSwitch row1Column'><!-- Standard / Delta -->
				<span id='standardToggle' class='toggleSwitchString toggleSwitchSelected'>Standard</span>
				<label class="switch">
					<input id='deltaCheckbox' type="checkbox" onchange="switchClassicDelta(this)" >
					<span class="slider round"></span>
				</label>
				<span id='deltaToggle' class='toggleSwitchString'>Delta</span>
				<a class="tagInfo" href="/todo#todo" target="_blank">?</a>
				<span class="tagHoverDescription">Switch between standard or delta pricing. Note that some units have a different delta price for VC-inclusive events.</span>
			</span>
			
			<!--<span class='row1Column'>
				<img class='logoImg' id='centerLogoImg' src='/images/autoloadIcon.png' />
				
				<label id='keepX0'>
					Keep x0s
					<input id='armyMinCheckbox' type='checkbox' onclick='changeArmyMin()' />
				</label>
			</span>-->
		</div>
	</div>
	
	<script>
		if (window.location.origin.includes("c3g")) {
			document.getElementById("ToggleSwitches").remove();
		}
	</script>
	
	<div id='SearchAndSortDiv'>
		<div id='SearchDiv'>
			<input type='text' id='searchInput' placeholder='Search...' oninput='_search(this)' />
		</div>
		<div id='SortDiv'>
			<select id='sort1' class='sortSelect' onchange='_sort1(this)'>
				<option value='alphabetical'>Alphabetical</option>
				<option value='pointsLowToHigh' selected='true'>Points (Low to High)</option>
				<option value='pointsHighToLow'>Points (High to Low)</option>
				<option value='general'>General</option>
				<option value='species'>Species</option>
				<option value='personality'>Personality</option>
				<option value='class'>Class</option>
				<option value='size'>Size</option>
				<option value='uniqueness'>Uniqueness</option>
				<option value='squadOrHero'>Squad/Hero</option>
				<option value='hexes'>Hexes</option>
				<option value='figures'>Figures</option>
				<option value='move'>Move</option>
				<option value='range'>Range</option>
				<option value='attack'>Attack</option>
				<option value='defense'>Defense</option>
				<option value='life'>Life</option>
				<option value='powerRanking'>Power Ranking</option>
				<option value='deltaUpdateDate'>Delta Update</option>
			</select>
			<select id='sort2' class='sortSelect' onchange='_sort2(this)'>
				<option value='none'>None</option>
				<option value='alphabetical'>Alphabetical</option>
				<option value='pointsLowToHigh'>Points (Low to High)</option>
				<option value='pointsHighToLow'>Points (High to Low)</option>
				<option value='general'>General</option>
				<option value='species'>Species</option>
				<option value='personality'>Personality</option>
				<option value='class'>Class</option>
				<option value='size'>Size</option>
				<option value='uniqueness'>Uniqueness</option>
				<option value='squadOrHero'>Squad/Hero</option>
				<option value='hexes'>Hexes</option>
				<option value='figures'>Figures</option>
				<option value='move'>Move</option>
				<option value='range'>Range</option>
				<option value='attack'>Attack</option>
				<option value='defense'>Defense</option>
				<option value='life'>Life</option>
				<option value='powerRanking'>Power Ranking</option>
				<option value='deltaUpdateDate'>Delta Update</option>
			</select>
			
		</div>
	</div>
	
	<article>
	
		<div id='LeftColumn'>
			<div id='FiguresPartialCardScoring'></div>
		</div>
		
		<div id='RightColumn'> 
			<div id='ArmyStatsDivDesktop'>
			<div id='ArmyStatsDiv'>
				<div id='PartialScoringStatsDiv'>
					<div class='partialScoringArmyDiv'>
						<h2>Army 1</h2>
						<div id='armyPartial1List'>
							No figures selected. Choose a figure from the box to add it to your army.
						</div>
						<button id='armyListCopy' onclick='_copyArmy(1)'>Copy</button>
						<button id='armyListX' onclick='_clearArmy(1)'>X</button>
						<div class='armyStatsGroup'>
							<div id='armyPartial1Points' class='armyStatsValue'>
								0
							</div>
							<div class='armyStatsLabel'>
								Points
							</div>
						</div>
						<div class='armyStatsGroup'>
							<div id='armyPartial1Figures' class='armyStatsValue'>
								0
							</div>
							<div class='armyStatsLabel'>
								Figures
							</div>
						</div>
						<div class='armyStatsGroup'>
							<div id='armyPartial1Hexes' class='armyStatsValue'>
								0
							</div>
							<div class='armyStatsLabel'>
								Hexes
							</div>
						</div>
					</div>
					<hr>
					<div class='partialScoringArmyDiv'>
						<h2>Army 2</h2>
						<div id='armyPartial2List'>
							No figures selected. Choose a figure from the box to add it to your army.
						</div>
						<button id='armyListCopy' onclick='_copyArmy(2)'>Copy</button>
						<button id='armyListX' onclick='_clearArmy(2)'>X</button>
						<div class='armyStatsGroup'>
							<div id='armyPartial2Points' class='armyStatsValue'>
								0
							</div>
							<div class='armyStatsLabel'>
								Points
							</div>
						</div>
						<div class='armyStatsGroup'>
							<div id='armyPartial2Figures' class='armyStatsValue'>
								0
							</div>
							<div class='armyStatsLabel'>
								Figures
							</div>
						</div>
						<div class='armyStatsGroup'>
							<div id='armyPartial2Hexes' class='armyStatsValue'>
								0
							</div>
							<div class='armyStatsLabel'>
								Hexes
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
			
			<div id='UnitStatsDiv'>
				<button id='UnitStatsDivX' onclick='_toggleActiveUnit()'>X</button>
				<h2 id='UnitName'></h2>
				
				<div class='UnitStatsColumn topUnitStatsColumn'>
					<div class='UnitStat' style='color: white; background-color: red'><span id='UnitLife'></span> Life</div>
					<div class='UnitStat' style='color: white; background-color: green'><span id='UnitMove'></span> Move</div>
					<div class='UnitStat' style='color: white; background-color: grey'><span id='UnitRange'></span> Range</div>
					<div class='UnitStat' style='color: white; background-color: red'><span id='UnitAttack'></span> Attack</div>
					<div class='UnitStat' style='color: white; background-color: blue'><span id='UnitDefense'></span> Defense</div>
				</div>
				<img id='UnitImg'></img>
				<div id='DeltaUpdate'></div>
				<div id='UnitReleaseSet'></div>
				<div class='UnitStatsColumn'>
					<div class='UnitStat'><span id='UnitSpecies'></span></div>
					<div class='UnitStat'><span id='UnitCommonality'></span></div>
					<div class='UnitStat'><span id='UnitClass'></span></div>
					<div class='UnitStat'><span id='UnitPersonality'></span></div>
					<div class='UnitStat'><span id='UnitSize'></span></div>
				</div>
				<div class='UnitStatsColumn'>
					<div class='UnitStat'><span id='UnitGeneral'></span></div>
					<div class='UnitStat'><span id='UnitHomeworld'></span></div>
					<div class='UnitStat'><span id='UnitFigures'></span> Figures</div>
					<div class='UnitStat'><span id='UnitHexes'></span> Hexes</div>
					<div class='UnitStat'><span id='UnitPoints'></span> Points</div>
				</div>
				
				<div id='UnitPowers'></div>
				<div id='UnitPowerRankings'></div>
			</div>
		</div>
	</article>
	
	<script>
		_sort1(document.getElementById("sort1"));
	</script>
	
	<?php include(Footer); ?>

</div></body>
</html>