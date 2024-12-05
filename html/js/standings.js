/** 
	File to sort & display players for a given League, Season, or Convention

*/

var _sortPlayersTournaments = null;

/*
	Public Entry Point
*/
var _displayStandingsTournaments = null;
//var _displayStandingsParentElem = null;
var _displayStandingsSortCriteria = 1;
function displayStandings(tournaments=null, parentElem=null) {
	if (tournaments != null) {
		_displayStandingsTournaments = tournaments;
	} else {
		tournaments = _displayStandingsTournaments;
	}
	/*if (parentElem != null) {
		_displayStandingsParentElem = parentElem;
	} else {
		parentElem = _displayStandingsParentElem;
	}*/
	//parentElem.innerHTML = "";
	
	var players = _createPlayers(tournaments);
	
	_sortPlayersTournaments = tournaments;
	players.sort(_sortPlayers);
	
	var playersTable = document.getElementById("_displayStandingsPlayersTable");
	if (playersTable == null) {
		var playersTable = createTable({
			id: "_displayStandingsPlayersTable"
		});
		parentElem.appendChild(playersTable);
	} else {
		playersTable.innerHTML = "";
	}
	
	var headerRow = createTr({});
	playersTable.appendChild(headerRow);
	headerRow.appendChild(createTh({}));
	headerRow.appendChild(createTh({
		innerHTML: "Player",
		onclick: "_displayStandingsAltSort(5)"}));
	headerRow.appendChild(createTh({
		innerHTML: "W %",
		onclick: "_displayStandingsAltSort(3)"}));
	headerRow.appendChild(createTh({
		innerHTML: "W",
		onclick: "_displayStandingsAltSort(1)"}));
	headerRow.appendChild(createTh({
		innerHTML: "L",
		onclick: "_displayStandingsAltSort(2)"}));
	headerRow.appendChild(createTh({
		innerHTML: "T",
		onclick: "_displayStandingsAltSort(6)"}));
	headerRow.appendChild(createTh({
		innerHTML: "SoS",
		onclick: "_displayStandingsAltSort(4)"}));
	
	var prevRank = null;
	var prevPlayer = null;
	for (let i = 0; i < players.length; i++) {
		const player = players[i];
		if (player.wins + player.losses + player.ties == 0) {
			continue;
		}
				
		var row = createTr({});
		playersTable.appendChild(row);
		
		var playerTd = createTd({});
		if (player.player.user != null) {
			playerTd.appendChild(createA({
				innerHTML: player.player.user.userName,
				href: "/user/?userName="+player.player.user.userName
			}));
		} else {
			playerTd.appendChild(createSpan({
				innerHTML: player.player.name
			}));
		}
		
		var playerRank = i+1;
		if (prevPlayer != null && _sortPlayers(prevPlayer, player, true) == 0) {
			playerRank = "T-"+prevRank;
		} else if (i+1 < players.length && _sortPlayers(player, players[i+1], true) == 0) {
			playerRank = "T-"+playerRank;
			prevRank = i+1;
		} else {
			prevRank = playerRank;
		}
		row.appendChild(createTd({
			innerHTML: playerRank
		}));
		prevPlayer = player;
		
		row.appendChild(playerTd);
		var winPercent = (player.wins / (player.wins + player.losses)) * 1.0;
		if (isNaN(winPercent)) {
			row.appendChild(createTd({innerHTML: "---"}));
		} else {
			row.appendChild(createTd({innerHTML: (Math.round(winPercent * 1000) / 1000).toFixed(3)}));
		}
		row.appendChild(createTd({innerHTML: player.wins}));
		row.appendChild(createTd({innerHTML: player.losses}));
		row.appendChild(createTd({innerHTML: player.ties}));
		const sos = player.player.user != null
			? player.player.user.strengthOfSchedule(tournaments)			
			: player.player.strengthOfSchedule();
		row.appendChild(createTd({innerHTML: sos}));
	}
}

/*
	Helper Functions 
*/

function _displayStandingsAltSort(criteriaNum) {
	_displayStandingsSortCriteria = criteriaNum;
	displayStandings();
}

function _createPlayers(tournaments) {
	var playersMap = {};
	for (let j = 0; j < tournaments.length; j++) {
		const tournament = tournaments[j];
		if (tournament.ignoreInStandings) {
			continue;
		}
		
		for (let k = 0; k < tournament.players.length; k++) {
			const player = tournament.players[k];
			const playerName = player.name.trim();
			var wins = 0;
			var losses = 0;
			var ties = 0;
			
			var playerOfRecord = player.teamCaptain == null
				? player
				: player.teamCaptain;
			
			for (let l = 0; l < playerOfRecord.heroscapeGamePlayers.length; l++) {
				const gamePlayer = playerOfRecord.heroscapeGamePlayers[l];
				
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
			
			if (playersMap[playerName] !== undefined) {
				playersMap[playerName].wins += wins;
				playersMap[playerName].losses += losses;
				playersMap[playerName].ties += ties;
			} else {
				playersMap[playerName] = {
					player: player,
					wins: wins,
					losses: losses,
					ties: ties
				};
			}
		}
	}
	
	var players = [];
	for (const [key, value] of Object.entries(playersMap)) {
		players.push(value);
	}
	return players;
}

function _sortPlayers(x, y, skipAlphabetical=false) {
	
	if (_displayStandingsSortCriteria !== null) {
		switch (_displayStandingsSortCriteria) {
			case 1: // W
				// Do Nothing
				break;
			case 2: // L
				if (x.losses < y.losses) {
					return -1;
				} else if (x.losses > y.losses) {
					return 1;
				}
				break;
			case 3: // W%
				const xWp = x.wins / (x.wins + x.losses);
				const yWp = y.wins / (y.wins + y.losses);
				if (xWp < yWp) {
					return 1;
				} else if (xWp > yWp) {
					return -1;
				}
				break;
			case 4: // SoS
				const xSoS = x.player.user != null	
					? x.player.user.strengthOfSchedule(_sortPlayersTournaments)
					: x.player.strengthOfSchedule();
				const ySoS = y.player.user != null
					? y.player.user.strengthOfSchedule(_sortPlayersTournaments)
					: y.player.strengthOfSchedule();
				if (xSoS < ySoS) {
					return 1;
				} else if (xSoS > ySoS) {
					return -1;
				}		
				break;
			case 5: // Name
				if (x.player.name < y.player.name) {
					return -1;
				} else if (x.player.name > y.player.name) {
					return 1;
				}
				break;
			case 6: // T
				if (x.ties < y.ties) {
					return 1;
				} else if (x.ties > y.ties) {
					return -1;
				}
				break;
		}		
	}
	
	// Criteria 1: Most Wins
	if (x.wins < y.wins) {
		return 1;
	} else if (x.wins > y.wins) {
		return -1;
	}
	
	// Criteria 2: Fewest Losses
	if (x.losses < y.losses) {
		return -1;
	} else if (x.losses > y.losses) {
		return 1;
	}
	
	// Criteria 3: SoS
	const xSoS = x.player.user != null	
		? x.player.user.strengthOfSchedule(_sortPlayersTournaments)
		: x.player.strengthOfSchedule();
	const ySoS = y.player.user != null
		? y.player.user.strengthOfSchedule(_sortPlayersTournaments)
		: y.player.strengthOfSchedule();
	if (xSoS < ySoS) {
		return 1;
	} else if (xSoS > ySoS) {
		return -1;
	}		
	
	if (skipAlphabetical) {
		return 0;
	}
	
	// Criteria 4: Alphabetical
	if (x.player.name < y.player.name) {
		return -1;
	} else if (x.player.name > y.player.name) {
		return 1;
	}
	
	// Criteria 5: Punt
	return 0;
}

