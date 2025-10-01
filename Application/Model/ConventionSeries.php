<?php

class ConventionSeries extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["ConventionSeries"])) {
			$OBJECT_MAP["ConventionSeries"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["ConventionSeries"][$id])) {
			$obj = $OBJECT_MAP["ConventionSeries"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["ConventionSeries"][$id] = $obj;
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
			return "A Convention Series already exists with that name - you cannot have duplicate entries.";
		}
		
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("ConventionSeries",
				array("name"),
				array($clientDataObj->name)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->conventions)) {
			foreach ($clientDataObj->conventions as $clientLinkObj) {
				$clientLinkObj->conventionSeries = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->admins)) {
			foreach ($clientDataObj->admins as $clientLinkObj) {
				$clientLinkObj->conventionSeries = $this;
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
			$whereArray["{$prefix}ConventionSeries.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}ConventionSeries.name"] = $whereData["name"];
			}
		}
		
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("ConventionSeries.name" => "ASC")
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
		return array("Convention" => "conventionSeriesID", "Admin" => "conventionSeriesID");
	}

	public static function getForeignKeys() {
		return array();
	}

	public static function getColumnNames() {
		return array("id", "name");
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
		if (Convention::countEntries(array("Convention.conventionSeriesID" => $this->id)) > 0) {
			return "Unable to delete Convention Series because one or more Convention is dependent on it.";
		}
		if (Admin::countEntries(array("Admin.conventionSeriesID" => $this->id)) > 0) {
			return "Unable to delete Convention Series because one or more Admin is dependent on it.";
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
					return "A Convention Series already exists with that name - you cannot have duplicate entries.";
				}
				$this->name = $clientDataObj->name;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("ConventionSeries",
				array("name"),
				array($this->name))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->conventions) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->conventions as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Convention::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->conventionSeries = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->admins) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->admins as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Admin::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->conventionSeries = $this;
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
			delete("ConventionSeries")->
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
