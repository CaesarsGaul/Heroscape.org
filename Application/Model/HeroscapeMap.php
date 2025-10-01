<?php

class HeroscapeMap extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $authorName; // String
	protected $buildInstructionsUrl; // String
	protected $imageUrl; // String
	protected $numberOfPlayers; // Int
	protected $ohsGdocId; // String
	protected $hexoscapeUrl; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["HeroscapeMap"])) {
			$OBJECT_MAP["HeroscapeMap"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["HeroscapeMap"][$id])) {
			$obj = $OBJECT_MAP["HeroscapeMap"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["HeroscapeMap"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_name($name, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("name" => $name));
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		if (isset($clientDataObj->name) && self::exists(array("name" => $clientDataObj->name))) {
			return "A Heroscape Map already exists with that name - you cannot have duplicate entries.";
		}
		
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeMap",
				array("name", "authorName", "buildInstructionsUrl", "imageUrl", "numberOfPlayers", "ohsGdocId", "hexoscapeUrl"),
				array($clientDataObj->name,
					$clientDataObj->authorName,
					$clientDataObj->buildInstructionsUrl,
					$clientDataObj->imageUrl,
					$clientDataObj->numberOfPlayers,
					$clientDataObj->ohsGdocId,
					$clientDataObj->hexoscapeUrl)));
		
		$dbObj = self::fromDB($id);
		
		if (isset($clientDataObj->tags)) {
			foreach ($clientDataObj->tags as $tempClientDataObj) {
				HeroscapeMapTagLink::create(array(
					"map" => $dbObj,
					"tag" => HeroscapeMapTag::fromDB($tempClientDataObj->id)));
			}
		}
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->heroscapeMapSets)) {
			foreach ($clientDataObj->heroscapeMapSets as $clientLinkObj) {
				$clientLinkObj->map = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->heroscapeMapPreviousVersions)) {
			foreach ($clientDataObj->heroscapeMapPreviousVersions as $clientLinkObj) {
				$clientLinkObj->map = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->conventionMaps)) {
			foreach ($clientDataObj->conventionMaps as $clientLinkObj) {
				$clientLinkObj->map = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->heroscapeMapTerrainPieceQuantitys)) {
			foreach ($clientDataObj->heroscapeMapTerrainPieceQuantitys as $clientLinkObj) {
				$clientLinkObj->heroscapeMap = $this;
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
			$whereArray["{$prefix}HeroscapeMap.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}HeroscapeMap.name"] = $whereData["name"];
			}
			if (isset($whereData["authorName"])) {
				$whereArray["{$prefix}HeroscapeMap.authorName"] = $whereData["authorName"];
			}
			if (isset($whereData["buildInstructionsUrl"])) {
				$whereArray["{$prefix}HeroscapeMap.buildInstructionsUrl"] = $whereData["buildInstructionsUrl"];
			}
			if (isset($whereData["imageUrl"])) {
				$whereArray["{$prefix}HeroscapeMap.imageUrl"] = $whereData["imageUrl"];
			}
			if (isset($whereData["numberOfPlayers"])) {
				$whereArray["{$prefix}HeroscapeMap.numberOfPlayers"] = $whereData["numberOfPlayers"];
			}
			if (isset($whereData["ohsGdocId"])) {
				$whereArray["{$prefix}HeroscapeMap.ohsGdocId"] = $whereData["ohsGdocId"];
			}
			if (isset($whereData["hexoscapeUrl"])) {
				$whereArray["{$prefix}HeroscapeMap.hexoscapeUrl"] = $whereData["hexoscapeUrl"];
			}
		}
		
		
		if (isset($whereData["id"])) {
			$whereArray = array_merge($whereArray, HeroscapeMapTag::createWhereArray($whereData["id"], "{$prefix}HeroscapeMap_id_HeroscapeMapTagLink_tagID_"));
		}
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array("HeroscapeMap.name" => "ASC");
	}

	public static function getPrimaryKey() {
		return "id";
	}

	public static function getNToMLinkClasses() {
		return array("HeroscapeMapTagLink" => "mapID");
	}

	public static function getNToMLinkClassesWithType() {
		return array("HeroscapeMapTagLink" => "HeroscapeMapTag");
	}

	public static function getNToMLinkClassesWithJSVariableName() {
		return array("HeroscapeMapTagLink" => "tags");
	}

	public static function getNTo1LinkClasses() {
		return array("HeroscapeMapSet" => "mapID", "HeroscapeMapPreviousVersion" => "mapID", "ConventionMap" => "mapID", "HeroscapeMapTerrainPieceQuantity" => "heroscapeMapID");
	}

	public static function getForeignKeys() {
		return array();
	}

	public static function getColumnNames() {
		return array("id", "name", "authorName", "buildInstructionsUrl", "imageUrl", "numberOfPlayers", "ohsGdocId", "hexoscapeUrl");
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
		if (LoginCredentials::userLoggedIn()) {
			$user = LoginCredentials::getLoggedInUser();
			if ($user->isSiteAdmin()) {
				return true;
			}
			if ($user->mapEditor) {
				return true;
			}
			if (/*$user->verified && */$user->userName == $this->authorName) {
				return true;
			}
		}
		return false; 
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return true;
	}

	// @DoNotUpdate
	public static function userCanCreate($implicitObjects=null) {
		if (LoginCredentials::userLoggedIn()) {
			return true;
			/*$user = LoginCredentials::getLoggedInUser();
			if ($user->isSiteAdmin() || $user->verified) {
				return true;
			}*/
		}
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
		if (HeroscapeMapSet::countEntries(array("HeroscapeMapSet.mapID" => $this->id)) > 0) {
			return "Unable to delete Heroscape Map because one or more Heroscape Map Set is dependent on it.";
		}
		if (HeroscapeMapPreviousVersion::countEntries(array("HeroscapeMapPreviousVersion.mapID" => $this->id)) > 0) {
			return "Unable to delete Heroscape Map because one or more Heroscape Map Previous Version is dependent on it.";
		}
		if (ConventionMap::countEntries(array("ConventionMap.mapID" => $this->id)) > 0) {
			return "Unable to delete Heroscape Map because one or more Convention Map is dependent on it.";
		}
		if (HeroscapeMapTerrainPieceQuantity::countEntries(array("HeroscapeMapTerrainPieceQuantity.heroscapeMapID" => $this->id)) > 0) {
			return "Unable to delete Heroscape Map because one or more Heroscape Map Terrain Piece Quantity is dependent on it.";
		}
		
		// N-M Links
		HeroscapeMapTagLink::deleteEntries(HeroscapeMapTagLink::fetch(array("heroscapeMap" => $this)));
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
					return "A Heroscape Map already exists with that name - you cannot have duplicate entries.";
				}
				$this->name = $clientDataObj->name;
			}
			if (property_exists($clientDataObj, "authorName")) {
				$this->authorName = $clientDataObj->authorName;
			}
			if (property_exists($clientDataObj, "buildInstructionsUrl")) {
				$this->buildInstructionsUrl = $clientDataObj->buildInstructionsUrl;
			}
			if (property_exists($clientDataObj, "imageUrl")) {
				$this->imageUrl = $clientDataObj->imageUrl;
			}
			if (isset($clientDataObj->numberOfPlayers)) {
				$this->numberOfPlayers = $clientDataObj->numberOfPlayers;
			}
			if (property_exists($clientDataObj, "ohsGdocId")) {
				$this->ohsGdocId = $clientDataObj->ohsGdocId;
			}
			if (property_exists($clientDataObj, "hexoscapeUrl")) {
				$this->hexoscapeUrl = $clientDataObj->hexoscapeUrl;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("HeroscapeMap",
				array("name", "authorName", "buildInstructionsUrl", "imageUrl", "numberOfPlayers", "ohsGdocId", "hexoscapeUrl"),
				array($this->name, $this->authorName, $this->buildInstructionsUrl, $this->imageUrl, $this->numberOfPlayers, $this->ohsGdocId, $this->hexoscapeUrl))->
			where(array("id" => $this->id)));
		
		if ((isset($clientDataObj->updateNtoMLinks) || (isset($clientDataObj->joins, $clientDataObj->joins->{'HeroscapeMapTagLink.mapID'}))) && in_array("tags", $clientDataObj->linksToUpdate)) {
			$links = HeroscapeMapTagLink::fetch(array("map" => $this));
			$oldObjs = array();
			foreach ($links as $link) {
				$oldObjs[] = $link->getTag();
			}
			$newObjs = array();
			foreach ($clientDataObj->tags as $clientLinkObj) {
				if (is_object($clientLinkObj) && isset($clientLinkObj->id) && $clientLinkObj->id > 0) {
					$newObjs[] = HeroscapeMapTag::fromDB($clientLinkObj->id);
				}
			}
			subtractOverlap($newObjs, $oldObjs, array("id"));
			foreach ($newObjs as $newObj) {
				HeroscapeMapTagLink::create(array("tag" => $newObj, "map" => $this));
			}
			foreach ($oldObjs as $oldObj) {
				(HeroscapeMapTagLink::fromDB(array("tag" => $oldObj, "map" => $this)))->deleteInDB();
			}
		}
		
		// Update 1-N Links
		if (isset($clientDataObj->heroscapeMapSets) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->heroscapeMapSets as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = HeroscapeMapSet::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->map = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->heroscapeMapPreviousVersions) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->heroscapeMapPreviousVersions as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = HeroscapeMapPreviousVersion::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->map = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->conventionMaps) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->conventionMaps as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = ConventionMap::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->map = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->heroscapeMapTerrainPieceQuantitys) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->heroscapeMapTerrainPieceQuantitys as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = HeroscapeMapTerrainPieceQuantity::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->heroscapeMap = $this;
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
			delete("HeroscapeMap")->
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
