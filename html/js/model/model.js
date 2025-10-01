class ConventionSeriesView extends DatabaseObject {
	constructor(jsonObj) {
		if (ConventionSeriesView.exists(jsonObj)) {
			return ConventionSeriesView.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.ConventionSeries_id = null; // Int
		this.ConventionSeries_name = null; // String
		this.Convention_id = null; // Int
		this.Convention_name = null; // String
		this.Convention_description = null; // String
		this.Convention_startDate = null; // Date
		this.Convention_endDate = null; // Date
		this.Convention_address = null; // String
		this.Convention_conventionSeriesID = null; // Int
		this.Convention_hardPlayerCap = null; // Int
		this.Convention_softPlayerCap = null; // Int
		this.Tournament_id = null; // Int
		this.Tournament_name = null; // String
		this.Tournament_conventionID = null; // Int
		this.Tournament_started = null; // Boolean
		this.Tournament_finished = null; // Boolean
		this.Tournament_teamSize = null; // Int
		this.Tournament_maxNumPlayersPerGame = null; // Int
		this.Tournament_ignoreInStandings = null; // Boolean
		this.HeroscapeTournament_tournamentID = null; // Int
		this.Player_id = null; // Int
		this.Player_name = null; // String
		this.Player_userID = null; // Int
		this.Player_tournamentID = null; // Int
		this.Player_teamCaptainID = null; // Int
		this.User_id = null; // Int
		this.User_userName = null; // String
		this.HeroscapeGamePlayer_id = null; // Int
		this.HeroscapeGamePlayer_playerID = null; // Int
		this.HeroscapeGamePlayer_gameID = null; // Int
		this.HeroscapeGamePlayer_result = null; // Decimal
		this.HeroscapeGamePlayer_pointsLeft = null; // Int
		this.Game_id = null; // Int
		this.HeroscapeGame_gameID = null; // Int
		this.HeroscapeGame_wentToTime = null; // Boolean
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			ConventionSeriesView.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.ConventionSeries_id = jsonObj.ConventionSeries_id;
			this.ConventionSeries_name = jsonObj.ConventionSeries_name;
			this.Convention_id = jsonObj.Convention_id;
			this.Convention_name = jsonObj.Convention_name;
			this.Convention_description = jsonObj.Convention_description;
			this.Convention_startDate = jsonObj.Convention_startDate;
			this.Convention_endDate = jsonObj.Convention_endDate;
			this.Convention_address = jsonObj.Convention_address;
			this.Convention_conventionSeriesID = jsonObj.Convention_conventionSeriesID;
			this.Convention_hardPlayerCap = jsonObj.Convention_hardPlayerCap;
			this.Convention_softPlayerCap = jsonObj.Convention_softPlayerCap;
			this.Tournament_id = jsonObj.Tournament_id;
			this.Tournament_name = jsonObj.Tournament_name;
			this.Tournament_conventionID = jsonObj.Tournament_conventionID;
			this.Tournament_started = jsonObj.Tournament_started;
			this.Tournament_finished = jsonObj.Tournament_finished;
			this.Tournament_teamSize = jsonObj.Tournament_teamSize;
			this.Tournament_maxNumPlayersPerGame = jsonObj.Tournament_maxNumPlayersPerGame;
			this.Tournament_ignoreInStandings = jsonObj.Tournament_ignoreInStandings;
			this.HeroscapeTournament_tournamentID = jsonObj.HeroscapeTournament_tournamentID;
			this.Player_id = jsonObj.Player_id;
			this.Player_name = jsonObj.Player_name;
			this.Player_userID = jsonObj.Player_userID;
			this.Player_tournamentID = jsonObj.Player_tournamentID;
			this.Player_teamCaptainID = jsonObj.Player_teamCaptainID;
			this.User_id = jsonObj.User_id;
			this.User_userName = jsonObj.User_userName;
			this.HeroscapeGamePlayer_id = jsonObj.HeroscapeGamePlayer_id;
			this.HeroscapeGamePlayer_playerID = jsonObj.HeroscapeGamePlayer_playerID;
			this.HeroscapeGamePlayer_gameID = jsonObj.HeroscapeGamePlayer_gameID;
			this.HeroscapeGamePlayer_result = jsonObj.HeroscapeGamePlayer_result;
			this.HeroscapeGamePlayer_pointsLeft = jsonObj.HeroscapeGamePlayer_pointsLeft;
			this.Game_id = jsonObj.Game_id;
			this.HeroscapeGame_gameID = jsonObj.HeroscapeGame_gameID;
			this.HeroscapeGame_wentToTime = jsonObj.HeroscapeGame_wentToTime;
			
			// Links
			
			ConventionSeriesView.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Convention Series View";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "ConventionSeries_id", "ConventionSeries_name", "Convention_id", "Convention_name", "Convention_description", "Convention_startDate", "Convention_endDate", "Convention_address", "Convention_conventionSeriesID", "Convention_hardPlayerCap", "Convention_softPlayerCap", "Tournament_id", "Tournament_name", "Tournament_conventionID", "Tournament_started", "Tournament_finished", "Tournament_teamSize", "Tournament_maxNumPlayersPerGame", "Tournament_ignoreInStandings", "HeroscapeTournament_tournamentID", "Player_id", "Player_name", "Player_userID", "Player_tournamentID", "Player_teamCaptainID", "User_id", "User_userName", "HeroscapeGamePlayer_id", "HeroscapeGamePlayer_playerID", "HeroscapeGamePlayer_gameID", "HeroscapeGamePlayer_result", "HeroscapeGamePlayer_pointsLeft", "Game_id", "HeroscapeGame_gameID", "HeroscapeGame_wentToTime"];
	}

	static getAllFields() {
		return ["id", "ConventionSeries_id", "ConventionSeries_name", "Convention_id", "Convention_name", "Convention_description", "Convention_startDate", "Convention_endDate", "Convention_address", "Convention_conventionSeriesID", "Convention_hardPlayerCap", "Convention_softPlayerCap", "Tournament_id", "Tournament_name", "Tournament_conventionID", "Tournament_started", "Tournament_finished", "Tournament_teamSize", "Tournament_maxNumPlayersPerGame", "Tournament_ignoreInStandings", "HeroscapeTournament_tournamentID", "Player_id", "Player_name", "Player_userID", "Player_tournamentID", "Player_teamCaptainID", "User_id", "User_userName", "HeroscapeGamePlayer_id", "HeroscapeGamePlayer_playerID", "HeroscapeGamePlayer_gameID", "HeroscapeGamePlayer_result", "HeroscapeGamePlayer_pointsLeft", "Game_id", "HeroscapeGame_gameID", "HeroscapeGame_wentToTime"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "ConventionSeries_id", "ConventionSeries_name", "Convention_id", "Convention_name", "Convention_description", "Convention_startDate", "Convention_endDate", "Convention_address", "Convention_conventionSeriesID", "Convention_hardPlayerCap", "Convention_softPlayerCap", "Tournament_id", "Tournament_name", "Tournament_conventionID", "Tournament_started", "Tournament_finished", "Tournament_teamSize", "Tournament_maxNumPlayersPerGame", "Tournament_ignoreInStandings", "HeroscapeTournament_tournamentID", "Player_id", "Player_name", "Player_userID", "Player_tournamentID", "Player_teamCaptainID", "User_id", "User_userName", "HeroscapeGamePlayer_id", "HeroscapeGamePlayer_playerID", "HeroscapeGamePlayer_gameID", "HeroscapeGamePlayer_result", "HeroscapeGamePlayer_pointsLeft", "Game_id", "HeroscapeGame_gameID", "HeroscapeGame_wentToTime"].includes(columnName)) {
			return ConventionSeriesView;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "ConventionSeries_id":
				return null;
			case "ConventionSeries_name":
				return null;
			case "Convention_id":
				return null;
			case "Convention_name":
				return null;
			case "Convention_description":
				return null;
			case "Convention_startDate":
				return null;
			case "Convention_endDate":
				return null;
			case "Convention_address":
				return null;
			case "Convention_conventionSeries":
				return null;
			case "Convention_hardPlayerCap":
				return null;
			case "Convention_softPlayerCap":
				return null;
			case "Tournament_id":
				return null;
			case "Tournament_name":
				return null;
			case "Tournament_convention":
				return null;
			case "Tournament_started":
				return null;
			case "Tournament_finished":
				return null;
			case "Tournament_teamSize":
				return null;
			case "Tournament_maxNumPlayersPerGame":
				return null;
			case "Tournament_ignoreInStandings":
				return null;
			case "HeroscapeTournament_tournament":
				return null;
			case "Player_id":
				return null;
			case "Player_name":
				return null;
			case "Player_user":
				return null;
			case "Player_tournament":
				return null;
			case "Player_teamCaptain":
				return null;
			case "User_id":
				return null;
			case "User_userName":
				return null;
			case "HeroscapeGamePlayer_id":
				return null;
			case "HeroscapeGamePlayer_player":
				return null;
			case "HeroscapeGamePlayer_game":
				return null;
			case "HeroscapeGamePlayer_result":
				return null;
			case "HeroscapeGamePlayer_pointsLeft":
				return null;
			case "Game_id":
				return null;
			case "HeroscapeGame_game":
				return null;
			case "HeroscapeGame_wentToTime":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "ConventionSeries_id":
				return ""; // TODO
			case "ConventionSeries_name":
				return ""; // TODO
			case "Convention_id":
				return ""; // TODO
			case "Convention_name":
				return ""; // TODO
			case "Convention_description":
				return ""; // TODO
			case "Convention_startDate":
				return ""; // TODO
			case "Convention_endDate":
				return ""; // TODO
			case "Convention_address":
				return ""; // TODO
			case "Convention_conventionSeries":
				return ""; // TODO
			case "Convention_hardPlayerCap":
				return ""; // TODO
			case "Convention_softPlayerCap":
				return ""; // TODO
			case "Tournament_id":
				return ""; // TODO
			case "Tournament_name":
				return ""; // TODO
			case "Tournament_convention":
				return ""; // TODO
			case "Tournament_started":
				return ""; // TODO
			case "Tournament_finished":
				return ""; // TODO
			case "Tournament_teamSize":
				return ""; // TODO
			case "Tournament_maxNumPlayersPerGame":
				return ""; // TODO
			case "Tournament_ignoreInStandings":
				return ""; // TODO
			case "HeroscapeTournament_tournament":
				return ""; // TODO
			case "Player_id":
				return ""; // TODO
			case "Player_name":
				return ""; // TODO
			case "Player_user":
				return ""; // TODO
			case "Player_tournament":
				return ""; // TODO
			case "Player_teamCaptain":
				return ""; // TODO
			case "User_id":
				return ""; // TODO
			case "User_userName":
				return ""; // TODO
			case "HeroscapeGamePlayer_id":
				return ""; // TODO
			case "HeroscapeGamePlayer_player":
				return ""; // TODO
			case "HeroscapeGamePlayer_game":
				return ""; // TODO
			case "HeroscapeGamePlayer_result":
				return ""; // TODO
			case "HeroscapeGamePlayer_pointsLeft":
				return ""; // TODO
			case "Game_id":
				return ""; // TODO
			case "HeroscapeGame_game":
				return ""; // TODO
			case "HeroscapeGame_wentToTime":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (ConventionSeriesView.includeField("ConventionSeries_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "ConventionSeries_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Convention Series_id";
			if (this.ConventionSeries_id !== null) {
				fieldData["value"] = this.ConventionSeries_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("ConventionSeries_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "ConventionSeries_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Convention Series_name";
			if (this.ConventionSeries_name !== null) {
				fieldData["value"] = this.ConventionSeries_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Convention_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Convention_id";
			if (this.Convention_id !== null) {
				fieldData["value"] = this.Convention_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Convention_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Convention_name";
			if (this.Convention_name !== null) {
				fieldData["value"] = this.Convention_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Convention_description", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_description";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Convention_description";
			if (this.Convention_description !== null) {
				fieldData["value"] = this.Convention_description;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Convention_startDate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_startDate";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "Convention_start Date";
			if (this.Convention_startDate !== null) {
				fieldData["value"] = this.Convention_startDate;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Convention_endDate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_endDate";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "Convention_end Date";
			if (this.Convention_endDate !== null) {
				fieldData["value"] = this.Convention_endDate;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Convention_address", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_address";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Convention_address";
			if (this.Convention_address !== null) {
				fieldData["value"] = this.Convention_address;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Convention_conventionSeries", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_conventionSeries";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Convention_convention Series ID";
			if (this.Convention_conventionSeries !== null) {
				fieldData["value"] = this.Convention_conventionSeries;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Convention_hardPlayerCap", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_hardPlayerCap";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Convention_hard Player Cap";
			if (this.Convention_hardPlayerCap !== null) {
				fieldData["value"] = this.Convention_hardPlayerCap;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Convention_softPlayerCap", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_softPlayerCap";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Convention_soft Player Cap";
			if (this.Convention_softPlayerCap !== null) {
				fieldData["value"] = this.Convention_softPlayerCap;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Tournament_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_id";
			if (this.Tournament_id !== null) {
				fieldData["value"] = this.Tournament_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Tournament_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Tournament_name";
			if (this.Tournament_name !== null) {
				fieldData["value"] = this.Tournament_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Tournament_convention", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_convention";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_convention ID";
			if (this.Tournament_convention !== null) {
				fieldData["value"] = this.Tournament_convention;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Tournament_started", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_started";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Tournament_started";
			if (this.Tournament_started !== null) {
				fieldData["value"] = this.Tournament_started;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Tournament_finished", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_finished";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Tournament_finished";
			if (this.Tournament_finished !== null) {
				fieldData["value"] = this.Tournament_finished;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Tournament_teamSize", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_teamSize";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_team Size";
			if (this.Tournament_teamSize !== null) {
				fieldData["value"] = this.Tournament_teamSize;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Tournament_maxNumPlayersPerGame", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_maxNumPlayersPerGame";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_max Num Players Per Game";
			if (this.Tournament_maxNumPlayersPerGame !== null) {
				fieldData["value"] = this.Tournament_maxNumPlayersPerGame;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Tournament_ignoreInStandings", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_ignoreInStandings";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Tournament_ignore In Standings";
			if (this.Tournament_ignoreInStandings !== null) {
				fieldData["value"] = this.Tournament_ignoreInStandings;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("HeroscapeTournament_tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_tournament";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_tournament ID";
			if (this.HeroscapeTournament_tournament !== null) {
				fieldData["value"] = this.HeroscapeTournament_tournament;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Player_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player_id";
			if (this.Player_id !== null) {
				fieldData["value"] = this.Player_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Player_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Player_name";
			if (this.Player_name !== null) {
				fieldData["value"] = this.Player_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Player_user", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_user";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player_user ID";
			if (this.Player_user !== null) {
				fieldData["value"] = this.Player_user;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Player_tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_tournament";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player_tournament ID";
			if (this.Player_tournament !== null) {
				fieldData["value"] = this.Player_tournament;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Player_teamCaptain", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_teamCaptain";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player_team Captain ID";
			if (this.Player_teamCaptain !== null) {
				fieldData["value"] = this.Player_teamCaptain;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("User_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "User_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "User_id";
			if (this.User_id !== null) {
				fieldData["value"] = this.User_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("User_userName", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "User_userName";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "User_user Name";
			if (this.User_userName !== null) {
				fieldData["value"] = this.User_userName;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("HeroscapeGamePlayer_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGamePlayer_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Game Player_id";
			if (this.HeroscapeGamePlayer_id !== null) {
				fieldData["value"] = this.HeroscapeGamePlayer_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("HeroscapeGamePlayer_player", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGamePlayer_player";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Game Player_player ID";
			if (this.HeroscapeGamePlayer_player !== null) {
				fieldData["value"] = this.HeroscapeGamePlayer_player;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("HeroscapeGamePlayer_game", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGamePlayer_game";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Game Player_game ID";
			if (this.HeroscapeGamePlayer_game !== null) {
				fieldData["value"] = this.HeroscapeGamePlayer_game;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("HeroscapeGamePlayer_result", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGamePlayer_result";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "any";
			fieldData["label"] = "Heroscape Game Player_result";
			if (this.HeroscapeGamePlayer_result !== null) {
				fieldData["value"] = this.HeroscapeGamePlayer_result;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("HeroscapeGamePlayer_pointsLeft", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGamePlayer_pointsLeft";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Game Player_points Left";
			if (this.HeroscapeGamePlayer_pointsLeft !== null) {
				fieldData["value"] = this.HeroscapeGamePlayer_pointsLeft;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("Game_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Game_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Game_id";
			if (this.Game_id !== null) {
				fieldData["value"] = this.Game_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("HeroscapeGame_game", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGame_game";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Game_game ID";
			if (this.HeroscapeGame_game !== null) {
				fieldData["value"] = this.HeroscapeGame_game;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.includeField("HeroscapeGame_wentToTime", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGame_wentToTime";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Heroscape Game_went To Time";
			if (this.HeroscapeGame_wentToTime !== null) {
				fieldData["value"] = this.HeroscapeGame_wentToTime;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeriesView.options.fieldOrder !== undefined && ConventionSeriesView.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, ConventionSeriesView.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

ConventionSeriesView.list = [];
ConventionSeriesView.options = [];

class HeadToHeadRecordsView extends DatabaseObject {
	constructor(jsonObj) {
		if (HeadToHeadRecordsView.exists(jsonObj)) {
			return HeadToHeadRecordsView.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.player1 = null; // String
		this.player2 = null; // String
		this.games = null; // Int
		this.wins = null; // Int
		this.losses = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			HeadToHeadRecordsView.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.player1 = jsonObj.player1;
			this.player2 = jsonObj.player2;
			this.games = jsonObj.games;
			this.wins = jsonObj.wins;
			this.losses = jsonObj.losses;
			
			// Links
			
			HeadToHeadRecordsView.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Head To Head Records View";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "player1", "player2", "games", "wins", "losses"];
	}

	static getAllFields() {
		return ["id", "player1", "player2", "games", "wins", "losses"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "player1", "player2", "games", "wins", "losses"].includes(columnName)) {
			return HeadToHeadRecordsView;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "player1":
				return null;
			case "player2":
				return null;
			case "games":
				return null;
			case "wins":
				return null;
			case "losses":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "player1":
				return ""; // TODO
			case "player2":
				return ""; // TODO
			case "games":
				return ""; // TODO
			case "wins":
				return ""; // TODO
			case "losses":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (HeadToHeadRecordsView.includeField("player1", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "player1";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Player1";
			if (this.player1 !== null) {
				fieldData["value"] = this.player1;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeadToHeadRecordsView.includeField("player2", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "player2";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Player2";
			if (this.player2 !== null) {
				fieldData["value"] = this.player2;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeadToHeadRecordsView.includeField("games", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "games";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Games";
			if (this.games !== null) {
				fieldData["value"] = this.games;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeadToHeadRecordsView.includeField("wins", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "wins";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Wins";
			if (this.wins !== null) {
				fieldData["value"] = this.wins;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeadToHeadRecordsView.includeField("losses", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "losses";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Losses";
			if (this.losses !== null) {
				fieldData["value"] = this.losses;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeadToHeadRecordsView.options.fieldOrder !== undefined && HeadToHeadRecordsView.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, HeadToHeadRecordsView.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

HeadToHeadRecordsView.list = [];
HeadToHeadRecordsView.options = [];

class TournamentOverviewView extends DatabaseObject {
	constructor(jsonObj) {
		if (TournamentOverviewView.exists(jsonObj)) {
			return TournamentOverviewView.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.HeroscapeTournament_tournamentID = null; // Int
		this.HeroscapeTournament_numArmies = null; // Int
		this.HeroscapeTournament_allowedPointOverlap = null; // Int
		this.HeroscapeTournament_pointLimit = null; // Int
		this.HeroscapeTournament_hexLimit = null; // Int
		this.HeroscapeTournament_figureLimit = null; // Int
		this.HeroscapeTournament_useDeltaPricing = null; // Boolean
		this.HeroscapeTournament_includeVC = null; // Boolean
		this.HeroscapeTournament_includeMarvel = null; // Boolean
		this.Tournament_id = null; // Int
		this.Tournament_name = null; // String
		this.Tournament_description = null; // String
		this.Tournament_conventionID = null; // Int
		this.Tournament_startTime = null; // Datetime
		this.Tournament_endDate = null; // Date
		this.Tournament_address = null; // String
		this.Tournament_started = null; // Boolean
		this.Tournament_finished = null; // Boolean
		this.Tournament_online = null; // Boolean
		this.Tournament_maxEntries = null; // Int
		this.Tournament_teamSize = null; // Int
		this.Tournament_maxNumPlayersPerGame = null; // Int
		this.Tournament_numLossesToBeEliminated = null; // Int
		this.Tournament_pairAfterEliminated = null; // Boolean
		this.Tournament_roundLengthMinutes = null; // Int
		this.Tournament_ignoreInStandings = null; // Boolean
		this.Season_id = null; // Int
		this.Season_name = null; // String
		this.Season_leagueID = null; // Int
		this.Season_start = null; // Date
		this.Season_end = null; // Date
		this.Season_description = null; // String
		this.League_id = null; // Int
		this.League_name = null; // String
		this.League_description = null; // String
		this.Convention_id = null; // Int
		this.Convention_name = null; // String
		this.Convention_description = null; // String
		this.Convention_startDate = null; // Date
		this.Convention_endDate = null; // Date
		this.Convention_address = null; // String
		this.Convention_conventionSeriesID = null; // Int
		this.Convention_hardPlayerCap = null; // Int
		this.Convention_softPlayerCap = null; // Int
		this.ConventionSeries_id = null; // Int
		this.ConventionSeries_name = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			TournamentOverviewView.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.HeroscapeTournament_tournamentID = jsonObj.HeroscapeTournament_tournamentID;
			this.HeroscapeTournament_numArmies = jsonObj.HeroscapeTournament_numArmies;
			this.HeroscapeTournament_allowedPointOverlap = jsonObj.HeroscapeTournament_allowedPointOverlap;
			this.HeroscapeTournament_pointLimit = jsonObj.HeroscapeTournament_pointLimit;
			this.HeroscapeTournament_hexLimit = jsonObj.HeroscapeTournament_hexLimit;
			this.HeroscapeTournament_figureLimit = jsonObj.HeroscapeTournament_figureLimit;
			this.HeroscapeTournament_useDeltaPricing = jsonObj.HeroscapeTournament_useDeltaPricing;
			this.HeroscapeTournament_includeVC = jsonObj.HeroscapeTournament_includeVC;
			this.HeroscapeTournament_includeMarvel = jsonObj.HeroscapeTournament_includeMarvel;
			this.Tournament_id = jsonObj.Tournament_id;
			this.Tournament_name = jsonObj.Tournament_name;
			this.Tournament_description = jsonObj.Tournament_description;
			this.Tournament_conventionID = jsonObj.Tournament_conventionID;
			this.Tournament_startTime = jsonObj.Tournament_startTime;
			this.Tournament_endDate = jsonObj.Tournament_endDate;
			this.Tournament_address = jsonObj.Tournament_address;
			this.Tournament_started = jsonObj.Tournament_started;
			this.Tournament_finished = jsonObj.Tournament_finished;
			this.Tournament_online = jsonObj.Tournament_online;
			this.Tournament_maxEntries = jsonObj.Tournament_maxEntries;
			this.Tournament_teamSize = jsonObj.Tournament_teamSize;
			this.Tournament_maxNumPlayersPerGame = jsonObj.Tournament_maxNumPlayersPerGame;
			this.Tournament_numLossesToBeEliminated = jsonObj.Tournament_numLossesToBeEliminated;
			this.Tournament_pairAfterEliminated = jsonObj.Tournament_pairAfterEliminated;
			this.Tournament_roundLengthMinutes = jsonObj.Tournament_roundLengthMinutes;
			this.Tournament_ignoreInStandings = jsonObj.Tournament_ignoreInStandings;
			this.Season_id = jsonObj.Season_id;
			this.Season_name = jsonObj.Season_name;
			this.Season_leagueID = jsonObj.Season_leagueID;
			this.Season_start = jsonObj.Season_start;
			this.Season_end = jsonObj.Season_end;
			this.Season_description = jsonObj.Season_description;
			this.League_id = jsonObj.League_id;
			this.League_name = jsonObj.League_name;
			this.League_description = jsonObj.League_description;
			this.Convention_id = jsonObj.Convention_id;
			this.Convention_name = jsonObj.Convention_name;
			this.Convention_description = jsonObj.Convention_description;
			this.Convention_startDate = jsonObj.Convention_startDate;
			this.Convention_endDate = jsonObj.Convention_endDate;
			this.Convention_address = jsonObj.Convention_address;
			this.Convention_conventionSeriesID = jsonObj.Convention_conventionSeriesID;
			this.Convention_hardPlayerCap = jsonObj.Convention_hardPlayerCap;
			this.Convention_softPlayerCap = jsonObj.Convention_softPlayerCap;
			this.ConventionSeries_id = jsonObj.ConventionSeries_id;
			this.ConventionSeries_name = jsonObj.ConventionSeries_name;
			
			// Links
			
			TournamentOverviewView.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Tournament Overview View";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "HeroscapeTournament_tournamentID", "HeroscapeTournament_numArmies", "HeroscapeTournament_allowedPointOverlap", "HeroscapeTournament_pointLimit", "HeroscapeTournament_hexLimit", "HeroscapeTournament_figureLimit", "HeroscapeTournament_useDeltaPricing", "HeroscapeTournament_includeVC", "HeroscapeTournament_includeMarvel", "Tournament_id", "Tournament_name", "Tournament_description", "Tournament_conventionID", "Tournament_startTime", "Tournament_endDate", "Tournament_address", "Tournament_started", "Tournament_finished", "Tournament_online", "Tournament_maxEntries", "Tournament_teamSize", "Tournament_maxNumPlayersPerGame", "Tournament_numLossesToBeEliminated", "Tournament_pairAfterEliminated", "Tournament_roundLengthMinutes", "Tournament_ignoreInStandings", "Season_id", "Season_name", "Season_leagueID", "Season_start", "Season_end", "Season_description", "League_id", "League_name", "League_description", "Convention_id", "Convention_name", "Convention_description", "Convention_startDate", "Convention_endDate", "Convention_address", "Convention_conventionSeriesID", "Convention_hardPlayerCap", "Convention_softPlayerCap", "ConventionSeries_id", "ConventionSeries_name"];
	}

	static getAllFields() {
		return ["id", "HeroscapeTournament_tournamentID", "HeroscapeTournament_numArmies", "HeroscapeTournament_allowedPointOverlap", "HeroscapeTournament_pointLimit", "HeroscapeTournament_hexLimit", "HeroscapeTournament_figureLimit", "HeroscapeTournament_useDeltaPricing", "HeroscapeTournament_includeVC", "HeroscapeTournament_includeMarvel", "Tournament_id", "Tournament_name", "Tournament_description", "Tournament_conventionID", "Tournament_startTime", "Tournament_endDate", "Tournament_address", "Tournament_started", "Tournament_finished", "Tournament_online", "Tournament_maxEntries", "Tournament_teamSize", "Tournament_maxNumPlayersPerGame", "Tournament_numLossesToBeEliminated", "Tournament_pairAfterEliminated", "Tournament_roundLengthMinutes", "Tournament_ignoreInStandings", "Season_id", "Season_name", "Season_leagueID", "Season_start", "Season_end", "Season_description", "League_id", "League_name", "League_description", "Convention_id", "Convention_name", "Convention_description", "Convention_startDate", "Convention_endDate", "Convention_address", "Convention_conventionSeriesID", "Convention_hardPlayerCap", "Convention_softPlayerCap", "ConventionSeries_id", "ConventionSeries_name"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "HeroscapeTournament_tournamentID", "HeroscapeTournament_numArmies", "HeroscapeTournament_allowedPointOverlap", "HeroscapeTournament_pointLimit", "HeroscapeTournament_hexLimit", "HeroscapeTournament_figureLimit", "HeroscapeTournament_useDeltaPricing", "HeroscapeTournament_includeVC", "HeroscapeTournament_includeMarvel", "Tournament_id", "Tournament_name", "Tournament_description", "Tournament_conventionID", "Tournament_startTime", "Tournament_endDate", "Tournament_address", "Tournament_started", "Tournament_finished", "Tournament_online", "Tournament_maxEntries", "Tournament_teamSize", "Tournament_maxNumPlayersPerGame", "Tournament_numLossesToBeEliminated", "Tournament_pairAfterEliminated", "Tournament_roundLengthMinutes", "Tournament_ignoreInStandings", "Season_id", "Season_name", "Season_leagueID", "Season_start", "Season_end", "Season_description", "League_id", "League_name", "League_description", "Convention_id", "Convention_name", "Convention_description", "Convention_startDate", "Convention_endDate", "Convention_address", "Convention_conventionSeriesID", "Convention_hardPlayerCap", "Convention_softPlayerCap", "ConventionSeries_id", "ConventionSeries_name"].includes(columnName)) {
			return TournamentOverviewView;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "HeroscapeTournament_tournament":
				return null;
			case "HeroscapeTournament_numArmies":
				return null;
			case "HeroscapeTournament_allowedPointOverlap":
				return null;
			case "HeroscapeTournament_pointLimit":
				return null;
			case "HeroscapeTournament_hexLimit":
				return null;
			case "HeroscapeTournament_figureLimit":
				return null;
			case "HeroscapeTournament_useDeltaPricing":
				return null;
			case "HeroscapeTournament_includeVC":
				return null;
			case "HeroscapeTournament_includeMarvel":
				return null;
			case "Tournament_id":
				return null;
			case "Tournament_name":
				return null;
			case "Tournament_description":
				return null;
			case "Tournament_convention":
				return null;
			case "Tournament_startTime":
				return null;
			case "Tournament_endDate":
				return null;
			case "Tournament_address":
				return null;
			case "Tournament_started":
				return null;
			case "Tournament_finished":
				return null;
			case "Tournament_online":
				return null;
			case "Tournament_maxEntries":
				return null;
			case "Tournament_teamSize":
				return null;
			case "Tournament_maxNumPlayersPerGame":
				return null;
			case "Tournament_numLossesToBeEliminated":
				return null;
			case "Tournament_pairAfterEliminated":
				return null;
			case "Tournament_roundLengthMinutes":
				return null;
			case "Tournament_ignoreInStandings":
				return null;
			case "Season_id":
				return null;
			case "Season_name":
				return null;
			case "Season_league":
				return null;
			case "Season_start":
				return null;
			case "Season_end":
				return null;
			case "Season_description":
				return null;
			case "League_id":
				return null;
			case "League_name":
				return null;
			case "League_description":
				return null;
			case "Convention_id":
				return null;
			case "Convention_name":
				return null;
			case "Convention_description":
				return null;
			case "Convention_startDate":
				return null;
			case "Convention_endDate":
				return null;
			case "Convention_address":
				return null;
			case "Convention_conventionSeries":
				return null;
			case "Convention_hardPlayerCap":
				return null;
			case "Convention_softPlayerCap":
				return null;
			case "ConventionSeries_id":
				return null;
			case "ConventionSeries_name":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "HeroscapeTournament_tournament":
				return ""; // TODO
			case "HeroscapeTournament_numArmies":
				return ""; // TODO
			case "HeroscapeTournament_allowedPointOverlap":
				return ""; // TODO
			case "HeroscapeTournament_pointLimit":
				return ""; // TODO
			case "HeroscapeTournament_hexLimit":
				return ""; // TODO
			case "HeroscapeTournament_figureLimit":
				return ""; // TODO
			case "HeroscapeTournament_useDeltaPricing":
				return ""; // TODO
			case "HeroscapeTournament_includeVC":
				return ""; // TODO
			case "HeroscapeTournament_includeMarvel":
				return ""; // TODO
			case "Tournament_id":
				return ""; // TODO
			case "Tournament_name":
				return ""; // TODO
			case "Tournament_description":
				return ""; // TODO
			case "Tournament_convention":
				return ""; // TODO
			case "Tournament_startTime":
				return ""; // TODO
			case "Tournament_endDate":
				return ""; // TODO
			case "Tournament_address":
				return ""; // TODO
			case "Tournament_started":
				return ""; // TODO
			case "Tournament_finished":
				return ""; // TODO
			case "Tournament_online":
				return ""; // TODO
			case "Tournament_maxEntries":
				return ""; // TODO
			case "Tournament_teamSize":
				return ""; // TODO
			case "Tournament_maxNumPlayersPerGame":
				return ""; // TODO
			case "Tournament_numLossesToBeEliminated":
				return ""; // TODO
			case "Tournament_pairAfterEliminated":
				return ""; // TODO
			case "Tournament_roundLengthMinutes":
				return ""; // TODO
			case "Tournament_ignoreInStandings":
				return ""; // TODO
			case "Season_id":
				return ""; // TODO
			case "Season_name":
				return ""; // TODO
			case "Season_league":
				return ""; // TODO
			case "Season_start":
				return ""; // TODO
			case "Season_end":
				return ""; // TODO
			case "Season_description":
				return ""; // TODO
			case "League_id":
				return ""; // TODO
			case "League_name":
				return ""; // TODO
			case "League_description":
				return ""; // TODO
			case "Convention_id":
				return ""; // TODO
			case "Convention_name":
				return ""; // TODO
			case "Convention_description":
				return ""; // TODO
			case "Convention_startDate":
				return ""; // TODO
			case "Convention_endDate":
				return ""; // TODO
			case "Convention_address":
				return ""; // TODO
			case "Convention_conventionSeries":
				return ""; // TODO
			case "Convention_hardPlayerCap":
				return ""; // TODO
			case "Convention_softPlayerCap":
				return ""; // TODO
			case "ConventionSeries_id":
				return ""; // TODO
			case "ConventionSeries_name":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (TournamentOverviewView.includeField("HeroscapeTournament_tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_tournament";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_tournament ID";
			if (this.HeroscapeTournament_tournament !== null) {
				fieldData["value"] = this.HeroscapeTournament_tournament;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("HeroscapeTournament_numArmies", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_numArmies";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_num Armies";
			if (this.HeroscapeTournament_numArmies !== null) {
				fieldData["value"] = this.HeroscapeTournament_numArmies;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("HeroscapeTournament_allowedPointOverlap", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_allowedPointOverlap";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_allowed Point Overlap";
			if (this.HeroscapeTournament_allowedPointOverlap !== null) {
				fieldData["value"] = this.HeroscapeTournament_allowedPointOverlap;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("HeroscapeTournament_pointLimit", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_pointLimit";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_point Limit";
			if (this.HeroscapeTournament_pointLimit !== null) {
				fieldData["value"] = this.HeroscapeTournament_pointLimit;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("HeroscapeTournament_hexLimit", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_hexLimit";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_hex Limit";
			if (this.HeroscapeTournament_hexLimit !== null) {
				fieldData["value"] = this.HeroscapeTournament_hexLimit;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("HeroscapeTournament_figureLimit", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_figureLimit";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_figure Limit";
			if (this.HeroscapeTournament_figureLimit !== null) {
				fieldData["value"] = this.HeroscapeTournament_figureLimit;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("HeroscapeTournament_useDeltaPricing", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_useDeltaPricing";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Heroscape Tournament_use Delta Pricing";
			if (this.HeroscapeTournament_useDeltaPricing !== null) {
				fieldData["value"] = this.HeroscapeTournament_useDeltaPricing;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("HeroscapeTournament_includeVC", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_includeVC";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Heroscape Tournament_include VC";
			if (this.HeroscapeTournament_includeVC !== null) {
				fieldData["value"] = this.HeroscapeTournament_includeVC;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("HeroscapeTournament_includeMarvel", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_includeMarvel";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Heroscape Tournament_include Marvel";
			if (this.HeroscapeTournament_includeMarvel !== null) {
				fieldData["value"] = this.HeroscapeTournament_includeMarvel;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_id";
			if (this.Tournament_id !== null) {
				fieldData["value"] = this.Tournament_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Tournament_name";
			if (this.Tournament_name !== null) {
				fieldData["value"] = this.Tournament_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_description", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_description";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Tournament_description";
			if (this.Tournament_description !== null) {
				fieldData["value"] = this.Tournament_description;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_convention", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_convention";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_convention ID";
			if (this.Tournament_convention !== null) {
				fieldData["value"] = this.Tournament_convention;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_startTime", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_startTime";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "datetime-local";
			fieldData["label"] = "Tournament_start Time";
			if (this.Tournament_startTime !== null) {
				fieldData["value"] = forEditing ? this.Tournament_startTime.replace(' ','T') : new Date(this.Tournament_startTime).toString();
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_endDate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_endDate";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "Tournament_end Date";
			if (this.Tournament_endDate !== null) {
				fieldData["value"] = this.Tournament_endDate;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_address", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_address";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Tournament_address";
			if (this.Tournament_address !== null) {
				fieldData["value"] = this.Tournament_address;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_started", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_started";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Tournament_started";
			if (this.Tournament_started !== null) {
				fieldData["value"] = this.Tournament_started;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_finished", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_finished";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Tournament_finished";
			if (this.Tournament_finished !== null) {
				fieldData["value"] = this.Tournament_finished;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_online", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_online";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Tournament_online";
			if (this.Tournament_online !== null) {
				fieldData["value"] = this.Tournament_online;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_maxEntries", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_maxEntries";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_max Entries";
			if (this.Tournament_maxEntries !== null) {
				fieldData["value"] = this.Tournament_maxEntries;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_teamSize", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_teamSize";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_team Size";
			if (this.Tournament_teamSize !== null) {
				fieldData["value"] = this.Tournament_teamSize;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_maxNumPlayersPerGame", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_maxNumPlayersPerGame";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_max Num Players Per Game";
			if (this.Tournament_maxNumPlayersPerGame !== null) {
				fieldData["value"] = this.Tournament_maxNumPlayersPerGame;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_numLossesToBeEliminated", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_numLossesToBeEliminated";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_num Losses To Be Eliminated";
			if (this.Tournament_numLossesToBeEliminated !== null) {
				fieldData["value"] = this.Tournament_numLossesToBeEliminated;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_pairAfterEliminated", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_pairAfterEliminated";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Tournament_pair After Eliminated";
			if (this.Tournament_pairAfterEliminated !== null) {
				fieldData["value"] = this.Tournament_pairAfterEliminated;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_roundLengthMinutes", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_roundLengthMinutes";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_round Length Minutes";
			if (this.Tournament_roundLengthMinutes !== null) {
				fieldData["value"] = this.Tournament_roundLengthMinutes;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Tournament_ignoreInStandings", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_ignoreInStandings";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Tournament_ignore In Standings";
			if (this.Tournament_ignoreInStandings !== null) {
				fieldData["value"] = this.Tournament_ignoreInStandings;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Season_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Season_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Season_id";
			if (this.Season_id !== null) {
				fieldData["value"] = this.Season_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Season_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Season_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Season_name";
			if (this.Season_name !== null) {
				fieldData["value"] = this.Season_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Season_league", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Season_league";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Season_league ID";
			if (this.Season_league !== null) {
				fieldData["value"] = this.Season_league;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Season_start", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Season_start";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "Season_start";
			if (this.Season_start !== null) {
				fieldData["value"] = this.Season_start;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Season_end", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Season_end";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "Season_end";
			if (this.Season_end !== null) {
				fieldData["value"] = this.Season_end;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Season_description", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Season_description";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Season_description";
			if (this.Season_description !== null) {
				fieldData["value"] = this.Season_description;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("League_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "League_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "League_id";
			if (this.League_id !== null) {
				fieldData["value"] = this.League_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("League_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "League_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "League_name";
			if (this.League_name !== null) {
				fieldData["value"] = this.League_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("League_description", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "League_description";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "League_description";
			if (this.League_description !== null) {
				fieldData["value"] = this.League_description;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Convention_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Convention_id";
			if (this.Convention_id !== null) {
				fieldData["value"] = this.Convention_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Convention_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Convention_name";
			if (this.Convention_name !== null) {
				fieldData["value"] = this.Convention_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Convention_description", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_description";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Convention_description";
			if (this.Convention_description !== null) {
				fieldData["value"] = this.Convention_description;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Convention_startDate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_startDate";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "Convention_start Date";
			if (this.Convention_startDate !== null) {
				fieldData["value"] = this.Convention_startDate;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Convention_endDate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_endDate";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "Convention_end Date";
			if (this.Convention_endDate !== null) {
				fieldData["value"] = this.Convention_endDate;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Convention_address", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_address";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Convention_address";
			if (this.Convention_address !== null) {
				fieldData["value"] = this.Convention_address;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Convention_conventionSeries", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_conventionSeries";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Convention_convention Series ID";
			if (this.Convention_conventionSeries !== null) {
				fieldData["value"] = this.Convention_conventionSeries;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Convention_hardPlayerCap", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_hardPlayerCap";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Convention_hard Player Cap";
			if (this.Convention_hardPlayerCap !== null) {
				fieldData["value"] = this.Convention_hardPlayerCap;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("Convention_softPlayerCap", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_softPlayerCap";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Convention_soft Player Cap";
			if (this.Convention_softPlayerCap !== null) {
				fieldData["value"] = this.Convention_softPlayerCap;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("ConventionSeries_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "ConventionSeries_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Convention Series_id";
			if (this.ConventionSeries_id !== null) {
				fieldData["value"] = this.ConventionSeries_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.includeField("ConventionSeries_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "ConventionSeries_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Convention Series_name";
			if (this.ConventionSeries_name !== null) {
				fieldData["value"] = this.ConventionSeries_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentOverviewView.options.fieldOrder !== undefined && TournamentOverviewView.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, TournamentOverviewView.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

TournamentOverviewView.list = [];
TournamentOverviewView.options = [];

class ConventionTournamentResultsView extends DatabaseObject {
	constructor(jsonObj) {
		if (ConventionTournamentResultsView.exists(jsonObj)) {
			return ConventionTournamentResultsView.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.Convention_id = null; // Int
		this.Tournament_id = null; // Int
		this.Tournament_name = null; // String
		this.Tournament_description = null; // String
		this.Tournament_conventionID = null; // Int
		this.Tournament_startTime = null; // Datetime
		this.Tournament_endDate = null; // Date
		this.Tournament_started = null; // Boolean
		this.Tournament_finished = null; // Boolean
		this.Tournament_allowSignupAfter = null; // Datetime
		this.Tournament_allowLateSignup = null; // Datetime
		this.Tournament_online = null; // Boolean
		this.Tournament_maxEntries = null; // Int
		this.Tournament_teamSize = null; // Int
		this.Tournament_maxNumPlayersPerGame = null; // Int
		this.Tournament_roundLengthMinutes = null; // Int
		this.Tournament_ignoreInStandings = null; // Boolean
		this.HeroscapeTournament_tournamentID = null; // Int
		this.HeroscapeTournament_numArmies = null; // Int
		this.HeroscapeTournament_pointLimit = null; // Int
		this.HeroscapeTournament_hexLimit = null; // Int
		this.HeroscapeTournament_figureLimit = null; // Int
		this.HeroscapeTournament_useDeltaPricing = null; // Boolean
		this.HeroscapeTournament_includeVC = null; // Boolean
		this.HeroscapeTournament_includeMarvel = null; // Boolean
		this.Round_id = null; // Int
		this.Round_tournamentID = null; // Int
		this.Round_name = null; // String
		this.Round_order = null; // Int
		this.Round_started = null; // Boolean
		this.Game_id = null; // Int
		this.Game_roundID = null; // Int
		this.HeroscapeGame_gameID = null; // Int
		this.HeroscapeGame_mapID = null; // Int
		this.HeroscapeGame_wentToTime = null; // Boolean
		this.GameMap_id = null; // Int
		this.GameMap_name = null; // String
		this.GameMap_number = null; // Int
		this.GameMap_tournamentID = null; // Int
		this.HeroscapeGamePlayer_id = null; // Int
		this.HeroscapeGamePlayer_playerID = null; // Int
		this.HeroscapeGamePlayer_gameID = null; // Int
		this.HeroscapeGamePlayer_result = null; // Int
		this.HeroscapeGamePlayer_pointsLeft = null; // Int
		this.Player_id = null; // Int
		this.Player_name = null; // String
		this.Player_userID = null; // Int
		this.Player_tournamentID = null; // Int
		this.Player_teamCaptainID = null; // Int
		this.Player_active = null; // Boolean
		this.User_id = null; // Int
		this.User_userName = null; // String
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			ConventionTournamentResultsView.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.Convention_id = jsonObj.Convention_id;
			this.Tournament_id = jsonObj.Tournament_id;
			this.Tournament_name = jsonObj.Tournament_name;
			this.Tournament_description = jsonObj.Tournament_description;
			this.Tournament_conventionID = jsonObj.Tournament_conventionID;
			this.Tournament_startTime = jsonObj.Tournament_startTime;
			this.Tournament_endDate = jsonObj.Tournament_endDate;
			this.Tournament_started = jsonObj.Tournament_started;
			this.Tournament_finished = jsonObj.Tournament_finished;
			this.Tournament_allowSignupAfter = jsonObj.Tournament_allowSignupAfter;
			this.Tournament_allowLateSignup = jsonObj.Tournament_allowLateSignup;
			this.Tournament_online = jsonObj.Tournament_online;
			this.Tournament_maxEntries = jsonObj.Tournament_maxEntries;
			this.Tournament_teamSize = jsonObj.Tournament_teamSize;
			this.Tournament_maxNumPlayersPerGame = jsonObj.Tournament_maxNumPlayersPerGame;
			this.Tournament_roundLengthMinutes = jsonObj.Tournament_roundLengthMinutes;
			this.Tournament_ignoreInStandings = jsonObj.Tournament_ignoreInStandings;
			this.HeroscapeTournament_tournamentID = jsonObj.HeroscapeTournament_tournamentID;
			this.HeroscapeTournament_numArmies = jsonObj.HeroscapeTournament_numArmies;
			this.HeroscapeTournament_pointLimit = jsonObj.HeroscapeTournament_pointLimit;
			this.HeroscapeTournament_hexLimit = jsonObj.HeroscapeTournament_hexLimit;
			this.HeroscapeTournament_figureLimit = jsonObj.HeroscapeTournament_figureLimit;
			this.HeroscapeTournament_useDeltaPricing = jsonObj.HeroscapeTournament_useDeltaPricing;
			this.HeroscapeTournament_includeVC = jsonObj.HeroscapeTournament_includeVC;
			this.HeroscapeTournament_includeMarvel = jsonObj.HeroscapeTournament_includeMarvel;
			this.Round_id = jsonObj.Round_id;
			this.Round_tournamentID = jsonObj.Round_tournamentID;
			this.Round_name = jsonObj.Round_name;
			this.Round_order = jsonObj.Round_order;
			this.Round_started = jsonObj.Round_started;
			this.Game_id = jsonObj.Game_id;
			this.Game_roundID = jsonObj.Game_roundID;
			this.HeroscapeGame_gameID = jsonObj.HeroscapeGame_gameID;
			this.HeroscapeGame_mapID = jsonObj.HeroscapeGame_mapID;
			this.HeroscapeGame_wentToTime = jsonObj.HeroscapeGame_wentToTime;
			this.GameMap_id = jsonObj.GameMap_id;
			this.GameMap_name = jsonObj.GameMap_name;
			this.GameMap_number = jsonObj.GameMap_number;
			this.GameMap_tournamentID = jsonObj.GameMap_tournamentID;
			this.HeroscapeGamePlayer_id = jsonObj.HeroscapeGamePlayer_id;
			this.HeroscapeGamePlayer_playerID = jsonObj.HeroscapeGamePlayer_playerID;
			this.HeroscapeGamePlayer_gameID = jsonObj.HeroscapeGamePlayer_gameID;
			this.HeroscapeGamePlayer_result = jsonObj.HeroscapeGamePlayer_result;
			this.HeroscapeGamePlayer_pointsLeft = jsonObj.HeroscapeGamePlayer_pointsLeft;
			this.Player_id = jsonObj.Player_id;
			this.Player_name = jsonObj.Player_name;
			this.Player_userID = jsonObj.Player_userID;
			this.Player_tournamentID = jsonObj.Player_tournamentID;
			this.Player_teamCaptainID = jsonObj.Player_teamCaptainID;
			this.Player_active = jsonObj.Player_active;
			this.User_id = jsonObj.User_id;
			this.User_userName = jsonObj.User_userName;
			
			// Links
			
			ConventionTournamentResultsView.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Convention Tournament Results View";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "Convention_id", "Tournament_id", "Tournament_name", "Tournament_description", "Tournament_conventionID", "Tournament_startTime", "Tournament_endDate", "Tournament_started", "Tournament_finished", "Tournament_allowSignupAfter", "Tournament_allowLateSignup", "Tournament_online", "Tournament_maxEntries", "Tournament_teamSize", "Tournament_maxNumPlayersPerGame", "Tournament_roundLengthMinutes", "Tournament_ignoreInStandings", "HeroscapeTournament_tournamentID", "HeroscapeTournament_numArmies", "HeroscapeTournament_pointLimit", "HeroscapeTournament_hexLimit", "HeroscapeTournament_figureLimit", "HeroscapeTournament_useDeltaPricing", "HeroscapeTournament_includeVC", "HeroscapeTournament_includeMarvel", "Round_id", "Round_tournamentID", "Round_name", "Round_order", "Round_started", "Game_id", "Game_roundID", "HeroscapeGame_gameID", "HeroscapeGame_mapID", "HeroscapeGame_wentToTime", "GameMap_id", "GameMap_name", "GameMap_number", "GameMap_tournamentID", "HeroscapeGamePlayer_id", "HeroscapeGamePlayer_playerID", "HeroscapeGamePlayer_gameID", "HeroscapeGamePlayer_result", "HeroscapeGamePlayer_pointsLeft", "Player_id", "Player_name", "Player_userID", "Player_tournamentID", "Player_teamCaptainID", "Player_active", "User_id", "User_userName"];
	}

	static getAllFields() {
		return ["id", "Convention_id", "Tournament_id", "Tournament_name", "Tournament_description", "Tournament_conventionID", "Tournament_startTime", "Tournament_endDate", "Tournament_started", "Tournament_finished", "Tournament_allowSignupAfter", "Tournament_allowLateSignup", "Tournament_online", "Tournament_maxEntries", "Tournament_teamSize", "Tournament_maxNumPlayersPerGame", "Tournament_roundLengthMinutes", "Tournament_ignoreInStandings", "HeroscapeTournament_tournamentID", "HeroscapeTournament_numArmies", "HeroscapeTournament_pointLimit", "HeroscapeTournament_hexLimit", "HeroscapeTournament_figureLimit", "HeroscapeTournament_useDeltaPricing", "HeroscapeTournament_includeVC", "HeroscapeTournament_includeMarvel", "Round_id", "Round_tournamentID", "Round_name", "Round_order", "Round_started", "Game_id", "Game_roundID", "HeroscapeGame_gameID", "HeroscapeGame_mapID", "HeroscapeGame_wentToTime", "GameMap_id", "GameMap_name", "GameMap_number", "GameMap_tournamentID", "HeroscapeGamePlayer_id", "HeroscapeGamePlayer_playerID", "HeroscapeGamePlayer_gameID", "HeroscapeGamePlayer_result", "HeroscapeGamePlayer_pointsLeft", "Player_id", "Player_name", "Player_userID", "Player_tournamentID", "Player_teamCaptainID", "Player_active", "User_id", "User_userName"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "Convention_id", "Tournament_id", "Tournament_name", "Tournament_description", "Tournament_conventionID", "Tournament_startTime", "Tournament_endDate", "Tournament_started", "Tournament_finished", "Tournament_allowSignupAfter", "Tournament_allowLateSignup", "Tournament_online", "Tournament_maxEntries", "Tournament_teamSize", "Tournament_maxNumPlayersPerGame", "Tournament_roundLengthMinutes", "Tournament_ignoreInStandings", "HeroscapeTournament_tournamentID", "HeroscapeTournament_numArmies", "HeroscapeTournament_pointLimit", "HeroscapeTournament_hexLimit", "HeroscapeTournament_figureLimit", "HeroscapeTournament_useDeltaPricing", "HeroscapeTournament_includeVC", "HeroscapeTournament_includeMarvel", "Round_id", "Round_tournamentID", "Round_name", "Round_order", "Round_started", "Game_id", "Game_roundID", "HeroscapeGame_gameID", "HeroscapeGame_mapID", "HeroscapeGame_wentToTime", "GameMap_id", "GameMap_name", "GameMap_number", "GameMap_tournamentID", "HeroscapeGamePlayer_id", "HeroscapeGamePlayer_playerID", "HeroscapeGamePlayer_gameID", "HeroscapeGamePlayer_result", "HeroscapeGamePlayer_pointsLeft", "Player_id", "Player_name", "Player_userID", "Player_tournamentID", "Player_teamCaptainID", "Player_active", "User_id", "User_userName"].includes(columnName)) {
			return ConventionTournamentResultsView;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "Convention_id":
				return null;
			case "Tournament_id":
				return null;
			case "Tournament_name":
				return null;
			case "Tournament_description":
				return null;
			case "Tournament_convention":
				return null;
			case "Tournament_startTime":
				return null;
			case "Tournament_endDate":
				return null;
			case "Tournament_started":
				return null;
			case "Tournament_finished":
				return null;
			case "Tournament_allowSignupAfter":
				return null;
			case "Tournament_allowLateSignup":
				return null;
			case "Tournament_online":
				return null;
			case "Tournament_maxEntries":
				return null;
			case "Tournament_teamSize":
				return null;
			case "Tournament_maxNumPlayersPerGame":
				return null;
			case "Tournament_roundLengthMinutes":
				return null;
			case "Tournament_ignoreInStandings":
				return null;
			case "HeroscapeTournament_tournament":
				return null;
			case "HeroscapeTournament_numArmies":
				return null;
			case "HeroscapeTournament_pointLimit":
				return null;
			case "HeroscapeTournament_hexLimit":
				return null;
			case "HeroscapeTournament_figureLimit":
				return null;
			case "HeroscapeTournament_useDeltaPricing":
				return null;
			case "HeroscapeTournament_includeVC":
				return null;
			case "HeroscapeTournament_includeMarvel":
				return null;
			case "Round_id":
				return null;
			case "Round_tournament":
				return null;
			case "Round_name":
				return null;
			case "Round_order":
				return null;
			case "Round_started":
				return null;
			case "Game_id":
				return null;
			case "Game_round":
				return null;
			case "HeroscapeGame_game":
				return null;
			case "HeroscapeGame_map":
				return null;
			case "HeroscapeGame_wentToTime":
				return null;
			case "GameMap_id":
				return null;
			case "GameMap_name":
				return null;
			case "GameMap_number":
				return null;
			case "GameMap_tournament":
				return null;
			case "HeroscapeGamePlayer_id":
				return null;
			case "HeroscapeGamePlayer_player":
				return null;
			case "HeroscapeGamePlayer_game":
				return null;
			case "HeroscapeGamePlayer_result":
				return null;
			case "HeroscapeGamePlayer_pointsLeft":
				return null;
			case "Player_id":
				return null;
			case "Player_name":
				return null;
			case "Player_user":
				return null;
			case "Player_tournament":
				return null;
			case "Player_teamCaptain":
				return null;
			case "Player_active":
				return null;
			case "User_id":
				return null;
			case "User_userName":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "Convention_id":
				return ""; // TODO
			case "Tournament_id":
				return ""; // TODO
			case "Tournament_name":
				return ""; // TODO
			case "Tournament_description":
				return ""; // TODO
			case "Tournament_convention":
				return ""; // TODO
			case "Tournament_startTime":
				return ""; // TODO
			case "Tournament_endDate":
				return ""; // TODO
			case "Tournament_started":
				return ""; // TODO
			case "Tournament_finished":
				return ""; // TODO
			case "Tournament_allowSignupAfter":
				return ""; // TODO
			case "Tournament_allowLateSignup":
				return ""; // TODO
			case "Tournament_online":
				return ""; // TODO
			case "Tournament_maxEntries":
				return ""; // TODO
			case "Tournament_teamSize":
				return ""; // TODO
			case "Tournament_maxNumPlayersPerGame":
				return ""; // TODO
			case "Tournament_roundLengthMinutes":
				return ""; // TODO
			case "Tournament_ignoreInStandings":
				return ""; // TODO
			case "HeroscapeTournament_tournament":
				return ""; // TODO
			case "HeroscapeTournament_numArmies":
				return ""; // TODO
			case "HeroscapeTournament_pointLimit":
				return ""; // TODO
			case "HeroscapeTournament_hexLimit":
				return ""; // TODO
			case "HeroscapeTournament_figureLimit":
				return ""; // TODO
			case "HeroscapeTournament_useDeltaPricing":
				return ""; // TODO
			case "HeroscapeTournament_includeVC":
				return ""; // TODO
			case "HeroscapeTournament_includeMarvel":
				return ""; // TODO
			case "Round_id":
				return ""; // TODO
			case "Round_tournament":
				return ""; // TODO
			case "Round_name":
				return ""; // TODO
			case "Round_order":
				return ""; // TODO
			case "Round_started":
				return ""; // TODO
			case "Game_id":
				return ""; // TODO
			case "Game_round":
				return ""; // TODO
			case "HeroscapeGame_game":
				return ""; // TODO
			case "HeroscapeGame_map":
				return ""; // TODO
			case "HeroscapeGame_wentToTime":
				return ""; // TODO
			case "GameMap_id":
				return ""; // TODO
			case "GameMap_name":
				return ""; // TODO
			case "GameMap_number":
				return ""; // TODO
			case "GameMap_tournament":
				return ""; // TODO
			case "HeroscapeGamePlayer_id":
				return ""; // TODO
			case "HeroscapeGamePlayer_player":
				return ""; // TODO
			case "HeroscapeGamePlayer_game":
				return ""; // TODO
			case "HeroscapeGamePlayer_result":
				return ""; // TODO
			case "HeroscapeGamePlayer_pointsLeft":
				return ""; // TODO
			case "Player_id":
				return ""; // TODO
			case "Player_name":
				return ""; // TODO
			case "Player_user":
				return ""; // TODO
			case "Player_tournament":
				return ""; // TODO
			case "Player_teamCaptain":
				return ""; // TODO
			case "Player_active":
				return ""; // TODO
			case "User_id":
				return ""; // TODO
			case "User_userName":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (ConventionTournamentResultsView.includeField("Convention_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Convention_id";
			if (this.Convention_id !== null) {
				fieldData["value"] = this.Convention_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_id";
			if (this.Tournament_id !== null) {
				fieldData["value"] = this.Tournament_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Tournament_name";
			if (this.Tournament_name !== null) {
				fieldData["value"] = this.Tournament_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_description", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_description";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Tournament_description";
			if (this.Tournament_description !== null) {
				fieldData["value"] = this.Tournament_description;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_convention", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_convention";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_convention ID";
			if (this.Tournament_convention !== null) {
				fieldData["value"] = this.Tournament_convention;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_startTime", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_startTime";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "datetime-local";
			fieldData["label"] = "Tournament_start Time";
			if (this.Tournament_startTime !== null) {
				fieldData["value"] = forEditing ? this.Tournament_startTime.replace(' ','T') : new Date(this.Tournament_startTime).toString();
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_endDate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_endDate";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "Tournament_end Date";
			if (this.Tournament_endDate !== null) {
				fieldData["value"] = this.Tournament_endDate;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_started", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_started";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Tournament_started";
			if (this.Tournament_started !== null) {
				fieldData["value"] = this.Tournament_started;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_finished", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_finished";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Tournament_finished";
			if (this.Tournament_finished !== null) {
				fieldData["value"] = this.Tournament_finished;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_allowSignupAfter", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_allowSignupAfter";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "datetime-local";
			fieldData["label"] = "Tournament_allow Signup After";
			if (this.Tournament_allowSignupAfter !== null) {
				fieldData["value"] = forEditing ? this.Tournament_allowSignupAfter.replace(' ','T') : new Date(this.Tournament_allowSignupAfter).toString();
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_allowLateSignup", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_allowLateSignup";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "datetime-local";
			fieldData["label"] = "Tournament_allow Late Signup";
			if (this.Tournament_allowLateSignup !== null) {
				fieldData["value"] = forEditing ? this.Tournament_allowLateSignup.replace(' ','T') : new Date(this.Tournament_allowLateSignup).toString();
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_online", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_online";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Tournament_online";
			if (this.Tournament_online !== null) {
				fieldData["value"] = this.Tournament_online;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_maxEntries", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_maxEntries";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_max Entries";
			if (this.Tournament_maxEntries !== null) {
				fieldData["value"] = this.Tournament_maxEntries;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_teamSize", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_teamSize";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_team Size";
			if (this.Tournament_teamSize !== null) {
				fieldData["value"] = this.Tournament_teamSize;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_maxNumPlayersPerGame", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_maxNumPlayersPerGame";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_max Num Players Per Game";
			if (this.Tournament_maxNumPlayersPerGame !== null) {
				fieldData["value"] = this.Tournament_maxNumPlayersPerGame;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_roundLengthMinutes", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_roundLengthMinutes";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_round Length Minutes";
			if (this.Tournament_roundLengthMinutes !== null) {
				fieldData["value"] = this.Tournament_roundLengthMinutes;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Tournament_ignoreInStandings", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_ignoreInStandings";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Tournament_ignore In Standings";
			if (this.Tournament_ignoreInStandings !== null) {
				fieldData["value"] = this.Tournament_ignoreInStandings;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeTournament_tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_tournament";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_tournament ID";
			if (this.HeroscapeTournament_tournament !== null) {
				fieldData["value"] = this.HeroscapeTournament_tournament;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeTournament_numArmies", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_numArmies";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_num Armies";
			if (this.HeroscapeTournament_numArmies !== null) {
				fieldData["value"] = this.HeroscapeTournament_numArmies;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeTournament_pointLimit", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_pointLimit";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_point Limit";
			if (this.HeroscapeTournament_pointLimit !== null) {
				fieldData["value"] = this.HeroscapeTournament_pointLimit;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeTournament_hexLimit", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_hexLimit";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_hex Limit";
			if (this.HeroscapeTournament_hexLimit !== null) {
				fieldData["value"] = this.HeroscapeTournament_hexLimit;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeTournament_figureLimit", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_figureLimit";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_figure Limit";
			if (this.HeroscapeTournament_figureLimit !== null) {
				fieldData["value"] = this.HeroscapeTournament_figureLimit;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeTournament_useDeltaPricing", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_useDeltaPricing";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Heroscape Tournament_use Delta Pricing";
			if (this.HeroscapeTournament_useDeltaPricing !== null) {
				fieldData["value"] = this.HeroscapeTournament_useDeltaPricing;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeTournament_includeVC", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_includeVC";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Heroscape Tournament_include VC";
			if (this.HeroscapeTournament_includeVC !== null) {
				fieldData["value"] = this.HeroscapeTournament_includeVC;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeTournament_includeMarvel", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_includeMarvel";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Heroscape Tournament_include Marvel";
			if (this.HeroscapeTournament_includeMarvel !== null) {
				fieldData["value"] = this.HeroscapeTournament_includeMarvel;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Round_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Round_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Round_id";
			if (this.Round_id !== null) {
				fieldData["value"] = this.Round_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Round_tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Round_tournament";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Round_tournament ID";
			if (this.Round_tournament !== null) {
				fieldData["value"] = this.Round_tournament;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Round_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Round_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Round_name";
			if (this.Round_name !== null) {
				fieldData["value"] = this.Round_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Round_order", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Round_order";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Round_order";
			if (this.Round_order !== null) {
				fieldData["value"] = this.Round_order;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Round_started", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Round_started";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Round_started";
			if (this.Round_started !== null) {
				fieldData["value"] = this.Round_started;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Game_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Game_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Game_id";
			if (this.Game_id !== null) {
				fieldData["value"] = this.Game_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Game_round", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Game_round";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Game_round ID";
			if (this.Game_round !== null) {
				fieldData["value"] = this.Game_round;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeGame_game", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGame_game";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Game_game ID";
			if (this.HeroscapeGame_game !== null) {
				fieldData["value"] = this.HeroscapeGame_game;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeGame_map", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGame_map";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Game_map ID";
			if (this.HeroscapeGame_map !== null) {
				fieldData["value"] = this.HeroscapeGame_map;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeGame_wentToTime", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGame_wentToTime";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Heroscape Game_went To Time";
			if (this.HeroscapeGame_wentToTime !== null) {
				fieldData["value"] = this.HeroscapeGame_wentToTime;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("GameMap_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "GameMap_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Game Map_id";
			if (this.GameMap_id !== null) {
				fieldData["value"] = this.GameMap_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("GameMap_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "GameMap_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Game Map_name";
			if (this.GameMap_name !== null) {
				fieldData["value"] = this.GameMap_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("GameMap_number", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "GameMap_number";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Game Map_number";
			if (this.GameMap_number !== null) {
				fieldData["value"] = this.GameMap_number;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("GameMap_tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "GameMap_tournament";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Game Map_tournament ID";
			if (this.GameMap_tournament !== null) {
				fieldData["value"] = this.GameMap_tournament;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeGamePlayer_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGamePlayer_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Game Player_id";
			if (this.HeroscapeGamePlayer_id !== null) {
				fieldData["value"] = this.HeroscapeGamePlayer_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeGamePlayer_player", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGamePlayer_player";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Game Player_player ID";
			if (this.HeroscapeGamePlayer_player !== null) {
				fieldData["value"] = this.HeroscapeGamePlayer_player;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeGamePlayer_game", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGamePlayer_game";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Game Player_game ID";
			if (this.HeroscapeGamePlayer_game !== null) {
				fieldData["value"] = this.HeroscapeGamePlayer_game;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeGamePlayer_result", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGamePlayer_result";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Game Player_result";
			if (this.HeroscapeGamePlayer_result !== null) {
				fieldData["value"] = this.HeroscapeGamePlayer_result;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("HeroscapeGamePlayer_pointsLeft", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGamePlayer_pointsLeft";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Game Player_points Left";
			if (this.HeroscapeGamePlayer_pointsLeft !== null) {
				fieldData["value"] = this.HeroscapeGamePlayer_pointsLeft;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Player_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player_id";
			if (this.Player_id !== null) {
				fieldData["value"] = this.Player_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Player_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Player_name";
			if (this.Player_name !== null) {
				fieldData["value"] = this.Player_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Player_user", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_user";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player_user ID";
			if (this.Player_user !== null) {
				fieldData["value"] = this.Player_user;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Player_tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_tournament";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player_tournament ID";
			if (this.Player_tournament !== null) {
				fieldData["value"] = this.Player_tournament;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Player_teamCaptain", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_teamCaptain";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player_team Captain ID";
			if (this.Player_teamCaptain !== null) {
				fieldData["value"] = this.Player_teamCaptain;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("Player_active", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_active";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Player_active";
			if (this.Player_active !== null) {
				fieldData["value"] = this.Player_active;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("User_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "User_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "User_id";
			if (this.User_id !== null) {
				fieldData["value"] = this.User_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.includeField("User_userName", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "User_userName";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "User_user Name";
			if (this.User_userName !== null) {
				fieldData["value"] = this.User_userName;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionTournamentResultsView.options.fieldOrder !== undefined && ConventionTournamentResultsView.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, ConventionTournamentResultsView.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

ConventionTournamentResultsView.list = [];
ConventionTournamentResultsView.options = [];

class FigureUsageView extends DatabaseObject {
	constructor(jsonObj) {
		if (FigureUsageView.exists(jsonObj)) {
			return FigureUsageView.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.PlayerArmyCard_id = null; // Int
		this.PlayerArmyCard_playerArmyID = null; // Int
		this.PlayerArmyCard_cardID = null; // Int
		this.PlayerArmyCard_quantity = null; // Int
		this.Card_id = null; // Int
		this.Card_name = null; // String
		this.PlayerArmy_id = null; // Int
		this.PlayerArmy_armyNumber = null; // Int
		this.PlayerArmy_playerID = null; // Int
		this.PlayerArmy_army = null; // String
		this.Player_id = null; // Int
		this.Player_name = null; // String
		this.Player_userID = null; // Int
		this.Player_tournamentID = null; // Int
		this.Player_active = null; // Boolean
		this.Tournament_id = null; // Int
		this.Tournament_name = null; // String
		this.Tournament_startTime = null; // Datetime
		this.Tournament_endDate = null; // Date
		this.Tournament_started = null; // Boolean
		this.Tournament_finished = null; // Boolean
		this.Tournament_maxNumPlayersPerGame = null; // Int
		this.Tournament_figureSetID = null; // Int
		this.HeroscapeTournament_tournamentID = null; // Int
		this.HeroscapeTournament_numArmies = null; // Int
		this.HeroscapeTournament_useDeltaPricing = null; // Boolean
		this.HeroscapeTournament_includeVC = null; // Boolean
		this.HeroscapeTournament_includeMarvel = null; // Boolean
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			FigureUsageView.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.PlayerArmyCard_id = jsonObj.PlayerArmyCard_id;
			this.PlayerArmyCard_playerArmyID = jsonObj.PlayerArmyCard_playerArmyID;
			this.PlayerArmyCard_cardID = jsonObj.PlayerArmyCard_cardID;
			this.PlayerArmyCard_quantity = jsonObj.PlayerArmyCard_quantity;
			this.Card_id = jsonObj.Card_id;
			this.Card_name = jsonObj.Card_name;
			this.PlayerArmy_id = jsonObj.PlayerArmy_id;
			this.PlayerArmy_armyNumber = jsonObj.PlayerArmy_armyNumber;
			this.PlayerArmy_playerID = jsonObj.PlayerArmy_playerID;
			this.PlayerArmy_army = jsonObj.PlayerArmy_army;
			this.Player_id = jsonObj.Player_id;
			this.Player_name = jsonObj.Player_name;
			this.Player_userID = jsonObj.Player_userID;
			this.Player_tournamentID = jsonObj.Player_tournamentID;
			this.Player_active = jsonObj.Player_active;
			this.Tournament_id = jsonObj.Tournament_id;
			this.Tournament_name = jsonObj.Tournament_name;
			this.Tournament_startTime = jsonObj.Tournament_startTime;
			this.Tournament_endDate = jsonObj.Tournament_endDate;
			this.Tournament_started = jsonObj.Tournament_started;
			this.Tournament_finished = jsonObj.Tournament_finished;
			this.Tournament_maxNumPlayersPerGame = jsonObj.Tournament_maxNumPlayersPerGame;
			this.Tournament_figureSetID = jsonObj.Tournament_figureSetID;
			this.HeroscapeTournament_tournamentID = jsonObj.HeroscapeTournament_tournamentID;
			this.HeroscapeTournament_numArmies = jsonObj.HeroscapeTournament_numArmies;
			this.HeroscapeTournament_useDeltaPricing = jsonObj.HeroscapeTournament_useDeltaPricing;
			this.HeroscapeTournament_includeVC = jsonObj.HeroscapeTournament_includeVC;
			this.HeroscapeTournament_includeMarvel = jsonObj.HeroscapeTournament_includeMarvel;
			
			// Links
			
			FigureUsageView.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Figure Usage View";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "PlayerArmyCard_id", "PlayerArmyCard_playerArmyID", "PlayerArmyCard_cardID", "PlayerArmyCard_quantity", "Card_id", "Card_name", "PlayerArmy_id", "PlayerArmy_armyNumber", "PlayerArmy_playerID", "PlayerArmy_army", "Player_id", "Player_name", "Player_userID", "Player_tournamentID", "Player_active", "Tournament_id", "Tournament_name", "Tournament_startTime", "Tournament_endDate", "Tournament_started", "Tournament_finished", "Tournament_maxNumPlayersPerGame", "Tournament_figureSetID", "HeroscapeTournament_tournamentID", "HeroscapeTournament_numArmies", "HeroscapeTournament_useDeltaPricing", "HeroscapeTournament_includeVC", "HeroscapeTournament_includeMarvel"];
	}

	static getAllFields() {
		return ["id", "PlayerArmyCard_id", "PlayerArmyCard_playerArmyID", "PlayerArmyCard_cardID", "PlayerArmyCard_quantity", "Card_id", "Card_name", "PlayerArmy_id", "PlayerArmy_armyNumber", "PlayerArmy_playerID", "PlayerArmy_army", "Player_id", "Player_name", "Player_userID", "Player_tournamentID", "Player_active", "Tournament_id", "Tournament_name", "Tournament_startTime", "Tournament_endDate", "Tournament_started", "Tournament_finished", "Tournament_maxNumPlayersPerGame", "Tournament_figureSetID", "HeroscapeTournament_tournamentID", "HeroscapeTournament_numArmies", "HeroscapeTournament_useDeltaPricing", "HeroscapeTournament_includeVC", "HeroscapeTournament_includeMarvel"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "PlayerArmyCard_id", "PlayerArmyCard_playerArmyID", "PlayerArmyCard_cardID", "PlayerArmyCard_quantity", "Card_id", "Card_name", "PlayerArmy_id", "PlayerArmy_armyNumber", "PlayerArmy_playerID", "PlayerArmy_army", "Player_id", "Player_name", "Player_userID", "Player_tournamentID", "Player_active", "Tournament_id", "Tournament_name", "Tournament_startTime", "Tournament_endDate", "Tournament_started", "Tournament_finished", "Tournament_maxNumPlayersPerGame", "Tournament_figureSetID", "HeroscapeTournament_tournamentID", "HeroscapeTournament_numArmies", "HeroscapeTournament_useDeltaPricing", "HeroscapeTournament_includeVC", "HeroscapeTournament_includeMarvel"].includes(columnName)) {
			return FigureUsageView;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "PlayerArmyCard_id":
				return null;
			case "PlayerArmyCard_playerArmy":
				return null;
			case "PlayerArmyCard_card":
				return null;
			case "PlayerArmyCard_quantity":
				return null;
			case "Card_id":
				return null;
			case "Card_name":
				return null;
			case "PlayerArmy_id":
				return null;
			case "PlayerArmy_armyNumber":
				return null;
			case "PlayerArmy_player":
				return null;
			case "PlayerArmy_army":
				return null;
			case "Player_id":
				return null;
			case "Player_name":
				return null;
			case "Player_user":
				return null;
			case "Player_tournament":
				return null;
			case "Player_active":
				return null;
			case "Tournament_id":
				return null;
			case "Tournament_name":
				return null;
			case "Tournament_startTime":
				return null;
			case "Tournament_endDate":
				return null;
			case "Tournament_started":
				return null;
			case "Tournament_finished":
				return null;
			case "Tournament_maxNumPlayersPerGame":
				return null;
			case "Tournament_figureSet":
				return null;
			case "HeroscapeTournament_tournament":
				return null;
			case "HeroscapeTournament_numArmies":
				return null;
			case "HeroscapeTournament_useDeltaPricing":
				return null;
			case "HeroscapeTournament_includeVC":
				return null;
			case "HeroscapeTournament_includeMarvel":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "PlayerArmyCard_id":
				return ""; // TODO
			case "PlayerArmyCard_playerArmy":
				return ""; // TODO
			case "PlayerArmyCard_card":
				return ""; // TODO
			case "PlayerArmyCard_quantity":
				return ""; // TODO
			case "Card_id":
				return ""; // TODO
			case "Card_name":
				return ""; // TODO
			case "PlayerArmy_id":
				return ""; // TODO
			case "PlayerArmy_armyNumber":
				return ""; // TODO
			case "PlayerArmy_player":
				return ""; // TODO
			case "PlayerArmy_army":
				return ""; // TODO
			case "Player_id":
				return ""; // TODO
			case "Player_name":
				return ""; // TODO
			case "Player_user":
				return ""; // TODO
			case "Player_tournament":
				return ""; // TODO
			case "Player_active":
				return ""; // TODO
			case "Tournament_id":
				return ""; // TODO
			case "Tournament_name":
				return ""; // TODO
			case "Tournament_startTime":
				return ""; // TODO
			case "Tournament_endDate":
				return ""; // TODO
			case "Tournament_started":
				return ""; // TODO
			case "Tournament_finished":
				return ""; // TODO
			case "Tournament_maxNumPlayersPerGame":
				return ""; // TODO
			case "Tournament_figureSet":
				return ""; // TODO
			case "HeroscapeTournament_tournament":
				return ""; // TODO
			case "HeroscapeTournament_numArmies":
				return ""; // TODO
			case "HeroscapeTournament_useDeltaPricing":
				return ""; // TODO
			case "HeroscapeTournament_includeVC":
				return ""; // TODO
			case "HeroscapeTournament_includeMarvel":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (FigureUsageView.includeField("PlayerArmyCard_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "PlayerArmyCard_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player Army Card_id";
			if (this.PlayerArmyCard_id !== null) {
				fieldData["value"] = this.PlayerArmyCard_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("PlayerArmyCard_playerArmy", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "PlayerArmyCard_playerArmy";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player Army Card_player Army ID";
			if (this.PlayerArmyCard_playerArmy !== null) {
				fieldData["value"] = this.PlayerArmyCard_playerArmy;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("PlayerArmyCard_card", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "PlayerArmyCard_card";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player Army Card_card ID";
			if (this.PlayerArmyCard_card !== null) {
				fieldData["value"] = this.PlayerArmyCard_card;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("PlayerArmyCard_quantity", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "PlayerArmyCard_quantity";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player Army Card_quantity";
			if (this.PlayerArmyCard_quantity !== null) {
				fieldData["value"] = this.PlayerArmyCard_quantity;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Card_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Card_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Card_id";
			if (this.Card_id !== null) {
				fieldData["value"] = this.Card_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Card_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Card_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Card_name";
			if (this.Card_name !== null) {
				fieldData["value"] = this.Card_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("PlayerArmy_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "PlayerArmy_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player Army_id";
			if (this.PlayerArmy_id !== null) {
				fieldData["value"] = this.PlayerArmy_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("PlayerArmy_armyNumber", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "PlayerArmy_armyNumber";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player Army_army Number";
			if (this.PlayerArmy_armyNumber !== null) {
				fieldData["value"] = this.PlayerArmy_armyNumber;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("PlayerArmy_player", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "PlayerArmy_player";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player Army_player ID";
			if (this.PlayerArmy_player !== null) {
				fieldData["value"] = this.PlayerArmy_player;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("PlayerArmy_army", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "PlayerArmy_army";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Player Army_army";
			if (this.PlayerArmy_army !== null) {
				fieldData["value"] = this.PlayerArmy_army;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Player_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player_id";
			if (this.Player_id !== null) {
				fieldData["value"] = this.Player_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Player_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Player_name";
			if (this.Player_name !== null) {
				fieldData["value"] = this.Player_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Player_user", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_user";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player_user ID";
			if (this.Player_user !== null) {
				fieldData["value"] = this.Player_user;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Player_tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_tournament";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Player_tournament ID";
			if (this.Player_tournament !== null) {
				fieldData["value"] = this.Player_tournament;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Player_active", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Player_active";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Player_active";
			if (this.Player_active !== null) {
				fieldData["value"] = this.Player_active;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Tournament_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_id";
			if (this.Tournament_id !== null) {
				fieldData["value"] = this.Tournament_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Tournament_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Tournament_name";
			if (this.Tournament_name !== null) {
				fieldData["value"] = this.Tournament_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Tournament_startTime", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_startTime";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "datetime-local";
			fieldData["label"] = "Tournament_start Time";
			if (this.Tournament_startTime !== null) {
				fieldData["value"] = forEditing ? this.Tournament_startTime.replace(' ','T') : new Date(this.Tournament_startTime).toString();
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Tournament_endDate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_endDate";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "Tournament_end Date";
			if (this.Tournament_endDate !== null) {
				fieldData["value"] = this.Tournament_endDate;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Tournament_started", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_started";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Tournament_started";
			if (this.Tournament_started !== null) {
				fieldData["value"] = this.Tournament_started;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Tournament_finished", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_finished";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Tournament_finished";
			if (this.Tournament_finished !== null) {
				fieldData["value"] = this.Tournament_finished;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Tournament_maxNumPlayersPerGame", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_maxNumPlayersPerGame";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_max Num Players Per Game";
			if (this.Tournament_maxNumPlayersPerGame !== null) {
				fieldData["value"] = this.Tournament_maxNumPlayersPerGame;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("Tournament_figureSet", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_figureSet";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_figure Set ID";
			if (this.Tournament_figureSet !== null) {
				fieldData["value"] = this.Tournament_figureSet;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("HeroscapeTournament_tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_tournament";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_tournament ID";
			if (this.HeroscapeTournament_tournament !== null) {
				fieldData["value"] = this.HeroscapeTournament_tournament;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("HeroscapeTournament_numArmies", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_numArmies";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_num Armies";
			if (this.HeroscapeTournament_numArmies !== null) {
				fieldData["value"] = this.HeroscapeTournament_numArmies;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("HeroscapeTournament_useDeltaPricing", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_useDeltaPricing";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Heroscape Tournament_use Delta Pricing";
			if (this.HeroscapeTournament_useDeltaPricing !== null) {
				fieldData["value"] = this.HeroscapeTournament_useDeltaPricing;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("HeroscapeTournament_includeVC", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_includeVC";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Heroscape Tournament_include VC";
			if (this.HeroscapeTournament_includeVC !== null) {
				fieldData["value"] = this.HeroscapeTournament_includeVC;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.includeField("HeroscapeTournament_includeMarvel", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_includeMarvel";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Heroscape Tournament_include Marvel";
			if (this.HeroscapeTournament_includeMarvel !== null) {
				fieldData["value"] = this.HeroscapeTournament_includeMarvel;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (FigureUsageView.options.fieldOrder !== undefined && FigureUsageView.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, FigureUsageView.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

FigureUsageView.list = [];
FigureUsageView.options = [];

class UnitWinRateDeltaView extends DatabaseObject {
	constructor(jsonObj) {
		if (UnitWinRateDeltaView.exists(jsonObj)) {
			return UnitWinRateDeltaView.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.W = null; // Int
		this.L = null; // Int
		this.WinPercent = null; // Decimal
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			UnitWinRateDeltaView.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.W = jsonObj.W;
			this.L = jsonObj.L;
			this.WinPercent = jsonObj.WinPercent;
			
			// Links
			
			UnitWinRateDeltaView.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Unit Win Rate Delta View";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "W", "L", "WinPercent"];
	}

	static getAllFields() {
		return ["id", "name", "W", "L", "WinPercent"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "W", "L", "WinPercent"].includes(columnName)) {
			return UnitWinRateDeltaView;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "W":
				return null;
			case "L":
				return null;
			case "WinPercent":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "W":
				return ""; // TODO
			case "L":
				return ""; // TODO
			case "WinPercent":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (UnitWinRateDeltaView.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UnitWinRateDeltaView.includeField("W", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "W";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "W";
			if (this.W !== null) {
				fieldData["value"] = this.W;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UnitWinRateDeltaView.includeField("L", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "L";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "L";
			if (this.L !== null) {
				fieldData["value"] = this.L;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UnitWinRateDeltaView.includeField("WinPercent", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "WinPercent";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "any";
			fieldData["label"] = "Win Percent";
			if (this.WinPercent !== null) {
				fieldData["value"] = this.WinPercent;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UnitWinRateDeltaView.options.fieldOrder !== undefined && UnitWinRateDeltaView.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, UnitWinRateDeltaView.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

UnitWinRateDeltaView.list = [];
UnitWinRateDeltaView.options = [];

class UnitWinRateStandardView extends DatabaseObject {
	constructor(jsonObj) {
		if (UnitWinRateStandardView.exists(jsonObj)) {
			return UnitWinRateStandardView.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.W = null; // Int
		this.L = null; // Int
		this.WinPercent = null; // Decimal
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			UnitWinRateStandardView.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.W = jsonObj.W;
			this.L = jsonObj.L;
			this.WinPercent = jsonObj.WinPercent;
			
			// Links
			
			UnitWinRateStandardView.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Unit Win Rate Standard View";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "W", "L", "WinPercent"];
	}

	static getAllFields() {
		return ["id", "name", "W", "L", "WinPercent"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "W", "L", "WinPercent"].includes(columnName)) {
			return UnitWinRateStandardView;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "W":
				return null;
			case "L":
				return null;
			case "WinPercent":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "W":
				return ""; // TODO
			case "L":
				return ""; // TODO
			case "WinPercent":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (UnitWinRateStandardView.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UnitWinRateStandardView.includeField("W", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "W";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "W";
			if (this.W !== null) {
				fieldData["value"] = this.W;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UnitWinRateStandardView.includeField("L", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "L";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "L";
			if (this.L !== null) {
				fieldData["value"] = this.L;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UnitWinRateStandardView.includeField("WinPercent", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "WinPercent";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "any";
			fieldData["label"] = "Win Percent";
			if (this.WinPercent !== null) {
				fieldData["value"] = this.WinPercent;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UnitWinRateStandardView.options.fieldOrder !== undefined && UnitWinRateStandardView.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, UnitWinRateStandardView.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

UnitWinRateStandardView.list = [];
UnitWinRateStandardView.options = [];

class CardUsageByUserView extends DatabaseObject {
	constructor(jsonObj) {
		if (CardUsageByUserView.exists(jsonObj)) {
			return CardUsageByUserView.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.cardName = null; // String
		this.userName = null; // String
		this.delta = null; // Boolean
		this.count = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			CardUsageByUserView.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.cardName = jsonObj.cardName;
			this.userName = jsonObj.userName;
			this.delta = jsonObj.delta;
			this.count = jsonObj.count;
			
			// Links
			
			CardUsageByUserView.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Card Usage By User View";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "cardName", "userName", "delta", "count"];
	}

	static getAllFields() {
		return ["id", "cardName", "userName", "delta", "count"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "cardName", "userName", "delta", "count"].includes(columnName)) {
			return CardUsageByUserView;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "cardName":
				return null;
			case "userName":
				return null;
			case "delta":
				return null;
			case "count":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "cardName":
				return ""; // TODO
			case "userName":
				return ""; // TODO
			case "delta":
				return ""; // TODO
			case "count":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (CardUsageByUserView.includeField("cardName", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "cardName";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Card Name";
			if (this.cardName !== null) {
				fieldData["value"] = this.cardName;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (CardUsageByUserView.includeField("userName", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "userName";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "User Name";
			if (this.userName !== null) {
				fieldData["value"] = this.userName;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (CardUsageByUserView.includeField("delta", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "delta";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Delta";
			if (this.delta !== null) {
				fieldData["value"] = this.delta;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (CardUsageByUserView.includeField("count", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "count";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Count";
			if (this.count !== null) {
				fieldData["value"] = this.count;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (CardUsageByUserView.options.fieldOrder !== undefined && CardUsageByUserView.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, CardUsageByUserView.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

CardUsageByUserView.list = [];
CardUsageByUserView.options = [];

class User extends DatabaseObject {
	constructor(jsonObj) {
		if (User.exists(jsonObj)) {
			return User.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.userName = null; // String
		this.email = null; // String
		this.phoneNumber = null; // String
		this.firstName = null; // String
		this.lastName = null; // String
		this.verified = null; // Boolean
		this.mapEditor = null; // Boolean
		this.siteAdmin = null; // Boolean
		this.verificationKey = null; // String
		this.elo = null; // Int
		
		// Links
		this.links = [{loginCredentialss: LoginCredentials, label: "Login Credentialss", nTo1Link: true, linkField: 'user'}, {admins: Admin, label: "Admins", nTo1Link: true, linkField: 'user'}, {players: Player, label: "Players", nTo1Link: true, linkField: 'user'}, {gameMaps: GameMap, label: "Game Maps", nTo1Link: true, linkField: 'broughtByUser'}, {attendees: Attendee, label: "Attendees", nTo1Link: true, linkField: 'user'}, {userPasswordResets: UserPasswordReset, label: "User Password Resets", nTo1Link: true, linkField: 'user'}, {glyphs: Glyph, label: "Glyphs", nTo1Link: true, linkField: 'author'}, {userSettingTags: UserSettingTag, label: "User Setting Tags", nTo1Link: true, linkField: 'user'}, {powerRankingLists: PowerRankingList, label: "Power Ranking Lists", nTo1Link: true, linkField: 'author'}, {userCollectionHeroscapeSets: UserCollectionHeroscapeSet, label: "User Collection Heroscape Sets", nTo1Link: true, linkField: 'user'}];
		this.loginCredentialss = [];
		this.admins = [];
		this.players = [];
		this.gameMaps = [];
		this.attendees = [];
		this.userPasswordResets = [];
		this.glyphs = [];
		this.userSettingTags = [];
		this.powerRankingLists = [];
		this.userCollectionHeroscapeSets = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			User.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.userName = jsonObj.userName;
			this.email = jsonObj.email;
			this.phoneNumber = jsonObj.phoneNumber;
			this.firstName = jsonObj.firstName;
			this.lastName = jsonObj.lastName;
			this.verified = jsonObj.verified;
			this.mapEditor = jsonObj.mapEditor;
			this.siteAdmin = jsonObj.siteAdmin;
			this.verificationKey = jsonObj.verificationKey;
			this.elo = jsonObj.elo;
			
			// Links
			if (jsonObj.loginCredentialss != undefined && jsonObj.loginCredentialss != null) {
				for (var i = 0; i < jsonObj.loginCredentialss.length; i++) {
					if (LoginCredentials.exists(jsonObj.loginCredentialss[i])){
						const newLinkObj = LoginCredentials.get(jsonObj.loginCredentialss[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.loginCredentialss.length; j++) {
							if (this.loginCredentialss[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.loginCredentialss.push(newLinkObj);
						}
					} else {
						const newForeignObj = new LoginCredentials(jsonObj.loginCredentialss[i]);
						if ( ! this.loginCredentialss.includes(newForeignObj)) {
							this.loginCredentialss.push(newForeignObj);
						}
						newForeignObj.user = this;
					}
				}
			}
			LoginCredentials.orderBy(this.loginCredentialss);
			if (jsonObj.admins != undefined && jsonObj.admins != null) {
				for (var i = 0; i < jsonObj.admins.length; i++) {
					if (Admin.exists(jsonObj.admins[i])){
						const newLinkObj = Admin.get(jsonObj.admins[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.admins.length; j++) {
							if (this.admins[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.admins.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Admin(jsonObj.admins[i]);
						if ( ! this.admins.includes(newForeignObj)) {
							this.admins.push(newForeignObj);
						}
						newForeignObj.user = this;
					}
				}
			}
			Admin.orderBy(this.admins);
			if (jsonObj.players != undefined && jsonObj.players != null) {
				for (var i = 0; i < jsonObj.players.length; i++) {
					if (Player.exists(jsonObj.players[i])){
						const newLinkObj = Player.get(jsonObj.players[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.players.length; j++) {
							if (this.players[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.players.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Player(jsonObj.players[i]);
						if ( ! this.players.includes(newForeignObj)) {
							this.players.push(newForeignObj);
						}
						newForeignObj.user = this;
					}
				}
			}
			Player.orderBy(this.players);
			if (jsonObj.gameMaps != undefined && jsonObj.gameMaps != null) {
				for (var i = 0; i < jsonObj.gameMaps.length; i++) {
					if (GameMap.exists(jsonObj.gameMaps[i])){
						const newLinkObj = GameMap.get(jsonObj.gameMaps[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.gameMaps.length; j++) {
							if (this.gameMaps[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.gameMaps.push(newLinkObj);
						}
					} else {
						const newForeignObj = new GameMap(jsonObj.gameMaps[i]);
						if ( ! this.gameMaps.includes(newForeignObj)) {
							this.gameMaps.push(newForeignObj);
						}
						newForeignObj.broughtByUser = this;
					}
				}
			}
			GameMap.orderBy(this.gameMaps);
			if (jsonObj.attendees != undefined && jsonObj.attendees != null) {
				for (var i = 0; i < jsonObj.attendees.length; i++) {
					if (Attendee.exists(jsonObj.attendees[i])){
						const newLinkObj = Attendee.get(jsonObj.attendees[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.attendees.length; j++) {
							if (this.attendees[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.attendees.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Attendee(jsonObj.attendees[i]);
						if ( ! this.attendees.includes(newForeignObj)) {
							this.attendees.push(newForeignObj);
						}
						newForeignObj.user = this;
					}
				}
			}
			Attendee.orderBy(this.attendees);
			if (jsonObj.userPasswordResets != undefined && jsonObj.userPasswordResets != null) {
				for (var i = 0; i < jsonObj.userPasswordResets.length; i++) {
					if (UserPasswordReset.exists(jsonObj.userPasswordResets[i])){
						const newLinkObj = UserPasswordReset.get(jsonObj.userPasswordResets[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.userPasswordResets.length; j++) {
							if (this.userPasswordResets[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.userPasswordResets.push(newLinkObj);
						}
					} else {
						const newForeignObj = new UserPasswordReset(jsonObj.userPasswordResets[i]);
						if ( ! this.userPasswordResets.includes(newForeignObj)) {
							this.userPasswordResets.push(newForeignObj);
						}
						newForeignObj.user = this;
					}
				}
			}
			UserPasswordReset.orderBy(this.userPasswordResets);
			if (jsonObj.glyphs != undefined && jsonObj.glyphs != null) {
				for (var i = 0; i < jsonObj.glyphs.length; i++) {
					if (Glyph.exists(jsonObj.glyphs[i])){
						const newLinkObj = Glyph.get(jsonObj.glyphs[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.glyphs.length; j++) {
							if (this.glyphs[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.glyphs.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Glyph(jsonObj.glyphs[i]);
						if ( ! this.glyphs.includes(newForeignObj)) {
							this.glyphs.push(newForeignObj);
						}
						newForeignObj.author = this;
					}
				}
			}
			Glyph.orderBy(this.glyphs);
			if (jsonObj.userSettingTags != undefined && jsonObj.userSettingTags != null) {
				for (var i = 0; i < jsonObj.userSettingTags.length; i++) {
					if (UserSettingTag.exists(jsonObj.userSettingTags[i])){
						const newLinkObj = UserSettingTag.get(jsonObj.userSettingTags[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.userSettingTags.length; j++) {
							if (this.userSettingTags[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.userSettingTags.push(newLinkObj);
						}
					} else {
						const newForeignObj = new UserSettingTag(jsonObj.userSettingTags[i]);
						if ( ! this.userSettingTags.includes(newForeignObj)) {
							this.userSettingTags.push(newForeignObj);
						}
						newForeignObj.user = this;
					}
				}
			}
			UserSettingTag.orderBy(this.userSettingTags);
			if (jsonObj.powerRankingLists != undefined && jsonObj.powerRankingLists != null) {
				for (var i = 0; i < jsonObj.powerRankingLists.length; i++) {
					if (PowerRankingList.exists(jsonObj.powerRankingLists[i])){
						const newLinkObj = PowerRankingList.get(jsonObj.powerRankingLists[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.powerRankingLists.length; j++) {
							if (this.powerRankingLists[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.powerRankingLists.push(newLinkObj);
						}
					} else {
						const newForeignObj = new PowerRankingList(jsonObj.powerRankingLists[i]);
						if ( ! this.powerRankingLists.includes(newForeignObj)) {
							this.powerRankingLists.push(newForeignObj);
						}
						newForeignObj.author = this;
					}
				}
			}
			PowerRankingList.orderBy(this.powerRankingLists);
			if (jsonObj.userCollectionHeroscapeSets != undefined && jsonObj.userCollectionHeroscapeSets != null) {
				for (var i = 0; i < jsonObj.userCollectionHeroscapeSets.length; i++) {
					if (UserCollectionHeroscapeSet.exists(jsonObj.userCollectionHeroscapeSets[i])){
						const newLinkObj = UserCollectionHeroscapeSet.get(jsonObj.userCollectionHeroscapeSets[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.userCollectionHeroscapeSets.length; j++) {
							if (this.userCollectionHeroscapeSets[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.userCollectionHeroscapeSets.push(newLinkObj);
						}
					} else {
						const newForeignObj = new UserCollectionHeroscapeSet(jsonObj.userCollectionHeroscapeSets[i]);
						if ( ! this.userCollectionHeroscapeSets.includes(newForeignObj)) {
							this.userCollectionHeroscapeSets.push(newForeignObj);
						}
						newForeignObj.user = this;
					}
				}
			}
			UserCollectionHeroscapeSet.orderBy(this.userCollectionHeroscapeSets);
			
			User.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "User";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "userName", "email", "verified", "mapEditor", "siteAdmin"];
	}

	static getAllFields() {
		return ["id", "userName", "email", "phoneNumber", "firstName", "lastName", "verified", "mapEditor", "siteAdmin", "verificationKey", "elo"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "userName", "email", "phoneNumber", "firstName", "lastName", "verified", "mapEditor", "siteAdmin", "verificationKey", "elo"].includes(columnName)) {
			return User;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	// @DoNotUpdate
	wins() {
		var w = 0;
		for (let i = 0; i < this.players.length; i++) {
			w += this.players[i].wins();
		}
		return w;
	}

	// @DoNotUpdate
	losses() {
		var l = 0;
		for (let i = 0; i < this.players.length; i++) {
			l += this.players[i].losses();
		}
		return l;
	}

	// @DoNotUpdate
	ties() {
		var t = 0;
		for (let i = 0; i < this.players.length; i++) {
			t += this.players[i].ties();
		}
		return t;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	// @DoNotUpdate
	strengthOfSchedule(tournaments=null) {
		var opponentWins = 0;
		var opponentLosses = 0;
		for (let i = 0; i < this.players.length; i++) {
			const player = this.players[i];
			if (tournaments != null) {
				var match = false;
				for (let j = 0; j < tournaments.length; j++) {
					if ((player.tournament != null && player.tournament.id == tournaments[j].id) ||
							(player.heroscapeTournament !== undefined && player.heroscapeTournament != null && player.heroscapeTournament.id == tournaments[j].id)) {
						match = true;
						break;
					}
				}
				if ( ! match) {
					continue;
				}
			}
			opponentWins += player.opponentWins();
			opponentLosses += player.opponentLosses();
		}
		if (opponentLosses + opponentWins == 0) {
			return 0;
		}
		return (opponentWins / (opponentLosses + opponentWins)).toFixed(3);
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "userName":
				return null;
			case "email":
				return null;
			case "phoneNumber":
				return null;
			case "firstName":
				return null;
			case "lastName":
				return null;
			case "verified":
				return null;
			case "mapEditor":
				return null;
			case "siteAdmin":
				return null;
			case "verificationKey":
				return null;
			case "elo":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "userName":
				return ""; // TODO
			case "email":
				return ""; // TODO
			case "phoneNumber":
				return ""; // TODO
			case "firstName":
				return ""; // TODO
			case "lastName":
				return ""; // TODO
			case "verified":
				return ""; // TODO
			case "mapEditor":
				return ""; // TODO
			case "siteAdmin":
				return ""; // TODO
			case "verificationKey":
				return ""; // TODO
			case "elo":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (User.includeField("userName", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "userName";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "User Name";
			if (this.userName !== null) {
				fieldData["value"] = this.userName;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (User.includeField("email", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "email";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Email";
			if (this.email !== null) {
				fieldData["value"] = this.email;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (User.includeField("phoneNumber", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "phoneNumber";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Phone Number";
			if (this.phoneNumber !== null) {
				fieldData["value"] = this.phoneNumber;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (User.includeField("firstName", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "firstName";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "First Name";
			if (this.firstName !== null) {
				fieldData["value"] = this.firstName;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (User.includeField("lastName", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "lastName";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Last Name";
			if (this.lastName !== null) {
				fieldData["value"] = this.lastName;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (User.includeField("verified", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "verified";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Verified";
			if (this.verified !== null) {
				fieldData["value"] = this.verified;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (User.includeField("mapEditor", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "mapEditor";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Map Editor";
			if (this.mapEditor !== null) {
				fieldData["value"] = this.mapEditor;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (User.includeField("siteAdmin", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "siteAdmin";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Site Admin";
			if (this.siteAdmin !== null) {
				fieldData["value"] = this.siteAdmin;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (User.includeField("verificationKey", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "verificationKey";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Verification Key";
			if (this.verificationKey !== null) {
				fieldData["value"] = this.verificationKey;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (User.includeField("elo", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "elo";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Elo";
			if (this.elo !== null) {
				fieldData["value"] = this.elo;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (User.options.fieldOrder !== undefined && User.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, User.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

	UserSelectFilters(property, filterObjects) {
		switch (property) {
			case "userName":
				return null;
			case "email":
				return null;
			case "phoneNumber":
				return null;
			case "firstName":
				return null;
			case "lastName":
				return null;
			default:
				return null;
		}
	}

	UserGetTooltip(propName) {
		switch (propName) {
			case "userName":
				return ""; // TODO
			case "email":
				return ""; // TODO
			case "phoneNumber":
				return ""; // TODO
			case "firstName":
				return ""; // TODO
			case "lastName":
				return ""; // TODO
			default:
				return "";
		}
	}

	UserDataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (User.includeField("userName", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "userName";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "User Name";
			if (this.userName !== null) {
				fieldData["value"] = this.userName;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (User.includeField("email", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "email";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Email";
			if (this.email !== null) {
				fieldData["value"] = this.email;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (User.includeField("phoneNumber", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "phoneNumber";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Phone Number";
			if (this.phoneNumber !== null) {
				fieldData["value"] = this.phoneNumber;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (User.includeField("firstName", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "firstName";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "First Name";
			if (this.firstName !== null) {
				fieldData["value"] = this.firstName;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (User.includeField("lastName", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "lastName";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Last Name";
			if (this.lastName !== null) {
				fieldData["value"] = this.lastName;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (User.options.fieldOrder !== undefined && User.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, User.options.fieldOrder);
		}
		return data;
	}

	UserSet(field, jsonObj) {
		switch (field) {
		}
	}

}

User.list = [];
User.options = [];

class LoginCredentials extends DatabaseObject {
	constructor(jsonObj) {
		if (LoginCredentials.exists(jsonObj)) {
			return LoginCredentials.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.user = null; // Int
		this.password = null; // String
		this.cookie = null; // String
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			LoginCredentials.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.user != null) {
				this.user = User.exists(jsonObj.user) ?
					User.get(jsonObj.user) : new User(jsonObj.user);
				if ( ! this.user.loginCredentialss.includes(this)) {
					this.user.loginCredentialss.push(this);
					User.orderBy(this.user.loginCredentialss);
				}
			}
			this.password = jsonObj.password;
			this.cookie = jsonObj.cookie;
			
			// Links
			
			LoginCredentials.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Login Credentials";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "user", "password", "cookie"];
	}

	static getAllFields() {
		return ["id", "user", "password", "cookie"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "userID", "password", "cookie"].includes(columnName)) {
			return LoginCredentials;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "userID":
				return "User";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "user":
				return null;
			case "password":
				return null;
			case "cookie":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "user":
				return ""; // TODO
			case "password":
				return ""; // TODO
			case "cookie":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (LoginCredentials.includeField("user", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "user";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = User.selectOptions(this.user, this.selectFilters("user", filterObjects));
			fieldData["optionClass"] = "User";
			fieldData["propertyForeignClass"] = User;
			fieldData["label"] = "User";
			if (this.user !== undefined && this.user !== null) {
				fieldData["value"] = this.user.toDisplayString();
				fieldData["databaseObj"] = this.user;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (LoginCredentials.includeField("password", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "password";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Password";
			if (this.password !== null) {
				fieldData["value"] = this.password;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (LoginCredentials.includeField("cookie", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "cookie";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Cookie";
			if (this.cookie !== null) {
				fieldData["value"] = this.cookie;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (LoginCredentials.options.fieldOrder !== undefined && LoginCredentials.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, LoginCredentials.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "user":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.user = jsonObj;
				} else if (User.exists(jsonObj)) {
					this.user = User.get(jsonObj);
				} else {
					this.user = new User(jsonObj);
				}
				break;
		}
	}

}

LoginCredentials.list = [];
LoginCredentials.options = [];

class ConventionSeries extends DatabaseObject {
	constructor(jsonObj) {
		if (ConventionSeries.exists(jsonObj)) {
			return ConventionSeries.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		
		// Links
		this.links = [{conventions: Convention, label: "Conventions", nTo1Link: true, linkField: 'conventionSeries'}, {admins: Admin, label: "Admins", nTo1Link: true, linkField: 'conventionSeries'}];
		this.conventions = [];
		this.admins = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			ConventionSeries.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			
			// Links
			if (jsonObj.conventions != undefined && jsonObj.conventions != null) {
				for (var i = 0; i < jsonObj.conventions.length; i++) {
					if (Convention.exists(jsonObj.conventions[i])){
						const newLinkObj = Convention.get(jsonObj.conventions[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.conventions.length; j++) {
							if (this.conventions[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.conventions.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Convention(jsonObj.conventions[i]);
						if ( ! this.conventions.includes(newForeignObj)) {
							this.conventions.push(newForeignObj);
						}
						newForeignObj.conventionSeries = this;
					}
				}
			}
			Convention.orderBy(this.conventions);
			if (jsonObj.admins != undefined && jsonObj.admins != null) {
				for (var i = 0; i < jsonObj.admins.length; i++) {
					if (Admin.exists(jsonObj.admins[i])){
						const newLinkObj = Admin.get(jsonObj.admins[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.admins.length; j++) {
							if (this.admins[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.admins.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Admin(jsonObj.admins[i]);
						if ( ! this.admins.includes(newForeignObj)) {
							this.admins.push(newForeignObj);
						}
						newForeignObj.conventionSeries = this;
					}
				}
			}
			Admin.orderBy(this.admins);
			
			ConventionSeries.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Convention Series";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name"];
	}

	static getAllFields() {
		return ["id", "name"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name"].includes(columnName)) {
			return ConventionSeries;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (ConventionSeries.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionSeries.options.fieldOrder !== undefined && ConventionSeries.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, ConventionSeries.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

ConventionSeries.list = [];
ConventionSeries.options = [];

class Convention extends DatabaseObject {
	constructor(jsonObj) {
		if (Convention.exists(jsonObj)) {
			return Convention.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.description = null; // String
		this.startDate = null; // Date
		this.endDate = null; // Date
		this.address = null; // String
		this.latitude = null; // Decimal
		this.longitude = null; // Decimal
		this.conventionSeries = null; // Int
		this.hardPlayerCap = null; // Int
		this.softPlayerCap = null; // Int
		this.signupKey = null; // String
		
		// Links
		this.links = [{tournaments: Tournament, label: "Tournaments", nTo1Link: true, linkField: 'convention'}, {admins: Admin, label: "Admins", nTo1Link: true, linkField: 'convention'}, {attendees: Attendee, label: "Attendees", nTo1Link: true, linkField: 'convention'}, {conventionMaps: ConventionMap, label: "Convention Maps", nTo1Link: true, linkField: 'convention'}];
		this.tournaments = [];
		this.admins = [];
		this.attendees = [];
		this.conventionMaps = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Convention.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.description = jsonObj.description;
			this.startDate = jsonObj.startDate;
			this.endDate = jsonObj.endDate;
			this.address = jsonObj.address;
			this.latitude = jsonObj.latitude;
			this.longitude = jsonObj.longitude;
			if (jsonObj.conventionSeries != null) {
				this.conventionSeries = ConventionSeries.exists(jsonObj.conventionSeries) ?
					ConventionSeries.get(jsonObj.conventionSeries) : new ConventionSeries(jsonObj.conventionSeries);
				if ( ! this.conventionSeries.conventions.includes(this)) {
					this.conventionSeries.conventions.push(this);
					ConventionSeries.orderBy(this.conventionSeries.conventions);
				}
			}
			this.hardPlayerCap = jsonObj.hardPlayerCap;
			this.softPlayerCap = jsonObj.softPlayerCap;
			this.signupKey = jsonObj.signupKey;
			
			// Links
			if (jsonObj.tournaments != undefined && jsonObj.tournaments != null) {
				for (var i = 0; i < jsonObj.tournaments.length; i++) {
					if (Tournament.exists(jsonObj.tournaments[i])){
						const newLinkObj = Tournament.get(jsonObj.tournaments[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.tournaments.length; j++) {
							if (this.tournaments[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.tournaments.push(newLinkObj);
						}
					} else {
						const newForeignObj = Tournament.newChild(jsonObj.tournaments[i]);
						if ( ! this.tournaments.includes(newForeignObj)) {
							this.tournaments.push(newForeignObj);
						}
						newForeignObj.convention = this;
					}
				}
			}
			Tournament.orderBy(this.tournaments);
			if (jsonObj.admins != undefined && jsonObj.admins != null) {
				for (var i = 0; i < jsonObj.admins.length; i++) {
					if (Admin.exists(jsonObj.admins[i])){
						const newLinkObj = Admin.get(jsonObj.admins[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.admins.length; j++) {
							if (this.admins[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.admins.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Admin(jsonObj.admins[i]);
						if ( ! this.admins.includes(newForeignObj)) {
							this.admins.push(newForeignObj);
						}
						newForeignObj.convention = this;
					}
				}
			}
			Admin.orderBy(this.admins);
			if (jsonObj.attendees != undefined && jsonObj.attendees != null) {
				for (var i = 0; i < jsonObj.attendees.length; i++) {
					if (Attendee.exists(jsonObj.attendees[i])){
						const newLinkObj = Attendee.get(jsonObj.attendees[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.attendees.length; j++) {
							if (this.attendees[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.attendees.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Attendee(jsonObj.attendees[i]);
						if ( ! this.attendees.includes(newForeignObj)) {
							this.attendees.push(newForeignObj);
						}
						newForeignObj.convention = this;
					}
				}
			}
			Attendee.orderBy(this.attendees);
			if (jsonObj.conventionMaps != undefined && jsonObj.conventionMaps != null) {
				for (var i = 0; i < jsonObj.conventionMaps.length; i++) {
					if (ConventionMap.exists(jsonObj.conventionMaps[i])){
						const newLinkObj = ConventionMap.get(jsonObj.conventionMaps[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.conventionMaps.length; j++) {
							if (this.conventionMaps[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.conventionMaps.push(newLinkObj);
						}
					} else {
						const newForeignObj = new ConventionMap(jsonObj.conventionMaps[i]);
						if ( ! this.conventionMaps.includes(newForeignObj)) {
							this.conventionMaps.push(newForeignObj);
						}
						newForeignObj.convention = this;
					}
				}
			}
			ConventionMap.orderBy(this.conventionMaps);
			
			Convention.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Convention";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "startDate", "endDate"];
	}

	static getAllFields() {
		return ["id", "name", "description", "startDate", "endDate", "address", "latitude", "longitude", "conventionSeries", "hardPlayerCap", "softPlayerCap", "signupKey"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "description", "startDate", "endDate", "address", "latitude", "longitude", "conventionSeriesID", "hardPlayerCap", "softPlayerCap", "signupKey"].includes(columnName)) {
			return Convention;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "conventionSeriesID":
				return "ConventionSeries";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "description":
				return null;
			case "startDate":
				return null;
			case "endDate":
				return null;
			case "address":
				return null;
			case "latitude":
				return null;
			case "longitude":
				return null;
			case "conventionSeries":
				return null;
			case "hardPlayerCap":
				return null;
			case "softPlayerCap":
				return null;
			case "signupKey":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "description":
				return ""; // TODO
			case "startDate":
				return ""; // TODO
			case "endDate":
				return ""; // TODO
			case "address":
				return ""; // TODO
			case "latitude":
				return ""; // TODO
			case "longitude":
				return ""; // TODO
			case "conventionSeries":
				return ""; // TODO
			case "hardPlayerCap":
				return ""; // TODO
			case "softPlayerCap":
				return ""; // TODO
			case "signupKey":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Convention.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Convention.includeField("description", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "description";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Description";
			if (this.description !== null) {
				fieldData["value"] = this.description;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Convention.includeField("startDate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "startDate";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "Start Date";
			if (this.startDate !== null) {
				fieldData["value"] = this.startDate;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Convention.includeField("endDate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "endDate";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "End Date";
			if (this.endDate !== null) {
				fieldData["value"] = this.endDate;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Convention.includeField("address", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "address";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Address";
			if (this.address !== null) {
				fieldData["value"] = this.address;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Convention.includeField("latitude", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "latitude";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "any";
			fieldData["label"] = "Latitude";
			if (this.latitude !== null) {
				fieldData["value"] = this.latitude;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Convention.includeField("longitude", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "longitude";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "any";
			fieldData["label"] = "Longitude";
			if (this.longitude !== null) {
				fieldData["value"] = this.longitude;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Convention.includeField("conventionSeries", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "conventionSeries";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = ConventionSeries.selectOptions(this.conventionSeries, this.selectFilters("conventionSeries", filterObjects));
			fieldData["optionClass"] = "ConventionSeries";
			fieldData["propertyForeignClass"] = ConventionSeries;
			fieldData["label"] = "Convention Series";
			if (this.conventionSeries !== undefined && this.conventionSeries !== null) {
				fieldData["value"] = this.conventionSeries.toDisplayString();
				fieldData["databaseObj"] = this.conventionSeries;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Convention.includeField("hardPlayerCap", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "hardPlayerCap";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Hard Player Cap";
			if (this.hardPlayerCap !== null) {
				fieldData["value"] = this.hardPlayerCap;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Convention.includeField("softPlayerCap", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "softPlayerCap";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Soft Player Cap";
			if (this.softPlayerCap !== null) {
				fieldData["value"] = this.softPlayerCap;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Convention.includeField("signupKey", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "signupKey";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Signup Key";
			if (this.signupKey !== null) {
				fieldData["value"] = this.signupKey;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Convention.options.fieldOrder !== undefined && Convention.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Convention.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "conventionSeries":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.conventionSeries = jsonObj;
				} else if (ConventionSeries.exists(jsonObj)) {
					this.conventionSeries = ConventionSeries.get(jsonObj);
				} else {
					this.conventionSeries = new ConventionSeries(jsonObj);
				}
				break;
		}
	}

}

Convention.list = [];
Convention.options = [];

class Tournament extends DatabaseObject {
	constructor(jsonObj) {
		if (Tournament.exists(jsonObj)) {
			return Tournament.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.description = null; // String
		this.convention = null; // Int
		this.startTime = null; // Datetime
		this.endDate = null; // Date
		this.address = null; // String
		this.latitude = null; // Decimal
		this.longitude = null; // Decimal
		this.started = null; // Boolean
		this.finished = null; // Boolean
		this.allowSignupAfter = null; // Datetime
		this.allowArmySubmissionAfter = null; // Datetime
		this.allowLateSignup = null; // Boolean
		this.online = null; // Boolean
		this.maxEntries = null; // Int
		this.teamSize = null; // Int
		this.maxNumPlayersPerGame = null; // Int
		this.numLossesToBeEliminated = null; // Int
		this.pairAfterEliminated = null; // Boolean
		this.roundLengthMinutes = null; // Int
		this.bracket = null; // Int
		this.ignoreInStandings = null; // Boolean
		this.figureSet = null; // Int
		this.sheetId = null; // String
		
		// Links
		this.links = [{admins: Admin, label: "Admins", nTo1Link: true, linkField: 'tournament'}, {players: Player, label: "Players", nTo1Link: true, linkField: 'tournament'}, {rounds: Round, label: "Rounds", nTo1Link: true, linkField: 'tournament'}, {gameMaps: GameMap, label: "Game Maps", nTo1Link: true, linkField: 'tournament'}, {tournamentFormatTags: TournamentFormatTag, label: "Tournament Format Tags", nTo1Link: true, linkField: 'tournament'}, {tournamentIncludesFigureSetSubGroups: TournamentIncludesFigureSetSubGroup, label: "Tournament Includes Figure Set Sub Groups", nTo1Link: true, linkField: 'tournament'}, {seasons: Season, label: "Seasons"}];
		this.admins = [];
		this.players = [];
		this.rounds = [];
		this.gameMaps = [];
		this.tournamentFormatTags = [];
		this.tournamentIncludesFigureSetSubGroups = [];
		this.seasons = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Tournament.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.description = jsonObj.description;
			if (jsonObj.convention != null) {
				this.convention = Convention.exists(jsonObj.convention) ?
					Convention.get(jsonObj.convention) : new Convention(jsonObj.convention);
				if ( ! this.convention.tournaments.includes(this)) {
					this.convention.tournaments.push(this);
					Convention.orderBy(this.convention.tournaments);
				}
			}
			this.startTime = jsonObj.startTime;
			this.endDate = jsonObj.endDate;
			this.address = jsonObj.address;
			this.latitude = jsonObj.latitude;
			this.longitude = jsonObj.longitude;
			this.started = jsonObj.started;
			this.finished = jsonObj.finished;
			this.allowSignupAfter = jsonObj.allowSignupAfter;
			this.allowArmySubmissionAfter = jsonObj.allowArmySubmissionAfter;
			this.allowLateSignup = jsonObj.allowLateSignup;
			this.online = jsonObj.online;
			this.maxEntries = jsonObj.maxEntries;
			this.teamSize = jsonObj.teamSize;
			this.maxNumPlayersPerGame = jsonObj.maxNumPlayersPerGame;
			this.numLossesToBeEliminated = jsonObj.numLossesToBeEliminated;
			this.pairAfterEliminated = jsonObj.pairAfterEliminated;
			this.roundLengthMinutes = jsonObj.roundLengthMinutes;
			if (jsonObj.bracket != null) {
				this.bracket = Bracket.exists(jsonObj.bracket) ?
					Bracket.get(jsonObj.bracket) : new Bracket(jsonObj.bracket);
				if ( ! this.bracket.tournaments.includes(this)) {
					this.bracket.tournaments.push(this);
					Bracket.orderBy(this.bracket.tournaments);
				}
			}
			this.ignoreInStandings = jsonObj.ignoreInStandings;
			if (jsonObj.figureSet != null) {
				this.figureSet = FigureSet.exists(jsonObj.figureSet) ?
					FigureSet.get(jsonObj.figureSet) : new FigureSet(jsonObj.figureSet);
				if ( ! this.figureSet.tournaments.includes(this)) {
					this.figureSet.tournaments.push(this);
					FigureSet.orderBy(this.figureSet.tournaments);
				}
			}
			this.sheetId = jsonObj.sheetId;
			
			// Links
			if (jsonObj.admins != undefined && jsonObj.admins != null) {
				for (var i = 0; i < jsonObj.admins.length; i++) {
					if (Admin.exists(jsonObj.admins[i])){
						const newLinkObj = Admin.get(jsonObj.admins[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.admins.length; j++) {
							if (this.admins[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.admins.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Admin(jsonObj.admins[i]);
						if ( ! this.admins.includes(newForeignObj)) {
							this.admins.push(newForeignObj);
						}
						newForeignObj.tournament = this;
					}
				}
			}
			Admin.orderBy(this.admins);
			if (jsonObj.players != undefined && jsonObj.players != null) {
				for (var i = 0; i < jsonObj.players.length; i++) {
					if (Player.exists(jsonObj.players[i])){
						const newLinkObj = Player.get(jsonObj.players[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.players.length; j++) {
							if (this.players[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.players.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Player(jsonObj.players[i]);
						if ( ! this.players.includes(newForeignObj)) {
							this.players.push(newForeignObj);
						}
						newForeignObj.tournament = this;
					}
				}
			}
			Player.orderBy(this.players);
			if (jsonObj.rounds != undefined && jsonObj.rounds != null) {
				for (var i = 0; i < jsonObj.rounds.length; i++) {
					if (Round.exists(jsonObj.rounds[i])){
						const newLinkObj = Round.get(jsonObj.rounds[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.rounds.length; j++) {
							if (this.rounds[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.rounds.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Round(jsonObj.rounds[i]);
						if ( ! this.rounds.includes(newForeignObj)) {
							this.rounds.push(newForeignObj);
						}
						newForeignObj.tournament = this;
					}
				}
			}
			Round.orderBy(this.rounds);
			if (jsonObj.gameMaps != undefined && jsonObj.gameMaps != null) {
				for (var i = 0; i < jsonObj.gameMaps.length; i++) {
					if (GameMap.exists(jsonObj.gameMaps[i])){
						const newLinkObj = GameMap.get(jsonObj.gameMaps[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.gameMaps.length; j++) {
							if (this.gameMaps[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.gameMaps.push(newLinkObj);
						}
					} else {
						const newForeignObj = new GameMap(jsonObj.gameMaps[i]);
						if ( ! this.gameMaps.includes(newForeignObj)) {
							this.gameMaps.push(newForeignObj);
						}
						newForeignObj.tournament = this;
					}
				}
			}
			GameMap.orderBy(this.gameMaps);
			if (jsonObj.tournamentFormatTags != undefined && jsonObj.tournamentFormatTags != null) {
				for (var i = 0; i < jsonObj.tournamentFormatTags.length; i++) {
					if (TournamentFormatTag.exists(jsonObj.tournamentFormatTags[i])){
						const newLinkObj = TournamentFormatTag.get(jsonObj.tournamentFormatTags[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.tournamentFormatTags.length; j++) {
							if (this.tournamentFormatTags[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.tournamentFormatTags.push(newLinkObj);
						}
					} else {
						const newForeignObj = new TournamentFormatTag(jsonObj.tournamentFormatTags[i]);
						if ( ! this.tournamentFormatTags.includes(newForeignObj)) {
							this.tournamentFormatTags.push(newForeignObj);
						}
						newForeignObj.tournament = this;
					}
				}
			}
			TournamentFormatTag.orderBy(this.tournamentFormatTags);
			if (jsonObj.tournamentIncludesFigureSetSubGroups != undefined && jsonObj.tournamentIncludesFigureSetSubGroups != null) {
				for (var i = 0; i < jsonObj.tournamentIncludesFigureSetSubGroups.length; i++) {
					if (TournamentIncludesFigureSetSubGroup.exists(jsonObj.tournamentIncludesFigureSetSubGroups[i])){
						const newLinkObj = TournamentIncludesFigureSetSubGroup.get(jsonObj.tournamentIncludesFigureSetSubGroups[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.tournamentIncludesFigureSetSubGroups.length; j++) {
							if (this.tournamentIncludesFigureSetSubGroups[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.tournamentIncludesFigureSetSubGroups.push(newLinkObj);
						}
					} else {
						const newForeignObj = new TournamentIncludesFigureSetSubGroup(jsonObj.tournamentIncludesFigureSetSubGroups[i]);
						if ( ! this.tournamentIncludesFigureSetSubGroups.includes(newForeignObj)) {
							this.tournamentIncludesFigureSetSubGroups.push(newForeignObj);
						}
						newForeignObj.tournament = this;
					}
				}
			}
			TournamentIncludesFigureSetSubGroup.orderBy(this.tournamentIncludesFigureSetSubGroups);
			if (jsonObj.seasons != undefined && jsonObj.seasons != null) {
				for (var i = 0; i < jsonObj.seasons.length; i++) {
					if (Season.exists(jsonObj.seasons[i])){
						const newLinkObj = Season.get(jsonObj.seasons[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.seasons.length; j++) {
							if (this.seasons[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.seasons.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Season(jsonObj.seasons[i]);
						if ( ! this.seasons.includes(newForeignObj)) {
							this.seasons.push(newForeignObj);
						}
					}
				}
			}
			Season.orderBy(this.seasons);
			
			Tournament.orderBy();
		}
	}

	static newChild(jsonObj) {
		if (jsonObj.className !== undefined && jsonObj.className !== null) {
			return new databaseObjectClassMap[jsonObj.className](jsonObj);
		}
	}
	
	// @DoNotUpdate
	includesVC() {
		for (let i = 0; i < this.tournamentIncludesFigureSetSubGroups.length; i++) {
			if (this.tournamentIncludesFigureSetSubGroups[i].figureSetSubGroup.name == "VC") {
				return true;
			}
		}
		return false;
	}


	// @DoNotUpdate
	static getOrderBy() {
		return ["startTime", "name"];
	}

	static label() {
		return "Tournament";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getTournamentRequiredFields() {
		return ["id", "name", "startTime", "endDate", "started", "finished", "allowLateSignup", "online", "teamSize", "maxNumPlayersPerGame", "pairAfterEliminated", "ignoreInStandings", "figureSet"];
	}

	static getTournamentAllFields() {
		return ["id", "name", "description", "convention", "startTime", "endDate", "address", "latitude", "longitude", "started", "finished", "allowSignupAfter", "allowArmySubmissionAfter", "allowLateSignup", "online", "maxEntries", "teamSize", "maxNumPlayersPerGame", "numLossesToBeEliminated", "pairAfterEliminated", "roundLengthMinutes", "bracket", "ignoreInStandings", "figureSet", "sheetId"];
	}

	static getNtoMLinkClasses() {
		return {seasons: Season};
	}

	static isAbstract() {
		return true;
	}

	static getChildClasses() {
		return [HeroscapeTournament, GameTournament];
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "description", "conventionID", "startTime", "endDate", "address", "latitude", "longitude", "started", "finished", "allowSignupAfter", "allowArmySubmissionAfter", "allowLateSignup", "online", "maxEntries", "teamSize", "maxNumPlayersPerGame", "numLossesToBeEliminated", "pairAfterEliminated", "roundLengthMinutes", "bracketID", "ignoreInStandings", "figureSetID", "sheetId"].includes(columnName)) {
			return Tournament;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "conventionID":
				return "Convention";
			case "bracketID":
				return "Bracket";
			case "figureSetID":
				return "FigureSet";
		}
		return null;
	}

	static TournamentGetActionNames() {
		return [];
	}

	TournamentGetAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	// @DoNotUpdate
	toDisplayString() {
		return this.fullDisplayName();
	}

	// @DoNotUpdate
	fullDisplayName() {
		var tournamentName = "";
		if (this.convention != null) {
			tournamentName = this.convention.name + " | ";
		}
		if (this.seasons != null && this.seasons.length > 0) {
			const season = this.seasons[0];
			tournamentName += season.fullDisplayName() + " | ";
		}
		tournamentName += this.name;
		return tournamentName;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	TournamentSelectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "description":
				return null;
			case "convention":
				return null;
			case "startTime":
				return null;
			case "endDate":
				return null;
			case "address":
				return null;
			case "latitude":
				return null;
			case "longitude":
				return null;
			case "started":
				return null;
			case "finished":
				return null;
			case "allowSignupAfter":
				return null;
			case "allowArmySubmissionAfter":
				return null;
			case "allowLateSignup":
				return null;
			case "online":
				return null;
			case "maxEntries":
				return null;
			case "teamSize":
				return null;
			case "maxNumPlayersPerGame":
				return null;
			case "numLossesToBeEliminated":
				return null;
			case "pairAfterEliminated":
				return null;
			case "roundLengthMinutes":
				return null;
			case "bracket":
				return null;
			case "ignoreInStandings":
				return null;
			case "figureSet":
				return null;
			case "sheetId":
				return null;
			case "seasons":
				return null;
			default:
				return null;
		}
	}

	TournamentGetTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "description":
				return ""; // TODO
			case "convention":
				return ""; // TODO
			case "startTime":
				return ""; // TODO
			case "endDate":
				return ""; // TODO
			case "address":
				return ""; // TODO
			case "latitude":
				return ""; // TODO
			case "longitude":
				return ""; // TODO
			case "started":
				return ""; // TODO
			case "finished":
				return ""; // TODO
			case "allowSignupAfter":
				return ""; // TODO
			case "allowArmySubmissionAfter":
				return ""; // TODO
			case "allowLateSignup":
				return ""; // TODO
			case "online":
				return ""; // TODO
			case "maxEntries":
				return ""; // TODO
			case "teamSize":
				return ""; // TODO
			case "maxNumPlayersPerGame":
				return ""; // TODO
			case "numLossesToBeEliminated":
				return ""; // TODO
			case "pairAfterEliminated":
				return ""; // TODO
			case "roundLengthMinutes":
				return ""; // TODO
			case "bracket":
				return ""; // TODO
			case "ignoreInStandings":
				return ""; // TODO
			case "figureSet":
				return ""; // TODO
			case "sheetId":
				return ""; // TODO
			default:
				return "";
		}
	}

	TournamentDataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Tournament.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("description", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "description";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Description";
			if (this.description !== null) {
				fieldData["value"] = this.description;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("convention", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "convention";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Convention.selectOptions(this.convention, this.selectFilters("convention", filterObjects));
			fieldData["optionClass"] = "Convention";
			fieldData["propertyForeignClass"] = Convention;
			fieldData["label"] = "Convention";
			if (this.convention !== undefined && this.convention !== null) {
				fieldData["value"] = this.convention.toDisplayString();
				fieldData["databaseObj"] = this.convention;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("startTime", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "startTime";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "datetime-local";
			fieldData["label"] = "Start Time";
			if (this.startTime !== null) {
				fieldData["value"] = forEditing ? this.startTime.replace(' ','T') : new Date(this.startTime).toString();
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("endDate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "endDate";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "End Date";
			if (this.endDate !== null) {
				fieldData["value"] = this.endDate;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("address", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "address";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Address";
			if (this.address !== null) {
				fieldData["value"] = this.address;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("latitude", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "latitude";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "any";
			fieldData["label"] = "Latitude";
			if (this.latitude !== null) {
				fieldData["value"] = this.latitude;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("longitude", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "longitude";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "any";
			fieldData["label"] = "Longitude";
			if (this.longitude !== null) {
				fieldData["value"] = this.longitude;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("started", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "started";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Started";
			if (this.started !== null) {
				fieldData["value"] = this.started;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("finished", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "finished";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Finished";
			if (this.finished !== null) {
				fieldData["value"] = this.finished;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("allowSignupAfter", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "allowSignupAfter";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "datetime-local";
			fieldData["label"] = "Allow Signup After";
			if (this.allowSignupAfter !== null) {
				fieldData["value"] = forEditing ? this.allowSignupAfter.replace(' ','T') : new Date(this.allowSignupAfter).toString();
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("allowArmySubmissionAfter", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "allowArmySubmissionAfter";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "datetime-local";
			fieldData["label"] = "Allow Army Submission After";
			if (this.allowArmySubmissionAfter !== null) {
				fieldData["value"] = forEditing ? this.allowArmySubmissionAfter.replace(' ','T') : new Date(this.allowArmySubmissionAfter).toString();
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("allowLateSignup", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "allowLateSignup";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Allow Late Signup";
			if (this.allowLateSignup !== null) {
				fieldData["value"] = this.allowLateSignup;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("online", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "online";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Online";
			if (this.online !== null) {
				fieldData["value"] = this.online;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("maxEntries", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "maxEntries";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Max Entries";
			if (this.maxEntries !== null) {
				fieldData["value"] = this.maxEntries;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("teamSize", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "teamSize";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Team Size";
			if (this.teamSize !== null) {
				fieldData["value"] = this.teamSize;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("maxNumPlayersPerGame", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "maxNumPlayersPerGame";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Max Num Players Per Game";
			if (this.maxNumPlayersPerGame !== null) {
				fieldData["value"] = this.maxNumPlayersPerGame;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("numLossesToBeEliminated", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "numLossesToBeEliminated";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Num Losses To Be Eliminated";
			if (this.numLossesToBeEliminated !== null) {
				fieldData["value"] = this.numLossesToBeEliminated;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("pairAfterEliminated", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "pairAfterEliminated";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Pair After Eliminated";
			if (this.pairAfterEliminated !== null) {
				fieldData["value"] = this.pairAfterEliminated;
			} else {
				fieldData["value"] = true; // Default value
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("roundLengthMinutes", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "roundLengthMinutes";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Round Length Minutes";
			if (this.roundLengthMinutes !== null) {
				fieldData["value"] = this.roundLengthMinutes;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("bracket", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "bracket";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Bracket.selectOptions(this.bracket, this.selectFilters("bracket", filterObjects));
			fieldData["optionClass"] = "Bracket";
			fieldData["propertyForeignClass"] = Bracket;
			fieldData["label"] = "Bracket";
			if (this.bracket !== undefined && this.bracket !== null) {
				fieldData["value"] = this.bracket.toDisplayString();
				fieldData["databaseObj"] = this.bracket;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("ignoreInStandings", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "ignoreInStandings";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Ignore In Standings";
			if (this.ignoreInStandings !== null) {
				fieldData["value"] = this.ignoreInStandings;
			} else {
				fieldData["value"] = true; // Default value
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("figureSet", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "figureSet";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = FigureSet.selectOptions(this.figureSet, this.selectFilters("figureSet", filterObjects));
			fieldData["optionClass"] = "FigureSet";
			fieldData["propertyForeignClass"] = FigureSet;
			fieldData["label"] = "Figure Set";
			if (this.figureSet !== undefined && this.figureSet !== null) {
				fieldData["value"] = this.figureSet.toDisplayString();
				fieldData["databaseObj"] = this.figureSet;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Tournament.includeField("sheetId", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "sheetId";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Sheet Id";
			if (this.sheetId !== null) {
				fieldData["value"] = this.sheetId;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Tournament.options.fieldOrder !== undefined && Tournament.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Tournament.options.fieldOrder);
		}
		return data;
	}

	TournamentSet(field, jsonObj) {
		switch (field) {
			case "convention":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.convention = jsonObj;
				} else if (Convention.exists(jsonObj)) {
					this.convention = Convention.get(jsonObj);
				} else {
					this.convention = new Convention(jsonObj);
				}
				break;
			case "bracket":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.bracket = jsonObj;
				} else if (Bracket.exists(jsonObj)) {
					this.bracket = Bracket.get(jsonObj);
				} else {
					this.bracket = new Bracket(jsonObj);
				}
				break;
			case "figureSet":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.figureSet = jsonObj;
				} else if (FigureSet.exists(jsonObj)) {
					this.figureSet = FigureSet.get(jsonObj);
				} else {
					this.figureSet = new FigureSet(jsonObj);
				}
				break;
		}
	}

}

Tournament.list = [];
Tournament.options = [];

class Admin extends DatabaseObject {
	constructor(jsonObj) {
		if (Admin.exists(jsonObj)) {
			return Admin.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.user = null; // Int
		this.convention = null; // Int
		this.conventionSeries = null; // Int
		this.tournament = null; // Int
		this.league = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Admin.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.user != null) {
				this.user = User.exists(jsonObj.user) ?
					User.get(jsonObj.user) : new User(jsonObj.user);
				if ( ! this.user.admins.includes(this)) {
					this.user.admins.push(this);
					User.orderBy(this.user.admins);
				}
			}
			if (jsonObj.convention != null) {
				this.convention = Convention.exists(jsonObj.convention) ?
					Convention.get(jsonObj.convention) : new Convention(jsonObj.convention);
				if ( ! this.convention.admins.includes(this)) {
					this.convention.admins.push(this);
					Convention.orderBy(this.convention.admins);
				}
			}
			if (jsonObj.conventionSeries != null) {
				this.conventionSeries = ConventionSeries.exists(jsonObj.conventionSeries) ?
					ConventionSeries.get(jsonObj.conventionSeries) : new ConventionSeries(jsonObj.conventionSeries);
				if ( ! this.conventionSeries.admins.includes(this)) {
					this.conventionSeries.admins.push(this);
					ConventionSeries.orderBy(this.conventionSeries.admins);
				}
			}
			if (jsonObj.tournament != null) {
				this.tournament = Tournament.exists(jsonObj.tournament) ?
					Tournament.get(jsonObj.tournament) : Tournament.newChild(jsonObj.tournament);
				if ( ! this.tournament.admins.includes(this)) {
					this.tournament.admins.push(this);
					Tournament.orderBy(this.tournament.admins);
				}
			}
			if (jsonObj.league != null) {
				this.league = League.exists(jsonObj.league) ?
					League.get(jsonObj.league) : new League(jsonObj.league);
				if ( ! this.league.admins.includes(this)) {
					this.league.admins.push(this);
					League.orderBy(this.league.admins);
				}
			}
			
			// Links
			
			Admin.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Admin";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "user"];
	}

	static getAllFields() {
		return ["id", "user", "convention", "conventionSeries", "tournament", "league"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "userID", "conventionID", "conventionSeriesID", "tournamentID", "leagueID"].includes(columnName)) {
			return Admin;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "userID":
				return "User";
			case "conventionID":
				return "Convention";
			case "conventionSeriesID":
				return "ConventionSeries";
			case "tournamentID":
				return "Tournament";
			case "leagueID":
				return "League";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "user":
				return null;
			case "convention":
				return null;
			case "conventionSeries":
				return null;
			case "tournament":
				return null;
			case "league":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "user":
				return ""; // TODO
			case "convention":
				return ""; // TODO
			case "conventionSeries":
				return ""; // TODO
			case "tournament":
				return ""; // TODO
			case "league":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Admin.includeField("user", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "user";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = User.selectOptions(this.user, this.selectFilters("user", filterObjects));
			fieldData["optionClass"] = "User";
			fieldData["propertyForeignClass"] = User;
			fieldData["label"] = "User";
			if (this.user !== undefined && this.user !== null) {
				fieldData["value"] = this.user.toDisplayString();
				fieldData["databaseObj"] = this.user;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Admin.includeField("convention", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "convention";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Convention.selectOptions(this.convention, this.selectFilters("convention", filterObjects));
			fieldData["optionClass"] = "Convention";
			fieldData["propertyForeignClass"] = Convention;
			fieldData["label"] = "Convention";
			if (this.convention !== undefined && this.convention !== null) {
				fieldData["value"] = this.convention.toDisplayString();
				fieldData["databaseObj"] = this.convention;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Admin.includeField("conventionSeries", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "conventionSeries";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = ConventionSeries.selectOptions(this.conventionSeries, this.selectFilters("conventionSeries", filterObjects));
			fieldData["optionClass"] = "ConventionSeries";
			fieldData["propertyForeignClass"] = ConventionSeries;
			fieldData["label"] = "Convention Series";
			if (this.conventionSeries !== undefined && this.conventionSeries !== null) {
				fieldData["value"] = this.conventionSeries.toDisplayString();
				fieldData["databaseObj"] = this.conventionSeries;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Admin.includeField("tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "tournament";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Tournament.selectOptions(this.tournament, this.selectFilters("tournament", filterObjects));
			fieldData["optionClass"] = "Tournament";
			fieldData["propertyForeignClass"] = Tournament;
			fieldData["label"] = "Tournament";
			if (this.tournament !== undefined && this.tournament !== null) {
				fieldData["value"] = this.tournament.toDisplayString();
				fieldData["databaseObj"] = this.tournament;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Admin.includeField("league", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "league";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = League.selectOptions(this.league, this.selectFilters("league", filterObjects));
			fieldData["optionClass"] = "League";
			fieldData["propertyForeignClass"] = League;
			fieldData["label"] = "League";
			if (this.league !== undefined && this.league !== null) {
				fieldData["value"] = this.league.toDisplayString();
				fieldData["databaseObj"] = this.league;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Admin.options.fieldOrder !== undefined && Admin.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Admin.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "user":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.user = jsonObj;
				} else if (User.exists(jsonObj)) {
					this.user = User.get(jsonObj);
				} else {
					this.user = new User(jsonObj);
				}
				break;
			case "convention":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.convention = jsonObj;
				} else if (Convention.exists(jsonObj)) {
					this.convention = Convention.get(jsonObj);
				} else {
					this.convention = new Convention(jsonObj);
				}
				break;
			case "conventionSeries":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.conventionSeries = jsonObj;
				} else if (ConventionSeries.exists(jsonObj)) {
					this.conventionSeries = ConventionSeries.get(jsonObj);
				} else {
					this.conventionSeries = new ConventionSeries(jsonObj);
				}
				break;
			case "tournament":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.tournament = jsonObj;
				} else if (Tournament.exists(jsonObj)) {
					this.tournament = Tournament.get(jsonObj);
				} else {
					this.tournament = new Tournament(jsonObj);
				}
				break;
			case "league":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.league = jsonObj;
				} else if (League.exists(jsonObj)) {
					this.league = League.get(jsonObj);
				} else {
					this.league = new League(jsonObj);
				}
				break;
		}
	}

}

Admin.list = [];
Admin.options = [];

class Player extends DatabaseObject {
	constructor(jsonObj) {
		if (Player.exists(jsonObj)) {
			return Player.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.user = null; // Int
		this.tournament = null; // Int
		this.teamCaptain = null; // Int
		this.active = null; // Boolean
		
		// Links
		this.links = [{players: Player, label: "Players", nTo1Link: true, linkField: 'teamCaptain'}, {playerArmys: PlayerArmy, label: "Player Armys", nTo1Link: true, linkField: 'player'}, {heroscapeGamePlayers: HeroscapeGamePlayer, label: "Heroscape Game Players", nTo1Link: true, linkField: 'player'}, {bracketEntrys: BracketEntry, label: "Bracket Entrys", nTo1Link: true, linkField: 'player'}];
		this.players = [];
		this.playerArmys = [];
		this.heroscapeGamePlayers = [];
		this.bracketEntrys = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Player.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			if (jsonObj.user != null) {
				this.user = User.exists(jsonObj.user) ?
					User.get(jsonObj.user) : new User(jsonObj.user);
				if ( ! this.user.players.includes(this)) {
					this.user.players.push(this);
					User.orderBy(this.user.players);
				}
			}
			if (jsonObj.tournament != null) {
				this.tournament = Tournament.exists(jsonObj.tournament) ?
					Tournament.get(jsonObj.tournament) : Tournament.newChild(jsonObj.tournament);
				if ( ! this.tournament.players.includes(this)) {
					this.tournament.players.push(this);
					Tournament.orderBy(this.tournament.players);
				}
			}
			if (jsonObj.teamCaptain != null) {
				this.teamCaptain = Player.exists(jsonObj.teamCaptain) ?
					Player.get(jsonObj.teamCaptain) : new Player(jsonObj.teamCaptain);
				if ( ! this.teamCaptain.players.includes(this)) {
					this.teamCaptain.players.push(this);
					Player.orderBy(this.teamCaptain.players);
				}
			}
			this.active = jsonObj.active;
			
			// Links
			if (jsonObj.players != undefined && jsonObj.players != null) {
				for (var i = 0; i < jsonObj.players.length; i++) {
					if (Player.exists(jsonObj.players[i])){
						const newLinkObj = Player.get(jsonObj.players[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.players.length; j++) {
							if (this.players[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.players.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Player(jsonObj.players[i]);
						if ( ! this.players.includes(newForeignObj)) {
							this.players.push(newForeignObj);
						}
						newForeignObj.teamCaptain = this;
					}
				}
			}
			Player.orderBy(this.players);
			if (jsonObj.playerArmys != undefined && jsonObj.playerArmys != null) {
				for (var i = 0; i < jsonObj.playerArmys.length; i++) {
					if (PlayerArmy.exists(jsonObj.playerArmys[i])){
						const newLinkObj = PlayerArmy.get(jsonObj.playerArmys[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.playerArmys.length; j++) {
							if (this.playerArmys[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.playerArmys.push(newLinkObj);
						}
					} else {
						const newForeignObj = new PlayerArmy(jsonObj.playerArmys[i]);
						if ( ! this.playerArmys.includes(newForeignObj)) {
							this.playerArmys.push(newForeignObj);
						}
						newForeignObj.player = this;
					}
				}
			}
			PlayerArmy.orderBy(this.playerArmys);
			if (jsonObj.heroscapeGamePlayers != undefined && jsonObj.heroscapeGamePlayers != null) {
				for (var i = 0; i < jsonObj.heroscapeGamePlayers.length; i++) {
					if (HeroscapeGamePlayer.exists(jsonObj.heroscapeGamePlayers[i])){
						const newLinkObj = HeroscapeGamePlayer.get(jsonObj.heroscapeGamePlayers[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.heroscapeGamePlayers.length; j++) {
							if (this.heroscapeGamePlayers[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.heroscapeGamePlayers.push(newLinkObj);
						}
					} else {
						const newForeignObj = new HeroscapeGamePlayer(jsonObj.heroscapeGamePlayers[i]);
						if ( ! this.heroscapeGamePlayers.includes(newForeignObj)) {
							this.heroscapeGamePlayers.push(newForeignObj);
						}
						newForeignObj.player = this;
					}
				}
			}
			HeroscapeGamePlayer.orderBy(this.heroscapeGamePlayers);
			if (jsonObj.bracketEntrys != undefined && jsonObj.bracketEntrys != null) {
				for (var i = 0; i < jsonObj.bracketEntrys.length; i++) {
					if (BracketEntry.exists(jsonObj.bracketEntrys[i])){
						const newLinkObj = BracketEntry.get(jsonObj.bracketEntrys[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.bracketEntrys.length; j++) {
							if (this.bracketEntrys[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.bracketEntrys.push(newLinkObj);
						}
					} else {
						const newForeignObj = new BracketEntry(jsonObj.bracketEntrys[i]);
						if ( ! this.bracketEntrys.includes(newForeignObj)) {
							this.bracketEntrys.push(newForeignObj);
						}
						newForeignObj.player = this;
					}
				}
			}
			BracketEntry.orderBy(this.bracketEntrys);
			
			Player.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Player";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "active"];
	}

	static getAllFields() {
		return ["id", "name", "user", "tournament", "teamCaptain", "active"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "userID", "tournamentID", "teamCaptainID", "active"].includes(columnName)) {
			return Player;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "userID":
				return "User";
			case "tournamentID":
				return "Tournament";
			case "teamCaptainID":
				return "Player";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	// @DoNotUpdate
	wins() {
		var win = 0; 
		for (let i = 0; i < this.heroscapeGamePlayers.length; i++) {
			if (this.tournament == null) {
				console.log("wtf");
			}
			if (this.tournament.maxNumPlayersPerGame == 2) {
				if (this.heroscapeGamePlayers[i].result == 2) {
					win++;
				}
			} else {
				// TODO 
			}
		}
		return win;
	}

	// @DoNotUpdate
	losses() {
		var loss = 0; 
		for (let i = 0; i < this.heroscapeGamePlayers.length; i++) {
			if (this.heroscapeGamePlayers[i].result == 0) {
				loss++;
			}
		}
		return loss;
	}

	// @DoNotUpdate
	ties() {
		var tie = 0; 
		for (let i = 0; i < this.heroscapeGamePlayers.length; i++) {
			//if (this.tournament != null) {
			if (this.tournament.maxNumPlayersPerGame == 2) {
				if (this.heroscapeGamePlayers[i].result == 1) {
					tie++;
				}
			} else {
				// TODO 
			}
			//}
		}
		return tie;
	}

	// @DoNotUpdate
	opponentWins() {
		var opponentWins = 0;
		for (let i = 0; i < this.heroscapeGamePlayers.length; i++) {
			const game = this.heroscapeGamePlayers[i].game;
			if (game.heroscapeGamePlayers.length == 2) {
				const opponent = game.heroscapeGamePlayers[0].id == this.heroscapeGamePlayers[i].id
					? game.heroscapeGamePlayers[1].player
					: game.heroscapeGamePlayers[0].player;
				if (opponent !== null) {
					opponentWins += opponent.wins();
				}
			} else {
				// TODO : Handle Multiplayer case
			}
		}
		return opponentWins;
	}

	// @DoNotUpdate
	opponentLosses() {
		var opponentLosses = 0;
		for (let i = 0; i < this.heroscapeGamePlayers.length; i++) {
			const game = this.heroscapeGamePlayers[i].game;
			if (game.heroscapeGamePlayers.length == 2) {
				const opponent = game.heroscapeGamePlayers[0].id == this.heroscapeGamePlayers[i].id
					? game.heroscapeGamePlayers[1].player
					: game.heroscapeGamePlayers[0].player;
				if (opponent !== null) {
					opponentLosses += opponent.losses();
				} 
			} else {
				// TODO : Handle Multiplayer case
			}
		}
		return opponentLosses;
	}

	// @DoNotUpdate
	strengthOfSchedule() {
		var opponentWins = 0;
		var opponentLosses = 0;
		for (let i = 0; i < this.heroscapeGamePlayers.length; i++) {
			const game = this.heroscapeGamePlayers[i].game;
			if (game.heroscapeGamePlayers.length == 2) {
				const opponent = game.heroscapeGamePlayers[0].id == this.heroscapeGamePlayers[i].id
					? game.heroscapeGamePlayers[1].player
					: game.heroscapeGamePlayers[0].player;
				if (opponent !== null) {
					opponentWins += opponent.wins();
					opponentLosses += opponent.losses();
				}
			} else {
				// TODO : Handle Multiplayer case
			}
		}
		if (opponentLosses + opponentWins == 0) {
			return 0;
		}
		return (opponentWins / (opponentLosses + opponentWins)).toFixed(3);
	}

	// @DoNotUpdate
	calculatePoints() {
		var points = 0;
		for (let i = 0; i < this.heroscapeGamePlayers.length; i++) {
			if (this.heroscapeGamePlayers[i].result != null) {
				points += parseFloat(this.heroscapeGamePlayers[i].result);
			}
		}
		return points;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "user":
				return null;
			case "tournament":
				return null;
			case "teamCaptain":
				return null;
			case "active":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "user":
				return ""; // TODO
			case "tournament":
				return ""; // TODO
			case "teamCaptain":
				return ""; // TODO
			case "active":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Player.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Player.includeField("user", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "user";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = User.selectOptions(this.user, this.selectFilters("user", filterObjects));
			fieldData["optionClass"] = "User";
			fieldData["propertyForeignClass"] = User;
			fieldData["label"] = "User";
			if (this.user !== undefined && this.user !== null) {
				fieldData["value"] = this.user.toDisplayString();
				fieldData["databaseObj"] = this.user;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Player.includeField("tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "tournament";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Tournament.selectOptions(this.tournament, this.selectFilters("tournament", filterObjects));
			fieldData["optionClass"] = "Tournament";
			fieldData["propertyForeignClass"] = Tournament;
			fieldData["label"] = "Tournament";
			if (this.tournament !== undefined && this.tournament !== null) {
				fieldData["value"] = this.tournament.toDisplayString();
				fieldData["databaseObj"] = this.tournament;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Player.includeField("teamCaptain", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "teamCaptain";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Player.selectOptions(this.teamCaptain, this.selectFilters("teamCaptain", filterObjects));
			fieldData["optionClass"] = "Player";
			fieldData["propertyForeignClass"] = Player;
			fieldData["label"] = "Team Captain";
			if (this.teamCaptain !== undefined && this.teamCaptain !== null) {
				fieldData["value"] = this.teamCaptain.toDisplayString();
				fieldData["databaseObj"] = this.teamCaptain;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Player.includeField("active", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "active";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Active";
			if (this.active !== null) {
				fieldData["value"] = this.active;
			} else {
				fieldData["value"] = true; // Default value
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Player.options.fieldOrder !== undefined && Player.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Player.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "user":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.user = jsonObj;
				} else if (User.exists(jsonObj)) {
					this.user = User.get(jsonObj);
				} else {
					this.user = new User(jsonObj);
				}
				break;
			case "tournament":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.tournament = jsonObj;
				} else if (Tournament.exists(jsonObj)) {
					this.tournament = Tournament.get(jsonObj);
				} else {
					this.tournament = new Tournament(jsonObj);
				}
				break;
			case "teamCaptain":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.teamCaptain = jsonObj;
				} else if (Player.exists(jsonObj)) {
					this.teamCaptain = Player.get(jsonObj);
				} else {
					this.teamCaptain = new Player(jsonObj);
				}
				break;
		}
	}

}

Player.list = [];
Player.options = [];

class PlayerArmy extends DatabaseObject {
	constructor(jsonObj) {
		if (PlayerArmy.exists(jsonObj)) {
			return PlayerArmy.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.army = null; // String
		this.armyNumber = null; // Int
		this.player = null; // Int
		
		// Links
		this.links = [{playerArmyCards: PlayerArmyCard, label: "Player Army Cards", nTo1Link: true, linkField: 'playerArmy'}];
		this.playerArmyCards = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			PlayerArmy.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.army = jsonObj.army;
			this.armyNumber = jsonObj.armyNumber;
			if (jsonObj.player != null) {
				this.player = Player.exists(jsonObj.player) ?
					Player.get(jsonObj.player) : new Player(jsonObj.player);
				if ( ! this.player.playerArmys.includes(this)) {
					this.player.playerArmys.push(this);
					Player.orderBy(this.player.playerArmys);
				}
			}
			
			// Links
			if (jsonObj.playerArmyCards != undefined && jsonObj.playerArmyCards != null) {
				for (var i = 0; i < jsonObj.playerArmyCards.length; i++) {
					if (PlayerArmyCard.exists(jsonObj.playerArmyCards[i])){
						const newLinkObj = PlayerArmyCard.get(jsonObj.playerArmyCards[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.playerArmyCards.length; j++) {
							if (this.playerArmyCards[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.playerArmyCards.push(newLinkObj);
						}
					} else {
						const newForeignObj = new PlayerArmyCard(jsonObj.playerArmyCards[i]);
						if ( ! this.playerArmyCards.includes(newForeignObj)) {
							this.playerArmyCards.push(newForeignObj);
						}
						newForeignObj.playerArmy = this;
					}
				}
			}
			PlayerArmyCard.orderBy(this.playerArmyCards);
			
			PlayerArmy.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Player Army";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "army", "armyNumber", "player"];
	}

	static getAllFields() {
		return ["id", "army", "armyNumber", "player"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "army", "armyNumber", "playerID"].includes(columnName)) {
			return PlayerArmy;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "playerID":
				return "Player";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	// @DoNotUpdate
	points() {
		if (this.playerArmyCards.length > 0) {
			var delta = this.player.tournament.useDeltaPricing;
			var vc = this.player.tournament.includesVC();
			var points = 0;
			for (let i = 0; i < this.playerArmyCards.length; i++) {
				const playerArmyCard = this.playerArmyCards[i];
				const card = playerArmyCard.card;
				points += playerArmyCard.quantity * ((delta && vc)
					? card.pointsDeltaVc
					: delta 
						? card.pointsDeltaClassic
						: card.points);
			}
			return points;
		} else {
			return null;
		}
	}
	
	// @DoNotUpdate
	figures() {
		if (this.playerArmyCards.length > 0) {
			var figures = 0;
			for (let i = 0; i < this.playerArmyCards.length; i++) {
				const playerArmyCard = this.playerArmyCards[i];
				const card = playerArmyCard.card;
				figures += playerArmyCard.quantity * card.figureCount;
			}
			return figures;
		} else {
			return null;
		}
	}
	
	// @DoNotUpdate
	hexes() {
		if (this.playerArmyCards.length > 0) {
			var hexes = 0;
			for (let i = 0; i < this.playerArmyCards.length; i++) {
				const playerArmyCard = this.playerArmyCards[i];
				const card = playerArmyCard.card;
				hexes += playerArmyCard.quantity * card.hexCount;
			}
			return hexes;
		} else {
			return null;
		}
	}


	// @DoNotUpdate
	toDisplayString(figsOnly=false) {
		if (this.army === undefined) {
			return null;
		}
		
		// 1) Try to use PlayerArmyCard data 
		if (this.playerArmyCards.length > 0) {
			var armyStr = "";
			var refThis = this;
			this.playerArmyCards.sort(function(a, b) {
				const aWeight = a.quantity * 
					(refThis.player.tournament.useDeltaPricing
						? refThis.player.tournament.includeVC
							? a.card.pointsDeltaVc
							: a.card.pointsDeltaClassic
						: a.card.points);
				const bWeight = b.quantity * 
					(refThis.player.tournament.useDeltaPricing
						? refThis.player.tournament.includeVC
							? b.card.pointsDeltaVc
							: b.card.pointsDeltaClassic
						: b.card.points);
				if (aWeight > bWeight) {
					return -1;
				} else if (aWeight < bWeight) {
					return 1;
				}
				if (a.card.name > b.card.name) {
					return 1;
				} else if (a.card.name < b.card.name) {
					return -1;
				}
				return 0;
			});
			var builderUrl = "/builder/?units=";
			for (let i = 0; i < this.playerArmyCards.length; i++) {
				if (i > 0) {
					armyStr += ", ";
				}
				armyStr += this.playerArmyCards[i].card.name;
				if (this.playerArmyCards[i].card.commonality.toLowerCase() != "unique") {
					armyStr += " x" + this.playerArmyCards[i].quantity
				}
				if (i > 0) {
					builderUrl += ";"
				}
				builderUrl += this.playerArmyCards[i].card.name + "_" + this.playerArmyCards[i].quantity;
			}
			if (this.player != null && this.player.tournament != null) {
				if (this.player.tournament.useDeltaPricing) {
					builderUrl += "&delta=true";
				}
			}
			
			if ( ! figsOnly) {
				armyStr += " <a href='"+builderUrl+"' target='_blank'>Builder</a>";
				
				armyStr += " <span class='armyDisplayCost'>" + this.points() + "/" + this.figures() + /*"/" + this.hexes() +*/ "</span>";
				
				
			}
			return armyStr;
		}
		
		// 2) Try to use the static 'army' field
		if (this.army !== null) {
			return this.army;
		}
		
		// 3) Punt - nothing to return (army missing or hidden by permissions)
		return null;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "army":
				return null;
			case "armyNumber":
				return null;
			case "player":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "army":
				return ""; // TODO
			case "armyNumber":
				return ""; // TODO
			case "player":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (PlayerArmy.includeField("army", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "army";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Army";
			if (this.army !== null) {
				fieldData["value"] = this.army;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (PlayerArmy.includeField("armyNumber", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "armyNumber";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Army Number";
			if (this.armyNumber !== null) {
				fieldData["value"] = this.armyNumber;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (PlayerArmy.includeField("player", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "player";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Player.selectOptions(this.player, this.selectFilters("player", filterObjects));
			fieldData["optionClass"] = "Player";
			fieldData["propertyForeignClass"] = Player;
			fieldData["label"] = "Player";
			if (this.player !== undefined && this.player !== null) {
				fieldData["value"] = this.player.toDisplayString();
				fieldData["databaseObj"] = this.player;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (PlayerArmy.options.fieldOrder !== undefined && PlayerArmy.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, PlayerArmy.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "player":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.player = jsonObj;
				} else if (Player.exists(jsonObj)) {
					this.player = Player.get(jsonObj);
				} else {
					this.player = new Player(jsonObj);
				}
				break;
		}
	}

}

PlayerArmy.list = [];
PlayerArmy.options = [];

class Round extends DatabaseObject {
	constructor(jsonObj) {
		if (Round.exists(jsonObj)) {
			return Round.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.tournament = null; // Int
		this.name = null; // String
		this.order = null; // Int
		this.started = null; // Boolean
		
		// Links
		this.links = [{games: Game, label: "Games", nTo1Link: true, linkField: 'round'}];
		this.games = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Round.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.tournament != null) {
				this.tournament = Tournament.exists(jsonObj.tournament) ?
					Tournament.get(jsonObj.tournament) : Tournament.newChild(jsonObj.tournament);
				if ( ! this.tournament.rounds.includes(this)) {
					this.tournament.rounds.push(this);
					Tournament.orderBy(this.tournament.rounds);
				}
			}
			this.name = jsonObj.name;
			this.order = jsonObj.order;
			this.started = jsonObj.started;
			
			// Links
			if (jsonObj.games != undefined && jsonObj.games != null) {
				for (var i = 0; i < jsonObj.games.length; i++) {
					if (Game.exists(jsonObj.games[i])){
						const newLinkObj = Game.get(jsonObj.games[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.games.length; j++) {
							if (this.games[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.games.push(newLinkObj);
						}
					} else {
						const newForeignObj = Game.newChild(jsonObj.games[i]);
						if ( ! this.games.includes(newForeignObj)) {
							this.games.push(newForeignObj);
						}
						newForeignObj.round = this;
					}
				}
			}
			Game.orderBy(this.games);
			
			// Draggable
			this.objectIsDraggable = true;
			this.draggableProperty = "order"
			
			Round.orderBy();
		}
	}

	static getOrderBy() {
		return ["order"];
	}

	static label() {
		return "Round";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "tournament", "name", "order", "started"];
	}

	static getAllFields() {
		return ["id", "tournament", "name", "order", "started"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "tournamentID", "name", "order", "started"].includes(columnName)) {
			return Round;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "tournamentID":
				return "Tournament";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "tournament":
				return null;
			case "name":
				return null;
			case "order":
				return null;
			case "started":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "tournament":
				return ""; // TODO
			case "name":
				return ""; // TODO
			case "order":
				return ""; // TODO
			case "started":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Round.includeField("tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "tournament";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Tournament.selectOptions(this.tournament, this.selectFilters("tournament", filterObjects));
			fieldData["optionClass"] = "Tournament";
			fieldData["propertyForeignClass"] = Tournament;
			fieldData["label"] = "Tournament";
			if (this.tournament !== undefined && this.tournament !== null) {
				fieldData["value"] = this.tournament.toDisplayString();
				fieldData["databaseObj"] = this.tournament;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Round.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Round.includeField("order", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "order";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Order";
			if (this.order !== null) {
				fieldData["value"] = this.order;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Round.includeField("started", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "started";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Started";
			if (this.started !== null) {
				fieldData["value"] = this.started;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Round.options.fieldOrder !== undefined && Round.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Round.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "tournament":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.tournament = jsonObj;
				} else if (Tournament.exists(jsonObj)) {
					this.tournament = Tournament.get(jsonObj);
				} else {
					this.tournament = new Tournament(jsonObj);
				}
				break;
		}
	}

}

Round.list = [];
Round.options = [];

class Game extends DatabaseObject {
	constructor(jsonObj) {
		if (Game.exists(jsonObj)) {
			return Game.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.round = null; // Int
		this.onlineUrl = null; // String
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Game.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.round != null) {
				this.round = Round.exists(jsonObj.round) ?
					Round.get(jsonObj.round) : new Round(jsonObj.round);
				if ( ! this.round.games.includes(this)) {
					this.round.games.push(this);
					Round.orderBy(this.round.games);
				}
			}
			this.onlineUrl = jsonObj.onlineUrl;
			
			// Links
			
			Game.orderBy();
		}
	}

	static newChild(jsonObj) {
		if (jsonObj.className !== undefined && jsonObj.className !== null) {
			return new databaseObjectClassMap[jsonObj.className](jsonObj);
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Game";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getGameRequiredFields() {
		return ["id", "round"];
	}

	static getGameAllFields() {
		return ["id", "round", "onlineUrl"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return true;
	}

	static getChildClasses() {
		return [HeroscapeGame];
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "roundID", "onlineUrl"].includes(columnName)) {
			return Game;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "roundID":
				return "Round";
		}
		return null;
	}

	static GameGetActionNames() {
		return [];
	}

	GameGetAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	GameSelectFilters(property, filterObjects) {
		switch (property) {
			case "round":
				return null;
			case "onlineUrl":
				return null;
			default:
				return null;
		}
	}

	GameGetTooltip(propName) {
		switch (propName) {
			case "round":
				return ""; // TODO
			case "onlineUrl":
				return ""; // TODO
			default:
				return "";
		}
	}

	GameDataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Game.includeField("round", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "round";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Round.selectOptions(this.round, this.selectFilters("round", filterObjects));
			fieldData["optionClass"] = "Round";
			fieldData["propertyForeignClass"] = Round;
			fieldData["label"] = "Round";
			if (this.round !== undefined && this.round !== null) {
				fieldData["value"] = this.round.toDisplayString();
				fieldData["databaseObj"] = this.round;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Game.includeField("onlineUrl", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "onlineUrl";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Online Url";
			if (this.onlineUrl !== null) {
				fieldData["value"] = this.onlineUrl;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Game.options.fieldOrder !== undefined && Game.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Game.options.fieldOrder);
		}
		return data;
	}

	GameSet(field, jsonObj) {
		switch (field) {
			case "round":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.round = jsonObj;
				} else if (Round.exists(jsonObj)) {
					this.round = Round.get(jsonObj);
				} else {
					this.round = new Round(jsonObj);
				}
				break;
		}
	}

}

Game.list = [];
Game.options = [];

class HeroscapeGamePlayer extends DatabaseObject {
	constructor(jsonObj) {
		if (HeroscapeGamePlayer.exists(jsonObj)) {
			return HeroscapeGamePlayer.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.player = null; // Int
		this.game = null; // Int
		this.result = null; // Decimal
		this.pointsLeft = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			HeroscapeGamePlayer.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.player != null) {
				this.player = Player.exists(jsonObj.player) ?
					Player.get(jsonObj.player) : new Player(jsonObj.player);
				if ( ! this.player.heroscapeGamePlayers.includes(this)) {
					this.player.heroscapeGamePlayers.push(this);
					Player.orderBy(this.player.heroscapeGamePlayers);
				}
			}
			if (jsonObj.game != null) {
				this.game = HeroscapeGame.exists(jsonObj.game) ?
					HeroscapeGame.get(jsonObj.game) : new HeroscapeGame(jsonObj.game);
				if ( ! this.game.heroscapeGamePlayers.includes(this)) {
					this.game.heroscapeGamePlayers.push(this);
					HeroscapeGame.orderBy(this.game.heroscapeGamePlayers);
				}
			}
			this.result = jsonObj.result;
			this.pointsLeft = jsonObj.pointsLeft;
			
			// Links
			
			HeroscapeGamePlayer.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Heroscape Game Player";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "player", "game"];
	}

	static getAllFields() {
		return ["id", "player", "game", "result", "pointsLeft"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "playerID", "gameID", "result", "pointsLeft"].includes(columnName)) {
			return HeroscapeGamePlayer;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "playerID":
				return "Player";
			case "gameID":
				return "HeroscapeGame";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "player":
				return null;
			case "game":
				return null;
			case "result":
				return null;
			case "pointsLeft":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "player":
				return ""; // TODO
			case "game":
				return ""; // TODO
			case "result":
				return ""; // TODO
			case "pointsLeft":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (HeroscapeGamePlayer.includeField("player", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "player";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Player.selectOptions(this.player, this.selectFilters("player", filterObjects));
			fieldData["optionClass"] = "Player";
			fieldData["propertyForeignClass"] = Player;
			fieldData["label"] = "Player";
			if (this.player !== undefined && this.player !== null) {
				fieldData["value"] = this.player.toDisplayString();
				fieldData["databaseObj"] = this.player;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeGamePlayer.includeField("game", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "game";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = HeroscapeGame.selectOptions(this.game, this.selectFilters("game", filterObjects));
			fieldData["optionClass"] = "HeroscapeGame";
			fieldData["propertyForeignClass"] = HeroscapeGame;
			fieldData["label"] = "Game";
			if (this.game !== undefined && this.game !== null) {
				fieldData["value"] = this.game.toDisplayString();
				fieldData["databaseObj"] = this.game;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeGamePlayer.includeField("result", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "result";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "any";
			fieldData["label"] = "Result";
			if (this.result !== null) {
				fieldData["value"] = this.result;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeGamePlayer.includeField("pointsLeft", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "pointsLeft";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Points Left";
			if (this.pointsLeft !== null) {
				fieldData["value"] = this.pointsLeft;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeGamePlayer.options.fieldOrder !== undefined && HeroscapeGamePlayer.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, HeroscapeGamePlayer.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "player":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.player = jsonObj;
				} else if (Player.exists(jsonObj)) {
					this.player = Player.get(jsonObj);
				} else {
					this.player = new Player(jsonObj);
				}
				break;
			case "game":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.game = jsonObj;
				} else if (HeroscapeGame.exists(jsonObj)) {
					this.game = HeroscapeGame.get(jsonObj);
				} else {
					this.game = new HeroscapeGame(jsonObj);
				}
				break;
		}
	}

}

HeroscapeGamePlayer.list = [];
HeroscapeGamePlayer.options = [];

class GameMap extends DatabaseObject {
	constructor(jsonObj) {
		if (GameMap.exists(jsonObj)) {
			return GameMap.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.number = null; // Int
		this.tournament = null; // Int
		this.broughtByUser = null; // Int
		this.active = null; // Boolean
		this.forStreaming = null; // Boolean
		this.altOhsGdocId = null; // String
		
		// Links
		this.links = [{heroscapeGames: HeroscapeGame, label: "Heroscape Games", nTo1Link: true, linkField: 'map'}, {gameMapGlyphs: GameMapGlyph, label: "Game Map Glyphs", nTo1Link: true, linkField: 'gameMap'}];
		this.heroscapeGames = [];
		this.gameMapGlyphs = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			GameMap.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.number = jsonObj.number;
			if (jsonObj.tournament != null) {
				this.tournament = Tournament.exists(jsonObj.tournament) ?
					Tournament.get(jsonObj.tournament) : Tournament.newChild(jsonObj.tournament);
				if ( ! this.tournament.gameMaps.includes(this)) {
					this.tournament.gameMaps.push(this);
					Tournament.orderBy(this.tournament.gameMaps);
				}
			}
			if (jsonObj.broughtByUser != null) {
				this.broughtByUser = User.exists(jsonObj.broughtByUser) ?
					User.get(jsonObj.broughtByUser) : new User(jsonObj.broughtByUser);
				if ( ! this.broughtByUser.gameMaps.includes(this)) {
					this.broughtByUser.gameMaps.push(this);
					User.orderBy(this.broughtByUser.gameMaps);
				}
			}
			this.active = jsonObj.active;
			this.forStreaming = jsonObj.forStreaming;
			this.altOhsGdocId = jsonObj.altOhsGdocId;
			
			// Links
			if (jsonObj.heroscapeGames != undefined && jsonObj.heroscapeGames != null) {
				for (var i = 0; i < jsonObj.heroscapeGames.length; i++) {
					if (HeroscapeGame.exists(jsonObj.heroscapeGames[i])){
						const newLinkObj = HeroscapeGame.get(jsonObj.heroscapeGames[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.heroscapeGames.length; j++) {
							if (this.heroscapeGames[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.heroscapeGames.push(newLinkObj);
						}
					} else {
						const newForeignObj = new HeroscapeGame(jsonObj.heroscapeGames[i]);
						if ( ! this.heroscapeGames.includes(newForeignObj)) {
							this.heroscapeGames.push(newForeignObj);
						}
						newForeignObj.map = this;
					}
				}
			}
			HeroscapeGame.orderBy(this.heroscapeGames);
			if (jsonObj.gameMapGlyphs != undefined && jsonObj.gameMapGlyphs != null) {
				for (var i = 0; i < jsonObj.gameMapGlyphs.length; i++) {
					if (GameMapGlyph.exists(jsonObj.gameMapGlyphs[i])){
						const newLinkObj = GameMapGlyph.get(jsonObj.gameMapGlyphs[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.gameMapGlyphs.length; j++) {
							if (this.gameMapGlyphs[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.gameMapGlyphs.push(newLinkObj);
						}
					} else {
						const newForeignObj = new GameMapGlyph(jsonObj.gameMapGlyphs[i]);
						if ( ! this.gameMapGlyphs.includes(newForeignObj)) {
							this.gameMapGlyphs.push(newForeignObj);
						}
						newForeignObj.gameMap = this;
					}
				}
			}
			GameMapGlyph.orderBy(this.gameMapGlyphs);
			
			GameMap.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Game Map";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "number", "tournament", "active", "forStreaming"];
	}

	static getAllFields() {
		return ["id", "name", "number", "tournament", "broughtByUser", "active", "forStreaming", "altOhsGdocId"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "number", "tournamentID", "broughtByUserID", "active", "forStreaming", "altOhsGdocId"].includes(columnName)) {
			return GameMap;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "tournamentID":
				return "Tournament";
			case "broughtByUserID":
				return "User";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "number":
				return null;
			case "tournament":
				return null;
			case "broughtByUser":
				return null;
			case "active":
				return null;
			case "forStreaming":
				return null;
			case "altOhsGdocId":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "number":
				return ""; // TODO
			case "tournament":
				return ""; // TODO
			case "broughtByUser":
				return ""; // TODO
			case "active":
				return ""; // TODO
			case "forStreaming":
				return ""; // TODO
			case "altOhsGdocId":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (GameMap.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (GameMap.includeField("number", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "number";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Number";
			if (this.number !== null) {
				fieldData["value"] = this.number;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (GameMap.includeField("tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "tournament";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Tournament.selectOptions(this.tournament, this.selectFilters("tournament", filterObjects));
			fieldData["optionClass"] = "Tournament";
			fieldData["propertyForeignClass"] = Tournament;
			fieldData["label"] = "Tournament";
			if (this.tournament !== undefined && this.tournament !== null) {
				fieldData["value"] = this.tournament.toDisplayString();
				fieldData["databaseObj"] = this.tournament;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (GameMap.includeField("broughtByUser", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "broughtByUser";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = User.selectOptions(this.broughtByUser, this.selectFilters("broughtByUser", filterObjects));
			fieldData["optionClass"] = "User";
			fieldData["propertyForeignClass"] = User;
			fieldData["label"] = "Brought By User";
			if (this.broughtByUser !== undefined && this.broughtByUser !== null) {
				fieldData["value"] = this.broughtByUser.toDisplayString();
				fieldData["databaseObj"] = this.broughtByUser;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (GameMap.includeField("active", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "active";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Active";
			if (this.active !== null) {
				fieldData["value"] = this.active;
			} else {
				fieldData["value"] = true; // Default value
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (GameMap.includeField("forStreaming", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "forStreaming";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "For Streaming";
			if (this.forStreaming !== null) {
				fieldData["value"] = this.forStreaming;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (GameMap.includeField("altOhsGdocId", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "altOhsGdocId";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Alt Ohs Gdoc Id";
			if (this.altOhsGdocId !== null) {
				fieldData["value"] = this.altOhsGdocId;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (GameMap.options.fieldOrder !== undefined && GameMap.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, GameMap.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "tournament":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.tournament = jsonObj;
				} else if (Tournament.exists(jsonObj)) {
					this.tournament = Tournament.get(jsonObj);
				} else {
					this.tournament = new Tournament(jsonObj);
				}
				break;
			case "broughtByUser":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.broughtByUser = jsonObj;
				} else if (User.exists(jsonObj)) {
					this.broughtByUser = User.get(jsonObj);
				} else {
					this.broughtByUser = new User(jsonObj);
				}
				break;
		}
	}

}

GameMap.list = [];
GameMap.options = [];

class Attendee extends DatabaseObject {
	constructor(jsonObj) {
		if (Attendee.exists(jsonObj)) {
			return Attendee.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.user = null; // Int
		this.convention = null; // Int
		this.signupTime = null; // Datetime
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Attendee.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.user != null) {
				this.user = User.exists(jsonObj.user) ?
					User.get(jsonObj.user) : new User(jsonObj.user);
				if ( ! this.user.attendees.includes(this)) {
					this.user.attendees.push(this);
					User.orderBy(this.user.attendees);
				}
			}
			if (jsonObj.convention != null) {
				this.convention = Convention.exists(jsonObj.convention) ?
					Convention.get(jsonObj.convention) : new Convention(jsonObj.convention);
				if ( ! this.convention.attendees.includes(this)) {
					this.convention.attendees.push(this);
					Convention.orderBy(this.convention.attendees);
				}
			}
			this.signupTime = jsonObj.signupTime;
			
			// Links
			
			Attendee.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Attendee";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "user", "convention", "signupTime"];
	}

	static getAllFields() {
		return ["id", "user", "convention", "signupTime"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "userID", "conventionID", "signupTime"].includes(columnName)) {
			return Attendee;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "userID":
				return "User";
			case "conventionID":
				return "Convention";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "user":
				return null;
			case "convention":
				return null;
			case "signupTime":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "user":
				return ""; // TODO
			case "convention":
				return ""; // TODO
			case "signupTime":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Attendee.includeField("user", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "user";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = User.selectOptions(this.user, this.selectFilters("user", filterObjects));
			fieldData["optionClass"] = "User";
			fieldData["propertyForeignClass"] = User;
			fieldData["label"] = "User";
			if (this.user !== undefined && this.user !== null) {
				fieldData["value"] = this.user.toDisplayString();
				fieldData["databaseObj"] = this.user;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Attendee.includeField("convention", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "convention";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Convention.selectOptions(this.convention, this.selectFilters("convention", filterObjects));
			fieldData["optionClass"] = "Convention";
			fieldData["propertyForeignClass"] = Convention;
			fieldData["label"] = "Convention";
			if (this.convention !== undefined && this.convention !== null) {
				fieldData["value"] = this.convention.toDisplayString();
				fieldData["databaseObj"] = this.convention;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Attendee.includeField("signupTime", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "signupTime";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "datetime-local";
			fieldData["label"] = "Signup Time";
			if (this.signupTime !== null) {
				fieldData["value"] = forEditing ? this.signupTime.replace(' ','T') : new Date(this.signupTime).toString();
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Attendee.options.fieldOrder !== undefined && Attendee.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Attendee.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "user":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.user = jsonObj;
				} else if (User.exists(jsonObj)) {
					this.user = User.get(jsonObj);
				} else {
					this.user = new User(jsonObj);
				}
				break;
			case "convention":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.convention = jsonObj;
				} else if (Convention.exists(jsonObj)) {
					this.convention = Convention.get(jsonObj);
				} else {
					this.convention = new Convention(jsonObj);
				}
				break;
		}
	}

}

Attendee.list = [];
Attendee.options = [];

class Bracket extends DatabaseObject {
	constructor(jsonObj) {
		if (Bracket.exists(jsonObj)) {
			return Bracket.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.reSeedEachRound = null; // Boolean
		this.size = null; // Int
		
		// Links
		this.links = [{tournaments: Tournament, label: "Tournaments", nTo1Link: true, linkField: 'bracket'}, {bracketEntrys: BracketEntry, label: "Bracket Entrys", nTo1Link: true, linkField: 'bracket'}];
		this.tournaments = [];
		this.bracketEntrys = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Bracket.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.reSeedEachRound = jsonObj.reSeedEachRound;
			this.size = jsonObj.size;
			
			// Links
			if (jsonObj.tournaments != undefined && jsonObj.tournaments != null) {
				for (var i = 0; i < jsonObj.tournaments.length; i++) {
					if (Tournament.exists(jsonObj.tournaments[i])){
						const newLinkObj = Tournament.get(jsonObj.tournaments[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.tournaments.length; j++) {
							if (this.tournaments[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.tournaments.push(newLinkObj);
						}
					} else {
						const newForeignObj = Tournament.newChild(jsonObj.tournaments[i]);
						if ( ! this.tournaments.includes(newForeignObj)) {
							this.tournaments.push(newForeignObj);
						}
						newForeignObj.bracket = this;
					}
				}
			}
			Tournament.orderBy(this.tournaments);
			if (jsonObj.bracketEntrys != undefined && jsonObj.bracketEntrys != null) {
				for (var i = 0; i < jsonObj.bracketEntrys.length; i++) {
					if (BracketEntry.exists(jsonObj.bracketEntrys[i])){
						const newLinkObj = BracketEntry.get(jsonObj.bracketEntrys[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.bracketEntrys.length; j++) {
							if (this.bracketEntrys[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.bracketEntrys.push(newLinkObj);
						}
					} else {
						const newForeignObj = new BracketEntry(jsonObj.bracketEntrys[i]);
						if ( ! this.bracketEntrys.includes(newForeignObj)) {
							this.bracketEntrys.push(newForeignObj);
						}
						newForeignObj.bracket = this;
					}
				}
			}
			BracketEntry.orderBy(this.bracketEntrys);
			
			Bracket.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Bracket";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "reSeedEachRound", "size"];
	}

	static getAllFields() {
		return ["id", "reSeedEachRound", "size"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "reSeedEachRound", "size"].includes(columnName)) {
			return Bracket;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "reSeedEachRound":
				return null;
			case "size":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "reSeedEachRound":
				return ""; // TODO
			case "size":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Bracket.includeField("reSeedEachRound", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "reSeedEachRound";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Re Seed Each Round";
			if (this.reSeedEachRound !== null) {
				fieldData["value"] = this.reSeedEachRound;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Bracket.includeField("size", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "size";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
				fieldData["label"] = "Size";
			fieldData["label"] = "Size";
			if (this.size !== null) {
				fieldData["value"] = this.size;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Bracket.options.fieldOrder !== undefined && Bracket.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Bracket.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

Bracket.list = [];
Bracket.options = [];

class BracketEntry extends DatabaseObject {
	constructor(jsonObj) {
		if (BracketEntry.exists(jsonObj)) {
			return BracketEntry.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.bracket = null; // Int
		this.player = null; // Int
		this.seed = null; // Int
		this.eliminated = null; // Boolean
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			BracketEntry.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.bracket != null) {
				this.bracket = Bracket.exists(jsonObj.bracket) ?
					Bracket.get(jsonObj.bracket) : new Bracket(jsonObj.bracket);
				if ( ! this.bracket.bracketEntrys.includes(this)) {
					this.bracket.bracketEntrys.push(this);
					Bracket.orderBy(this.bracket.bracketEntrys);
				}
			}
			if (jsonObj.player != null) {
				this.player = Player.exists(jsonObj.player) ?
					Player.get(jsonObj.player) : new Player(jsonObj.player);
				if ( ! this.player.bracketEntrys.includes(this)) {
					this.player.bracketEntrys.push(this);
					Player.orderBy(this.player.bracketEntrys);
				}
			}
			this.seed = jsonObj.seed;
			this.eliminated = jsonObj.eliminated;
			
			// Links
			
			BracketEntry.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Bracket Entry";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "bracket", "player", "seed", "eliminated"];
	}

	static getAllFields() {
		return ["id", "bracket", "player", "seed", "eliminated"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "bracketID", "playerID", "seed", "eliminated"].includes(columnName)) {
			return BracketEntry;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "bracketID":
				return "Bracket";
			case "playerID":
				return "Player";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "bracket":
				return null;
			case "player":
				return null;
			case "seed":
				return null;
			case "eliminated":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "bracket":
				return ""; // TODO
			case "player":
				return ""; // TODO
			case "seed":
				return ""; // TODO
			case "eliminated":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (BracketEntry.includeField("bracket", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "bracket";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Bracket.selectOptions(this.bracket, this.selectFilters("bracket", filterObjects));
			fieldData["optionClass"] = "Bracket";
			fieldData["propertyForeignClass"] = Bracket;
			fieldData["label"] = "Bracket";
			if (this.bracket !== undefined && this.bracket !== null) {
				fieldData["value"] = this.bracket.toDisplayString();
				fieldData["databaseObj"] = this.bracket;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (BracketEntry.includeField("player", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "player";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Player.selectOptions(this.player, this.selectFilters("player", filterObjects));
			fieldData["optionClass"] = "Player";
			fieldData["propertyForeignClass"] = Player;
			fieldData["label"] = "Player";
			if (this.player !== undefined && this.player !== null) {
				fieldData["value"] = this.player.toDisplayString();
				fieldData["databaseObj"] = this.player;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (BracketEntry.includeField("seed", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "seed";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Seed";
			if (this.seed !== null) {
				fieldData["value"] = this.seed;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (BracketEntry.includeField("eliminated", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "eliminated";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Eliminated";
			if (this.eliminated !== null) {
				fieldData["value"] = this.eliminated;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (BracketEntry.options.fieldOrder !== undefined && BracketEntry.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, BracketEntry.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "bracket":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.bracket = jsonObj;
				} else if (Bracket.exists(jsonObj)) {
					this.bracket = Bracket.get(jsonObj);
				} else {
					this.bracket = new Bracket(jsonObj);
				}
				break;
			case "player":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.player = jsonObj;
				} else if (Player.exists(jsonObj)) {
					this.player = Player.get(jsonObj);
				} else {
					this.player = new Player(jsonObj);
				}
				break;
		}
	}

}

BracketEntry.list = [];
BracketEntry.options = [];

class League extends DatabaseObject {
	constructor(jsonObj) {
		if (League.exists(jsonObj)) {
			return League.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.description = null; // String
		
		// Links
		this.links = [{admins: Admin, label: "Admins", nTo1Link: true, linkField: 'league'}, {seasons: Season, label: "Seasons", nTo1Link: true, linkField: 'league'}];
		this.admins = [];
		this.seasons = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			League.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.description = jsonObj.description;
			
			// Links
			if (jsonObj.admins != undefined && jsonObj.admins != null) {
				for (var i = 0; i < jsonObj.admins.length; i++) {
					if (Admin.exists(jsonObj.admins[i])){
						const newLinkObj = Admin.get(jsonObj.admins[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.admins.length; j++) {
							if (this.admins[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.admins.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Admin(jsonObj.admins[i]);
						if ( ! this.admins.includes(newForeignObj)) {
							this.admins.push(newForeignObj);
						}
						newForeignObj.league = this;
					}
				}
			}
			Admin.orderBy(this.admins);
			if (jsonObj.seasons != undefined && jsonObj.seasons != null) {
				for (var i = 0; i < jsonObj.seasons.length; i++) {
					if (Season.exists(jsonObj.seasons[i])){
						const newLinkObj = Season.get(jsonObj.seasons[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.seasons.length; j++) {
							if (this.seasons[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.seasons.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Season(jsonObj.seasons[i]);
						if ( ! this.seasons.includes(newForeignObj)) {
							this.seasons.push(newForeignObj);
						}
						newForeignObj.league = this;
					}
				}
			}
			Season.orderBy(this.seasons);
			
			League.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "League";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name"];
	}

	static getAllFields() {
		return ["id", "name", "description"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "description"].includes(columnName)) {
			return League;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "description":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "description":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (League.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (League.includeField("description", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "description";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Description";
			if (this.description !== null) {
				fieldData["value"] = this.description;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (League.options.fieldOrder !== undefined && League.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, League.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

League.list = [];
League.options = [];

class Season extends DatabaseObject {
	constructor(jsonObj) {
		if (Season.exists(jsonObj)) {
			return Season.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.league = null; // Int
		this.start = null; // Date
		this.end = null; // Date
		this.description = null; // String
		
		// Links
		this.links = [{tournaments: Tournament, label: "Tournaments"}];
		this.tournaments = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Season.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			if (jsonObj.league != null) {
				this.league = League.exists(jsonObj.league) ?
					League.get(jsonObj.league) : new League(jsonObj.league);
				if ( ! this.league.seasons.includes(this)) {
					this.league.seasons.push(this);
					League.orderBy(this.league.seasons);
				}
			}
			this.start = jsonObj.start;
			this.end = jsonObj.end;
			this.description = jsonObj.description;
			
			// Links
			if (jsonObj.tournaments != undefined && jsonObj.tournaments != null) {
				for (var i = 0; i < jsonObj.tournaments.length; i++) {
					if (Tournament.exists(jsonObj.tournaments[i])){
						const newLinkObj = Tournament.get(jsonObj.tournaments[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.tournaments.length; j++) {
							if (this.tournaments[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.tournaments.push(newLinkObj);
						}
					} else {
						const newForeignObj = Tournament.newChild(jsonObj.tournaments[i]);
						if ( ! this.tournaments.includes(newForeignObj)) {
							this.tournaments.push(newForeignObj);
						}
					}
				}
			}
			Tournament.orderBy(this.tournaments);
			
			Season.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Season";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "league", "start", "end"];
	}

	static getAllFields() {
		return ["id", "name", "league", "start", "end", "description"];
	}

	static getNtoMLinkClasses() {
		return {tournaments: Tournament};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "leagueID", "start", "end", "description"].includes(columnName)) {
			return Season;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "leagueID":
				return "League";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	// @DoNotUpdate
	toDisplayString() {
		return this.fullDisplayName();
	}

	// @DoNotUpdate
	fullDisplayName() {
		var name = "";
		if (this.league != null) {
			name = this.league.name + " ";
		}
		name += this.name;
		return name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "league":
				return null;
			case "start":
				return null;
			case "end":
				return null;
			case "description":
				return null;
			case "tournaments":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "league":
				return ""; // TODO
			case "start":
				return ""; // TODO
			case "end":
				return ""; // TODO
			case "description":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Season.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Season.includeField("league", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "league";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = League.selectOptions(this.league, this.selectFilters("league", filterObjects));
			fieldData["optionClass"] = "League";
			fieldData["propertyForeignClass"] = League;
			fieldData["label"] = "League";
			if (this.league !== undefined && this.league !== null) {
				fieldData["value"] = this.league.toDisplayString();
				fieldData["databaseObj"] = this.league;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Season.includeField("start", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "start";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "Start";
			if (this.start !== null) {
				fieldData["value"] = this.start;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Season.includeField("end", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "end";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "End";
			if (this.end !== null) {
				fieldData["value"] = this.end;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Season.includeField("description", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "description";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Description";
			if (this.description !== null) {
				fieldData["value"] = this.description;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Season.options.fieldOrder !== undefined && Season.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Season.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "league":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.league = jsonObj;
				} else if (League.exists(jsonObj)) {
					this.league = League.get(jsonObj);
				} else {
					this.league = new League(jsonObj);
				}
				break;
		}
	}

}

Season.list = [];
Season.options = [];

class HeroscapeMap extends DatabaseObject {
	constructor(jsonObj) {
		if (HeroscapeMap.exists(jsonObj)) {
			return HeroscapeMap.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.authorName = null; // String
		this.buildInstructionsUrl = null; // String
		this.imageUrl = null; // String
		this.numberOfPlayers = null; // Int
		this.ohsGdocId = null; // String
		this.hexoscapeUrl = null; // String
		
		// Links
		this.links = [{heroscapeMapSets: HeroscapeMapSet, label: "Heroscape Map Sets", nTo1Link: true, linkField: 'map'}, {heroscapeMapPreviousVersions: HeroscapeMapPreviousVersion, label: "Heroscape Map Previous Versions", nTo1Link: true, linkField: 'map'}, {conventionMaps: ConventionMap, label: "Convention Maps", nTo1Link: true, linkField: 'map'}, {heroscapeMapTerrainPieceQuantitys: HeroscapeMapTerrainPieceQuantity, label: "Heroscape Map Terrain Piece Quantitys", nTo1Link: true, linkField: 'heroscapeMap'}, {tags: HeroscapeMapTag, label: "Heroscape Map Tags"}];
		this.heroscapeMapSets = [];
		this.heroscapeMapPreviousVersions = [];
		this.conventionMaps = [];
		this.heroscapeMapTerrainPieceQuantitys = [];
		this.tags = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			HeroscapeMap.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.authorName = jsonObj.authorName;
			this.buildInstructionsUrl = jsonObj.buildInstructionsUrl;
			this.imageUrl = jsonObj.imageUrl;
			this.numberOfPlayers = jsonObj.numberOfPlayers;
			this.ohsGdocId = jsonObj.ohsGdocId;
			this.hexoscapeUrl = jsonObj.hexoscapeUrl;
			
			// Links
			if (jsonObj.heroscapeMapSets != undefined && jsonObj.heroscapeMapSets != null) {
				for (var i = 0; i < jsonObj.heroscapeMapSets.length; i++) {
					if (HeroscapeMapSet.exists(jsonObj.heroscapeMapSets[i])){
						const newLinkObj = HeroscapeMapSet.get(jsonObj.heroscapeMapSets[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.heroscapeMapSets.length; j++) {
							if (this.heroscapeMapSets[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.heroscapeMapSets.push(newLinkObj);
						}
					} else {
						const newForeignObj = new HeroscapeMapSet(jsonObj.heroscapeMapSets[i]);
						if ( ! this.heroscapeMapSets.includes(newForeignObj)) {
							this.heroscapeMapSets.push(newForeignObj);
						}
						newForeignObj.map = this;
					}
				}
			}
			HeroscapeMapSet.orderBy(this.heroscapeMapSets);
			if (jsonObj.heroscapeMapPreviousVersions != undefined && jsonObj.heroscapeMapPreviousVersions != null) {
				for (var i = 0; i < jsonObj.heroscapeMapPreviousVersions.length; i++) {
					if (HeroscapeMapPreviousVersion.exists(jsonObj.heroscapeMapPreviousVersions[i])){
						const newLinkObj = HeroscapeMapPreviousVersion.get(jsonObj.heroscapeMapPreviousVersions[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.heroscapeMapPreviousVersions.length; j++) {
							if (this.heroscapeMapPreviousVersions[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.heroscapeMapPreviousVersions.push(newLinkObj);
						}
					} else {
						const newForeignObj = new HeroscapeMapPreviousVersion(jsonObj.heroscapeMapPreviousVersions[i]);
						if ( ! this.heroscapeMapPreviousVersions.includes(newForeignObj)) {
							this.heroscapeMapPreviousVersions.push(newForeignObj);
						}
						newForeignObj.map = this;
					}
				}
			}
			HeroscapeMapPreviousVersion.orderBy(this.heroscapeMapPreviousVersions);
			if (jsonObj.conventionMaps != undefined && jsonObj.conventionMaps != null) {
				for (var i = 0; i < jsonObj.conventionMaps.length; i++) {
					if (ConventionMap.exists(jsonObj.conventionMaps[i])){
						const newLinkObj = ConventionMap.get(jsonObj.conventionMaps[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.conventionMaps.length; j++) {
							if (this.conventionMaps[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.conventionMaps.push(newLinkObj);
						}
					} else {
						const newForeignObj = new ConventionMap(jsonObj.conventionMaps[i]);
						if ( ! this.conventionMaps.includes(newForeignObj)) {
							this.conventionMaps.push(newForeignObj);
						}
						newForeignObj.map = this;
					}
				}
			}
			ConventionMap.orderBy(this.conventionMaps);
			if (jsonObj.heroscapeMapTerrainPieceQuantitys != undefined && jsonObj.heroscapeMapTerrainPieceQuantitys != null) {
				for (var i = 0; i < jsonObj.heroscapeMapTerrainPieceQuantitys.length; i++) {
					if (HeroscapeMapTerrainPieceQuantity.exists(jsonObj.heroscapeMapTerrainPieceQuantitys[i])){
						const newLinkObj = HeroscapeMapTerrainPieceQuantity.get(jsonObj.heroscapeMapTerrainPieceQuantitys[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.heroscapeMapTerrainPieceQuantitys.length; j++) {
							if (this.heroscapeMapTerrainPieceQuantitys[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.heroscapeMapTerrainPieceQuantitys.push(newLinkObj);
						}
					} else {
						const newForeignObj = new HeroscapeMapTerrainPieceQuantity(jsonObj.heroscapeMapTerrainPieceQuantitys[i]);
						if ( ! this.heroscapeMapTerrainPieceQuantitys.includes(newForeignObj)) {
							this.heroscapeMapTerrainPieceQuantitys.push(newForeignObj);
						}
						newForeignObj.heroscapeMap = this;
					}
				}
			}
			HeroscapeMapTerrainPieceQuantity.orderBy(this.heroscapeMapTerrainPieceQuantitys);
			if (jsonObj.tags != undefined && jsonObj.tags != null) {
				for (var i = 0; i < jsonObj.tags.length; i++) {
					if (HeroscapeMapTag.exists(jsonObj.tags[i])){
						const newLinkObj = HeroscapeMapTag.get(jsonObj.tags[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.tags.length; j++) {
							if (this.tags[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.tags.push(newLinkObj);
						}
					} else {
						const newForeignObj = new HeroscapeMapTag(jsonObj.tags[i]);
						if ( ! this.tags.includes(newForeignObj)) {
							this.tags.push(newForeignObj);
						}
					}
				}
			}
			HeroscapeMapTag.orderBy(this.tags);
			
			HeroscapeMap.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Heroscape Map";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "numberOfPlayers"];
	}

	static getAllFields() {
		return ["id", "name", "authorName", "buildInstructionsUrl", "imageUrl", "numberOfPlayers", "ohsGdocId", "hexoscapeUrl"];
	}

	static getNtoMLinkClasses() {
		return {tags: HeroscapeMapTag};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "authorName", "buildInstructionsUrl", "imageUrl", "numberOfPlayers", "ohsGdocId", "hexoscapeUrl"].includes(columnName)) {
			return HeroscapeMap;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "authorName":
				return null;
			case "buildInstructionsUrl":
				return null;
			case "imageUrl":
				return null;
			case "numberOfPlayers":
				return null;
			case "ohsGdocId":
				return null;
			case "hexoscapeUrl":
				return null;
			case "tags":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "authorName":
				return ""; // TODO
			case "buildInstructionsUrl":
				return ""; // TODO
			case "imageUrl":
				return ""; // TODO
			case "numberOfPlayers":
				return ""; // TODO
			case "ohsGdocId":
				return ""; // TODO
			case "hexoscapeUrl":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (HeroscapeMap.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMap.includeField("authorName", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "authorName";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Author Name";
			if (this.authorName !== null) {
				fieldData["value"] = this.authorName;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMap.includeField("buildInstructionsUrl", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "buildInstructionsUrl";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Build Instructions Url";
			if (this.buildInstructionsUrl !== null) {
				fieldData["value"] = this.buildInstructionsUrl;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMap.includeField("imageUrl", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "imageUrl";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Image Url";
			if (this.imageUrl !== null) {
				fieldData["value"] = this.imageUrl;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMap.includeField("numberOfPlayers", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "numberOfPlayers";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Number Of Players";
			if (this.numberOfPlayers !== null) {
				fieldData["value"] = this.numberOfPlayers;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMap.includeField("ohsGdocId", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "ohsGdocId";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Ohs Gdoc Id";
			if (this.ohsGdocId !== null) {
				fieldData["value"] = this.ohsGdocId;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMap.includeField("hexoscapeUrl", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "hexoscapeUrl";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Hexoscape Url";
			if (this.hexoscapeUrl !== null) {
				fieldData["value"] = this.hexoscapeUrl;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMap.options.fieldOrder !== undefined && HeroscapeMap.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, HeroscapeMap.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

HeroscapeMap.list = [];
HeroscapeMap.options = [];

class HeroscapeSet extends DatabaseObject {
	constructor(jsonObj) {
		if (HeroscapeSet.exists(jsonObj)) {
			return HeroscapeSet.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.abbreviation = null; // String
		this.releaseDate = null; // String
		this.masterSet = null; // Boolean
		this.terrainExpansion = null; // Boolean
		
		// Links
		this.links = [{heroscapeMapSets: HeroscapeMapSet, label: "Heroscape Map Sets", nTo1Link: true, linkField: 'terrainSet'}, {heroscapeSetTerrainPieceQuantitys: HeroscapeSetTerrainPieceQuantity, label: "Heroscape Set Terrain Piece Quantitys", nTo1Link: true, linkField: 'heroscapeSet'}, {userCollectionHeroscapeSets: UserCollectionHeroscapeSet, label: "User Collection Heroscape Sets", nTo1Link: true, linkField: 'heroscapeSet'}];
		this.heroscapeMapSets = [];
		this.heroscapeSetTerrainPieceQuantitys = [];
		this.userCollectionHeroscapeSets = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			HeroscapeSet.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.abbreviation = jsonObj.abbreviation;
			this.releaseDate = jsonObj.releaseDate;
			this.masterSet = jsonObj.masterSet;
			this.terrainExpansion = jsonObj.terrainExpansion;
			
			// Links
			if (jsonObj.heroscapeMapSets != undefined && jsonObj.heroscapeMapSets != null) {
				for (var i = 0; i < jsonObj.heroscapeMapSets.length; i++) {
					if (HeroscapeMapSet.exists(jsonObj.heroscapeMapSets[i])){
						const newLinkObj = HeroscapeMapSet.get(jsonObj.heroscapeMapSets[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.heroscapeMapSets.length; j++) {
							if (this.heroscapeMapSets[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.heroscapeMapSets.push(newLinkObj);
						}
					} else {
						const newForeignObj = new HeroscapeMapSet(jsonObj.heroscapeMapSets[i]);
						if ( ! this.heroscapeMapSets.includes(newForeignObj)) {
							this.heroscapeMapSets.push(newForeignObj);
						}
						newForeignObj.terrainSet = this;
					}
				}
			}
			HeroscapeMapSet.orderBy(this.heroscapeMapSets);
			if (jsonObj.heroscapeSetTerrainPieceQuantitys != undefined && jsonObj.heroscapeSetTerrainPieceQuantitys != null) {
				for (var i = 0; i < jsonObj.heroscapeSetTerrainPieceQuantitys.length; i++) {
					if (HeroscapeSetTerrainPieceQuantity.exists(jsonObj.heroscapeSetTerrainPieceQuantitys[i])){
						const newLinkObj = HeroscapeSetTerrainPieceQuantity.get(jsonObj.heroscapeSetTerrainPieceQuantitys[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.heroscapeSetTerrainPieceQuantitys.length; j++) {
							if (this.heroscapeSetTerrainPieceQuantitys[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.heroscapeSetTerrainPieceQuantitys.push(newLinkObj);
						}
					} else {
						const newForeignObj = new HeroscapeSetTerrainPieceQuantity(jsonObj.heroscapeSetTerrainPieceQuantitys[i]);
						if ( ! this.heroscapeSetTerrainPieceQuantitys.includes(newForeignObj)) {
							this.heroscapeSetTerrainPieceQuantitys.push(newForeignObj);
						}
						newForeignObj.heroscapeSet = this;
					}
				}
			}
			HeroscapeSetTerrainPieceQuantity.orderBy(this.heroscapeSetTerrainPieceQuantitys);
			if (jsonObj.userCollectionHeroscapeSets != undefined && jsonObj.userCollectionHeroscapeSets != null) {
				for (var i = 0; i < jsonObj.userCollectionHeroscapeSets.length; i++) {
					if (UserCollectionHeroscapeSet.exists(jsonObj.userCollectionHeroscapeSets[i])){
						const newLinkObj = UserCollectionHeroscapeSet.get(jsonObj.userCollectionHeroscapeSets[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.userCollectionHeroscapeSets.length; j++) {
							if (this.userCollectionHeroscapeSets[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.userCollectionHeroscapeSets.push(newLinkObj);
						}
					} else {
						const newForeignObj = new UserCollectionHeroscapeSet(jsonObj.userCollectionHeroscapeSets[i]);
						if ( ! this.userCollectionHeroscapeSets.includes(newForeignObj)) {
							this.userCollectionHeroscapeSets.push(newForeignObj);
						}
						newForeignObj.heroscapeSet = this;
					}
				}
			}
			UserCollectionHeroscapeSet.orderBy(this.userCollectionHeroscapeSets);
			
			HeroscapeSet.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Heroscape Set";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "abbreviation", "releaseDate", "masterSet", "terrainExpansion"];
	}

	static getAllFields() {
		return ["id", "name", "abbreviation", "releaseDate", "masterSet", "terrainExpansion"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "abbreviation", "releaseDate", "masterSet", "terrainExpansion"].includes(columnName)) {
			return HeroscapeSet;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "abbreviation":
				return null;
			case "releaseDate":
				return null;
			case "masterSet":
				return null;
			case "terrainExpansion":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "abbreviation":
				return ""; // TODO
			case "releaseDate":
				return ""; // TODO
			case "masterSet":
				return ""; // TODO
			case "terrainExpansion":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (HeroscapeSet.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeSet.includeField("abbreviation", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "abbreviation";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Abbreviation";
			if (this.abbreviation !== null) {
				fieldData["value"] = this.abbreviation;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeSet.includeField("releaseDate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "releaseDate";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Release Date";
			if (this.releaseDate !== null) {
				fieldData["value"] = this.releaseDate;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeSet.includeField("masterSet", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "masterSet";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Master Set";
			if (this.masterSet !== null) {
				fieldData["value"] = this.masterSet;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeSet.includeField("terrainExpansion", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "terrainExpansion";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Terrain Expansion";
			if (this.terrainExpansion !== null) {
				fieldData["value"] = this.terrainExpansion;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeSet.options.fieldOrder !== undefined && HeroscapeSet.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, HeroscapeSet.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

HeroscapeSet.list = [];
HeroscapeSet.options = [];

class HeroscapeMapSet extends DatabaseObject {
	constructor(jsonObj) {
		if (HeroscapeMapSet.exists(jsonObj)) {
			return HeroscapeMapSet.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.map = null; // Int
		this.terrainSet = null; // Int
		this.quantity = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			HeroscapeMapSet.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.map != null) {
				this.map = HeroscapeMap.exists(jsonObj.map) ?
					HeroscapeMap.get(jsonObj.map) : new HeroscapeMap(jsonObj.map);
				if ( ! this.map.heroscapeMapSets.includes(this)) {
					this.map.heroscapeMapSets.push(this);
					HeroscapeMap.orderBy(this.map.heroscapeMapSets);
				}
			}
			if (jsonObj.terrainSet != null) {
				this.terrainSet = HeroscapeSet.exists(jsonObj.terrainSet) ?
					HeroscapeSet.get(jsonObj.terrainSet) : new HeroscapeSet(jsonObj.terrainSet);
				if ( ! this.terrainSet.heroscapeMapSets.includes(this)) {
					this.terrainSet.heroscapeMapSets.push(this);
					HeroscapeSet.orderBy(this.terrainSet.heroscapeMapSets);
				}
			}
			this.quantity = jsonObj.quantity;
			
			// Links
			
			HeroscapeMapSet.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Heroscape Map Set";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "map", "terrainSet", "quantity"];
	}

	static getAllFields() {
		return ["id", "map", "terrainSet", "quantity"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "mapID", "terrainSetID", "quantity"].includes(columnName)) {
			return HeroscapeMapSet;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "mapID":
				return "HeroscapeMap";
			case "terrainSetID":
				return "HeroscapeSet";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	// @DoNotUpdate
	toDisplayString() {
		return this.quantity + "x " + this.terrainSet.abbreviation;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "map":
				return null;
			case "terrainSet":
				return null;
			case "quantity":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "map":
				return ""; // TODO
			case "terrainSet":
				return ""; // TODO
			case "quantity":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (HeroscapeMapSet.includeField("map", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "map";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = HeroscapeMap.selectOptions(this.map, this.selectFilters("map", filterObjects));
			fieldData["optionClass"] = "HeroscapeMap";
			fieldData["propertyForeignClass"] = HeroscapeMap;
			fieldData["label"] = "Map";
			if (this.map !== undefined && this.map !== null) {
				fieldData["value"] = this.map.toDisplayString();
				fieldData["databaseObj"] = this.map;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMapSet.includeField("terrainSet", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "terrainSet";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = HeroscapeSet.selectOptions(this.terrainSet, this.selectFilters("terrainSet", filterObjects));
			fieldData["optionClass"] = "HeroscapeSet";
			fieldData["propertyForeignClass"] = HeroscapeSet;
			fieldData["label"] = "Terrain Set";
			if (this.terrainSet !== undefined && this.terrainSet !== null) {
				fieldData["value"] = this.terrainSet.toDisplayString();
				fieldData["databaseObj"] = this.terrainSet;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMapSet.includeField("quantity", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "quantity";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Quantity";
			if (this.quantity !== null) {
				fieldData["value"] = this.quantity;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMapSet.options.fieldOrder !== undefined && HeroscapeMapSet.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, HeroscapeMapSet.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "map":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.map = jsonObj;
				} else if (HeroscapeMap.exists(jsonObj)) {
					this.map = HeroscapeMap.get(jsonObj);
				} else {
					this.map = new HeroscapeMap(jsonObj);
				}
				break;
			case "terrainSet":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.terrainSet = jsonObj;
				} else if (HeroscapeSet.exists(jsonObj)) {
					this.terrainSet = HeroscapeSet.get(jsonObj);
				} else {
					this.terrainSet = new HeroscapeSet(jsonObj);
				}
				break;
		}
	}

}

HeroscapeMapSet.list = [];
HeroscapeMapSet.options = [];

class HeroscapeMapTag extends DatabaseObject {
	constructor(jsonObj) {
		if (HeroscapeMapTag.exists(jsonObj)) {
			return HeroscapeMapTag.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.tag = null; // String
		
		// Links
		this.links = [{maps: HeroscapeMap, label: "Heroscape Maps"}];
		this.maps = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			HeroscapeMapTag.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.tag = jsonObj.tag;
			
			// Links
			if (jsonObj.maps != undefined && jsonObj.maps != null) {
				for (var i = 0; i < jsonObj.maps.length; i++) {
					if (HeroscapeMap.exists(jsonObj.maps[i])){
						const newLinkObj = HeroscapeMap.get(jsonObj.maps[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.maps.length; j++) {
							if (this.maps[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.maps.push(newLinkObj);
						}
					} else {
						const newForeignObj = new HeroscapeMap(jsonObj.maps[i]);
						if ( ! this.maps.includes(newForeignObj)) {
							this.maps.push(newForeignObj);
						}
					}
				}
			}
			HeroscapeMap.orderBy(this.maps);
			
			HeroscapeMapTag.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Heroscape Map Tag";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "tag"];
	}

	static getAllFields() {
		return ["id", "tag"];
	}

	static getNtoMLinkClasses() {
		return {maps: HeroscapeMap};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "tag"].includes(columnName)) {
			return HeroscapeMapTag;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	// @DoNotUpdate
	toDisplayString() {
		return this.tag;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "tag":
				return null;
			case "maps":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "tag":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (HeroscapeMapTag.includeField("tag", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "tag";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Tag";
			if (this.tag !== null) {
				fieldData["value"] = this.tag;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMapTag.options.fieldOrder !== undefined && HeroscapeMapTag.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, HeroscapeMapTag.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

HeroscapeMapTag.list = [];
HeroscapeMapTag.options = [];

class HeroscapeMapPreviousVersion extends DatabaseObject {
	constructor(jsonObj) {
		if (HeroscapeMapPreviousVersion.exists(jsonObj)) {
			return HeroscapeMapPreviousVersion.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.map = null; // Int
		this.versionNumber = null; // Int
		this.buildInstructionsUrl = null; // String
		this.imageUrl = null; // String
		this.ohsGdocId = null; // String
		this.startDate = null; // Date
		this.endDate = null; // Date
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			HeroscapeMapPreviousVersion.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.map != null) {
				this.map = HeroscapeMap.exists(jsonObj.map) ?
					HeroscapeMap.get(jsonObj.map) : new HeroscapeMap(jsonObj.map);
				if ( ! this.map.heroscapeMapPreviousVersions.includes(this)) {
					this.map.heroscapeMapPreviousVersions.push(this);
					HeroscapeMap.orderBy(this.map.heroscapeMapPreviousVersions);
				}
			}
			this.versionNumber = jsonObj.versionNumber;
			this.buildInstructionsUrl = jsonObj.buildInstructionsUrl;
			this.imageUrl = jsonObj.imageUrl;
			this.ohsGdocId = jsonObj.ohsGdocId;
			this.startDate = jsonObj.startDate;
			this.endDate = jsonObj.endDate;
			
			// Links
			
			HeroscapeMapPreviousVersion.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Heroscape Map Previous Version";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "map", "versionNumber", "startDate", "endDate"];
	}

	static getAllFields() {
		return ["id", "map", "versionNumber", "buildInstructionsUrl", "imageUrl", "ohsGdocId", "startDate", "endDate"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "mapID", "versionNumber", "buildInstructionsUrl", "imageUrl", "ohsGdocId", "startDate", "endDate"].includes(columnName)) {
			return HeroscapeMapPreviousVersion;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "mapID":
				return "HeroscapeMap";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "map":
				return null;
			case "versionNumber":
				return null;
			case "buildInstructionsUrl":
				return null;
			case "imageUrl":
				return null;
			case "ohsGdocId":
				return null;
			case "startDate":
				return null;
			case "endDate":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "map":
				return ""; // TODO
			case "versionNumber":
				return ""; // TODO
			case "buildInstructionsUrl":
				return ""; // TODO
			case "imageUrl":
				return ""; // TODO
			case "ohsGdocId":
				return ""; // TODO
			case "startDate":
				return ""; // TODO
			case "endDate":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (HeroscapeMapPreviousVersion.includeField("map", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "map";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = HeroscapeMap.selectOptions(this.map, this.selectFilters("map", filterObjects));
			fieldData["optionClass"] = "HeroscapeMap";
			fieldData["propertyForeignClass"] = HeroscapeMap;
			fieldData["label"] = "Map";
			if (this.map !== undefined && this.map !== null) {
				fieldData["value"] = this.map.toDisplayString();
				fieldData["databaseObj"] = this.map;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMapPreviousVersion.includeField("versionNumber", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "versionNumber";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Version Number";
			if (this.versionNumber !== null) {
				fieldData["value"] = this.versionNumber;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMapPreviousVersion.includeField("buildInstructionsUrl", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "buildInstructionsUrl";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Build Instructions Url";
			if (this.buildInstructionsUrl !== null) {
				fieldData["value"] = this.buildInstructionsUrl;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMapPreviousVersion.includeField("imageUrl", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "imageUrl";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Image Url";
			if (this.imageUrl !== null) {
				fieldData["value"] = this.imageUrl;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMapPreviousVersion.includeField("ohsGdocId", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "ohsGdocId";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Ohs Gdoc Id";
			if (this.ohsGdocId !== null) {
				fieldData["value"] = this.ohsGdocId;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMapPreviousVersion.includeField("startDate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "startDate";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "Start Date";
			if (this.startDate !== null) {
				fieldData["value"] = this.startDate;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMapPreviousVersion.includeField("endDate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "endDate";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "End Date";
			if (this.endDate !== null) {
				fieldData["value"] = this.endDate;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMapPreviousVersion.options.fieldOrder !== undefined && HeroscapeMapPreviousVersion.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, HeroscapeMapPreviousVersion.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "map":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.map = jsonObj;
				} else if (HeroscapeMap.exists(jsonObj)) {
					this.map = HeroscapeMap.get(jsonObj);
				} else {
					this.map = new HeroscapeMap(jsonObj);
				}
				break;
		}
	}

}

HeroscapeMapPreviousVersion.list = [];
HeroscapeMapPreviousVersion.options = [];

class UserPasswordReset extends DatabaseObject {
	constructor(jsonObj) {
		if (UserPasswordReset.exists(jsonObj)) {
			return UserPasswordReset.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.user = null; // Int
		this.resetKey = null; // String
		this.resetRequestTime = null; // Datetime
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			UserPasswordReset.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.user != null) {
				this.user = User.exists(jsonObj.user) ?
					User.get(jsonObj.user) : new User(jsonObj.user);
				if ( ! this.user.userPasswordResets.includes(this)) {
					this.user.userPasswordResets.push(this);
					User.orderBy(this.user.userPasswordResets);
				}
			}
			this.resetKey = jsonObj.resetKey;
			this.resetRequestTime = jsonObj.resetRequestTime;
			
			// Links
			
			UserPasswordReset.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "User Password Reset";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "user", "resetKey", "resetRequestTime"];
	}

	static getAllFields() {
		return ["id", "user", "resetKey", "resetRequestTime"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "userID", "resetKey", "resetRequestTime"].includes(columnName)) {
			return UserPasswordReset;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "userID":
				return "User";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "user":
				return null;
			case "resetKey":
				return null;
			case "resetRequestTime":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "user":
				return ""; // TODO
			case "resetKey":
				return ""; // TODO
			case "resetRequestTime":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (UserPasswordReset.includeField("user", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "user";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = User.selectOptions(this.user, this.selectFilters("user", filterObjects));
			fieldData["optionClass"] = "User";
			fieldData["propertyForeignClass"] = User;
			fieldData["label"] = "User";
			if (this.user !== undefined && this.user !== null) {
				fieldData["value"] = this.user.toDisplayString();
				fieldData["databaseObj"] = this.user;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UserPasswordReset.includeField("resetKey", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "resetKey";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Reset Key";
			if (this.resetKey !== null) {
				fieldData["value"] = this.resetKey;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UserPasswordReset.includeField("resetRequestTime", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "resetRequestTime";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "datetime-local";
			fieldData["label"] = "Reset Request Time";
			if (this.resetRequestTime !== null) {
				fieldData["value"] = forEditing ? this.resetRequestTime.replace(' ','T') : new Date(this.resetRequestTime).toString();
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UserPasswordReset.options.fieldOrder !== undefined && UserPasswordReset.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, UserPasswordReset.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "user":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.user = jsonObj;
				} else if (User.exists(jsonObj)) {
					this.user = User.get(jsonObj);
				} else {
					this.user = new User(jsonObj);
				}
				break;
		}
	}

}

UserPasswordReset.list = [];
UserPasswordReset.options = [];

class FigureSet extends DatabaseObject {
	constructor(jsonObj) {
		if (FigureSet.exists(jsonObj)) {
			return FigureSet.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.sDomain = null; // String
		this.includeBase = null; // Boolean
		this.includeDelta = null; // Boolean
		this.includeVC = null; // Boolean
		this.googleDocId = null; // String
		this.public = null; // Boolean
		
		// Links
		this.links = [{tournaments: Tournament, label: "Tournaments", nTo1Link: true, linkField: 'figureSet'}, {cards: Card, label: "Cards", nTo1Link: true, linkField: 'figureSet'}, {figureSetSubGroups: FigureSetSubGroup, label: "Figure Set Sub Groups", nTo1Link: true, linkField: 'figureSet'}, {generals: General, label: "Generals", nTo1Link: true, linkField: 'figureSet'}, {homeworlds: Homeworld, label: "Homeworlds", nTo1Link: true, linkField: 'figureSet'}, {speciess: Species, label: "Speciess", nTo1Link: true, linkField: 'figureSet'}, {cardClasss: CardClass, label: "Card Classs", nTo1Link: true, linkField: 'figureSet'}, {personalitys: Personality, label: "Personalitys", nTo1Link: true, linkField: 'figureSet'}];
		this.tournaments = [];
		this.cards = [];
		this.figureSetSubGroups = [];
		this.generals = [];
		this.homeworlds = [];
		this.speciess = [];
		this.cardClasss = [];
		this.personalitys = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			FigureSet.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.sDomain = jsonObj.sDomain;
			this.includeBase = jsonObj.includeBase;
			this.includeDelta = jsonObj.includeDelta;
			this.includeVC = jsonObj.includeVC;
			this.googleDocId = jsonObj.googleDocId;
			this.public = jsonObj.public;
			
			// Links
			if (jsonObj.tournaments != undefined && jsonObj.tournaments != null) {
				for (var i = 0; i < jsonObj.tournaments.length; i++) {
					if (Tournament.exists(jsonObj.tournaments[i])){
						const newLinkObj = Tournament.get(jsonObj.tournaments[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.tournaments.length; j++) {
							if (this.tournaments[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.tournaments.push(newLinkObj);
						}
					} else {
						const newForeignObj = Tournament.newChild(jsonObj.tournaments[i]);
						if ( ! this.tournaments.includes(newForeignObj)) {
							this.tournaments.push(newForeignObj);
						}
						newForeignObj.figureSet = this;
					}
				}
			}
			Tournament.orderBy(this.tournaments);
			if (jsonObj.cards != undefined && jsonObj.cards != null) {
				for (var i = 0; i < jsonObj.cards.length; i++) {
					if (Card.exists(jsonObj.cards[i])){
						const newLinkObj = Card.get(jsonObj.cards[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.cards.length; j++) {
							if (this.cards[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.cards.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Card(jsonObj.cards[i]);
						if ( ! this.cards.includes(newForeignObj)) {
							this.cards.push(newForeignObj);
						}
						newForeignObj.figureSet = this;
					}
				}
			}
			Card.orderBy(this.cards);
			if (jsonObj.figureSetSubGroups != undefined && jsonObj.figureSetSubGroups != null) {
				for (var i = 0; i < jsonObj.figureSetSubGroups.length; i++) {
					if (FigureSetSubGroup.exists(jsonObj.figureSetSubGroups[i])){
						const newLinkObj = FigureSetSubGroup.get(jsonObj.figureSetSubGroups[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.figureSetSubGroups.length; j++) {
							if (this.figureSetSubGroups[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.figureSetSubGroups.push(newLinkObj);
						}
					} else {
						const newForeignObj = new FigureSetSubGroup(jsonObj.figureSetSubGroups[i]);
						if ( ! this.figureSetSubGroups.includes(newForeignObj)) {
							this.figureSetSubGroups.push(newForeignObj);
						}
						newForeignObj.figureSet = this;
					}
				}
			}
			FigureSetSubGroup.orderBy(this.figureSetSubGroups);
			if (jsonObj.generals != undefined && jsonObj.generals != null) {
				for (var i = 0; i < jsonObj.generals.length; i++) {
					if (General.exists(jsonObj.generals[i])){
						const newLinkObj = General.get(jsonObj.generals[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.generals.length; j++) {
							if (this.generals[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.generals.push(newLinkObj);
						}
					} else {
						const newForeignObj = new General(jsonObj.generals[i]);
						if ( ! this.generals.includes(newForeignObj)) {
							this.generals.push(newForeignObj);
						}
						newForeignObj.figureSet = this;
					}
				}
			}
			General.orderBy(this.generals);
			if (jsonObj.homeworlds != undefined && jsonObj.homeworlds != null) {
				for (var i = 0; i < jsonObj.homeworlds.length; i++) {
					if (Homeworld.exists(jsonObj.homeworlds[i])){
						const newLinkObj = Homeworld.get(jsonObj.homeworlds[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.homeworlds.length; j++) {
							if (this.homeworlds[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.homeworlds.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Homeworld(jsonObj.homeworlds[i]);
						if ( ! this.homeworlds.includes(newForeignObj)) {
							this.homeworlds.push(newForeignObj);
						}
						newForeignObj.figureSet = this;
					}
				}
			}
			Homeworld.orderBy(this.homeworlds);
			if (jsonObj.speciess != undefined && jsonObj.speciess != null) {
				for (var i = 0; i < jsonObj.speciess.length; i++) {
					if (Species.exists(jsonObj.speciess[i])){
						const newLinkObj = Species.get(jsonObj.speciess[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.speciess.length; j++) {
							if (this.speciess[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.speciess.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Species(jsonObj.speciess[i]);
						if ( ! this.speciess.includes(newForeignObj)) {
							this.speciess.push(newForeignObj);
						}
						newForeignObj.figureSet = this;
					}
				}
			}
			Species.orderBy(this.speciess);
			if (jsonObj.cardClasss != undefined && jsonObj.cardClasss != null) {
				for (var i = 0; i < jsonObj.cardClasss.length; i++) {
					if (CardClass.exists(jsonObj.cardClasss[i])){
						const newLinkObj = CardClass.get(jsonObj.cardClasss[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.cardClasss.length; j++) {
							if (this.cardClasss[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.cardClasss.push(newLinkObj);
						}
					} else {
						const newForeignObj = new CardClass(jsonObj.cardClasss[i]);
						if ( ! this.cardClasss.includes(newForeignObj)) {
							this.cardClasss.push(newForeignObj);
						}
						newForeignObj.figureSet = this;
					}
				}
			}
			CardClass.orderBy(this.cardClasss);
			if (jsonObj.personalitys != undefined && jsonObj.personalitys != null) {
				for (var i = 0; i < jsonObj.personalitys.length; i++) {
					if (Personality.exists(jsonObj.personalitys[i])){
						const newLinkObj = Personality.get(jsonObj.personalitys[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.personalitys.length; j++) {
							if (this.personalitys[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.personalitys.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Personality(jsonObj.personalitys[i]);
						if ( ! this.personalitys.includes(newForeignObj)) {
							this.personalitys.push(newForeignObj);
						}
						newForeignObj.figureSet = this;
					}
				}
			}
			Personality.orderBy(this.personalitys);
			
			FigureSet.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Figure Set";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "sDomain", "includeBase", "includeDelta", "includeVC", "googleDocId", "public"];
	}

	static getAllFields() {
		return ["id", "name", "sDomain", "includeBase", "includeDelta", "includeVC", "googleDocId", "public"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "sDomain", "includeBase", "includeDelta", "includeVC", "googleDocId", "public"].includes(columnName)) {
			return FigureSet;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "sDomain":
				return null;
			case "includeBase":
				return null;
			case "includeDelta":
				return null;
			case "includeVC":
				return null;
			case "googleDocId":
				return null;
			case "public":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "sDomain":
				return ""; // TODO
			case "includeBase":
				return ""; // TODO
			case "includeDelta":
				return ""; // TODO
			case "includeVC":
				return ""; // TODO
			case "googleDocId":
				return ""; // TODO
			case "public":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (FigureSet.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureSet.includeField("sDomain", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "sDomain";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "S Domain";
			if (this.sDomain !== null) {
				fieldData["value"] = this.sDomain;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureSet.includeField("includeBase", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "includeBase";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Include Base";
			if (this.includeBase !== null) {
				fieldData["value"] = this.includeBase;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (FigureSet.includeField("includeDelta", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "includeDelta";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Include Delta";
			if (this.includeDelta !== null) {
				fieldData["value"] = this.includeDelta;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (FigureSet.includeField("includeVC", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "includeVC";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Include VC";
			if (this.includeVC !== null) {
				fieldData["value"] = this.includeVC;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (FigureSet.includeField("googleDocId", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "googleDocId";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Google Doc Id";
			if (this.googleDocId !== null) {
				fieldData["value"] = this.googleDocId;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureSet.includeField("public", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "public";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Public";
			if (this.public !== null) {
				fieldData["value"] = this.public;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (FigureSet.options.fieldOrder !== undefined && FigureSet.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, FigureSet.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

FigureSet.list = [];
FigureSet.options = [];

class ConventionMap extends DatabaseObject {
	constructor(jsonObj) {
		if (ConventionMap.exists(jsonObj)) {
			return ConventionMap.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.convention = null; // Int
		this.map = null; // Int
		this.quantity = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			ConventionMap.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.convention != null) {
				this.convention = Convention.exists(jsonObj.convention) ?
					Convention.get(jsonObj.convention) : new Convention(jsonObj.convention);
				if ( ! this.convention.conventionMaps.includes(this)) {
					this.convention.conventionMaps.push(this);
					Convention.orderBy(this.convention.conventionMaps);
				}
			}
			if (jsonObj.map != null) {
				this.map = HeroscapeMap.exists(jsonObj.map) ?
					HeroscapeMap.get(jsonObj.map) : new HeroscapeMap(jsonObj.map);
				if ( ! this.map.conventionMaps.includes(this)) {
					this.map.conventionMaps.push(this);
					HeroscapeMap.orderBy(this.map.conventionMaps);
				}
			}
			this.quantity = jsonObj.quantity;
			
			// Links
			
			ConventionMap.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Convention Map";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "convention", "map", "quantity"];
	}

	static getAllFields() {
		return ["id", "convention", "map", "quantity"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "conventionID", "mapID", "quantity"].includes(columnName)) {
			return ConventionMap;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "conventionID":
				return "Convention";
			case "mapID":
				return "HeroscapeMap";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "convention":
				return null;
			case "map":
				return null;
			case "quantity":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "convention":
				return ""; // TODO
			case "map":
				return ""; // TODO
			case "quantity":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (ConventionMap.includeField("convention", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "convention";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Convention.selectOptions(this.convention, this.selectFilters("convention", filterObjects));
			fieldData["optionClass"] = "Convention";
			fieldData["propertyForeignClass"] = Convention;
			fieldData["label"] = "Convention";
			if (this.convention !== undefined && this.convention !== null) {
				fieldData["value"] = this.convention.toDisplayString();
				fieldData["databaseObj"] = this.convention;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionMap.includeField("map", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "map";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = HeroscapeMap.selectOptions(this.map, this.selectFilters("map", filterObjects));
			fieldData["optionClass"] = "HeroscapeMap";
			fieldData["propertyForeignClass"] = HeroscapeMap;
			fieldData["label"] = "Map";
			if (this.map !== undefined && this.map !== null) {
				fieldData["value"] = this.map.toDisplayString();
				fieldData["databaseObj"] = this.map;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionMap.includeField("quantity", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "quantity";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Quantity";
			if (this.quantity !== null) {
				fieldData["value"] = this.quantity;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ConventionMap.options.fieldOrder !== undefined && ConventionMap.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, ConventionMap.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "convention":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.convention = jsonObj;
				} else if (Convention.exists(jsonObj)) {
					this.convention = Convention.get(jsonObj);
				} else {
					this.convention = new Convention(jsonObj);
				}
				break;
			case "map":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.map = jsonObj;
				} else if (HeroscapeMap.exists(jsonObj)) {
					this.map = HeroscapeMap.get(jsonObj);
				} else {
					this.map = new HeroscapeMap(jsonObj);
				}
				break;
		}
	}

}

ConventionMap.list = [];
ConventionMap.options = [];

class Clock extends DatabaseObject {
	constructor(jsonObj) {
		if (Clock.exists(jsonObj)) {
			return Clock.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.chess = null; // Boolean
		this.countDown = null; // Boolean
		this.createdTime = null; // Datetime
		
		// Links
		this.links = [{playerClocks: PlayerClock, label: "Player Clocks", nTo1Link: true, linkField: 'clock'}];
		this.playerClocks = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Clock.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.chess = jsonObj.chess;
			this.countDown = jsonObj.countDown;
			this.createdTime = jsonObj.createdTime;
			
			// Links
			if (jsonObj.playerClocks != undefined && jsonObj.playerClocks != null) {
				for (var i = 0; i < jsonObj.playerClocks.length; i++) {
					if (PlayerClock.exists(jsonObj.playerClocks[i])){
						const newLinkObj = PlayerClock.get(jsonObj.playerClocks[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.playerClocks.length; j++) {
							if (this.playerClocks[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.playerClocks.push(newLinkObj);
						}
					} else {
						const newForeignObj = new PlayerClock(jsonObj.playerClocks[i]);
						if ( ! this.playerClocks.includes(newForeignObj)) {
							this.playerClocks.push(newForeignObj);
						}
						newForeignObj.clock = this;
					}
				}
			}
			PlayerClock.orderBy(this.playerClocks);
			
			Clock.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Clock";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "chess", "countDown", "createdTime"];
	}

	static getAllFields() {
		return ["id", "chess", "countDown", "createdTime"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "chess", "countDown", "createdTime"].includes(columnName)) {
			return Clock;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "chess":
				return null;
			case "countDown":
				return null;
			case "createdTime":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "chess":
				return ""; // TODO
			case "countDown":
				return ""; // TODO
			case "createdTime":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Clock.includeField("chess", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "chess";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Chess";
			if (this.chess !== null) {
				fieldData["value"] = this.chess;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Clock.includeField("countDown", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "countDown";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Count Down";
			if (this.countDown !== null) {
				fieldData["value"] = this.countDown;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Clock.includeField("createdTime", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "createdTime";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "datetime-local";
			fieldData["label"] = "Created Time";
			if (this.createdTime !== null) {
				fieldData["value"] = forEditing ? this.createdTime.replace(' ','T') : new Date(this.createdTime).toString();
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Clock.options.fieldOrder !== undefined && Clock.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Clock.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

Clock.list = [];
Clock.options = [];

class PlayerClock extends DatabaseObject {
	constructor(jsonObj) {
		if (PlayerClock.exists(jsonObj)) {
			return PlayerClock.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.timeInSeconds = null; // Int
		this.clock = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			PlayerClock.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.timeInSeconds = jsonObj.timeInSeconds;
			if (jsonObj.clock != null) {
				this.clock = Clock.exists(jsonObj.clock) ?
					Clock.get(jsonObj.clock) : new Clock(jsonObj.clock);
				if ( ! this.clock.playerClocks.includes(this)) {
					this.clock.playerClocks.push(this);
					Clock.orderBy(this.clock.playerClocks);
				}
			}
			
			// Links
			
			PlayerClock.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Player Clock";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "timeInSeconds", "clock"];
	}

	static getAllFields() {
		return ["id", "name", "timeInSeconds", "clock"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "timeInSeconds", "clockID"].includes(columnName)) {
			return PlayerClock;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "clockID":
				return "Clock";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "timeInSeconds":
				return null;
			case "clock":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "timeInSeconds":
				return ""; // TODO
			case "clock":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (PlayerClock.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (PlayerClock.includeField("timeInSeconds", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "timeInSeconds";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Time In Seconds";
			if (this.timeInSeconds !== null) {
				fieldData["value"] = this.timeInSeconds;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (PlayerClock.includeField("clock", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "clock";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Clock.selectOptions(this.clock, this.selectFilters("clock", filterObjects));
			fieldData["optionClass"] = "Clock";
			fieldData["propertyForeignClass"] = Clock;
			fieldData["label"] = "Clock";
			if (this.clock !== undefined && this.clock !== null) {
				fieldData["value"] = this.clock.toDisplayString();
				fieldData["databaseObj"] = this.clock;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (PlayerClock.options.fieldOrder !== undefined && PlayerClock.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, PlayerClock.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "clock":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.clock = jsonObj;
				} else if (Clock.exists(jsonObj)) {
					this.clock = Clock.get(jsonObj);
				} else {
					this.clock = new Clock(jsonObj);
				}
				break;
		}
	}

}

PlayerClock.list = [];
PlayerClock.options = [];

class Glyph extends DatabaseObject {
	constructor(jsonObj) {
		if (Glyph.exists(jsonObj)) {
			return Glyph.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.abbreviation = null; // String
		this.summary = null; // String
		this.description = null; // String
		this.imageUrl = null; // Int
		this.powerGlyph = null; // Boolean
		this.temporaryGlyph = null; // Boolean
		this.vcGlyph = null; // Boolean
		this.author = null; // Int
		
		// Links
		this.links = [{gameMapGlyphs: GameMapGlyph, label: "Game Map Glyphs", nTo1Link: true, linkField: 'glyph'}, {tags: GlyphTag, label: "Glyph Tags"}];
		this.gameMapGlyphs = [];
		this.tags = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Glyph.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.abbreviation = jsonObj.abbreviation;
			this.summary = jsonObj.summary;
			this.description = jsonObj.description;
			this.imageUrl = jsonObj.imageUrl;
			this.powerGlyph = jsonObj.powerGlyph;
			this.temporaryGlyph = jsonObj.temporaryGlyph;
			this.vcGlyph = jsonObj.vcGlyph;
			if (jsonObj.author != null) {
				this.author = User.exists(jsonObj.author) ?
					User.get(jsonObj.author) : new User(jsonObj.author);
				if ( ! this.author.glyphs.includes(this)) {
					this.author.glyphs.push(this);
					User.orderBy(this.author.glyphs);
				}
			}
			
			// Links
			if (jsonObj.gameMapGlyphs != undefined && jsonObj.gameMapGlyphs != null) {
				for (var i = 0; i < jsonObj.gameMapGlyphs.length; i++) {
					if (GameMapGlyph.exists(jsonObj.gameMapGlyphs[i])){
						const newLinkObj = GameMapGlyph.get(jsonObj.gameMapGlyphs[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.gameMapGlyphs.length; j++) {
							if (this.gameMapGlyphs[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.gameMapGlyphs.push(newLinkObj);
						}
					} else {
						const newForeignObj = new GameMapGlyph(jsonObj.gameMapGlyphs[i]);
						if ( ! this.gameMapGlyphs.includes(newForeignObj)) {
							this.gameMapGlyphs.push(newForeignObj);
						}
						newForeignObj.glyph = this;
					}
				}
			}
			GameMapGlyph.orderBy(this.gameMapGlyphs);
			if (jsonObj.tags != undefined && jsonObj.tags != null) {
				for (var i = 0; i < jsonObj.tags.length; i++) {
					if (GlyphTag.exists(jsonObj.tags[i])){
						const newLinkObj = GlyphTag.get(jsonObj.tags[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.tags.length; j++) {
							if (this.tags[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.tags.push(newLinkObj);
						}
					} else {
						const newForeignObj = new GlyphTag(jsonObj.tags[i]);
						if ( ! this.tags.includes(newForeignObj)) {
							this.tags.push(newForeignObj);
						}
					}
				}
			}
			GlyphTag.orderBy(this.tags);
			
			Glyph.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Glyph";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "abbreviation", "summary", "description", "powerGlyph", "temporaryGlyph", "vcGlyph"];
	}

	static getAllFields() {
		return ["id", "name", "abbreviation", "summary", "description", "imageUrl", "powerGlyph", "temporaryGlyph", "vcGlyph", "author"];
	}

	static getNtoMLinkClasses() {
		return {tags: GlyphTag};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "abbreviation", "summary", "description", "imageUrl", "powerGlyph", "temporaryGlyph", "vcGlyph", "authorID"].includes(columnName)) {
			return Glyph;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "authorID":
				return "User";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "abbreviation":
				return null;
			case "summary":
				return null;
			case "description":
				return null;
			case "imageUrl":
				return null;
			case "powerGlyph":
				return null;
			case "temporaryGlyph":
				return null;
			case "vcGlyph":
				return null;
			case "author":
				return null;
			case "tags":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "abbreviation":
				return ""; // TODO
			case "summary":
				return ""; // TODO
			case "description":
				return ""; // TODO
			case "imageUrl":
				return ""; // TODO
			case "powerGlyph":
				return ""; // TODO
			case "temporaryGlyph":
				return ""; // TODO
			case "vcGlyph":
				return ""; // TODO
			case "author":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Glyph.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Glyph.includeField("abbreviation", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "abbreviation";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Abbreviation";
			if (this.abbreviation !== null) {
				fieldData["value"] = this.abbreviation;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Glyph.includeField("summary", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "summary";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Summary";
			if (this.summary !== null) {
				fieldData["value"] = this.summary;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Glyph.includeField("description", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "description";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Description";
			if (this.description !== null) {
				fieldData["value"] = this.description;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Glyph.includeField("imageUrl", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "imageUrl";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Image Url";
			if (this.imageUrl !== null) {
				fieldData["value"] = this.imageUrl;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Glyph.includeField("powerGlyph", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "powerGlyph";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Power Glyph";
			if (this.powerGlyph !== null) {
				fieldData["value"] = this.powerGlyph;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Glyph.includeField("temporaryGlyph", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "temporaryGlyph";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Temporary Glyph";
			if (this.temporaryGlyph !== null) {
				fieldData["value"] = this.temporaryGlyph;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Glyph.includeField("vcGlyph", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "vcGlyph";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Vc Glyph";
			if (this.vcGlyph !== null) {
				fieldData["value"] = this.vcGlyph;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Glyph.includeField("author", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "author";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = User.selectOptions(this.author, this.selectFilters("author", filterObjects));
			fieldData["optionClass"] = "User";
			fieldData["propertyForeignClass"] = User;
			fieldData["label"] = "Author";
			if (this.author !== undefined && this.author !== null) {
				fieldData["value"] = this.author.toDisplayString();
				fieldData["databaseObj"] = this.author;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Glyph.options.fieldOrder !== undefined && Glyph.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Glyph.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "author":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.author = jsonObj;
				} else if (User.exists(jsonObj)) {
					this.author = User.get(jsonObj);
				} else {
					this.author = new User(jsonObj);
				}
				break;
		}
	}

}

Glyph.list = [];
Glyph.options = [];

class GameMapGlyph extends DatabaseObject {
	constructor(jsonObj) {
		if (GameMapGlyph.exists(jsonObj)) {
			return GameMapGlyph.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.gameMap = null; // Int
		this.glyph = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			GameMapGlyph.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.gameMap != null) {
				this.gameMap = GameMap.exists(jsonObj.gameMap) ?
					GameMap.get(jsonObj.gameMap) : new GameMap(jsonObj.gameMap);
				if ( ! this.gameMap.gameMapGlyphs.includes(this)) {
					this.gameMap.gameMapGlyphs.push(this);
					GameMap.orderBy(this.gameMap.gameMapGlyphs);
				}
			}
			if (jsonObj.glyph != null) {
				this.glyph = Glyph.exists(jsonObj.glyph) ?
					Glyph.get(jsonObj.glyph) : new Glyph(jsonObj.glyph);
				if ( ! this.glyph.gameMapGlyphs.includes(this)) {
					this.glyph.gameMapGlyphs.push(this);
					Glyph.orderBy(this.glyph.gameMapGlyphs);
				}
			}
			
			// Links
			
			GameMapGlyph.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Game Map Glyph";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "gameMap", "glyph"];
	}

	static getAllFields() {
		return ["id", "gameMap", "glyph"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "gameMapID", "glyphID"].includes(columnName)) {
			return GameMapGlyph;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "gameMapID":
				return "GameMap";
			case "glyphID":
				return "Glyph";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	// @DoNotUpdate
	toDisplayString() {
		return this.glyph.toDisplayString();
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "gameMap":
				return null;
			case "glyph":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "gameMap":
				return ""; // TODO
			case "glyph":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (GameMapGlyph.includeField("gameMap", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "gameMap";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = GameMap.selectOptions(this.gameMap, this.selectFilters("gameMap", filterObjects));
			fieldData["optionClass"] = "GameMap";
			fieldData["propertyForeignClass"] = GameMap;
			fieldData["label"] = "Game Map";
			if (this.gameMap !== undefined && this.gameMap !== null) {
				fieldData["value"] = this.gameMap.toDisplayString();
				fieldData["databaseObj"] = this.gameMap;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (GameMapGlyph.includeField("glyph", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "glyph";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Glyph.selectOptions(this.glyph, this.selectFilters("glyph", filterObjects));
			fieldData["optionClass"] = "Glyph";
			fieldData["propertyForeignClass"] = Glyph;
			fieldData["label"] = "Glyph";
			if (this.glyph !== undefined && this.glyph !== null) {
				fieldData["value"] = this.glyph.toDisplayString();
				fieldData["databaseObj"] = this.glyph;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (GameMapGlyph.options.fieldOrder !== undefined && GameMapGlyph.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, GameMapGlyph.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "gameMap":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.gameMap = jsonObj;
				} else if (GameMap.exists(jsonObj)) {
					this.gameMap = GameMap.get(jsonObj);
				} else {
					this.gameMap = new GameMap(jsonObj);
				}
				break;
			case "glyph":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.glyph = jsonObj;
				} else if (Glyph.exists(jsonObj)) {
					this.glyph = Glyph.get(jsonObj);
				} else {
					this.glyph = new Glyph(jsonObj);
				}
				break;
		}
	}

}

GameMapGlyph.list = [];
GameMapGlyph.options = [];

class GlyphTag extends DatabaseObject {
	constructor(jsonObj) {
		if (GlyphTag.exists(jsonObj)) {
			return GlyphTag.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		
		// Links
		this.links = [{glyphs: Glyph, label: "Glyphs"}];
		this.glyphs = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			GlyphTag.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			
			// Links
			if (jsonObj.glyphs != undefined && jsonObj.glyphs != null) {
				for (var i = 0; i < jsonObj.glyphs.length; i++) {
					if (Glyph.exists(jsonObj.glyphs[i])){
						const newLinkObj = Glyph.get(jsonObj.glyphs[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.glyphs.length; j++) {
							if (this.glyphs[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.glyphs.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Glyph(jsonObj.glyphs[i]);
						if ( ! this.glyphs.includes(newForeignObj)) {
							this.glyphs.push(newForeignObj);
						}
					}
				}
			}
			Glyph.orderBy(this.glyphs);
			
			GlyphTag.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Glyph Tag";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name"];
	}

	static getAllFields() {
		return ["id", "name"];
	}

	static getNtoMLinkClasses() {
		return {glyphs: Glyph};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name"].includes(columnName)) {
			return GlyphTag;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "glyphs":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (GlyphTag.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (GlyphTag.options.fieldOrder !== undefined && GlyphTag.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, GlyphTag.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

GlyphTag.list = [];
GlyphTag.options = [];

class TournamentFormat extends DatabaseObject {
	constructor(jsonObj) {
		if (TournamentFormat.exists(jsonObj)) {
			return TournamentFormat.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.impactBuilder = null; // Boolean
		this.description = null; // String
		
		// Links
		this.links = [{tournamentFormatTags: TournamentFormatTag, label: "Tournament Format Tags", nTo1Link: true, linkField: 'format'}];
		this.tournamentFormatTags = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			TournamentFormat.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.impactBuilder = jsonObj.impactBuilder;
			this.description = jsonObj.description;
			
			// Links
			if (jsonObj.tournamentFormatTags != undefined && jsonObj.tournamentFormatTags != null) {
				for (var i = 0; i < jsonObj.tournamentFormatTags.length; i++) {
					if (TournamentFormatTag.exists(jsonObj.tournamentFormatTags[i])){
						const newLinkObj = TournamentFormatTag.get(jsonObj.tournamentFormatTags[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.tournamentFormatTags.length; j++) {
							if (this.tournamentFormatTags[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.tournamentFormatTags.push(newLinkObj);
						}
					} else {
						const newForeignObj = new TournamentFormatTag(jsonObj.tournamentFormatTags[i]);
						if ( ! this.tournamentFormatTags.includes(newForeignObj)) {
							this.tournamentFormatTags.push(newForeignObj);
						}
						newForeignObj.format = this;
					}
				}
			}
			TournamentFormatTag.orderBy(this.tournamentFormatTags);
			
			TournamentFormat.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Tournament Format";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "impactBuilder"];
	}

	static getAllFields() {
		return ["id", "name", "impactBuilder", "description"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "impactBuilder", "description"].includes(columnName)) {
			return TournamentFormat;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "impactBuilder":
				return null;
			case "description":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "impactBuilder":
				return ""; // TODO
			case "description":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (TournamentFormat.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentFormat.includeField("impactBuilder", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "impactBuilder";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Impact Builder";
			if (this.impactBuilder !== null) {
				fieldData["value"] = this.impactBuilder;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (TournamentFormat.includeField("description", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "description";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Description";
			if (this.description !== null) {
				fieldData["value"] = this.description;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (TournamentFormat.options.fieldOrder !== undefined && TournamentFormat.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, TournamentFormat.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

TournamentFormat.list = [];
TournamentFormat.options = [];

class TournamentFormatTag extends DatabaseObject {
	constructor(jsonObj) {
		if (TournamentFormatTag.exists(jsonObj)) {
			return TournamentFormatTag.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.tournament = null; // Int
		this.format = null; // Int
		this.data = null; // String
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			TournamentFormatTag.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.tournament != null) {
				this.tournament = Tournament.exists(jsonObj.tournament) ?
					Tournament.get(jsonObj.tournament) : Tournament.newChild(jsonObj.tournament);
				if ( ! this.tournament.tournamentFormatTags.includes(this)) {
					this.tournament.tournamentFormatTags.push(this);
					Tournament.orderBy(this.tournament.tournamentFormatTags);
				}
			}
			if (jsonObj.format != null) {
				this.format = TournamentFormat.exists(jsonObj.format) ?
					TournamentFormat.get(jsonObj.format) : new TournamentFormat(jsonObj.format);
				if ( ! this.format.tournamentFormatTags.includes(this)) {
					this.format.tournamentFormatTags.push(this);
					TournamentFormat.orderBy(this.format.tournamentFormatTags);
				}
			}
			this.data = jsonObj.data;
			
			// Links
			
			TournamentFormatTag.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Tournament Format Tag";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "tournament", "format"];
	}

	static getAllFields() {
		return ["id", "tournament", "format", "data"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "tournamentID", "formatID", "data"].includes(columnName)) {
			return TournamentFormatTag;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "tournamentID":
				return "Tournament";
			case "formatID":
				return "TournamentFormat";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	// @DoNotUpdate
	toDisplayString() {
		var value = this.format.name;
		if (this.data != null) {
			value += " - " + this.data
		}
		return value;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "tournament":
				return null;
			case "format":
				return null;
			case "data":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "tournament":
				return ""; // TODO
			case "format":
				return ""; // TODO
			case "data":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (TournamentFormatTag.includeField("tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "tournament";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Tournament.selectOptions(this.tournament, this.selectFilters("tournament", filterObjects));
			fieldData["optionClass"] = "Tournament";
			fieldData["propertyForeignClass"] = Tournament;
			fieldData["label"] = "Tournament";
			if (this.tournament !== undefined && this.tournament !== null) {
				fieldData["value"] = this.tournament.toDisplayString();
				fieldData["databaseObj"] = this.tournament;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentFormatTag.includeField("format", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "format";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = TournamentFormat.selectOptions(this.format, this.selectFilters("format", filterObjects));
			fieldData["optionClass"] = "TournamentFormat";
			fieldData["propertyForeignClass"] = TournamentFormat;
			fieldData["label"] = "Format";
			if (this.format !== undefined && this.format !== null) {
				fieldData["value"] = this.format.toDisplayString();
				fieldData["databaseObj"] = this.format;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentFormatTag.includeField("data", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "data";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Data";
			if (this.data !== null) {
				fieldData["value"] = this.data;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (TournamentFormatTag.options.fieldOrder !== undefined && TournamentFormatTag.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, TournamentFormatTag.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "tournament":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.tournament = jsonObj;
				} else if (Tournament.exists(jsonObj)) {
					this.tournament = Tournament.get(jsonObj);
				} else {
					this.tournament = new Tournament(jsonObj);
				}
				break;
			case "format":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.format = jsonObj;
				} else if (TournamentFormat.exists(jsonObj)) {
					this.format = TournamentFormat.get(jsonObj);
				} else {
					this.format = new TournamentFormat(jsonObj);
				}
				break;
		}
	}

}

TournamentFormatTag.list = [];
TournamentFormatTag.options = [];

class UserSetting extends DatabaseObject {
	constructor(jsonObj) {
		if (UserSetting.exists(jsonObj)) {
			return UserSetting.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.dataType = null; // String
		
		// Links
		this.links = [{userSettingTags: UserSettingTag, label: "User Setting Tags", nTo1Link: true, linkField: 'userSetting'}, {userSettingOptions: UserSettingOption, label: "User Setting Options", nTo1Link: true, linkField: 'userSetting'}];
		this.userSettingTags = [];
		this.userSettingOptions = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			UserSetting.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.dataType = jsonObj.dataType;
			
			// Links
			if (jsonObj.userSettingTags != undefined && jsonObj.userSettingTags != null) {
				for (var i = 0; i < jsonObj.userSettingTags.length; i++) {
					if (UserSettingTag.exists(jsonObj.userSettingTags[i])){
						const newLinkObj = UserSettingTag.get(jsonObj.userSettingTags[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.userSettingTags.length; j++) {
							if (this.userSettingTags[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.userSettingTags.push(newLinkObj);
						}
					} else {
						const newForeignObj = new UserSettingTag(jsonObj.userSettingTags[i]);
						if ( ! this.userSettingTags.includes(newForeignObj)) {
							this.userSettingTags.push(newForeignObj);
						}
						newForeignObj.userSetting = this;
					}
				}
			}
			UserSettingTag.orderBy(this.userSettingTags);
			if (jsonObj.userSettingOptions != undefined && jsonObj.userSettingOptions != null) {
				for (var i = 0; i < jsonObj.userSettingOptions.length; i++) {
					if (UserSettingOption.exists(jsonObj.userSettingOptions[i])){
						const newLinkObj = UserSettingOption.get(jsonObj.userSettingOptions[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.userSettingOptions.length; j++) {
							if (this.userSettingOptions[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.userSettingOptions.push(newLinkObj);
						}
					} else {
						const newForeignObj = new UserSettingOption(jsonObj.userSettingOptions[i]);
						if ( ! this.userSettingOptions.includes(newForeignObj)) {
							this.userSettingOptions.push(newForeignObj);
						}
						newForeignObj.userSetting = this;
					}
				}
			}
			UserSettingOption.orderBy(this.userSettingOptions);
			
			UserSetting.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "User Setting";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "dataType"];
	}

	static getAllFields() {
		return ["id", "name", "dataType"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "dataType"].includes(columnName)) {
			return UserSetting;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "dataType":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "dataType":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (UserSetting.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UserSetting.includeField("dataType", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "dataType";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Data Type";
			if (this.dataType !== null) {
				fieldData["value"] = this.dataType;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UserSetting.options.fieldOrder !== undefined && UserSetting.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, UserSetting.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

UserSetting.list = [];
UserSetting.options = [];

class UserSettingTag extends DatabaseObject {
	constructor(jsonObj) {
		if (UserSettingTag.exists(jsonObj)) {
			return UserSettingTag.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.user = null; // Int
		this.userSetting = null; // Int
		this.data = null; // String
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			UserSettingTag.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.user != null) {
				this.user = User.exists(jsonObj.user) ?
					User.get(jsonObj.user) : new User(jsonObj.user);
				if ( ! this.user.userSettingTags.includes(this)) {
					this.user.userSettingTags.push(this);
					User.orderBy(this.user.userSettingTags);
				}
			}
			if (jsonObj.userSetting != null) {
				this.userSetting = UserSetting.exists(jsonObj.userSetting) ?
					UserSetting.get(jsonObj.userSetting) : new UserSetting(jsonObj.userSetting);
				if ( ! this.userSetting.userSettingTags.includes(this)) {
					this.userSetting.userSettingTags.push(this);
					UserSetting.orderBy(this.userSetting.userSettingTags);
				}
			}
			this.data = jsonObj.data;
			
			// Links
			
			UserSettingTag.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "User Setting Tag";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "user", "userSetting"];
	}

	static getAllFields() {
		return ["id", "user", "userSetting", "data"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "userID", "userSettingID", "data"].includes(columnName)) {
			return UserSettingTag;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "userID":
				return "User";
			case "userSettingID":
				return "UserSetting";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "user":
				return null;
			case "userSetting":
				return null;
			case "data":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "user":
				return ""; // TODO
			case "userSetting":
				return ""; // TODO
			case "data":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (UserSettingTag.includeField("user", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "user";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = User.selectOptions(this.user, this.selectFilters("user", filterObjects));
			fieldData["optionClass"] = "User";
			fieldData["propertyForeignClass"] = User;
			fieldData["label"] = "User";
			if (this.user !== undefined && this.user !== null) {
				fieldData["value"] = this.user.toDisplayString();
				fieldData["databaseObj"] = this.user;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UserSettingTag.includeField("userSetting", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "userSetting";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = UserSetting.selectOptions(this.userSetting, this.selectFilters("userSetting", filterObjects));
			fieldData["optionClass"] = "UserSetting";
			fieldData["propertyForeignClass"] = UserSetting;
			fieldData["label"] = "User Setting";
			if (this.userSetting !== undefined && this.userSetting !== null) {
				fieldData["value"] = this.userSetting.toDisplayString();
				fieldData["databaseObj"] = this.userSetting;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UserSettingTag.includeField("data", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "data";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Data";
			if (this.data !== null) {
				fieldData["value"] = this.data;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (UserSettingTag.options.fieldOrder !== undefined && UserSettingTag.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, UserSettingTag.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "user":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.user = jsonObj;
				} else if (User.exists(jsonObj)) {
					this.user = User.get(jsonObj);
				} else {
					this.user = new User(jsonObj);
				}
				break;
			case "userSetting":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.userSetting = jsonObj;
				} else if (UserSetting.exists(jsonObj)) {
					this.userSetting = UserSetting.get(jsonObj);
				} else {
					this.userSetting = new UserSetting(jsonObj);
				}
				break;
		}
	}

}

UserSettingTag.list = [];
UserSettingTag.options = [];

class UserSettingOption extends DatabaseObject {
	constructor(jsonObj) {
		if (UserSettingOption.exists(jsonObj)) {
			return UserSettingOption.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.userSetting = null; // Int
		this.name = null; // String
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			UserSettingOption.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.userSetting != null) {
				this.userSetting = UserSetting.exists(jsonObj.userSetting) ?
					UserSetting.get(jsonObj.userSetting) : new UserSetting(jsonObj.userSetting);
				if ( ! this.userSetting.userSettingOptions.includes(this)) {
					this.userSetting.userSettingOptions.push(this);
					UserSetting.orderBy(this.userSetting.userSettingOptions);
				}
			}
			this.name = jsonObj.name;
			
			// Links
			
			UserSettingOption.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "User Setting Option";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "userSetting", "name"];
	}

	static getAllFields() {
		return ["id", "userSetting", "name"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "userSettingID", "name"].includes(columnName)) {
			return UserSettingOption;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "userSettingID":
				return "UserSetting";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "userSetting":
				return null;
			case "name":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "userSetting":
				return ""; // TODO
			case "name":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (UserSettingOption.includeField("userSetting", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "userSetting";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = UserSetting.selectOptions(this.userSetting, this.selectFilters("userSetting", filterObjects));
			fieldData["optionClass"] = "UserSetting";
			fieldData["propertyForeignClass"] = UserSetting;
			fieldData["label"] = "User Setting";
			if (this.userSetting !== undefined && this.userSetting !== null) {
				fieldData["value"] = this.userSetting.toDisplayString();
				fieldData["databaseObj"] = this.userSetting;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UserSettingOption.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UserSettingOption.options.fieldOrder !== undefined && UserSettingOption.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, UserSettingOption.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "userSetting":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.userSetting = jsonObj;
				} else if (UserSetting.exists(jsonObj)) {
					this.userSetting = UserSetting.get(jsonObj);
				} else {
					this.userSetting = new UserSetting(jsonObj);
				}
				break;
		}
	}

}

UserSettingOption.list = [];
UserSettingOption.options = [];

class FigureNickname extends DatabaseObject {
	constructor(jsonObj) {
		if (FigureNickname.exists(jsonObj)) {
			return FigureNickname.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.nickname = null; // String
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			FigureNickname.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.nickname = jsonObj.nickname;
			
			// Links
			
			FigureNickname.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Figure Nickname";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "nickname"];
	}

	static getAllFields() {
		return ["id", "name", "nickname"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "nickname"].includes(columnName)) {
			return FigureNickname;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "nickname":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "nickname":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (FigureNickname.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureNickname.includeField("nickname", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "nickname";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Nickname";
			if (this.nickname !== null) {
				fieldData["value"] = this.nickname;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureNickname.options.fieldOrder !== undefined && FigureNickname.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, FigureNickname.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

FigureNickname.list = [];
FigureNickname.options = [];

class Term extends DatabaseObject {
	constructor(jsonObj) {
		if (Term.exists(jsonObj)) {
			return Term.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.definition = null; // String
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Term.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.definition = jsonObj.definition;
			
			// Links
			
			Term.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Term";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name"];
	}

	static getAllFields() {
		return ["id", "name", "definition"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "definition"].includes(columnName)) {
			return Term;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "definition":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "definition":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Term.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Term.includeField("definition", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "definition";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Definition";
			if (this.definition !== null) {
				fieldData["value"] = this.definition;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Term.options.fieldOrder !== undefined && Term.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Term.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

Term.list = [];
Term.options = [];

class TerrainType extends DatabaseObject {
	constructor(jsonObj) {
		if (TerrainType.exists(jsonObj)) {
			return TerrainType.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.height = null; // Int
		this.color = null; // String
		this.rules = null; // String
		
		// Links
		this.links = [{terrainPieces: TerrainPiece, label: "Terrain Pieces", nTo1Link: true, linkField: 'terrainType'}];
		this.terrainPieces = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			TerrainType.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.height = jsonObj.height;
			this.color = jsonObj.color;
			this.rules = jsonObj.rules;
			
			// Links
			if (jsonObj.terrainPieces != undefined && jsonObj.terrainPieces != null) {
				for (var i = 0; i < jsonObj.terrainPieces.length; i++) {
					if (TerrainPiece.exists(jsonObj.terrainPieces[i])){
						const newLinkObj = TerrainPiece.get(jsonObj.terrainPieces[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.terrainPieces.length; j++) {
							if (this.terrainPieces[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.terrainPieces.push(newLinkObj);
						}
					} else {
						const newForeignObj = new TerrainPiece(jsonObj.terrainPieces[i]);
						if ( ! this.terrainPieces.includes(newForeignObj)) {
							this.terrainPieces.push(newForeignObj);
						}
						newForeignObj.terrainType = this;
					}
				}
			}
			TerrainPiece.orderBy(this.terrainPieces);
			
			TerrainType.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Terrain Type";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "height", "color"];
	}

	static getAllFields() {
		return ["id", "name", "height", "color", "rules"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "height", "color", "rules"].includes(columnName)) {
			return TerrainType;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "height":
				return null;
			case "color":
				return null;
			case "rules":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "height":
				return ""; // TODO
			case "color":
				return ""; // TODO
			case "rules":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (TerrainType.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TerrainType.includeField("height", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "height";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Height";
			if (this.height !== null) {
				fieldData["value"] = this.height;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TerrainType.includeField("color", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "color";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Color";
			if (this.color !== null) {
				fieldData["value"] = this.color;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TerrainType.includeField("rules", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "rules";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Rules";
			if (this.rules !== null) {
				fieldData["value"] = this.rules;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (TerrainType.options.fieldOrder !== undefined && TerrainType.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, TerrainType.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

TerrainType.list = [];
TerrainType.options = [];

class TerrainSize extends DatabaseObject {
	constructor(jsonObj) {
		if (TerrainSize.exists(jsonObj)) {
			return TerrainSize.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.size = null; // Int
		
		// Links
		this.links = [{terrainPieces: TerrainPiece, label: "Terrain Pieces", nTo1Link: true, linkField: 'terrainSize'}];
		this.terrainPieces = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			TerrainSize.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.size = jsonObj.size;
			
			// Links
			if (jsonObj.terrainPieces != undefined && jsonObj.terrainPieces != null) {
				for (var i = 0; i < jsonObj.terrainPieces.length; i++) {
					if (TerrainPiece.exists(jsonObj.terrainPieces[i])){
						const newLinkObj = TerrainPiece.get(jsonObj.terrainPieces[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.terrainPieces.length; j++) {
							if (this.terrainPieces[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.terrainPieces.push(newLinkObj);
						}
					} else {
						const newForeignObj = new TerrainPiece(jsonObj.terrainPieces[i]);
						if ( ! this.terrainPieces.includes(newForeignObj)) {
							this.terrainPieces.push(newForeignObj);
						}
						newForeignObj.terrainSize = this;
					}
				}
			}
			TerrainPiece.orderBy(this.terrainPieces);
			
			TerrainSize.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Terrain Size";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "size"];
	}

	static getAllFields() {
		return ["id", "size"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "size"].includes(columnName)) {
			return TerrainSize;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "size":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "size":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (TerrainSize.includeField("size", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "size";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
				fieldData["label"] = "Size";
			fieldData["label"] = "Size";
			if (this.size !== null) {
				fieldData["value"] = this.size;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TerrainSize.options.fieldOrder !== undefined && TerrainSize.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, TerrainSize.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

TerrainSize.list = [];
TerrainSize.options = [];

class TerrainPiece extends DatabaseObject {
	// @DoNotUpdate
	constructor(jsonObj) {
		if (TerrainPiece.exists(jsonObj)) {
			return TerrainPiece.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.terrainType = null; // Int
		this.terrainSize = null; // Int
		this.image = null; // String
		
		// Links
		this.links = [{heroscapeSetTerrainPieceQuantitys: HeroscapeSetTerrainPieceQuantity, label: "Heroscape Set Terrain Piece Quantitys", nTo1Link: true, linkField: 'terrainPiece'}, {heroscapeMapTerrainPieceQuantitys: HeroscapeMapTerrainPieceQuantity, label: "Heroscape Map Terrain Piece Quantitys", nTo1Link: true, linkField: 'terrainPIece'}, {onlineMapTerrainPieces: OnlineMapTerrainPiece, label: "Online Map Terrain Pieces", nTo1Link: true, linkField: 'terrainPiece'}];
		this.heroscapeSetTerrainPieceQuantitys = [];
		this.heroscapeMapTerrainPieceQuantitys = [];
		this.onlineMapTerrainPieces = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			TerrainPiece.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.terrainType != null) {
				this.terrainType = TerrainType.exists(jsonObj.terrainType) ?
					TerrainType.get(jsonObj.terrainType) : new TerrainType(jsonObj.terrainType);
				if ( ! this.terrainType.terrainPieces.includes(this)) {
					this.terrainType.terrainPieces.push(this);
					TerrainType.orderBy(this.terrainType.terrainPieces);
				}
			}
			if (jsonObj.terrainSize != null) {
				this.terrainSize = TerrainSize.exists(jsonObj.terrainSize) ?
					TerrainSize.get(jsonObj.terrainSize) : new TerrainSize(jsonObj.terrainSize);
				if ( ! this.terrainSize.terrainPieces.includes(this)) {
					this.terrainSize.terrainPieces.push(this);
					TerrainSize.orderBy(this.terrainSize.terrainPieces);
				}
			}
			this.image = jsonObj.image;
			var tp = this;
			tp.imageData = null;
			if (this.image != null) {
				(async function() {
					let blob = await fetch(tp.image).then(r => r.blob());
					let dataUrl = await new Promise(resolve => {
						let reader = new FileReader();
						reader.onload = () => resolve(reader.result);
							reader.readAsDataURL(blob);
					});
					tp.imageData = dataUrl;
				})();
			}
			
			// Links
			if (jsonObj.heroscapeSetTerrainPieceQuantitys != undefined && jsonObj.heroscapeSetTerrainPieceQuantitys != null) {
				for (var i = 0; i < jsonObj.heroscapeSetTerrainPieceQuantitys.length; i++) {
					if (HeroscapeSetTerrainPieceQuantity.exists(jsonObj.heroscapeSetTerrainPieceQuantitys[i])){
						const newLinkObj = HeroscapeSetTerrainPieceQuantity.get(jsonObj.heroscapeSetTerrainPieceQuantitys[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.heroscapeSetTerrainPieceQuantitys.length; j++) {
							if (this.heroscapeSetTerrainPieceQuantitys[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.heroscapeSetTerrainPieceQuantitys.push(newLinkObj);
						}
					} else {
						const newForeignObj = new HeroscapeSetTerrainPieceQuantity(jsonObj.heroscapeSetTerrainPieceQuantitys[i]);
						if ( ! this.heroscapeSetTerrainPieceQuantitys.includes(newForeignObj)) {
							this.heroscapeSetTerrainPieceQuantitys.push(newForeignObj);
						}
						newForeignObj.terrainPiece = this;
					}
				}
			}
			HeroscapeSetTerrainPieceQuantity.orderBy(this.heroscapeSetTerrainPieceQuantitys);
			if (jsonObj.heroscapeMapTerrainPieceQuantitys != undefined && jsonObj.heroscapeMapTerrainPieceQuantitys != null) {
				for (var i = 0; i < jsonObj.heroscapeMapTerrainPieceQuantitys.length; i++) {
					if (HeroscapeMapTerrainPieceQuantity.exists(jsonObj.heroscapeMapTerrainPieceQuantitys[i])){
						const newLinkObj = HeroscapeMapTerrainPieceQuantity.get(jsonObj.heroscapeMapTerrainPieceQuantitys[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.heroscapeMapTerrainPieceQuantitys.length; j++) {
							if (this.heroscapeMapTerrainPieceQuantitys[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.heroscapeMapTerrainPieceQuantitys.push(newLinkObj);
						}
					} else {
						const newForeignObj = new HeroscapeMapTerrainPieceQuantity(jsonObj.heroscapeMapTerrainPieceQuantitys[i]);
						if ( ! this.heroscapeMapTerrainPieceQuantitys.includes(newForeignObj)) {
							this.heroscapeMapTerrainPieceQuantitys.push(newForeignObj);
						}
						newForeignObj.terrainPIece = this;
					}
				}
			}
			HeroscapeMapTerrainPieceQuantity.orderBy(this.heroscapeMapTerrainPieceQuantitys);
			if (jsonObj.onlineMapTerrainPieces != undefined && jsonObj.onlineMapTerrainPieces != null) {
				for (var i = 0; i < jsonObj.onlineMapTerrainPieces.length; i++) {
					if (OnlineMapTerrainPiece.exists(jsonObj.onlineMapTerrainPieces[i])){
						const newLinkObj = OnlineMapTerrainPiece.get(jsonObj.onlineMapTerrainPieces[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.onlineMapTerrainPieces.length; j++) {
							if (this.onlineMapTerrainPieces[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.onlineMapTerrainPieces.push(newLinkObj);
						}
					} else {
						const newForeignObj = new OnlineMapTerrainPiece(jsonObj.onlineMapTerrainPieces[i]);
						if ( ! this.onlineMapTerrainPieces.includes(newForeignObj)) {
							this.onlineMapTerrainPieces.push(newForeignObj);
						}
						newForeignObj.terrainPiece = this;
					}
				}
			}
			OnlineMapTerrainPiece.orderBy(this.onlineMapTerrainPieces);
			
			TerrainPiece.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Terrain Piece";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "terrainType", "terrainSize"];
	}

	static getAllFields() {
		return ["id", "terrainType", "terrainSize", "image"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "terrainTypeID", "terrainSizeID", "image"].includes(columnName)) {
			return TerrainPiece;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "terrainTypeID":
				return "TerrainType";
			case "terrainSizeID":
				return "TerrainSize";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "terrainType":
				return null;
			case "terrainSize":
				return null;
			case "image":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "terrainType":
				return ""; // TODO
			case "terrainSize":
				return ""; // TODO
			case "image":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (TerrainPiece.includeField("terrainType", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "terrainType";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = TerrainType.selectOptions(this.terrainType, this.selectFilters("terrainType", filterObjects));
			fieldData["optionClass"] = "TerrainType";
			fieldData["propertyForeignClass"] = TerrainType;
			fieldData["label"] = "Terrain Type";
			if (this.terrainType !== undefined && this.terrainType !== null) {
				fieldData["value"] = this.terrainType.toDisplayString();
				fieldData["databaseObj"] = this.terrainType;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TerrainPiece.includeField("terrainSize", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "terrainSize";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = TerrainSize.selectOptions(this.terrainSize, this.selectFilters("terrainSize", filterObjects));
			fieldData["optionClass"] = "TerrainSize";
			fieldData["propertyForeignClass"] = TerrainSize;
			fieldData["label"] = "Terrain Size";
			if (this.terrainSize !== undefined && this.terrainSize !== null) {
				fieldData["value"] = this.terrainSize.toDisplayString();
				fieldData["databaseObj"] = this.terrainSize;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TerrainPiece.includeField("image", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "image";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Image";
			if (this.image !== null) {
				fieldData["value"] = this.image;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (TerrainPiece.options.fieldOrder !== undefined && TerrainPiece.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, TerrainPiece.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "terrainType":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.terrainType = jsonObj;
				} else if (TerrainType.exists(jsonObj)) {
					this.terrainType = TerrainType.get(jsonObj);
				} else {
					this.terrainType = new TerrainType(jsonObj);
				}
				break;
			case "terrainSize":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.terrainSize = jsonObj;
				} else if (TerrainSize.exists(jsonObj)) {
					this.terrainSize = TerrainSize.get(jsonObj);
				} else {
					this.terrainSize = new TerrainSize(jsonObj);
				}
				break;
		}
	}

}

TerrainPiece.list = [];
TerrainPiece.options = [];

class HeroscapeSetTerrainPieceQuantity extends DatabaseObject {
	constructor(jsonObj) {
		if (HeroscapeSetTerrainPieceQuantity.exists(jsonObj)) {
			return HeroscapeSetTerrainPieceQuantity.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.heroscapeSet = null; // Int
		this.terrainPiece = null; // Int
		this.quantity = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			HeroscapeSetTerrainPieceQuantity.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.heroscapeSet != null) {
				this.heroscapeSet = HeroscapeSet.exists(jsonObj.heroscapeSet) ?
					HeroscapeSet.get(jsonObj.heroscapeSet) : new HeroscapeSet(jsonObj.heroscapeSet);
				if ( ! this.heroscapeSet.heroscapeSetTerrainPieceQuantitys.includes(this)) {
					this.heroscapeSet.heroscapeSetTerrainPieceQuantitys.push(this);
					HeroscapeSet.orderBy(this.heroscapeSet.heroscapeSetTerrainPieceQuantitys);
				}
			}
			if (jsonObj.terrainPiece != null) {
				this.terrainPiece = TerrainPiece.exists(jsonObj.terrainPiece) ?
					TerrainPiece.get(jsonObj.terrainPiece) : new TerrainPiece(jsonObj.terrainPiece);
				if ( ! this.terrainPiece.heroscapeSetTerrainPieceQuantitys.includes(this)) {
					this.terrainPiece.heroscapeSetTerrainPieceQuantitys.push(this);
					TerrainPiece.orderBy(this.terrainPiece.heroscapeSetTerrainPieceQuantitys);
				}
			}
			this.quantity = jsonObj.quantity;
			
			// Links
			
			HeroscapeSetTerrainPieceQuantity.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Heroscape Set Terrain Piece Quantity";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "heroscapeSet", "terrainPiece", "quantity"];
	}

	static getAllFields() {
		return ["id", "heroscapeSet", "terrainPiece", "quantity"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "heroscapeSetID", "terrainPieceID", "quantity"].includes(columnName)) {
			return HeroscapeSetTerrainPieceQuantity;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "heroscapeSetID":
				return "HeroscapeSet";
			case "terrainPieceID":
				return "TerrainPiece";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "heroscapeSet":
				return null;
			case "terrainPiece":
				return null;
			case "quantity":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "heroscapeSet":
				return ""; // TODO
			case "terrainPiece":
				return ""; // TODO
			case "quantity":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (HeroscapeSetTerrainPieceQuantity.includeField("heroscapeSet", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "heroscapeSet";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = HeroscapeSet.selectOptions(this.heroscapeSet, this.selectFilters("heroscapeSet", filterObjects));
			fieldData["optionClass"] = "HeroscapeSet";
			fieldData["propertyForeignClass"] = HeroscapeSet;
			fieldData["label"] = "Heroscape Set";
			if (this.heroscapeSet !== undefined && this.heroscapeSet !== null) {
				fieldData["value"] = this.heroscapeSet.toDisplayString();
				fieldData["databaseObj"] = this.heroscapeSet;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeSetTerrainPieceQuantity.includeField("terrainPiece", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "terrainPiece";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = TerrainPiece.selectOptions(this.terrainPiece, this.selectFilters("terrainPiece", filterObjects));
			fieldData["optionClass"] = "TerrainPiece";
			fieldData["propertyForeignClass"] = TerrainPiece;
			fieldData["label"] = "Terrain Piece";
			if (this.terrainPiece !== undefined && this.terrainPiece !== null) {
				fieldData["value"] = this.terrainPiece.toDisplayString();
				fieldData["databaseObj"] = this.terrainPiece;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeSetTerrainPieceQuantity.includeField("quantity", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "quantity";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Quantity";
			if (this.quantity !== null) {
				fieldData["value"] = this.quantity;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeSetTerrainPieceQuantity.options.fieldOrder !== undefined && HeroscapeSetTerrainPieceQuantity.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, HeroscapeSetTerrainPieceQuantity.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "heroscapeSet":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.heroscapeSet = jsonObj;
				} else if (HeroscapeSet.exists(jsonObj)) {
					this.heroscapeSet = HeroscapeSet.get(jsonObj);
				} else {
					this.heroscapeSet = new HeroscapeSet(jsonObj);
				}
				break;
			case "terrainPiece":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.terrainPiece = jsonObj;
				} else if (TerrainPiece.exists(jsonObj)) {
					this.terrainPiece = TerrainPiece.get(jsonObj);
				} else {
					this.terrainPiece = new TerrainPiece(jsonObj);
				}
				break;
		}
	}

}

HeroscapeSetTerrainPieceQuantity.list = [];
HeroscapeSetTerrainPieceQuantity.options = [];

class HeroscapeMapTerrainPieceQuantity extends DatabaseObject {
	constructor(jsonObj) {
		if (HeroscapeMapTerrainPieceQuantity.exists(jsonObj)) {
			return HeroscapeMapTerrainPieceQuantity.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.heroscapeMap = null; // Int
		this.terrainPIece = null; // Int
		this.quantity = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			HeroscapeMapTerrainPieceQuantity.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.heroscapeMap != null) {
				this.heroscapeMap = HeroscapeMap.exists(jsonObj.heroscapeMap) ?
					HeroscapeMap.get(jsonObj.heroscapeMap) : new HeroscapeMap(jsonObj.heroscapeMap);
				if ( ! this.heroscapeMap.heroscapeMapTerrainPieceQuantitys.includes(this)) {
					this.heroscapeMap.heroscapeMapTerrainPieceQuantitys.push(this);
					HeroscapeMap.orderBy(this.heroscapeMap.heroscapeMapTerrainPieceQuantitys);
				}
			}
			if (jsonObj.terrainPIece != null) {
				this.terrainPIece = TerrainPiece.exists(jsonObj.terrainPIece) ?
					TerrainPiece.get(jsonObj.terrainPIece) : new TerrainPiece(jsonObj.terrainPIece);
				if ( ! this.terrainPIece.heroscapeMapTerrainPieceQuantitys.includes(this)) {
					this.terrainPIece.heroscapeMapTerrainPieceQuantitys.push(this);
					TerrainPiece.orderBy(this.terrainPIece.heroscapeMapTerrainPieceQuantitys);
				}
			}
			this.quantity = jsonObj.quantity;
			
			// Links
			
			HeroscapeMapTerrainPieceQuantity.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Heroscape Map Terrain Piece Quantity";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "heroscapeMap", "terrainPIece", "quantity"];
	}

	static getAllFields() {
		return ["id", "heroscapeMap", "terrainPIece", "quantity"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "heroscapeMapID", "terrainPIeceID", "quantity"].includes(columnName)) {
			return HeroscapeMapTerrainPieceQuantity;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "heroscapeMapID":
				return "HeroscapeMap";
			case "terrainPIeceID":
				return "TerrainPiece";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "heroscapeMap":
				return null;
			case "terrainPIece":
				return null;
			case "quantity":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "heroscapeMap":
				return ""; // TODO
			case "terrainPIece":
				return ""; // TODO
			case "quantity":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (HeroscapeMapTerrainPieceQuantity.includeField("heroscapeMap", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "heroscapeMap";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = HeroscapeMap.selectOptions(this.heroscapeMap, this.selectFilters("heroscapeMap", filterObjects));
			fieldData["optionClass"] = "HeroscapeMap";
			fieldData["propertyForeignClass"] = HeroscapeMap;
			fieldData["label"] = "Heroscape Map";
			if (this.heroscapeMap !== undefined && this.heroscapeMap !== null) {
				fieldData["value"] = this.heroscapeMap.toDisplayString();
				fieldData["databaseObj"] = this.heroscapeMap;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMapTerrainPieceQuantity.includeField("terrainPIece", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "terrainPIece";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = TerrainPiece.selectOptions(this.terrainPIece, this.selectFilters("terrainPIece", filterObjects));
			fieldData["optionClass"] = "TerrainPiece";
			fieldData["propertyForeignClass"] = TerrainPiece;
			fieldData["label"] = "Terrain PIece";
			if (this.terrainPIece !== undefined && this.terrainPIece !== null) {
				fieldData["value"] = this.terrainPIece.toDisplayString();
				fieldData["databaseObj"] = this.terrainPIece;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMapTerrainPieceQuantity.includeField("quantity", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "quantity";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Quantity";
			if (this.quantity !== null) {
				fieldData["value"] = this.quantity;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeMapTerrainPieceQuantity.options.fieldOrder !== undefined && HeroscapeMapTerrainPieceQuantity.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, HeroscapeMapTerrainPieceQuantity.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "heroscapeMap":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.heroscapeMap = jsonObj;
				} else if (HeroscapeMap.exists(jsonObj)) {
					this.heroscapeMap = HeroscapeMap.get(jsonObj);
				} else {
					this.heroscapeMap = new HeroscapeMap(jsonObj);
				}
				break;
			case "terrainPIece":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.terrainPIece = jsonObj;
				} else if (TerrainPiece.exists(jsonObj)) {
					this.terrainPIece = TerrainPiece.get(jsonObj);
				} else {
					this.terrainPIece = new TerrainPiece(jsonObj);
				}
				break;
		}
	}

}

HeroscapeMapTerrainPieceQuantity.list = [];
HeroscapeMapTerrainPieceQuantity.options = [];

class OnlineMap extends DatabaseObject {
	constructor(jsonObj) {
		if (OnlineMap.exists(jsonObj)) {
			return OnlineMap.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.authorID = null; // Int
		
		// Links
		this.links = [{onlineMapTerrainPieces: OnlineMapTerrainPiece, label: "Online Map Terrain Pieces", nTo1Link: true, linkField: 'onlineMap'}];
		this.onlineMapTerrainPieces = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			OnlineMap.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.authorID = jsonObj.authorID;
			
			// Links
			if (jsonObj.onlineMapTerrainPieces != undefined && jsonObj.onlineMapTerrainPieces != null) {
				for (var i = 0; i < jsonObj.onlineMapTerrainPieces.length; i++) {
					if (OnlineMapTerrainPiece.exists(jsonObj.onlineMapTerrainPieces[i])){
						const newLinkObj = OnlineMapTerrainPiece.get(jsonObj.onlineMapTerrainPieces[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.onlineMapTerrainPieces.length; j++) {
							if (this.onlineMapTerrainPieces[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.onlineMapTerrainPieces.push(newLinkObj);
						}
					} else {
						const newForeignObj = new OnlineMapTerrainPiece(jsonObj.onlineMapTerrainPieces[i]);
						if ( ! this.onlineMapTerrainPieces.includes(newForeignObj)) {
							this.onlineMapTerrainPieces.push(newForeignObj);
						}
						newForeignObj.onlineMap = this;
					}
				}
			}
			OnlineMapTerrainPiece.orderBy(this.onlineMapTerrainPieces);
			
			OnlineMap.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Online Map";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "authorID"];
	}

	static getAllFields() {
		return ["id", "name", "authorID"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "authorID"].includes(columnName)) {
			return OnlineMap;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "author":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "author":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (OnlineMap.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (OnlineMap.includeField("author", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "author";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Author ID";
			if (this.author !== null) {
				fieldData["value"] = this.author;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (OnlineMap.options.fieldOrder !== undefined && OnlineMap.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, OnlineMap.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

OnlineMap.list = [];
OnlineMap.options = [];

class OnlineMapTerrainPiece extends DatabaseObject {
	constructor(jsonObj) {
		if (OnlineMapTerrainPiece.exists(jsonObj)) {
			return OnlineMapTerrainPiece.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.onlineMap = null; // Int
		this.terrainPiece = null; // Int
		this.level = null; // Int
		this.column = null; // Int
		this.row = null; // Int
		this.direction = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			OnlineMapTerrainPiece.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.onlineMap != null) {
				this.onlineMap = OnlineMap.exists(jsonObj.onlineMap) ?
					OnlineMap.get(jsonObj.onlineMap) : new OnlineMap(jsonObj.onlineMap);
				if ( ! this.onlineMap.onlineMapTerrainPieces.includes(this)) {
					this.onlineMap.onlineMapTerrainPieces.push(this);
					OnlineMap.orderBy(this.onlineMap.onlineMapTerrainPieces);
				}
			}
			if (jsonObj.terrainPiece != null) {
				this.terrainPiece = TerrainPiece.exists(jsonObj.terrainPiece) ?
					TerrainPiece.get(jsonObj.terrainPiece) : new TerrainPiece(jsonObj.terrainPiece);
				if ( ! this.terrainPiece.onlineMapTerrainPieces.includes(this)) {
					this.terrainPiece.onlineMapTerrainPieces.push(this);
					TerrainPiece.orderBy(this.terrainPiece.onlineMapTerrainPieces);
				}
			}
			this.level = jsonObj.level;
			this.column = jsonObj.column;
			this.row = jsonObj.row;
			this.direction = jsonObj.direction;
			
			// Links
			
			OnlineMapTerrainPiece.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Online Map Terrain Piece";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "onlineMap", "terrainPiece", "level", "column", "row", "direction"];
	}

	static getAllFields() {
		return ["id", "onlineMap", "terrainPiece", "level", "column", "row", "direction"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "onlineMapID", "terrainPieceID", "level", "column", "row", "direction"].includes(columnName)) {
			return OnlineMapTerrainPiece;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "onlineMapID":
				return "OnlineMap";
			case "terrainPieceID":
				return "TerrainPiece";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "onlineMap":
				return null;
			case "terrainPiece":
				return null;
			case "level":
				return null;
			case "column":
				return null;
			case "row":
				return null;
			case "direction":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "onlineMap":
				return ""; // TODO
			case "terrainPiece":
				return ""; // TODO
			case "level":
				return ""; // TODO
			case "column":
				return ""; // TODO
			case "row":
				return ""; // TODO
			case "direction":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (OnlineMapTerrainPiece.includeField("onlineMap", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "onlineMap";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = OnlineMap.selectOptions(this.onlineMap, this.selectFilters("onlineMap", filterObjects));
			fieldData["optionClass"] = "OnlineMap";
			fieldData["propertyForeignClass"] = OnlineMap;
			fieldData["label"] = "Online Map";
			if (this.onlineMap !== undefined && this.onlineMap !== null) {
				fieldData["value"] = this.onlineMap.toDisplayString();
				fieldData["databaseObj"] = this.onlineMap;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (OnlineMapTerrainPiece.includeField("terrainPiece", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "terrainPiece";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = TerrainPiece.selectOptions(this.terrainPiece, this.selectFilters("terrainPiece", filterObjects));
			fieldData["optionClass"] = "TerrainPiece";
			fieldData["propertyForeignClass"] = TerrainPiece;
			fieldData["label"] = "Terrain Piece";
			if (this.terrainPiece !== undefined && this.terrainPiece !== null) {
				fieldData["value"] = this.terrainPiece.toDisplayString();
				fieldData["databaseObj"] = this.terrainPiece;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (OnlineMapTerrainPiece.includeField("level", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "level";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Level";
			if (this.level !== null) {
				fieldData["value"] = this.level;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (OnlineMapTerrainPiece.includeField("column", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "column";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Column";
			if (this.column !== null) {
				fieldData["value"] = this.column;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (OnlineMapTerrainPiece.includeField("row", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "row";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Row";
			if (this.row !== null) {
				fieldData["value"] = this.row;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (OnlineMapTerrainPiece.includeField("direction", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "direction";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Direction";
			if (this.direction !== null) {
				fieldData["value"] = this.direction;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (OnlineMapTerrainPiece.options.fieldOrder !== undefined && OnlineMapTerrainPiece.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, OnlineMapTerrainPiece.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "onlineMap":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.onlineMap = jsonObj;
				} else if (OnlineMap.exists(jsonObj)) {
					this.onlineMap = OnlineMap.get(jsonObj);
				} else {
					this.onlineMap = new OnlineMap(jsonObj);
				}
				break;
			case "terrainPiece":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.terrainPiece = jsonObj;
				} else if (TerrainPiece.exists(jsonObj)) {
					this.terrainPiece = TerrainPiece.get(jsonObj);
				} else {
					this.terrainPiece = new TerrainPiece(jsonObj);
				}
				break;
		}
	}

}

OnlineMapTerrainPiece.list = [];
OnlineMapTerrainPiece.options = [];

class MapTournamentUseView extends DatabaseObject {
	constructor(jsonObj) {
		if (MapTournamentUseView.exists(jsonObj)) {
			return MapTournamentUseView.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.Tournament_id = null; // Int
		this.Tournament_name = null; // String
		this.Tournament_conventionID = null; // Int
		this.HeroscapeTournament_tournamentID = null; // Int
		this.GameMap_id = null; // Int
		this.GameMap_name = null; // String
		this.GameMap_tournamentID = null; // Int
		this.Game_id = null; // Int
		this.HeroscapeGame_gameID = null; // Int
		this.HeroscapeGame_mapID = null; // Int
		this.Convention_id = null; // Int
		this.Convention_name = null; // String
		this.Season_id = null; // Int
		this.Season_name = null; // String
		this.Season_leagueID = null; // Int
		this.League_id = null; // Int
		this.League_name = null; // String
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			MapTournamentUseView.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.Tournament_id = jsonObj.Tournament_id;
			this.Tournament_name = jsonObj.Tournament_name;
			this.Tournament_conventionID = jsonObj.Tournament_conventionID;
			this.HeroscapeTournament_tournamentID = jsonObj.HeroscapeTournament_tournamentID;
			this.GameMap_id = jsonObj.GameMap_id;
			this.GameMap_name = jsonObj.GameMap_name;
			this.GameMap_tournamentID = jsonObj.GameMap_tournamentID;
			this.Game_id = jsonObj.Game_id;
			this.HeroscapeGame_gameID = jsonObj.HeroscapeGame_gameID;
			this.HeroscapeGame_mapID = jsonObj.HeroscapeGame_mapID;
			this.Convention_id = jsonObj.Convention_id;
			this.Convention_name = jsonObj.Convention_name;
			this.Season_id = jsonObj.Season_id;
			this.Season_name = jsonObj.Season_name;
			this.Season_leagueID = jsonObj.Season_leagueID;
			this.League_id = jsonObj.League_id;
			this.League_name = jsonObj.League_name;
			
			// Links
			
			MapTournamentUseView.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Map Tournament Use View";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "Tournament_id", "Tournament_name", "Tournament_conventionID", "HeroscapeTournament_tournamentID", "GameMap_id", "GameMap_name", "GameMap_tournamentID", "Game_id", "HeroscapeGame_gameID", "HeroscapeGame_mapID", "Convention_id", "Convention_name", "Season_id", "Season_name", "Season_leagueID", "League_id", "League_name"];
	}

	static getAllFields() {
		return ["id", "Tournament_id", "Tournament_name", "Tournament_conventionID", "HeroscapeTournament_tournamentID", "GameMap_id", "GameMap_name", "GameMap_tournamentID", "Game_id", "HeroscapeGame_gameID", "HeroscapeGame_mapID", "Convention_id", "Convention_name", "Season_id", "Season_name", "Season_leagueID", "League_id", "League_name"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "Tournament_id", "Tournament_name", "Tournament_conventionID", "HeroscapeTournament_tournamentID", "GameMap_id", "GameMap_name", "GameMap_tournamentID", "Game_id", "HeroscapeGame_gameID", "HeroscapeGame_mapID", "Convention_id", "Convention_name", "Season_id", "Season_name", "Season_leagueID", "League_id", "League_name"].includes(columnName)) {
			return MapTournamentUseView;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "Tournament_id":
				return null;
			case "Tournament_name":
				return null;
			case "Tournament_convention":
				return null;
			case "HeroscapeTournament_tournament":
				return null;
			case "GameMap_id":
				return null;
			case "GameMap_name":
				return null;
			case "GameMap_tournament":
				return null;
			case "Game_id":
				return null;
			case "HeroscapeGame_game":
				return null;
			case "HeroscapeGame_map":
				return null;
			case "Convention_id":
				return null;
			case "Convention_name":
				return null;
			case "Season_id":
				return null;
			case "Season_name":
				return null;
			case "Season_league":
				return null;
			case "League_id":
				return null;
			case "League_name":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "Tournament_id":
				return ""; // TODO
			case "Tournament_name":
				return ""; // TODO
			case "Tournament_convention":
				return ""; // TODO
			case "HeroscapeTournament_tournament":
				return ""; // TODO
			case "GameMap_id":
				return ""; // TODO
			case "GameMap_name":
				return ""; // TODO
			case "GameMap_tournament":
				return ""; // TODO
			case "Game_id":
				return ""; // TODO
			case "HeroscapeGame_game":
				return ""; // TODO
			case "HeroscapeGame_map":
				return ""; // TODO
			case "Convention_id":
				return ""; // TODO
			case "Convention_name":
				return ""; // TODO
			case "Season_id":
				return ""; // TODO
			case "Season_name":
				return ""; // TODO
			case "Season_league":
				return ""; // TODO
			case "League_id":
				return ""; // TODO
			case "League_name":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (MapTournamentUseView.includeField("Tournament_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_id";
			if (this.Tournament_id !== null) {
				fieldData["value"] = this.Tournament_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("Tournament_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Tournament_name";
			if (this.Tournament_name !== null) {
				fieldData["value"] = this.Tournament_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("Tournament_convention", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Tournament_convention";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tournament_convention ID";
			if (this.Tournament_convention !== null) {
				fieldData["value"] = this.Tournament_convention;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("HeroscapeTournament_tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeTournament_tournament";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Tournament_tournament ID";
			if (this.HeroscapeTournament_tournament !== null) {
				fieldData["value"] = this.HeroscapeTournament_tournament;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("GameMap_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "GameMap_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Game Map_id";
			if (this.GameMap_id !== null) {
				fieldData["value"] = this.GameMap_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("GameMap_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "GameMap_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Game Map_name";
			if (this.GameMap_name !== null) {
				fieldData["value"] = this.GameMap_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("GameMap_tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "GameMap_tournament";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Game Map_tournament ID";
			if (this.GameMap_tournament !== null) {
				fieldData["value"] = this.GameMap_tournament;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("Game_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Game_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Game_id";
			if (this.Game_id !== null) {
				fieldData["value"] = this.Game_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("HeroscapeGame_game", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGame_game";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Game_game ID";
			if (this.HeroscapeGame_game !== null) {
				fieldData["value"] = this.HeroscapeGame_game;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("HeroscapeGame_map", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "HeroscapeGame_map";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Heroscape Game_map ID";
			if (this.HeroscapeGame_map !== null) {
				fieldData["value"] = this.HeroscapeGame_map;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("Convention_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Convention_id";
			if (this.Convention_id !== null) {
				fieldData["value"] = this.Convention_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("Convention_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Convention_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Convention_name";
			if (this.Convention_name !== null) {
				fieldData["value"] = this.Convention_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("Season_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Season_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Season_id";
			if (this.Season_id !== null) {
				fieldData["value"] = this.Season_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("Season_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Season_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Season_name";
			if (this.Season_name !== null) {
				fieldData["value"] = this.Season_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("Season_league", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "Season_league";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Season_league ID";
			if (this.Season_league !== null) {
				fieldData["value"] = this.Season_league;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("League_id", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "League_id";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "League_id";
			if (this.League_id !== null) {
				fieldData["value"] = this.League_id;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.includeField("League_name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "League_name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "League_name";
			if (this.League_name !== null) {
				fieldData["value"] = this.League_name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (MapTournamentUseView.options.fieldOrder !== undefined && MapTournamentUseView.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, MapTournamentUseView.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

MapTournamentUseView.list = [];
MapTournamentUseView.options = [];

class Card extends DatabaseObject {
	constructor(jsonObj) {
		if (Card.exists(jsonObj)) {
			return Card.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.figureSet = null; // Int
		this.figureSetSubGroup = null; // Int
		this.name = null; // String
		this.general = null; // Int
		this.homeworld = null; // Int
		this.species = null; // Int
		this.commonality = null; // String
		this.hero = null; // Boolean
		this.figureCount = null; // Int
		this.hexCount = null; // Int
		this.class = null; // Int
		this.personality = null; // Int
		this.size = null; // Int
		this.height = null; // Int
		this.life = null; // Int
		this.move = null; // Int
		this.range = null; // Int
		this.attack = null; // Int
		this.defense = null; // Int
		this.points = null; // Int
		this.pointsDeltaClassic = null; // Int
		this.pointsDeltaVc = null; // Int
		this.releaseSet = null; // Int
		this.imageLink = null; // String
		this.heroscapersBookLink = null; // String
		this.wikiLink = null; // String
		
		// Links
		this.links = [{cardPowers: CardPower, label: "Card Powers", nTo1Link: true, linkField: 'card'}, {deltaUpdateCosts: DeltaUpdateCost, label: "Delta Update Costs", nTo1Link: true, linkField: 'card'}, {cardPowerRankings: CardPowerRanking, label: "Card Power Rankings", nTo1Link: true, linkField: 'card'}, {playerArmyCards: PlayerArmyCard, label: "Player Army Cards", nTo1Link: true, linkField: 'card'}];
		this.cardPowers = [];
		this.deltaUpdateCosts = [];
		this.cardPowerRankings = [];
		this.playerArmyCards = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Card.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.figureSet != null) {
				this.figureSet = FigureSet.exists(jsonObj.figureSet) ?
					FigureSet.get(jsonObj.figureSet) : new FigureSet(jsonObj.figureSet);
				if ( ! this.figureSet.cards.includes(this)) {
					this.figureSet.cards.push(this);
					FigureSet.orderBy(this.figureSet.cards);
				}
			}
			if (jsonObj.figureSetSubGroup != null) {
				this.figureSetSubGroup = FigureSetSubGroup.exists(jsonObj.figureSetSubGroup) ?
					FigureSetSubGroup.get(jsonObj.figureSetSubGroup) : new FigureSetSubGroup(jsonObj.figureSetSubGroup);
				if ( ! this.figureSetSubGroup.cards.includes(this)) {
					this.figureSetSubGroup.cards.push(this);
					FigureSetSubGroup.orderBy(this.figureSetSubGroup.cards);
				}
			}
			this.name = jsonObj.name;
			if (jsonObj.general != null) {
				this.general = General.exists(jsonObj.general) ?
					General.get(jsonObj.general) : new General(jsonObj.general);
				if ( ! this.general.cards.includes(this)) {
					this.general.cards.push(this);
					General.orderBy(this.general.cards);
				}
			}
			if (jsonObj.homeworld != null) {
				this.homeworld = Homeworld.exists(jsonObj.homeworld) ?
					Homeworld.get(jsonObj.homeworld) : new Homeworld(jsonObj.homeworld);
				if ( ! this.homeworld.cards.includes(this)) {
					this.homeworld.cards.push(this);
					Homeworld.orderBy(this.homeworld.cards);
				}
			}
			if (jsonObj.species != null) {
				this.species = Species.exists(jsonObj.species) ?
					Species.get(jsonObj.species) : new Species(jsonObj.species);
				if ( ! this.species.cards.includes(this)) {
					this.species.cards.push(this);
					Species.orderBy(this.species.cards);
				}
			}
			this.commonality = jsonObj.commonality;
			this.hero = jsonObj.hero;
			this.figureCount = jsonObj.figureCount;
			this.hexCount = jsonObj.hexCount;
			if (jsonObj.class != null) {
				this.class = CardClass.exists(jsonObj.class) ?
					CardClass.get(jsonObj.class) : new CardClass(jsonObj.class);
				if ( ! this.class.cards.includes(this)) {
					this.class.cards.push(this);
					CardClass.orderBy(this.class.cards);
				}
			}
			if (jsonObj.personality != null) {
				this.personality = Personality.exists(jsonObj.personality) ?
					Personality.get(jsonObj.personality) : new Personality(jsonObj.personality);
				if ( ! this.personality.cards.includes(this)) {
					this.personality.cards.push(this);
					Personality.orderBy(this.personality.cards);
				}
			}
			if (jsonObj.size != null) {
				this.size = Size.exists(jsonObj.size) ?
					Size.get(jsonObj.size) : new Size(jsonObj.size);
				if ( ! this.size.cards.includes(this)) {
					this.size.cards.push(this);
					Size.orderBy(this.size.cards);
				}
			}
			this.height = jsonObj.height;
			this.life = jsonObj.life;
			this.move = jsonObj.move;
			this.range = jsonObj.range;
			this.attack = jsonObj.attack;
			this.defense = jsonObj.defense;
			this.points = jsonObj.points;
			this.pointsDeltaClassic = jsonObj.pointsDeltaClassic;
			this.pointsDeltaVc = jsonObj.pointsDeltaVc;
			if (jsonObj.releaseSet != null) {
				this.releaseSet = ReleaseSet.exists(jsonObj.releaseSet) ?
					ReleaseSet.get(jsonObj.releaseSet) : new ReleaseSet(jsonObj.releaseSet);
				if ( ! this.releaseSet.cards.includes(this)) {
					this.releaseSet.cards.push(this);
					ReleaseSet.orderBy(this.releaseSet.cards);
				}
			}
			this.imageLink = jsonObj.imageLink;
			this.heroscapersBookLink = jsonObj.heroscapersBookLink;
			this.wikiLink = jsonObj.wikiLink;
			
			// Links
			if (jsonObj.cardPowers != undefined && jsonObj.cardPowers != null) {
				for (var i = 0; i < jsonObj.cardPowers.length; i++) {
					if (CardPower.exists(jsonObj.cardPowers[i])){
						const newLinkObj = CardPower.get(jsonObj.cardPowers[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.cardPowers.length; j++) {
							if (this.cardPowers[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.cardPowers.push(newLinkObj);
						}
					} else {
						const newForeignObj = new CardPower(jsonObj.cardPowers[i]);
						if ( ! this.cardPowers.includes(newForeignObj)) {
							this.cardPowers.push(newForeignObj);
						}
						newForeignObj.card = this;
					}
				}
			}
			CardPower.orderBy(this.cardPowers);
			if (jsonObj.deltaUpdateCosts != undefined && jsonObj.deltaUpdateCosts != null) {
				for (var i = 0; i < jsonObj.deltaUpdateCosts.length; i++) {
					if (DeltaUpdateCost.exists(jsonObj.deltaUpdateCosts[i])){
						const newLinkObj = DeltaUpdateCost.get(jsonObj.deltaUpdateCosts[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.deltaUpdateCosts.length; j++) {
							if (this.deltaUpdateCosts[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.deltaUpdateCosts.push(newLinkObj);
						}
					} else {
						const newForeignObj = new DeltaUpdateCost(jsonObj.deltaUpdateCosts[i]);
						if ( ! this.deltaUpdateCosts.includes(newForeignObj)) {
							this.deltaUpdateCosts.push(newForeignObj);
						}
						newForeignObj.card = this;
					}
				}
			}
			DeltaUpdateCost.orderBy(this.deltaUpdateCosts);
			if (jsonObj.cardPowerRankings != undefined && jsonObj.cardPowerRankings != null) {
				for (var i = 0; i < jsonObj.cardPowerRankings.length; i++) {
					if (CardPowerRanking.exists(jsonObj.cardPowerRankings[i])){
						const newLinkObj = CardPowerRanking.get(jsonObj.cardPowerRankings[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.cardPowerRankings.length; j++) {
							if (this.cardPowerRankings[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.cardPowerRankings.push(newLinkObj);
						}
					} else {
						const newForeignObj = new CardPowerRanking(jsonObj.cardPowerRankings[i]);
						if ( ! this.cardPowerRankings.includes(newForeignObj)) {
							this.cardPowerRankings.push(newForeignObj);
						}
						newForeignObj.card = this;
					}
				}
			}
			CardPowerRanking.orderBy(this.cardPowerRankings);
			if (jsonObj.playerArmyCards != undefined && jsonObj.playerArmyCards != null) {
				for (var i = 0; i < jsonObj.playerArmyCards.length; i++) {
					if (PlayerArmyCard.exists(jsonObj.playerArmyCards[i])){
						const newLinkObj = PlayerArmyCard.get(jsonObj.playerArmyCards[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.playerArmyCards.length; j++) {
							if (this.playerArmyCards[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.playerArmyCards.push(newLinkObj);
						}
					} else {
						const newForeignObj = new PlayerArmyCard(jsonObj.playerArmyCards[i]);
						if ( ! this.playerArmyCards.includes(newForeignObj)) {
							this.playerArmyCards.push(newForeignObj);
						}
						newForeignObj.card = this;
					}
				}
			}
			PlayerArmyCard.orderBy(this.playerArmyCards);
			
			Card.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Card";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "figureSet", "figureSetSubGroup", "name", "general", "homeworld", "species", "commonality", "hero", "figureCount", "hexCount", "class", "personality", "size", "height", "life", "move", "range", "attack", "defense", "points", "pointsDeltaClassic", "pointsDeltaVc", "releaseSet"];
	}

	static getAllFields() {
		return ["id", "figureSet", "figureSetSubGroup", "name", "general", "homeworld", "species", "commonality", "hero", "figureCount", "hexCount", "class", "personality", "size", "height", "life", "move", "range", "attack", "defense", "points", "pointsDeltaClassic", "pointsDeltaVc", "releaseSet", "imageLink", "heroscapersBookLink", "wikiLink"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "figureSetID", "figureSetSubGroupID", "name", "generalID", "homeworldID", "speciesID", "commonality", "hero", "figureCount", "hexCount", "classID", "personalityID", "sizeID", "height", "life", "move", "range", "attack", "defense", "points", "pointsDeltaClassic", "pointsDeltaVc", "releaseSetID", "imageLink", "heroscapersBookLink", "wikiLink"].includes(columnName)) {
			return Card;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "figureSetID":
				return "FigureSet";
			case "figureSetSubGroupID":
				return "FigureSetSubGroup";
			case "generalID":
				return "General";
			case "homeworldID":
				return "Homeworld";
			case "speciesID":
				return "Species";
			case "classID":
				return "CardClass";
			case "personalityID":
				return "Personality";
			case "sizeID":
				return "Size";
			case "releaseSetID":
				return "ReleaseSet";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "figureSet":
				return null;
			case "figureSetSubGroup":
				return null;
			case "name":
				return null;
			case "general":
				return null;
			case "homeworld":
				return null;
			case "species":
				return null;
			case "commonality":
				return null;
			case "hero":
				return null;
			case "figureCount":
				return null;
			case "hexCount":
				return null;
			case "class":
				return null;
			case "personality":
				return null;
			case "size":
				return null;
			case "height":
				return null;
			case "life":
				return null;
			case "move":
				return null;
			case "range":
				return null;
			case "attack":
				return null;
			case "defense":
				return null;
			case "points":
				return null;
			case "pointsDeltaClassic":
				return null;
			case "pointsDeltaVc":
				return null;
			case "releaseSet":
				return null;
			case "imageLink":
				return null;
			case "heroscapersBookLink":
				return null;
			case "wikiLink":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "figureSet":
				return ""; // TODO
			case "figureSetSubGroup":
				return ""; // TODO
			case "name":
				return ""; // TODO
			case "general":
				return ""; // TODO
			case "homeworld":
				return ""; // TODO
			case "species":
				return ""; // TODO
			case "commonality":
				return ""; // TODO
			case "hero":
				return ""; // TODO
			case "figureCount":
				return ""; // TODO
			case "hexCount":
				return ""; // TODO
			case "class":
				return ""; // TODO
			case "personality":
				return ""; // TODO
			case "size":
				return ""; // TODO
			case "height":
				return ""; // TODO
			case "life":
				return ""; // TODO
			case "move":
				return ""; // TODO
			case "range":
				return ""; // TODO
			case "attack":
				return ""; // TODO
			case "defense":
				return ""; // TODO
			case "points":
				return ""; // TODO
			case "pointsDeltaClassic":
				return ""; // TODO
			case "pointsDeltaVc":
				return ""; // TODO
			case "releaseSet":
				return ""; // TODO
			case "imageLink":
				return ""; // TODO
			case "heroscapersBookLink":
				return ""; // TODO
			case "wikiLink":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Card.includeField("figureSet", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "figureSet";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = FigureSet.selectOptions(this.figureSet, this.selectFilters("figureSet", filterObjects));
			fieldData["optionClass"] = "FigureSet";
			fieldData["propertyForeignClass"] = FigureSet;
			fieldData["label"] = "Figure Set";
			if (this.figureSet !== undefined && this.figureSet !== null) {
				fieldData["value"] = this.figureSet.toDisplayString();
				fieldData["databaseObj"] = this.figureSet;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("figureSetSubGroup", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "figureSetSubGroup";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = FigureSetSubGroup.selectOptions(this.figureSetSubGroup, this.selectFilters("figureSetSubGroup", filterObjects));
			fieldData["optionClass"] = "FigureSetSubGroup";
			fieldData["propertyForeignClass"] = FigureSetSubGroup;
			fieldData["label"] = "Figure Set Sub Group";
			if (this.figureSetSubGroup !== undefined && this.figureSetSubGroup !== null) {
				fieldData["value"] = this.figureSetSubGroup.toDisplayString();
				fieldData["databaseObj"] = this.figureSetSubGroup;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("general", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "general";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = General.selectOptions(this.general, this.selectFilters("general", filterObjects));
			fieldData["optionClass"] = "General";
			fieldData["propertyForeignClass"] = General;
			fieldData["label"] = "General";
			if (this.general !== undefined && this.general !== null) {
				fieldData["value"] = this.general.toDisplayString();
				fieldData["databaseObj"] = this.general;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("homeworld", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "homeworld";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Homeworld.selectOptions(this.homeworld, this.selectFilters("homeworld", filterObjects));
			fieldData["optionClass"] = "Homeworld";
			fieldData["propertyForeignClass"] = Homeworld;
			fieldData["label"] = "Homeworld";
			if (this.homeworld !== undefined && this.homeworld !== null) {
				fieldData["value"] = this.homeworld.toDisplayString();
				fieldData["databaseObj"] = this.homeworld;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("species", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "species";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Species.selectOptions(this.species, this.selectFilters("species", filterObjects));
			fieldData["optionClass"] = "Species";
			fieldData["propertyForeignClass"] = Species;
			fieldData["label"] = "Species";
			if (this.species !== undefined && this.species !== null) {
				fieldData["value"] = this.species.toDisplayString();
				fieldData["databaseObj"] = this.species;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("commonality", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "commonality";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Commonality";
			if (this.commonality !== null) {
				fieldData["value"] = this.commonality;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("hero", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "hero";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Hero";
			if (this.hero !== null) {
				fieldData["value"] = this.hero;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("figureCount", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "figureCount";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Figure Count";
			if (this.figureCount !== null) {
				fieldData["value"] = this.figureCount;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("hexCount", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "hexCount";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Hex Count";
			if (this.hexCount !== null) {
				fieldData["value"] = this.hexCount;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("class", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "class";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = CardClass.selectOptions(this.class, this.selectFilters("class", filterObjects));
			fieldData["optionClass"] = "CardClass";
			fieldData["propertyForeignClass"] = CardClass;
			fieldData["label"] = "Class";
			if (this.class !== undefined && this.class !== null) {
				fieldData["value"] = this.class.toDisplayString();
				fieldData["databaseObj"] = this.class;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("personality", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "personality";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Personality.selectOptions(this.personality, this.selectFilters("personality", filterObjects));
			fieldData["optionClass"] = "Personality";
			fieldData["propertyForeignClass"] = Personality;
			fieldData["label"] = "Personality";
			if (this.personality !== undefined && this.personality !== null) {
				fieldData["value"] = this.personality.toDisplayString();
				fieldData["databaseObj"] = this.personality;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("size", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "size";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Size.selectOptions(this.size, this.selectFilters("size", filterObjects));
			fieldData["optionClass"] = "Size";
			fieldData["propertyForeignClass"] = Size;
			fieldData["label"] = "Size";
			if (this.size !== undefined && this.size !== null) {
				fieldData["value"] = this.size.toDisplayString();
				fieldData["databaseObj"] = this.size;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("height", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "height";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Height";
			if (this.height !== null) {
				fieldData["value"] = this.height;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("life", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "life";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Life";
			if (this.life !== null) {
				fieldData["value"] = this.life;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("move", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "move";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Move";
			if (this.move !== null) {
				fieldData["value"] = this.move;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("range", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "range";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Range";
			if (this.range !== null) {
				fieldData["value"] = this.range;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("attack", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "attack";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Attack";
			if (this.attack !== null) {
				fieldData["value"] = this.attack;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("defense", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "defense";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Defense";
			if (this.defense !== null) {
				fieldData["value"] = this.defense;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("points", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "points";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Points";
			if (this.points !== null) {
				fieldData["value"] = this.points;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("pointsDeltaClassic", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "pointsDeltaClassic";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Points Delta Classic";
			if (this.pointsDeltaClassic !== null) {
				fieldData["value"] = this.pointsDeltaClassic;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("pointsDeltaVc", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "pointsDeltaVc";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Points Delta Vc";
			if (this.pointsDeltaVc !== null) {
				fieldData["value"] = this.pointsDeltaVc;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("releaseSet", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "releaseSet";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = ReleaseSet.selectOptions(this.releaseSet, this.selectFilters("releaseSet", filterObjects));
			fieldData["optionClass"] = "ReleaseSet";
			fieldData["propertyForeignClass"] = ReleaseSet;
			fieldData["label"] = "Release Set";
			if (this.releaseSet !== undefined && this.releaseSet !== null) {
				fieldData["value"] = this.releaseSet.toDisplayString();
				fieldData["databaseObj"] = this.releaseSet;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("imageLink", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "imageLink";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Image Link";
			if (this.imageLink !== null) {
				fieldData["value"] = this.imageLink;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("heroscapersBookLink", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "heroscapersBookLink";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Heroscapers Book Link";
			if (this.heroscapersBookLink !== null) {
				fieldData["value"] = this.heroscapersBookLink;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Card.includeField("wikiLink", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "wikiLink";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Wiki Link";
			if (this.wikiLink !== null) {
				fieldData["value"] = this.wikiLink;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (Card.options.fieldOrder !== undefined && Card.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Card.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "figureSet":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.figureSet = jsonObj;
				} else if (FigureSet.exists(jsonObj)) {
					this.figureSet = FigureSet.get(jsonObj);
				} else {
					this.figureSet = new FigureSet(jsonObj);
				}
				break;
			case "figureSetSubGroup":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.figureSetSubGroup = jsonObj;
				} else if (FigureSetSubGroup.exists(jsonObj)) {
					this.figureSetSubGroup = FigureSetSubGroup.get(jsonObj);
				} else {
					this.figureSetSubGroup = new FigureSetSubGroup(jsonObj);
				}
				break;
			case "general":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.general = jsonObj;
				} else if (General.exists(jsonObj)) {
					this.general = General.get(jsonObj);
				} else {
					this.general = new General(jsonObj);
				}
				break;
			case "homeworld":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.homeworld = jsonObj;
				} else if (Homeworld.exists(jsonObj)) {
					this.homeworld = Homeworld.get(jsonObj);
				} else {
					this.homeworld = new Homeworld(jsonObj);
				}
				break;
			case "species":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.species = jsonObj;
				} else if (Species.exists(jsonObj)) {
					this.species = Species.get(jsonObj);
				} else {
					this.species = new Species(jsonObj);
				}
				break;
			case "class":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.class = jsonObj;
				} else if (CardClass.exists(jsonObj)) {
					this.class = CardClass.get(jsonObj);
				} else {
					this.class = new CardClass(jsonObj);
				}
				break;
			case "personality":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.personality = jsonObj;
				} else if (Personality.exists(jsonObj)) {
					this.personality = Personality.get(jsonObj);
				} else {
					this.personality = new Personality(jsonObj);
				}
				break;
			case "size":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.size = jsonObj;
				} else if (Size.exists(jsonObj)) {
					this.size = Size.get(jsonObj);
				} else {
					this.size = new Size(jsonObj);
				}
				break;
			case "releaseSet":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.releaseSet = jsonObj;
				} else if (ReleaseSet.exists(jsonObj)) {
					this.releaseSet = ReleaseSet.get(jsonObj);
				} else {
					this.releaseSet = new ReleaseSet(jsonObj);
				}
				break;
		}
	}

}

Card.list = [];
Card.options = [];

class CardPower extends DatabaseObject {
	constructor(jsonObj) {
		if (CardPower.exists(jsonObj)) {
			return CardPower.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.card = null; // Int
		this.order = null; // Int
		this.name = null; // String
		this.description = null; // String
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			CardPower.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.card != null) {
				this.card = Card.exists(jsonObj.card) ?
					Card.get(jsonObj.card) : new Card(jsonObj.card);
				if ( ! this.card.cardPowers.includes(this)) {
					this.card.cardPowers.push(this);
					Card.orderBy(this.card.cardPowers);
				}
			}
			this.order = jsonObj.order;
			this.name = jsonObj.name;
			this.description = jsonObj.description;
			
			// Links
			
			// Draggable
			this.objectIsDraggable = true;
			this.draggableProperty = "order"
			
			CardPower.orderBy();
		}
	}

	static getOrderBy() {
		return ["order"];
	}

	static label() {
		return "Card Power";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "card", "order", "name", "description"];
	}

	static getAllFields() {
		return ["id", "card", "order", "name", "description"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "cardID", "order", "name", "description"].includes(columnName)) {
			return CardPower;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "cardID":
				return "Card";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "card":
				return null;
			case "order":
				return null;
			case "name":
				return null;
			case "description":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "card":
				return ""; // TODO
			case "order":
				return ""; // TODO
			case "name":
				return ""; // TODO
			case "description":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (CardPower.includeField("card", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "card";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Card.selectOptions(this.card, this.selectFilters("card", filterObjects));
			fieldData["optionClass"] = "Card";
			fieldData["propertyForeignClass"] = Card;
			fieldData["label"] = "Card";
			if (this.card !== undefined && this.card !== null) {
				fieldData["value"] = this.card.toDisplayString();
				fieldData["databaseObj"] = this.card;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (CardPower.includeField("order", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "order";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Order";
			if (this.order !== null) {
				fieldData["value"] = this.order;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (CardPower.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (CardPower.includeField("description", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "description";
			fieldData["elemType"] = "textarea";
			fieldData["label"] = "Description";
			if (this.description !== null) {
				fieldData["value"] = this.description;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (CardPower.options.fieldOrder !== undefined && CardPower.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, CardPower.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "card":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.card = jsonObj;
				} else if (Card.exists(jsonObj)) {
					this.card = Card.get(jsonObj);
				} else {
					this.card = new Card(jsonObj);
				}
				break;
		}
	}

}

CardPower.list = [];
CardPower.options = [];

class ReleaseSet extends DatabaseObject {
	constructor(jsonObj) {
		if (ReleaseSet.exists(jsonObj)) {
			return ReleaseSet.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.releaseDate = null; // Date
		this.figureSubSetGroup = null; // Int
		
		// Links
		this.links = [{cards: Card, label: "Cards", nTo1Link: true, linkField: 'releaseSet'}];
		this.cards = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			ReleaseSet.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			this.releaseDate = jsonObj.releaseDate;
			if (jsonObj.figureSubSetGroup != null) {
				this.figureSubSetGroup = FigureSetSubGroup.exists(jsonObj.figureSubSetGroup) ?
					FigureSetSubGroup.get(jsonObj.figureSubSetGroup) : new FigureSetSubGroup(jsonObj.figureSubSetGroup);
				if ( ! this.figureSubSetGroup.releaseSets.includes(this)) {
					this.figureSubSetGroup.releaseSets.push(this);
					FigureSetSubGroup.orderBy(this.figureSubSetGroup.releaseSets);
				}
			}
			
			// Links
			if (jsonObj.cards != undefined && jsonObj.cards != null) {
				for (var i = 0; i < jsonObj.cards.length; i++) {
					if (Card.exists(jsonObj.cards[i])){
						const newLinkObj = Card.get(jsonObj.cards[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.cards.length; j++) {
							if (this.cards[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.cards.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Card(jsonObj.cards[i]);
						if ( ! this.cards.includes(newForeignObj)) {
							this.cards.push(newForeignObj);
						}
						newForeignObj.releaseSet = this;
					}
				}
			}
			Card.orderBy(this.cards);
			
			ReleaseSet.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Release Set";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "releaseDate"];
	}

	static getAllFields() {
		return ["id", "name", "releaseDate", "figureSubSetGroup"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "releaseDate", "figureSubSetGroupID"].includes(columnName)) {
			return ReleaseSet;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "figureSubSetGroupID":
				return "FigureSetSubGroup";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "releaseDate":
				return null;
			case "figureSubSetGroup":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "releaseDate":
				return ""; // TODO
			case "figureSubSetGroup":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (ReleaseSet.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ReleaseSet.includeField("releaseDate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "releaseDate";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "Release Date";
			if (this.releaseDate !== null) {
				fieldData["value"] = this.releaseDate;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (ReleaseSet.includeField("figureSubSetGroup", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "figureSubSetGroup";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = FigureSetSubGroup.selectOptions(this.figureSubSetGroup, this.selectFilters("figureSubSetGroup", filterObjects));
			fieldData["optionClass"] = "FigureSetSubGroup";
			fieldData["propertyForeignClass"] = FigureSetSubGroup;
			fieldData["label"] = "Figure Sub Set Group";
			if (this.figureSubSetGroup !== undefined && this.figureSubSetGroup !== null) {
				fieldData["value"] = this.figureSubSetGroup.toDisplayString();
				fieldData["databaseObj"] = this.figureSubSetGroup;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (ReleaseSet.options.fieldOrder !== undefined && ReleaseSet.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, ReleaseSet.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "figureSubSetGroup":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.figureSubSetGroup = jsonObj;
				} else if (FigureSetSubGroup.exists(jsonObj)) {
					this.figureSubSetGroup = FigureSetSubGroup.get(jsonObj);
				} else {
					this.figureSubSetGroup = new FigureSetSubGroup(jsonObj);
				}
				break;
		}
	}

}

ReleaseSet.list = [];
ReleaseSet.options = [];

class DeltaUpdate extends DatabaseObject {
	constructor(jsonObj) {
		if (DeltaUpdate.exists(jsonObj)) {
			return DeltaUpdate.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.date = null; // Date
		
		// Links
		this.links = [{deltaUpdateCosts: DeltaUpdateCost, label: "Delta Update Costs", nTo1Link: true, linkField: 'deltaUpdate'}];
		this.deltaUpdateCosts = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			DeltaUpdate.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.date = jsonObj.date;
			
			// Links
			if (jsonObj.deltaUpdateCosts != undefined && jsonObj.deltaUpdateCosts != null) {
				for (var i = 0; i < jsonObj.deltaUpdateCosts.length; i++) {
					if (DeltaUpdateCost.exists(jsonObj.deltaUpdateCosts[i])){
						const newLinkObj = DeltaUpdateCost.get(jsonObj.deltaUpdateCosts[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.deltaUpdateCosts.length; j++) {
							if (this.deltaUpdateCosts[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.deltaUpdateCosts.push(newLinkObj);
						}
					} else {
						const newForeignObj = new DeltaUpdateCost(jsonObj.deltaUpdateCosts[i]);
						if ( ! this.deltaUpdateCosts.includes(newForeignObj)) {
							this.deltaUpdateCosts.push(newForeignObj);
						}
						newForeignObj.deltaUpdate = this;
					}
				}
			}
			DeltaUpdateCost.orderBy(this.deltaUpdateCosts);
			
			DeltaUpdate.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Delta Update";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "date"];
	}

	static getAllFields() {
		return ["id", "date"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "date"].includes(columnName)) {
			return DeltaUpdate;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "date":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "date":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (DeltaUpdate.includeField("date", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "date";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "date";
			fieldData["label"] = "Date";
			if (this.date !== null) {
				fieldData["value"] = this.date;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (DeltaUpdate.options.fieldOrder !== undefined && DeltaUpdate.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, DeltaUpdate.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

DeltaUpdate.list = [];
DeltaUpdate.options = [];

class DeltaUpdateCost extends DatabaseObject {
	constructor(jsonObj) {
		if (DeltaUpdateCost.exists(jsonObj)) {
			return DeltaUpdateCost.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.card = null; // Int
		this.deltaUpdate = null; // Int
		this.points = null; // Int
		this.vcPoints = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			DeltaUpdateCost.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.card != null) {
				this.card = Card.exists(jsonObj.card) ?
					Card.get(jsonObj.card) : new Card(jsonObj.card);
				if ( ! this.card.deltaUpdateCosts.includes(this)) {
					this.card.deltaUpdateCosts.push(this);
					Card.orderBy(this.card.deltaUpdateCosts);
				}
			}
			if (jsonObj.deltaUpdate != null) {
				this.deltaUpdate = DeltaUpdate.exists(jsonObj.deltaUpdate) ?
					DeltaUpdate.get(jsonObj.deltaUpdate) : new DeltaUpdate(jsonObj.deltaUpdate);
				if ( ! this.deltaUpdate.deltaUpdateCosts.includes(this)) {
					this.deltaUpdate.deltaUpdateCosts.push(this);
					DeltaUpdate.orderBy(this.deltaUpdate.deltaUpdateCosts);
				}
			}
			this.points = jsonObj.points;
			this.vcPoints = jsonObj.vcPoints;
			
			// Links
			
			DeltaUpdateCost.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Delta Update Cost";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "card", "deltaUpdate", "points", "vcPoints"];
	}

	static getAllFields() {
		return ["id", "card", "deltaUpdate", "points", "vcPoints"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "cardID", "deltaUpdateID", "points", "vcPoints"].includes(columnName)) {
			return DeltaUpdateCost;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "cardID":
				return "Card";
			case "deltaUpdateID":
				return "DeltaUpdate";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "card":
				return null;
			case "deltaUpdate":
				return null;
			case "points":
				return null;
			case "vcPoints":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "card":
				return ""; // TODO
			case "deltaUpdate":
				return ""; // TODO
			case "points":
				return ""; // TODO
			case "vcPoints":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (DeltaUpdateCost.includeField("card", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "card";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Card.selectOptions(this.card, this.selectFilters("card", filterObjects));
			fieldData["optionClass"] = "Card";
			fieldData["propertyForeignClass"] = Card;
			fieldData["label"] = "Card";
			if (this.card !== undefined && this.card !== null) {
				fieldData["value"] = this.card.toDisplayString();
				fieldData["databaseObj"] = this.card;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (DeltaUpdateCost.includeField("deltaUpdate", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "deltaUpdate";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = DeltaUpdate.selectOptions(this.deltaUpdate, this.selectFilters("deltaUpdate", filterObjects));
			fieldData["optionClass"] = "DeltaUpdate";
			fieldData["propertyForeignClass"] = DeltaUpdate;
			fieldData["label"] = "Delta Update";
			if (this.deltaUpdate !== undefined && this.deltaUpdate !== null) {
				fieldData["value"] = this.deltaUpdate.toDisplayString();
				fieldData["databaseObj"] = this.deltaUpdate;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (DeltaUpdateCost.includeField("points", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "points";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Points";
			if (this.points !== null) {
				fieldData["value"] = this.points;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (DeltaUpdateCost.includeField("vcPoints", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "vcPoints";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Vc Points";
			if (this.vcPoints !== null) {
				fieldData["value"] = this.vcPoints;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (DeltaUpdateCost.options.fieldOrder !== undefined && DeltaUpdateCost.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, DeltaUpdateCost.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "card":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.card = jsonObj;
				} else if (Card.exists(jsonObj)) {
					this.card = Card.get(jsonObj);
				} else {
					this.card = new Card(jsonObj);
				}
				break;
			case "deltaUpdate":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.deltaUpdate = jsonObj;
				} else if (DeltaUpdate.exists(jsonObj)) {
					this.deltaUpdate = DeltaUpdate.get(jsonObj);
				} else {
					this.deltaUpdate = new DeltaUpdate(jsonObj);
				}
				break;
		}
	}

}

DeltaUpdateCost.list = [];
DeltaUpdateCost.options = [];

class FigureSetSubGroup extends DatabaseObject {
	constructor(jsonObj) {
		if (FigureSetSubGroup.exists(jsonObj)) {
			return FigureSetSubGroup.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.figureSet = null; // Int
		this.tier = null; // Int
		this.order = null; // Int
		this.selectedByDefault = null; // Boolean
		this.powerRankingList = null; // Int
		
		// Links
		this.links = [{cards: Card, label: "Cards", nTo1Link: true, linkField: 'figureSetSubGroup'}, {releaseSets: ReleaseSet, label: "Release Sets", nTo1Link: true, linkField: 'figureSubSetGroup'}, {tournamentIncludesFigureSetSubGroups: TournamentIncludesFigureSetSubGroup, label: "Tournament Includes Figure Set Sub Groups", nTo1Link: true, linkField: 'figureSetSubGroup'}];
		this.cards = [];
		this.releaseSets = [];
		this.tournamentIncludesFigureSetSubGroups = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			FigureSetSubGroup.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			if (jsonObj.figureSet != null) {
				this.figureSet = FigureSet.exists(jsonObj.figureSet) ?
					FigureSet.get(jsonObj.figureSet) : new FigureSet(jsonObj.figureSet);
				if ( ! this.figureSet.figureSetSubGroups.includes(this)) {
					this.figureSet.figureSetSubGroups.push(this);
					FigureSet.orderBy(this.figureSet.figureSetSubGroups);
				}
			}
			this.tier = jsonObj.tier;
			this.order = jsonObj.order;
			this.selectedByDefault = jsonObj.selectedByDefault;
			if (jsonObj.powerRankingList != null) {
				this.powerRankingList = PowerRankingList.exists(jsonObj.powerRankingList) ?
					PowerRankingList.get(jsonObj.powerRankingList) : new PowerRankingList(jsonObj.powerRankingList);
				if ( ! this.powerRankingList.figureSetSubGroups.includes(this)) {
					this.powerRankingList.figureSetSubGroups.push(this);
					PowerRankingList.orderBy(this.powerRankingList.figureSetSubGroups);
				}
			}
			
			// Links
			if (jsonObj.cards != undefined && jsonObj.cards != null) {
				for (var i = 0; i < jsonObj.cards.length; i++) {
					if (Card.exists(jsonObj.cards[i])){
						const newLinkObj = Card.get(jsonObj.cards[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.cards.length; j++) {
							if (this.cards[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.cards.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Card(jsonObj.cards[i]);
						if ( ! this.cards.includes(newForeignObj)) {
							this.cards.push(newForeignObj);
						}
						newForeignObj.figureSetSubGroup = this;
					}
				}
			}
			Card.orderBy(this.cards);
			if (jsonObj.releaseSets != undefined && jsonObj.releaseSets != null) {
				for (var i = 0; i < jsonObj.releaseSets.length; i++) {
					if (ReleaseSet.exists(jsonObj.releaseSets[i])){
						const newLinkObj = ReleaseSet.get(jsonObj.releaseSets[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.releaseSets.length; j++) {
							if (this.releaseSets[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.releaseSets.push(newLinkObj);
						}
					} else {
						const newForeignObj = new ReleaseSet(jsonObj.releaseSets[i]);
						if ( ! this.releaseSets.includes(newForeignObj)) {
							this.releaseSets.push(newForeignObj);
						}
						newForeignObj.figureSubSetGroup = this;
					}
				}
			}
			ReleaseSet.orderBy(this.releaseSets);
			if (jsonObj.tournamentIncludesFigureSetSubGroups != undefined && jsonObj.tournamentIncludesFigureSetSubGroups != null) {
				for (var i = 0; i < jsonObj.tournamentIncludesFigureSetSubGroups.length; i++) {
					if (TournamentIncludesFigureSetSubGroup.exists(jsonObj.tournamentIncludesFigureSetSubGroups[i])){
						const newLinkObj = TournamentIncludesFigureSetSubGroup.get(jsonObj.tournamentIncludesFigureSetSubGroups[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.tournamentIncludesFigureSetSubGroups.length; j++) {
							if (this.tournamentIncludesFigureSetSubGroups[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.tournamentIncludesFigureSetSubGroups.push(newLinkObj);
						}
					} else {
						const newForeignObj = new TournamentIncludesFigureSetSubGroup(jsonObj.tournamentIncludesFigureSetSubGroups[i]);
						if ( ! this.tournamentIncludesFigureSetSubGroups.includes(newForeignObj)) {
							this.tournamentIncludesFigureSetSubGroups.push(newForeignObj);
						}
						newForeignObj.figureSetSubGroup = this;
					}
				}
			}
			TournamentIncludesFigureSetSubGroup.orderBy(this.tournamentIncludesFigureSetSubGroups);
			
			// Draggable
			this.objectIsDraggable = true;
			this.draggableProperty = "order"
			
			FigureSetSubGroup.orderBy();
		}
	}

	static getOrderBy() {
		return ["order"];
	}

	static label() {
		return "Figure Set Sub Group";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "figureSet", "tier", "order", "selectedByDefault"];
	}

	static getAllFields() {
		return ["id", "name", "figureSet", "tier", "order", "selectedByDefault", "powerRankingList"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "figureSetID", "tier", "order", "selectedByDefault", "powerRankingListID"].includes(columnName)) {
			return FigureSetSubGroup;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "figureSetID":
				return "FigureSet";
			case "powerRankingListID":
				return "PowerRankingList";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "figureSet":
				return null;
			case "tier":
				return null;
			case "order":
				return null;
			case "selectedByDefault":
				return null;
			case "powerRankingList":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "figureSet":
				return ""; // TODO
			case "tier":
				return ""; // TODO
			case "order":
				return ""; // TODO
			case "selectedByDefault":
				return ""; // TODO
			case "powerRankingList":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (FigureSetSubGroup.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureSetSubGroup.includeField("figureSet", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "figureSet";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = FigureSet.selectOptions(this.figureSet, this.selectFilters("figureSet", filterObjects));
			fieldData["optionClass"] = "FigureSet";
			fieldData["propertyForeignClass"] = FigureSet;
			fieldData["label"] = "Figure Set";
			if (this.figureSet !== undefined && this.figureSet !== null) {
				fieldData["value"] = this.figureSet.toDisplayString();
				fieldData["databaseObj"] = this.figureSet;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureSetSubGroup.includeField("tier", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "tier";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Tier";
			if (this.tier !== null) {
				fieldData["value"] = this.tier;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureSetSubGroup.includeField("order", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "order";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Order";
			if (this.order !== null) {
				fieldData["value"] = this.order;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (FigureSetSubGroup.includeField("selectedByDefault", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "selectedByDefault";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Selected By Default";
			if (this.selectedByDefault !== null) {
				fieldData["value"] = this.selectedByDefault;
			} else {
				fieldData["value"] = true; // Default value
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (FigureSetSubGroup.includeField("powerRankingList", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "powerRankingList";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = PowerRankingList.selectOptions(this.powerRankingList, this.selectFilters("powerRankingList", filterObjects));
			fieldData["optionClass"] = "PowerRankingList";
			fieldData["propertyForeignClass"] = PowerRankingList;
			fieldData["label"] = "Power Ranking List";
			if (this.powerRankingList !== undefined && this.powerRankingList !== null) {
				fieldData["value"] = this.powerRankingList.toDisplayString();
				fieldData["databaseObj"] = this.powerRankingList;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (FigureSetSubGroup.options.fieldOrder !== undefined && FigureSetSubGroup.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, FigureSetSubGroup.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "figureSet":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.figureSet = jsonObj;
				} else if (FigureSet.exists(jsonObj)) {
					this.figureSet = FigureSet.get(jsonObj);
				} else {
					this.figureSet = new FigureSet(jsonObj);
				}
				break;
			case "powerRankingList":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.powerRankingList = jsonObj;
				} else if (PowerRankingList.exists(jsonObj)) {
					this.powerRankingList = PowerRankingList.get(jsonObj);
				} else {
					this.powerRankingList = new PowerRankingList(jsonObj);
				}
				break;
		}
	}

}

FigureSetSubGroup.list = [];
FigureSetSubGroup.options = [];

class PowerRankingList extends DatabaseObject {
	constructor(jsonObj) {
		if (PowerRankingList.exists(jsonObj)) {
			return PowerRankingList.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.author = null; // Int
		
		// Links
		this.links = [{figureSetSubGroups: FigureSetSubGroup, label: "Figure Set Sub Groups", nTo1Link: true, linkField: 'powerRankingList'}, {cardPowerRankings: CardPowerRanking, label: "Card Power Rankings", nTo1Link: true, linkField: 'powerRankingList'}];
		this.figureSetSubGroups = [];
		this.cardPowerRankings = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			PowerRankingList.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			if (jsonObj.author != null) {
				this.author = User.exists(jsonObj.author) ?
					User.get(jsonObj.author) : new User(jsonObj.author);
				if ( ! this.author.powerRankingLists.includes(this)) {
					this.author.powerRankingLists.push(this);
					User.orderBy(this.author.powerRankingLists);
				}
			}
			
			// Links
			if (jsonObj.figureSetSubGroups != undefined && jsonObj.figureSetSubGroups != null) {
				for (var i = 0; i < jsonObj.figureSetSubGroups.length; i++) {
					if (FigureSetSubGroup.exists(jsonObj.figureSetSubGroups[i])){
						const newLinkObj = FigureSetSubGroup.get(jsonObj.figureSetSubGroups[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.figureSetSubGroups.length; j++) {
							if (this.figureSetSubGroups[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.figureSetSubGroups.push(newLinkObj);
						}
					} else {
						const newForeignObj = new FigureSetSubGroup(jsonObj.figureSetSubGroups[i]);
						if ( ! this.figureSetSubGroups.includes(newForeignObj)) {
							this.figureSetSubGroups.push(newForeignObj);
						}
						newForeignObj.powerRankingList = this;
					}
				}
			}
			FigureSetSubGroup.orderBy(this.figureSetSubGroups);
			if (jsonObj.cardPowerRankings != undefined && jsonObj.cardPowerRankings != null) {
				for (var i = 0; i < jsonObj.cardPowerRankings.length; i++) {
					if (CardPowerRanking.exists(jsonObj.cardPowerRankings[i])){
						const newLinkObj = CardPowerRanking.get(jsonObj.cardPowerRankings[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.cardPowerRankings.length; j++) {
							if (this.cardPowerRankings[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.cardPowerRankings.push(newLinkObj);
						}
					} else {
						const newForeignObj = new CardPowerRanking(jsonObj.cardPowerRankings[i]);
						if ( ! this.cardPowerRankings.includes(newForeignObj)) {
							this.cardPowerRankings.push(newForeignObj);
						}
						newForeignObj.powerRankingList = this;
					}
				}
			}
			CardPowerRanking.orderBy(this.cardPowerRankings);
			
			PowerRankingList.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Power Ranking List";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "author"];
	}

	static getAllFields() {
		return ["id", "name", "author"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "authorID"].includes(columnName)) {
			return PowerRankingList;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "authorID":
				return "User";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "author":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "author":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (PowerRankingList.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (PowerRankingList.includeField("author", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "author";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = User.selectOptions(this.author, this.selectFilters("author", filterObjects));
			fieldData["optionClass"] = "User";
			fieldData["propertyForeignClass"] = User;
			fieldData["label"] = "Author";
			if (this.author !== undefined && this.author !== null) {
				fieldData["value"] = this.author.toDisplayString();
				fieldData["databaseObj"] = this.author;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (PowerRankingList.options.fieldOrder !== undefined && PowerRankingList.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, PowerRankingList.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "author":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.author = jsonObj;
				} else if (User.exists(jsonObj)) {
					this.author = User.get(jsonObj);
				} else {
					this.author = new User(jsonObj);
				}
				break;
		}
	}

}

PowerRankingList.list = [];
PowerRankingList.options = [];

class General extends DatabaseObject {
	constructor(jsonObj) {
		if (General.exists(jsonObj)) {
			return General.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.figureSet = null; // Int
		
		// Links
		this.links = [{cards: Card, label: "Cards", nTo1Link: true, linkField: 'general'}];
		this.cards = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			General.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			if (jsonObj.figureSet != null) {
				this.figureSet = FigureSet.exists(jsonObj.figureSet) ?
					FigureSet.get(jsonObj.figureSet) : new FigureSet(jsonObj.figureSet);
				if ( ! this.figureSet.generals.includes(this)) {
					this.figureSet.generals.push(this);
					FigureSet.orderBy(this.figureSet.generals);
				}
			}
			
			// Links
			if (jsonObj.cards != undefined && jsonObj.cards != null) {
				for (var i = 0; i < jsonObj.cards.length; i++) {
					if (Card.exists(jsonObj.cards[i])){
						const newLinkObj = Card.get(jsonObj.cards[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.cards.length; j++) {
							if (this.cards[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.cards.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Card(jsonObj.cards[i]);
						if ( ! this.cards.includes(newForeignObj)) {
							this.cards.push(newForeignObj);
						}
						newForeignObj.general = this;
					}
				}
			}
			Card.orderBy(this.cards);
			
			General.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "General";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "figureSet"];
	}

	static getAllFields() {
		return ["id", "name", "figureSet"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "figureSetID"].includes(columnName)) {
			return General;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "figureSetID":
				return "FigureSet";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "figureSet":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "figureSet":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (General.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (General.includeField("figureSet", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "figureSet";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = FigureSet.selectOptions(this.figureSet, this.selectFilters("figureSet", filterObjects));
			fieldData["optionClass"] = "FigureSet";
			fieldData["propertyForeignClass"] = FigureSet;
			fieldData["label"] = "Figure Set";
			if (this.figureSet !== undefined && this.figureSet !== null) {
				fieldData["value"] = this.figureSet.toDisplayString();
				fieldData["databaseObj"] = this.figureSet;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (General.options.fieldOrder !== undefined && General.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, General.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "figureSet":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.figureSet = jsonObj;
				} else if (FigureSet.exists(jsonObj)) {
					this.figureSet = FigureSet.get(jsonObj);
				} else {
					this.figureSet = new FigureSet(jsonObj);
				}
				break;
		}
	}

}

General.list = [];
General.options = [];

class Homeworld extends DatabaseObject {
	constructor(jsonObj) {
		if (Homeworld.exists(jsonObj)) {
			return Homeworld.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.figureSet = null; // Int
		
		// Links
		this.links = [{cards: Card, label: "Cards", nTo1Link: true, linkField: 'homeworld'}];
		this.cards = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Homeworld.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			if (jsonObj.figureSet != null) {
				this.figureSet = FigureSet.exists(jsonObj.figureSet) ?
					FigureSet.get(jsonObj.figureSet) : new FigureSet(jsonObj.figureSet);
				if ( ! this.figureSet.homeworlds.includes(this)) {
					this.figureSet.homeworlds.push(this);
					FigureSet.orderBy(this.figureSet.homeworlds);
				}
			}
			
			// Links
			if (jsonObj.cards != undefined && jsonObj.cards != null) {
				for (var i = 0; i < jsonObj.cards.length; i++) {
					if (Card.exists(jsonObj.cards[i])){
						const newLinkObj = Card.get(jsonObj.cards[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.cards.length; j++) {
							if (this.cards[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.cards.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Card(jsonObj.cards[i]);
						if ( ! this.cards.includes(newForeignObj)) {
							this.cards.push(newForeignObj);
						}
						newForeignObj.homeworld = this;
					}
				}
			}
			Card.orderBy(this.cards);
			
			Homeworld.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Homeworld";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "figureSet"];
	}

	static getAllFields() {
		return ["id", "name", "figureSet"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "figureSetID"].includes(columnName)) {
			return Homeworld;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "figureSetID":
				return "FigureSet";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "figureSet":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "figureSet":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Homeworld.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Homeworld.includeField("figureSet", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "figureSet";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = FigureSet.selectOptions(this.figureSet, this.selectFilters("figureSet", filterObjects));
			fieldData["optionClass"] = "FigureSet";
			fieldData["propertyForeignClass"] = FigureSet;
			fieldData["label"] = "Figure Set";
			if (this.figureSet !== undefined && this.figureSet !== null) {
				fieldData["value"] = this.figureSet.toDisplayString();
				fieldData["databaseObj"] = this.figureSet;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Homeworld.options.fieldOrder !== undefined && Homeworld.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Homeworld.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "figureSet":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.figureSet = jsonObj;
				} else if (FigureSet.exists(jsonObj)) {
					this.figureSet = FigureSet.get(jsonObj);
				} else {
					this.figureSet = new FigureSet(jsonObj);
				}
				break;
		}
	}

}

Homeworld.list = [];
Homeworld.options = [];

class Species extends DatabaseObject {
	constructor(jsonObj) {
		if (Species.exists(jsonObj)) {
			return Species.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.figureSet = null; // Int
		
		// Links
		this.links = [{cards: Card, label: "Cards", nTo1Link: true, linkField: 'species'}];
		this.cards = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Species.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			if (jsonObj.figureSet != null) {
				this.figureSet = FigureSet.exists(jsonObj.figureSet) ?
					FigureSet.get(jsonObj.figureSet) : new FigureSet(jsonObj.figureSet);
				if ( ! this.figureSet.speciess.includes(this)) {
					this.figureSet.speciess.push(this);
					FigureSet.orderBy(this.figureSet.speciess);
				}
			}
			
			// Links
			if (jsonObj.cards != undefined && jsonObj.cards != null) {
				for (var i = 0; i < jsonObj.cards.length; i++) {
					if (Card.exists(jsonObj.cards[i])){
						const newLinkObj = Card.get(jsonObj.cards[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.cards.length; j++) {
							if (this.cards[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.cards.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Card(jsonObj.cards[i]);
						if ( ! this.cards.includes(newForeignObj)) {
							this.cards.push(newForeignObj);
						}
						newForeignObj.species = this;
					}
				}
			}
			Card.orderBy(this.cards);
			
			Species.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Species";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "figureSet"];
	}

	static getAllFields() {
		return ["id", "name", "figureSet"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "figureSetID"].includes(columnName)) {
			return Species;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "figureSetID":
				return "FigureSet";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "figureSet":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "figureSet":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Species.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Species.includeField("figureSet", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "figureSet";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = FigureSet.selectOptions(this.figureSet, this.selectFilters("figureSet", filterObjects));
			fieldData["optionClass"] = "FigureSet";
			fieldData["propertyForeignClass"] = FigureSet;
			fieldData["label"] = "Figure Set";
			if (this.figureSet !== undefined && this.figureSet !== null) {
				fieldData["value"] = this.figureSet.toDisplayString();
				fieldData["databaseObj"] = this.figureSet;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Species.options.fieldOrder !== undefined && Species.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Species.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "figureSet":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.figureSet = jsonObj;
				} else if (FigureSet.exists(jsonObj)) {
					this.figureSet = FigureSet.get(jsonObj);
				} else {
					this.figureSet = new FigureSet(jsonObj);
				}
				break;
		}
	}

}

Species.list = [];
Species.options = [];

class CardClass extends DatabaseObject {
	constructor(jsonObj) {
		if (CardClass.exists(jsonObj)) {
			return CardClass.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.figureSet = null; // Int
		
		// Links
		this.links = [{cards: Card, label: "Cards", nTo1Link: true, linkField: 'class'}];
		this.cards = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			CardClass.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			if (jsonObj.figureSet != null) {
				this.figureSet = FigureSet.exists(jsonObj.figureSet) ?
					FigureSet.get(jsonObj.figureSet) : new FigureSet(jsonObj.figureSet);
				if ( ! this.figureSet.cardClasss.includes(this)) {
					this.figureSet.cardClasss.push(this);
					FigureSet.orderBy(this.figureSet.cardClasss);
				}
			}
			
			// Links
			if (jsonObj.cards != undefined && jsonObj.cards != null) {
				for (var i = 0; i < jsonObj.cards.length; i++) {
					if (Card.exists(jsonObj.cards[i])){
						const newLinkObj = Card.get(jsonObj.cards[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.cards.length; j++) {
							if (this.cards[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.cards.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Card(jsonObj.cards[i]);
						if ( ! this.cards.includes(newForeignObj)) {
							this.cards.push(newForeignObj);
						}
						newForeignObj.class = this;
					}
				}
			}
			Card.orderBy(this.cards);
			
			CardClass.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Card Class";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "figureSet"];
	}

	static getAllFields() {
		return ["id", "name", "figureSet"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "figureSetID"].includes(columnName)) {
			return CardClass;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "figureSetID":
				return "FigureSet";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "figureSet":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "figureSet":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (CardClass.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (CardClass.includeField("figureSet", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "figureSet";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = FigureSet.selectOptions(this.figureSet, this.selectFilters("figureSet", filterObjects));
			fieldData["optionClass"] = "FigureSet";
			fieldData["propertyForeignClass"] = FigureSet;
			fieldData["label"] = "Figure Set";
			if (this.figureSet !== undefined && this.figureSet !== null) {
				fieldData["value"] = this.figureSet.toDisplayString();
				fieldData["databaseObj"] = this.figureSet;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (CardClass.options.fieldOrder !== undefined && CardClass.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, CardClass.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "figureSet":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.figureSet = jsonObj;
				} else if (FigureSet.exists(jsonObj)) {
					this.figureSet = FigureSet.get(jsonObj);
				} else {
					this.figureSet = new FigureSet(jsonObj);
				}
				break;
		}
	}

}

CardClass.list = [];
CardClass.options = [];

class Personality extends DatabaseObject {
	constructor(jsonObj) {
		if (Personality.exists(jsonObj)) {
			return Personality.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		this.figureSet = null; // Int
		
		// Links
		this.links = [{cards: Card, label: "Cards", nTo1Link: true, linkField: 'personality'}];
		this.cards = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Personality.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			if (jsonObj.figureSet != null) {
				this.figureSet = FigureSet.exists(jsonObj.figureSet) ?
					FigureSet.get(jsonObj.figureSet) : new FigureSet(jsonObj.figureSet);
				if ( ! this.figureSet.personalitys.includes(this)) {
					this.figureSet.personalitys.push(this);
					FigureSet.orderBy(this.figureSet.personalitys);
				}
			}
			
			// Links
			if (jsonObj.cards != undefined && jsonObj.cards != null) {
				for (var i = 0; i < jsonObj.cards.length; i++) {
					if (Card.exists(jsonObj.cards[i])){
						const newLinkObj = Card.get(jsonObj.cards[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.cards.length; j++) {
							if (this.cards[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.cards.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Card(jsonObj.cards[i]);
						if ( ! this.cards.includes(newForeignObj)) {
							this.cards.push(newForeignObj);
						}
						newForeignObj.personality = this;
					}
				}
			}
			Card.orderBy(this.cards);
			
			Personality.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Personality";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name", "figureSet"];
	}

	static getAllFields() {
		return ["id", "name", "figureSet"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name", "figureSetID"].includes(columnName)) {
			return Personality;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "figureSetID":
				return "FigureSet";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			case "figureSet":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			case "figureSet":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Personality.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Personality.includeField("figureSet", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "figureSet";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = FigureSet.selectOptions(this.figureSet, this.selectFilters("figureSet", filterObjects));
			fieldData["optionClass"] = "FigureSet";
			fieldData["propertyForeignClass"] = FigureSet;
			fieldData["label"] = "Figure Set";
			if (this.figureSet !== undefined && this.figureSet !== null) {
				fieldData["value"] = this.figureSet.toDisplayString();
				fieldData["databaseObj"] = this.figureSet;
				fieldData["databaseObjProperty"] = "name";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Personality.options.fieldOrder !== undefined && Personality.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Personality.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "figureSet":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.figureSet = jsonObj;
				} else if (FigureSet.exists(jsonObj)) {
					this.figureSet = FigureSet.get(jsonObj);
				} else {
					this.figureSet = new FigureSet(jsonObj);
				}
				break;
		}
	}

}

Personality.list = [];
Personality.options = [];

class Size extends DatabaseObject {
	constructor(jsonObj) {
		if (Size.exists(jsonObj)) {
			return Size.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.name = null; // String
		
		// Links
		this.links = [{cards: Card, label: "Cards", nTo1Link: true, linkField: 'size'}];
		this.cards = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			Size.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.name = jsonObj.name;
			
			// Links
			if (jsonObj.cards != undefined && jsonObj.cards != null) {
				for (var i = 0; i < jsonObj.cards.length; i++) {
					if (Card.exists(jsonObj.cards[i])){
						const newLinkObj = Card.get(jsonObj.cards[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.cards.length; j++) {
							if (this.cards[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.cards.push(newLinkObj);
						}
					} else {
						const newForeignObj = new Card(jsonObj.cards[i]);
						if ( ! this.cards.includes(newForeignObj)) {
							this.cards.push(newForeignObj);
						}
						newForeignObj.size = this;
					}
				}
			}
			Card.orderBy(this.cards);
			
			Size.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Size";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "name"];
	}

	static getAllFields() {
		return ["id", "name"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "name"].includes(columnName)) {
			return Size;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return this.name.substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "name":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "name":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (Size.includeField("name", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "name";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Name";
			if (this.name !== null) {
				fieldData["value"] = this.name;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (Size.options.fieldOrder !== undefined && Size.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, Size.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

Size.list = [];
Size.options = [];

class CardPowerRanking extends DatabaseObject {
	constructor(jsonObj) {
		if (CardPowerRanking.exists(jsonObj)) {
			return CardPowerRanking.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.card = null; // Int
		this.powerRankingList = null; // Int
		this.ranking = null; // String
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			CardPowerRanking.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.card != null) {
				this.card = Card.exists(jsonObj.card) ?
					Card.get(jsonObj.card) : new Card(jsonObj.card);
				if ( ! this.card.cardPowerRankings.includes(this)) {
					this.card.cardPowerRankings.push(this);
					Card.orderBy(this.card.cardPowerRankings);
				}
			}
			if (jsonObj.powerRankingList != null) {
				this.powerRankingList = PowerRankingList.exists(jsonObj.powerRankingList) ?
					PowerRankingList.get(jsonObj.powerRankingList) : new PowerRankingList(jsonObj.powerRankingList);
				if ( ! this.powerRankingList.cardPowerRankings.includes(this)) {
					this.powerRankingList.cardPowerRankings.push(this);
					PowerRankingList.orderBy(this.powerRankingList.cardPowerRankings);
				}
			}
			this.ranking = jsonObj.ranking;
			
			// Links
			
			CardPowerRanking.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Card Power Ranking";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "card", "powerRankingList"];
	}

	static getAllFields() {
		return ["id", "card", "powerRankingList", "ranking"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "cardID", "powerRankingListID", "ranking"].includes(columnName)) {
			return CardPowerRanking;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "cardID":
				return "Card";
			case "powerRankingListID":
				return "PowerRankingList";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "card":
				return null;
			case "powerRankingList":
				return null;
			case "ranking":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "card":
				return ""; // TODO
			case "powerRankingList":
				return ""; // TODO
			case "ranking":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (CardPowerRanking.includeField("card", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "card";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Card.selectOptions(this.card, this.selectFilters("card", filterObjects));
			fieldData["optionClass"] = "Card";
			fieldData["propertyForeignClass"] = Card;
			fieldData["label"] = "Card";
			if (this.card !== undefined && this.card !== null) {
				fieldData["value"] = this.card.toDisplayString();
				fieldData["databaseObj"] = this.card;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (CardPowerRanking.includeField("powerRankingList", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "powerRankingList";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = PowerRankingList.selectOptions(this.powerRankingList, this.selectFilters("powerRankingList", filterObjects));
			fieldData["optionClass"] = "PowerRankingList";
			fieldData["propertyForeignClass"] = PowerRankingList;
			fieldData["label"] = "Power Ranking List";
			if (this.powerRankingList !== undefined && this.powerRankingList !== null) {
				fieldData["value"] = this.powerRankingList.toDisplayString();
				fieldData["databaseObj"] = this.powerRankingList;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (CardPowerRanking.includeField("ranking", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "ranking";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "Ranking";
			if (this.ranking !== null) {
				fieldData["value"] = this.ranking;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (CardPowerRanking.options.fieldOrder !== undefined && CardPowerRanking.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, CardPowerRanking.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "card":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.card = jsonObj;
				} else if (Card.exists(jsonObj)) {
					this.card = Card.get(jsonObj);
				} else {
					this.card = new Card(jsonObj);
				}
				break;
			case "powerRankingList":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.powerRankingList = jsonObj;
				} else if (PowerRankingList.exists(jsonObj)) {
					this.powerRankingList = PowerRankingList.get(jsonObj);
				} else {
					this.powerRankingList = new PowerRankingList(jsonObj);
				}
				break;
		}
	}

}

CardPowerRanking.list = [];
CardPowerRanking.options = [];

class UserCollectionHeroscapeSet extends DatabaseObject {
	constructor(jsonObj) {
		if (UserCollectionHeroscapeSet.exists(jsonObj)) {
			return UserCollectionHeroscapeSet.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.user = null; // Int
		this.heroscapeSet = null; // Int
		this.quantity = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			UserCollectionHeroscapeSet.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.user != null) {
				this.user = User.exists(jsonObj.user) ?
					User.get(jsonObj.user) : new User(jsonObj.user);
				if ( ! this.user.userCollectionHeroscapeSets.includes(this)) {
					this.user.userCollectionHeroscapeSets.push(this);
					User.orderBy(this.user.userCollectionHeroscapeSets);
				}
			}
			if (jsonObj.heroscapeSet != null) {
				this.heroscapeSet = HeroscapeSet.exists(jsonObj.heroscapeSet) ?
					HeroscapeSet.get(jsonObj.heroscapeSet) : new HeroscapeSet(jsonObj.heroscapeSet);
				if ( ! this.heroscapeSet.userCollectionHeroscapeSets.includes(this)) {
					this.heroscapeSet.userCollectionHeroscapeSets.push(this);
					HeroscapeSet.orderBy(this.heroscapeSet.userCollectionHeroscapeSets);
				}
			}
			this.quantity = jsonObj.quantity;
			
			// Links
			
			UserCollectionHeroscapeSet.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "User Collection Heroscape Set";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "user", "heroscapeSet", "quantity"];
	}

	static getAllFields() {
		return ["id", "user", "heroscapeSet", "quantity"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "userID", "heroscapeSetID", "quantity"].includes(columnName)) {
			return UserCollectionHeroscapeSet;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "userID":
				return "User";
			case "heroscapeSetID":
				return "HeroscapeSet";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "user":
				return null;
			case "heroscapeSet":
				return null;
			case "quantity":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "user":
				return ""; // TODO
			case "heroscapeSet":
				return ""; // TODO
			case "quantity":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (UserCollectionHeroscapeSet.includeField("user", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "user";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = User.selectOptions(this.user, this.selectFilters("user", filterObjects));
			fieldData["optionClass"] = "User";
			fieldData["propertyForeignClass"] = User;
			fieldData["label"] = "User";
			if (this.user !== undefined && this.user !== null) {
				fieldData["value"] = this.user.toDisplayString();
				fieldData["databaseObj"] = this.user;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UserCollectionHeroscapeSet.includeField("heroscapeSet", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "heroscapeSet";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = HeroscapeSet.selectOptions(this.heroscapeSet, this.selectFilters("heroscapeSet", filterObjects));
			fieldData["optionClass"] = "HeroscapeSet";
			fieldData["propertyForeignClass"] = HeroscapeSet;
			fieldData["label"] = "Heroscape Set";
			if (this.heroscapeSet !== undefined && this.heroscapeSet !== null) {
				fieldData["value"] = this.heroscapeSet.toDisplayString();
				fieldData["databaseObj"] = this.heroscapeSet;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UserCollectionHeroscapeSet.includeField("quantity", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "quantity";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Quantity";
			if (this.quantity !== null) {
				fieldData["value"] = this.quantity;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (UserCollectionHeroscapeSet.options.fieldOrder !== undefined && UserCollectionHeroscapeSet.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, UserCollectionHeroscapeSet.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "user":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.user = jsonObj;
				} else if (User.exists(jsonObj)) {
					this.user = User.get(jsonObj);
				} else {
					this.user = new User(jsonObj);
				}
				break;
			case "heroscapeSet":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.heroscapeSet = jsonObj;
				} else if (HeroscapeSet.exists(jsonObj)) {
					this.heroscapeSet = HeroscapeSet.get(jsonObj);
				} else {
					this.heroscapeSet = new HeroscapeSet(jsonObj);
				}
				break;
		}
	}

}

UserCollectionHeroscapeSet.list = [];
UserCollectionHeroscapeSet.options = [];

class PlayerArmyCard extends DatabaseObject {
	constructor(jsonObj) {
		if (PlayerArmyCard.exists(jsonObj)) {
			return PlayerArmyCard.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.playerArmy = null; // Int
		this.card = null; // Int
		this.quantity = null; // Int
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			PlayerArmyCard.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.playerArmy != null) {
				this.playerArmy = PlayerArmy.exists(jsonObj.playerArmy) ?
					PlayerArmy.get(jsonObj.playerArmy) : new PlayerArmy(jsonObj.playerArmy);
				if ( ! this.playerArmy.playerArmyCards.includes(this)) {
					this.playerArmy.playerArmyCards.push(this);
					PlayerArmy.orderBy(this.playerArmy.playerArmyCards);
				}
			}
			if (jsonObj.card != null) {
				this.card = Card.exists(jsonObj.card) ?
					Card.get(jsonObj.card) : new Card(jsonObj.card);
				if ( ! this.card.playerArmyCards.includes(this)) {
					this.card.playerArmyCards.push(this);
					Card.orderBy(this.card.playerArmyCards);
				}
			}
			this.quantity = jsonObj.quantity;
			
			// Links
			
			PlayerArmyCard.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Player Army Card";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "playerArmy", "card", "quantity"];
	}

	static getAllFields() {
		return ["id", "playerArmy", "card", "quantity"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "playerArmyID", "cardID", "quantity"].includes(columnName)) {
			return PlayerArmyCard;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "playerArmyID":
				return "PlayerArmy";
			case "cardID":
				return "Card";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "playerArmy":
				return null;
			case "card":
				return null;
			case "quantity":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "playerArmy":
				return ""; // TODO
			case "card":
				return ""; // TODO
			case "quantity":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (PlayerArmyCard.includeField("playerArmy", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "playerArmy";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = PlayerArmy.selectOptions(this.playerArmy, this.selectFilters("playerArmy", filterObjects));
			fieldData["optionClass"] = "PlayerArmy";
			fieldData["propertyForeignClass"] = PlayerArmy;
			fieldData["label"] = "Player Army";
			if (this.playerArmy !== undefined && this.playerArmy !== null) {
				fieldData["value"] = this.playerArmy.toDisplayString();
				fieldData["databaseObj"] = this.playerArmy;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (PlayerArmyCard.includeField("card", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "card";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Card.selectOptions(this.card, this.selectFilters("card", filterObjects));
			fieldData["optionClass"] = "Card";
			fieldData["propertyForeignClass"] = Card;
			fieldData["label"] = "Card";
			if (this.card !== undefined && this.card !== null) {
				fieldData["value"] = this.card.toDisplayString();
				fieldData["databaseObj"] = this.card;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (PlayerArmyCard.includeField("quantity", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "quantity";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Quantity";
			if (this.quantity !== null) {
				fieldData["value"] = this.quantity;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (PlayerArmyCard.options.fieldOrder !== undefined && PlayerArmyCard.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, PlayerArmyCard.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "playerArmy":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.playerArmy = jsonObj;
				} else if (PlayerArmy.exists(jsonObj)) {
					this.playerArmy = PlayerArmy.get(jsonObj);
				} else {
					this.playerArmy = new PlayerArmy(jsonObj);
				}
				break;
			case "card":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.card = jsonObj;
				} else if (Card.exists(jsonObj)) {
					this.card = Card.get(jsonObj);
				} else {
					this.card = new Card(jsonObj);
				}
				break;
		}
	}

}

PlayerArmyCard.list = [];
PlayerArmyCard.options = [];

class StandingsView extends DatabaseObject {
	constructor(jsonObj) {
		if (StandingsView.exists(jsonObj)) {
			return StandingsView.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.userName = null; // String
		this.elo = null; // Int
		this.W = null; // Int
		this.L = null; // Int
		this.WinPercent = null; // Decimal
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			StandingsView.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			this.userName = jsonObj.userName;
			this.elo = jsonObj.elo;
			this.W = jsonObj.W;
			this.L = jsonObj.L;
			this.WinPercent = jsonObj.WinPercent;
			
			// Links
			
			StandingsView.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Standings View";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "userName", "elo", "W", "L", "WinPercent"];
	}

	static getAllFields() {
		return ["id", "userName", "elo", "W", "L", "WinPercent"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "userName", "elo", "W", "L", "WinPercent"].includes(columnName)) {
			return StandingsView;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "userName":
				return null;
			case "elo":
				return null;
			case "W":
				return null;
			case "L":
				return null;
			case "WinPercent":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "userName":
				return ""; // TODO
			case "elo":
				return ""; // TODO
			case "W":
				return ""; // TODO
			case "L":
				return ""; // TODO
			case "WinPercent":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (StandingsView.includeField("userName", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "userName";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "text";
			fieldData["label"] = "User Name";
			if (this.userName !== null) {
				fieldData["value"] = this.userName;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (StandingsView.includeField("elo", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "elo";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Elo";
			if (this.elo !== null) {
				fieldData["value"] = this.elo;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (StandingsView.includeField("W", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "W";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "W";
			if (this.W !== null) {
				fieldData["value"] = this.W;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (StandingsView.includeField("L", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "L";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "L";
			if (this.L !== null) {
				fieldData["value"] = this.L;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (StandingsView.includeField("WinPercent", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "WinPercent";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "any";
			fieldData["label"] = "Win Percent";
			if (this.WinPercent !== null) {
				fieldData["value"] = this.WinPercent;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (StandingsView.options.fieldOrder !== undefined && StandingsView.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, StandingsView.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
		}
	}

}

StandingsView.list = [];
StandingsView.options = [];

class TournamentIncludesFigureSetSubGroup extends DatabaseObject {
	constructor(jsonObj) {
		if (TournamentIncludesFigureSetSubGroup.exists(jsonObj)) {
			return TournamentIncludesFigureSetSubGroup.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.id = null; // Int
		this.tournament = null; // Int
		this.figureSetSubGroup = null; // Int
		this.include = null; // Boolean
		
		// Links
		this.links = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			TournamentIncludesFigureSetSubGroup.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.id = jsonObj.id;
			if (jsonObj.tournament != null) {
				this.tournament = Tournament.exists(jsonObj.tournament) ?
					Tournament.get(jsonObj.tournament) : Tournament.newChild(jsonObj.tournament);
				if ( ! this.tournament.tournamentIncludesFigureSetSubGroups.includes(this)) {
					this.tournament.tournamentIncludesFigureSetSubGroups.push(this);
					Tournament.orderBy(this.tournament.tournamentIncludesFigureSetSubGroups);
				}
			}
			if (jsonObj.figureSetSubGroup != null) {
				this.figureSetSubGroup = FigureSetSubGroup.exists(jsonObj.figureSetSubGroup) ?
					FigureSetSubGroup.get(jsonObj.figureSetSubGroup) : new FigureSetSubGroup(jsonObj.figureSetSubGroup);
				if ( ! this.figureSetSubGroup.tournamentIncludesFigureSetSubGroups.includes(this)) {
					this.figureSetSubGroup.tournamentIncludesFigureSetSubGroups.push(this);
					FigureSetSubGroup.orderBy(this.figureSetSubGroup.tournamentIncludesFigureSetSubGroups);
				}
			}
			this.include = jsonObj.include;
			
			// Links
			
			TournamentIncludesFigureSetSubGroup.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Tournament Includes Figure Set Sub Group";
	}

	static primaryKeys() {
		return ["id"];
	}

	static primaryKeysWithChildKeys() {
		return ["id"];
	}

	static getRequiredFields() {
		return ["id", "tournament", "figureSetSubGroup", "include"];
	}

	static getAllFields() {
		return ["id", "tournament", "figureSetSubGroup", "include"];
	}

	static getNtoMLinkClasses() {
		return {};
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["id", "tournamentID", "figureSetSubGroupID", "include"].includes(columnName)) {
			return TournamentIncludesFigureSetSubGroup;
		}
		return null;
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "tournamentID":
				return "Tournament";
			case "figureSetSubGroupID":
				return "FigureSetSubGroup";
		}
		return null;
	}

	static getActionNames() {
		return [];
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return null;
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.id, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "tournament":
				return null;
			case "figureSetSubGroup":
				return null;
			case "include":
				return null;
			default:
				return null;
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "tournament":
				return ""; // TODO
			case "figureSetSubGroup":
				return ""; // TODO
			case "include":
				return ""; // TODO
			default:
				return "";
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = [];
		
		if (TournamentIncludesFigureSetSubGroup.includeField("tournament", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "tournament";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = Tournament.selectOptions(this.tournament, this.selectFilters("tournament", filterObjects));
			fieldData["optionClass"] = "Tournament";
			fieldData["propertyForeignClass"] = Tournament;
			fieldData["label"] = "Tournament";
			if (this.tournament !== undefined && this.tournament !== null) {
				fieldData["value"] = this.tournament.toDisplayString();
				fieldData["databaseObj"] = this.tournament;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentIncludesFigureSetSubGroup.includeField("figureSetSubGroup", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "figureSetSubGroup";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = FigureSetSubGroup.selectOptions(this.figureSetSubGroup, this.selectFilters("figureSetSubGroup", filterObjects));
			fieldData["optionClass"] = "FigureSetSubGroup";
			fieldData["propertyForeignClass"] = FigureSetSubGroup;
			fieldData["label"] = "Figure Set Sub Group";
			if (this.figureSetSubGroup !== undefined && this.figureSetSubGroup !== null) {
				fieldData["value"] = this.figureSetSubGroup.toDisplayString();
				fieldData["databaseObj"] = this.figureSetSubGroup;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (TournamentIncludesFigureSetSubGroup.includeField("include", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "include";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Include";
			if (this.include !== null) {
				fieldData["value"] = this.include;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (TournamentIncludesFigureSetSubGroup.options.fieldOrder !== undefined && TournamentIncludesFigureSetSubGroup.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, TournamentIncludesFigureSetSubGroup.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "tournament":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.tournament = jsonObj;
				} else if (Tournament.exists(jsonObj)) {
					this.tournament = Tournament.get(jsonObj);
				} else {
					this.tournament = new Tournament(jsonObj);
				}
				break;
			case "figureSetSubGroup":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.figureSetSubGroup = jsonObj;
				} else if (FigureSetSubGroup.exists(jsonObj)) {
					this.figureSetSubGroup = FigureSetSubGroup.get(jsonObj);
				} else {
					this.figureSetSubGroup = new FigureSetSubGroup(jsonObj);
				}
				break;
		}
	}

}

TournamentIncludesFigureSetSubGroup.list = [];
TournamentIncludesFigureSetSubGroup.options = [];

class HeroscapeTournament extends Tournament {
	constructor(jsonObj) {
		if (Tournament.exists(jsonObj)) {
			return Tournament.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.tournamentID = null; // Int
		this.numArmies = null; // Int
		this.allowedPointOverlap = null; // Int
		this.pointLimit = null; // Int
		this.hexLimit = null; // Int
		this.figureLimit = null; // Int
		this.useDeltaPricing = null; // Boolean
		this.includeVC = null; // Boolean
		this.includeMarvel = null; // Boolean
		
		// Links
		this.links = this.links.concat([]);
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			HeroscapeTournament.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.tournamentID = jsonObj.tournamentID;
			this.numArmies = jsonObj.numArmies;
			this.allowedPointOverlap = jsonObj.allowedPointOverlap;
			this.pointLimit = jsonObj.pointLimit;
			this.hexLimit = jsonObj.hexLimit;
			this.figureLimit = jsonObj.figureLimit;
			this.useDeltaPricing = jsonObj.useDeltaPricing;
			this.includeVC = jsonObj.includeVC;
			this.includeMarvel = jsonObj.includeMarvel;
			
			// Links
			
			HeroscapeTournament.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Heroscape Tournament";
	}

	static primaryKeysWithChildKeys() {
		return ["tournamentID", "id"];
	}

	static getRequiredFields() {
		return this.getTournamentRequiredFields().concat(["tournament", "numArmies", "allowedPointOverlap", "pointLimit", "useDeltaPricing", "includeVC", "includeMarvel"]);
	}

	static getAllFields() {
		return this.getTournamentAllFields().concat(["tournament", "numArmies", "allowedPointOverlap", "pointLimit", "hexLimit", "figureLimit", "useDeltaPricing", "includeVC", "includeMarvel"]);
	}

	static getNtoMLinkClasses() {
		return Object.assign({}, super.getNtoMLinkClasses());
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["tournamentID", "numArmies", "allowedPointOverlap", "pointLimit", "hexLimit", "figureLimit", "useDeltaPricing", "includeVC", "includeMarvel"].includes(columnName)) {
			return HeroscapeTournament;
		}
		return super.getClassOfColumn(columnName);
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "tournamentID":
				return "Tournament";
		}
		return super.getForeignTableNameByKey(columnName);
	}

	static getActionNames() {
		return [].concat(this.TournamentGetActionNames());
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return this.TournamentGetAction(actionName);
		}
	}

	// @DoNotUpdate
	toDisplayString() {
		return super.toDisplayString();
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.tournamentID, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "numArmies":
				return null;
			case "allowedPointOverlap":
				return null;
			case "pointLimit":
				return null;
			case "hexLimit":
				return null;
			case "figureLimit":
				return null;
			case "useDeltaPricing":
				return null;
			case "includeVC":
				return null;
			case "includeMarvel":
				return null;
			default:
				return this.TournamentSelectFilters(property, filterObjects);
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "numArmies":
				return ""; // TODO
			case "allowedPointOverlap":
				return ""; // TODO
			case "pointLimit":
				return ""; // TODO
			case "hexLimit":
				return ""; // TODO
			case "figureLimit":
				return ""; // TODO
			case "useDeltaPricing":
				return ""; // TODO
			case "includeVC":
				return ""; // TODO
			case "includeMarvel":
				return ""; // TODO
			default:
				return this.TournamentGetTooltip(propName);
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = this.TournamentDataForDisplay(forEditing, forCreateForm);
		
		if (HeroscapeTournament.includeField("numArmies", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "numArmies";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Num Armies";
			if (this.numArmies !== null) {
				fieldData["value"] = this.numArmies;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeTournament.includeField("allowedPointOverlap", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "allowedPointOverlap";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Allowed Point Overlap";
			if (this.allowedPointOverlap !== null) {
				fieldData["value"] = this.allowedPointOverlap;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeTournament.includeField("pointLimit", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "pointLimit";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Point Limit";
			if (this.pointLimit !== null) {
				fieldData["value"] = this.pointLimit;
			} else {
				fieldData["inputRequired"] = true;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeTournament.includeField("hexLimit", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "hexLimit";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Hex Limit";
			if (this.hexLimit !== null) {
				fieldData["value"] = this.hexLimit;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeTournament.includeField("figureLimit", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "figureLimit";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "number";
			fieldData["inputNumber_step"] = "1";
			fieldData["label"] = "Figure Limit";
			if (this.figureLimit !== null) {
				fieldData["value"] = this.figureLimit;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeTournament.includeField("useDeltaPricing", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "useDeltaPricing";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Use Delta Pricing";
			if (this.useDeltaPricing !== null) {
				fieldData["value"] = this.useDeltaPricing;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeTournament.includeField("includeVC", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "includeVC";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Include VC";
			if (this.includeVC !== null) {
				fieldData["value"] = this.includeVC;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeTournament.includeField("includeMarvel", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "includeMarvel";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Include Marvel";
			if (this.includeMarvel !== null) {
				fieldData["value"] = this.includeMarvel;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeTournament.options.fieldOrder !== undefined && HeroscapeTournament.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, HeroscapeTournament.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			default:
				this.TournamentSet(field, jsonObj);
				break;
		}
	}

}

HeroscapeTournament.list = [];
HeroscapeTournament.options = [];

class HeroscapeGame extends Game {
	constructor(jsonObj) {
		if (Game.exists(jsonObj)) {
			return Game.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.gameID = null; // Int
		this.map = null; // Int
		this.wentToTime = null; // Boolean
		
		// Links
		this.links = this.links.concat([{heroscapeGamePlayers: HeroscapeGamePlayer, label: "Heroscape Game Players", nTo1Link: true, linkField: 'game'}]);
		this.heroscapeGamePlayers = [];
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			HeroscapeGame.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.gameID = jsonObj.gameID;
			if (jsonObj.map != null) {
				this.map = GameMap.exists(jsonObj.map) ?
					GameMap.get(jsonObj.map) : new GameMap(jsonObj.map);
				if ( ! this.map.heroscapeGames.includes(this)) {
					this.map.heroscapeGames.push(this);
					GameMap.orderBy(this.map.heroscapeGames);
				}
			}
			this.wentToTime = jsonObj.wentToTime;
			
			// Links
			if (jsonObj.heroscapeGamePlayers != undefined && jsonObj.heroscapeGamePlayers != null) {
				for (var i = 0; i < jsonObj.heroscapeGamePlayers.length; i++) {
					if (HeroscapeGamePlayer.exists(jsonObj.heroscapeGamePlayers[i])){
						const newLinkObj = HeroscapeGamePlayer.get(jsonObj.heroscapeGamePlayers[i]);
						var alreadyLinked = false;
						for (let j = 0; j < this.heroscapeGamePlayers.length; j++) {
							if (this.heroscapeGamePlayers[j].id == newLinkObj.id) {
								alreadyLinked = true;
								break;
							}
						}
						if ( ! alreadyLinked) {
							this.heroscapeGamePlayers.push(newLinkObj);
						}
					} else {
						const newForeignObj = new HeroscapeGamePlayer(jsonObj.heroscapeGamePlayers[i]);
						if ( ! this.heroscapeGamePlayers.includes(newForeignObj)) {
							this.heroscapeGamePlayers.push(newForeignObj);
						}
						newForeignObj.game = this;
					}
				}
			}
			HeroscapeGamePlayer.orderBy(this.heroscapeGamePlayers);
			
			HeroscapeGame.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Heroscape Game";
	}

	static primaryKeysWithChildKeys() {
		return ["gameID", "id"];
	}

	static getRequiredFields() {
		return this.getGameRequiredFields().concat(["game", "wentToTime"]);
	}

	static getAllFields() {
		return this.getGameAllFields().concat(["game", "map", "wentToTime"]);
	}

	static getNtoMLinkClasses() {
		return Object.assign({}, super.getNtoMLinkClasses());
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["gameID", "mapID", "wentToTime"].includes(columnName)) {
			return HeroscapeGame;
		}
		return super.getClassOfColumn(columnName);
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "gameID":
				return "Game";
			case "mapID":
				return "GameMap";
		}
		return super.getForeignTableNameByKey(columnName);
	}

	static getActionNames() {
		return [].concat(this.GameGetActionNames());
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return this.GameGetAction(actionName);
		}
	}

	toDisplayString() {
		return this._TODO_;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.gameID, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "_TODO_"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			case "map":
				return null;
			case "wentToTime":
				return null;
			default:
				return this.GameSelectFilters(property, filterObjects);
		}
	}

	getTooltip(propName) {
		switch (propName) {
			case "map":
				return ""; // TODO
			case "wentToTime":
				return ""; // TODO
			default:
				return this.GameGetTooltip(propName);
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = this.GameDataForDisplay(forEditing, forCreateForm);
		
		if (HeroscapeGame.includeField("map", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "map";
			fieldData["elemType"] = "select";
			fieldData["selectOptions"] = GameMap.selectOptions(this.map, this.selectFilters("map", filterObjects));
			fieldData["optionClass"] = "GameMap";
			fieldData["propertyForeignClass"] = GameMap;
			fieldData["label"] = "Map";
			if (this.map !== undefined && this.map !== null) {
				fieldData["value"] = this.map.toDisplayString();
				fieldData["databaseObj"] = this.map;
				fieldData["databaseObjProperty"] = "_TODO_";
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeGame.includeField("wentToTime", forEditing, forCreateForm)) {
			var fieldData = {};
			fieldData["propertyName"] = "wentToTime";
			fieldData["elemType"] = "input";
			fieldData["inputType"] = "checkbox";
			fieldData["label"] = "Went To Time";
			if (this.wentToTime !== null) {
				fieldData["value"] = this.wentToTime;
			} else {
				fieldData["inputRequired"] = false;
			}
			data.push(fieldData);
		}
		
		if (HeroscapeGame.options.fieldOrder !== undefined && HeroscapeGame.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, HeroscapeGame.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			case "map":
				if (typeof jsonObj === "object" && jsonObj instanceof DatabaseObject) {
					this.map = jsonObj;
				} else if (GameMap.exists(jsonObj)) {
					this.map = GameMap.get(jsonObj);
				} else {
					this.map = new GameMap(jsonObj);
				}
				break;
			default:
				this.GameSet(field, jsonObj);
				break;
		}
	}

}

HeroscapeGame.list = [];
HeroscapeGame.options = [];

class GameTournament extends Tournament {
	constructor(jsonObj) {
		if (Tournament.exists(jsonObj)) {
			return Tournament.get(jsonObj);
		}
		
		super(jsonObj);
		
		// Table Columns
		this.tournamentID = null; // Int
		
		// Links
		this.links = this.links.concat([]);
		
		if (jsonObj !== undefined && jsonObj !== null) {
			// Static Variables
			GameTournament.list.push(this);
			
			// Instance Variables
			
			// Table Columns
			this.tournamentID = jsonObj.tournamentID;
			
			// Links
			
			GameTournament.orderBy();
		}
	}

	static getOrderBy() {
		return [];
	}

	static label() {
		return "Game Tournament";
	}

	static primaryKeysWithChildKeys() {
		return ["tournamentID", "id"];
	}

	static getRequiredFields() {
		return this.getTournamentRequiredFields().concat(["tournament"]);
	}

	static getAllFields() {
		return this.getTournamentAllFields().concat(["tournament"]);
	}

	static getNtoMLinkClasses() {
		return Object.assign({}, super.getNtoMLinkClasses());
	}

	static isAbstract() {
		return false;
	}

	static editableOptions() {
		return [""];
	}

	static getClassOfColumn(columnName) {
		if (["tournamentID"].includes(columnName)) {
			return GameTournament;
		}
		return super.getClassOfColumn(columnName);
	}

	static getForeignTableNameByKey(columnName) {
		switch (columnName) {
			case "tournamentID":
				return "Tournament";
		}
		return super.getForeignTableNameByKey(columnName);
	}

	static getActionNames() {
		return [].concat(this.TournamentGetActionNames());
	}

	getAction(actionName) {
		switch (actionName) {
			default:
				return this.TournamentGetAction(actionName);
		}
	}

	toDisplayString() {
		return this.name;
	}

	summary() {
		return "".substring(0, 147)+'...';
	}

	selectOption() {
		return {id: this.tournamentID, value: this.toDisplayString(), databaseObj: this, databaseObjProperty: "name"};
	}

	selectFilters(property, filterObjects) {
		switch (property) {
			default:
				return this.TournamentSelectFilters(property, filterObjects);
		}
	}

	getTooltip(propName) {
		switch (propName) {
			default:
				return this.TournamentGetTooltip(propName);
		}
	}

	dataForDisplay(forEditing, forCreateForm, filterObjects) {
		var data = this.TournamentDataForDisplay(forEditing, forCreateForm);
		
		if (GameTournament.options.fieldOrder !== undefined && GameTournament.options.fieldOrder != null) {
			data = DatabaseObject.reorderData(data, GameTournament.options.fieldOrder);
		}
		return data;
	}

	set(field, jsonObj) {
		switch (field) {
			default:
				this.TournamentSet(field, jsonObj);
				break;
		}
	}

}

GameTournament.list = [];
GameTournament.options = [];


databaseObjectClassMap['ConventionSeriesView'] = ConventionSeriesView;
databaseObjectClassMap['HeadToHeadRecordsView'] = HeadToHeadRecordsView;
databaseObjectClassMap['TournamentOverviewView'] = TournamentOverviewView;
databaseObjectClassMap['ConventionTournamentResultsView'] = ConventionTournamentResultsView;
databaseObjectClassMap['FigureUsageView'] = FigureUsageView;
databaseObjectClassMap['UnitWinRateDeltaView'] = UnitWinRateDeltaView;
databaseObjectClassMap['UnitWinRateStandardView'] = UnitWinRateStandardView;
databaseObjectClassMap['CardUsageByUserView'] = CardUsageByUserView;
databaseObjectClassMap['User'] = User;
databaseObjectClassMap['LoginCredentials'] = LoginCredentials;
databaseObjectClassMap['ConventionSeries'] = ConventionSeries;
databaseObjectClassMap['Convention'] = Convention;
databaseObjectClassMap['Tournament'] = Tournament;
databaseObjectClassMap['Admin'] = Admin;
databaseObjectClassMap['Player'] = Player;
databaseObjectClassMap['PlayerArmy'] = PlayerArmy;
databaseObjectClassMap['Round'] = Round;
databaseObjectClassMap['Game'] = Game;
databaseObjectClassMap['HeroscapeGamePlayer'] = HeroscapeGamePlayer;
databaseObjectClassMap['GameMap'] = GameMap;
databaseObjectClassMap['Attendee'] = Attendee;
databaseObjectClassMap['Bracket'] = Bracket;
databaseObjectClassMap['BracketEntry'] = BracketEntry;
databaseObjectClassMap['League'] = League;
databaseObjectClassMap['Season'] = Season;
databaseObjectClassMap['HeroscapeMap'] = HeroscapeMap;
databaseObjectClassMap['HeroscapeSet'] = HeroscapeSet;
databaseObjectClassMap['HeroscapeMapSet'] = HeroscapeMapSet;
databaseObjectClassMap['HeroscapeMapTag'] = HeroscapeMapTag;
databaseObjectClassMap['HeroscapeMapPreviousVersion'] = HeroscapeMapPreviousVersion;
databaseObjectClassMap['UserPasswordReset'] = UserPasswordReset;
databaseObjectClassMap['FigureSet'] = FigureSet;
databaseObjectClassMap['ConventionMap'] = ConventionMap;
databaseObjectClassMap['Clock'] = Clock;
databaseObjectClassMap['PlayerClock'] = PlayerClock;
databaseObjectClassMap['Glyph'] = Glyph;
databaseObjectClassMap['GameMapGlyph'] = GameMapGlyph;
databaseObjectClassMap['GlyphTag'] = GlyphTag;
databaseObjectClassMap['TournamentFormat'] = TournamentFormat;
databaseObjectClassMap['TournamentFormatTag'] = TournamentFormatTag;
databaseObjectClassMap['UserSetting'] = UserSetting;
databaseObjectClassMap['UserSettingTag'] = UserSettingTag;
databaseObjectClassMap['UserSettingOption'] = UserSettingOption;
databaseObjectClassMap['FigureNickname'] = FigureNickname;
databaseObjectClassMap['Term'] = Term;
databaseObjectClassMap['TerrainType'] = TerrainType;
databaseObjectClassMap['TerrainSize'] = TerrainSize;
databaseObjectClassMap['TerrainPiece'] = TerrainPiece;
databaseObjectClassMap['HeroscapeSetTerrainPieceQuantity'] = HeroscapeSetTerrainPieceQuantity;
databaseObjectClassMap['HeroscapeMapTerrainPieceQuantity'] = HeroscapeMapTerrainPieceQuantity;
databaseObjectClassMap['OnlineMap'] = OnlineMap;
databaseObjectClassMap['OnlineMapTerrainPiece'] = OnlineMapTerrainPiece;
databaseObjectClassMap['MapTournamentUseView'] = MapTournamentUseView;
databaseObjectClassMap['Card'] = Card;
databaseObjectClassMap['CardPower'] = CardPower;
databaseObjectClassMap['ReleaseSet'] = ReleaseSet;
databaseObjectClassMap['DeltaUpdate'] = DeltaUpdate;
databaseObjectClassMap['DeltaUpdateCost'] = DeltaUpdateCost;
databaseObjectClassMap['FigureSetSubGroup'] = FigureSetSubGroup;
databaseObjectClassMap['PowerRankingList'] = PowerRankingList;
databaseObjectClassMap['General'] = General;
databaseObjectClassMap['Homeworld'] = Homeworld;
databaseObjectClassMap['Species'] = Species;
databaseObjectClassMap['CardClass'] = CardClass;
databaseObjectClassMap['Personality'] = Personality;
databaseObjectClassMap['Size'] = Size;
databaseObjectClassMap['CardPowerRanking'] = CardPowerRanking;
databaseObjectClassMap['UserCollectionHeroscapeSet'] = UserCollectionHeroscapeSet;
databaseObjectClassMap['PlayerArmyCard'] = PlayerArmyCard;
databaseObjectClassMap['StandingsView'] = StandingsView;
databaseObjectClassMap['TournamentIncludesFigureSetSubGroup'] = TournamentIncludesFigureSetSubGroup;
databaseObjectClassMap['HeroscapeTournament'] = HeroscapeTournament;
databaseObjectClassMap['HeroscapeGame'] = HeroscapeGame;
databaseObjectClassMap['GameTournament'] = GameTournament;
