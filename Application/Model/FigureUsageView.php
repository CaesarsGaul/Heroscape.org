<?php

class FigureUsageView extends HS_DatabaseObject {
	protected $id; // Int
	protected $PlayerArmyCard_id; // Int
	protected $PlayerArmyCard_playerArmyID; // Int
	protected $PlayerArmyCard_cardID; // Int
	protected $PlayerArmyCard_quantity; // Int
	protected $Card_id; // Int
	protected $Card_name; // String
	protected $PlayerArmy_id; // Int
	protected $PlayerArmy_armyNumber; // Int
	protected $PlayerArmy_playerID; // Int
	protected $PlayerArmy_army; // String
	protected $Player_id; // Int
	protected $Player_name; // String
	protected $Player_userID; // Int
	protected $Player_tournamentID; // Int
	protected $Player_active; // Boolean
	protected $Tournament_id; // Int
	protected $Tournament_name; // String
	protected $Tournament_startTime; // Datetime
	protected $Tournament_endDate; // Date
	protected $Tournament_started; // Boolean
	protected $Tournament_finished; // Boolean
	protected $Tournament_maxNumPlayersPerGame; // Int
	protected $Tournament_figureSetID; // Int
	protected $HeroscapeTournament_tournamentID; // Int
	protected $HeroscapeTournament_numArmies; // Int
	protected $HeroscapeTournament_useDeltaPricing; // Boolean
	protected $HeroscapeTournament_includeVC; // Boolean
	protected $HeroscapeTournament_includeMarvel; // Boolean

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["FigureUsageView"])) {
			$OBJECT_MAP["FigureUsageView"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["FigureUsageView"][$id])) {
			$obj = $OBJECT_MAP["FigureUsageView"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["FigureUsageView"][$id] = $obj;
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
			$whereArray["{$prefix}FigureUsageView.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["PlayerArmyCard_id"])) {
				$whereArray["{$prefix}FigureUsageView.PlayerArmyCard_id"] = $whereData["PlayerArmyCard_id"];
			}
			if (isset($whereData["PlayerArmyCard_playerArmyID"])) {
				$whereArray["{$prefix}FigureUsageView.PlayerArmyCard_playerArmyID"] = $whereData["PlayerArmyCard_playerArmyID"];
			}
			if (isset($whereData["PlayerArmyCard_cardID"])) {
				$whereArray["{$prefix}FigureUsageView.PlayerArmyCard_cardID"] = $whereData["PlayerArmyCard_cardID"];
			}
			if (isset($whereData["PlayerArmyCard_quantity"])) {
				$whereArray["{$prefix}FigureUsageView.PlayerArmyCard_quantity"] = $whereData["PlayerArmyCard_quantity"];
			}
			if (isset($whereData["Card_id"])) {
				$whereArray["{$prefix}FigureUsageView.Card_id"] = $whereData["Card_id"];
			}
			if (isset($whereData["Card_name"])) {
				$whereArray["{$prefix}FigureUsageView.Card_name"] = $whereData["Card_name"];
			}
			if (isset($whereData["PlayerArmy_id"])) {
				$whereArray["{$prefix}FigureUsageView.PlayerArmy_id"] = $whereData["PlayerArmy_id"];
			}
			if (isset($whereData["PlayerArmy_armyNumber"])) {
				$whereArray["{$prefix}FigureUsageView.PlayerArmy_armyNumber"] = $whereData["PlayerArmy_armyNumber"];
			}
			if (isset($whereData["PlayerArmy_playerID"])) {
				$whereArray["{$prefix}FigureUsageView.PlayerArmy_playerID"] = $whereData["PlayerArmy_playerID"];
			}
			if (isset($whereData["PlayerArmy_army"])) {
				$whereArray["{$prefix}FigureUsageView.PlayerArmy_army"] = $whereData["PlayerArmy_army"];
			}
			if (isset($whereData["Player_id"])) {
				$whereArray["{$prefix}FigureUsageView.Player_id"] = $whereData["Player_id"];
			}
			if (isset($whereData["Player_name"])) {
				$whereArray["{$prefix}FigureUsageView.Player_name"] = $whereData["Player_name"];
			}
			if (isset($whereData["Player_userID"])) {
				$whereArray["{$prefix}FigureUsageView.Player_userID"] = $whereData["Player_userID"];
			}
			if (isset($whereData["Player_tournamentID"])) {
				$whereArray["{$prefix}FigureUsageView.Player_tournamentID"] = $whereData["Player_tournamentID"];
			}
			if (isset($whereData["Player_active"])) {
				$whereArray["{$prefix}FigureUsageView.Player_active"] = $whereData["Player_active"];
			}
			if (isset($whereData["Tournament_id"])) {
				$whereArray["{$prefix}FigureUsageView.Tournament_id"] = $whereData["Tournament_id"];
			}
			if (isset($whereData["Tournament_name"])) {
				$whereArray["{$prefix}FigureUsageView.Tournament_name"] = $whereData["Tournament_name"];
			}
			if (isset($whereData["Tournament_startTime"])) {
				$whereArray["{$prefix}FigureUsageView.Tournament_startTime"] = $whereData["Tournament_startTime"];
			}
			if (isset($whereData["Tournament_endDate"])) {
				$whereArray["{$prefix}FigureUsageView.Tournament_endDate"] = $whereData["Tournament_endDate"];
			}
			if (isset($whereData["Tournament_started"])) {
				$whereArray["{$prefix}FigureUsageView.Tournament_started"] = $whereData["Tournament_started"];
			}
			if (isset($whereData["Tournament_finished"])) {
				$whereArray["{$prefix}FigureUsageView.Tournament_finished"] = $whereData["Tournament_finished"];
			}
			if (isset($whereData["Tournament_maxNumPlayersPerGame"])) {
				$whereArray["{$prefix}FigureUsageView.Tournament_maxNumPlayersPerGame"] = $whereData["Tournament_maxNumPlayersPerGame"];
			}
			if (isset($whereData["Tournament_figureSetID"])) {
				$whereArray["{$prefix}FigureUsageView.Tournament_figureSetID"] = $whereData["Tournament_figureSetID"];
			}
			if (isset($whereData["HeroscapeTournament_tournamentID"])) {
				$whereArray["{$prefix}FigureUsageView.HeroscapeTournament_tournamentID"] = $whereData["HeroscapeTournament_tournamentID"];
			}
			if (isset($whereData["HeroscapeTournament_numArmies"])) {
				$whereArray["{$prefix}FigureUsageView.HeroscapeTournament_numArmies"] = $whereData["HeroscapeTournament_numArmies"];
			}
			if (isset($whereData["HeroscapeTournament_useDeltaPricing"])) {
				$whereArray["{$prefix}FigureUsageView.HeroscapeTournament_useDeltaPricing"] = $whereData["HeroscapeTournament_useDeltaPricing"];
			}
			if (isset($whereData["HeroscapeTournament_includeVC"])) {
				$whereArray["{$prefix}FigureUsageView.HeroscapeTournament_includeVC"] = $whereData["HeroscapeTournament_includeVC"];
			}
			if (isset($whereData["HeroscapeTournament_includeMarvel"])) {
				$whereArray["{$prefix}FigureUsageView.HeroscapeTournament_includeMarvel"] = $whereData["HeroscapeTournament_includeMarvel"];
			}
		}
		
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("FigureUsageView.name" => "ASC")
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
		return array("id", "PlayerArmyCard_id", "PlayerArmyCard_playerArmyID", "PlayerArmyCard_cardID", "PlayerArmyCard_quantity", "Card_id", "Card_name", "PlayerArmy_id", "PlayerArmy_armyNumber", "PlayerArmy_playerID", "PlayerArmy_army", "Player_id", "Player_name", "Player_userID", "Player_tournamentID", "Player_active", "Tournament_id", "Tournament_name", "Tournament_startTime", "Tournament_endDate", "Tournament_started", "Tournament_finished", "Tournament_maxNumPlayersPerGame", "Tournament_figureSetID", "HeroscapeTournament_tournamentID", "HeroscapeTournament_numArmies", "HeroscapeTournament_useDeltaPricing", "HeroscapeTournament_includeVC", "HeroscapeTournament_includeMarvel");
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
