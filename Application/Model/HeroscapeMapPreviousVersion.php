<?php

class HeroscapeMapPreviousVersion extends HS_DatabaseObject {
	protected $id; // Int
	protected $mapID; // Int
	protected $versionNumber; // Int
	protected $buildInstructionsUrl; // String
	protected $imageUrl; // String
	protected $ohsGdocId; // String
	protected $startDate; // Date
	protected $endDate; // Date

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["HeroscapeMapPreviousVersion"])) {
			$OBJECT_MAP["HeroscapeMapPreviousVersion"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["HeroscapeMapPreviousVersion"][$id])) {
			$obj = $OBJECT_MAP["HeroscapeMapPreviousVersion"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["HeroscapeMapPreviousVersion"][$id] = $obj;
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
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeMapPreviousVersion",
				array("mapID", "versionNumber", "buildInstructionsUrl", "imageUrl", "ohsGdocId", "startDate", "endDate"),
				array($clientDataObj->map->id,
					$clientDataObj->versionNumber,
					$clientDataObj->buildInstructionsUrl,
					$clientDataObj->imageUrl,
					$clientDataObj->ohsGdocId,
					$clientDataObj->startDate,
					$clientDataObj->endDate)));
		
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
			$whereArray["{$prefix}HeroscapeMapPreviousVersion.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("map", $whereData)) {
				if (isset($whereData["map"]->id)) {
					$whereArray["{$prefix}HeroscapeMapPreviousVersion.mapID"] = $whereData["map"]->id;
				} else if ($whereData["map"] == null) {
					$whereArray["{$prefix}HeroscapeMapPreviousVersion.mapID"] = null;
				}
			}
			if (isset($whereData["versionNumber"])) {
				$whereArray["{$prefix}HeroscapeMapPreviousVersion.versionNumber"] = $whereData["versionNumber"];
			}
			if (isset($whereData["buildInstructionsUrl"])) {
				$whereArray["{$prefix}HeroscapeMapPreviousVersion.buildInstructionsUrl"] = $whereData["buildInstructionsUrl"];
			}
			if (isset($whereData["imageUrl"])) {
				$whereArray["{$prefix}HeroscapeMapPreviousVersion.imageUrl"] = $whereData["imageUrl"];
			}
			if (isset($whereData["ohsGdocId"])) {
				$whereArray["{$prefix}HeroscapeMapPreviousVersion.ohsGdocId"] = $whereData["ohsGdocId"];
			}
			if (isset($whereData["startDate"])) {
				$whereArray["{$prefix}HeroscapeMapPreviousVersion.startDate"] = $whereData["startDate"];
			}
			if (isset($whereData["endDate"])) {
				$whereArray["{$prefix}HeroscapeMapPreviousVersion.endDate"] = $whereData["endDate"];
			}
		}
		
		if (isset($whereData["map"])) {
			$whereArray = array_merge($whereArray, HeroscapeMap::createWhereArray($whereData["map"], "{$prefix}HeroscapeMapPreviousVersion_mapID_"));
		}
		
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		array("HeroscapeMapPreviousVersion.versionNumber" => "DESC");
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
		return array("mapID" => "HeroscapeMap");
	}

	public static function getColumnNames() {
		return array("id", "mapID", "versionNumber", "buildInstructionsUrl", "imageUrl", "ohsGdocId", "startDate", "endDate");
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

	// @DoNotUpdate
	public function isViewableByUser() {
		return true;
	}

	// @DoNotUpdate
	public static function userCanCreate($implicitObjects=null) {
		return true;
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
			if (isset($clientDataObj->versionNumber)) {
				$this->versionNumber = $clientDataObj->versionNumber;
			}
			if (property_exists($clientDataObj, "buildInstructionsUrl")) {
				$this->buildInstructionsUrl = $clientDataObj->buildInstructionsUrl;
			}
			if (property_exists($clientDataObj, "imageUrl")) {
				$this->imageUrl = $clientDataObj->imageUrl;
			}
			if (property_exists($clientDataObj, "ohsGdocId")) {
				$this->ohsGdocId = $clientDataObj->ohsGdocId;
			}
			if (isset($clientDataObj->startDate)) {
				$this->startDate = $clientDataObj->startDate;
			}
			if (isset($clientDataObj->endDate)) {
				$this->endDate = $clientDataObj->endDate;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->map) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeMap", $clientDataObj->updateClasses))) && in_array("map", $clientDataObj->fieldsToUpdate) && ! isset($this->mapIDJustCreated)) {
				(HeroscapeMap::fromDB($this->mapID))->updateInDB($clientDataObj->map);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("HeroscapeMapPreviousVersion",
				array("mapID", "versionNumber", "buildInstructionsUrl", "imageUrl", "ohsGdocId", "startDate", "endDate"),
				array($this->mapID, $this->versionNumber, $this->buildInstructionsUrl, $this->imageUrl, $this->ohsGdocId, $this->startDate, $this->endDate))->
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
			delete("HeroscapeMapPreviousVersion")->
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
