<?php

class D20Roll extends DiceRoll {
	protected $diceRollID; // Int
	protected $number; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($diceRollID, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["D20Roll"])) {
			$OBJECT_MAP["D20Roll"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["D20Roll"][$diceRollID])) {
			$obj = $OBJECT_MAP["D20Roll"][$diceRollID];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("diceRollID" => $diceRollID), "DiceRoll", $diceRollID);
			$OBJECT_MAP["D20Roll"][$diceRollID] = $obj;
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
			insert("D20Roll",
				array("diceRollID", "number"),
				array($dbObj->id,
					$clientDataObj->number)));
		
		$dbObj = self::fromDB($dbObj->id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->onlineGameOrderMarkerss)) {
			foreach ($clientDataObj->onlineGameOrderMarkerss as $clientLinkObj) {
				$clientLinkObj->initiative = $this;
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
			$whereArray["{$prefix}D20Roll.diceRollID"] = $whereData["diceRollID"];
		}
		else {
			if (isset($whereData["number"])) {
				$whereArray["{$prefix}D20Roll.number"] = $whereData["number"];
			}
		}
		
		if (isset($whereData["diceRoll"])) {
			$whereArray = array_merge($whereArray, DiceRoll::createWhereArray($whereData["diceRoll"], "{$prefix}D20Roll_diceRollID_"));
		}
		
		
		return array_merge($whereArray, parent::createWhereArray($whereData, $prefix));
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("D20Roll.name" => "ASC")
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
		return array_merge(array("OnlineGameOrderMarkers" => "initiativeID"), parent::getNTo1LinkClasses());
	}

	public static function getForeignKeys() {
		return array_merge(array(), parent::getForeignKeys());
	}

	public static function getColumnNames() {
		return array_merge(array("diceRollID", "number"), parent::getColumnNames());
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
		if (OnlineGameOrderMarkers::countEntries(array("OnlineGameOrderMarkers.initiativeID" => $this->diceRollID)) > 0) {
			return "Unable to delete D20 Roll because one or more Online Game Order Markers is dependent on it.";
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
			if (isset($clientDataObj->number)) {
				$this->number = $clientDataObj->number;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("D20Roll",
				array("number"),
				array($this->number))->
			where(array("diceRollID" => $this->diceRollID)));
		
		// Update 1-N Links
		if (isset($clientDataObj->onlineGameOrderMarkerss) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineGameOrderMarkerss as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineGameOrderMarkers::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->initiative = $this;
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
			delete("D20Roll")->
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
