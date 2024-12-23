// Imports
const fs = require('fs');
const ini = require('ini');
const path = require('path');
const mysql = require('mysql');
const cookie = require("cookie");
const app = require('express')();
const http = require('http').createServer(app);
const readline = require('readline');
//const fetch = require('node-fetch');
const fetch = (...args) => import('node-fetch').then(({default: fetch}) => fetch(...args));
const FormData = require('form-data');
const {GoogleAuth} = require('google-auth-library');
const {google} = require('googleapis');
const AWS = require('aws-sdk');
const {exec} = require('child_process');
const io = require('socket.io')(http, 
	{path: '/connect/socket.io',
		cors: {
			origin: "http://localhost:3000/connect",
			methods: ["GET", "POST"],
			credentials: true,
			transports: ['websocket', 'polling']
        },
		transports: ['websocket', 'polling'],
		pingInterval: 1000,
		allowEIO3: true});

// Constants
const port = 3000;
const SCOPES = ['https://www.googleapis.com/auth/spreadsheets',
	'https://www.googleapis.com/auth/drive'];
const TOKEN_PATH = 'token.json';

AWS.config.update({region: 'us-east-1'});

/**
 * Create an OAuth2 client with the given credentials, and then execute the
 * given callback function.
 * @param {Object} credentials The authorization client credentials.
 * @param {function} callback The callback to call with the authorized client.
 */
function authorize(callback) {
	fs.readFile('/var/www/secureFiles/google/credentials.json', (err, content) => {
		if (err) {
			return;
		}
		const credentials = JSON.parse(content);
		const {client_secret, client_id, redirect_uris} = credentials.web;
		const oAuth2Client = new google.auth.OAuth2(client_id, client_secret, redirect_uris[0]);

		// Check if we have previously stored a token.
		fs.readFile(TOKEN_PATH, (err, token) => {
			if (err) {
				return getNewToken(oAuth2Client, callback);
			} 
			oAuth2Client.setCredentials(JSON.parse(token));
			callback(oAuth2Client);
		});
	});
}
/**
 * Get and store new token after prompting for user authorization, and then
 * execute the given callback with the authorized OAuth2 client.
 * @param {google.auth.OAuth2} oAuth2Client The OAuth2 client to get token for.
 * @param {getEventsCallback} callback The callback for the authorized client.
 */
function getNewToken(oAuth2Client, callback) {
	const authUrl = oAuth2Client.generateAuthUrl({
		access_type: 'offline',
		scope: SCOPES,
	});
	console.log('Authorize this app by visiting this url:', authUrl);
	const rl = readline.createInterface({
		input: process.stdin,
		output: process.stdout,
	});
	rl.question('Enter the authorization code from that page here: ', (code) => {
		rl.close();
		oAuth2Client.getToken(code, (err, token) => {
			if (err) {
				return console.error('Error while trying to retrieve access token', err);
			}
			oAuth2Client.setCredentials(token);
			// Store the token to disk for later program executions
			fs.writeFile(TOKEN_PATH, JSON.stringify(token), (err) => {
				if (err) return console.error(err);
				console.log('Token stored to', TOKEN_PATH);
			});
			callback(oAuth2Client);
		});
	});
}

async function createMap(fileId, gameName, players, callback) {
	authorize(function(auth) {
		return _createMap(auth, fileId, gameName, players, callback);
	});
}
async function _createMap(auth, fileId, gameName, players, callback) {
	const sheetService = google.sheets({version: 'v4', auth});
	const driveService = google.drive({version: 'v3', auth});
	driveService.files.copy({
		fileId: fileId,
		requestBody: {
			parents: ["1ROpJ_Fuf0MaLCpiopPZdEnQNd6kuG18q"],
			name: gameName
		}
	}, (err, result) => {
		if (err) {
			return;
		}
		
		//var forTournament = false; // TODO : get this from input params somehow...
				
		/*if (players != null) {
			driveService.permissions.create({
				fileId: result.data.id,
				fields: "id",
				resource: {
					role: "reader",
					type: "anyone"
				}
			});
			for (let i = 0; i < players.length; i++) {
				if (players[i].email == null) {
					continue;
				}
				driveService.permissions.create({
					fileId: result.data.id,
					fields: "id",
					resource: {
						role: "writer",
						type: "user",
						emailAddress: players[i].email 
					}
				});
			}*/
		//} else { // players == null 
			driveService.permissions.create({
				fileId: result.data.id,
				fields: "id",
				resource: {
					role: "writer",
					type: "anyone"
				}
			});
		//}
		
		callback(result.data);
	});
}
async function createSheet(tournament, callback) {
	authorize(function(auth) {
		return _createSheet(auth, tournament, callback);
	});
}
async function _createSheet(auth, tournament, callback) {
	const sheetService = google.sheets({version: 'v4', auth});
	const driveService = google.drive({version: 'v3', auth});
	const resource = {
		properties: {
			title: tournament.name,
		},
	};
	try {
		const spreadsheet = await sheetService.spreadsheets.create({
			resource,
			fields: 'spreadsheetId',
		});
		const fileId = spreadsheet.data.spreadsheetId;
		
		if (callback !== undefined && callback !== null) {
			callback(fileId);
		}
		
		// Make Sheet publicly readable
		const driveRes = await driveService.permissions.create({
			resource: {
				type: "anyone",
				role: "reader"
			},
			fileId: fileId,
			fields: "id",
		});
		
		// Move Sheet to preset folder
		const file = await driveService.files.get({
			fileId: fileId,
			fields: 'parents',
		});
		const previousParents = file.data.parents
			.map(function(parent) {
				return parent.id;
			})
			.join(',');
		const folderId = "1JjVFLVsn4SY93Bhm6PeyJOUKGzqKP-64";
		const files = await driveService.files.update({
			fileId: fileId,
			addParents: folderId,
			removeParents: previousParents,
			fields: 'id, parents',
		});
		
		// Set Individual Sheet Names
		renameSheet(fileId, 0, "Armies", function() {
			writeSheetData(fileId, "Armies", [["Username","Army"]], false, function() {
				addSheet(fileId, "Results", function() {
					var headers = ["Round","Map"];
					for (let i = 0; i < tournament.maxNumPlayersPerGame; i++) {
						headers.push("Player "+(i+1));
						headers.push("Points");
					}
					writeSheetData(fileId, "Results", [headers]);
				});
			});
		});
	} catch (err) {
		throw err;
	}
}
async function writeSheetData(sheetId, sheetName, values, overwrite=false, callback=null) {
	authorize(function(auth) {
		_writeSheetData(auth, sheetId, sheetName, values, overwrite, callback);
	});
}
async function _writeSheetData(auth, sheetId, sheetName, values, overwrite, callback) {
	const sheetService = google.sheets({version: 'v4', auth});
	const resource = {values};
	if (overwrite) {
		sheetService.spreadsheets.values.update({
			spreadsheetId: sheetId,
			range: sheetName+'!A1',
			valueInputOption: 'RAW',
			resource: resource
		}, (err, result) => {
			if (err) {
				return;
			}
			if (callback !== undefined && callback !== null) {
				callback();
			}
		});
	} else {
		sheetService.spreadsheets.values.append({
			spreadsheetId: sheetId,
			range: sheetName+'!A1',
			valueInputOption: 'RAW',
			insertDataOption: 'INSERT_ROWS',
			resource: resource
		}, (err, result) => {
			if (err) {
				return;
			}
			if (callback !== undefined && callback !== null) {
				callback();
			}
		});
	}
}
async function deleteSheetArmy(sheetId, values, callback=null) {
	authorize(function(auth) {
		_deleteSheetArmy(auth, sheetId, values, callback);
	});
}
async function _deleteSheetArmy(auth, sheetId, values, callback=null) {
	const sheetService = google.sheets({version: 'v4', auth});
	sheetService.spreadsheets.values.get({
		spreadsheetId: sheetId,
		range: "Armies!A:B"
	}, (err, result) => {
		if (err) {
			return;
		}
		const rows = result.data.values;
		var rowNum = null;
		if (rows !== undefined && rows !== null) {
			for (let i = 0; i < rows.length; i++) {
				const row = rows[i];
				if (row[0] == values[0]) {
					rowNum = i+1;
					break;
				}
			}
		}
		if (rowNum != null) {
			const resource = {
				"requests": [
					{
						"deleteDimension": {
							"range": {
								"sheetId": 0, // 0 is always the 'first' sheet gid
								"dimension": "ROWS",
								"startIndex": rowNum-1,
								"endIndex": rowNum
							}
						}
					}
				]
			};
			sheetService.spreadsheets.batchUpdate({
				spreadsheetId: sheetId,
				resource: resource
			}, (err, result) => {
				if (err) {
					return;
				} 
			});	
		} 		
	});
}
async function deleteSheetRound(sheetId, roundName, callback=null) {
	authorize(function(auth) {
		_deleteSheetRound(auth, sheetId, roundName, callback);
	});
}
async function _deleteSheetRound(auth, sheetId, roundName, callback=null) {
	const sheetService = google.sheets({version: 'v4', auth});
	
	const request = {
		spreadsheetId: sheetId,
		ranges: 'Results!A1:B1',
		includeGridData: false
	};
	let res = await sheetService.spreadsheets.get(request);

	var gId = null;
	for (i = 0; i < res.data.sheets.length; i++) {
		if (res.data.sheets[i].properties.title === 'Results') {
			gId = res.data.sheets[i].properties.sheetId;
		}
	}
	
	sheetService.spreadsheets.values.get({
		spreadsheetId: sheetId,
		range: "Results!A:B"
	}, (err, result) => {
		if (err) {
			return;
		}
		const rows = result.data.values;
		var startIndex = null;
		if (rows !== undefined && rows !== null) {
			for (let i = 0; i < rows.length; i++) {
				const row = rows[i];
				if (row[0] == roundName) {
					startIndex = i;
					break;
				}
			}
		}
		if (startIndex != null) {
			const resource = {
				"requests": [
					{
						"deleteDimension": {
							"range": {
								"sheetId": gId, 
								"dimension": "ROWS",
								"startIndex": startIndex,
								"endIndex": rows.length
							}
						}
					}
				]
			};
			sheetService.spreadsheets.batchUpdate({
				spreadsheetId: sheetId,
				resource: resource
			}, (err, result) => {
				if (err) {
					return;
				} 
			});	
		} 		
	});
}
async function updateSheetArmy(sheetId, values, callback=null) {
	authorize(function(auth) {
		_updateSheetArmy(auth, sheetId, values, callback);
	});
}
async function _updateSheetArmy(auth, sheetId, values, callback=null) {
	const sheetService = google.sheets({version: 'v4', auth});
	sheetService.spreadsheets.values.get({
		spreadsheetId: sheetId,
		range: "Armies!A:B"
	}, (err, result) => {
		if (err) {
			return;
		}
		const rows = result.data.values;
		var rowNum = null;
		if (rows !== undefined && rows !== null) {
			for (let i = 0; i < rows.length; i++) {
				const row = rows[i];
				if (row[0] == values[0]) {
					rowNum = i+1;
					break;
				}
			}
		}
		if (rowNum != null) {
			const resource = {
				values : [values]
			};
			sheetService.spreadsheets.values.update({
				spreadsheetId: sheetId,
				range: "Armies!A"+rowNum+":Z"+rowNum,
				valueInputOption: "RAW",
				resource: resource
			}, (err, result) => {
				if (err) {
					return;
				} 
			});	
		} else {
			writeSheetData(sheetId, "Armies", [values]);
		}			
	});
}
async function updateSheetGameResult(sheetId, values, callback=null) {
	authorize(function(auth) {
		_updateSheetGameResult(auth, sheetId, values, callback);
	});
}
async function _updateSheetGameResult(auth, sheetId, values, callback) {
	const sheetService = google.sheets({version: 'v4', auth});
	sheetService.spreadsheets.values.get({
		spreadsheetId: sheetId,
		range: "Results!A:Z"
	}, (err, result) => {
		if (err) {
			return;
		}
		const rows = result.data.values;
		var rowNum = null;
		if (rows !== undefined && rows !== null) {
			for (let i = 0; i < rows.length; i++) {
				const row = rows[i];
				if (row[0] == values[0] && row[1] == values[1]) {
					rowNum = i+1;
					break;
				}
			}
		}
		if (rowNum != null) {
			const resource = {
				values : [values]
			};
			sheetService.spreadsheets.values.update({
				spreadsheetId: sheetId,
				range: "Results!A"+rowNum+":Z"+rowNum,
				valueInputOption: "RAW",
				resource: resource
			}, (err, result) => {
				if (err) {
					return;
				} 
			});		
		}
	});
}
async function renameSheet(spreadsheetId, sheetId, newName, callback) {
	authorize(function(auth) {
		_renameSheet(auth, spreadsheetId, sheetId, newName, callback);
	});
}
async function _renameSheet(auth, spreadsheetId, sheetId, newName, callback) {
	const sheetService = google.sheets({version: 'v4', auth});
	const request = {
		requests: [
			{
				updateSheetProperties: {
					properties: {
						sheetId: sheetId,
						title: newName
					},
					fields: 'title'
				}
			}
		]
	}
	sheetService.spreadsheets.batchUpdate({
		spreadsheetId: spreadsheetId,
		requestBody: request,
		auth
	}, function(err, response) {
		if (err) {
			return;
		} 
		if (callback !== undefined && callback !== null) {
			callback();
		}
	});
}
async function addSheet(spreadsheetId, newName, callback) {
	authorize(function(auth) {
		_addSheet(auth, spreadsheetId, newName, callback);
	});
}
async function _addSheet(auth, spreadsheetId, newName, callback) {
	const sheetService = google.sheets({version: 'v4', auth});
	const request = {
		requests: [
			{
				addSheet: {
					properties: {
						title: newName
					}
				}
			}
		]
	}
	sheetService.spreadsheets.batchUpdate({
		spreadsheetId: spreadsheetId,
		requestBody: request,
		auth
	}, function(err, response) {
		if (err) {
			return;
		} 
		if (callback !== undefined && callback !== null) {
			callback();
		}
	});
}

app.get('/connect', function (req, res) {
	res.sendFile(__dirname + '/index.html')
});

// Establish Pool of Database Connections
const dbConnectionFile = "/var/www/secureFiles/dbms/config.ini";
const dbConfig = ini.parse(fs.readFileSync(dbConnectionFile, 'utf-8')).database;
const dbConnection = mysql.createPool({
	connectionLimit	: 10,
	host: 		dbConfig.host,
	user: 		dbConfig.username,
	password: 	dbConfig.password,
	database:	dbConfig.name
});

var roundTimeIntervals = [];
var playerClockTimeIntervals = [];

io.on('connection', (socket) => {
	// Variable Declarations
	var isAdmin = false;
	var currentTournament = null;
	var currentConvention = null;
	var currentSeason = null;
	var currentLeague = null;
	var loginCookie = null;
	var user = null;
	var sheetId = null;
	
	//logToFile('connected | SocketID : ' + socket.id);
	
	socket.on('createOhsGame', (objStr) => {
		var inputObj = JSON.parse(objStr);
		
		const gameName = inputObj.gameName.length > 0
			? inputObj.gameName
			: "Unnamed Game";
		
		const mapGdocId = inputObj.mapGdocId;
		
		createGameLink(gameName, mapGdocId, null, null);		
	});
	
	function createGameLink(gameName, mapGdocId, players=null, callbackFcn=null) {
		const loginUrl = "https://www.heroscapers.com/ohs/index.php";	
		
		createMap(mapGdocId, gameName, players, function(resultData) {
			const gDocId = resultData.id;
			
			const form = new FormData();
			form.append('name', 'Heroscape.org');
			form.append('game', '');
			form.append('gdoc', gDocId);
			form.append('enter', 'Enter');
			
			var loginOpt = {
				method: "POST",
				timeout: 10 * 1000, // 10 Seconds
				body: form
			};
			
			_createGameLink(loginUrl, loginOpt, function(gameId) {
				if (gameId != null) {
					const finalUrl = 
						"https://www.heroscapers.com/ohs/index.php?log="+gameId+"&gdoc="+gDocId;
					
					if (callbackFcn !== undefined && callbackFcn !== null) {
						callbackFcn(finalUrl);
					} else {
						socket.emit("ohsGameCreated", JSON.stringify({
							gameUrl: finalUrl
						}));
					}
				} else {
					if (callbackFcn !== undefined && callbackFcn !== null) {
						callbackFcn(null);
					} else {
						socket.emit("ohsGameCreationError", JSON.stringify({msg: "Unknown Error"}));
					}
				}
			});
		});	
	}
	
	async function _createGameLink(loginUrl, loginOpt, callbackFcn) {
		try {
			var response = await fetch(loginUrl, loginOpt);
			
			/*for(const header of response.headers){
			   console.log(header);
			}*/
			// TODO - I might need 'set-cookie', 'sec_session_id' later if I want to re-enter game to post anything...
			
			var data = await response.text();
			
			data = data.substr(data.indexOf('url') + 6); // Offset by 'url: "'
			data = data.substr(0, data.indexOf(',')-1).trim();
			
			callbackFcn(data);
		} catch (err) {
			callbackFcn(null);
		}
	}
	
	/** Admin Entry Points **/
	
	socket.on('loadSiteAdmin', (objStr) => {
		
		// TODO 
		
	});
	
	socket.on('requestNumberOfOpenSockets', (objStr) => {
		//console.log("hi-yo");
		logToFile(io.of("/").sockets);
		socket.emit('numberOfOpenSockets', JSON.stringify({
			numberOfOpenSockets: io.of("/").sockets.size
		}));
	});
	
	socket.on('requestAvailableDiskSpace', (objStr) => {
		var dir = "/dev/xvda1";
		var cmd = "df -h --output=pcent " + dir;
  
		exec(cmd, function(err, data) {
			if (err) {
				// TODO 
			} else {
				socket.emit("availableDiskSpace", JSON.stringify(data));
			}
		});
		
	});
	
	
	
	/** Convention Entry Points **/	
	
	socket.on('loadConvention', (objStr) => {
		var obj = JSON.parse(objStr);
		currentConvention = obj.convention;
		checkLoginAndSetAdmin(1, function() {
			socket.join("Convention_"+currentConvention.id);			
		});
	});
		
	socket.on('signupConvention', (objStr) => {
		var obj = JSON.parse(objStr);
		var convention = obj.convention;
		const signupKey = obj.signupKey;
		
		if (loginCookie != null) {
			dbConnection.query(
					"SELECT `User`.`id`, `User`.`userName` FROM `User` " +
						"INNER JOIN `LoginCredentials` ON `LoginCredentials`.`userID` = `User`.`id` " +
						"WHERE `cookie`=?",
					[loginCookie],
					(error, results, fields) => {
				if (error) {
					socket.emit("signupConventionError", JSON.stringify({}));
					return;
				}
				const user = results[0];
				
				dbConnection.query(
						"SELECT * FROM `Convention` WHERE `id`=?",
						[convention.id],
						(error, results, fields) => {
					if (error) {
						socket.emit("signupConventionError", JSON.stringify({}));
						return;
					}
					convention = results[0];
					
					if (convention.signupKey != null && convention.signupKey != signupKey) {
						socket.emit("invalidSignupKey", JSON.stringify({}));
						return;
					}
					dbConnection.query(
							"SELECT * FROM `Attendee` WHERE `conventionID`=?",
							[convention.id],
							(error, results, fields) => {
						if (error) {
							socket.emit("signupConventionError", JSON.stringify({}));
							return;
						}
						if (convention.maxAttendees != null && convention.maxAttendees <= results.length) {
							socket.emit("conventionFull", JSON.stringify({}));
							return;
						} 
						
						for (let i = 0; i < results.length; i++) {
							if (user.id == results[i].userID) {
								socket.emit("alreadySignedUpForConvention", JSON.stringify({}));
								return;
							}
						}
						
						dbConnection.query(
								"INSERT INTO `Attendee` " + 
									"(`userID`,`conventionID`,`signupTime`) VALUES (?,?,?)",
								[user.id, convention.id, new Date().toISOString()],
								(error, results, fields) => {
							if (error) {
								socket.emit("signupConventionError", JSON.stringify({}));
								return;
							}
							
							io.to("Convention_"+convention.id)
								.emit("signedUpConvention", JSON.stringify({
									attendee: {
										id: results.insertId,
										user: user,
										convention: convention
									}
								}));
						});
					}); 
				});
			});			
		} else {
			socket.emit("notLoggedIn", JSON.stringify({}));
		}		
	});
	
	socket.on('deRegisterConvention', (objStr) => {
		var obj = JSON.parse(objStr);
		var convention = obj.convention;
		
		if (loginCookie != null) {
			dbConnection.query(
					"SELECT `User`.`id`, `User`.`userName` FROM `User` " +
						"INNER JOIN `LoginCredentials` ON `LoginCredentials`.`userID` = `User`.`id` " +
						"WHERE `cookie`=?",
					[loginCookie],
					(error, results, fields) => {
				if (error) {
					socket.emit("deRegisterConventionError", JSON.stringify({}));
					return;
				}
				const user = results[0];
				
				dbConnection.query(
						"SELECT * FROM `Convention` WHERE `id`=?",
						[convention.id],
						(error, results, fields) => {
					if (error) {
						socket.emit("deRegisterConventionError", JSON.stringify({}));
						return;
					}
					convention = results[0];
					
					dbConnection.query(
							"DELETE FROM `Attendee` WHERE `conventionID`=? AND `userID`=?",
							[convention.id, user.id],
							(error, results, fields) => {
						if (error) {
							socket.emit("deRegisterConventionError", JSON.stringify({}));
							return;
						}
						
						io.to("Convention_"+convention.id)
							.emit("deRegisteredConvention", JSON.stringify({}));
					});
				});
			});			
		} else {
			socket.emit("notLoggedIn", JSON.stringify({}));
		}		
		
	});
	
	socket.on('dropUserFromConvention', (objStr) => {
		var obj = JSON.parse(objStr);
		var user = obj.user;
		
		if (isAdmin && currentConvention != null) {
			dbConnection.query(
					"DELETE FROM `Attendee` WHERE `conventionID`=? AND `userID`=?",
					[currentConvention.id, user.id],
					(error, results, fields) => {
				if (error) {
					socket.emit("announcementError", JSON.stringify({}));
					return;
				}			
				var emails = [];
				for (let i = 0; i < results.length; i++) {
					emails.push(results[i].email);
				}
				io.to("Convention_"+currentConvention.id)
					.emit("userDropped", JSON.stringify({user: {id: user.id}}));
			});	
		}
	});
	
	socket.on('conventionAnnouncement', (objStr) => {
		var obj = JSON.parse(objStr);
		const convention = obj.convention;
		const announcement = obj.announcement;
		if (isAdmin && currentConvention != null && 
				convention !== undefined && convention !== null &&
				convention.id !== undefined && convention.id !== null &&
				currentConvention.id == convention.id) {
			dbConnection.query(
					"SELECT `User`.`email` FROM `Attendee` " +
						"INNER JOIN `User` ON `User`.`id` = `Attendee`.`userID` " +
						"WHERE `conventionID`=?",
					[currentConvention.id],
					(error, results, fields) => {
				if (error) {
					socket.emit("announcementError", JSON.stringify({}));
					return;
				}			
				var emails = [];
				for (let i = 0; i < results.length; i++) {
					emails.push(results[i].email);
				}
				sendAnnouncement(announcement, convention.name, emails);
			});		
		}
	});
	
	/** League / Season Entry Points **/
	
	socket.on('loadLeague', (objStr) => {
		var obj = JSON.parse(objStr);
		currentLeague = obj.league;
		checkLoginAndSetAdmin(3, function() {
			socket.join("League_"+currentLeague.id);			
		});
	});
	
	socket.on('loadSeason', (objStr) => {
		var obj = JSON.parse(objStr);
		currentSeason = obj.season;
		checkLoginAndSetAdmin(4, function() {
			socket.join("Season_"+currentSeason.id);			
		});
	});
	
	socket.on('seasonAnnouncement', (objStr) => {
		var obj = JSON.parse(objStr);
		const season = obj.season;
		const announcement = obj.announcement;
		if (isAdmin && currentSeason !== null && currentSeason !== undefined && 
				season !== null && season !== undefined &&
				currentSeason.id !== null && currentSeason.id !== undefined && 
				currentSeason.id == season.id) {
			dbConnection.query(
					"SELECT DISTINCT `User`.`email` FROM `User` " +
						"INNER JOIN `Player` ON `Player`.`userID` = `User`.`id` " +
						"INNER JOIN `Tournament` ON `Player`.`tournamentID` = `Tournament`.`id` " +
						"INNER JOIN `TournamentSeasonLink` ON `TournamentSeasonLink`.`tournamentID` = `Tournament`.`id` " +
						"INNER JOIN `Season` ON `Season`.`id` = `TournamentSeasonLink`.`seasonID` " +
						"WHERE `Season`.`id` = ?",
					[season.id],
					(error, results, fields) => {
				if (error) {
					socket.emit("announcementError", JSON.stringify({}));
					return;
				}
				var emails = [];
				for (let i = 0; i < results.length; i++) {
					emails.push(results[i].email);
				}
				sendAnnouncement(announcement, season.league.name + " " + season.name, emails); 
			});
		}
	});
	
	socket.on('leagueAnnouncement', (objStr) => {
		var obj = JSON.parse(objStr);
		const league = obj.league;
		const announcement = obj.announcement;
		if (isAdmin && currentLeague !== null && currentLeague !== undefined && 
				league !== null && league !== undefined &&
				currentLeague.id !== null && currentLeague.id !== undefined && 
				currentLeague.id == league.id) {
			dbConnection.query(
					"SELECT DISTINCT `User`.`email` FROM `User` " +
						"INNER JOIN `Player` ON `Player`.`userID` = `User`.`id` " +
						"INNER JOIN `Tournament` ON `Player`.`tournamentID` = `Tournament`.`id` " +
						"INNER JOIN `TournamentSeasonLink` ON `TournamentSeasonLink`.`tournamentID` = `Tournament`.`id` " +
						"INNER JOIN `Season` ON `Season`.`id` = `TournamentSeasonLink`.`seasonID` " +
						"INNER JOIN `League` ON `League`.`id` = `Season`.`leagueID` " +
						"WHERE `League`.`id` = ?",
					[league.id],
					(error, results, fields) => {
				if (error) {
					socket.emit("announcementError", JSON.stringify({}));
					return;
				}
				var emails = [];
				for (let i = 0; i < results.length; i++) {
					emails.push(results[i].email);
				}
				sendAnnouncement(announcement, league.name, emails); 
			});
		}
	});
		
	/** Tournament Entry Points **/	
	
	socket.on('createSheet', (objStr) => {
		var obj = JSON.parse(objStr);
		createSheet(obj.tournament, function(sheetId) {
			dbConnection.query(
					"UPDATE `Tournament` SET `sheetId` = ? WHERE (`id` = ?);",
					[sheetId, obj.tournament.id],
					(error, results, fields) => {
				if (error) {
					socket.emit("sheetCreationError", JSON.stringify({}));
				} 
				socket.emit("sheetCreated", 
					JSON.stringify({
						tournament: obj.tournament, 
						sheetId: sheetId}));
			});
		});		
	});
	
	socket.on('loadTournament', (objStr, respond) => {
		//logToFile('loadTournament() | SocketID : ' + socket.id);
		var obj = JSON.parse(objStr);
		currentTournament = obj.tournament;
		/*logToFile("  currentTournament=" + JSON.stringify(currentTournament) + 
			" | SocketID : " + socket.id);*/
		socket.join("Tournament_"+currentTournament.id);	
		checkLoginAndSetAdmin(2, function() {
			//logToFile("  loadTournament()-inAdmin | SocketID : " + socket.id);			
			
			respond(null, 'Success');
			
			dbConnection.query(
					"SELECT * FROM `Tournament` " +
						"LEFT JOIN `HeroscapeTournament` ON `HeroscapeTournament`.`tournamentID` = `Tournament`.`id` " + 
						"WHERE `id`=?",
					[currentTournament.id],
					(error, results, fields) => {
				if (error) {
					return;
				}
				if (results.length != 1) {
					return;
				}
				currentTournament = results[0];
				sheetId = currentTournament.sheetId;
				if (currentTournament.bracketID != null) {
					dbConnection.query(
							"SELECT `Bracket`.`reSeedEachRound`, `Bracket`.`size`, " +
								"`BracketEntry`.`id` AS `bracketEntryID`, `BracketEntry`.`bracketID`, " +
								"`BracketEntry`.`playerID`, `BracketEntry`.`seed`, `BracketEntry`.`eliminated` " +
							"FROM `Bracket` " +
								"LEFT JOIN `BracketEntry` ON `BracketEntry`.`bracketID` = `Bracket`.`id` " +
								"WHERE `bracketID`=?",
							[currentTournament.bracketID],
							(error, results, fields) => {
						if (error) {
							return;
						}
						if (results.length == 0) {
							return;
						}
						currentTournament.bracket = {
							id: results[0].bracketID,
							reSeedEachRound: results[0].reSeedEachRound,
							size: results[0].size,
							bracketEntrys: []
						};		
						for (let i = 0; i < results.length; i++) {
							const result = results[i];
							currentTournament.bracket.bracketEntrys.push({
								id: result.bracketEntryID,
								bracketID: result.bracketID,
								playerID: result.playerID,
								seed: result.seed,
								eliminated: result.eliminated
							});
						}
					});
				}
				if (currentTournament.conventionID != null) {
					dbConnection.query(
							"SELECT * FROM `Convention` WHERE `id`=?",
							[currentTournament.conventionID],
							(error, results, fields) => {
						if (error) {
							return;
						}
						if (results.length == 0) {
							return;
						}
						currentTournament.convention = {
							id: results[0].id,
							name: results[0].name
						};
					});
				}
			});
		});
	});
	
	socket.on('signupTournament', (objStr) => {
		var obj = JSON.parse(objStr);
		var tournament = obj.tournament;
		
		// TODO - check if player can signup or not (via tournament start time)
		/*currentTournament.allowLateSignup + currentTournament.startTime*/
		
		var teamCaptainID = null;
		if (currentTournament.teamSize > 1 && obj.teamCaptain != undefined) {
			teamCaptainID = obj.teamCaptain.id;
			if (teamCaptainID == "-1") {
				teamCaptainID = null;
			}
			
			// TODO : Verify that team isn't already full ... 
		}
		
		if (loginCookie != null) {		
			dbConnection.query(
					"SELECT `User`.`id`, `User`.`userName`, `User`.`verificationKey` FROM `User` " +
						"INNER JOIN `LoginCredentials` ON `LoginCredentials`.`userID` = `User`.`id` " +
						"WHERE `cookie`=?",
					[loginCookie],
					(error, results, fields) => {
				if (error) {
					socket.emit("cannotSignup", JSON.stringify({msg: "Unknown error"}));
					return;
				}
				const user = results[0];
				
				if (user.verificationKey != null) {
					socket.emit("cannotSignup", JSON.stringify({msg: 
						"You must verify your email address before you can signup for tournaments. " +
						"If you do not see an email from Heroscape.org, check your spam folder."}));
					return;
				}
				
				// TODO - check that tournament is not yet full 
				// currentTournament.maxEntries
				
				dbConnection.query(
						"SELECT * FROM `Player` WHERE `tournamentID`=?",
						[tournament.id],
						(error, results, fields) => {
					if (error) {
						socket.emit("cannotSignup", JSON.stringify({msg: "Unknown error"}));
						return;
					}
					if (currentTournament.maxEntries != null && 
							results.length >= currentTournament.maxEntries) {
						socket.emit("cannotSignup", JSON.stringify({msg: "Cannot signup: The tournament is already full."}));
						return;
					}
					if (currentTournament.convention !== undefined && currentTournament.convention !== null) {
						dbConnection.query(
								"SELECT * FROM `Attendee` WHERE `userID`=? AND `conventionID`=?",
								[user.id, currentTournament.convention.id],
								(error, results, fields) => {
							if (error) {
								socket.emit("cannotSignup", JSON.stringify({msg: "Unknown error"}));
								return;
							}
							if (results.length == 0) {
								socket.emit("cannotSignup", JSON.stringify({msg: "Cannot signup: You are not signed up for the convention."}));
								return;
							}
							_signUserUpForTournament(user, tournament, teamCaptainID, sheetId);
						});					
					} else {
						_signUserUpForTournament(user, tournament, teamCaptainID, sheetId);
					}
				});
			});
		}
	});
	
	function _signUserUpForTournament(user, tournament, teamCaptainID, sheetId) {
		dbConnection.query(
				"INSERT INTO `Player` (`name`,`userID`,`teamCaptainID`,`tournamentID`,`active`) VALUES (?,?,?,?,?)",
				[user.userName, user.id, teamCaptainID, tournament.id, true],
				(error, results, fields) => {
			if (error) {
				socket.emit("cannotSignup", JSON.stringify({msg: "Unknown error"}));
				return;
			}
			
			updateSheetArmy(sheetId, [user.userName]);
			
			var player = {
				id: results.insertId,
				user: user,
				name: user.userName,
				tournament: tournament,
				active: true
			};
			if (teamCaptainID != null) {
				player.teamCaptain = {
					id: teamCaptainID
				};
			}
			
			io.to("Tournament_"+currentTournament.id)
				.emit("signedUp", JSON.stringify({player: player}));
		});
	}
	
	socket.on('submitArmy', (objStr) => {
		var obj = JSON.parse(objStr);
		
		dbConnection.query(
				"SELECT * FROM `Tournament` WHERE `id`=?",
				[obj.tournament.id],
				(error, results, fields) => {
			if (error) {
				// TODO 
				return;
			} 
			if (results.length != 1) {
				// TODO 
				return;
			} 		
			const sheetId = results[0].sheetId;
			
			dbConnection.query(
					"SELECT * FROM `User` " +
						"INNER JOIN `Player` ON `User`.id=`Player`.`userID` " +
						"WHERE `Player`.`id`=?",
					[obj.player.id],
					(error, results, fields) => {
				if (error) {
					// TODO 
					return;
				} 
				if (results.length != 1) {
					// TODO 
					return;
				} 		
				
				const userName = results[0].userName;
				var values = [userName];
				for (let i = 0; i < obj.player.armies.length; i++) {
					values.push(obj.player.armies[i]);
				}			
				updateSheetArmy(sheetId, values);
			});
		});		
	});
	
	socket.on('deletePlayerArmyCards', (objStr) => {
		var obj = JSON.parse(objStr);
		var playerArmyIds = obj.playerArmyIds;
		for (let i = 0; i < playerArmyIds.length; i++) {
			const playerArmyId = playerArmyIds[i];
			dbConnection.query(
					"DELETE FROM `PlayerArmyCard` WHERE `playerArmyID`=?",
					[playerArmyId],
					(error, results, fields) => {
				if (error) {
					// TODO
					return;
				}
			});
		}
	});

	socket.on('createNonUserPlayer', (objStr) => {
		if ( ! isAdmin) {
			return;
		}
		var obj = JSON.parse(objStr);
		var player = obj.player;
				
		dbConnection.query(
				"INSERT INTO `Player` (`name`,`tournamentID`,`active`) VALUES (?,?,?)",
				[player.name, currentTournament.id, true],
				(error, results, fields) => {
			if (error) {
				socket.emit("createNonUserPlayerError", JSON.stringify({msg: "Unknown error"}));
				return;
			}
			player.id = results.insertId;
			_createNonUserPlayerArmy(player, 0);
			
			// Add to Sheet
			var values = [player.name];
			for (let i = 0; i < player.armies.length; i++) {
				values.push(player.armies[i].army);
			}
			updateSheetArmy(sheetId, values);
		});		
	});
	
	socket.on('deRegisterTournament', (objStr) => {
		var obj = JSON.parse(objStr);
		const tournament = obj.tournament;
				
		if (loginCookie != null) {			
		
			dbConnection.query(
					"SELECT * FROM `Tournament` WHERE `id`=?",
					[tournament.id],
					(error, results, fields) => {
				if (error) {
					// TODO 
					return;
				} 
				if (results.length != 1) {
					// TODO 
					return;
				} 		
				const sheetId = results[0].sheetId;
		
				dbConnection.query(
						"SELECT `User`.`id`, `User`.`userName` FROM `User` " +
							"INNER JOIN `LoginCredentials` ON `LoginCredentials`.`userID` = `User`.`id` " +
							"WHERE `cookie`=?",
						[loginCookie],
						(error, results, fields) => {
					if (error) {
						// TODO
						return;
					}
					const user = results[0];
					
					dbConnection.query(
							"SELECT * FROM `Player` WHERE `userID`=? AND `tournamentID`=?",
							[user.id, tournament.id],
							(error, results, fields) => {
						if (error) {
							// TODO
							return;
						}
						if (results.length == 0) {
							// TODO
							return;
						}
						
						const player = results[0];
						
						dbConnection.query(
								"DELETE FROM `PlayerArmy` WHERE `playerID`=?",
								[player.id],
								(error, results, fields) => {
							if (error) {
								// TODO
								return;
							}
							
							dbConnection.query(
									"DELETE FROM `Player` WHERE `id`=?",
									[player.id],
									(error, results, fields) => {
								if (error) {
									// TODO
									return;
								}
							});
							
							deleteSheetArmy(sheetId, [user.userName]);
							
							io.to("Tournament_"+currentTournament.id)
								.emit("withdrawn", JSON.stringify({player: player}));
						});
					});
				});
			});
		}
	});
	
	socket.on('pairNextRound', (objStr) => {
		var obj = JSON.parse(objStr);
		var tournament = obj.tournament;
		if ( ! isAdmin) {
			return;
		}
		
		stopClock();
		
		_loadPlayers(tournament, function(players) {
			_rankPlayers(players, tournament, function(players, standings, gameData) {
				_checkArmiesSubmitted(tournament, players, function() {
					_loadMaps(tournament, function(maps) {
						maps = shuffle(maps);
						var streamingMaps = [];
						for (let i = 0; i < maps.length; i++) {
							if (maps[i].forStreaming) {
								streamingMaps.push(maps[i]);
								maps.splice(i, 1);
								i--;
							}
						}
						
						const maxPlayersPerMatchup = tournament.maxNumPlayersPerGame;
						
						// Bracket Case
						if (currentTournament.bracket !== undefined && 
								currentTournament.bracket !== null) {
							dbConnection.query(
									"SELECT * FROM `BracketEntry` " +
										"WHERE `bracketID`=? AND `eliminated`=0 " +
										"ORDER BY `seed` ASC",
									[currentTournament.bracket.id],
									(error, results, fields) => {
								if (error) {
									// TODO
									return;
								}
								var bracketEntries = results;
								
								var numMapsNeeded = bracketEntries.length % 2 == 0
									? bracketEntries.length / 2
									: (bracketEntries.length - 1) / 2;
								if (numMapsNeeded > maps.length + streamingMaps.length) {
									socket.emit("notEnoughMaps", JSON.stringify({}));
									return;
								}
								
								var roundSize = bracketEntries.length;
								if ( ! powerOfTwo(roundSize)) {
									var n = 1;
									var expandedRoundSize = Math.pow(2,n);
									while (expandedRoundSize < roundSize) {
										var expandedRoundSize = Math.pow(2,n++);
									}
									roundSize = expandedRoundSize;
								}
								_createRound("Round of "+roundSize, function(round) {
									var matchups = [];
									if (currentTournament.bracket.reSeedEachRound) {
										if (maxPlayersPerMatchup > 2) {
											// TODO - handle multiplayer case 
										} else {
											var numByesToAssign = roundSize - bracketEntries.length;
											while (numByesToAssign > 0) {
												var bracketEntry = bracketEntries.shift();
												var player = _findPlayerFromBracketEntry(bracketEntry, standings);;
												matchups.push([player]);
												numByesToAssign--;
											}
											while (bracketEntries.length > 0) {
												var bracketEntry1 = bracketEntries.shift();
												var bracketEntry2 = bracketEntries.pop();
												var player1 = _findPlayerFromBracketEntry(bracketEntry1, standings);
												var player2 = _findPlayerFromBracketEntry(bracketEntry2, standings);
												matchups.push([player1, player2]);
											}
										}
									} else {
										if (maxPlayersPerMatchup > 2) {
											// TODO - handle multiplayer case 
										} else {
											//const roundSize = bracketEntries.length;
											while (bracketEntries.length > 0) {
												var bracketEntry1 = bracketEntries.shift();
												var bracketEntry2 = null;
												var validOpponentSeeds = 
													_findValidOpponentSeeds(
														bracketEntry1.seed, 
														roundSize,
														currentTournament.bracket.size);
												for (let i = 0; i < bracketEntries.length; i++) {
													if (validOpponentSeeds.includes(bracketEntries[i].seed)) {
														bracketEntry2 = bracketEntries[i];
														bracketEntries.splice(i, 1);
														break;
													}
												}
												var player1 = _findPlayerFromBracketEntry(bracketEntry1, standings);
												if (bracketEntry2 == null) {
													matchups.push([player1]);
												} else {
													var player2 = _findPlayerFromBracketEntry(bracketEntry2, standings);
													matchups.push([player1, player2]);
												}
											}
										}
									}
									_createGames(round, matchups, maxPlayersPerMatchup, maps, streamingMaps, gameData);
									
									socket.emit("nextRoundPaired", JSON.stringify({round: round}));
								});
							});
							return;
						}
						
						// Swiss Case (Normal/Default)
						var numMapsNeeded = null;
						if (maxPlayersPerMatchup == 2) {
							numMapsNeeded = players.length % 2 == 0
								? players.length / 2
								: (players.length - 1) / 2;
						} else {
							numMapsNeeded = Math.ceil(players.length / maxPlayersPerMatchup);
						}
						if (numMapsNeeded > maps.length + streamingMaps.length) {
							socket.emit("notEnoughMaps", JSON.stringify({}));
							return;
						}
										
						_createRound(null, function(round) {
							var matchups = [];
							var playerPool = [];
							
							while (standings.length > 0) {
								if (standings[standings.length-1] === undefined) {
									standings.pop();
									continue;
								}
								while (playerPool.length < maxPlayersPerMatchup && standings.length > 0) {
									Array.prototype.push.apply(playerPool, standings.pop());
								}
								// Skipping backgracking for now, ensuring a reasonably timed ending
								playerPool = shuffle(playerPool, true);
								
								if (maxPlayersPerMatchup == 2) { // Skip re-match avoidance for multiplayer
									var attemptsLeft = 100;
									for (let i = 0; i < playerPool.length-1; i+=2) {
										if (rematch(playerPool[i], playerPool[i+1], gameData)) {
											if (attemptsLeft > 0) {
												playerPool = shuffle(playerPool, true);
												attemptsLeft--;
												i = -2;
											}
										}
									}
								}
																
								while (playerPool.length > (maxPlayersPerMatchup-1)) {
									var matchup = [];
									for (let i = 0; i < maxPlayersPerMatchup; i++) {
										matchup.push(playerPool.shift());
									}
									matchups.push(matchup);
								}
								
								// Handle Bye (if needed)
								if (totalEntries(standings) == 0) {
									if (maxPlayersPerMatchup == 2) { // No byes in multiplayer
										if (playerPool.length == 1) {
											var player1 = playerPool.shift();
											matchups.push([player1, null]);
										}
									} else {
										var finalMatchup = [];
										while (playerPool.length > 0) {
											finalMatchup.push(playerPool.shift());
										}
										if (finalMatchup.length > 0) {
											matchups.push(finalMatchup);
										}
									}
								}
							}
							
							// 'Fix' Multiplayer Pairings to get 4,3,3 instead of 4,4,2
							if (maxPlayersPerMatchup > 2 && matchups.length > 1) {
								var matchupIdx = matchups.length-1;
								var matchup = matchups[matchupIdx];
								while (matchup.length < maxPlayersPerMatchup-1 && matchupIdx > 0) {
									var prevMatchup = matchups[matchupIdx-1];
									matchup.push(prevMatchup.pop());
									if (matchup.length == maxPlayersPerMatchup-1) {
										matchupIdx--;
										matchup = matchups[matchupIdx];
									}
								}
							}
							
							_createGames(round, matchups, maxPlayersPerMatchup, maps, streamingMaps, gameData);
							
							socket.emit("nextRoundPaired", JSON.stringify({round: round}));
						});
					});
				});
			});
		});
	});
		
	socket.on('changeGame', (objStr) => {		
		if ( ! isAdmin) {
			return;
		}	
		var obj = JSON.parse(objStr);
		var game = obj.game;
		
		var mapId = game.map != null ? game.map.id : null;
		
		// TODO - verify the round hasn't started yet...
		
		// SELECT * from game.id -> get game.roundID => check ! Round.started 
		
		/*
		if (error || results.length != 1) {
				socket.emit("publishRoundError", JSON.stringify({}));
				return;
			}
			var round = results[0];
			if (round.tournamentID == currentTournament.id) {
		*/
		
		dbConnection.query(
				"SELECT * FROM `Game` WHERE `id`=?",
				[game.id],
				(error, results, fields) => {
			if (error || results.length != 1) {
				socket.emit("changeGameError", JSON.stringify({}));
				return;
			}
			const dbGame = results[0];
			dbConnection.query(
					"SELECT * FROM `Round` WHERE `id`=?",
					[dbGame.roundID],
					(error, results, fields) => {
				if (error || results.length != 1) {
					socket.emit("changeGameError", JSON.stringify({}));
					return;
				}
				const dbRound = results[0]; 
				if (dbRound.started) {
					socket.emit("changeGameError", JSON.stringify({}));
					return;
				}
				
				dbConnection.query(
						"UPDATE `HeroscapeGame` SET `mapID`=? WHERE `gameID`=?",
						[mapId, game.id],
						(error, results, fields) => {
					if (error) {
						socket.emit('changeGameError', JSON.stringify({}));
					}
				});
				for (let i = 0; i < game.heroscapeGamePlayers.length; i++) {
					dbConnection.query(
							"UPDATE `HeroscapeGamePlayer` SET `gameID`=? WHERE `id`=?",
							[game.id, game.heroscapeGamePlayers[i].id],
							(error, results, fields) => {
						if (error) {
							socket.emit('changeGameError', JSON.stringify({}));
						}
					});
				}
				
				io.to("Tournament_"+currentTournament.id)
					.emit("gameChanged", JSON.stringify({
						game: game
					}));
			});
		});
	});
	
	socket.on('publishNextRound', (objStr) => {
		if ( ! isAdmin) {
			return;
		}
		var obj = JSON.parse(objStr);
		
		dbConnection.query(
				"SELECT * FROM `Round` WHERE `id`=?",
				[obj.round.id],
				(error, results, fields) => {
			if (error || results.length != 1) {
				socket.emit("publishRoundError", JSON.stringify({}));
				return;
			}
			var round = results[0];
			if (round.tournamentID == currentTournament.id) {
				dbConnection.query(
						"UPDATE `Round` SET `started`=1 WHERE `id`=?",
						[round.id],
						(error, results, fields) => {
					if (error) {
						socket.emit("publishRoundError", JSON.stringify({}));
						return;
					} 
					dbConnection.query(
							"SELECT `Game`.`id`, `roundID`, `mapID`, `GameMap`.`name` AS `mapName`, `GameMap`.`altOhsGdocId` AS `mapAltOhsGdocId`," +
								"`GameMap`.`number` AS `mapNumber` " + 
								"FROM `Game` " +
								"INNER JOIN `HeroscapeGame` ON `HeroscapeGame`.`gameID` = `Game`.`id` "+
								"LEFT JOIN `GameMap` ON `GameMap`.`id` = `HeroscapeGame`.`mapID` " + 
								"WHERE `roundID`=?",
								[round.id],
								(error, results, fields) => {
						if (error) {
							socket.emit("publishRoundError", JSON.stringify({}));
							return;
						}
						
						// TODO : Need to create an online game link here and send it to players via email ...
						
						for (let i = 0; i < results.length; i++) {
							_alertGamePlayers(round, results[i]);
						}
						if (currentTournament.roundLengthMinutes !== undefined && 
								currentTournament.roundLengthMinutes !== null) {
							startClock(currentTournament);
						}
						_updateBackupSheet();
						socket.emit('roundPublished', JSON.stringify({}));
					});
				});
			}
		});
	});
	
	socket.on('cancelCurrentRound', (objStr) => {
		var obj = JSON.parse(objStr);
		var tournament = obj.tournament;
		if ( ! isAdmin) {
			return;
		}		
		stopClock();
				
		dbConnection.query(
				"SELECT * FROM `Round` WHERE `tournamentID`=? ORDER BY `Round`.`order` ASC",
				[tournament.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("roundCancelError", JSON.stringify({}));
				return;
			}
			if (results.length == 0) {
				socket.emit("roundCancelError", JSON.stringify({}));
				return;
			}
						
			var round = results[results.length-1];
						
			dbConnection.query(
					"DELETE FROM `Round` WHERE `id`=?",
					[round.id],
					(error, results, fields) => {
				if (error) {
					socket.emit("roundCancelError", JSON.stringify({}));
					return;
				}
								
				if (sheetId != null) {
					deleteSheetRound(sheetId, round.name);
				}
								
				io.to("Tournament_"+tournament.id)
					.emit("cancelCurrentRound", JSON.stringify({}));
			});
		});
	});
	
	socket.on('createBracket', (objStr) => {
		if ( ! isAdmin) {
			return;
		}
		if (currentTournament.bracket !== undefined && currentTournament.bracket !== null) {
			socket.emit("bracketCreationError", JSON.stringify({}));
			return;
		}
		
		var obj = JSON.parse(objStr);
		const bracket = obj.bracket;
		_loadPlayers(currentTournament, function(players) {
			_rankPlayers(players, currentTournament, function(players, standings, gameData) {
				dbConnection.query(
						"INSERT INTO `Bracket` (`reSeedEachRound`,`size`) VALUES (?,?)",
						[bracket.reSeedEachRound, bracket.size],
						(error, results, fields) => {
					if (error) {
						socket.emit("bracketCreationError", JSON.stringify({}));
						return;
					}
					bracket.id = results.insertId;
					bracket.bracketEntrys = [];
					dbConnection.query(
							"UPDATE `Tournament` SET `bracketID`=? WHERE `id`=?",
							[bracket.id, currentTournament.id],
							(error, results, fields) => {
						if (error) {
							socket.emit("bracketCreationError", JSON.stringify({}));
							return;
						}		
						_createBracketEntry(bracket, standings, 1);
					});
				});
			}, true);
		}, false);
	});
	
	socket.on('tournamentAnnouncement', (objStr) => {
		var obj = JSON.parse(objStr);
		const tournament = obj.tournament;
		const announcement = obj.announcement;
		
		if (isAdmin && currentTournament != null && 
				tournament !== undefined && tournament !== null &&
				tournament.id !== undefined && tournament.id !== null &&
				currentTournament.id == tournament.id) {
			dbConnection.query(
					"SELECT `User`.`email` FROM `Player` " +
						"INNER JOIN `User` ON `User`.`id` = `Player`.`userID` " +
						"WHERE `tournamentID`=?",
					[currentTournament.id],
					(error, results, fields) => {
				if (error) {
					socket.emit("announcementError", JSON.stringify({}));
					return;
				}			
				var emails = [];
				for (let i = 0; i < results.length; i++) {
					emails.push(results[i].email);
				}
				sendAnnouncement(announcement, tournament.name, emails);
			});		
		}
	});
	
	socket.on('submitGameResult', (objStr) => {
		var obj = JSON.parse(objStr);
		var game = obj.game;
		
		// TODO : add a security check to make sure result was submitted by one of the 2 players in the game, or an admin
		
		// TODO : The below if statement is a patch for the crashes observed on 11/12/22 
			// during the Peoria monthly tournament
		if (currentTournament == null) {
			/*logToFile('Peoria Error !! | SocketID : ' + socket.id);
			logToFile('  PE game=' + JSON.stringify(game) + 
				" | SocketID : " + socket.id);
			logToFile('  PE currentTournament=' + JSON.stringify(currentTournament) + 
				" | SocketID : " + socket.id);
			logToFile('  PE loginCookie=' + loginCookie);
			logToFile('  PE user=' + JSON.stringify(user));*/
			socket.emit("gameReportingError", JSON.stringify({}));
			return;
		}
		
		// Set multiplayer 'result' values
		if (currentTournament.maxNumPlayersPerGame > 2) {
			var pointsAvailable = [];
			for (let i = currentTournament.maxNumPlayersPerGame - 1; i >= 0; i--) { // This makes it 6,4,2,0 (remove 2) 
				pointsAvailable.push(i*2);
			} // Mike Wants it 4,2,1,0 (remove 1)
			
			var spotsToRemove = 
				currentTournament.maxNumPlayersPerGame - game.heroscapeGamePlayers.length;
			while (spotsToRemove > 0) {
				pointsAvailable.splice(pointsAvailable.length-2, 1);
				spotsToRemove--;
			}
			
			var currRank = 1;
			while (currRank <= currentTournament.maxNumPlayersPerGame) {
				var playersWithRankIdxs = [];
				for (let i = 0; i < game.heroscapeGamePlayers.length; i++) {
					if (game.heroscapeGamePlayers[i].rank == currRank) {
						playersWithRankIdxs.push(i);
					}
				}
				if (playersWithRankIdxs.length > 0) {
					var pointsPerPlayer = 0;
					for (let i = 0; i < playersWithRankIdxs.length; i++) {
						pointsPerPlayer += pointsAvailable.shift();
					}
					pointsPerPlayer /= playersWithRankIdxs.length;
					for (let i = 0; i < playersWithRankIdxs.length; i++) {
						game.heroscapeGamePlayers[playersWithRankIdxs[i]].result = pointsPerPlayer;
					}
				}
				currRank++;
			}
		}
		
		dbConnection.query(
				"UPDATE `HeroscapeGame` SET `wentToTime`=? WHERE `gameID`=?",
				[game.wentToTime, game.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("gameReportingError", JSON.stringify({}));
				return;
			}
			io.to("Tournament_"+game.round.tournament.id)
				.emit("gameResult", JSON.stringify({game: game}));	
		});
				
		for (let i = 0; i < game.heroscapeGamePlayers.length; i++) {
			const gamePlayer = game.heroscapeGamePlayers[i];
			dbConnection.query(
					"UPDATE `HeroscapeGamePlayer` SET `result`=?, `pointsLeft`=? WHERE id=?",
					[gamePlayer.result, gamePlayer.pointsLeft, gamePlayer.id],
					(error, results, fields) => {
				if (error) {
					socket.emit("gameReportingError", JSON.stringify({}));
					return;
				} 
				if (gamePlayer.result == 0 && 
						currentTournament.bracket !== undefined && 
						currentTournament.bracket !== null) {
					for (let j = 0; j < currentTournament.bracket.bracketEntrys.length; j++) {
						const entry = currentTournament.bracket.bracketEntrys[j];
						if (entry.playerID == gamePlayer.playerID) {
							dbConnection.query(
									"UPDATE `BracketEntry` SET `eliminated`=1 WHERE `id`=?",
									[entry.id],
									(error, results, fields) => {
								if (error) {
									socket.emit("gameReportingError", JSON.stringify({}));
									return;
								}
								// Do nothing 
							});
							break;
						}
					}
				}
				if (i == game.heroscapeGamePlayers.length - 1) {
					_updateBackupSheet();
					_checkRoundCompleted(game);
				}
			});
		}
	});
	
	function _checkRoundCompleted(game) {
		/*if (currentTournament.online && 
				currentTournament.roundLengthMinutes == null) {*/
			dbConnection.query(
					"SELECT * FROM Game " +
					"		INNER JOIN HeroscapeGame ON HeroscapeGame.gameID = Game.id " +
					"		INNER JOIN HeroscapeGamePlayer ON HeroscapeGamePlayer.gameID = HeroscapeGame.gameID " + 
					"	WHERE roundID=? " +
					"		AND result IS NULL",
					[game.round.id],
					(error, results, fields) => {
				if ( ! error && results.length == 0) {	
					dbConnection.query(
							"SELECT * FROM Admin " +
							"		INNER JOIN User ON User.id = Admin.userID " +
							"	WHERE tournamentID=?",
							[currentTournament.id],
							(error, results, fields) => {
						if ( ! error) {
							const subject = currentTournament.name + " " + game.round.name + " Completed";
							const message= "The round is completed.<br><br>" + 
								"Start the next round here:<br>" + 
								"<a href='https://heroscape.org/events/tournament/?Tournament="+currentTournament.id+"'>https://heroscape.org/tournament/?Tournament="+currentTournament.id+"</a>";
							for (let i = 0; i < results.length; i++) {
								const user = results[i];
								sendEmail(user.email, subject, message);
							}
						}
					});
				}			
			});
		//}
	}
	
	socket.on('markSelfInactive', (objStr) => {
		if (currentTournament != null && user != null) {			
			dbConnection.query(
					"SELECT * FROM `Player` WHERE `userID`=? AND `tournamentID`=?",
					[user.id, currentTournament.id],
					(error, results, fields) => {
				if (error || results.length != 1) {
					socket.emit("markPlayerInactiveError", JSON.stringify({}));
					return;
				}
				const player = results[0];
				_markPlayerInactive(player);
			});			
		}		
	});
	
	socket.on('markPlayerInactive', (objStr) => {
		if ( ! isAdmin) {
			return;
		}
		var obj = JSON.parse(objStr);
		var player = obj.player;
		_markPlayerInactive(player);
	});
	
	socket.on('dropPlayer', (objStr) => {
		if ( ! isAdmin) {
			return;
		}
		var obj = JSON.parse(objStr);
		var player = obj.player;
		
		dbConnection.query(
				"SELECT * FROM `Round` WHERE `tournamentID`=?",
				[currentTournament.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("dropPlayerError", JSON.stringify({}));
				return;
			}
			if (results.length > 0) {
				socket.emit("dropPlayerError", JSON.stringify({}));
				return;
			}
			dbConnection.query(
					"DELETE FROM `PlayerArmy` WHERE `playerID`=?",
					[player.id],
					(error, results, fields) => {
				if (error) {
					socket.emit("dropPlayerError", JSON.stringify({}));
					return;
				}
				dbConnection.query(
						"DELETE FROM `Player` WHERE `id`=?",
						[player.id],
						(error, results, fields) => {
					if (error) {
						socket.emit("dropPlayerError", JSON.stringify({}));
						return;
					}
					io.to("Tournament_"+currentTournament.id)
						.emit("playerDropped", JSON.stringify({player: player}));
				});
			});
		});
	});
	
	function _markPlayerInactive(player) {
		dbConnection.query(
				"UPDATE `Player` SET `active`=0 WHERE `id`=?",
				[player.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("dropPlayerError", JSON.stringify({}));
				return;
			}		
		});
		io.to("Tournament_"+currentTournament.id)
			.emit("playerInactive", JSON.stringify({player: player}));
	}
	
	socket.on('markPlayerActive', (objStr) => {
		var obj = JSON.parse(objStr);
		var player = obj.player;
		var tournament = obj.tournament;
		if ( ! isAdmin) {
			return;
		}
				
		dbConnection.query(
				"UPDATE `Player` SET `active`=1 WHERE `id`=?",
				[player.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("markPlayerActiveError", JSON.stringify({}));
				return;
			}		
		});
		
		io.to("Tournament_"+tournament.id)
			.emit("playerActive", JSON.stringify({player: player}));
	});

	socket.on('startTournament', (objStr) => {
		if ( ! isAdmin) {
			return;
		}
		dbConnection.query(
				"UPDATE `Tournament` SET `started`=1 WHERE `id`=?",
				[currentTournament.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("startTournamentError", JSON.stringify({}));
				return;
			}
			io.to("Tournament_"+currentTournament.id)
				.emit("tournamentStarted", JSON.stringify({}));
		});
	});
	
	socket.on('finishTournament', (objStr) => {
		if ( ! isAdmin) {
			return;
		}
		dbConnection.query(
				"UPDATE `Tournament` SET `finished`=1 WHERE `id`=?",
				[currentTournament.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("finishTournamentError", JSON.stringify({}));
				return;
			}
			io.to("Tournament_"+currentTournament.id)
				.emit("tournamentFinished", JSON.stringify({}));
			_updatePlayerRankings();
		});
	});
	
	socket.on('restartTournament', (objStr) => {
		if ( ! isAdmin) {
			return;
		}
		dbConnection.query(
				"UPDATE `Tournament` SET `finished`=0 WHERE `id`=?",
				[currentTournament.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("restartTournamentError", JSON.stringify({}));
				return;
			}
			io.to("Tournament_"+currentTournament.id)
				.emit("tournamentRestarted", JSON.stringify({}));
		});
	});
	
	/*socket.on('restartNodeServer', (objStr) => {
		getLoggedInUser(function(user) {
			if (user != null && user.siteAdmin) {
				const cmd = "cd /var/www/html/connect" + 
					" && node secondaryServer.js &> output.log &" + 
					" && disown";
				exec(cmd, (err, stdout, stderr) => {
					if (err) {
						// node couldn't execute the command
						return;
					}			
				});
			}
		});
	});*/
	
	socket.on('claimMap', (objStr) => {
		if (user != null) {
			var obj = JSON.parse(objStr);
			const gameMapId = obj.gameMap.id;
			
			dbConnection.query(
					"UPDATE `GameMap` SET `broughtByUserID`=? WHERE `id`=?",
					[user.id, gameMapId],
					(error, results, fields) => {
				if (error) {
					socket.emit("mapClaimedError", JSON.stringify({}));
					return;
				}
				io.to("Tournament_"+currentTournament.id)
					.emit("mapClaimed", JSON.stringify({
						gameMap: {
							id: gameMapId
						},
						user: {
							id: user.id,
							userName: user.userName
						}
					}));
			});
		}
	});
	
	socket.on('unClaimMap', (objStr) => {
		if (user != null) {
			var obj = JSON.parse(objStr);
			const gameMapId = obj.gameMap.id;
			
			// TODO - add check that logged in user is the current map bringer 
			
			dbConnection.query(
					"UPDATE `GameMap` SET `broughtByUserID`=null WHERE `id`=?",
					[gameMapId],
					(error, results, fields) => {
				if (error) {
					socket.emit("mapClaimedError", JSON.stringify({}));
					return;
				}
				io.to("Tournament_"+currentTournament.id)
					.emit("mapUnClaimed", JSON.stringify({
						gameMap: {
							id: gameMapId
						}/*,
						user: {
							id: user.id,
							userName: user.userName
						}*/
					}));
			});
		}
	});
	
	function getLoggedInUser(callbackFcn) {
		try {
			var cookies = cookie.parse(socket.handshake.headers.cookie);
			if ( ! 'hs_key' in cookies) {
				callbackFcn(null);
				return;
			}
			loginCookie = cookies['hs_key'];
		} catch (error) {
			callbackFcn(null);
			return;
		}
		dbConnection.query(
				"SELECT `User`.`id`, `User`.`userName` FROM `User` " +
					"INNER JOIN `LoginCredentials` ON `LoginCredentials`.`userID` = `User`.`id` " +
					"WHERE (`cookie` = ?);",
				[loginCookie],
				(error, results, fields) => {
			if (error) {
				return;
			} 
			if (results.length != 1) {
				return;
			}
			user = results[0];
			callbackFcn(user);
		});
	}
	
	
	
	socket.on('updateUserCollectionHeroscapeSet', (objStr) => {
		getLoggedInUser(function(user) {
			if (user == null) {
				return;
			}
			var obj = JSON.parse(objStr);
			const heroscapeSet = obj.heroscapeSet;
			const quantity = obj.quantity;
			
			dbConnection.query(
				"SELECT * FROM `UserCollectionHeroscapeSet` WHERE `userID`=? AND `heroscapeSetID`=?",
				[user.id, heroscapeSet.id],
				(error, results, fields) => {
					if (error) {
						// TODO - Handle error
						return;
					}
					if (results.length > 0) {
						dbConnection.query(
								"UPDATE `UserCollectionHeroscapeSet` SET `quantity`=? WHERE `userID`=? AND `heroscapeSetID`=?",
								[quantity, user.id, heroscapeSet.id],
								(error, results, fields) => {
							if (error) {
								// TODO - Handle Error 
								return;
							}
						});
					} else {
						dbConnection.query(
								"INSERT INTO `UserCollectionHeroscapeSet` (`userID`, `heroscapeSetID`, `quantity`) VALUES (?,?,?);",
								[user.id, heroscapeSet.id, quantity],
								(error, results, fields) => {
							if (error) {
								// TODO - Handle Error 
								return;
							}
						});
					}
				}
			);
		});
	});
	
	
	
	/** Clock Functionality **/
	
	socket.on('loadClock', (objStr) => {
		const clock = JSON.parse(objStr).clock;
		socket.join("Clock_"+clock.id);	
	});
	
	socket.on('startPlayerClock', (objStr) => {
		const clock = JSON.parse(objStr).clock;
		const player = JSON.parse(objStr).player;
		
		stopPlayerClock(clock);
		startPlayerClock(clock, player);
	});
	
	socket.on('stopPlayerClock', (objStr) => {
		const clock = JSON.parse(objStr).clock;
		const player = JSON.parse(objStr).player;
		
		stopPlayerClock(clock);
	});
		
	function startPlayerClock(clock, player) {
		stopPlayerClock(clock);
		io.to("Clock_"+clock.id)
			.emit("startClock", JSON.stringify({player: player}));
		var timeInSeconds = player.timeInSeconds;
		playerClockTimeIntervals[clock.id] = setInterval(function() {
			const newTimeInSeconds = clock.countDown
				? --timeInSeconds
				: ++timeInSeconds;
			updatePlayerClock(clock, player, newTimeInSeconds);
		}, 1 * 1000);
	}
	
	function stopPlayerClock(clock) {
		if (playerClockTimeIntervals[clock.id] !== null) {
			io.to("Clock_"+clock.id)
				.emit("stopClock", JSON.stringify({}));
			clearInterval(playerClockTimeIntervals[clock.id]);
			playerClockTimeIntervals[clock.id] = null;
		}
	}
	
	function updatePlayerClock(clock, player, timeInSeconds) {
		io.to("Clock_"+clock.id)
			.emit("setPlayerClock", JSON.stringify({
				player: player,
				timeInSeconds: timeInSeconds}));
				
		dbConnection.query(
				"UPDATE `PlayerClock` SET `timeInSeconds`=? WHERE `id`=?",
				[timeInSeconds, player.id],
				(error, results, fields) => {
			if (error || results.length != 1) {
				//socket.emit("dropPlayerError", JSON.stringify({}));
				return;
			}
		});		
		
		if (timeInSeconds <= 0 || timeInSeconds >= 60*60*24) {
			stopPlayerClock(clock);
		}
	}
	
	
	
	/** Player Rankings **/
	
	socket.on('checkSiteAdmin', (objStr) => {
		checkLoginAndSetAdmin(5, null);
	});
	
	socket.on('updatePlayerRankings', (objStr) => {
		if ( ! isAdmin) {
			return;
		}
		_updatePlayerRankings()
	});
	
	function _updatePlayerRankings() {
		_updatePlayerELO();
		_updatePlayerTTT();
	}
	
	function _updatePlayerELO() {
		dbConnection.query(
				"SELECT `User`.`id`, `User`.`userName` FROM `User`;",
				[],
				(error, results, fields) => {
			if (error) {
				return;
			} 
			
			var users = {};
			for (let i = 0; i < results.length; i++) {
				users[results[i].id] = {
					/*user: {
						id: results[i].id,
						userName: results[i].userName
					},*/
					elo: 1600
				};
			}
						
			dbConnection.query(
					"SELECT * FROM `Tournament` WHERE `teamSize` = 1 AND `maxNumPlayersPerGame` = 2 AND `started` = 1 AND `finished` = 1 ORDER BY `startTime` ASC;",
					[],
					(error, results, fields) => {
				if (error) {
					return;
				} 
				for (let i = 0; i < results.length; i++) {
					const tournament = results[i];
					const lastTournament = (i == results.length-1);
					
					dbConnection.query(
							"SELECT * FROM `Round` WHERE `tournamentID`=?;",
							[tournament.id],
							(error, results, fields) => {
						if (error) {
							return;
						} 
						for (let j = 0; j < results.length; j++) {
							const round = results[j];
							const lastRound = (j == results.length-1);
							
							dbConnection.query(
									"SELECT * FROM `Game` " +
										"INNER JOIN `HeroscapeGame` ON `HeroscapeGame`.`gameID` = `Game`.`id` " +
										"WHERE `roundID`=?;",
									[round.id],
									(error, results, fields) => {
								if (error) {
									return;
								} 
								for (let k = 0; k < results.length; k++) {
									const game = results[k];
									const lastGame = (k == results.length-1);
														
									dbConnection.query(
											"SELECT * FROM `HeroscapeGamePlayer` " +
												"INNER JOIN `Player` ON `Player`.`id` = `HeroscapeGamePlayer`.`playerID` " +
												"WHERE `gameID`=?;",
											[game.id],
											(error, results, fields) => {
										if (error) {
											return;
										} 
										if (results.length == 2) {
										
											const gamePlayer1 = results[0];
											const gamePlayer2 = results[1];
											
											if (gamePlayer1.userID != null && gamePlayer2.userID != null) {
												
												//const user1 = users[gamePlayer1.userID];
												//const user2 = users[gamePlayer2.userID];
												
												const user1Elo = users[gamePlayer1.userID].elo;
												const user2Elo = users[gamePlayer2.userID].elo;
												
												users[gamePlayer1.userID].elo = Elo.getNewRating(user1Elo, user2Elo, gamePlayer1.result / 2.0);
												users[gamePlayer2.userID].elo = Elo.getNewRating(user2Elo, user1Elo, gamePlayer2.result / 2.0);
											}
										}
																				
										if (lastTournament && lastRound && lastGame) {
											for (const userID in users) {
												const userEntry = users[userID];
												//const user = userEntry.user;
												dbConnection.query(
														"UPDATE `User` SET `elo`=? WHERE `id`=?",
														[userEntry.elo, userID],
														(error, results, fields) => {
													if (error) {
														// TODO : Handle error
													}
												});
											}
										}
									});
								}
							});
						}
					});
				}
			});
		});
	}
	
	Elo = (function() {
		function getRatingDelta(myRating, opponentRating, myGameResult) {
			if ([0, 0.5, 1].indexOf(myGameResult) === -1) {
				return null;
			}

			var myChanceToWin = 1 / ( 1 + Math.pow(10, (opponentRating - myRating) / 400));

			const kFactor = 10; // was 32 
			return Math.round(kFactor * (myGameResult - myChanceToWin));
		}

		function getNewRating(myRating, opponentRating, myGameResult) {
			return myRating + getRatingDelta(myRating, opponentRating, myGameResult);
		}

		return {
			getRatingDelta: getRatingDelta,
			getNewRating: getNewRating
		};
	})();
	
	function _updatePlayerTTT() {
		
		// TODO 
		
	}
	
	
	/** Create Round Helper Functions **/
	
	function _loadPlayers(tournament, callbackFcn, onlyActive=true) {
		var playerQuery = 
			"SELECT `Player`.`id`, `Player`.`name`, `Player`.`userID`, `Player`.`tournamentID`, " +
					"`Player`.`teamCaptainID`, `Player`.`active`, `User`.`email` " +
				"FROM `Player` " + 
				"LEFT JOIN `User` ON `User`.`id` = `Player`.`userID` " +
				"WHERE `tournamentID`=?";
		if (onlyActive) {
			playerQuery += " AND `Player`.`active`=1";
		}
		dbConnection.query(
				playerQuery,
				[tournament.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("roundCreationError", JSON.stringify({}));
				return;
			}
			
			var players = results;
						
			dbConnection.query(
					"SELECT `Player`.`id`, `PlayerArmy`.`army`, `PlayerArmy`.`armyNumber`, `Card`.`name`, `PlayerArmyCard`.`quantity` FROM `PlayerArmy` " +
						"INNER JOIN `Player` ON `Player`.`id` = `PlayerArmy`.`playerID` " +
						"LEFT JOIN `PlayerArmyCard` ON `PlayerArmyCard`.`playerArmyID` = `PlayerArmy`.`id` " +
						"LEFT JOIN `Card` ON `Card`.`id` = `PlayerArmyCard`.`cardID` " +  
						"WHERE `tournamentID`=? ",
					[tournament.id],
					(error, results, fields) => {
				if (error) {
					socket.emit("roundCreationError", JSON.stringify({}));
					return;
				}		

				for (let i = 0; i < players.length; i++) {
					var player = players[i];
					player.armies = [];
					for (let j = 0; j < results.length; j++ ) {
						if (results[j].id == player.id) {
							if (results[j].army != null) {
								player.armies[results[j].armyNumber-1] = results[j].army;
							} else {
								if (player.armies[results[j].armyNumber-1] == undefined) {
									player.armies[results[j].armyNumber-1] = "";
								} else if (player.armies[results[j].armyNumber-1].length > 0) {
									player.armies[results[j].armyNumber-1] += ", ";
								}
								player.armies[results[j].armyNumber-1] += results[j].name + " x" + results[j].quantity;
							}
						}
					}
				}

				callbackFcn(players);
			});
		});
	}
	
	function _rankPlayers(players, tournament, callbackFcn, useSoS=false) {
		dbConnection.query(
				"SELECT `Player`.`id`, `Player`.`active`, " + 
					"`HeroscapeGame`.`gameID` AS 'gameID', `result`, `pointsLeft`, `mapID`, `GameMap`.`name` AS 'mapName' "+
					"FROM `Player` "+
						"LEFT JOIN `HeroscapeGamePlayer` ON `HeroscapeGamePlayer`.`playerID` = `Player`.`id` "+
						"LEFT JOIN `HeroscapeGame` ON `HeroscapeGame`.`gameID` = `HeroscapeGamePlayer`.`gameID` "+
						"LEFT JOIN `GameMap` ON `GameMap`.`id` = `HeroscapeGame`.`mapID` "+
					"WHERE `Player`.`tournamentID`=?",// AND `Player`.`active`=1",
				[tournament.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("roundCreationError", JSON.stringify({}));
				return;
			}	
			var standings = [];
			for (let i = 0; i < players.length; i++) {
				var player = players[i];
				var points = 0;
				var wins = 0;
				var losses = 0;
				var ties = 0;
				for (let j = 0; j < results.length; j++) {
					if (results[j].id == player.id) {
						points += results[j].result;
						if (tournament.maxNumPlayersPerGame == 2) {
							if (results[j].result == 2) {
								wins++;
							} else if (results[j].result == 2) {
								ties++;
							}
						}
						if (results[j].result == 0) {
							losses += 1;
						}
					}
				}
				player.points = points;
				if (tournament.maxNumPlayersPerGame == 2) {
					player.wins = wins;
					player.ties = ties;
				}
				player.losses = losses;
				
				if ( ! tournament.pairAfterEliminated && tournament.numLossesToBeEliminated != null) {
					if (losses >= tournament.numLossesToBeEliminated) {
						players.splice(i, 1);
						i--;
						continue;
					}
				}
				
				if (standings[points] === undefined) {
					standings[points] = [];
				}
				
				// TODO - check here if player is NOT a team captain, and exclude them if not
				
				if (player.teamCaptainID == null) {
					standings[points].push(player);
				}
			}
			for (let i = 0; i < standings.length; i++) {
				if (standings[i] !== undefined && standings[i].length > 0) {
					standings[i] = shuffle(standings[i]);
				}
			}
			if (useSoS) {
				for (let i = 0; i < players.length; i++) {
					var player = players[i];
					var opponentWins = 0;
					var opponentLosses = 0;
					for (let j = 0; j < results.length; j++) {
						if (results[j].id == player.id) {	
							const opponent = 
								_findOpponent(player, results[j].gameID, results, players);
							if (opponent != null) {
								opponentWins += opponent.wins;
								opponentLosses += opponent.losses;
							}
						}
					}			
					player.sos = 
						(opponentWins / (opponentLosses + opponentWins))
							.toFixed(3);
				}
				for (let i = 0; i < standings.length; i++) {
					if (standings[i] !== undefined && standings[i].length > 0) {
						standings[i] = shuffle(standings[i]);						
						standings[i].sort(function(a, b) {
							if (a.sos < b.sos) {
								return 1;
							} else if (a.sos > b.sos) {
								return -1;
							}
							return 0;
						});
					}
				}
			} 
			callbackFcn(players, standings, results);
		});		
	}
	
	function _findOpponent(player, gameID, results, players) {
		var opponentID = null;
		for (let i = 0; i < results.length; i++) {
			if (results[i].gameID == gameID && results[i].id != player.id) {
				opponentID = results[i].id;
				break;
			}
		}
		var opponent = null;
		if (opponentID != null) {
			for (let i = 0; i < players.length; i++) {
				if (players[i].id == opponentID) {
					opponent = players[i];
					break;
				}
			}
		}	
		return opponent;
	}

	function _checkArmiesSubmitted(tournament, players, callbackFcn) {
		if (currentTournament.numArmies == 0) {
			callbackFcn();
			return;
		}
		dbConnection.query(
				"SELECT `Player`.`id`, `Player`.`name`, `playerID` FROM `Player` "+
					"LEFT JOIN `PlayerArmy` ON `PlayerArmy`.`playerID` = Player.id "+
					"WHERE `tournamentID`=?",
				[tournament.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("roundCreationError", JSON.stringify({}));
				return;
			}
			
			for (let i = 0; i < results.length; i++) {
				var playerFound = false;
				for (let j = 0; j < players.length; j++) {
					if (results[i].id == players[j].id) {
						playerFound = true;
						break;
					}
				}
				
				if (playerFound) {
					// TODO - check tournament.numArmies eventually 
					if (results[i].playerID == null) { // if Player didn't link to any PlayerArmy rows
						socket.emit("playerMissingArmy", 
							JSON.stringify({
								userName: results[i].name}));
						return;
					}
				}
			}
			
			callbackFcn();
		});		
	}

	function _loadMaps(tournament, callbackFcn) {
		dbConnection.query(
				"SELECT * FROM `GameMap` WHERE `tournamentID`=? AND `active`=1",
				[tournament.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("roundCreationError", JSON.stringify({}));
				return;
			}	
			callbackFcn(results);
		});
	}

	function _createRound(roundName=null, callbackFcn) {
		dbConnection.query(
				"SELECT * FROM `Round` WHERE `tournamentID`=?",
				[currentTournament.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("roundCreationError", JSON.stringify({}));
				return;
			}
			if (roundName == null) {
				roundName = "Round " + (results.length+1);
			}
			const roundOrder = results.length; 
			dbConnection.query(
					"INSERT INTO `Round` (`tournamentID`,`name`,`order`) VALUES (?,?,?)",
					[currentTournament.id, roundName, roundOrder],
					(error, results, fields) => {
				if (error) {
					socket.emit("roundCreationError", JSON.stringify({}));
					return;
				}	
				const roundID = results.insertId;
				callbackFcn({
					id: roundID,
					name: roundName,
					order: roundOrder,
					started: false,
					tournament: currentTournament
				});
			});
		});		
	}
	
	function shuffle(array, checkPlayerPointsOrder=false) {
		let currentIndex = array.length, randomIndex;

		// While there remain elements to shuffle.
		while (currentIndex != 0) {
			// Pick a remaining element.
			randomIndex = Math.floor(Math.random() * currentIndex);
			currentIndex--;

			// And swap it with the current element.
			[array[currentIndex], array[randomIndex]] = [
				array[randomIndex], array[currentIndex]];
		}
		
		if (checkPlayerPointsOrder) {
			// Need to replace bubble sort eventually
			for (let a = 0; a < array.length; a++) {
				for (let b = a+1; b < array.length; b++) {
					if (array[b].points > array[a].points) {
						var tempPlayer = array[a];
						array[a] = array[b];
						array[b] = tempPlayer;
					}
				}
			}
		}

		return array;
	}
	
	function totalEntries(twoDarray) {
		var count = 0;
		for (let i = 0; i < twoDarray.length; i++) {
			if (twoDarray[i] !== undefined) {
				count += twoDarray[i].length;
			}
		}
		return count;
	}
	
	function rematch(player1, player2, gameData) {
		var player1GameIDs = [];
		for (let i = 0; i < gameData.length; i++) {
			const game = gameData[i];
			if (game.id == player1.id) {
				player1GameIDs.push(game.gameID);
			}
		}
		for (let i = 0; i < gameData.length; i++) {
			const game = gameData[i];
			if (game.id == player2.id) {
				for (let j = 0; j < player1GameIDs.length; j++) {
					if (player1GameIDs[j] == game.gameID) {
						return true;
					}
				}
			}
		}
		return false;
	}
	
	function mapRematches(player1, player2, gameData, map) {
		var numTimesOnMap = 0;
		for (let i = 0; i < gameData.length; i++) {
			const game = gameData[i];
			if (game.mapName == map.name) {
				if (game.id == player1.id) {
					numTimesOnMap++;
				}
				if (player2 != null && game.id == player2.id) {
					numTimesOnMap++;
				}
			}
		}
		return numTimesOnMap;
	}
	
	function createGame(round, players, map) {
		dbConnection.query(
				"INSERT INTO `Game` (`roundID`) VALUES (?)",
				[round.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("roundCreationError", JSON.stringify({}));
				return;
			}	
			
			round.className = "Round";
			if (map != null) {
				map.className = "GameMap";
			}
			var game = {
				id: results.insertId, 
				heroscapeGamePlayers: [],
				map: map,
				round: round,
				className: "HeroscapeGame"
			};
			
			var mapId = map != null ? map.id : null;
			
			dbConnection.query(
					"INSERT INTO `HeroscapeGame` (`gameID`,`mapID`) VALUES (?,?)",
					[game.id, mapId],
					(error, results, fields) => {
				if (error) {
					socket.emit("roundCreationError", JSON.stringify({}));
					return;
				}
				
				createGamePlayers(round, game, players, 0, map);
			});
		});
	}
	
	function createGamePlayers(round, game, players, playerIdx, map) {
		// Base Case 1
		if (players.length == playerIdx) {
			socket.emit("gamePaired", JSON.stringify({game: game}));
			return;
		}
		
		// Base Case 2
		var player = players[playerIdx];
		if (player == null) {
			createGamePlayers(round, game, players, playerIdx+1, map);
			return;
		}
		
		// Recursive Case 
		dbConnection.query(
				"INSERT INTO `HeroscapeGamePlayer` (`playerID`,`gameID`) VALUES (?,?)",
				[player.id, game.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("roundCreationError", JSON.stringify({}));
				return;
			} 
			
			game.heroscapeGamePlayers.push({
				id: results.insertId,
				playerID: player.id,
				result: null,
				className: "HeroscapeGamePlayer",
				player: {
					id: player.id,
					name: player.name,
					className: "Player"
				}
			});
			
			createGamePlayers(round, game, players, playerIdx+1, map)
		});
	}
	
	
	/** Bracket Helper Functions **/
	
	function _createBracketEntry(bracket, standings, seed) {
		if (seed > bracket.size) {
			currentTournament.bracket = bracket;
			socket.emit("bracketCreated", JSON.stringify({bracket: bracket}));
			return;
		}
		
		var player = null;
		while (player == null) {
			if (standings.length == 0) {
				currentTournament.bracket = bracket;
				socket.emit("bracketCreated", JSON.stringify({bracket: bracket}));
				return;
			}
			if (standings[standings.length-1] === undefined || 
					standings[standings.length-1].length == 0) {
				standings.pop();
				continue;
			}
			player = standings[standings.length-1].shift();
			if ( ! player.active) {
				player = null;
			}
		}
		
		dbConnection.query(
				"INSERT INTO `BracketEntry` (`bracketID`,`playerID`,`seed`) VALUES(?,?,?)",
				[bracket.id, player.id, seed],
				(error, results, fields) => {
			var bracketEntry = {
				id: results.insertId,
				player: player,
				seed: seed,
				eliminated: false
			};
			bracket.bracketEntrys.push(bracketEntry);
			_createBracketEntry(bracket, standings, seed+1);
		});
	}
	
	function _createGames(round, matchups, maxPlayersPerMatchup, maps, streamingMaps, gameData) {
		while (matchups.length > 0) {
			const matchup = matchups.shift();
			
			var map = null;
			
			if (maxPlayersPerMatchup == 2) {
				const player1 = matchup[0];
				const player2 = matchup[1];
				if (player2 != null) { // Leave map null if bye
					if (streamingMaps.length > 0) {
						map = streamingMaps[0];
						streamingMaps.splice(0, 1);
					} else {
						var mapIdx = 0;
						var numMapRematches = mapRematches(player1, player2, gameData, maps[mapIdx]);
						for (let i = 1; i < maps.length; i++) {
							var tempNumMapRematches = mapRematches(player1, player2, gameData, maps[i]);
							if (tempNumMapRematches < numMapRematches) {
								numMapRematches = tempNumMapRematches;
								mapIdx = i;
							}
						}
						map = maps[mapIdx];
						maps.splice(mapIdx, 1);
					}
				}
			} else { // Avoid map rematch check in multiplayer
				if (streamingMaps.length > 0) {
					map = streamingMaps[0];
					streamingMaps.splice(0, 1);
				} else {
					map = maps[0];
					maps.splice(0, 1);
				}
			}
			createGame(round, matchup, map);
		}
	}
	
	function _findPlayerFromBracketEntry(bracketEntry, standings) {
		for (let i = 0; i < standings.length; i++) {
			if (standings[i] !== undefined) {
				for (let j = 0; j < standings[i].length; j++) {
					if (standings[i][j].id == bracketEntry.playerID) {
						return standings[i][j];
					}
				}
			}
		}
		return null; // Error case 
	}
	
	function powerOfTwo(x) {
		return (Math.log(x)/Math.log(2)) % 1 === 0;
	}
	
	function _findValidOpponentSeeds(seed, roundSize, bracketSize) {
		// Ex. 1, 4, 8 => [4,5]
		// Ex. 1, 4, 16 => [4,5,13,12]
		// [4,5] => [4,5,16-4+1,16-5+1]
		var validSeeds = [];
		
		var comparisonSeed = seed;
		if (comparisonSeed > roundSize) {
			var tempRoundSize = roundSize;
			while (comparisonSeed > tempRoundSize) {
				tempRoundSize *= 2;
			}
			comparisonSeed = Math.min.apply(Math, _findValidOpponentSeeds(seed, tempRoundSize, bracketSize));  
		}
		validSeeds.push(roundSize+1-comparisonSeed);
		
		//validSeeds.push(roundSize+1-seed); 
		var cutoff = bracketSize;
		if ( ! powerOfTwo(cutoff)) {
			var n = 1;
			var k = Math.pow(2,n);
			while (k < cutoff) {
				k = Math.pow(2, ++n);
			}
			cutoff = k;
		}
		for (let currRoundSize = roundSize*2; currRoundSize <= cutoff; currRoundSize*=2) {
			var newValidSeeds = [];
			for (let j = 0; j < validSeeds.length; j++) {
				newValidSeeds.push(currRoundSize+1-validSeeds[j]);
			}
			validSeeds = validSeeds.concat(newValidSeeds);
		}
		return validSeeds;
	}
	
	
	/** Create Player Helper Functions **/
	
	function _createNonUserPlayerArmy(player, armyIdx) {
		if (player.armies.length == armyIdx) {
			player.playerArmys = player.armies;
			socket.emit("nonUserPlayerCreated", JSON.stringify({player: player}));
			return;
		}
		dbConnection.query(
				"INSERT INTO `PlayerArmy` (`army`,`armyNumber`,`playerID`) VALUES (?,?,?)",
				[player.armies[armyIdx].army, player.armies[armyIdx].armyNumber, player.id],
				(error, results, fields) => {
			if (error) {
				socket.emit("createNonUserPlayerError", JSON.stringify({msg: "Unknown error"}));
				return;
			}
			player.armies[armyIdx].id = results.insertId;
			_createNonUserPlayerArmy(player, armyIdx+1);
		});		
	}
	
	
	/** Publish Round Helper Functions **/
	
	function _alertGamePlayers(round, game) {		
		_loadPlayers(currentTournament, function(players) {
			_rankPlayers(players, currentTournament, function(players, standings, gameData) {
				dbConnection.query(
						"SELECT `Player`.`id`, `HeroscapeGamePlayer`.`id` AS `gamePlayerId` " +
							" FROM `HeroscapeGamePlayer` " + 
							"INNER JOIN `Player` ON `Player`.`id` = `HeroscapeGamePlayer`.`playerID` " +
							"WHERE `gameID`=?",
						[game.id],
						(error, results, fields) => {
					var gamePlayers = [];
					for (let i = 0; i < players.length; i++) {
						for (let j = 0; j < results.length; j++) {
							if (players[i].id == results[j].id) {
								players[i].gamePlayerId = results[j].gamePlayerId;
								gamePlayers.push(players[i]);
							}
						}
					}
					//logToFile(game);
					var map = game.mapName == null
						? null
						: {
							name: game.mapName,
							number: game.mapNumber,
							altOhsGdocId: game.mapAltOhsGdocId
						};
					var game2 = {
						id: game.id, 
						heroscapeGamePlayers: [],
						map: map,
						round: round
					};
					if (map == null) {
						dbConnection.query(
								"UPDATE `HeroscapeGamePlayer` SET `result`=2 WHERE `id`=?",
								[gamePlayers[0].gamePlayerId],
								(error, results, fields) => {
							if (error) {
								// TODO : Handle error
							}
						});
					}
					
					if (currentTournament.online) {	
						const mapName = game2.map == null
							? "-1"
							: game2.map.name;
						dbConnection.query(
								"SELECT * FROM `HeroscapeMap` WHERE `name`=?",
								[mapName],
								(error, results, fields) => {
							if (error || results.length == 0) {
								_alertGamePlayers2(round, game2, gamePlayers, 0, map);
							} else {
								const heroscapeMap = results[0];
								if (heroscapeMap.ohsGdocId != null || map.altOhsGdocId != null) {
									var gameName = currentTournament.name + " " + round.name;
									for (let i = 0; i < gamePlayers.length; i++) {
										if (i > 0) {
											gameName += " v.";
										}
										gameName += " " + gamePlayers[i].name;
									}
									
									//logToFile("Map GDoc Id:");
									//logToFile(map);
									//logToFile(map.altOhsGdocId);
									
									const gDocId = map.altOhsGdocId != null
										? map.altOhsGdocId
										: heroscapeMap.ohsGdocId;
										
									//logToFile(gDocId);
									
									createGameLink(gameName, gDocId, gamePlayers, function(gameUrl) {
										game2.onlineUrl = gameUrl;
										_alertGamePlayers2(round, game2, gamePlayers, 0, map);
										dbConnection.query(
												"UPDATE `Game` SET `onlineUrl`=? WHERE `id`=?",
												[game2.onlineUrl, game2.id],
												(error, results, fields) => {
											if (error) {
												// TODO - handle error 
											}
										});
									});
								} else {
									_alertGamePlayers2(round, game2, gamePlayers, 0, map);
								}
							}
						});						
					} else {
						_alertGamePlayers2(round, game2, gamePlayers, 0, map);
					}
				});
			})
		});			
	}
	
	function _alertGamePlayers2(round, game, players, playerIdx, map) {
		// Base Case 1
		if (players.length == playerIdx) {
			io.to("Tournament_"+currentTournament.id).emit("gamePaired", JSON.stringify({game: game}));
			return;
		}
		
		var player = players[playerIdx];
		
		// Base Case 2
		/*if (player == null) {
			_alertGamePlayers2(round, game, players, playerIdx+1, map);
			return;
		}*/
		
		// Recursive Case 
		game.heroscapeGamePlayers.push({
			id: player.gamePlayerId,
			playerID: player.id,
			result: null,
			player: {
				id: player.id,
				name: player.name
			}
		});
					
		const subject = currentTournament.name + " " + round.name + " Matchup";
		if (players.length == 1) {
			game.heroscapeGamePlayers[0].result = 2;
			var body = "You have a bye.";
			sendEmail(player.email, subject, body);
			if (currentTournament.teamSize > 1) {
				emailTeammates(player, subject, body);
			}
		} else {		
			var body = "";
			
			if (game.hasOwnProperty('onlineUrl') && game.onlineUrl != null) {
				body += "Game Link : <a href='"+game.onlineUrl+"'>"+game.onlineUrl+"</a><br><br>"; 
			}
			
			if (players.length == 2) {
				body += "Opponent : ";
				var opponent = (players[1].id == player.id 
					? players[0] 
					: players[1]);
				body += opponent.name + 
					" (" + opponent.wins + "-" + opponent.losses + "-" + opponent.ties + ")";
				if (opponent.armies !== undefined && opponent.armies !== null) {
					for (let i = 0; i < opponent.armies.length; i++) {
						body += "<br>Army " + (i+1) + " : " + opponent.armies[i];
					}
				}
			} else {
				// TODO : Look up Army(s) of each Opponent 
				body += "Opponents : ";
				for (let i = 0; i < players.length; i++) {
					if (players[i].id != player.id) {
						body += players[i].name;
						if (i < players.length-1) {
							body += ", ";
						}
					}
				}
			}
			body += "<br><br>Map : " + map.name + " " + map.number;	
			if (map.forStreaming) {
				body += "<br>(STREAMING MAP)";
			}
			dbConnection.query(
					"SELECT * FROM `HeroscapeMap` WHERE `name`=?",
					[map.name.trim()],
					(error, results, fields) => {
				if ( ! error && results.length == 1) {
					const hsMap = results[0];
					if (hsMap.imageUrl != null) {
						body += "<br><img src='"+hsMap.imageUrl+"' width='300'/>";
					}
					if (hsMap.heroscapersLink != null) {
						body += "<br><a href='" + hsMap.heroscapersLink + "' target='_blank'>" + map.name + " Download</a>";
					}
				} 
				const tournamentLink = "https://heroscape.org/events/tournament/?Tournament="+currentTournament.id;
				body += "<br><br><br>Tournament Link:<br><a href='"+tournamentLink+"'>"+tournamentLink+"</a>";
				sendEmail(player.email, subject, body);
				if (currentTournament.teamSize > 1) {
					emailTeammates(player, subject, body);
				}
			});		
		}
		_alertGamePlayers2(round, game, players, playerIdx+1, map);
	}
	
	function emailTeammates(player, subject, body) {
		dbConnection.query(
				"SELECT `User`.`id`, `User`.`email` FROM `Player` INNER JOIN `User` ON `User`.`id` = `Player`.`userID` WHERE `teamCaptainID`=?",
				[player.id],
				(error, results, fields) => {
			if (error) {
				// TODO - Handle error
				return;
			}
			for (let i = 0; i < results.length; i++) {
				const result = results[i];
				const email = result.email;
				sendEmail(email, subject, body);
			}
		});	
	}
	
	
	/** Round Clock Management **/
	
	function startClock(tournament) {
		stopClock();
		var secondsLeft = tournament.roundLengthMinutes * 60;
		roundTimeIntervals[currentTournament.id] = setInterval(function() {
			reduceClock(tournament, secondsLeft--);
		}, 1 * 1000);
	}
	
	function stopClock() {
		if (roundTimeIntervals[currentTournament.id] !== null) {
			clearInterval(roundTimeIntervals[currentTournament.id]);
			roundTimeIntervals[currentTournament.id] = null;
		}
	}
	
	function reduceClock(tournament, secondsLeft) {
		io.to("Tournament_"+tournament.id)
			.emit("setRoundClock", JSON.stringify({secondsLeft: secondsLeft}));
		if (secondsLeft <= 0) {
			stopClock();
		}
	}
	

	/** General Helper Functions **/
	
	function checkLoginAndSetAdmin(type, callbackFcn) {
		try {
			var cookies = cookie.parse(socket.handshake.headers.cookie);
			if ( ! 'hs_key' in cookies) {
				return;
			}
			loginCookie = cookies['hs_key'];
		} catch (error) {
			return;
		}
		dbConnection.query(
				"SELECT `User`.`id`, `User`.`userName`, `User`.`siteAdmin` FROM `User` " +
					"INNER JOIN `LoginCredentials` ON `LoginCredentials`.`userID` = `User`.`id` " +
					"WHERE (`cookie` = ?);",
				[loginCookie],
				(error, results, fields) => {
			if (error) {
				return;
			} 
			if (results.length != 1) {
				return;
			}
			user = results[0];
			
			switch (type) {
				case 1:
					checkAndSetConventionAdmin(user, currentConvention, callbackFcn);
					break;
				case 2:
					checkAndSetTournamentAdmin(user, currentTournament, callbackFcn);
					break;
				case 3:
					checkAndSetLeagueAdmin(user, currentLeague, callbackFcn);
					break;
				case 4:
					checkAndSetLeagueAdmin(user, currentSeason.league, callbackFcn);
					break;
				case 5:
					if (user.siteAdmin) {
						isAdmin = true;
					}
					break;
			}
		});
	}
	
	function checkAndSetTournamentAdmin(user, tournament, callbackFcn) {
		dbConnection.query(
				"SELECT * FROM `Admin` WHERE (`userID` = ? AND `tournamentID` = ?);",
				[user.id, tournament.id],
				(error, results, fields) => {
			if ( ! error) {
				if (results.length > 0) {
					isAdmin = true;
					socket.emit("loadAdmin", JSON.stringify({}));
					callbackFcn();
				} else {
					dbConnection.query(
							"SELECT * FROM `TournamentSeasonLink` " +
								"INNER JOIN `Season` ON `Season`.`id` = `TournamentSeasonLink`.`seasonID` " + 
								"INNER JOIN `League` ON `League`.`id` = `Season`.`leagueID` " + 
								"INNER JOIN `Admin` ON `League`.`id` = `Admin`.`leagueID` " + 
								"WHERE (`TournamentSeasonLink`.`tournamentID`=? AND `userID`=?);",
							[tournament.id, user.id],
							(error, results, fields) => {
						if ( ! error) {
							if (results.length > 0) {
								isAdmin = true;
								socket.emit("loadAdmin", JSON.stringify({}));
								callbackFcn();
							} else {
								dbConnection.query(
										"SELECT * FROM `Tournament` WHERE (`id`=?);",
										[tournament.id],
										(error, results, fields) => {
									if ( ! error) {
										if (results.length > 0) {
											if (results[0].conventionID != null) {
												checkAndSetConventionAdmin(user, {id: results[0].conventionID}, callbackFcn);
											} else {
												callbackFcn();
											}
										}
									}							
								});
							}
						}								
					});
				}				
			} 
		});
	}
	
	function checkAndSetConventionAdmin(user, convention, callbackFcn) {
		dbConnection.query(
				"SELECT * FROM `Admin` WHERE (`userID` = ? AND `conventionID` = ?);",
				[user.id, convention.id],
				(error, results, fields) => {
			if ( ! error) {
				if (results.length > 0) {
					isAdmin = true;
					socket.emit("loadAdmin", JSON.stringify({}));
				}
				callbackFcn();
			}
		});
	}

	function checkAndSetLeagueAdmin(user, league, callbackFcn) {
		dbConnection.query(
				"SELECT * FROM `Admin` WHERE (`userID` = ? AND `leagueID` = ?);",
				[user.id, league.id],
				(error, results, fields) => {
			if ( ! error) {
				if (results.length > 0) {
					isAdmin = true;
					socket.emit("loadAdmin", JSON.stringify({}));
				}
				callbackFcn();
			}
		});
	}

	function sendAnnouncement(announcement, name, emails) {
		announcement = announcement.replaceAll("\n", "<br>");
		for (let i = 0; i < emails.length; i++) {
			sendEmail(emails[i], name + " Announcement", announcement);
		}		
	}
	
	function sendEmail(emailAddress, subject, message) {
		
		message += "<br><br>------------<br>Please DO NOT REPLY to this email. It will not go back to the sender.";
		
		if (emailAddress == null) {
			return; 
		}
		var params = {
			Destination: {
				ToAddresses: [
					emailAddress
				]
			},
			Message: {
				Body: {
					Html: {
						Charset: "UTF-8",
						Data: message
					}
				},
				Subject: {
					Charset: 'UTF-8',
					Data: subject
				}
			},
			Source: 'Heroscape.org@heroscape.org',
			ReplyToAddresses: [
				'chrisperkins.cp@gmail.com'
			],
		};

		// Create the promise and SES service object
		var sendPromise = new AWS.SES({apiVersion: '2010-12-01'}).sendEmail(params).promise();

		// Handle promise's fulfilled/rejected states
		sendPromise.then(
			function(data) {
				// Do nothing
			}).catch(
				function(err) {
					// Do nothing 
		});
	}
	
	function _updateBackupSheet() {
		if (sheetId == null) {
			return;
		}
		var values = [];
		var headers = ["Round","Map"];
		for (let i = 0; i < currentTournament.maxNumPlayersPerGame; i++) {
			headers.push("Player "+(i+1));
			headers.push("Points");
		}
		values.push(headers);
		dbConnection.query(
				"SELECT `Round`.`id`, `Round`.`name` as `roundName`, `Round`.`order`, `Round`.`started`, " +
						"`Game`.`id` as `gameID`, `GameMap`.`name` AS `mapName`, " +
						"`GameMap`.`number` as `mapNumber`, " +
						"`HeroscapeGamePlayer`.`result`, `HeroscapeGamePlayer`.`pointsLeft`, " +
						"`Player`.`name` as `playerName` " +
					"FROM `Round` " +
						"INNER JOIN `Tournament` ON `Tournament`.`id` = `Round`.`tournamentID` " +
						"LEFT JOIN `Game` ON `Game`.`roundID` = `Round`.`id` " + 
						"LEFT JOIN `HeroscapeGame` ON `HeroscapeGame`.`gameID` = `Game`.`id` " + 
						"LEFT JOIN `GameMap` ON `GameMap`.`id` = `HeroscapeGame`.`mapID` " + 
						"LEFT JOIN `HeroscapeGamePlayer` ON `HeroscapeGamePlayer`.`gameID` = `Game`.`id` " + 
						"LEFT JOIN `Player` ON `Player`.`id` = `HeroscapeGamePlayer`.`playerID` " + 
					"WHERE `Tournament`.`id`=? " +
					"ORDER BY `Round`.`order` ASC, `Game`.`id` ASC",
				[currentTournament.id],
				(error, results, fields) => {
			if (error) {
				return;
			}
			var row = [];
			for (let i = 0; i < results.length; i++) {
				if ( ! results[i].started) {
					continue;
				}
				if (row.length == 0) {
					row.push(results[i].roundName);
					if (results[i].mapName != null) {
						row.push(results[i].mapName + " " + results[i].mapNumber);
					} else {
						row.push("--Bye--");
					}
				}
				row.push(results[i].playerName);
				row.push(results[i].result);				
				if (i == results.length - 1 || results[i].gameID != results[i+1].gameID) {
					values.push(row);
					row = [];
				}
			}
			for (let i = 0; i < Math.max(results.length, 50); i++) {
				// This is kinda hacky, but it "erases" any extra lines in the sheet 
					// from a previous iteration, i.e. if a round was deleted 
				values.push(["","","","","",""]);
			}
			writeSheetData(sheetId, "Results", values, true);
		});
	}
	
});

function logToFile(msg) {
	//console.log(msg);
	var logFile = fs.createWriteStream(__dirname + '/debugLog.txt', {flags : 'a'});
	logFile.write(msg + "\n\n");
	logFile.end();
}

http.listen(port, function () {
	// Do nothing
});

//import process from 'node:process';
process.on('uncaughtException', err => {
	console.log(err);
	logToFile("Uncaught Exception: " + err);
	logToFile("    Stack : " + err.stack);
	//process.exit(1);
});