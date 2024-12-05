<?php

class ConventionMap extends HS_DatabaseObject {
	protected $id; // Int
	protected $conventionID; // Int
	protected $mapID; // Int
	protected $quantity; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["ConventionMap"])) {
			$OBJECT_MAP["ConventionMap"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["ConventionMap"][$id])) {
			$obj = $OBJECT_MAP["ConventionMap"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["ConventionMap"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->convention->id)) {
			$clientDataObj->convention = Convention::create($clientDataObj->convention);
		}
		if ( ! isset($clientDataObj->map->id)) {
			$clientDataObj->map = HeroscapeMap::create($clientDataObj->map);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("ConventionMap",
				array("conventionID", "mapID", "quantity"),
				array($clientDataObj->convention->id,
					$clientDataObj->map->id,
					$clientDataObj->quantity)));
		
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
			$whereArray["{$prefix}ConventionMap.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("convention", $whereData)) {
				if (isset($whereData["convention"]->id)) {
					$whereArray["{$prefix}ConventionMap.conventionID"] = $whereData["convention"]->id;
				} else if ($whereData["convention"] == null) {
					$whereArray["{$prefix}ConventionMap.conventionID"] = null;
				}
			}
			if (array_key_exists("map", $whereData)) {
				if (isset($whereData["map"]->id)) {
					$whereArray["{$prefix}ConventionMap.mapID"] = $whereData["map"]->id;
				} else if ($whereData["map"] == null) {
					$whereArray["{$prefix}ConventionMap.mapID"] = null;
				}
			}
			if (isset($whereData["quantity"])) {
				$whereArray["{$prefix}ConventionMap.quantity"] = $whereData["quantity"];
			}
		}
		
		if (isset($whereData["convention"])) {
			$whereArray = array_merge($whereArray, Convention::createWhereArray($whereData["convention"], "{$prefix}ConventionMap_conventionID_"));
		}
		if (isset($whereData["map"])) {
			$whereArray = array_merge($whereArray, HeroscapeMap::createWhereArray($whereData["map"], "{$prefix}ConventionMap_mapID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("ConventionMap.name" => "ASC")
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
		return array("conventionID" => "Convention", "mapID" => "HeroscapeMap");
	}

	public static function getColumnNames() {
		return array("id", "conventionID", "mapID", "quantity");
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
	
	// @DoNotUpdate
	public function isEditableByUser() {
		return $this->getConvention()->isEditableByUser();
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
			if (isset($clientDataObj->convention, $clientDataObj->convention->id) &&
					$clientDataObj->convention->id > 0) {
					$this->conventionID = $clientDataObj->convention->id;
			}
			if (isset($clientDataObj->map, $clientDataObj->map->id) &&
					$clientDataObj->map->id > 0) {
					$this->mapID = $clientDataObj->map->id;
			}
			if (isset($clientDataObj->quantity)) {
				$this->quantity = $clientDataObj->quantity;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->convention) && ( ! isset($clientDataObj->updateClasses) || (in_array("Convention", $clientDataObj->updateClasses))) && in_array("convention", $clientDataObj->fieldsToUpdate) && ! isset($this->conventionIDJustCreated)) {
				(Convention::fromDB($this->conventionID))->updateInDB($clientDataObj->convention);
			}
			if (isset($clientDataObj->map) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeMap", $clientDataObj->updateClasses))) && in_array("map", $clientDataObj->fieldsToUpdate) && ! isset($this->mapIDJustCreated)) {
				(HeroscapeMap::fromDB($this->mapID))->updateInDB($clientDataObj->map);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("ConventionMap",
				array("conventionID", "mapID", "quantity"),
				array($this->conventionID, $this->mapID, $this->quantity))->
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
			delete("ConventionMap")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getConvention() {
		if ( ! property_exists($this, "convention")) {
			$this->convention = Convention::fromDB($this->conventionID);
		}
		return $this->convention;
	}

	public function getMap() {
		if ( ! property_exists($this, "map")) {
			$this->map = HeroscapeMap::fromDB($this->mapID);
		}
		return $this->map;
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
