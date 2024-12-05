<?php

abstract class Game extends HS_DatabaseObject {
	protected $id; // Int
	protected $roundID; // Int
	protected $onlineUrl; // String

	public static function GameFromDB($childObj, $id) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["Game"])) {
			$OBJECT_MAP["Game"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["Game"][$id])) {
			$obj = $OBJECT_MAP["Game"][$id];
		} else {
			$obj = parent::fromDBHelper($childObj, array("id" => $id));
			$OBJECT_MAP["Game"][$id] = $obj;
		}
		return $obj;
	}

	public static function childFromDB($id) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["Game"])) {
			$OBJECT_MAP["Game"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["Game"][$id])) {
			$obj = $OBJECT_MAP["Game"][$id];
		} else {
			if (HeroscapeGame::exists(array("gameID" => $id))) {
				$obj = HeroscapeGame::fromDB($id);
			}
			$OBJECT_MAP["Game"][$id] = $obj;
		}
		return $obj;
	}

	protected static function createGame($dbObj, $clientDataObj) {
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->round->id)) {
			$clientDataObj->round = Round::create($clientDataObj->round);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("Game",
				array("roundID", "onlineUrl"),
				array($clientDataObj->round->id,
					$clientDataObj->onlineUrl)));
		
		$dbObj->id = $id;
		
		// Abstract, no need to return
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
			$whereArray["{$prefix}Game.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("round", $whereData)) {
				if (isset($whereData["round"]->id)) {
					$whereArray["{$prefix}Game.roundID"] = $whereData["round"]->id;
				} else if ($whereData["round"] == null) {
					$whereArray["{$prefix}Game.roundID"] = null;
				}
			}
			if (isset($whereData["onlineUrl"])) {
				$whereArray["{$prefix}Game.onlineUrl"] = $whereData["onlineUrl"];
			}
		}
		
		if (isset($whereData["round"])) {
			$whereArray = array_merge($whereArray, Round::createWhereArray($whereData["round"], "{$prefix}Game_roundID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("Game.name" => "ASC")
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
		return array("roundID" => "Round");
	}

	public static function getChildClasses() {
		return array("HeroscapeGame");
	}

	public static function getColumnNames() {
		return array("id", "roundID", "onlineUrl");
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
			if (isset($clientDataObj->round, $clientDataObj->round->id) &&
					$clientDataObj->round->id > 0) {
					$this->roundID = $clientDataObj->round->id;
			}
			if (property_exists($clientDataObj, "onlineUrl")) {
				$this->onlineUrl = $clientDataObj->onlineUrl;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->round) && ( ! isset($clientDataObj->updateClasses) || (in_array("Round", $clientDataObj->updateClasses))) && in_array("round", $clientDataObj->fieldsToUpdate) && ! isset($this->roundIDJustCreated)) {
				(Round::fromDB($this->roundID))->updateInDB($clientDataObj->round);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("Game",
				array("roundID", "onlineUrl"),
				array($this->roundID, $this->onlineUrl))->
			where(array("id" => $this->id)));
		
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
			delete("Game")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getRound() {
		if ( ! property_exists($this, "round")) {
			$this->round = Round::fromDB($this->roundID);
		}
		return $this->round;
	}

	/* 'Constructor' only for DB Connection */
	protected static function dbConnection($subdomain = null) {
		return HeroscapeGame::dbConnection($subdomain);
	}

	/* Use "fromDB()" to initialize, not this constructor */
	protected function __construct($subdomain = null) {
		parent::__construct($subdomain);
	}

}


?>
