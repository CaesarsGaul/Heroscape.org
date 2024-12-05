<?php

class Homeworld extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $figureSetID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["Homeworld"])) {
			$OBJECT_MAP["Homeworld"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["Homeworld"][$id])) {
			$obj = $OBJECT_MAP["Homeworld"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["Homeworld"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_id($id, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("id" => $id));
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		if (isset($clientDataObj->id) && self::exists(array("id" => $clientDataObj->id))) {
			return "A Homeworld already exists with that id - you cannot have duplicate entries.";
		}
		
		if ( ! isset($clientDataObj->figureSet->id)) {
			$clientDataObj->figureSet = FigureSet::create($clientDataObj->figureSet);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("Homeworld",
				array("name", "figureSetID"),
				array($clientDataObj->name,
					$clientDataObj->figureSet->id)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->cards)) {
			foreach ($clientDataObj->cards as $clientLinkObj) {
				$clientLinkObj->homeworld = $this;
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
			$whereArray["{$prefix}Homeworld.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}Homeworld.name"] = $whereData["name"];
			}
			if (array_key_exists("figureSet", $whereData)) {
				if (isset($whereData["figureSet"]->id)) {
					$whereArray["{$prefix}Homeworld.figureSetID"] = $whereData["figureSet"]->id;
				} else if ($whereData["figureSet"] == null) {
					$whereArray["{$prefix}Homeworld.figureSetID"] = null;
				}
			}
		}
		
		if (isset($whereData["figureSet"])) {
			$whereArray = array_merge($whereArray, FigureSet::createWhereArray($whereData["figureSet"], "{$prefix}Homeworld_figureSetID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("Homeworld.name" => "ASC")
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
		return array("Card" => "homeworldID");
	}

	public static function getForeignKeys() {
		return array("figureSetID" => "FigureSet");
	}

	public static function getColumnNames() {
		return array("id", "name", "figureSetID");
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
		if (Card::countEntries(array("Card.homeworldID" => $this->id)) > 0) {
			return "Unable to delete Homeworld because one or more Card is dependent on it.";
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
				$this->name = $clientDataObj->name;
			}
			if (isset($clientDataObj->figureSet, $clientDataObj->figureSet->id) &&
					$clientDataObj->figureSet->id > 0) {
					$this->figureSetID = $clientDataObj->figureSet->id;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->figureSet) && ( ! isset($clientDataObj->updateClasses) || (in_array("FigureSet", $clientDataObj->updateClasses))) && in_array("figureSet", $clientDataObj->fieldsToUpdate) && ! isset($this->figureSetIDJustCreated)) {
				(FigureSet::fromDB($this->figureSetID))->updateInDB($clientDataObj->figureSet);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("Homeworld",
				array("name", "figureSetID"),
				array($this->name, $this->figureSetID))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->cards) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->cards as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Card::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->homeworld = $this;
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
			delete("Homeworld")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getFigureSet() {
		if ( ! property_exists($this, "figureSet")) {
			$this->figureSet = FigureSet::fromDB($this->figureSetID);
		}
		return $this->figureSet;
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