<?php

class HeroscapeMapSetLink extends HS_DatabaseObject {
	protected $mapID; // Int
	protected $setID; // Int
	protected $quantity; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($objsArray) {
		return parent::fromDBHelper(new self(), array(
			"mapID" => $objsArray["map"]->id,
			"setID" => $objsArray["set"]->id));
	}

	public static function create($objsArray, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($objsArray)) {
			return null;
		}
		
		
		
		
		$dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeMapSetLink",
				array("mapID", "setID", "quantity"),
				array($objsArray["map"]->id,
					$objsArray["set"]->id,
					$objsArray["quantity"])));
		
		$dbObj = self::fromDB($objsArray);
		
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
		
		if (isset($whereData["mapID"])) {
			$whereArray["{$prefix}HeroscapeMapSetLink.mapID"] = $whereData["mapID"];
		}
		if (isset($whereData["setID"])) {
			$whereArray["{$prefix}HeroscapeMapSetLink.setID"] = $whereData["setID"];
		}
		if (isset($whereData["quantity"])) {
			$whereArray["{$prefix}HeroscapeMapSetLink.quantity"] = $whereData["quantity"];
		}
		
		if (isset($whereData["map"])) {
			$whereArray = array_merge($whereArray, HeroscapeMap::createWhereArray($whereData["map"], "{$prefix}HeroscapeMapSetLink_mapID_"));
		}
		if (isset($whereData["set"])) {
			$whereArray = array_merge($whereArray, HeroscapeSet::createWhereArray($whereData["set"], "{$prefix}HeroscapeMapSetLink_setID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("HeroscapeMapSetLink.name" => "ASC")
		return array();
	}

	public static function getPrimaryKey() {
		return array("mapID", "setID");
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
		return array("mapID" => "HeroscapeMap", "setID" => "HeroscapeSet");
	}

	public static function getColumnNames() {
		return array("mapID", "setID", "quantity");
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
		if (LoginCredentials::userLoggedIn()) {
			$user = LoginCredentials::getLoggedInUser();
			return $user->isSiteAdmin() || $user->verified;
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
		
		// N-M Links
		return "";
	}

	/* Inherited DatabaseObject Functions */
	
	public function updateInDB($clientDataObj = null) {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to update this value.";
		}
		
		if ($this->mapID == null || $this->setID == null) {
			return "Unknown Error";
		}
		
		if ($clientDataObj != null) {
			if (isset($clientDataObj->quantity)) {
				$this->quantity = $clientDataObj->quantity;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("HeroscapeMapSetLink",
				array("quantity"),
				array($this->quantity))->
			where(array("mapID" => $this->mapID, "setID" => $this->setID)));
		
		return "";
	}

	public function deleteInDB() {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to delete this value.";
		}
		
		if ($this->mapID == null || $this->setID == null) {
			return "Unknown Error";
		}
		
		$deleteLinksMsg = $this->deleteLinks();
		if (strlen($deleteLinksMsg) > 0) {
			return $deleteLinksMsg;
		}
		
		$this->dbDelete((new MySQLBuilder())->
			delete("HeroscapeMapSetLink")->
			where(array("mapID" => $this->mapID, "setID" => $this->setID)));
		
		return "";
	}

	/* Getters */
	
	public function getMap() {
		if ( ! property_exists($this, "map")) {
			$this->map = HeroscapeMap::fromDB($this->mapID);
		}
		return $this->map;
	}

	public function getSet() {
		if ( ! property_exists($this, "set")) {
			$this->set = HeroscapeSet::fromDB($this->setID);
		}
		return $this->set;
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
