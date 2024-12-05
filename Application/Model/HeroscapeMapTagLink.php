<?php

class HeroscapeMapTagLink extends HS_DatabaseObject {
	protected $mapID; // Int
	protected $tagID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($objsArray) {
		return parent::fromDBHelper(new self(), array(
			"mapID" => $objsArray["map"]->id,
			"tagID" => $objsArray["tag"]->id));
	}

	public static function create($objsArray, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($objsArray)) {
			return null;
		}
		
		
		
		
		$dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeMapTagLink",
				array("mapID", "tagID"),
				array($objsArray["map"]->id,
					$objsArray["tag"]->id)));
		
		$dbObj = self::fromDB($objsArray);
		
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
		
		if (isset($whereData["mapID"])) {
			$whereArray["{$prefix}HeroscapeMapTagLink.mapID"] = $whereData["mapID"];
		}
		if (isset($whereData["tagID"])) {
			$whereArray["{$prefix}HeroscapeMapTagLink.tagID"] = $whereData["tagID"];
		}
		
		if (isset($whereData["map"])) {
			$whereArray = array_merge($whereArray, HeroscapeMap::createWhereArray($whereData["map"], "{$prefix}HeroscapeMapTagLink_mapID_"));
		}
		if (isset($whereData["tag"])) {
			$whereArray = array_merge($whereArray, HeroscapeMapTag::createWhereArray($whereData["tag"], "{$prefix}HeroscapeMapTagLink_tagID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("HeroscapeMapTagLink.name" => "ASC")
		return array();
	}

	public static function getPrimaryKey() {
		return array("mapID", "tagID");
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
		return array("mapID" => "HeroscapeMap", "tagID" => "HeroscapeMapTag");
	}

	public static function getColumnNames() {
		return array("mapID", "tagID");
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
		//return $this->getMap()->isEditableByUser();
		return false;
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return true;
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
		
		if ($this->mapID == null || $this->tagID == null) {
			return "Unknown Error";
		}
		
		if ($clientDataObj != null) {
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		// Nothing to update
		
		return "";
	}

	public function deleteInDB() {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to delete this value.";
		}
		
		if ($this->mapID == null || $this->tagID == null) {
			return "Unknown Error";
		}
		
		$deleteLinksMsg = $this->deleteLinks();
		if (strlen($deleteLinksMsg) > 0) {
			return $deleteLinksMsg;
		}
		
		$this->dbDelete((new MySQLBuilder())->
			delete("HeroscapeMapTagLink")->
			where(array("mapID" => $this->mapID, "tagID" => $this->tagID)));
		
		return "";
	}

	/* Getters */
	
	public function getMap() {
		if ( ! property_exists($this, "map")) {
			$this->map = HeroscapeMap::fromDB($this->mapID);
		}
		return $this->map;
	}

	public function getTag() {
		if ( ! property_exists($this, "tag")) {
			$this->tag = HeroscapeMapTag::fromDB($this->tagID);
		}
		return $this->tag;
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
