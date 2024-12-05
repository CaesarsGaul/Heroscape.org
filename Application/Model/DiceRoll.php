<?php

abstract class DiceRoll extends HS_DatabaseObject {
	protected $id; // Int
	protected $gameStateID; // Int
	protected $timestamp; // Datetime

	public static function DiceRollFromDB($childObj, $id) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["DiceRoll"])) {
			$OBJECT_MAP["DiceRoll"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["DiceRoll"][$id])) {
			$obj = $OBJECT_MAP["DiceRoll"][$id];
		} else {
			$obj = parent::fromDBHelper($childObj, array("id" => $id));
			$OBJECT_MAP["DiceRoll"][$id] = $obj;
		}
		return $obj;
	}

	public static function childFromDB($id) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["DiceRoll"])) {
			$OBJECT_MAP["DiceRoll"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["DiceRoll"][$id])) {
			$obj = $OBJECT_MAP["DiceRoll"][$id];
		} else {
			if (D20Roll::exists(array("diceRollID" => $id))) {
				$obj = D20Roll::fromDB($id);
			}
			if (HeroscapeDiceRoll::exists(array("diceRollID" => $id))) {
				$obj = HeroscapeDiceRoll::fromDB($id);
			}
			$OBJECT_MAP["DiceRoll"][$id] = $obj;
		}
		return $obj;
	}

	protected static function createDiceRoll($dbObj, $clientDataObj) {
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->gameState->id)) {
			$clientDataObj->gameState = OnlineGameState::create($clientDataObj->gameState);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("DiceRoll",
				array("gameStateID", "timestamp"),
				array($clientDataObj->gameState->id,
					$clientDataObj->timestamp)));
		
		$dbObj->id = $id;
		
		// Abstract, no need to return
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->onlineGameAttacks)) {
			foreach ($clientDataObj->onlineGameAttacks as $clientLinkObj) {
				$clientLinkObj->attackRoll = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
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
			$whereArray["{$prefix}DiceRoll.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("gameState", $whereData)) {
				if (isset($whereData["gameState"]->id)) {
					$whereArray["{$prefix}DiceRoll.gameStateID"] = $whereData["gameState"]->id;
				} else if ($whereData["gameState"] == null) {
					$whereArray["{$prefix}DiceRoll.gameStateID"] = null;
				}
			}
			if (isset($whereData["timestamp"])) {
				$whereArray["{$prefix}DiceRoll.timestamp"] = $whereData["timestamp"];
			}
		}
		
		if (isset($whereData["gameState"])) {
			$whereArray = array_merge($whereArray, OnlineGameState::createWhereArray($whereData["gameState"], "{$prefix}DiceRoll_gameStateID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("DiceRoll.name" => "ASC")
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
		return array("OnlineGameAttack" => "attackRollID");
	}

	public static function getForeignKeys() {
		return array("gameStateID" => "OnlineGameState");
	}

	public static function getChildClasses() {
		return array("D20Roll", "HeroscapeDiceRoll");
	}

	public static function getColumnNames() {
		return array("id", "gameStateID", "timestamp");
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
		//$user = LoginCredentials::getLoggedInUser();
		return false; // TODO: temporary only
		// TODO: return $user->TODO();
	}

	public function isViewableByUser() {
		//$user = LoginCredentials::getLoggedInUser();
		return true; // TODO: temporary only
	}

	public static function userCanCreate($implicitObjects=null) {
		//$user = LoginCredentials::getLoggedInUser();
		return true; // TODO: temporary only
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
		if (OnlineGameAttack::countEntries(array("OnlineGameAttack.attackRollID" => $this->id)) > 0) {
			return "Unable to delete Dice Roll because one or more Online Game Attack is dependent on it.";
		}
		
		// N-M Links
		return "";
	}

	/* Inherited DatabaseObject Functions */
	
	public function updateInDB($clientDataObj = null) {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to update this value.";
		}
		
		if ($this->id == null) {
			return "Unknown Error";
		}
		
		if ($clientDataObj != null) {
			if (isset($clientDataObj->gameState, $clientDataObj->gameState->id) &&
					$clientDataObj->gameState->id > 0) {
					$this->gameStateID = $clientDataObj->gameState->id;
			}
			if (isset($clientDataObj->timestamp)) {
				$this->timestamp = $clientDataObj->timestamp;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->gameState) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGameState", $clientDataObj->updateClasses))) && in_array("gameState", $clientDataObj->fieldsToUpdate) && ! isset($this->gameStateIDJustCreated)) {
				(OnlineGameState::fromDB($this->gameStateID))->updateInDB($clientDataObj->gameState);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("DiceRoll",
				array("gameStateID", "timestamp"),
				array($this->gameStateID, $this->timestamp))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->onlineGameAttacks) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineGameAttacks as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineGameAttack::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->attackRoll = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		
		
		return "";
	}

	public function deleteInDB() {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to delete this value.";
		}
		
		if ($this->id == null) {
			return "Unknown Error";
		}
		
		
		$this->dbDelete((new MySQLBuilder())->
			delete("DiceRoll")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getGameState() {
		if ( ! property_exists($this, "gameState")) {
			$this->gameState = OnlineGameState::fromDB($this->gameStateID);
		}
		return $this->gameState;
	}

	/* 'Constructor' only for DB Connection */
	protected static function dbConnection($subdomain = null) {
		return D20Roll::dbConnection($subdomain);
	}

	/* Use "fromDB()" to initialize, not this constructor */
	protected function __construct($subdomain = null) {
		parent::__construct($subdomain);
	}

}


?>
