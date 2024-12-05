<?php

class MapTournamentUseView extends HS_DatabaseObject {
	protected $id; // Int
	protected $Tournament_id; // Int
	protected $Tournament_name; // String
	protected $Tournament_conventionID; // Int
	protected $HeroscapeTournament_tournamentID; // Int
	protected $GameMap_id; // Int
	protected $GameMap_name; // String
	protected $GameMap_tournamentID; // Int
	protected $Game_id; // Int
	protected $HeroscapeGame_gameID; // Int
	protected $HeroscapeGame_mapID; // Int
	protected $Convention_id; // Int
	protected $Convention_name; // String
	protected $Season_id; // Int
	protected $Season_name; // String
	protected $Season_leagueID; // Int
	protected $League_id; // Int
	protected $League_name; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["MapTournamentUseView"])) {
			$OBJECT_MAP["MapTournamentUseView"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["MapTournamentUseView"][$id])) {
			$obj = $OBJECT_MAP["MapTournamentUseView"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["MapTournamentUseView"][$id] = $obj;
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
			$whereArray["{$prefix}MapTournamentUseView.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["Tournament_id"])) {
				$whereArray["{$prefix}MapTournamentUseView.Tournament_id"] = $whereData["Tournament_id"];
			}
			if (isset($whereData["Tournament_name"])) {
				$whereArray["{$prefix}MapTournamentUseView.Tournament_name"] = $whereData["Tournament_name"];
			}
			if (isset($whereData["Tournament_conventionID"])) {
				$whereArray["{$prefix}MapTournamentUseView.Tournament_conventionID"] = $whereData["Tournament_conventionID"];
			}
			if (isset($whereData["HeroscapeTournament_tournamentID"])) {
				$whereArray["{$prefix}MapTournamentUseView.HeroscapeTournament_tournamentID"] = $whereData["HeroscapeTournament_tournamentID"];
			}
			if (isset($whereData["GameMap_id"])) {
				$whereArray["{$prefix}MapTournamentUseView.GameMap_id"] = $whereData["GameMap_id"];
			}
			if (isset($whereData["GameMap_name"])) {
				$whereArray["{$prefix}MapTournamentUseView.GameMap_name"] = $whereData["GameMap_name"];
			}
			if (isset($whereData["GameMap_tournamentID"])) {
				$whereArray["{$prefix}MapTournamentUseView.GameMap_tournamentID"] = $whereData["GameMap_tournamentID"];
			}
			if (isset($whereData["Game_id"])) {
				$whereArray["{$prefix}MapTournamentUseView.Game_id"] = $whereData["Game_id"];
			}
			if (isset($whereData["HeroscapeGame_gameID"])) {
				$whereArray["{$prefix}MapTournamentUseView.HeroscapeGame_gameID"] = $whereData["HeroscapeGame_gameID"];
			}
			if (isset($whereData["HeroscapeGame_mapID"])) {
				$whereArray["{$prefix}MapTournamentUseView.HeroscapeGame_mapID"] = $whereData["HeroscapeGame_mapID"];
			}
			if (isset($whereData["Convention_id"])) {
				$whereArray["{$prefix}MapTournamentUseView.Convention_id"] = $whereData["Convention_id"];
			}
			if (isset($whereData["Convention_name"])) {
				$whereArray["{$prefix}MapTournamentUseView.Convention_name"] = $whereData["Convention_name"];
			}
			if (isset($whereData["Season_id"])) {
				$whereArray["{$prefix}MapTournamentUseView.Season_id"] = $whereData["Season_id"];
			}
			if (isset($whereData["Season_name"])) {
				$whereArray["{$prefix}MapTournamentUseView.Season_name"] = $whereData["Season_name"];
			}
			if (isset($whereData["Season_leagueID"])) {
				$whereArray["{$prefix}MapTournamentUseView.Season_leagueID"] = $whereData["Season_leagueID"];
			}
			if (isset($whereData["League_id"])) {
				$whereArray["{$prefix}MapTournamentUseView.League_id"] = $whereData["League_id"];
			}
			if (isset($whereData["League_name"])) {
				$whereArray["{$prefix}MapTournamentUseView.League_name"] = $whereData["League_name"];
			}
		}
		
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("MapTournamentUseView.name" => "ASC")
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
		return array("id", "Tournament_id", "Tournament_name", "Tournament_conventionID", "HeroscapeTournament_tournamentID", "GameMap_id", "GameMap_name", "GameMap_tournamentID", "Game_id", "HeroscapeGame_gameID", "HeroscapeGame_mapID", "Convention_id", "Convention_name", "Season_id", "Season_name", "Season_leagueID", "League_id", "League_name");
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
