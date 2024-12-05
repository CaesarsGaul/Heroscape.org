<?php

class PlayerClock extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $timeInSeconds; // Int
	protected $clockID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["PlayerClock"])) {
			$OBJECT_MAP["PlayerClock"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["PlayerClock"][$id])) {
			$obj = $OBJECT_MAP["PlayerClock"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["PlayerClock"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->clock->id)) {
			$clientDataObj->clock = Clock::create($clientDataObj->clock);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("PlayerClock",
				array("name", "timeInSeconds", "clockID"),
				array($clientDataObj->name,
					$clientDataObj->timeInSeconds,
					$clientDataObj->clock->id)));
		
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
			$whereArray["{$prefix}PlayerClock.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}PlayerClock.name"] = $whereData["name"];
			}
			if (isset($whereData["timeInSeconds"])) {
				$whereArray["{$prefix}PlayerClock.timeInSeconds"] = $whereData["timeInSeconds"];
			}
			if (array_key_exists("clock", $whereData)) {
				if (isset($whereData["clock"]->id)) {
					$whereArray["{$prefix}PlayerClock.clockID"] = $whereData["clock"]->id;
				} else if ($whereData["clock"] == null) {
					$whereArray["{$prefix}PlayerClock.clockID"] = null;
				}
			}
		}
		
		if (isset($whereData["clock"])) {
			$whereArray = array_merge($whereArray, Clock::createWhereArray($whereData["clock"], "{$prefix}PlayerClock_clockID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("PlayerClock.name" => "ASC")
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
		return array("clockID" => "Clock");
	}

	public static function getColumnNames() {
		return array("id", "name", "timeInSeconds", "clockID");
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
			if (isset($clientDataObj->name)) {
				$this->name = $clientDataObj->name;
			}
			if (isset($clientDataObj->timeInSeconds)) {
				$this->timeInSeconds = $clientDataObj->timeInSeconds;
			}
			if (isset($clientDataObj->clock, $clientDataObj->clock->id) &&
					$clientDataObj->clock->id > 0) {
					$this->clockID = $clientDataObj->clock->id;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->clock) && ( ! isset($clientDataObj->updateClasses) || (in_array("Clock", $clientDataObj->updateClasses))) && in_array("clock", $clientDataObj->fieldsToUpdate) && ! isset($this->clockIDJustCreated)) {
				(Clock::fromDB($this->clockID))->updateInDB($clientDataObj->clock);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("PlayerClock",
				array("name", "timeInSeconds", "clockID"),
				array($this->name, $this->timeInSeconds, $this->clockID))->
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
			delete("PlayerClock")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getClock() {
		if ( ! property_exists($this, "clock")) {
			$this->clock = Clock::fromDB($this->clockID);
		}
		return $this->clock;
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
