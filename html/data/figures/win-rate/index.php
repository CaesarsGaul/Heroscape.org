<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>

	<title>Data | Unit Win Rates</title>
	
	<!-- CSS -->
	<!--<link rel="stylesheet" type="text/css" href="/css/TODO.css">-->
	<link rel="stylesheet" type="text/css" href="/css/sortableTable.js">
	<style>
		#StandingsTable {
			margin: auto;
		}
		
		#StandingsTable th {
			padding-left: 15px;
			padding-right: 15px;
		}
		
		#StandingsTable td {
			max-width: 200px;
		}
		
		#StandingsTable td a {
			text-decoration: none;
			color: inherit;
		}
	</style>
	
	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	<script src='/js/sortableTable.js'></script>
	<script>
		const today = datetimeToString(new Date());
		
		var unitsDelta = null;
		var unitsStandard = null;
		function displayStandings() {
			_sortableTableData = {};
			
			var headers = ["Unit", "Win %", "W", "L"];
			var data = [];
			
			const delta = document.getElementById('DeltaCheckbox').checked;
			const units = delta
				? unitsDelta
				: unitsStandard;
			
			for (let i = 0; i < units.length; i++) {
				const unit = units[i];
				
				data.push([unit.name, unit.WinPercent, unit.W, unit.L]);
			}
			
			
			createSortableTable("StandingsTable", headers, data);
		}
		
	</script>
</head>
<body><div id='content'>

	<?php include(Nav); ?>
	<?php include(DataNav); ?>

	<div id='pageContent'>
		<h1>Unit Win Rates</h1>
		<article>
			<p>Note: Only non-multiplayer, bring-1 tournaments are used for data.</p>
			<label>
				<input id='DeltaCheckbox' type='checkbox' checked='true' onchange='displayStandings()'/>
				Checked=Delta, Un-Checked=Standard
			</label>
			<div id='Standings'>
				<table id='StandingsTable'>
					
				</table>
			</div>

			<script>
				UnitWinRateDeltaView.load(
					{},
					function (units) {
						unitsDelta = units;
						displayStandings();
					},
					{joins: {}}
				);
				UnitWinRateStandardView.load(
					{},
					function (units) {
						unitsStandard = units;
					},
					{joins: {}}
				);
			</script>
				
			
			
		</article>
	</div>
	
	<?php include(Footer); ?>
</div></body>
</html>