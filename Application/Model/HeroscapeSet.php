<?php

class HeroscapeSet extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $abbreviation; // String
	protected $releaseDate; // String
	protected $masterSet; // Boolean
	protected $terrainExpansion; // Boolean

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["HeroscapeSet"])) {
			$OBJECT_MAP["HeroscapeSet"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["HeroscapeSet"][$id])) {
			$obj = $OBJECT_MAP["HeroscapeSet"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["HeroscapeSet"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_name($name, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("name" => $name));
	}

	public static function fromDB_abbreviation($abbreviation, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("abbreviation" => $abbreviation));
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		if (isset($clientDataObj->name) && self::exists(array("name" => $clientDataObj->name))) {
			return "A Heroscape Set already exists with that name - you cannot have duplicate entries.";
		}
		if (isset($clientDataObj->abbreviation) && self::exists(array("abbreviation" => $clientDataObj->abbreviation))) {
			return "A Heroscape Set already exists with that abbreviation - you cannot have duplicate entries.";
		}
		
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeSet",
				array("name", "abbreviation", "releaseDate", "masterSet", "terrainExpansion"),
				array($clientDataObj->name,
					$clientDataObj->abbreviation,
					$clientDataObj->releaseDate,
					isset($clientDataObj->masterSet) && $clientDataObj-> masterSet ? true : false,
					isset($clientDataObj->terrainExpansion) && $clientDataObj-> terrainExpansion ? true : false)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->heroscapeMapSets)) {
			foreach ($clientDataObj->heroscapeMapSets as $clientLinkObj) {
				$clientLinkObj->terrainSet = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->heroscapeSetTerrainPieceQuantitys)) {
			foreach ($clientDataObj->heroscapeSetTerrainPieceQuantitys as $clientLinkObj) {
				$clientLinkObj->heroscapeSet = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->userCollectionHeroscapeSets)) {
			foreach ($clientDataObj->userCollectionHeroscapeSets as $clientLinkObj) {
				$clientLinkObj->heroscapeSet = $this;
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
			$whereArray["{$prefix}HeroscapeSet.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}HeroscapeSet.name"] = $whereData["name"];
			}
			if (isset($whereData["abbreviation"])) {
				$whereArray["{$prefix}HeroscapeSet.abbreviation"] = $whereData["abbreviation"];
			}
			if (isset($whereData["releaseDate"])) {
				$whereArray["{$prefix}HeroscapeSet.releaseDate"] = $whereData["releaseDate"];
			}
			if (isset($whereData["masterSet"])) {
				$whereArray["{$prefix}HeroscapeSet.masterSet"] = $whereData["masterSet"];
			}
			if (isset($whereData["terrainExpansion"])) {
				$whereArray["{$prefix}HeroscapeSet.terrainExpansion"] = $whereData["terrainExpansion"];
			}
		}
		
		
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		//return array("HeroscapeSet.id" => "ASC");
		return array("releaseDate.id" => "ASC");
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
		return array("HeroscapeMapSet" => "terrainSetID", "HeroscapeSetTerrainPieceQuantity" => "heroscapeSetID", "UserCollectionHeroscapeSet" => "heroscapeSetID");
	}

	public static function getForeignKeys() {
		return array();
	}

	public static function getColumnNames() {
		return array("id", "name", "abbreviation", "releaseDate", "masterSet", "terrainExpansion");
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
		return false;
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return true;
	}

	// @DoNotUpdate
	public static function userCanCreate($implicitObjects=null) {
		return false;
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
		if (HeroscapeMapSet::countEntries(array("HeroscapeMapSet.terrainSetID" => $this->id)) > 0) {
			return "Unable to delete Heroscape Set because one or more Heroscape Map Set is dependent on it.";
		}
		if (HeroscapeSetTerrainPieceQuantity::countEntries(array("HeroscapeSetTerrainPieceQuantity.heroscapeSetID" => $this->id)) > 0) {
			return "Unable to delete Heroscape Set because one or more Heroscape Set Terrain Piece Quantity is dependent on it.";
		}
		if (UserCollectionHeroscapeSet::countEntries(array("UserCollectionHeroscapeSet.heroscapeSetID" => $this->id)) > 0) {
			return "Unable to delete Heroscape Set because one or more User Collection Heroscape Set is dependent on it.";
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
					return "A Heroscape Set already exists with that name - you cannot have duplicate entries.";
				}
				$this->name = $clientDataObj->name;
			}
			if (isset($clientDataObj->abbreviation)) {
				if (isset($clientDataObj->abbreviation) && $this->abbreviation != $clientDataObj->abbreviation && self::exists(array("abbreviation" => $clientDataObj->abbreviation))) {
					return "A Heroscape Set already exists with that abbreviation - you cannot have duplicate entries.";
				}
				$this->abbreviation = $clientDataObj->abbreviation;
			}
			if (isset($clientDataObj->releaseDate)) {
				$this->releaseDate = $clientDataObj->releaseDate;
			}
			if (isset($clientDataObj->masterSet)) {
				$this->masterSet = $clientDataObj->masterSet;
			}
			if (isset($clientDataObj->terrainExpansion)) {
				$this->terrainExpansion = $clientDataObj->terrainExpansion;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("HeroscapeSet",
				array("name", "abbreviation", "releaseDate", "masterSet", "terrainExpansion"),
				array($this->name, $this->abbreviation, $this->releaseDate, $this->masterSet, $this->terrainExpansion))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->heroscapeMapSets) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->heroscapeMapSets as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = HeroscapeMapSet::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->terrainSet = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->heroscapeSetTerrainPieceQuantitys) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->heroscapeSetTerrainPieceQuantitys as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = HeroscapeSetTerrainPieceQuantity::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->heroscapeSet = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->userCollectionHeroscapeSets) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->userCollectionHeroscapeSets as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = UserCollectionHeroscapeSet::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->heroscapeSet = $this;
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
			delete("HeroscapeSet")->
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
