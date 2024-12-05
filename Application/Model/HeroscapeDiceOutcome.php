<?php

class HeroscapeDiceOutcome extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $color; // String
	protected $imageUrl; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["HeroscapeDiceOutcome"])) {
			$OBJECT_MAP["HeroscapeDiceOutcome"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["HeroscapeDiceOutcome"][$id])) {
			$obj = $OBJECT_MAP["HeroscapeDiceOutcome"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["HeroscapeDiceOutcome"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_name($name, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("name" => $name));
	}

	public static function fromDB_color($color, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("color" => $color));
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		if (isset($clientDataObj->name) && self::exists(array("name" => $clientDataObj->name))) {
			return "A Heroscape Dice Outcome already exists with that name - you cannot have duplicate entries.";
		}
		if (isset($clientDataObj->color) && self::exists(array("color" => $clientDataObj->color))) {
			return "A Heroscape Dice Outcome already exists with that color - you cannot have duplicate entries.";
		}
		
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeDiceOutcome",
				array("name", "color", "imageUrl"),
				array($clientDataObj->name,
					$clientDataObj->color,
					$clientDataObj->imageUrl)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->heroscapeDices)) {
			foreach ($clientDataObj->heroscapeDices as $clientLinkObj) {
				$clientLinkObj->outcome = $this;
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
			$whereArray["{$prefix}HeroscapeDiceOutcome.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}HeroscapeDiceOutcome.name"] = $whereData["name"];
			}
			if (isset($whereData["color"])) {
				$whereArray["{$prefix}HeroscapeDiceOutcome.color"] = $whereData["color"];
			}
			if (isset($whereData["imageUrl"])) {
				$whereArray["{$prefix}HeroscapeDiceOutcome.imageUrl"] = $whereData["imageUrl"];
			}
		}
		
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("HeroscapeDiceOutcome.name" => "ASC")
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
		return array("HeroscapeDice" => "outcomeID");
	}

	public static function getForeignKeys() {
		return array();
	}

	public static function getColumnNames() {
		return array("id", "name", "color", "imageUrl");
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
		if (HeroscapeDice::countEntries(array("HeroscapeDice.outcomeID" => $this->id)) > 0) {
			return "Unable to delete Heroscape Dice Outcome because one or more Heroscape Dice is dependent on it.";
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
			if (isset($clientDataObj->name)) {
				if (isset($clientDataObj->name) && $this->name != $clientDataObj->name && self::exists(array("name" => $clientDataObj->name))) {
					return "A Heroscape Dice Outcome already exists with that name - you cannot have duplicate entries.";
				}
				$this->name = $clientDataObj->name;
			}
			if (isset($clientDataObj->color)) {
				if (isset($clientDataObj->color) && $this->color != $clientDataObj->color && self::exists(array("color" => $clientDataObj->color))) {
					return "A Heroscape Dice Outcome already exists with that color - you cannot have duplicate entries.";
				}
				$this->color = $clientDataObj->color;
			}
			if (property_exists($clientDataObj, "imageUrl")) {
				$this->imageUrl = $clientDataObj->imageUrl;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("HeroscapeDiceOutcome",
				array("name", "color", "imageUrl"),
				array($this->name, $this->color, $this->imageUrl))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->heroscapeDices) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->heroscapeDices as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = HeroscapeDice::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->outcome = $this;
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
		
		$deleteLinksMsg = $this->deleteLinks();
		if (strlen($deleteLinksMsg) > 0) {
			return $deleteLinksMsg;
		}
		
		$this->dbDelete((new MySQLBuilder())->
			delete("HeroscapeDiceOutcome")->
			where(array("id" => $this->id)));
		
		return "";
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
