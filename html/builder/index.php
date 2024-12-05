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
	<link rel="stylesheet" href="/css/tournament.css">
	<link rel="stylesheet" href="/css/builder.css">
	<style>
		#tournamentBuilderDiv {
			text-align: center;
		}		
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	<script src='/js/tournament.js'></script>
	
	<script>
		loadUnits();
	
		function setupPage() {
			checkUrlParameters();
			displayUnits();
			displayFilters();
			updateArmyDisplay();
		}
		
		function checkUrlParameters() {
			if (window.location.origin.includes("c3g")) {
				return;
			}
			var url = new URL(window.location.href);
			var pointsParam = url.searchParams.get("delta");
			if (pointsParam !== undefined && pointsParam !== null && 
					pointsParam.toLowerCase() == "true") {
				var deltaCheckbox = document.getElementById("deltaCheckbox");
				deltaCheckbox.checked = true;
				switchClassicDelta(deltaCheckbox);
			}
			
			var vcParam = url.searchParams.get("vc");
			if (vcParam !== undefined && vcParam !== null && 
					vcParam.toLowerCase() == "true") {
				var pointsCheckbox = document.getElementById("vcCheckbox");
				pointsCheckbox.checked = true;
				switchClassicVc(pointsCheckbox);
			}
			
			var searchParam = url.searchParams.get("search");
			if (searchParam !== undefined && searchParam !== null && searchParam != "null"){
				document.getElementById("searchInput").value = searchParam;
				searchText = searchParam;
			}
			
			var sort1Param = url.searchParams.get("sort1");
			if (sort1Param !== undefined && sort1Param !== null && sort1Param != "null"){
				document.getElementById("sort1").value = sort1Param;
				sortOption1 = sort1Param;
			}
			
			var sort2Param = url.searchParams.get("sort2");
			if (sort2Param !== undefined && sort2Param !== null && sort2Param != "null"){
				document.getElementById("sort2").value = sort2Param;
				sortOption2 = sort2Param;
			}
			
			redrawPage();
		}
		
		var army = new Army();
		
		var vcInclusive = false;
		var marvelInclusive = true; // TODO : consider having a toggle for this 
		var deltaPoints = false;
		var banList = null;
		var restrictedList = null;
		
		function switchClassicVc(refThis) {
			vcInclusive = refThis.checked;
			if (vcInclusive) {
				document.getElementById("classicToggle").classList.remove("toggleSwitchSelected");
				document.getElementById("vcToggle").classList.add("toggleSwitchSelected");
			} else {
				document.getElementById("classicToggle").classList.add("toggleSwitchSelected");
				document.getElementById("vcToggle").classList.remove("toggleSwitchSelected");
			}
			redrawPage();
			updateURL();
		}
		
		function switchClassicDelta(refThis) {
			deltaPoints = refThis.checked;
			if (deltaPoints) {
				document.getElementById("standardToggle").classList.remove("toggleSwitchSelected");
				document.getElementById("deltaToggle").classList.add("toggleSwitchSelected");
			} else {
				document.getElementById("standardToggle").classList.add("toggleSwitchSelected");
				document.getElementById("deltaToggle").classList.remove("toggleSwitchSelected");
			}
			redrawPage();
			updateURL();
		}
		
		function updateURL() {
			if (window.location.origin.includes("c3g")) {
				return;
			}
			const deltaStr = deltaPoints ? "true" : "false";
			const vcStr = vcInclusive ? "true" : "false";
			var newurl = window.location.origin + 
				window.location.pathname + 
				"?" + 
					'delta='+deltaStr+
					'&vc='+vcStr+
					'&search='+searchText+
					'&sort1='+sortOption1+
					'&sort2='+sortOption2;
			
			window.history.pushState({path:newurl},'',newurl);
		}
		
		function redrawPage() {
			var currentUnit = null;
			if (activeUnitIdx != null) {
				currentUnit = units[activeUnitIdx];
				_toggleActiveUnit(activeUnitIdx);
			}
			displayUnits();
			updateArmyDisplay();
			
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
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<h1>Autoload Builder</h1>
	
	<div id='tournamentBuilderDiv'>
		<a href='/builder/tournament'>Tournament Builder</a>
	</div>
	
	<div id='ArmyStatsDivMobile'></div>
	
	<div id='ToggleSwitches'>
		<span class='toggleSwitch'><!-- Classic / VC -->
			<span id='classicToggle' class='toggleSwitchString toggleSwitchSelected'>Classic</span>
			<label class="switch"> 
				<input id='vcCheckbox' type="checkbox" onchange="switchClassicVc(this)" >
				<span class="slider round"></span>
			</label>
			<span id='vcToggle' class='toggleSwitchString'>VC</span>
		</span>
		
		<img class='logoImg' id='centerLogoImg' src='/images/autoloadIcon.png' />
		
		<span class='toggleSwitch'><!-- Standard / Delta -->
			<span id='standardToggle' class='toggleSwitchString toggleSwitchSelected'>Standard</span>
			<label class="switch">
				<input id='deltaCheckbox' type="checkbox" onchange="switchClassicDelta(this)" >
				<span class="slider round"></span>
			</label>
			<span id='deltaToggle' class='toggleSwitchString'>Delta</span>
		</span>
		
		<span>
			<label>
				Keep x0s
				<input id='armyMinCheckbox' type='checkbox' onclick='changeArmyMin()' />
			</label>
		</span>
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
			<div class='sortDiv'>
				<select id='sort1' class='sortSelect' onchange='_sort1(this)'>
					<option value='alphabetical'>Alphabetical</option>
					<option value='pointsLowToHigh' selected='true'>Points (Low to High)</option>
					<option value='pointsHighToLow'>Points (High to Low)</option>
					<option value='general'>General</option>
					<option value='homeworld'>Homeworld</option>
					<option value='species'>Species</option>
					<option value='personality'>Personality</option>
					<option value='class'>Class</option>
					<option value='size'>Size</option>
					<option value='height'>Height</option>
					<option value='size+height'>Size + Height</option>
					<option value='uniqueness'>Uniqueness</option>
					<option value='squadOrHero'>Squad/Hero</option>
					<option value='hexes'>Hexes</option>
					<option value='figures'>Figures</option>
					<option value='move'>Move</option>
					<option value='range'>Range</option>
					<option value='attack'>Attack</option>
					<option value='defense'>Defense</option>
					<option value='life'>Life</option>
					<option value='releaseSet'>Release Set</option>
					<option value='powerRanking'>Power Ranking</option>
					<option value='deltaUpdateDate'>Delta Update</option>
				</select>
				<label class='invertSortLabel'>
					<input type='checkbox' id='sort1Invert' class='invertSortInput' onchange='redrawPage()' />
					<p class='invertSortP'>Invert</p>
				</label>
			</div>
			<div class='sortDiv'>
				<select id='sort2' class='sortSelect' onchange='_sort2(this)'>
					<option value='none'>None</option>
					<option value='alphabetical'>Alphabetical</option>
					<option value='pointsLowToHigh'>Points (Low to High)</option>
					<option value='pointsHighToLow'>Points (High to Low)</option>
					<option value='general'>General</option>
					<option value='homeworld'>Homeworld</option>
					<option value='species'>Species</option>
					<option value='personality'>Personality</option>
					<option value='class'>Class</option>
					<option value='size'>Size</option>
					<option value='height'>Height</option>
					<option value='size+height'>Size + Height</option>
					<option value='uniqueness'>Uniqueness</option>
					<option value='squadOrHero'>Squad/Hero</option>
					<option value='hexes'>Hexes</option>
					<option value='figures'>Figures</option>
					<option value='move'>Move</option>
					<option value='range'>Range</option>
					<option value='attack'>Attack</option>
					<option value='defense'>Defense</option>
					<option value='life'>Life</option>
					<option value='releaseSet'>Release Set</option>
					<option value='powerRanking'>Power Ranking</option>
					<option value='deltaUpdateDate'>Delta Update</option>
				</select>
				<label class='invertSortLabel'>
					<input type='checkbox' id='sort2Invert' class='invertSortInput' onchange='redrawPage()' />
					<p class='invertSortP'>Invert</p>
				</label>
			</div>
			<script>
				_sort1(document.getElementById("sort1"));
			</script>
		</div>
	</div>
	
	<div id='FilterDiv'>
		<h2 onclick='_toggleFilters()'>Filters</h2>
		
		<div id='FiltersDiv'>
			<p>Select a filter to remove any figure(s) that do not match the criteria.</p>
			<div id='FiltersDivGroup1'>
				<label class='filterLabel'>
					<input type='checkbox' class='filterCheckbox' onclick='_updateFilters(this)' id='filter_common' />
					Common
				</label>
				<label class='filterLabel'>
					<input type='checkbox' class='filterCheckbox' onclick='_updateFilters(this)' id='filter_unique' />
					Unique
				</label>
				<label class='filterLabel'>
					<input type='checkbox' class='filterCheckbox' onclick='_updateFilters(this)' id='filter_squad' />
					Squad
				</label>
				<label class='filterLabel'>
					<input type='checkbox' class='filterCheckbox' onclick='_updateFilters(this)' id='filter_hero' />
					Hero
				</label>
			</div>
			<div class='filtersDivGroup'>
				<h3 onclick="_toggleFiltersSpecies()">Species</h3>
				<div id='SpeciesFiltersDiv'>
					<select id='SpeciesFiltersSelect' class='filtersMultiSelect' onchange='_updateFilters(this)' multiple></select>
				</div>
			</div>
			<div class='filtersDivGroup'>
				<h3 onclick="_toggleFiltersClass()">Class</h3>
				<div id='ClassFiltersDiv'>
					<select id='ClassFiltersSelect' class='filtersMultiSelect' onchange='_updateFilters(this)' multiple></select>
				</div>
			</div>
			<div class='filtersDivGroup'>
				<h3 onclick="_toggleFiltersPersonality()">Personality</h3>
				<div id='PersonalityFiltersDiv'>
					<select id='PersonalityFiltersSelect' class='filtersMultiSelect' onchange='_updateFilters(this)' multiple></select>
				</div>
			</div>
		</div>
	</div>
	
	<article>
	
		<div id='LeftColumn'>
			<div id='Figures'></div>
		</div>
		
		<div id='RightColumn'> 
			<div id='ArmyStatsDivDesktop'>
			<div id='ArmyStatsDiv'>
				<div id='ArmyBuilderStatsDiv'>
					<h2>Army</h2>
					<div id='armyList'>
						No figures selected. Choose a figure from the box to add it to your army.
					</div>
					<!--<button id='viewArmyBtn' class='armyBtn' onclick='_viewArmy()'>TBD</button>-->
					<button id='armyListCopy' class='armyBtn' onclick='_copyArmy()'>Copy</button>
					<button id='armyListX' class='armyBtn' onclick='_clearArmy()'>X</button>
					<div class='armyStatsGroup'>
						<div id='armyPoints' class='armyStatsValue'>
							0
						</div>
						<div class='armyStatsLabel'>
							Points
						</div>
					</div>
					<div class='armyStatsGroup'>
						<div id='armyFigures' class='armyStatsValue'>
							0
						</div>
						<div class='armyStatsLabel'>
							Figures
						</div>
					</div>
					<div class='armyStatsGroup'>
						<div id='armyHexes' class='armyStatsValue'>
							0
						</div>
						<div class='armyStatsLabel'>
							Hexes
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

	<?php include(Footer); ?>

</div></body>
</html>