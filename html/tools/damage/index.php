<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Damage Calculator</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		article {
			padding-top: 10px;
		}
		
		.powers {
			display: inline-block;
			width: 200px; 
			vertical-align: top;
			margin-bottom: 20px;
		}
		
		.powers label {
			display: block;
			text-align: left;
			margin-left: 30px;
		}
		
		.dropdown {
			margin-left: 20px;
			margin-right: 20px;
		}
		
		#calculateButton {
			display: block;
			margin: auto;
			margin-top: 20px;
			margin-bottom: 20px;
		}
		
		#thankYou {
			margin: auto;
			margin-top: 50px;
			max-width: 400px;
		}
		
		#output table {
			margin: auto;
			margin-top: 20px;
		}
		
		#output table, #output th, #output td {
			border: 1px solid var(--primary_color);
			border-collapse: collapse;
		}
		
		#output td, #output th {
			padding-left: 10px;
			padding-right: 10px;
		}
		
		#stealthArmorNumber {
			width: 40px;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
		
	<script>
		function calculateOdds(attack, defense) {
			var parentElem = document.getElementById("output");
			parentElem.innerHTML = "";
			
			// Offensive powers
			const deadlyStrike = document.getElementById("deadlyStrike").checked;
			//const paralyzingStare = document.getElementById("paralyzingStare").checked;
			const venomousString = document.getElementById("venomousSting").checked;
			const autoSkull = document.getElementById("autoSkull").checked;
			const orcBattleCryAura = document.getElementById("orcBattleCryAura").checked;
			const rerollNonSkulls = document.getElementById("rerollNonSkulls").checked;
			
			// Defensive powers
			const ironTough = document.getElementById("ironTough").checked;
			const autoShield = document.getElementById("autoShield").checked;
			const oneShieldDefense = document.getElementById("oneShieldDefense").checked;
			const shieldsOfValor = document.getElementById("shieldsOfValor").checked;
			const stealthDodge = document.getElementById("stealthDodge").checked;
			const giftOfTheEmpressAuta = document.getElementById("giftOfTheEmpressAuta").checked;
			const heroicDefenseAura = document.getElementById("heroicDefenseAura").checked;
			const stealthArmor = document.getElementById("stealthArmor").checked
				? document.getElementById("stealthArmorNumber").value
				: null;
			
			var attackProbability = orcBattleCryAura ? 2/3 : 1/2;
			if (rerollNonSkulls) {
				attackProbability = 1 - (Math.pow(1-attackProbability, 2));
			}
			const defenseProbability = giftOfTheEmpressAuta 
				? 1 - (2/3)*(2/3) 
				: heroicDefenseAura
					? 1/2
					: 1/3;
			
			var outcomes = [];
			for (let a = 0; a <= attack; a++) {
				var subOutcomes = [];
				for (let d = 0; d <= defense; d++) {
					var altA = a;
					var altD = d;
					if (deadlyStrike) {
						altA *= 2;
					}
					if (autoSkull) {
						altA += 1;
					}
					if (shieldsOfValor) {
						altD *= 2;
					}
					if (ironTough) {
						altD += 2;
					}
					if ((venomousString && a == attack)) {
						altD = 0;
					}
					if (stealthDodge && altD > 0) {
						altD = altA;
					}
					if (oneShieldDefense && altD > 0) {
						if (altA > altD + 1) {
							altD = altA - 1;
						}
					}
					
					subOutcomes[d] = {
						damage: Math.max(altA-altD, 0),
						probability: prob(attack, a, attackProbability) * prob(defense, d, defenseProbability),
						counterStrike: Math.max(0, altD-altA)
					};
					
					if (autoShield && subOutcomes[d].damage > 0) {
						subOutcomes[d].damage -= 1;
					}
				}
				outcomes[a] = subOutcomes;
			}
			
			console.log(outcomes);
			
			var averageDamage = 0;
			for (let a = 0; a <= attack; a++) {
				for (let b = 0; b <= defense; b++) {
					var additionalDamage = outcomes[a][b].damage * outcomes[a][b].probability;
					if (stealthArmor != null) {
						const damageGoThruProbability = ((parseInt(stealthArmor) - 1) / 20);
						additionalDamage *= damageGoThruProbability;
					}
					averageDamage += additionalDamage;
				}
			}
			
			parentElem.appendChild(createDiv({innerHTML: "Average Damage : " + averageDamage.toFixed(3) + " wounds"}));
			
			parentElem.appendChild(createH2({innerHTML: "Attack Damage Probabilities"}));
			var tableElem = createTable();
			parentElem.appendChild(tableElem);
			var headerRow = createTr();
			tableElem.appendChild(headerRow);
			headerRow.appendChild(createTh({innerHTML: ""}));
			headerRow.appendChild(createTh({innerHTML: "% <= # Wounds"}));
			headerRow.appendChild(createTh({innerHTML: "% = # Wounds"}));
			headerRow.appendChild(createTh({innerHTML: "% >= # Wounds"}));
			
			const iMax = 
				deadlyStrike
					? attack*2 
					: autoSkull
						? parseInt(attack)+1
						: attack;
						
			var p1Running = 0;
			var p3Running = 1;
			
			for (let i = 0; i <= iMax; i++) {
				var rowElem = createTr({});
				tableElem.appendChild(rowElem);
				rowElem.appendChild(createTd({innerHTML: i}));
				
				var p1 = 0;
				var p2 = 0;
				var p3 = 0;
				for (let a = 0; a <= attack; a++) {
					for (let b = 0; b <= defense; b++) {
						if (outcomes[a][b].damage <= i) {
							p1 += outcomes[a][b].probability;
						}
						if (outcomes[a][b].damage == i) {
							p2 += outcomes[a][b].probability;
						}
						if (outcomes[a][b].damage >= i) {
							p3 += outcomes[a][b].probability;
						}
					}
				}
				
				if (stealthArmor != null) {
					const stealthArmorProbability = ((parseInt(stealthArmor)-1) / 20);
					if (i == 0) {
						p1 += (1 - p1) * (1 - stealthArmorProbability);
						p2 += (1 - p2) * (1 - stealthArmorProbability);
						// No change to p3
					} else {
						p2 *= stealthArmorProbability;
					}
				}
				
				p1Running += p2;
				p1 = p1Running;
				p3 = p3Running;
				
				rowElem.appendChild(createTd({innerHTML: (p1*100).toFixed(2) + " %"}));
				rowElem.appendChild(createTd({innerHTML: (p2*100).toFixed(2) + " %"}));
				rowElem.appendChild(createTd({innerHTML: (p3*100).toFixed(2) + " %"}));
				
				p3Running -= p2;
			}
			
			parentElem.appendChild(createH2({innerHTML: "Counter Strike Probabilities"}));
			var counterStrikeTable = createTable({});
			parentElem.appendChild(counterStrikeTable);
			var csHeaderRow = createTr();
			counterStrikeTable.appendChild(csHeaderRow);
			csHeaderRow.appendChild(createTh({innerHTML: ""}));
			csHeaderRow.appendChild(createTh({innerHTML: "% <= # Wounds"}));
			csHeaderRow.appendChild(createTh({innerHTML: "% = # Wounds"}));
			csHeaderRow.appendChild(createTh({innerHTML: "% >= # Wounds"}));
			var csProbs = [];
			for (let i = 0; i < outcomes.length; i++) {
				for (let j = 0; j < outcomes[i].length; j++) {
					if (csProbs[outcomes[i][j].counterStrike] == undefined) {
						csProbs[outcomes[i][j].counterStrike] = 0;
					}
					csProbs[outcomes[i][j].counterStrike] += outcomes[i][j].probability;
				}
			}
			var csProbSum = 0;
			for (let i = 0; i < csProbs.length; i++) {
				var rowElem = createTr({});
				counterStrikeTable.appendChild(rowElem);
				rowElem.appendChild(createTd({innerHTML: i}));
				var csProbSumOpp = 1-csProbSum;
				csProbSum += csProbs[i];
				rowElem.appendChild(createTd({innerHTML: (csProbSum*100).toFixed(2) + " %"}));
				rowElem.appendChild(createTd({innerHTML: (csProbs[i]*100).toFixed(2) + " %"}));
				rowElem.appendChild(createTd({innerHTML: (csProbSumOpp*100).toFixed(2) + " %"}));
				

			}
			
		}
		
		/*
			n coins
			k heads
			p % heads
			
			(n choose k) * p^k * (1-p)^(n-k)
		*/
		function prob(n, k, p) {
			return binomialCoefficient(n, k) * Math.pow(p, k) * Math.pow(1-p, n-k);
		}
		
		function binomialCoefficient(n, k) {
			return factorial(n) / (factorial(k) * factorial(n-k));
		}
		
		function factorial(n) {
			if (n == 1 || n == 0) {
				return 1;
			}
			return n * factorial(n-1);
		}
		
		function calculate() {
			const attackSelect = document.getElementById("attackSelect");
			const defenseSelect = document.getElementById("defenseSelect");
			const attack = attackSelect.options[attackSelect.selectedIndex].value;
			const defense = defenseSelect.options[defenseSelect.selectedIndex].value;
			calculateOdds(attack, defense);
		}
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(ToolsNav); ?>
	
	<div id='pageContent'>		
		<article>	
			<div>
				<div class='powers'>
					<h2>Attack Powers</h2>
					<label>
						<input type='checkbox' id='autoSkull' />
						Auto-Skull
					</label>
					<label>
						<input type='checkbox' id='deadlyStrike' />
						Deadly Strike
					</label>
					<!--<label>
						<input type='checkbox' id='intenseStrike' />
						Intense Strike
					</label>-->
					<!--<label>
						<input type='checkbox' id='paralyzingStare' />
						Paralyzing Stare
					</label>-->
					<!--<label>
						<input type='checkbox' id='poisonousPowers' />
						Poisonous Powers
					</label>-->
					<!--<label>
						<input type='checkbox' id='netTrip' />
						Net Trip
					</label>-->
					<!--<label>
						<input type='checkbox' id='redFlagOfFury' />
						Red Flag of Fury
					</label>-->
					<!--<label>
						<input type='checkbox' id='stingerDrain' />
						Stinger Drain
					</label>-->
					<label>
						<input type='checkbox' id='venomousSting' />
						Venomous Sting / Maul
					</label>
					<label>
						<input type='checkbox' id='orcBattleCryAura' />
						Orc Battle Cry Aura
					</label>
					<label>
						<input type='checkbox' id='rerollNonSkulls' />
						Reroll Non-Skulls
					</label>
				</div>
				<div class='powers'>
					<h2>Defense Powers</h2>
					<label>
						<input type='checkbox' id='autoShield' />
						Auto-Shield
					</label>
					<!--<label>
						<input type='checkbox' id='hatamotosAuta' />
						Hatamoto's Aura
					</label>-->
					<label>
						<input type='checkbox' id='ironTough' />
						Iron Tough
					</label>
					<label>
						<input type='checkbox' id='oneShieldDefense' />
						One Shield Defense
					</label>
					<label>
						<input type='checkbox' id='shieldsOfValor' />
						Shields of Valor
					</label>
					<label>
						<input type='checkbox' id='stealthDodge' />
						Stealth Dodge / Defensive Agility
					</label>
					<label>
						<input type='checkbox' id='giftOfTheEmpressAuta' />
						Gift of the Empress Aura
					</label>
					<label>
						<input type='checkbox' id='heroicDefenseAura' />
						Heroic Defense Aura
					</label>
					<label>
						<input type='checkbox' id='stealthArmor' />
						Stealth Armor
						<input type='number' id='stealthArmorNumber' min=1 max=20 />
					</label>
					
					<!--<label>
						<input type='checkbox' id='vanish' />
						Vanish
					</label>-->
				</div>
			</div>
		
			<div>
				<label class='dropdown'>
					Attack : 
					<select id='attackSelect'>
						<option value=0>0</option>
						<option value=1>1</option>
						<option value=2>2</option>
						<option value=3>3</option>
						<option value=4>4</option>
						<option value=5>5</option>
						<option value=6>6</option>
						<option value=7>7</option>
						<option value=8>8</option>
						<option value=9>9</option>
						<option value=10>10</option>
						<option value=11>11</option>
						<option value=12>12</option>
					</select>
				</label>
				
				<label class='dropdown'>
					Defense : 
					<select id='defenseSelect'>
						<option value=0>0</option>
						<option value=1>1</option>
						<option value=2>2</option>
						<option value=3>3</option>
						<option value=4>4</option>
						<option value=5>5</option>
						<option value=6>6</option>
						<option value=7>7</option>
						<option value=8>8</option>
						<option value=9>9</option>
						<option value=10>10</option>
						<option value=11>11</option>
						<option value=12>12</option>
					</select>
				</label>
			
				<button type='button' id='calculateButton' onclick='calculate()'>Calculate</button>
			</div>
			
			<div id='output'></div>
			
			<div id='thankYou'>Thanks to Vegietarian18 for inspiring this tool via his Sterilizing Pear app.</div>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>