<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Format Search</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/builder.css">
	<style>
		.rowCol {
			display: inline-block;
			vertical-align: top;
		}
		#PointsSystemOptions label {
			display: block;
			text-align: left;
		}
	
		.minMaxGroup {
			display: block;
			padding-bottom: 15px;
		}
		.minMaxGroupTitle {
			display: block;
		}
		.minMaxGroupBody {
			display: block;
		}
		
		.searchGroup {
			padding-bottom: 20px;
			padding-left: 10px;
			padding-right: 10px;
		}
		
		#NumPlayers label,
		#LiveOnlineType label {
			display: block;
			text-align: left;
		}
		
		.formatTagDiv {
			display: inline-block;
			padding-left: 20px;
			padding-right: 20px;
		}
		
		input[type=number] {
			width: 40px !important;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/armyBuilder.js"></script>
	<script>
		function createTags() {
			var parentElem = document.getElementById('Formats');
			for (let i = 0; i < TournamentFormat.list.length; i++) {
				const format = TournamentFormat.list[i];
				var formatDiv = createDiv({
					class: 'formatTagDiv'
				});
				parentElem.appendChild(formatDiv);
				
				var formatLabel = createLabel({});
				formatDiv.appendChild(formatLabel);
				formatLabel.appendChild(createInput({
					class: 'formatTagInput',
					type: 'checkbox',
					value: format.id,
					onchange: 'search()'
				}));
				formatLabel.appendChild(createText(format.name));
			}			
		}
		
		function _toggleFigureSetCheckbox() {
			search();
		}
		
		function search() {
			var parentElem = document.getElementById("ResultsDivInner");
			parentElem.innerHTML = "";
			for (let i = 0; i < Tournament.list.length; i++) {
				const tournament = Tournament.list[i];
				var matchesSearch = true;
				
				// Check FigureSetSubGroups
				var figureSubGroupInputs = document.getElementsByClassName('figureSetSubGroupCheckbox');
				var selectedFigureSubGroups = [];
				for (let i = 0; i < figureSubGroupInputs.length; i++) {
					if (figureSubGroupInputs[i].checked) {
						selectedFigureSubGroups.push(figureSubGroupInputs[i].id.split("_")[0]);
					}
				}
				if (selectedFigureSubGroups.length > 0) {
					for (let i = 0; i < selectedFigureSubGroups.length; i++) {
						const figureSubGroupName = selectedFigureSubGroups[i];
						var formatMatch = false;
						for (let j = 0; j < tournament.tournamentIncludesFigureSetSubGroups.length; j++) {
							const figureSubGroup = tournament.tournamentIncludesFigureSetSubGroups[j].figureSetSubGroup;
							if (figureSubGroup.name == figureSubGroupName) {
								formatMatch = true;
								break;
							}
						}
						if ( ! formatMatch) {
							matchesSearch = false;
						}
					}
				}
				
				// Date Range 
				const startDate = document.getElementById('StartDate').value; 
				if (startDate.length > 0) {
					if (tournament.startTime < startDate) {
						matchesSearch = false;
					}
				}
				const endDate = document.getElementById('EndDate').value
				if (endDate.length > 0) {
					if (tournament.startTime > endDate) {
						matchesSearch = false;
					}
				}				
				
				// Check Point Systems
				if ((tournament.useDeltaPricing && ! document.getElementById('DeltaPricing').checked) || 
						( ! tournament.useDeltaPricing && ! document.getElementById('StandardPricing').checked)) {
					matchesSearch = false;
				}
				
				// Check Min/Maxes
				const pointMinValue = document.getElementById('PointMin').value;
				const pointMaxValue = document.getElementById('PointMax').value;
				const figureMinValue = document.getElementById('FigureMin').value;
				const figureMaxValue = document.getElementById('FigureMax').value;
				const hexMinValue = document.getElementById('HexMin').value;
				const hexMaxValue = document.getElementById('HexMax').value;
				if (pointMinValue.length > 0 && tournament.pointLimit < pointMinValue) {
					matchesSearch = false;
				}
				if (pointMaxValue.length > 0 && tournament.pointLimit > pointMaxValue) {
					matchesSearch = false;
				}
				if (figureMinValue.length > 0 && (tournament.figureLimit == null || tournament.figureLimit < figureMinValue)) {
					matchesSearch = false;
				}
				if (figureMaxValue.length > 0 && (tournament.figureLimit == null || tournament.figureLimit > figureMaxValue)) {
					matchesSearch = false;
				}
				if (hexMinValue.length > 0 && (tournament.hexLimit == null || tournament.hexLimit < hexMinValue)) {
					matchesSearch = false;
				}
				if (hexMaxValue.length > 0 && (tournament.hexLimit == null || tournament.hexLimit > hexMaxValue)) {
					matchesSearch = false;
				}
				
				// Live v. Online 
				var liveInput = document.getElementById('Live');
				var onlineInput = document.getElementById('Online');
				if (( ! liveInput.checked && ! tournament.online) || ( ! onlineInput.checked && tournament.online)) {
					matchesSearch = false;
				}
								
				// Check # Players
				if ((tournament.maxNumPlayersPerGame == 2 && ! document.getElementById("2Player").checked) || 
						(tournament.maxNumPlayersPerGame > 2 && ! document.getElementById("MultiPlayer").checked)) {
					matchesSearch = false;
				}
				
				// Check # Armies 
				const numArmiesInput = document.getElementById("NumArmies");
				if (numArmiesInput.value.length > 0 && tournament.numArmies != numArmiesInput.value) {
					matchesSearch = false;
				}
				
				// Check FormatTags 
				var formatInputs = document.getElementsByClassName('formatTagInput');
				var selectedFormats = [];
				for (let i = 0; i < formatInputs.length; i++) {
					if (formatInputs[i].checked) {
						selectedFormats.push(formatInputs[i].value);
					}
				}
				if (selectedFormats.length > 0) {
					for (let i = 0; i < selectedFormats.length; i++) {
						const formatId = selectedFormats[i];
						var formatMatch = false;
						for (let j = 0; j < tournament.tournamentFormatTags.length; j++) {
							const tag = tournament.tournamentFormatTags[j];
							if (tag.format.id == formatId) {
								formatMatch = true;
								break;
							}
						}
						if ( ! formatMatch) {
							matchesSearch = false;
						}
					}
				}
				
				if (matchesSearch) {
					var tournamentDiv = createDiv({
						class: 'tournamentDiv'
					});
					parentElem.appendChild(tournamentDiv);
					tournamentDiv.appendChild(createA({
						href: "/events/tournament/?Tournament="+tournament.id,
						innerHTML: tournament.fullDisplayName(),
						target: "_blank"
					}));
				}
			}
		}
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(DataNav); ?>
	
	<div id='pageContent'>	
		<h1>Format Search</h1>
		<article>	
			<div id='SearchDiv'>
			
				<div id='Row1' class='row'>
					<div class='rowCol searchGroup'>
						<div id='Tier1SubGroups' class='row1Group tierSubGroup'></div>
						<div id='Tier2SubGroups' class='row1Group tierSubGroup'></div>
						<script>
							FigureSetSubGroup.load(
								{},
								function (groups) {
									createFigureSetCheckboxes(groups, false);
								},
								{joins: {
									
								}}
							);
						</script>
					</div>
					<div class='rowCol searchGroup'>
						<div>
							Points System
						</div>
						<div id='PointsSystemOptions'>
							<label>
								<input id='StandardPricing' type='checkbox' checked onchange='search()' />
								Standard
							</label>
							<label>
								<input id='DeltaPricing' type='checkbox' checked onchange='search()' />
								Delta
							</label>
						</div>
					</div>
				</div>
				<div id='Row2' class='row'>
					<div class='searchGroup'>
						<div>
							Start Date
						</div>
						<div>
							<label>
								After 
								<input id='StartDate' type='date' onchange='search()' />
							</label>
							<label>
								Before 
								<input id='EndDate' type='date' onchange='search()' />
							</label>
						</div>
					</div>
				</div>				
				<div id='Row3' class='row'>
					<div class='rowCol  searchGroup'>
						<div class='minMaxGroup'>
							<div class='minMaxGroupTitle'>
								Points
							</div>
							<div class='minMaxGroupBody'>
								<label>
									Min: 
									<input id='PointMin' type='number' value=400 step=5 min=0 onchange='search()' />
								</label>
								<label>
									Max:
									<input id='PointMax' type='number' value=600 step=5 min=0 onchange='search()' />
								</label>
							</div>
						</div>
						<div class='minMaxGroup'>
							<div class='minMaxGroupTitle'>
								Figures
							</div>
							<div class='minMaxGroupBody'>
								<label>
									Min: 
									<input id='FigureMin' type='number' step=1 min=0 onchange='search()' />
								</label>
								<label>
									Max:
									<input id='FigureMax' type='number' step=1 min=0 onchange='search()' />
								</label>
							</div>
						</div>
						<div class='minMaxGroup'>
							<div class='minMaxGroupTitle'>
								Hexes
							</div>
							<div class='minMaxGroupBody'>
								<label>
									Min: 
									<input id='HexMin' type='number' step=1 min=0 onchange='search()' />
								</label>
								<label>
									Max:
									<input id='HexMax' type='number' step=1 min=0 onchange='search()' />
								</label>
							</div>
						</div>
					</div>
					<div class='rowCol'>
						<div id='LiveOnlineType' class='searchGroup'>
							Type
							<label>
								<input id='Live' type='checkbox' checked onchange='search()' />
								Live
							</label>
							<label>
								<input id='Online' type='checkbox' checked onchange='search()' />
								Online
							</label>
						</div>
					
						<div id='NumPlayers' class='searchGroup'>
							# Players
							<label>
								<input id='2Player' type='checkbox' checked onchange='search()' />
								2-Player
							</label>
							<label>
								<input id='MultiPlayer' type='checkbox' onchange='search()' />
								Multi-Player
							</label>
						</div>
						
						<div class='searchGroup'>
							<label>
								# Armies: 
								<input id='NumArmies' type='number' step=1 min=0 onchange='search()' />
							</label>
						</div>
					</div>
				</div>
			
				<div id='Row4' class='row'>
					<div id='Formats' class='searchGroup'></div>
					<div>
						<a href='https://heroscape.org/glossary/#FormatGlossaryListDiv' target='_blank'>Format Glossary</a>
					</div>
					<script>
						TournamentFormat.load(
							{},
							function (tags) {
								createTags();
							},
							{joins: {
								
							}}
						);
					</script>
				</div>				
				
			</div>
			<div id='ResultsDiv'>
				<h2>Results</h2>
				<div id='ResultsDivInner'></div>
			</div>
			
			<script>			
				TournamentOverviewView.load(
					{},
					function (viewEntries) {
						var tournaments = DatabaseObject.extractView(TournamentOverviewView.list, HeroscapeTournament);
						search();
					},
					{joins: {
						
					}}
				
				);
				
				/*HeroscapeTournament.load(
					{figureSetID: 1},
					function (tournaments) {
						search();
					},
					{joins: {
						"TournamentFormatTag.tournamentID": {
							"formatID": {}
						},
						"TournamentIncludesFigureSetSubGroup.tournamentID": {
							"figureSetSubGroupID": {}
						},
						"TournamentSeasonLink.tournamentID": {
							"seasonID": {
								"leagueID": {}
							}
						}
					}}
				);*/
			</script>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>