<?php

class HeroscapeDice extends HS_DatabaseObject {
	protected $id; // Int
	protected $rollID; // Int
	protected $outcomeID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["HeroscapeDice"])) {
			$OBJECT_MAP["HeroscapeDice"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["HeroscapeDice"][$id])) {
			$obj = $OBJECT_MAP["HeroscapeDice"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["HeroscapeDice"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->roll->diceRollID)) {
			$clientDataObj->roll = HeroscapeDiceRoll::create($clientDataObj->roll);
		}
		if ( ! isset($clientDataObj->outcome->id)) {
			$clientDataObj->outcome = HeroscapeDiceOutcome::create($clientDataObj->outcome);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeDice",
				array("rollID", "outcomeID"),
				array($clientDataObj->roll->diceRollID,
					$clientDataObj->outcome->id)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
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
			$whereArray["{$prefix}HeroscapeDice.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("roll", $whereData)) {
				if (isset($whereData["roll"]->diceRollID)) {
					$whereArray["{$prefix}HeroscapeDice.rollID"] = $whereData["roll"]->diceRollID;
				} else if ($whereData["roll"] == null) {
					$whereArray["{$prefix}HeroscapeDice.rollID"] = null;
				}
			}
			if (array_key_exists("outcome", $whereData)) {
				if (isset($whereData["outcome"]->id)) {
					$whereArray["{$prefix}HeroscapeDice.outcomeID"] = $whereData["outcome"]->id;
				} else if ($whereData["outcome"] == null) {
					$whereArray["{$prefix}HeroscapeDice.outcomeID"] = null;
				}
			}
		}
		
		if (isset($whereData["roll"])) {
			$whereArray = array_merge($whereArray, HeroscapeDiceRoll::createWhereArray($whereData["roll"], "{$prefix}HeroscapeDice_rollID_"));
		}
		if (isset($whereData["outcome"])) {
			$whereArray = array_merge($whereArray, HeroscapeDiceOutcome::createWhereArray($whereData["outcome"], "{$prefix}HeroscapeDice_outcomeID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("HeroscapeDice.name" => "ASC")
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
		return array("rollID" => "HeroscapeDiceRoll", "outcomeID" => "HeroscapeDiceOutcome");
	}

	public static function getColumnNames() {
		return array("id", "rollID", "outcomeID");
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
			if (isset($clientDataObj->roll, $clientDataObj->roll->diceRollID) &&
					$clientDataObj->roll->diceRollID > 0) {
					$this->rollID = $clientDataObj->roll->diceRollID;
			}
			if (isset($clientDataObj->outcome, $clientDataObj->outcome->id) &&
					$clientDataObj->outcome->id > 0) {
					$this->outcomeID = $clientDataObj->outcome->id;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->roll) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeDiceRoll", $clientDataObj->updateClasses))) && in_array("roll", $clientDataObj->fieldsToUpdate) && ! isset($this->rollIDJustCreated)) {
				(HeroscapeDiceRoll::fromDB($this->rollID))->updateInDB($clientDataObj->roll);
			}
			if (isset($clientDataObj->outcome) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeDiceOutcome", $clientDataObj->updateClasses))) && in_array("outcome", $clientDataObj->fieldsToUpdate) && ! isset($this->outcomeIDJustCreated)) {
				(HeroscapeDiceOutcome::fromDB($this->outcomeID))->updateInDB($clientDataObj->outcome);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("HeroscapeDice",
				array("rollID", "outcomeID"),
				array($this->rollID, $this->outcomeID))->
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
		
		$deleteLinksMsg = $this->deleteLinks();
		if (strlen($deleteLinksMsg) > 0) {
			return $deleteLinksMsg;
		}
		
		$this->dbDelete((new MySQLBuilder())->
			delete("HeroscapeDice")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getRoll() {
		if ( ! property_exists($this, "roll")) {
			$this->roll = HeroscapeDiceRoll::fromDB($this->rollID);
		}
		return $this->roll;
	}

	public function getOutcome() {
		if ( ! property_exists($this, "outcome")) {
			$this->outcome = HeroscapeDiceOutcome::fromDB($this->outcomeID);
		}
		return $this->outcome;
	}

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
