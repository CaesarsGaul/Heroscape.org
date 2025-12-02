<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Format Search</title>
	
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/builder.css">
	<link rel="stylesheet" href="/css/formatSearch.css">
	<style>
		
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/armyBuilder.js"></script>
	<script src="/js/formatSearch.js"></script>
	<script>
		
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
								<input id='StandardPricing' type='checkbox' checked onchange='formatSearch()' />
								Standard
							</label>
							<label>
								<input id='DeltaPricing' type='checkbox' checked onchange='formatSearch()' />
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
								<input id='StartDate' type='date' onchange='formatSearch()' />
							</label>
							<label>
								Before 
								<input id='EndDate' type='date' onchange='formatSearch()' />
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
									<input id='PointMin' type='number' value=400 step=5 min=0 onchange='formatSearch()' />
								</label>
								<label>
									Max:
									<input id='PointMax' type='number' value=600 step=5 min=0 onchange='formatSearch()' />
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
									<input id='FigureMin' type='number' step=1 min=0 onchange='formatSearch()' />
								</label>
								<label>
									Max:
									<input id='FigureMax' type='number' step=1 min=0 onchange='formatSearch()' />
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
									<input id='HexMin' type='number' step=1 min=0 onchange='formatSearch()' />
								</label>
								<label>
									Max:
									<input id='HexMax' type='number' step=1 min=0 onchange='formatSearch()' />
								</label>
							</div>
						</div>
					</div>
					<div class='rowCol'>
						<div id='LiveOnlineType' class='searchGroup'>
							Type
							<label>
								<input id='Live' type='checkbox' checked onchange='formatSearch()' />
								Live
							</label>
							<label>
								<input id='Online' type='checkbox' checked onchange='formatSearch()' />
								Online
							</label>
						</div>
					
						<div id='NumPlayers' class='searchGroup'>
							# Players
							<label>
								<input id='2Player' type='checkbox' checked onchange='formatSearch()' />
								2-Player
							</label>
							<label>
								<input id='MultiPlayer' type='checkbox' onchange='formatSearch()' />
								Multi-Player
							</label>
						</div>
						
						<div class='searchGroup'>
							<label>
								# Armies: 
								<input id='NumArmies' type='number' step=1 min=0 onchange='formatSearch()' />
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
						formatSearch();
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