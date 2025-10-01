<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Tournament</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/tournament.css">
	<link rel="stylesheet" href="/css/builder.css">
	<style>		
		#HeroscapeTournamentDiv, #GameTournamentDiv {
			display: none;
		}
		
		#GameTournamentDiv {
			text-align: center;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	<script src='/js/tournament.js'></script>
	
	<script src="/connect/socket.io/socket.io.js"></script>
	
	<script>
		var socket = io.connect("/", {path: "/connect/socket.io"});
		
		var tournament = null;
		function setupPage() {
			setupPageCalled = true;
			_setupPage();
		}
		var setupPageCalled = false;
		
		//var vcInclusive = null;
		//var marvelInclusive = null;
		var deltaPoints = null;
		var banList = null;
		var restrictedList = null;
		var armies = null;
		var army = null;
		function _setupPage() {
			if (tournament == null || ! setupPageCalled) {
				return;
			}
			
			armies = [];
			army = new Army();
			
			if (tournament instanceof HeroscapeTournament) {
				document.getElementById("HeroscapeTournamentDiv").style.display 
					= "Block";

				//vcInclusive = tournament.includeVC;
				//marvelInclusive = tournament.includeMarvel;
				deltaPoints = tournament.useDeltaPricing;
				banList = tournament.banList;
				restrictedList = tournament.restrictedList;
				
				displayUnits();
				displayFilters();
			} else if (tournament instanceof GameTournament) {
				document.getElementById("GameTournamentDiv").style.display 
					= "Block";
				
			}
			
			writeTournamentInfo(tournament, true, false);
		}
		
		function _saveArmy() {
			if (tournament instanceof GameTournament) {
				_submitArmy();
				return;
			}
			
			if (armies.length + 1 == tournament.numArmies) {
				const armyStr = army.toString(false, true, true).length > 0
					? army.toString(false, true, true)
					: "[BLANK]"
				if (confirm("Are you sure the army submission is correct? " + armyStr)) {
					armies.push(army);
					army = new Army();
					_submitArmy();
				}
			} else {
				armies.push(army);
				army = new Army();
				redrawPage();
			}
		}
		
		function _submitArmy() {
			var player = null;
			for (let i = 0; i < Player.list.length; i++) {
				if (Player.list[i].editableByUser) {
					player = Player.list[i];
					break;
				}
			}
			
			if (player != null) {
				var armyStrs = [];
				if (tournament instanceof HeroscapeTournament) {
					
					var playerArmyIds = [];
					for (let i = 0; i < player.playerArmys.length; i++) {
						playerArmyIds.push(player.playerArmys[i].id);
					}
					if (playerArmyIds.length > 0 && getSubdomain() == '') {
						socket.emit("deletePlayerArmyCards", JSON.stringify({
							playerArmyIds: playerArmyIds
						}));
					}
					
					for (let i = 0; i < armies.length; i++) {
						const armyNumber = i+1;
						const armyStr = armies[i].toString(false, true);
						if (player.playerArmys.length > i) {
							player.playerArmys[i].armyNumber = armyNumber;
							
							var army = player.playerArmys[i];
							if ((getSubdomain() == '' && tournament.figureSet.name.toLowerCase() == "base") || 
									(tournament.figureSet.name.toLowerCase() == "scapecon")) {
								
								//for (let k = 0; k < army.playerArmyCards.length; k++) {
									//army.playerArmyCards[k]._serverDelete();
									
								//}
								
								army.playerArmyCards = [];
								for (const [name, quantity] of Object.entries(armies[i].units)) {
									var playerArmyCard = new PlayerArmyCard();
									playerArmyCard.playerArmy = army;
									playerArmyCard.card = _findCard(name);
									playerArmyCard.quantity = quantity;
									army.playerArmyCards.push(playerArmyCard)
								}
							} else {
								army.army = armyStr;
							}
							
						} else {
							var army = new PlayerArmy();
							
							if ((getSubdomain() == '' && tournament.figureSet.name.toLowerCase() == "base") || 
									(tournament.figureSet.name.toLowerCase() == "scapecon")) {
								army.playerArmyCards = [];
								for (const [name, quantity] of Object.entries(armies[i].units)) {
									var playerArmyCard = new PlayerArmyCard();
									playerArmyCard.playerArmy = army;
									playerArmyCard.card = _findCard(name);
									playerArmyCard.quantity = quantity;
									army.playerArmyCards.push(playerArmyCard)
								}
							} else {
								army.army = armyStr;
							}
							
							army.armyNumber = armyNumber;
							army.player = player;
							player.playerArmys.push(army);
						}
						armyStrs.push(armyStr);
					}
				} else if (tournament instanceof GameTournament) {
					const armyStr = document.getElementById("GameTournamentArmyTextarea").value;
					var army = new PlayerArmy();
					army.army = armyStr;
					army.armyNumber = 1;
					army.player = player;
					player.playerArmys.push(army);
					armyStrs.push(armyStr);
				} 
				
				player._serverUpdate(); // TODO - delete this and do it via node .js  (requires sending more data to the below emit() call)
				socket.emit("submitArmy", JSON.stringify({
					tournament: {id: tournament.id},
					player: {
						id: player.id,
						armies: armyStrs
					}
					}));
				alert("Army submitted; registration complete.");
				window.location.href = 
					window.location.origin + "/events/tournament/?Tournament="+tournament.id;
			}
		}
		
		function _findCard(cardName) {
			// TODO - first check cards of just the subdomain
			/*for (let i = 0; i < tournament.figureSet.cards.length; i++) {
				if (tournament.figureSet.cards[i].name == cardName) {
					return tournament.figureSet.cards[i];
				}
			}*/
			// Then check cards of the base subdomain 
				// TODO 
			
			// Old Method 
			for (let i = 0; i < Card.list.length; i++) {
				if (Card.list[i].name == cardName) {
					return Card.list[i];
				}
				
				// Card.list[i].figureSet.id == ??
			}
			return null;
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
			
			writeTournamentInfo(tournament, true, false, army);
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
			
			if (mobileParentDiv == null || desktopParentDiv == null) {
				return;
			}
			
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
	<?php include(EventsNav); ?>
	
	<div id='pageContent'>	

		<div id='TournamentInfoDiv'></div>
		
		<div id='HeroscapeTournamentDiv'>

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
				<div class='filtersDivGroup1'>
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
				<p>Select the fields for your search text.</p>
				<div class='filtersDivGroup1'>
					<label class='filterLabel'>
						<input type='checkbox' class='filterCheckbox' onclick='_search()' id='filter_search_name' checked />
						Name
					</label>
					<label class='filterLabel'>
						<input type='checkbox' class='filterCheckbox' onclick='_search()' id='filter_search_nickname' checked />
						Nickname
					</label>
					<label class='filterLabel'>
						<input type='checkbox' class='filterCheckbox' onclick='_search()' id='filter_search_species' checked />
						Species
					</label>
					<label class='filterLabel'>
						<input type='checkbox' class='filterCheckbox' onclick='_search()' id='filter_search_class' checked />
						Class
					</label>
					<label class='filterLabel'>
						<input type='checkbox' class='filterCheckbox' onclick='_search()' id='filter_search_personality' checked />
						Personality
					</label>
					<label class='filterLabel'>
						<input type='checkbox' class='filterCheckbox' onclick='_search()' id='filter_search_powerNames' checked />
						Power Names
					</label>
					<label class='filterLabel'>
						<input type='checkbox' class='filterCheckbox' onclick='_search()' id='filter_search_powerText' checked />
						Power Text
					</label>
				</div>
				<div class='filtersDivGroup2'>
					<h3 onclick="_toggleFiltersSpecies()">Species</h3>
					<div id='SpeciesFiltersDiv'>
						<select id='SpeciesFiltersSelect' class='filtersMultiSelect' onchange='_updateFilters(this)' multiple></select>
					</div>
				</div>
				<div class='filtersDivGroup2'>
					<h3 onclick="_toggleFiltersClass()">Class</h3>
					<div id='ClassFiltersDiv'>
						<select id='ClassFiltersSelect' class='filtersMultiSelect' onchange='_updateFilters(this)' multiple></select>
					</div>
				</div>
				<div class='filtersDivGroup2'>
					<h3 onclick="_toggleFiltersPersonality()">Personality</h3>
					<div id='PersonalityFiltersDiv'>
						<select id='PersonalityFiltersSelect' class='filtersMultiSelect' onchange='_updateFilters(this)' multiple></select>
					</div>
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
						<button id='armyListCopy' onclick='_saveArmy()'>Save</button>
						<button id='armyListX' onclick='_clearArmy()'>X</button>
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
			
		</article>
		
		</div><!-- HeroscapeTournamentDiv -->
		
		<div id='GameTournamentDiv'>
			
			<!-- TODO -->
			
			<textarea id='GameTournamentArmyTextarea'></textarea>
			
			<button onclick='_saveArmy()'>Save</button>
			
		</div>
		
		<script>
			const tournamentID = findGetParameter("Tournament");
			
			Card.load(
				{},
				function (cards) {
					
				},
				{joins: {
					"figureSetID": {} // NEW LINE 
				}}
			);
			
			if (tournamentID != null) {
				Tournament.load(
					{id: tournamentID},
					function (tournaments) {
						tournament = tournaments[0];
						loadUnits(tournament);
						_setupPage();
					},
					{joins: {
						"conventionID": {
							"conventionSeriesID": {}
						},
						"Player.tournamentID": {
							"PlayerArmy.playerID": {
								"PlayerArmyCard.playerArmyID": {
									"cardID": {}
								}
							}
						},
						"figureSetID": {},
						"TournamentFormatTag.tournamentID": {
							"formatID": {}
						},
						"TournamentIncludesFigureSetSubGroup.tournamentID": {
							"figureSetSubGroupID": {}
						}
				}});
			} else {
				alert("Error loading page : make sure you reached this page via a valid link");
			}
		</script>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>