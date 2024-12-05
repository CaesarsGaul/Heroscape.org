<?php

class HeroscapeDiceRoll extends DiceRoll {
	protected $diceRollID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($diceRollID, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["HeroscapeDiceRoll"])) {
			$OBJECT_MAP["HeroscapeDiceRoll"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["HeroscapeDiceRoll"][$diceRollID])) {
			$obj = $OBJECT_MAP["HeroscapeDiceRoll"][$diceRollID];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("diceRollID" => $diceRollID), "DiceRoll", $diceRollID);
			$OBJECT_MAP["HeroscapeDiceRoll"][$diceRollID] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		DiceRoll::createDiceRoll($dbObj, $clientDataObj);
		
		
		
		
		$dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeDiceRoll",
				array("diceRollID"),
				array($dbObj->id)));
		
		$dbObj = self::fromDB($dbObj->id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->heroscapeDices)) {
			foreach ($clientDataObj->heroscapeDices as $clientLinkObj) {
				$clientLinkObj->roll = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		parent::createInitialLinks($clientDataObj);
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
		
		if (isset($whereData["diceRollID"])) {
			$whereArray["{$prefix}HeroscapeDiceRoll.diceRollID"] = $whereData["diceRollID"];
		}
		else {
		}
		
		if (isset($whereData["diceRoll"])) {
			$whereArray = array_merge($whereArray, DiceRoll::createWhereArray($whereData["diceRoll"], "{$prefix}HeroscapeDiceRoll_diceRollID_"));
		}
		
		
		return array_merge($whereArray, parent::createWhereArray($whereData, $prefix));
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("HeroscapeDiceRoll.name" => "ASC")
		return array_merge(array(), parent::getOrderBy());
	}

	public static function getPrimaryKey() {
		return "diceRollID";
	}

	public static function getNToMLinkClasses() {
		return array_merge(array(), parent::getNToMLinkClasses());
	}

	public static function getNToMLinkClassesWithType() {
		return array_merge(array(), parent::getNToMLinkClassesWithType());
	}

	public static function getNToMLinkClassesWithJSVariableName() {
		return array_merge(array(), parent::getNToMLinkClassesWithJSVariableName());
	}

	public static function getNTo1LinkClasses() {
		return array_merge(array("HeroscapeDice" => "rollID"), parent::getNTo1LinkClasses());
	}

	public static function getForeignKeys() {
		return array_merge(array(), parent::getForeignKeys());
	}

	public static function getColumnNames() {
		return array_merge(array("diceRollID"), parent::getColumnNames());
	}

	public static function getActionNames() {
		return array_merge(array(), parent::getActionNames());
	}

	public function performAction($action) {
		switch ($action->name) {
			default:
				return parent::performAction($action);
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
				return parent::userCanPerformAction($actionName);
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
		if (HeroscapeDice::countEntries(array("HeroscapeDice.rollID" => $this->diceRollID)) > 0) {
			return "Unable to delete Heroscape Dice Roll because one or more Heroscape Dice is dependent on it.";
		}
		
		// N-M Links
		return parent::deleteLinks();
	}

	/* Inherited DatabaseObject Functions */
	
	public function updateInDB($clientDataObj = null) {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to update this value.";
		}
		
		if ($this->diceRollID == null) {
			return "Unknown Error";
		}
		
		if ($clientDataObj != null) {
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		// No Columns To Update
		
		// Update 1-N Links
		if (isset($clientDataObj->heroscapeDices) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->heroscapeDices as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = HeroscapeDice::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->roll = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		
		
		return parent::updateInDB($clientDataObj);
	}

	public function deleteInDB() {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to delete this value.";
		}
		
		if ($this->diceRollID == null) {
			return "Unknown Error";
		}
		
		$deleteLinksMsg = $this->deleteLinks();
		if (strlen($deleteLinksMsg) > 0) {
			return $deleteLinksMsg;
		}
		
		$this->dbDelete((new MySQLBuilder())->
			delete("HeroscapeDiceRoll")->
			where(array("diceRollID" => $this->diceRollID)));
		
		return parent::deleteInDB();
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
