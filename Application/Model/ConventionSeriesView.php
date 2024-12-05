<?php

class ConventionSeriesView extends HS_DatabaseObject {
	protected $id; // Int
	protected $ConventionSeries_id; // Int
	protected $ConventionSeries_name; // String
	protected $Convention_id; // Int
	protected $Convention_name; // String
	protected $Convention_description; // String
	protected $Convention_startDate; // Date
	protected $Convention_endDate; // Date
	protected $Convention_address; // String
	protected $Convention_conventionSeriesID; // Int
	protected $Convention_maxAttendees; // Int
	protected $Tournament_id; // Int
	protected $Tournament_name; // String
	protected $Tournament_conventionID; // Int
	protected $Tournament_started; // Boolean
	protected $Tournament_finished; // Boolean
	protected $Tournament_teamSize; // Int
	protected $Tournament_maxNumPlayersPerGame; // Int
	protected $Tournament_ignoreInStandings; // Boolean
	protected $HeroscapeTournament_tournamentID; // Int
	protected $Player_id; // Int
	protected $Player_name; // String
	protected $Player_userID; // Int
	protected $Player_tournamentID; // Int
	protected $Player_teamCaptainID; // Int
	protected $User_id; // Int
	protected $User_userName; // String
	protected $HeroscapeGamePlayer_id; // Int
	protected $HeroscapeGamePlayer_playerID; // Int
	protected $HeroscapeGamePlayer_gameID; // Int
	protected $HeroscapeGamePlayer_result; // Decimal
	protected $HeroscapeGamePlayer_pointsLeft; // Int
	protected $Game_id; // Int
	protected $HeroscapeGame_gameID; // Int
	protected $HeroscapeGame_wentToTime; // Boolean

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["ConventionSeriesView"])) {
			$OBJECT_MAP["ConventionSeriesView"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["ConventionSeriesView"][$id])) {
			$obj = $OBJECT_MAP["ConventionSeriesView"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["ConventionSeriesView"][$id] = $obj;
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
			$whereArray["{$prefix}ConventionSeriesView.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["ConventionSeries_id"])) {
				$whereArray["{$prefix}ConventionSeriesView.ConventionSeries_id"] = $whereData["ConventionSeries_id"];
			}
			if (isset($whereData["ConventionSeries_name"])) {
				$whereArray["{$prefix}ConventionSeriesView.ConventionSeries_name"] = $whereData["ConventionSeries_name"];
			}
			if (isset($whereData["Convention_id"])) {
				$whereArray["{$prefix}ConventionSeriesView.Convention_id"] = $whereData["Convention_id"];
			}
			if (isset($whereData["Convention_name"])) {
				$whereArray["{$prefix}ConventionSeriesView.Convention_name"] = $whereData["Convention_name"];
			}
			if (isset($whereData["Convention_description"])) {
				$whereArray["{$prefix}ConventionSeriesView.Convention_description"] = $whereData["Convention_description"];
			}
			if (isset($whereData["Convention_startDate"])) {
				$whereArray["{$prefix}ConventionSeriesView.Convention_startDate"] = $whereData["Convention_startDate"];
			}
			if (isset($whereData["Convention_endDate"])) {
				$whereArray["{$prefix}ConventionSeriesView.Convention_endDate"] = $whereData["Convention_endDate"];
			}
			if (isset($whereData["Convention_address"])) {
				$whereArray["{$prefix}ConventionSeriesView.Convention_address"] = $whereData["Convention_address"];
			}
			if (isset($whereData["Convention_conventionSeriesID"])) {
				$whereArray["{$prefix}ConventionSeriesView.Convention_conventionSeriesID"] = $whereData["Convention_conventionSeriesID"];
			}
			if (isset($whereData["Convention_maxAttendees"])) {
				$whereArray["{$prefix}ConventionSeriesView.Convention_maxAttendees"] = $whereData["Convention_maxAttendees"];
			}
			if (isset($whereData["Tournament_id"])) {
				$whereArray["{$prefix}ConventionSeriesView.Tournament_id"] = $whereData["Tournament_id"];
			}
			if (isset($whereData["Tournament_name"])) {
				$whereArray["{$prefix}ConventionSeriesView.Tournament_name"] = $whereData["Tournament_name"];
			}
			if (isset($whereData["Tournament_conventionID"])) {
				$whereArray["{$prefix}ConventionSeriesView.Tournament_conventionID"] = $whereData["Tournament_conventionID"];
			}
			if (isset($whereData["Tournament_started"])) {
				$whereArray["{$prefix}ConventionSeriesView.Tournament_started"] = $whereData["Tournament_started"];
			}
			if (isset($whereData["Tournament_finished"])) {
				$whereArray["{$prefix}ConventionSeriesView.Tournament_finished"] = $whereData["Tournament_finished"];
			}
			if (isset($whereData["Tournament_teamSize"])) {
				$whereArray["{$prefix}ConventionSeriesView.Tournament_teamSize"] = $whereData["Tournament_teamSize"];
			}
			if (isset($whereData["Tournament_maxNumPlayersPerGame"])) {
				$whereArray["{$prefix}ConventionSeriesView.Tournament_maxNumPlayersPerGame"] = $whereData["Tournament_maxNumPlayersPerGame"];
			}
			if (isset($whereData["Tournament_ignoreInStandings"])) {
				$whereArray["{$prefix}ConventionSeriesView.Tournament_ignoreInStandings"] = $whereData["Tournament_ignoreInStandings"];
			}
			if (isset($whereData["HeroscapeTournament_tournamentID"])) {
				$whereArray["{$prefix}ConventionSeriesView.HeroscapeTournament_tournamentID"] = $whereData["HeroscapeTournament_tournamentID"];
			}
			if (isset($whereData["Player_id"])) {
				$whereArray["{$prefix}ConventionSeriesView.Player_id"] = $whereData["Player_id"];
			}
			if (isset($whereData["Player_name"])) {
				$whereArray["{$prefix}ConventionSeriesView.Player_name"] = $whereData["Player_name"];
			}
			if (isset($whereData["Player_userID"])) {
				$whereArray["{$prefix}ConventionSeriesView.Player_userID"] = $whereData["Player_userID"];
			}
			if (isset($whereData["Player_tournamentID"])) {
				$whereArray["{$prefix}ConventionSeriesView.Player_tournamentID"] = $whereData["Player_tournamentID"];
			}
			if (isset($whereData["Player_teamCaptainID"])) {
				$whereArray["{$prefix}ConventionSeriesView.Player_teamCaptainID"] = $whereData["Player_teamCaptainID"];
			}
			if (isset($whereData["User_id"])) {
				$whereArray["{$prefix}ConventionSeriesView.User_id"] = $whereData["User_id"];
			}
			if (isset($whereData["User_userName"])) {
				$whereArray["{$prefix}ConventionSeriesView.User_userName"] = $whereData["User_userName"];
			}
			if (isset($whereData["HeroscapeGamePlayer_id"])) {
				$whereArray["{$prefix}ConventionSeriesView.HeroscapeGamePlayer_id"] = $whereData["HeroscapeGamePlayer_id"];
			}
			if (isset($whereData["HeroscapeGamePlayer_playerID"])) {
				$whereArray["{$prefix}ConventionSeriesView.HeroscapeGamePlayer_playerID"] = $whereData["HeroscapeGamePlayer_playerID"];
			}
			if (isset($whereData["HeroscapeGamePlayer_gameID"])) {
				$whereArray["{$prefix}ConventionSeriesView.HeroscapeGamePlayer_gameID"] = $whereData["HeroscapeGamePlayer_gameID"];
			}
			if (isset($whereData["HeroscapeGamePlayer_result"])) {
				$whereArray["{$prefix}ConventionSeriesView.HeroscapeGamePlayer_result"] = $whereData["HeroscapeGamePlayer_result"];
			}
			if (isset($whereData["HeroscapeGamePlayer_pointsLeft"])) {
				$whereArray["{$prefix}ConventionSeriesView.HeroscapeGamePlayer_pointsLeft"] = $whereData["HeroscapeGamePlayer_pointsLeft"];
			}
			if (isset($whereData["Game_id"])) {
				$whereArray["{$prefix}ConventionSeriesView.Game_id"] = $whereData["Game_id"];
			}
			if (isset($whereData["HeroscapeGame_gameID"])) {
				$whereArray["{$prefix}ConventionSeriesView.HeroscapeGame_gameID"] = $whereData["HeroscapeGame_gameID"];
			}
			if (isset($whereData["HeroscapeGame_wentToTime"])) {
				$whereArray["{$prefix}ConventionSeriesView.HeroscapeGame_wentToTime"] = $whereData["HeroscapeGame_wentToTime"];
			}
		}
		
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("ConventionSeriesView.name" => "ASC")
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
		return array("id", "ConventionSeries_id", "ConventionSeries_name", "Convention_id", "Convention_name", "Convention_description", "Convention_startDate", "Convention_endDate", "Convention_address", "Convention_conventionSeriesID", "Convention_maxAttendees", "Tournament_id", "Tournament_name", "Tournament_conventionID", "Tournament_started", "Tournament_finished", "Tournament_teamSize", "Tournament_maxNumPlayersPerGame", "Tournament_ignoreInStandings", "HeroscapeTournament_tournamentID", "Player_id", "Player_name", "Player_userID", "Player_tournamentID", "Player_teamCaptainID", "User_id", "User_userName", "HeroscapeGamePlayer_id", "HeroscapeGamePlayer_playerID", "HeroscapeGamePlayer_gameID", "HeroscapeGamePlayer_result", "HeroscapeGamePlayer_pointsLeft", "Game_id", "HeroscapeGame_gameID", "HeroscapeGame_wentToTime");
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
	
	// @DoNotUpdate
	public function isEditableByUser() {
		return false;
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return true;
	}

	// @DoNotUpdate
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
