<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Historical GenCon Data</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		p {
			text-align: left;
			margin-top: 0;
			margin-bottom: 0;
		}
		
		.t16Table tr td:last-child {
			text-align: left;
		}
		
		.doubleArmyTable td:nth-last-child(2) {
			text-align: left;
		}
		
		
		
		
		.tournamentDiv {
			
		}
		
		.army {
			text-align: left;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	
		
	<script>
		function displayTournament(parentElem, data) {
			var tournamentDiv = createDiv({
				class: 'tournamentDiv'
			});
			parentElem.appendChild(tournamentDiv);
			
			tournamentDiv.appendChild(createH4({innerHTML: data.name}));
			
			if (data.paragraphs != undefined && data.paragraphs != null) {
				for (let i = 0; i < data.paragraphs.length; i++) {
					tournamentDiv.appendChild(createP({innerHTML: data.paragraphs[i]}));
				}
			}
			
			var standingsTable = createTable({});
			tournamentDiv.appendChild(standingsTable);
			var thRow = createTr({});
			standingsTable.appendChild(thRow);
			thRow.appendChild(createTh({innerHTML: ""}));
			thRow.appendChild(createTh({innerHTML: "Player"}));
			thRow.appendChild(createTh({innerHTML: "Record"}));
			thRow.appendChild(createTh({innerHTML: "Army"}));
			for (let i = 0; i < data.standings.length; i++) {
				const rowData = data.standings[i];
				var row = createTr({});
				standingsTable.appendChild(row);
				row.appendChild(createTd({
					innerHTML: i+1
				}));
				row.appendChild(createTd({
					innerHTML: rowData.player != null	
						? rowData.player
						: "?"
				}));
				row.appendChild(createTd({
					innerHTML: rowData.record != null
						? rowData.record
						: "?"
				}));
				row.appendChild(createTd({
					innerHTML: rowData.army != null
						? rowData.army
						: "?",
					class: "army"
				}));
			}
			
		}
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(DataNav); ?>
	
	<div id='pageContent'>	
		<h1>Historical GenCon Data</h1>
		<article>
			<h2>2006</h2>
			<h3>Main Event (Cheese)</h3>
			<h4>Finals</h4>
			<p>1st - Spider Poison (Arrow Gruts x3, Swog Rider x3, Krug, Raelin the Kyrie Warrior (RotV))</p>
			<p>2nd - NwoJedi (4th Massachusetts Line x3, Airborne Elite, Raelin the Kyrie Warrior (RotV))</p>
			<p>Map - Forsaken Waters (Ulanivia)</p>
			
			<h2>2007</h2>
			<h3>Main Event (Cheese)</h3>
			<h4>Finals</h4>
			<p>1st - MattserTruckRally (Major Q9, Laglor, Krav Maga Agents, Raelin the Kyrie Warrior (RotV), Marcu Esenwein, Isamu)</p>
			<p>2nd - Rychean (Deathreavers x3, Kaemon Awa, Krav Maga Agents, Marro Warriors, Airborne Elite)</p>
			<p>Map - Molten Ground (Valda, Lodin)</p>
			
			<h2>2008</h2>
			<h3>Main Event (Cheese)</h3>
			<h4>Finals</h4>
			<p>1st - Spider Poison (Gladiatrons x4, Blastatrons x2, Raelin the Kyrie Warrior (RotV))</p>
			<p>2nd - Lone Wolf (Marro Stingers x4, Deathreavers x2, Kaemon Awa, Raelin the Kyrie Warrior (RotV))</p>
			<p>Map - Feylund Fountain (Jalgard (D+2), Ulanivia)</p>
			<h4>Top 16</h4>
			<table class='t16Table'>
				<tr>
					<th>Record</th>
					<th>Player</th>
					<th>Army</th>
				</tr>
				<tr>
					<td>5-0</td>
					<td>Hendal</td>
					<td></td>
				</tr>
				<tr>
					<td>5-0</td>
					<td>Kaharma</td>
					<td>Major Q9, Raelin the Kyrie Warrior (RotV), Marro Stingers x3, Deathreavers x2</td>
				</tr>
				<tr>
					<td>5-0</td>
					<td>Spider Poison</td>
					<td>Blastatrons x2, Gladiatrons x4, Raelin the Kyrie Warrior (RotV)</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>Killer Cactus</td>
					<td></td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>Matrix Renegade</td>
					<td>Krav Maga Agents, Knights of Weston x3, Finn the Viking Champion, Thorgrim the Viking Champion, Eldgrim the Viking Champion</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>Gamjuven</td>
					<td></td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>Southwest Ninja</td>
					<td></td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>Lonewolf</td>
					<td>Marro Stingers x4, Deathreavers x2, Raelin the Kyrie Warrior (RotV), Kaemon Awa</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>Mattster Truck Rally</td>
					<td>4th Massachusetts Line x5, Sgt. Drake Alexander (SotM)</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>Eirikr</td>
					<td></td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>Scaper_Dude</td>
					<td>Marro Stingers x4, Deathreavers x2, Raelin the Kyrie Warrior (RotV), Kaemon Awa</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>[Unknown]</td>
					<td></td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>Main Train Choochoo</td>
					<td></td>
				</tr>
				<tr>
					<td>3-2</td>
					<td>Brownsfan82</td>
					<td>Nilfheim, Zelrig, Major Q10</td>
				</tr>
				<tr>
					<td>3-2</td>
					<td>Mecha Frog</td>
					<td></td>
				</tr>
				<tr>
					<td>3-2</td>
					<td>Weesel</td>
					<td></td>
				</tr>
			</table>
			
			<div id='2009'>
				<h2>2009</h2>
				
				
				<h3>Main Event (Cheese)</h3>
				<h4>Finals</h4>
				<p>1st - MattserTruckRally (Deathreavers x3, Braxas, Airborne Elite, Marro Warriors, Raelin the Kyrie Warrior (RotV))</p>
				<p>2nd - Hendal (Marro Stingers x7, Raelin the Kyrie Warrior (RotV), Zettian Guards)</p>
				<p>Map - Ticalla Sunrise (Wannok, Ulanivia)</p>
				<h4>Top Cut</h4>
				<p>Semi-Finals: Matthias Maccabeus, madpuppet</p>
				<p>Top 8: ManTrain, Rychean, CornPuff, RocDoc</p>
				<p>Top 16: spider_poison, Dillerbocker, gamjuven, Clarissimus, David K., nwojedi, Worldturtle, Menchi</p>
				<h4>Top 16</h4>
				<table class='t16Table doubleArmyTable'>
					<tr>
						<th>Record</th>
						<th>Player</th>
						<th>Army</th>
						<th>Re-enforcements</th>
					</tr>
					<tr>
						<td>5-0 </td>
						<td>Hendal</td>
						<td>Marro Stingers x7, Raelin the Kyrie Warrior (RotV)</td>
						<td>Zettian Guards</td>
					</tr>
					<tr>
						<td>5-0</td>
						<td>ManTrain</td>
						<td>Heavy Gruts x4, Grimnak, Raelin the Kyrie Warrior (RotV)</td>
						<td>Heavy Gruts x1</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>RocDoc</td>
						<td>Marro Stingers x5, Cyprien Esenwein, Marro Warriors</td>
						<td>Marro Stingers x1, Isamu</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>Dillerbocker</td>
						<td>Knights of Weston x2, 4th Massachusetts Line x2, Sir Gilbert, Eldgrim the Viking Champion</td>
						<td>Raelin the Kyrie Warrior (RotV)</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>gamjuven</td>
						<td>Gladiatrons x3, Blastatrons x2, Laglor, Marcu Esenwein</td>
						<td>Raelin the Kyrie Warrior (RotV)</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>Clarissimus</td>
						<td>4th Massachusetts Line x4, Braxas</td>
						<td>4th Massachusetts Line x1</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>Matthias Maccabeus</td>
						<td>Heavy Gruts x4, Grimnak, Raelin the Kyrie Warrior (RotV), Marcu Esenwein</td>
						<td>Nerak the Glacian Swog Rider, Swog Rider x1</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>David K.</td>
						<td>Roman Legionnaires x3, 10th Regiment of Foot x2, Marcus Decimus Gallus, Ne-Gok-Sa, Isamu</td>
						<td>Me-Burq-Sa</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>Rychean</td>
						<td>Marro Stingers x5, Deathreavers x2, Kaemon Awa</td>
						<td>James Murphy</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>spider_poison</td>
						<td>Gladiatrons x3, Blastatrons x2, Raelin the Kyrie Warrior (RotV), Isamu</td>
						<td>Kaemon Awa</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>MattserTruckRally</td>
						<td>Deathreavers x3, Braxas, Airborne Elite, Marro Warriors</td>
						<td>Raelin the Kyrie Warrior (RotV)</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>Cornpuff</td>
						<td>Minions of Utgar x2, Atlaga, Krav Maga Agents, Raelin the Kyrie Warrior (RotV)</td>
						<td>Repulsors x2</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>madpuppet</td>
						<td>Marro Stingers x2, Deathreavers x2, Braxas, Raelin the Kyrie Warrior (RotV)</td>
						<td>Marro Warriors, Eldgrim the Viking Champion</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>Menchi</td>
						<td>Knights of Weston x3, Krav Maga Agents, Alastair MacDirk, Finn the Viking Champion</td>
						<td>Knights of Weston x1</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>nwojedi</td>
						<td>10th Regiment of Foot x3, Deathreavers x1, Airborne Elite, Kaemon Awa</td>
						<td>Raelin the Kyrie Warrior (RotV)</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>Worldturtle</td>
						<td>Marro Dividers x4, Krav Maga Agents, Kaemon Awa, Raelin the Kyrie Warrior (RotV)</td>
						<td>Johnny 'Shotgun' Sullivan, Isamu</td>
					</tr>
				</table>
				
				<script>
					displayTournament(document.getElementById('2009'), {
						name: "Heat of Battle",
						standings: [
							{
								player: 'southwest ninja',
								record: null,
								army: "Major Q9, Warriors of Ashra x5, Isamu, Otonashi"
							},
							{
								player: 'Jexit',
								record: null,
								army: "Roman Legionnaires x4, Me-Burq-Sa, Ne-Gok-Sa, Izumi Samurai, Guilty McCreech, Marcu Esenwein"
							},
							{
								player: 'Clarrisimus',
								record: null,
								army: null
							}
						]
					});
				</script>
				<!--<h3>Heat of Battle</h3>
				<p>1st - southwest ninja (Major Q9, Warriors of Ashra x5, Isamu, Otonashi)</p>
				<p>2nd - Jexit (Roman Legionnaires x4, Me-Burq-Sa, Ne-Gok-Sa, Izumi Samurai, Guilty McCreech, Marcu Esenwein)</p>
				<p>3rd - Clarrisimus (?)</p>-->
				
				<h3>Smack Down</h3>
				<p>1st - spider_poison (Major Q10, Deathreavers x3, Krav Maga Agents, Raelin the Kyrie Warrior (RotV)</p>
				<p>2nd - Clarissimus (?)</p>
				<p>3rd - Cleon's Dad</p>
				<p>4th - Matthias Maccabeus (Heavy Gruts x4, Grimnak, Nerak the Glacian Swog Rider)</p>
				
				<h3>Capture the Flag</h3>
				<p>1st - Hendal (Marro Stingers x6, Deathreavers x1)</p>
				<p>2nd - ? (Venoc Vipers x7, Venoc Warlord)</p>
				<p>3rd - Jexit (4th Massachusetts Line x4, Sgt. Drake Alexander (RotV)</p>
				
				<h3>Lightweight</h3>
				<p>1st - Matthias Maccabeus (Blade Gruts x4, Grimnak, Nerak, Isamu)</p>
				<p>2nd - Dignan (Marro Stingers x3, Deathreavers x4)</p>
				<p>3rd - tom (Marro Stingers x4, Deathreavers x3, Marcu Esenwein)</p>
				<p>4th - Rychean (?)</p>
				<p>5th - Harlax (?)</p>
				
				<h3>Mixed Marvel</h3>
				<p>1st - nicktheant (?)</p>
				<p>2nd - EternalThanos86 (?)</p>
				<p>3rd - Mr Migraine (?)</p>
				
				<h3>War of the Worlds</h3>
				<p>1st - Dignan (Sacred Band x3, 10th Regiment of Foot x2, Marcus Decimus Gallus)</p>
				<p>2nd - southwest ninja (Heavy Gruts x4, Grimnak)</p>
				<p>3rd - Tiny Timmy (?)</p>
				
				<h3>Dragon Wars</h3>
				<p>1st - WOOKIE (Charos, 4th Massachusetts x3, Eldgrim the Viking Champion)</p>
				
				<h3>General Wars</h3>
				<table class='t16Table'>
					<tr>
						<th>Record</th>
						<th>Player</th>
						<th>Army</th>
					</tr>
					<tr>
						<td>5-0</td>
						<td>Spider_Poison</td>
						<td>4th Massachusetts Line x6, Concan the Kyrie Warrior</td>
					</tr>
					<tr>
						<td>5-0</td>
						<td>tom</td>
						<td>Knights of Weston x3, Sir Gilbert, Nilfheim</td>
					</tr>
					<tr>
						<td>4-0-1</td>
						<td>Jormi_Boced</td>
						<td>Knights of Weston x3, Sir Gilbert, Nilfheim</td>
					</tr>
					<tr>
						<td>4-0-1</td>
						<td>Matthias Maccabeus</td>
						<td>Axegrinders of the Burning Forge x5, Migol, Fyorlag Spiders x1</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>Tiny Timmy</td>
						<td>Heavy Gruts x4, Grimnak, Nerak the Glacian Swog Rider, Marro Warriors</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>BillyBoom (jdtenor's son)</td>
						<td>Major Q9, Krav Maga Agents, Agent Skahen, Agent Carr</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>Spencer (GaryLASQ's son)</td>
						<td>Marro Stingers x3, Zombies of Morindan x3, Shades of Bleakewoode x1, Deathreavers x1</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>Momo_The_Monkey</td>
						<td>Aubrien Archers x6, Venoc Vipers x2</td>
					</tr>
					<tr>
						<td>4-1</td>
						<td>GaryLASQ</td>
						<td>10th Regiment of Foot x4, Marcus Decimus Gallus, Kozuke Samurai</td>
					</tr>
					<tr>
						<td>?-?</td>
						<td>Cleon</td>
						<td>[Einar Army]</td>
					</tr>
					<tr>
						<td>?-?</td>
						<td>Rychean</td>
						<td>Heavy Gruts x?, Grimnak</td>
					</tr>
				</table>
				<h3>Unique Hero Tournament</h3>
				<p>1st - Matthias Maccabeus (Jotun, Wo-Sa-Ga, Krug, Marcu Esenwein)</p>
				<p>2nd - Bunjee (Cyprien Esenwein, Sonya Esenwein, Marcu Esenwein, Krug, Ornak, Johnny 'Shotgun' Sullivan)</p>
				<p>3rd - Switty111 (?)</p>
				
				<h3>Big Ol' Monster Battle</h3>
				<p>1st - jdtenor (?)</p>
				<p>2nd - southwest ninja (Major Q9, Marro Stingers x4, Eldgrim the Viking Champion)</p>
				<p>3rd - Cleon's Dad (?)</p>
			</div>
			
			<h2>2010</h2>
			<h3>Main Event (Cheese)</h3>
			<h4>Finals</h4>
			<p>1st - dok (Deathreavers x4, Major Q9, Fen Hydra, Krav Maga Agents, Raelin the Kyrie Warrior (RotV))</p>
			<p>2nd - ManTrainChooChoo (Deathreavers x4, Major Q9, Kaemon Awa, Marro Warriors, Raelin the Kyrie Warrior (RotV), Arkmer)</p>
			<p>Map - Warden (Dagmar, Jalgard (D+2))</p>
			<h4>Top Cut</h4>
			<p>Semi-Finals: RoninValentina, Fishtako</p>
			<p>Top 8: Tiny Timmy, EternalThanos86, Pickle4192, Menchi</p>
			<p>Top 16: Jexik, Chris M, Matthias Maccabeus, dragonmaster384, scaper_dude, killercactus, Rychean, wdgrant</p>
			<h4>Top 16</h4>
			<table class='t16Table doubleArmyTable'>
				<tr>
					<th>Record</th>
					<th>Player</th>
					<th>Army</th>
					<th>Re-enforcements</th>
				</tr>
				<tr>
					<td>5-0</td>
					<td>dok</td>
					<td>Major Q9, Fen Hydra, Deathreavers x3, Raelin the Kyrie Warrior (RotV)</td>
					<td>Krav Maga Agents, Deathreavers x1</td>
				</tr>
				<tr>
					<td>5-0</td>
					<td>Tiny Timmy</td>
					<td>Heavy Gruts x4, Grimnak, Nerak, Marro Warriors</td>
					<td>Othkurik</td>
				</tr>
				<tr>
					<td>5-0</td>
					<td>Jexik</td>
					<td>Nilfheim, Greenscale Warriors x4, Raelin the Kyrie Warrior (RotV)</td>
					<td>Warriors of Ashra x2, Marcu Esenwein, Isamu</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>EternalThanos86</td>
					<td>Zelrig, Greenscale Warriors x4, Raelin the Kyrie Warrior (RotV)</td>
					<td>Fen Hydra x1, Isamu</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>Chris M</td>
					<td>10th Regiment of Foot x4, Marcus Decimus Gallus, Airborne Elite</td>
					<td>Raelin the Kyrie Warrior (RotV), Brave Arrow</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>Matthias Maccabeus</td>
					<td>Knights of Weston x4, Sir Gilbert, Airborne Elite</td>
					<td>Sir Hawthorne, Theracus</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>dragonmaster384</td>
					<td>Nilfheim, Zelrig, Greenscale Warriors x2, Isamu, Otonashi</td>
					<td>Morsbane, Marcu Esenwein</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>scaper_dude</td>
					<td>Heavy Gruts x4, Grimnak, Raelin the Kyrie Warrior (RotV)</td>
					<td>Nerak the Glacian Swog Rider, Krav Maga Agents</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>Pickle4192</td>
					<td>4th Massachusetts Line x4, Braxas</td>
					<td>4th Massachusetts Line x1, Raelin the Kyrie Warrior (RotV)</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>Fishtako</td>
					<td>Major Q9, Marro Dividers x5, Raelin the Kyrie Warrior (RotV)</td>
					<td>Fen Hydra x1, Isamu</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>ManTrainChoochoo</td>
					<td>Major Q9, Kaemon Awa, Marro Warriors, Deathreavers x2, Raelin the Kyrie Warrior (RotV)</td>
					<td>Deathreavers x2, Arkmer</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>RoninValentina</td>
					<td>Knights of Weston x3, Finn the Viking Champion, Krav Maga Agents, Fen Hydra</td>
					<td>Sir Gilbert, Marcu Esenwein</td>
				</tr>
				<tr>
					<td>4-1</td>
					<td>killercactus</td>
					<td>Major Q9, Venoc Vipers x6, Raelin the Kyrie Warrior (RotV)</td>
					<td>Venoc Warlord, Isamu</td>
				</tr>
				<tr>
					<td>3-2</td>
					<td>Menchi</td>
					<td>Knights of Weston x3, Alastair MacDirk, Finn the Viking Champion, Krav Maga Agents</td>
					<td>Eldgrim the Viking Champion, Airborne Elite</td>
				</tr>
				<tr>
					<td>3-2</td>
					<td>Rychean</td>
					<td>10th Regiment of Foot x3, Roman Legionnaires x2, Marcus Decimus Gallus, Raelin the Kyrie Warrior (RotV)</td>
					<td>Mogrimm Forgehammer, Isamu</td>
				</tr>
				<tr>
					<td>3-2</td>
					<td>wdgrant</td>
					<td>Marro Stingers x5, Fen Hydra, Raelin the Kyrie Warrior (RotV)</td>
					<td>Kaemon Awa, Marcu Esenwein</td>
				</tr>
			</table>
			
			<h3>General Wars</h3>
			<p>Jandar (Overall) - lonewolf [5-0] (Knights of Weston x5, Sir Gilbert, Johnny 'Shotgun' Sullivan)</p>
			<p>Aquilla - fomox [4-0] (Axegrinders of the Burning Forge x5, Mogrimm Forgehammer, Brave Arrow)</p>
			<p>Einar - Tiny Timmy [4-1] (Sacred Band x4, Marcus Decimus Gallus, Zelrig)</p>
			<p>Utgar - dok [4-1] (Tor-Kul-Na, Marrden Nagrubs x3, Phantom Knights x3)</p>
			<p>Ullar - Clarissimus [3-2] (Aubrien Archers x5, Acolarh, Kyntella Gwyn, Theracus)</p>
			<p>Vydar - Killdawabit [3-2] (Gladiatrons x3, Blastatrons x2, Major Q10, Otonashi)</p>
			
			<h3>Smackdown</h3>
			<p>1st - Mantrainchoochoo (10th Regiment of Foot x4, Marcus Decimus Gallus, Raelin the Kyrie Warrior (RotV))</p>
			<p>2nd - Cleon (Knights of Weston x3, Sir Gilbert, Alastair MacDirk, Marro Warriors)</p>
			<p>3rd - Matthias Maccabeus [4-1] (Roman Legionnaires x5, Marcus Decimus Gallus, Me-Burq-Sa, Raelin the Kyrie Warrior (RotV))</p>
			
			<h3>Capture the Flag</h3>
			<p>1st - fomox (Heavy Gruts x4, Grimnak, Raelin the Kyrie Warrior (RotV))</p>
			<p>2nd - Hendal (?)</p>
			<p>3rd - Sarah (SWNinja's wift) (?)</p>
			
			<h3>Treasure Quest</h3>
			<p>1st - Arrow Grut [5-0] (Charos, Greenscale Warriors x3, Krav Maga Agents, Isamu)</p>
			<p>2nd - jdtenor [4-1] (Ornak, Mimring, Krug, Arrow Gruts x3, Isamu)</p>
			<p>3rd - Matthias Maccabeus [4-1] (Fyorlag Spiders x3, Wyvern x3, Estivara)</p>
			
			<h3>Mixed Marvel</h3>
			<p>1st - Brownsfan82 [5-0] (Marro Stingers x3, Airborne Elite, Cyprien Esenwein, Sonya Esenwein, Isamu)</p>
			<p>2nd - vminer [4-1] (Captain America, 4th Massachusetts Line x1, Zetacron, Cyprien Esenwein)</p>
			<p>3rd - worldsenemy [4-1] (Thanos, Marro Warriors, Deathreavers x2, Isamu)</p>
			<p>4th - stubobj (Major Q9, Krav Maga Agents, Deathreavers x3, Raelin the Kyrie Warrior(RotV))</p>
			
			<h3>Dragon Wars</h3>
			<p>1st - Brownsfan82 (Charos, 4th Massachusetts Line x3, Eldgrim the Viking Champion)</p>
			<p>2nd - Rollitontop (Major Q9, Nilfheim, Deathreavers x2)</p>
			<p>3rd - ManOfWar (Charos, 4th Massachusetts Line x3, Eldgrim the Viking Champion)</p>
			
			<h3>Lightweight</h3>
			<p>1st - Kaboomboomboom [5-0] (4th Massachusetts Line x4)</p>
			<p>2nd - Mattsertruckrally [4-1] (Major Q9, Nilfheim, Deathreavers x2)</p>
			<p>3rd - tom [4-1] (Marro Stingers x5, Marcu Esenwein)</p>
			
			<h3>Heat of Battle</h3>
			<p>1st - lonewolf (Heavy Gruts x4, Grimnak)</p>
			<p>2nd - TinyTimmy (Axegrinders x4, Mogrimm Forgehammer)</p>
			<p>3rd - Mattsertruckrally [4-1] (Roman Legionnaires x4, Mogrimm Forgehammer, Raelin the Kyrie Warrior (RotV))</p>
			
			<h3>Monster Mash</h3>
			<p>1st - Cleon [5-0] (Major Q9, Nilfheim, Zetacron, Deathreavers x3)</p>
			<p>2nd - lonewolf [4-1] (Gladiatrons x3, Blastatrons x2, Deathwalker 9000, Dumutuf Guard x2)</p>
			<p>3rd - Rollitontop (Major Q9, Major Q10, Krug, Marcu Esenwein, Deathreavers x2)</p>
			
			<h3>Heroes Only</h3>
			<p>1st - Matthias Maccabeus [5-0] (Jotun, Shurrak, Krug, Marcu Esenwein, Drow Chainfighter)</p>
			<p>2nd - Arcus [4-1] (Major Q9, Fen Hydra x2, Zetacron, Marcu Esenwein, Isamu)</p>
			<p>3rd - Wookie [3-1] (Nilfheim, Charos, Major Q10)</p>
			<p>4th - dok [3-1] (Kurrok the Elementalist, Fire Elemental x10, Raelin the Kyrie Warrior (RotV))</p>
			
			<div id='2011'>
				<h2>2011</h2>
				<script>
					displayTournament(document.getElementById('2011'), {
						name: "Main Event (RtW Day 2)",
						paragraphs: [
							"1st - dok",
							"2nd - spider_poison",
							"Finals Map - Trailblazer (Wannok, Valda)",
							"Semi-Finalists: scaper dude, lonewolf",
							"Top 8: KaBoomboomBoom, TurkeyClubSamich, nicktheant, Worseley",
							"Top 16: Johngee, Mezrath, Tiny Timmy, ManTrainChooChoo, Raider30, Hendal, Rollitontop, Mr. Infidel"
						],
						standings: [
							{
								player: 'scaper dude',
								record: '5-0',
								army: 'Phantom Knights x4, Fen Hydra, Raelin the Kyrie Warrior (RotV), March Esenwein'
							},
							{
								player: 'Hendal',
								record: '5-0',
								army: 'Marro Stingers x7, Raelin the Kyrie Warrior (RotV)'
							},
							{
								player: 'Rollitontop',
								record: '4-1',
								army: '10th Regiment of Foot x4, Zelrig, Isamu'
							},
							{
								player: 'KaBoomboomBoom',
								record: '4-1',
								army: '4th Massachusetts Line x6, Samuel Brown'
							},
							{
								player: 'Johngee',
								record: '4-1',
								army: 'Axegrinders of the Burning Forge x3, Mogrimm Forgehammer, Darrak Ambershard, Migol Ironwill'
							},
							{
								player: 'Worseley',
								record: '4-1',
								army: 'Knights of Weston x3, Sir Gilbert, Nilfheim'
							},
							{
								player: 'spider_poison',
								record: '4-1',
								army: 'Gladiatrons x3, Blastatrons x2, Raelin the Kyrie Warrrior (RotV), Black Wyrmling x2'
							},
							{
								player: 'lonewolf',
								record: '4-1',
								army: 'Gladiatrons x2, Blastatrons x2, Phantom Knights x2, Raelin the Kyrie Warrior (RotV)'
							},
							{
								player: 'dok',
								record: '4-1',
								army: 'Tor-Kul-Na, Marrden Nagrubs x3, Krav Maga Agnets, Raelin the Kyrie Warrior (RotV), Otonashi'
							},
							{
								player: 'Mr. Infidel',
								record: '4-1',
								army: 'Nilfheim, Cyprien Esenwein, Sonya Esenwein, Deathreavers x3'
							},
							{
								player: 'Mezrath',
								record: '4-1',
								army: 'Nilfheim, Greenscale Warriors x2, Airborne Elite, Raelin the Kyrie Warrior (RotV)'
							},
							{
								player: 'ManTrainChooChoo',
								record: '4-1',
								army: 'Heavy Gruts x4, Grimnak, Raelin the Kyrie Warrior (RotV), Marcu Esenwein'
							},
							{
								player: 'nicktheant',
								record: '4-1',
								army: 'Nilfheim, Marro Stingers x5, Isamu'
							},
							{
								player: 'TurkeyClubSmich',
								record: '4-1',
								army: 'Warforged Soldiers x4, Krav Maga Agents, Raelin the Kyrie Warrior (RotV)'
							},
							{
								player: 'Raider30',
								record: '3-2',
								army: '10th Regiment of Foot x2, Roman Legionnaires x3, Marcus Decimus Gallus, Ne-Gok-Sa, Isamu'
							},
							{
								player: 'Tiny Timmy',
								record: '3-2',
								army: 'Marro Drones x6, Cyprien Esenwein, Sonya Esenwein'
							}
						]
					});
					displayTournament(document.getElementById('2011'), {
						name: "Capture the Flag",
						standings: [
							{
								player: 'fomox',
								record: null,
								army: 'Heavy Gruts x4, Grimnak, Nerak the Glacian Swog Rider'
							},
							{
								player: 'stubobj',
								record: null,
								army: 'Axegrinders of the Burning Forge x4, Major Q10, Marcu Esenwein'
							},
							{
								player: 'Worseley',
								record: null,
								army: 'Major Q9, Major Q10, Fen Hydra'
							},
							{
								player: 'Matthias Maccabeus',
								record: null,
								army: 'Heavy Gruts x4, Grimnak, Nerak the Glacian Swog Rider'
							},
							{
								player: 'chief',
								record: null,
								army: null
							},
							{
								player: 'Retlaw',
								record: null,
								army: 'Heavy Gruts x3, Grimnak, Tornak, Isamu'
							}
						]
					});
					displayTournament(document.getElementById('2011'), {
						name: "Heat of Battle",
						standings: [
							{
								player: 'Rollitontop',
								record: '4-0',
								army: '4th Massachusetts Line x6, Eldgrim the Viking Champion'
							},
							{
								player: 'spider_poison',
								record: '3-1',
								army: 'Roman Legionnaires x5, Ne-Gok-Sa, Valguard'
							},
							{
								player: 'Mr Migraine',
								record: '3-1',
								army: 'Warriors of Ashra x4, Fen Hydra, Marro Warriors, Raelin the Kyrie Warrior (RotV)'
							},
							{
								player: 'dok',
								record: '3-1',
								army: 'Heavy Gruts x4, Grimnak, Nerak'
							},
							{
								player: 'lonewolf',
								record: '3-1',
								army: '4th Massachusetts Line x6, Eldgrim'
							},
							{
								player: 'Mr. Infidel',
								record: '3-1',
								army: null
							},
							{
								player: 'TurkeyClubSamich',
								record: '3-1',
								army: '10th Regiment of Foot x6'
							},
							{
								player: 'Mezrath',
								record: '3-1',
								army: null
							},
							{
								player: 'Tiny Timmy',
								record: '3-1',
								army: '10th Regiment of Foot x6'
							}
						]
					});
					displayTournament(document.getElementById('2011'), {
						name: "Treasure Quest",
						standings: [
							{
								player: 'jdtenor',
								record: null,
								army: 'Arrow Gruts x3, Ornak, Krug, Mimring'
							},
							{
								player: 'lefton4ya',
								record: null,
								army: 'Knights of Weston x3, Sir Gilbert, Thorgrim the Viking Champion, Sir Denrick'
							},
							{
								player: 'Hendal',
								record: null,
								army: 'Ornak, Cyprien Esenwein, Sonya Esenwein, Brunak, Marcu Esenwein, Isamu, Blade Gruts x1, Dumutuf Guard x1'
							},
							{
								player: null,
								record: null,
								army: null
							},
							{
								player: 'tomcollins2000',
								record: null,
								army: 'Greenscale Warriors x2, Charos, Heirloom, Raelin the Kyrie Warrior (RotV)'
							}
						]
					});
					displayTournament(document.getElementById('2011'), {
						name: "Smack Down",
						standings: [
							{
								player: 'MrMigraine',
								record: '4-0',
								army: 'Silver Surfer, Marro Stingers x3'
							},
							{
								player: 'Juniour',
								record: '3-1',
								army: 'Thanos, Marro Warriors, Deathreavers x2'
							},
							{
								player: 'killergoat72',
								record: '3-1',
								army: 'Silver Surfer, Raelin the Kyrie Warrior (RotV), Ana Karithon'
							}
						]
					});
					displayTournament(document.getElementById('2011'), {
						name: "Slugfest",
						standings: [
							{
								player: 'stubobj',
								record: null,
								army: 'Krav Maga Agents, Taelord, Deathreavers x5'
							},
							{
								player: 'Dragonmaster384',
								record: null,
								army: 'Venoc Vipers x4, Armoc Vipers x2, Venoc Warlord, Zetacron'
							},
							{
								player: 'lonewolf',
								record: null,
								army: 'Warriors of Ashra x6, Krav Maga Agents, Raelin the Kyrie Warrior (RotV)'
							}
						]
					});
					displayTournament(document.getElementById('2011'), {
						name: "Pack Draft",
						standings: [
							{
								player: 'Rychean',
								record: null,
								army: null
							},
							{
								player: 'Necroblade',
								record: null,
								army: null
							},
							{
								player: 'Mr Migraine',
								record: null,
								army: null
							},
							{
								player: 'Lefton4ya',
								record: null,
								army: null
							}
						]
					});
					displayTournament(document.getElementById('2011'), {
						name: "Dragon's Hoard",
						standings: [
							{
								player: 'jdtenor',
								record: null,
								army: 'Ornak, Mimring, Krug, Arrow Gruts x2, Marcu Esenwein, Isamu'
							},
							{
								player: 'Guanolator',
								record: null,
								army: 'Greenscale Warriors x?, Charos'
							},
							{
								player: 'Deroche',
								record: null,
								army: 'Greenscale Warriors x2, Charos, Cyprien Esenwein'
							}
						]
					});
					displayTournament(document.getElementById('2011'), {
						name: "4x400",
						standings: [
							{
								player: 'twotongues',
								record: null,
								army: 'Vipers | Axegrinders | Heavies | Krav, Raelin'
							},
							{
								player: 'Brownsfan82',
								record: null,
								army: ''
							},
							{
								player: 'TheLorax',
								record: null,
								army: ''
							},
							{
								player: 'fomox',
								record: null,
								army: ''
							},
							{
								player: 'spidysox',
								record: null,
								army: ''
							}
						]
					});
					displayTournament(document.getElementById('2011'), {
						name: "General Wars",
						standings: [
							{
								player: 'Deroche [Jandar]',
								record: '5-0',
								army: '4th Massachusetts Line x6, Samuel Brown'
							},
							{
								player: 'Hendal [Utgar]',
								record: '5-0',
								army: 'Marro Stingers x8, Marcu Esenwein'
							},
							{
								player: 'peteparkerh [Einar]',
								record: '4-1',
								army: '10th Regiment of Foot x?, Roman Legionnaires x?, Marcus Decimus Gallus'
							},
							{
								player: 'southwest ninja',
								record: '4-1',
								army: 'Heavy Gruts x?, Marro Warriors'
							},
							{
								player: 'fomox [Aquilla]',
								record: '4-1',
								army: 'Axeginrders of the Burning Forge x5, Mogrimm Forgehammer, Water Elemental x1'
							},
							{
								player: 'Tornado [Vydar]',
								record: '4-1',
								army: 'Braxas, Gladiatrons x2, Blastatrons x2, Otonashi'
							},
							{
								player: 'SuperflyTNT',
								record: '4-1',
								army: 'Heavy Gruts x3, Tornak, Ornak, Nerak the Glacian Swog Rider, Isamu'
							},
							{
								player: 'GromBloodboy',
								record: '4-1',
								army: 'Marro Stingers x?'
							},
							{
								player: "Ryan, Scytale's friend [Ullar]",
								record: null,
								army: 'Charos, Greenscale Warriors x3, Syvarris (RotV)'
							}
						]
					});
					displayTournament(document.getElementById('2011'), {
						name: "Heroes Only",
						standings: [
							{
								player: 'killergoat72',
								record: '5-0',
								army: 'Silver Surfer, Me-Burq-Sa, Ana Karithon, Raelin the Kyrie Warrior (RotV)'
							},
							{
								player: 'Tornado',
								record: '4-1',
								army: 'Jotun, Krug, Shurrak, Marcu Esenwein, Sahuagin Raider'
							},
							{
								player: 'spidysox',
								record: '3-1',
								army: 'Silver Surfer, Spider Man, Arkmer, Marcu Esenwein'
							},
							{
								player: null,
								record: null,
								army: ''
							},
							{
								player: null,
								record: null,
								army: ''
							},
							{
								player: 'Raider30',
								record: '3-1',
								army: 'Jotun, Krug, Frost Giant of Morh x1, Zetacron'
							}
						]
					});
					displayTournament(document.getElementById('2011'), {
						name: "Monster Mash",
						standings: [
							{
								player: 'heroscaper314',
								record: null,
								army: 'Marro Stingers x5, Master of the Hunt x1, Zetacron, Me-Burq-Sa'
							},
							{
								player: "Dragonmaster384's dad",
								record: null,
								army: "Fen Hydra x4, Johnny 'Shotgun' Sullivan"
							}
						]
					});
					displayTournament(document.getElementById('2011'), {
						name: "Tournament of Champions",
						standings: [
							{
								player: 'ManTrainChooChoo',
								record: '5-0',
								army: '10th Regiment of Foot x4, Kaemon Awa, Raelin the Kyrie Warrior (RotV)'
							},
							{
								player: 'Matthias Maccabeus',
								record: '4-1',
								army: 'Marro Dividers x7, Eltahale, Isamu'
							},
							{
								player: 'stubobj',
								record: '3-1',
								army: '10th Regiment of Foot x3, Phantom Knights x3, Marro Warriors, Isamu'
							},
							{
								player: 'dok',
								record: '3-1',
								army: 'Major Q9, Fen Hydra, Deathreavers x3, Raelin the Kyrie Warrior (RotV)'
							}
						]
					});
				</script>
			</div>
			
			<div id='2012'>
				<h2>2012</h2>
				<script>
					displayTournament(document.getElementById('2012'), {
						name: "Main Event (RtW Day 2)",
						paragraphs: [
							"1st - MattsterTruckRally",
							"2nd - cornpuff",
							"Finals Map - Elswin Plateau (Valda, Kelda)",
							"Semi-Finalists: scaper dude, lonewolf",
							"Top 8: KaBoomboomBoom, TurkeyClubSamich, nicktheant, Worseley",
							"Top 16: Johngee, Mezrath, Tiny Timmy, ManTrainChooChoo, Raider30, Hendal, Rollitontop, Mr. Infidel"
						],
						standings: [
							{
								player: 'Deroche',
								record: '5-0',
								army: 'Gladiatrons x3, Blastatrons x2, Raelin the Kyrie Warrior (RotV), Otonashi'
							},
							{
								player: 'tom',
								record: '5-0',
								army: '4th Massachusetts Line x6'
							},
							{
								player: 'Pickle4192',
								record: '5-0',
								army: '4th Massachusetts Line x6'
							},
							{
								player: 'Hendal',
								record: '4-1',
								army: 'Marro Stingers x6, Raelin the Kyrie Warrior (RotV), Isamu'
							},
							{
								player: 'pitboss648',
								record: '4-1',
								army: 'Heavy Gruts x4, Grimnak, Nerak the Glacian Swog Rider'
							},
							{
								player: 'cornpuff',
								record: '4-1',
								army: 'Axegrinders of the Burning Forge x2, Mogrimm Forgehammer, Airborne Elite, Raelin the Kyrie Warrior (RotV)'
							},
							{
								player: 'MattsterTruckRally',
								record: '4-1',
								army: 'Gladiatrons x3, Blastatrons x2, Raelin the Kyrie Warrior (RotV)'
							},
							{
								player: 'EternalThanos86',
								record: '4-1',
								army: 'Death Chasers of Thesk x5, Nerak the Glacian Swog Rider, Kaemon Awa'
							},
							{
								player: 'nicktheant',
								record: '4-1',
								army: 'Phantom Knights x3, Braxas, Marcu Esenwein, Isamu, Otonashi'
							},
							{
								player: 'NecroBlade',
								record: '4-1',
								army: 'Death Chasers of Thesk x4, Ogre Pulverizer, Nerak the Glacian Swog Rider, Raelin the Kyrie Warrior (RotV)'
							},
							{
								player: 'jacob_jp',
								record: '4-1',
								army: 'Phantom Knights x3, Major Q10, Raelin the Kyrie Warrior (RotV), Isamu'
							},
							{
								player: 'OEAO',
								record: '4-1',
								army: 'Nilfheim, Greenscale Warriors x3, Raelin the Kyrie Warrior (RotV)'
							},
							{
								player: 'InfectedSloth',
								record: '3-1-1',
								army: 'Phantom Knights x4, Fen Hydra x1, Marro Warriors'
							},
							{
								player: 'DragonRuler',
								record: '3-1-1',
								army: 'Death Chasers of Thesk x4, Ogre Pulverizer, Nerak the Glacian Swog Rider, Raelin the Kyrie Warrior (RotV)'
							},
							{
								player: 'sixthflagbearer',
								record: '3-2',
								army: 'Major Q9, Marro Dividers x5, Marcu Esenwein'
							},
							{
								player: 'Rollitontop',
								record: '3-2',
								army: '4th Massachusetts Line x4, Sgt. Drake Alexander (SotM)'
							}
						]
					});
					displayTournament(document.getElementById('2012'), {
						name: "Monster Mash",
						standings: [
							{
								player: 'nicktheant',
								record: null,
								army: 'Fen Hydra x?, ?'
							},
							{
								player: 'Mr Migraine',
								record: null,
								army: 'Fen Hydra x?, ?'
							},
							{
								player: 'El Diabolo',
								record: null,
								army: 'Arrow Gruts x?, ?'
							}
						]
					});
					displayTournament(document.getElementById('2012'), {
						name: "4x400",
						standings: [
							{
								player: 'Filthy the Clown',
								record: '5-0',
								army: null
							},
							{
								player: 'sixthflagbearer',
								record: '4-1',
								army: null
							},
							{
								player: 'Lonewolf',
								record: '3-1',
								army: null
							},
							{
								player: 'scaper dude',
								record: '3-1',
								army: null
							},
							{
								player: 'dok',
								record: '3-1',
								army: null
							},
							{
								player: 'NecroBlade',
								record: '3-1',
								army: null
							},
							{
								player: 'MegaSilver',
								record: '3-1',
								army: null
							}
						]
					});
					displayTournament(document.getElementById('2012'), {
						name: "Assassin's Creed",
						standings: [
							{
								player: 'Lonewolf',
								record: null,
								army: 'Gladiatrons x2, Blastatrons x1, Fen Hydra, Raelin the Kyrie Warrior (RotV), Marcu Esenwein'
							},
							{
								player: 'Matthias Maccabeus',
								record: null,
								army: 'Roman Legionnaires x3, Marcus Decimus Gallus, Ne-Gok-Sa, Valguard'
							},
							{
								player: '?',
								record: null,
								army: null
							},
							{
								player: 'El Diabolo',
								record: null,
								army: null
							}
						]
					});
					displayTournament(document.getElementById('2012'), {
						name: "Light Weight",
						standings: [
							{
								player: 'DragonRuler',
								record: null,
								army: '4th Massachusetts Line x4'
							},
							{
								player: 'Filthy the Clown',
								record: null,
								army: 'Goblin Cutters x4, Mindflayer Mastermind x1'
							},
							{
								player: null,
								record: null,
								army: null
							},
							{
								player: 'dok',
								record: '3-1',
								army: 'Phantom Knights x4, Marcu Esenwein'
							},
							{
								player: 'Unseen Shadowz',
								record: null,
								army: 'Phantom Knights x3, Heirloom'
							}
						]
					});
					displayTournament(document.getElementById('2012'), {
						name: "Heroes Only",
						standings: [
							{
								player: 'nicktheant',
								record: null,
								army: 'Silver Surfer, Fen Hydra x1, Iron Golem x1, Isamu'
							},
							{
								player: 'Heirloom',
								record: null,
								army: 'Thanos, Spider-Man, Marcu Esenwein, Isamu'
							},
							{
								player: null,
								record: null,
								army: null
							},
							{
								player: 'MrWookie',
								record: null,
								army: null
							}
						]
					});
					displayTournament(document.getElementById('2012'), {
						name: "Fog of War",
						standings: [
							{
								player: 'fomox',
								record: null,
								army: 'Death Chasers of Thesk x6, Me-Burq-Sa, Nerak the Glacian Swog Rider, Marcu Esenwein'
							},
							{
								player: "pitboss648's son",
								record: null,
								army: 'Minions of Utgar x4, Isamu'
							},
							{
								player: 'Deroche',
								record: null,
								army: '10th Regiment of Foot x6'
							},
							{
								player: "vegietarian18's dad",
								record: '3-0-1,
								army: null
							}
						]
					});
					displayTournament(document.getElementById('2012'), {
						name: "Treasure Quest",
						standings: [
							{
								player: 'dok',
								record: null,
								army: 'Nilfheim, Greenscale Warriors x2, Cyprien Esenwein, Sonya Esenwein'
							},
							{
								player: 'jdtenor',
								record: null,
								army: 'Arrow Gruts x3, Mimring, Krug, Ornak, Isamu'
							},
							{
								player: 'fomox',
								record: null,
								army: 'Death Chasers of Thesk x3, Me-Burq-Sa, Nerak the Glacian Swog Rider, Cyprien Esenwein, Sonya Esenwein, Marcu Esenwein'
							}
						]
					});
					displayTournament(document.getElementById('2012'), {
						name: "Heat of Battle",
						standings: [
							{
								player: 'dok',
								record: '5-0',
								army: '10th Regiment of Foot x3, Marcus Decimus Gallus, Deathreavers x2, Raelin the Kyrie Warrior (RotV), Isamu'
							},
							{
								player: 'Sir Dendrik',
								record: '4-1',
								army: '4th Massachusetts Line x5, Sgt. Drake Alexander (RotV), Eldgrim the Viking Champion'
							},
							{
								player: 'Major Q23',
								record: '3-1',
								army: 'Zombies of Morddin x5, Fen Hydra x1, Raelin the Kyrie Warrior (RotV)'
							},
							{
								player: null,
								record: null,
								army: null
							},
							{
								player: 'SlipperySlope',
								record: '3-1',
								army: '10th Regiment of Foot x?, Marcus Decimus Gallus'
							}
						]
					});
					displayTournament(document.getElementById('2012'), {
						name: "Kid's Tournament",
						standings: [
							{
								player: 'ISB3',
								record: null,
								army: 'Marro Stingers x4, Krug, Guilty McCreech, Isamu'
							}
						]
					});
					displayTournament(document.getElementById('2012'), {
						name: "General Wars",
						standings: [
							{
								player: 'OEAO [Utgar]',
								record: null,
								army: 'Heavy Gruts x4, Grimnak, Nerak the Glacian Swog Rider'
							},
							{
								player: 'Unseen Shadowz',
								record: '4-0-1',
								army: 'Marro Stingers x7, Marcu Esenwein, Isamu'
							},
							{
								player: 'Wookie [Jandar]',
								record: null,
								army: '4th Massachusetts Line x6, Eldgrim'
							},
							{
								player: 'Vegietarian18 [Einar]',
								record: null,
								army: '10th Regiment of Foot x6'
							},
							{
								player: 'Major Q23 [Aquilla]',
								record: null,
								army: 'Axegrinders of the Burning Forge x4, Mogrimm Forgehammer, Brave Arrow'
							},
							{
								player: 'MegaSilver [Ullar]',
								record: null,
								army: 'Venoc Vipers x7, Venoc Warlord, Arkmer'
							},
							{
								player: 'nicktheant [Vydar]',
								record: null,
								army: 'Gladiatrons x4, Blastatrons x2, Otonashi'
							},
							{
								player: 'ISB3',
								record: '4-1',
								army: null
							},
						]
					});
					displayTournament(document.getElementById('2012'), {
						name: "Team Tournament",
						standings: [
							{
								player: 'sixthflagbearer / his dad',
								record: '5-0',
								army: '4th Massachusetts Line x4 | Major Q9, Heirloom'
							},
							{
								player: 'lonewolf / scaper_dude',
								record: '4-1',
								army: '4th Massachusetts Line x3, Samuel Brown | Phantom Knights x4'
							},
							{
								player: 'MegaSilver / SlipperySlope',
								record: '3-1',
								army: 'Major Q9, Deathreavers x3 | Krav Maga Agents, Axegrinders of the Burning Forge x1, Raelin the Kyrie Warrior (RotV)'
							},
							{
								player: 'Deroche / NecroBlade',
								record: '3-1',
								army: '4th Massachusetts Line x3, Samuel Brown | Phantom Knights x4'
							},
							{
								player: 'InfectedSloth / Major Q23',
								record: '3-1',
								army: '4th Massachusetts Line x4 | Heirloom, Kaemon Awa, Marro Warriors ,Isamu'
							}
						]
					});
				</script>
			</div>
			
			<script>
				/*
				displayTournament(document.getElementById('2011'), {
					name: "",
					standings: [
						{
							player: '',
							record: null,
							army: ''
						},
						{
							player: '',
							record: null,
							army: ''
						},
						{
							player: '',
							record: null,
							army: ''
						}
					]
				});
				*/
			</script>

			
			
			
			
			
			<h2>2013</h2>
			<h3>Main Event (RtW Day 2)</h3>
			<h4>Finals</h4>
			<p>1st - Orange Mailman (10th Regiment of Foot x2, Marcus Decimus Gallus, Sgt. Drake Alexander (RotV), Raelin the Kyrie Warrior (RotV))</p>
			<p>2nd - Matthias Maccabeus (Fyorlag Spiders x4, Wyvern x2, Estivara)</p>
			<p>Map - Dry Season (Valda, Kelda)</p>
			
			<h2>2014</h2>
			<h3>Main Event (RtW Day 2)</h3>
			<h4>Finals</h4>
			<p>1st - Rychean (Marrden Hounds x4, Arkmer)</p>
			<p>2nd - ManTrainChooChoo (Mohican River Trive x3, Brave Arrow, James Murphy, Raelin the Kyrie Warrior (RotV))</p>
			<p>Map - Fossil (?, ?)</p>
			
			<h2>2015</h2>
			<h3>Main Event (RtW Day 2)</h3>
			<h4>Finals</h4>
			<p>1st - Weasel (Venoc Vipers x3, Elite Onyx Vipers, Kaemon Awa)</p>
			<p>2nd - Matthias Maccabeus (Sacred Band x3, Marcus Decimus Gallus, Parmenio, Raelin the Kyrie Warrior (SotM))</p>
			<p>Map - Dance of the Dryads (?, ?)</p>
			
			<h2>2016</h2>
			<h3>Main Event (RtW Day 2)</h3>
			<h4>Finals</h4>
			<p>1st - ISB3 (Goblin Cutters x4, Major Q10, Zetacron)</p>
			<p>2nd - NickTheAnt (Microcorp Agents x4, Laglor, Raelin the Kyrie Warrior (RotV), Isamu)</p>
			<p>Map - Fire (?, ?)</p>
			
			<h2>2017</h2>
			<h3>Main Event (RtW Alternating)</h3>
			<h4>Finals</h4>
			<p>1st - dok (Roman Legionnaires x2, Me-Burq-Sa, Red Wyrmling x3, Blue Wyrmling x3, White Wyrmling x1, Raelin the Kyrie Warrior (RotV), Otonashi)</p>
			<p>2nd - InfectedSloth (Horned Skull Brutes x2, Mezzodemon Warmongers x1, Kozuke Samurai, Tarn Viking Warriors, Raelin the Kyrie Warrior (RotV))</p>
			<p>Map - Zephyr (Valda)</p>
			
			<h2>2018</h2>
			<h3>Main Event (RtW Alternating)</h3>
			<h4>Finals</h4>
			<p>1st - Matthias Maccabeus (Axegrinders x4, Darrak Ambershard, Marcu Esenwein, Hatamoto Taro)</p>
			<p>2nd - Evantage (4th Massachusetts Line x2, Roman Legionnaires x2, Marcus Decimus Gallus, Major Q10)</p>
			<p>Map - Ticalla Sunrise (?, ?)</p>
			<h4>Top 16</h4>
			<table class='t16Table'>
				<tr>
					<th>Player</th>
					<th>R1</th>
					<th>R2</th>
					<th>R3</th>
					<th>R4</th>
					<th>R5</th>
					<th>Army</th>
				</tr>
				<tr>
					<td>Hendal</td>
					<td>W</td>
					<td>W</td>
					<td>W</td>
					<td>W</td>
					<td>W</td>
					<td>Nilfheim, Greenscale Warriors x2, Fen Hydra, Marrden Nagrubs, Marcu Esenwein, Isamu</td>
				</tr>
				<tr>
					<td>Matthias Maccabeus</td>
					<td>W</td>
					<td>W</td>
					<td>W</td>
					<td>W</td>
					<td>W</td>
					<td>Axegrinders of Burning Forge x4, Darrak Ambershard, Marcu Esenwein, Hatamoto Taro</td>
				</tr>
				
				<tr>
					<td>Evantage</td>
					<td>L</td>
					<td>W</td>
					<td>W</td>
					<td>W</td>
					<td>W</td>
					<td>4th Massachusetts Line x2, Roman Legionnaires x2, Marcus Decimus Gallus, Major Q10</td>
				</tr>
				<tr>
					<td>dok</td>
					<td>W</td>
					<td>W</td>
					<td>W</td>
					<td>W</td>
					<td>L</td>
					<td>Tor-Kul-Na, Marrden Nagrubs x4, Samuel Brown, Raelin the Kyrie Warrior (RotV), Otonashi</td>
				</tr>
				<tr>
					<td>Vegietarian18</td>
					<td>W</td>
					<td>W</td>
					<td>L</td>
					<td>W</td>
					<td>W</td>
					<td>Tagawa Samurai Archers x2, Knights of Weston x1, Alastair MacDirk, Syvarris, Raelin the Kyrie Warrior (RotV)</td>
				</tr>
				<tr>
					<td>Mr Chompy</td>
					<td>L</td>
					<td>W</td>
					<td>W</td>
					<td>W</td>
					<td>W</td>
					<td>Gorillinators x4, Nakita Agents, Otonashi</td>
				</tr>
				<tr>
					<td>OEAO / Mike</td>
					<td>W</td>
					<td>W</td>
					<td>L</td>
					<td>W</td>
					<td>W</td>
					<td>Phantom Knights x2, Warriors of Ashra x2, Concan the Kyrie Warrior, Jorhdawn, Arkmer, Kyntella</td>
				</tr>
				
				<tr>
					<td>ISB3</td>
					<td>L</td>
					<td>W</td>
					<td>T</td>
					<td>W</td>
					<td>W</td>
					<td>Goblin Cutters x3, Alastair MacDirk, Agent Carr, Dund</td>
				</tr>
				
				<tr>
					<td>Wookie</td>
					<td>W</td>
					<td>L</td>
					<td>L</td>
					<td>W</td>
					<td>W</td>
					<td>Marro Stingers x5, Sgt. Drake Alexander (SotM), Marcu Esenwein</td>
				</tr>
				<tr>
					<td>Michael White</td>
					<td>W</td>
					<td>L</td>
					<td>W</td>
					<td>L</td>
					<td>W</td>
					<td>Warforged Soldiers x4, Siege, Marro Warriors</td>
				</tr>
				<tr>
					<td>Dysoole</td>
					<td>L</td>
					<td>L</td>
					<td>W</td>
					<td>W</td>
					<td>W</td>
					<td>Templar Cavalry x2, 4th Massachusetts Line x2, Raelin the Kyrie Warrior (RotV), Eldgrim the Viking Champion</td>
				</tr>
				<tr>
					<td>Bradley Wersterfer</td>
					<td>W</td>
					<td>W</td>
					<td>L</td>
					<td>L</td>
					<td>W</td>
					<td>Zelrig, Greenscale Warriors x2, Nakita Agents, Samuel Brown</td>
				</tr>
				<tr>
					<td>Chris Perkins</td>
					<td>W</td>
					<td>L</td>
					<td>W</td>
					<td>W</td>
					<td>L</td>
					<td>Knights of Weston x1, Thorgrim the Viking Champion, Mezzodemon Warmongers x2, Marro Warriors, Zetacron, Raelin the Kyrie Warrior (RotV), Marcu Esenwein</td>
				</tr>
				<tr>
					<td>Major Q23</td>
					<td>L</td>
					<td>W</td>
					<td>L</td>
					<td>W</td>
					<td>W</td>
					<td>Axegrinders of Burning Forge x2, Darrak Ambershard, Phantom Knights x1, Tandros Kreel, Arkmer, Tarn Viking Warriors</td>
				</tr>
				<tr>
					<td>Chill</td>
					<td>W</td>
					<td>L</td>
					<td>W</td>
					<td>W</td>
					<td>L</td>
					<td>Ulginesh, Jorhdawn, Chardris, Arkmer, Raelin the Kyrie Warrior (RotV)</td>
				</tr>
				<tr>
					<td>Mark Pruett</td>
					<td>W</td>
					<td>W</td>
					<td>L</td>
					<td>W</td>
					<td>L</td>
					<td>Aubrien Archers x4, Sonlen (SotM), Arkmer</td>
				</tr>
			</table>
			
			<h2>2019</h2>
			<h3>Main Event (RtW Alternating)</h3>
			<h4>Finals</h4>
			<p>1st - InfectedSloth (Heaavy Gruts x2, Horned Skull Brutes x1, Mezzodemon Warmongers x1, Raelin the Kyrie Warrior (RotV), Nerak the Glacian Swog Rider)</p>
			<p>2nd - Vegietarian18 (Deathchasers of Thesk x3, Me-Burq-Sa, Nerak the Glacian Swog Rider, Theracus, Major X17)</p>
			<p>Map - Dance of the Dryads (Ulanivia, Valda)</p>
			<h4>Top 16</h4>
			<table class='t16Table'>
				<tr>
					<th>Player</th>
					<th>Army</th>
				</tr>
				<tr>
					<td>David Becher</td>
					<td>Axegrinders of Burning Forge x3, Laglor, Heirloom</td>
				</tr>
				<tr>
					<td>Brian Baird</td>
					<td>Marro Dividers x2, Marrden Nabrugs x2, Marrden Hounds x1, Su-Bak-Na</td>
				</tr>
				<tr>
					<td>John W</td>
					<td>Heavy Gruts x3, Tornak, Ornak</td>
				</tr>
				<tr>
					<td>Sir Dendrick</td>
					<td>Venoc Vipers x4, Venoc Warlord, Krug</td>
				</tr>
				<tr>
					<td>Matthia Maccabeus</td>
					<td>Fyorlag Spiders x5, Wyvern x2, Otonashi</td>
				</tr>
				<tr>
					<td>Major Q23</td>
					<td>Axegrinders x2, Heirloom, Tandrox Kreel, Tarn Viking Warriors</td>
				</tr>
				<tr>
					<td>InfectedSloth</td>
					<td>Heavy Gruts x2, Horned Skull Brutes x1, Mezzodemon Warmongers x1, Raelin the Kyrie Warrior (RotV), Nerak the Glacian Swog Rider</td>
				</tr>
				<tr>
					<td>Chris Perkins</td>
					<td>Knights of Weston x1, Thorgrim, Mezzodemon Warmongers x2, Me-Burq-Sa, Relin the Kyrie Warrior (RotV)</td>
				</tr>
				<tr>
					<td>Dysole</td>
					<td>Marro Dividers x2, Roman Archers x2, Nakita Agents, Raelin the Kyrie Warrior (RotV)</td>
				</tr>
				<tr>
					<td>Caps</td>
					<td>Horned Skull Brutes x2, Deathreavers x2, Brandis Skyhunter, Raelin the Kyrie Warrior (RotV)</td>
				</tr>
				<tr>
					<td>OEAO / Mike</td>
					<td>Phantom Knights x2, Concan, Horned Skull Brutes x1, Mezzodemon Warmongers x1, Tarn Viking Warriors</td>
				</tr>
				<tr>
					<td>DragonRuler</td>
					<td>Sacred Band x2, Marcus Decimus Gallus, Red Wyrmling x4, Raelin the Kyrie Warrior (RotV)</td>
				</tr>
				<tr>
					<td>Vegietarian18</td>
					<td>Deathchasers of Thesk x3, Me-Burq-Sa, Nerak the Glacian Swog Rider, Theracus, Major X17</td>
				</tr>
				<tr>
					<td>Son of Chompy</td>
					<td>Roman Legionnaires x2, Roman Archers x2, Marcus Decimus Gallus, Ne-Gok-Sa</td>
				</tr>
				<tr>
					<td>dok</td>
					<td>Blastatrons x2, Gladiatrons x1, Raelin the Kyrie Warrior (SotM), Kumiko, Otonashi</td>
				</tr>
				<tr>
					<td>Evantage</td>
					<td>Heavy Gruts x3, Grimnak, Nerak the Glacian Swog Rider, Marcu Esenwein, Isamu</td>
				</tr>
			</table>
			
			<h2>2024</h2>
			<h3>Main Event (Contemporary Cheese)</h3>
			<h4>Finals</h4>
			<p>1st - Chris Perkins (Frostclaw Paladins, Alastair MacDirk, Eldgrim the Viking Champion, Krav Maga Agents, Marcu Esenwein, Isamu)</p>
			<p>2nd - Boromir96 (Frostclaw Paladins, Alastair MacDirk, Eldgrim the Viking Champion, Krug)</p>
			<p>Map - ? (?, ?)</p>
			
			<h2>2025</h2>
			<h3>Main Event (Contemporary Cheese)</h3>
			<h4>Finals</h4>
			<p>1st - NickTheAnt (Queen Maladrix, Festering Honor Guard, Tanuki Tricksters x4)</p>
			<p>2nd - Bodacious Blood (Queen Maladrix, Festering Honor Guard, Major Q11, Revnan Acolytes x1)</p>
			<p>Map - ? (?, ?)</p>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>