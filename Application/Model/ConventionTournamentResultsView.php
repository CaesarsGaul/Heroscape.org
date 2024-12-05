<?php

class ConventionTournamentResultsView extends HS_DatabaseObject {
	protected $id; // Int
	protected $Convention_id; // Int
	protected $Tournament_id; // Int
	protected $Tournament_name; // String
	protected $Tournament_description; // String
	protected $Tournament_conventionID; // Int
	protected $Tournament_startTime; // Datetime
	protected $Tournament_endDate; // Date
	protected $Tournament_started; // Boolean
	protected $Tournament_finished; // Boolean
	protected $Tournament_allowSignupAfter; // Datetime
	protected $Tournament_allowLateSignup; // Datetime
	protected $Tournament_online; // Boolean
	protected $Tournament_maxEntries; // Int
	protected $Tournament_teamSize; // Int
	protected $Tournament_maxNumPlayersPerGame; // Int
	protected $Tournament_roundLengthMinutes; // Int
	protected $Tournament_ignoreInStandings; // Boolean
	protected $HeroscapeTournament_tournamentID; // Int
	protected $HeroscapeTournament_numArmies; // Int
	protected $HeroscapeTournament_pointLimit; // Int
	protected $HeroscapeTournament_hexLimit; // Int
	protected $HeroscapeTournament_figureLimit; // Int
	protected $HeroscapeTournament_useDeltaPricing; // Boolean
	protected $HeroscapeTournament_includeVC; // Boolean
	protected $HeroscapeTournament_includeMarvel; // Boolean
	protected $Round_id; // Int
	protected $Round_tournamentID; // Int
	protected $Round_name; // String
	protected $Round_order; // Int
	protected $Round_started; // Boolean
	protected $Game_id; // Int
	protected $Game_roundID; // Int
	protected $HeroscapeGame_gameID; // Int
	protected $HeroscapeGame_mapID; // Int
	protected $HeroscapeGame_wentToTime; // Boolean
	protected $GameMap_id; // Int
	protected $GameMap_name; // String
	protected $GameMap_number; // Int
	protected $GameMap_tournamentID; // Int
	protected $HeroscapeGamePlayer_id; // Int
	protected $HeroscapeGamePlayer_playerID; // Int
	protected $HeroscapeGamePlayer_gameID; // Int
	protected $HeroscapeGamePlayer_result; // Int
	protected $HeroscapeGamePlayer_pointsLeft; // Int
	protected $Player_id; // Int
	protected $Player_name; // String
	protected $Player_userID; // Int
	protected $Player_tournamentID; // Int
	protected $Player_teamCaptainID; // Int
	protected $Player_active; // Boolean
	protected $User_id; // Int
	protected $User_userName; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["ConventionTournamentResultsView"])) {
			$OBJECT_MAP["ConventionTournamentResultsView"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["ConventionTournamentResultsView"][$id])) {
			$obj = $OBJECT_MAP["ConventionTournamentResultsView"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["ConventionTournamentResultsView"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_id($id, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("id" => $id));
	}

	public static function create($clientDataObj, $subdomain=null) {
		// Class represents a view - do nothing here
	}

	protected function createInitialLinks($clientDataObj) {
	}

	/* Public Static Functions */
	
	public static function createWhereArray($whereData, $prefix="") {
		if (is_object($whereData)) {
			if (is_a($whereData, "DatabaseObject")) {
				$whereData = $whereData->toArray();
			} else {
				$whereData = (array)$whereData;
			}
		} else if ($whereData == null) {
			$whereData = array();
		}
		$whereArray = array();
		
		if (isset($whereData["id"])) {
			$whereArray["{$prefix}ConventionTournamentResultsView.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["Convention_id"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Convention_id"] = $whereData["Convention_id"];
			}
			if (isset($whereData["Tournament_id"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_id"] = $whereData["Tournament_id"];
			}
			if (isset($whereData["Tournament_name"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_name"] = $whereData["Tournament_name"];
			}
			if (isset($whereData["Tournament_description"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_description"] = $whereData["Tournament_description"];
			}
			if (isset($whereData["Tournament_conventionID"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_conventionID"] = $whereData["Tournament_conventionID"];
			}
			if (isset($whereData["Tournament_startTime"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_startTime"] = $whereData["Tournament_startTime"];
			}
			if (isset($whereData["Tournament_endDate"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_endDate"] = $whereData["Tournament_endDate"];
			}
			if (isset($whereData["Tournament_started"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_started"] = $whereData["Tournament_started"];
			}
			if (isset($whereData["Tournament_finished"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_finished"] = $whereData["Tournament_finished"];
			}
			if (isset($whereData["Tournament_allowSignupAfter"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_allowSignupAfter"] = $whereData["Tournament_allowSignupAfter"];
			}
			if (isset($whereData["Tournament_allowLateSignup"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_allowLateSignup"] = $whereData["Tournament_allowLateSignup"];
			}
			if (isset($whereData["Tournament_online"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_online"] = $whereData["Tournament_online"];
			}
			if (isset($whereData["Tournament_maxEntries"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_maxEntries"] = $whereData["Tournament_maxEntries"];
			}
			if (isset($whereData["Tournament_teamSize"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_teamSize"] = $whereData["Tournament_teamSize"];
			}
			if (isset($whereData["Tournament_maxNumPlayersPerGame"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_maxNumPlayersPerGame"] = $whereData["Tournament_maxNumPlayersPerGame"];
			}
			if (isset($whereData["Tournament_roundLengthMinutes"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_roundLengthMinutes"] = $whereData["Tournament_roundLengthMinutes"];
			}
			if (isset($whereData["Tournament_ignoreInStandings"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Tournament_ignoreInStandings"] = $whereData["Tournament_ignoreInStandings"];
			}
			if (isset($whereData["HeroscapeTournament_tournamentID"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeTournament_tournamentID"] = $whereData["HeroscapeTournament_tournamentID"];
			}
			if (isset($whereData["HeroscapeTournament_numArmies"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeTournament_numArmies"] = $whereData["HeroscapeTournament_numArmies"];
			}
			if (isset($whereData["HeroscapeTournament_pointLimit"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeTournament_pointLimit"] = $whereData["HeroscapeTournament_pointLimit"];
			}
			if (isset($whereData["HeroscapeTournament_hexLimit"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeTournament_hexLimit"] = $whereData["HeroscapeTournament_hexLimit"];
			}
			if (isset($whereData["HeroscapeTournament_figureLimit"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeTournament_figureLimit"] = $whereData["HeroscapeTournament_figureLimit"];
			}
			if (isset($whereData["HeroscapeTournament_useDeltaPricing"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeTournament_useDeltaPricing"] = $whereData["HeroscapeTournament_useDeltaPricing"];
			}
			if (isset($whereData["HeroscapeTournament_includeVC"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeTournament_includeVC"] = $whereData["HeroscapeTournament_includeVC"];
			}
			if (isset($whereData["HeroscapeTournament_includeMarvel"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeTournament_includeMarvel"] = $whereData["HeroscapeTournament_includeMarvel"];
			}
			if (isset($whereData["Round_id"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Round_id"] = $whereData["Round_id"];
			}
			if (isset($whereData["Round_tournamentID"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Round_tournamentID"] = $whereData["Round_tournamentID"];
			}
			if (isset($whereData["Round_name"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Round_name"] = $whereData["Round_name"];
			}
			if (isset($whereData["Round_order"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Round_order"] = $whereData["Round_order"];
			}
			if (isset($whereData["Round_started"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Round_started"] = $whereData["Round_started"];
			}
			if (isset($whereData["Game_id"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Game_id"] = $whereData["Game_id"];
			}
			if (isset($whereData["Game_roundID"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Game_roundID"] = $whereData["Game_roundID"];
			}
			if (isset($whereData["HeroscapeGame_gameID"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeGame_gameID"] = $whereData["HeroscapeGame_gameID"];
			}
			if (isset($whereData["HeroscapeGame_mapID"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeGame_mapID"] = $whereData["HeroscapeGame_mapID"];
			}
			if (isset($whereData["HeroscapeGame_wentToTime"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeGame_wentToTime"] = $whereData["HeroscapeGame_wentToTime"];
			}
			if (isset($whereData["GameMap_id"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.GameMap_id"] = $whereData["GameMap_id"];
			}
			if (isset($whereData["GameMap_name"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.GameMap_name"] = $whereData["GameMap_name"];
			}
			if (isset($whereData["GameMap_number"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.GameMap_number"] = $whereData["GameMap_number"];
			}
			if (isset($whereData["GameMap_tournamentID"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.GameMap_tournamentID"] = $whereData["GameMap_tournamentID"];
			}
			if (isset($whereData["HeroscapeGamePlayer_id"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeGamePlayer_id"] = $whereData["HeroscapeGamePlayer_id"];
			}
			if (isset($whereData["HeroscapeGamePlayer_playerID"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeGamePlayer_playerID"] = $whereData["HeroscapeGamePlayer_playerID"];
			}
			if (isset($whereData["HeroscapeGamePlayer_gameID"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeGamePlayer_gameID"] = $whereData["HeroscapeGamePlayer_gameID"];
			}
			if (isset($whereData["HeroscapeGamePlayer_result"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeGamePlayer_result"] = $whereData["HeroscapeGamePlayer_result"];
			}
			if (isset($whereData["HeroscapeGamePlayer_pointsLeft"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.HeroscapeGamePlayer_pointsLeft"] = $whereData["HeroscapeGamePlayer_pointsLeft"];
			}
			if (isset($whereData["Player_id"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Player_id"] = $whereData["Player_id"];
			}
			if (isset($whereData["Player_name"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Player_name"] = $whereData["Player_name"];
			}
			if (isset($whereData["Player_userID"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Player_userID"] = $whereData["Player_userID"];
			}
			if (isset($whereData["Player_tournamentID"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Player_tournamentID"] = $whereData["Player_tournamentID"];
			}
			if (isset($whereData["Player_teamCaptainID"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Player_teamCaptainID"] = $whereData["Player_teamCaptainID"];
			}
			if (isset($whereData["Player_active"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.Player_active"] = $whereData["Player_active"];
			}
			if (isset($whereData["User_id"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.User_id"] = $whereData["User_id"];
			}
			if (isset($whereData["User_userName"])) {
				$whereArray["{$prefix}ConventionTournamentResultsView.User_userName"] = $whereData["User_userName"];
			}
		}
		
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("ConventionTournamentResultsView.name" => "ASC")
		return array();
	}

	public static function getPrimaryKey() {
		return "id";
	}

	public static function getNToMLinkClasses() {
		return array();
	}

	public static function getNToMLinkClassesWithType() {
		return array();
	}

	public static function getNToMLinkClassesWithJSVariableName() {
		return array();
	}

	public static function getNTo1LinkClasses() {
		return array();
	}

	public static function getForeignKeys() {
		return array();
	}

	public static function getColumnNames() {
		return array("id", "Convention_id", "Tournament_id", "Tournament_name", "Tournament_description", "Tournament_conventionID", "Tournament_startTime", "Tournament_endDate", "Tournament_started", "Tournament_finished", "Tournament_allowSignupAfter", "Tournament_allowLateSignup", "Tournament_online", "Tournament_maxEntries", "Tournament_teamSize", "Tournament_maxNumPlayersPerGame", "Tournament_roundLengthMinutes", "Tournament_ignoreInStandings", "HeroscapeTournament_tournamentID", "HeroscapeTournament_numArmies", "HeroscapeTournament_pointLimit", "HeroscapeTournament_hexLimit", "HeroscapeTournament_figureLimit", "HeroscapeTournament_useDeltaPricing", "HeroscapeTournament_includeVC", "HeroscapeTournament_includeMarvel", "Round_id", "Round_tournamentID", "Round_name", "Round_order", "Round_started", "Game_id", "Game_roundID", "HeroscapeGame_gameID", "HeroscapeGame_mapID", "HeroscapeGame_wentToTime", "GameMap_id", "GameMap_name", "GameMap_number", "GameMap_tournamentID", "HeroscapeGamePlayer_id", "HeroscapeGamePlayer_playerID", "HeroscapeGamePlayer_gameID", "HeroscapeGamePlayer_result", "HeroscapeGamePlayer_pointsLeft", "Player_id", "Player_name", "Player_userID", "Player_tournamentID", "Player_teamCaptainID", "Player_active", "User_id", "User_userName");
	}

	public static function getActionNames() {
		return array();
	}

	public function performAction($action) {
		switch ($action->name) {
			default:
				return ""; // Do nothing
		}
	}

	public function linkedTo($obj) {
		/*if ($obj instanceof ClassName) {
			// TODO
		}*/
		return false;
	}

	/* Public Dynamic Functions */
	
	public function isEditableByUser() {
		return false;
	}

	public function isViewableByUser() {
		//$user = LoginCredentials::getLoggedInUser();
		return true; // TODO: temporary only
	}

	public static function userCanCreate($implicitObjects=null) {
		return false;
	}

	public function userCanPerformAction($actionName) {
		//$user = LoginCredentials::getLoggedInUser();
		switch ($actionName) {
			default:
				// Do nothing
		}
		return true; // TODO: temporary only
	}

	public function columnIsViewableByUser($columnName) {
		// Default Behavior
		return $this->isViewableByUser();
		// $user = LoginCredentials::getLoggedInUser();
		/*switch ($columnName) {
			case 'columnName':
				break;
		}*/
	}

	public function columnIsEditableByUser($columnName) {
		// Default Behavior
		return $this->isEditableByUser();
		// $user = LoginCredentials::getLoggedInUser();
		/*switch ($columnName) {
			case 'columnName':
				break;
		}*/
	}

	protected function deleteLinks() {
		// N-1 Links
		
		// N-M Links
		return "";
	}

	/* Inherited DatabaseObject Functions */
	
	public function updateInDB($clientDataObj = null) {
		// Class represents a view - do nothing here
	}

	public function deleteInDB() {
		// Class represents a view - do nothing here
	}

	/* Getters */
	
	/* 'Constructor' only for DB Connection */
	protected static function dbConnection($subdomain = null) {
		return new self($subdomain);
	}

	/* Use "fromDB()" to initialize, not this constructor */
	protected function __construct($subdomain = null) {
		parent::__construct($subdomain);
	}

}


?>
