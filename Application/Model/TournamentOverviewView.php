<?php

class TournamentOverviewView extends HS_DatabaseObject {
	protected $id; // Int
	protected $HeroscapeTournament_tournamentID; // Int
	protected $HeroscapeTournament_numArmies; // Int
	protected $HeroscapeTournament_allowedPointOverlap; // Int
	protected $HeroscapeTournament_pointLimit; // Int
	protected $HeroscapeTournament_hexLimit; // Int
	protected $HeroscapeTournament_figureLimit; // Int
	protected $HeroscapeTournament_useDeltaPricing; // Boolean
	protected $HeroscapeTournament_includeVC; // Boolean
	protected $HeroscapeTournament_includeMarvel; // Boolean
	protected $Tournament_id; // Int
	protected $Tournament_name; // String
	protected $Tournament_description; // String
	protected $Tournament_conventionID; // Int
	protected $Tournament_startTime; // Datetime
	protected $Tournament_endDate; // Date
	protected $Tournament_address; // String
	protected $Tournament_started; // Boolean
	protected $Tournament_finished; // Boolean
	protected $Tournament_online; // Boolean
	protected $Tournament_maxEntries; // Int
	protected $Tournament_teamSize; // Int
	protected $Tournament_maxNumPlayersPerGame; // Int
	protected $Tournament_numLossesToBeEliminated; // Int
	protected $Tournament_pairAfterEliminated; // Boolean
	protected $Tournament_roundLengthMinutes; // Int
	protected $Tournament_ignoreInStandings; // Boolean
	protected $Season_id; // Int
	protected $Season_name; // String
	protected $Season_leagueID; // Int
	protected $Season_start; // Date
	protected $Season_end; // Date
	protected $Season_description; // String
	protected $League_id; // Int
	protected $League_name; // String
	protected $League_description; // String
	protected $Convention_id; // Int
	protected $Convention_name; // String
	protected $Convention_description; // String
	protected $Convention_startDate; // Date
	protected $Convention_endDate; // Date
	protected $Convention_address; // String
	protected $Convention_conventionSeriesID; // Int
	protected $Convention_maxAttendees; // Int
	protected $ConventionSeries_id; // Int
	protected $ConventionSeries_name; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["TournamentOverviewView"])) {
			$OBJECT_MAP["TournamentOverviewView"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["TournamentOverviewView"][$id])) {
			$obj = $OBJECT_MAP["TournamentOverviewView"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["TournamentOverviewView"][$id] = $obj;
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
	
	// @DoNotUpdate
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
		
		if (isset($whereData["endAfter"])) {
			$whereArray["{$prefix}TournamentOverviewView.Tournament_endDate"] = array(
					"comparison" => ">=", 
					"value" => $whereData["endAfter"]);
		}
		if (isset($whereData["endBefore"])) {
			$whereArray["{$prefix}TournamentOverviewView.Tournament_endDate"] = array(
					"comparison" => "<", 
					"value" => $whereData["endBefore"]);
		}
		if (isset($whereData["startBefore"]) && isset($whereData["startAfter"])) {
			$whereArray["{$prefix}TournamentOverviewView.Tournament_startTime"] = array(
				"comparison" => "<=",
				"value" => $whereData["startBefore"],
				"and" => array(
					"comparison" => ">=",
					"value" => $whereData["startAfter"]
				)
			);
		} else if (isset($whereData["startBefore"])) {
			$whereArray["{$prefix}TournamentOverviewView.Tournament_startTime"] = array(
					"comparison" => "<=", 
					"value" => $whereData["startBefore"]);
		} else if (isset($whereData["startAfter"])) {
			$whereArray["{$prefix}TournamentOverviewView.Tournament_startTime"] = array(
					"comparison" => ">=", 
					"value" => $whereData["startAfter"]);
		} 
		
		if (isset($whereData["id"])) {
			$whereArray["{$prefix}TournamentOverviewView.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["HeroscapeTournament_tournamentID"])) {
				$whereArray["{$prefix}TournamentOverviewView.HeroscapeTournament_tournamentID"] = $whereData["HeroscapeTournament_tournamentID"];
			}
			if (isset($whereData["HeroscapeTournament_numArmies"])) {
				$whereArray["{$prefix}TournamentOverviewView.HeroscapeTournament_numArmies"] = $whereData["HeroscapeTournament_numArmies"];
			}
			if (isset($whereData["HeroscapeTournament_allowedPointOverlap"])) {
				$whereArray["{$prefix}TournamentOverviewView.HeroscapeTournament_allowedPointOverlap"] = $whereData["HeroscapeTournament_allowedPointOverlap"];
			}
			if (isset($whereData["HeroscapeTournament_pointLimit"])) {
				$whereArray["{$prefix}TournamentOverviewView.HeroscapeTournament_pointLimit"] = $whereData["HeroscapeTournament_pointLimit"];
			}
			if (isset($whereData["HeroscapeTournament_hexLimit"])) {
				$whereArray["{$prefix}TournamentOverviewView.HeroscapeTournament_hexLimit"] = $whereData["HeroscapeTournament_hexLimit"];
			}
			if (isset($whereData["HeroscapeTournament_figureLimit"])) {
				$whereArray["{$prefix}TournamentOverviewView.HeroscapeTournament_figureLimit"] = $whereData["HeroscapeTournament_figureLimit"];
			}
			if (isset($whereData["HeroscapeTournament_useDeltaPricing"])) {
				$whereArray["{$prefix}TournamentOverviewView.HeroscapeTournament_useDeltaPricing"] = $whereData["HeroscapeTournament_useDeltaPricing"];
			}
			if (isset($whereData["HeroscapeTournament_includeVC"])) {
				$whereArray["{$prefix}TournamentOverviewView.HeroscapeTournament_includeVC"] = $whereData["HeroscapeTournament_includeVC"];
			}
			if (isset($whereData["HeroscapeTournament_includeMarvel"])) {
				$whereArray["{$prefix}TournamentOverviewView.HeroscapeTournament_includeMarvel"] = $whereData["HeroscapeTournament_includeMarvel"];
			}
			if (isset($whereData["Tournament_id"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_id"] = $whereData["Tournament_id"];
			}
			if (isset($whereData["Tournament_name"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_name"] = $whereData["Tournament_name"];
			}
			if (isset($whereData["Tournament_description"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_description"] = $whereData["Tournament_description"];
			}
			if (isset($whereData["Tournament_conventionID"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_conventionID"] = $whereData["Tournament_conventionID"];
			}
			if (isset($whereData["Tournament_startTime"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_startTime"] = $whereData["Tournament_startTime"];
			}
			if (isset($whereData["Tournament_endDate"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_endDate"] = $whereData["Tournament_endDate"];
			}
			if (isset($whereData["Tournament_address"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_address"] = $whereData["Tournament_address"];
			}
			if (isset($whereData["Tournament_started"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_started"] = $whereData["Tournament_started"];
			}
			if (isset($whereData["Tournament_finished"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_finished"] = $whereData["Tournament_finished"];
			}
			if (isset($whereData["Tournament_online"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_online"] = $whereData["Tournament_online"];
			}
			if (isset($whereData["Tournament_maxEntries"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_maxEntries"] = $whereData["Tournament_maxEntries"];
			}
			if (isset($whereData["Tournament_teamSize"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_teamSize"] = $whereData["Tournament_teamSize"];
			}
			if (isset($whereData["Tournament_maxNumPlayersPerGame"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_maxNumPlayersPerGame"] = $whereData["Tournament_maxNumPlayersPerGame"];
			}
			if (isset($whereData["Tournament_numLossesToBeEliminated"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_numLossesToBeEliminated"] = $whereData["Tournament_numLossesToBeEliminated"];
			}
			if (isset($whereData["Tournament_pairAfterEliminated"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_pairAfterEliminated"] = $whereData["Tournament_pairAfterEliminated"];
			}
			if (isset($whereData["Tournament_roundLengthMinutes"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_roundLengthMinutes"] = $whereData["Tournament_roundLengthMinutes"];
			}
			if (isset($whereData["Tournament_ignoreInStandings"])) {
				$whereArray["{$prefix}TournamentOverviewView.Tournament_ignoreInStandings"] = $whereData["Tournament_ignoreInStandings"];
			}
			if (isset($whereData["Season_id"])) {
				$whereArray["{$prefix}TournamentOverviewView.Season_id"] = $whereData["Season_id"];
			}
			if (isset($whereData["Season_name"])) {
				$whereArray["{$prefix}TournamentOverviewView.Season_name"] = $whereData["Season_name"];
			}
			if (isset($whereData["Season_leagueID"])) {
				$whereArray["{$prefix}TournamentOverviewView.Season_leagueID"] = $whereData["Season_leagueID"];
			}
			if (isset($whereData["Season_start"])) {
				$whereArray["{$prefix}TournamentOverviewView.Season_start"] = $whereData["Season_start"];
			}
			if (isset($whereData["Season_end"])) {
				$whereArray["{$prefix}TournamentOverviewView.Season_end"] = $whereData["Season_end"];
			}
			if (isset($whereData["Season_description"])) {
				$whereArray["{$prefix}TournamentOverviewView.Season_description"] = $whereData["Season_description"];
			}
			if (isset($whereData["League_id"])) {
				$whereArray["{$prefix}TournamentOverviewView.League_id"] = $whereData["League_id"];
			}
			if (isset($whereData["League_name"])) {
				$whereArray["{$prefix}TournamentOverviewView.League_name"] = $whereData["League_name"];
			}
			if (isset($whereData["League_description"])) {
				$whereArray["{$prefix}TournamentOverviewView.League_description"] = $whereData["League_description"];
			}
			if (isset($whereData["Convention_id"])) {
				$whereArray["{$prefix}TournamentOverviewView.Convention_id"] = $whereData["Convention_id"];
			}
			if (isset($whereData["Convention_name"])) {
				$whereArray["{$prefix}TournamentOverviewView.Convention_name"] = $whereData["Convention_name"];
			}
			if (isset($whereData["Convention_description"])) {
				$whereArray["{$prefix}TournamentOverviewView.Convention_description"] = $whereData["Convention_description"];
			}
			if (isset($whereData["Convention_startDate"])) {
				$whereArray["{$prefix}TournamentOverviewView.Convention_startDate"] = $whereData["Convention_startDate"];
			}
			if (isset($whereData["Convention_endDate"])) {
				$whereArray["{$prefix}TournamentOverviewView.Convention_endDate"] = $whereData["Convention_endDate"];
			}
			if (isset($whereData["Convention_address"])) {
				$whereArray["{$prefix}TournamentOverviewView.Convention_address"] = $whereData["Convention_address"];
			}
			if (isset($whereData["Convention_conventionSeriesID"])) {
				$whereArray["{$prefix}TournamentOverviewView.Convention_conventionSeriesID"] = $whereData["Convention_conventionSeriesID"];
			}
			if (isset($whereData["Convention_maxAttendees"])) {
				$whereArray["{$prefix}TournamentOverviewView.Convention_maxAttendees"] = $whereData["Convention_maxAttendees"];
			}
			if (isset($whereData["ConventionSeries_id"])) {
				$whereArray["{$prefix}TournamentOverviewView.ConventionSeries_id"] = $whereData["ConventionSeries_id"];
			}
			if (isset($whereData["ConventionSeries_name"])) {
				$whereArray["{$prefix}TournamentOverviewView.ConventionSeries_name"] = $whereData["ConventionSeries_name"];
			}
		}
		
		
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array("TournamentOverView.tournament_startTime" => "ASC");
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
		return array("id", "HeroscapeTournament_tournamentID", "HeroscapeTournament_numArmies", "HeroscapeTournament_allowedPointOverlap", "HeroscapeTournament_pointLimit", "HeroscapeTournament_hexLimit", "HeroscapeTournament_figureLimit", "HeroscapeTournament_useDeltaPricing", "HeroscapeTournament_includeVC", "HeroscapeTournament_includeMarvel", "Tournament_id", "Tournament_name", "Tournament_description", "Tournament_conventionID", "Tournament_startTime", "Tournament_endDate", "Tournament_address", "Tournament_started", "Tournament_finished", "Tournament_online", "Tournament_maxEntries", "Tournament_teamSize", "Tournament_maxNumPlayersPerGame", "Tournament_numLossesToBeEliminated", "Tournament_pairAfterEliminated", "Tournament_roundLengthMinutes", "Tournament_ignoreInStandings", "Season_id", "Season_name", "Season_leagueID", "Season_start", "Season_end", "Season_description", "League_id", "League_name", "League_description", "Convention_id", "Convention_name", "Convention_description", "Convention_startDate", "Convention_endDate", "Convention_address", "Convention_conventionSeriesID", "Convention_maxAttendees", "ConventionSeries_id", "ConventionSeries_name");
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
