

/** Meta Health Index (MHI)
*   Purpose: measure how diverse (i.e. healthy) the meta is for a given tournament
*   Original Author : Ryguy
*/
async function mhi(tournament, callbackFcn) {
	// Constants
	const ctw = 0.75; // Current Tournament Weight (for Win %)
	const tew = 2; // Tail End Weight
	const mw = 0.1; // Minumum Weight
	//const esa = 2; // Expand Scale Adjustment - To use more of the 0-1 range
	const mT = tournament.pointLimit * tournament.numArmies; // # Points in Format
	
	deltaPoints = tournament.useDeltaPricing;
	//vcInclusive = tournament.includeVC;
	
	var asyncTasks = [];
	for (let i = 0; i < tournament.players.length; i++) {
		if (tournament.players[i].user != null) {
			asyncTasks.push(loadUserLifetimeResults(tournament.players[i].user));
			//n++;
		}
	}
	asyncTasks.push(loadUnits(tournament));
	await Promise.all(asyncTasks);
	//const standings = generateStandings(tournament);
	
	if (Object.keys(unitsMap).length == 0) {
		return;
	}
	
	var sumJij = 0;
	var n = 0;
	for (let i = 0; i < tournament.players.length; i++) {
		const playerI = tournament.players[i];
		if (playerI.user == null || playerI.playerArmys.length == 0) {
			continue;
		}
		const playerIarmy = _mergePlayerArmy(playerI);
		
		const winPercentLifetime = calculateAllTimeWinPercentage(playerI.user); // All-Time W-L of Player i 
		const winPercentTourney = calculateTournamentWinPercentage(playerI); 
		const winPercent = (winPercentTourney * ctw) + (winPercentLifetime * (1 - ctw)); 
		const rA = Math.max(mw, 1 - tew*((0.5-winPercent)/0.5)); 
		//const rT = _getPlayerStandingsRank(playerI, standings); // Rank of Player i
		
		var sumJi = 0;
		for (let j = 0; j < tournament.players.length; j++) {
			const playerJ = tournament.players[j];
			if ((playerJ.user != null || playerJ.playerArmys.length == 0) && (playerI.id != playerJ.id)) {		
				var playerJarmy = _mergePlayerArmy(playerJ);
				
				// Calculate MS
				var mS = 0; // # Points Shared Between Players
				for (const iIdx in playerIarmy) {
					const entryI = playerIarmy[iIdx].trim();
					if (entryI.length == 0) {
						continue;
					}
					var figureNameI = null;
					var figureQuantityI = null;
					if (unitsMap[entryI] === undefined) {
						figureNameI = entryI.substr(0, entryI.lastIndexOf(" "));
						figureQuantityI = parseInt(entryI.substr(entryI.lastIndexOf(" ")+2));
					} else {
						figureNameI = entryI;
						figureQuantityI = 1;
					}
					
					for (const jIdx in playerJarmy) {
						const entryJ = playerJarmy[jIdx].trim();
						if (entryJ.length == 0) {
							continue;
						}
						var figureNameJ = null;
						var figureQuantityJ = null;
						if (unitsMap[entryJ] === undefined) {
							figureNameJ = entryJ.substr(0, entryJ.lastIndexOf(" "));
							figureQuantityJ = parseInt(entryJ.substr(entryJ.lastIndexOf(" ")+2));
						} else {
							figureNameJ = entryJ;
							figureQuantityJ = 1;
						}
						
						if (figureNameI == figureNameJ) {
							const overlapQuantity = Math.min(figureQuantityI, figureQuantityJ);
							mS += unitsMap[figureNameI].getCost() * overlapQuantity;
							break;
						}
					}
				}
				
				//var jIJ = (mS / mT) /** (1 / Math.log(1 + rT)) * rA*/;
				var jIJ = (mS / mT) * rA;
				n += rA;
				//console.log(playerI.name + ", " + playerJ.name + " Jij = " + jIJ);
				sumJi += jIJ;
			}
		}
		//console.log(playerI.name + " net Jij = " + sumJi);
		sumJij += sumJi;
	}
	
	const mhiI = 1 - (sumJij / n);
	//const mhiF = Math.max(0, mhiI - ((1 - mhiI) * esa));
	callbackFcn(mhiI);
}

function _mergePlayerArmy(player) {
	var army = "";
	for (let i = 0; i < player.playerArmys.length; i++) {
		if (i > 0) {
			army += ",";
		}
		army += player.playerArmys[i].toDisplayString();
	}
	army = army.split(",");
	return army;
}

function _getPlayerStandingsRank(player, standings) {
	for (let i = 0; i < standings.length; i++) {
		if (standings[i].id == player.id) {
			return i+1;
		}
	}
}

function loadUserLifetimeResults(user) {
	
	
	return new Promise(function(resolve, reject) {
		User.load(
			{id: user.id},
			function (users) {
				if (users.length == 1) {
					const user = users[0];
					
					resolve(user);
					
				} else {
					reject();
				}	
			},
			{joins: {
				"Player.userID": {
					"HeroscapeGamePlayer.playerID": {
						"gameID": {
							/*"roundID": {
								"tournamentID": {
									
								}
							},*/
							/*"HeroscapeGamePlayer.gameID": {
								"playerID": {}
							},*/
							/*"mapID": {}*/
						}
					},
					"tournamentID": {}
				}
			}});
	});
}

function calculateAllTimeWinPercentage(user) {
	var wins = 0;
	var losses = 0;
	var ties = 0;
	for (let i = 0; i < user.players.length; i++) {
		const player = user.players[i];
		const tournament = player.tournament;
		for (let j = 0; j < player.heroscapeGamePlayers.length; j++) {
			const gamePlayer = player.heroscapeGamePlayers[j];
					
			if (tournament.maxNumPlayersPerGame == 2) {
				if (gamePlayer.result == 2) {
					wins++;
				} else if (gamePlayer.result == 0) {
					losses++;
				} else if (gamePlayer.result == 1) {
					ties++;
				}
			} else {
				// TODO - handle multiplayer
			}
		}	
	}
	return wins / (wins + losses);
}

function calculateTournamentWinPercentage(player) {
	const totalGames = player.wins() + player.losses();
	return totalGames == 0
		? 0
		: player.wins() / totalGames;
}