<?php

class HeroscapeMapSet extends HS_DatabaseObject {
	protected $id; // Int
	protected $mapID; // Int
	protected $terrainSetID; // Int
	protected $quantity; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["HeroscapeMapSet"])) {
			$OBJECT_MAP["HeroscapeMapSet"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["HeroscapeMapSet"][$id])) {
			$obj = $OBJECT_MAP["HeroscapeMapSet"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["HeroscapeMapSet"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->map->id)) {
			$clientDataObj->map = HeroscapeMap::create($clientDataObj->map);
		}
		if ( ! isset($clientDataObj->terrainSet->id)) {
			$clientDataObj->terrainSet = HeroscapeSet::create($clientDataObj->terrainSet);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeMapSet",
				array("mapID", "terrainSetID", "quantity"),
				array($clientDataObj->map->id,
					$clientDataObj->terrainSet->id,
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
			$whereArray["{$prefix}HeroscapeMapSet.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("map", $whereData)) {
				if (isset($whereData["map"]->id)) {
					$whereArray["{$prefix}HeroscapeMapSet.mapID"] = $whereData["map"]->id;
				} else if ($whereData["map"] == null) {
					$whereArray["{$prefix}HeroscapeMapSet.mapID"] = null;
				}
			}
			if (array_key_exists("terrainSet", $whereData)) {
				if (isset($whereData["terrainSet"]->id)) {
					$whereArray["{$prefix}HeroscapeMapSet.terrainSetID"] = $whereData["terrainSet"]->id;
				} else if ($whereData["terrainSet"] == null) {
					$whereArray["{$prefix}HeroscapeMapSet.terrainSetID"] = null;
				}
			}
			if (isset($whereData["quantity"])) {
				$whereArray["{$prefix}HeroscapeMapSet.quantity"] = $whereData["quantity"];
			}
		}
		
		if (isset($whereData["map"])) {
			$whereArray = array_merge($whereArray, HeroscapeMap::createWhereArray($whereData["map"], "{$prefix}HeroscapeMapSet_mapID_"));
		}
		if (isset($whereData["terrainSet"])) {
			$whereArray = array_merge($whereArray, HeroscapeSet::createWhereArray($whereData["terrainSet"], "{$prefix}HeroscapeMapSet_terrainSetID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("HeroscapeMapSet.name" => "ASC")
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
		return array("mapID" => "HeroscapeMap", "terrainSetID" => "HeroscapeSet");
	}

	public static function getColumnNames() {
		return array("id", "mapID", "terrainSetID", "quantity");
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
		return $this->getMap()->isEditableByUser();
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
			if (isset($clientDataObj->map, $clientDataObj->map->id) &&
					$clientDataObj->map->id > 0) {
					$this->mapID = $clientDataObj->map->id;
			}
			if (isset($clientDataObj->terrainSet, $clientDataObj->terrainSet->id) &&
					$clientDataObj->terrainSet->id > 0) {
					$this->terrainSetID = $clientDataObj->terrainSet->id;
			}
			if (isset($clientDataObj->quantity)) {
				$this->quantity = $clientDataObj->quantity;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->map) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeMap", $clientDataObj->updateClasses))) && in_array("map", $clientDataObj->fieldsToUpdate) && ! isset($this->mapIDJustCreated)) {
				(HeroscapeMap::fromDB($this->mapID))->updateInDB($clientDataObj->map);
			}
			if (isset($clientDataObj->terrainSet) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeSet", $clientDataObj->updateClasses))) && in_array("terrainSet", $clientDataObj->fieldsToUpdate) && ! isset($this->terrainSetIDJustCreated)) {
				(HeroscapeSet::fromDB($this->terrainSetID))->updateInDB($clientDataObj->terrainSet);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("HeroscapeMapSet",
				array("mapID", "terrainSetID", "quantity"),
				array($this->mapID, $this->terrainSetID, $this->quantity))->
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
			delete("HeroscapeMapSet")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getMap() {
		if ( ! property_exists($this, "map")) {
			$this->map = HeroscapeMap::fromDB($this->mapID);
		}
		return $this->map;
	}

	public function getTerrainSet() {
		if ( ! property_exists($this, "terrainSet")) {
			$this->terrainSet = HeroscapeSet::fromDB($this->terrainSetID);
		}
		return $this->terrainSet;
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
