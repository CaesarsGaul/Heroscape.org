<?php

class Convention extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $description; // String
	protected $startDate; // Date
	protected $endDate; // Date
	protected $address; // String
	protected $latitude; // Decimal
	protected $longitude; // Decimal
	protected $conventionSeriesID; // Int
	protected $hardPlayerCap; // Int
	protected $softPlayerCap; // Int
	protected $signupKey; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["Convention"])) {
			$OBJECT_MAP["Convention"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["Convention"][$id])) {
			$obj = $OBJECT_MAP["Convention"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["Convention"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_name($name, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("name" => $name));
	}

	// @DoNotUpdate
	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		if (isset($clientDataObj->name) && self::exists(array("name" => $clientDataObj->name))) {
			return "A Convention already exists with that name - you cannot have duplicate entries.";
		}
		
		if (isset($clientDataObj->conventionSeries) &&
				! isset($clientDataObj->conventionSeries->id)) {
			$clientDataObj->conventionSeries = Convention::create($clientDataObj->conventionSeries);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("Convention",
				array("name", "startDate", "endDate", "conventionSeriesID", "hardPlayerCap"),
				array($clientDataObj->name,
					$clientDataObj->startDate,
					$clientDataObj->endDate,
					isset($clientDataObj->conventionSeries) 
						? $clientDataObj->conventionSeries->id
						: null,
					$clientDataObj->hardPlayerCap)));
		
		$dbObj = self::fromDB($id);
		
		$adminObj = new stdClass();
		$adminObj->user = LoginCredentials::getLoggedInUser();
		$adminObj->convention = $dbObj;
		Admin::create($adminObj);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->tournaments)) {
			foreach ($clientDataObj->tournaments as $clientLinkObj) {
				$clientLinkObj->convention = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->admins)) {
			foreach ($clientDataObj->admins as $clientLinkObj) {
				$clientLinkObj->convention = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->attendees)) {
			foreach ($clientDataObj->attendees as $clientLinkObj) {
				$clientLinkObj->convention = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->conventionMaps)) {
			foreach ($clientDataObj->conventionMaps as $clientLinkObj) {
				$clientLinkObj->convention = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
	}

	/* Public Static Functions */
	
	// @DoNotUpdate
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
		
		if (isset($whereData["endAfter"])) {
			$whereArray["{$prefix}Convention.endDate"] = array(
					"comparison" => ">=", 
					"value" => $whereData["endAfter"]);
		}
		if (isset($whereData["endBefore"])) {
			$whereArray["{$prefix}Convention.endDate"] = array(
					"comparison" => "<", 
					"value" => $whereData["endBefore"]);
		}
		if (isset($whereData["startBefore"]) && isset($whereData["startAfter"])) {
			$whereArray["{$prefix}Convention.startDate"] = array(
				"comparison" => "<=",
				"value" => $whereData["startBefore"],
				"and" => array(
					"comparison" => ">",
					"value" => $whereData["startAfter"]
				)
			);
		} else if (isset($whereData["startBefore"])) {
			$whereArray["{$prefix}Convention.startDate"] = array(
					"comparison" => "<=", 
					"value" => $whereData["startBefore"]);
		} else if (isset($whereData["startAfter"])) {
			$whereArray["{$prefix}Convention.startDate"] = array(
					"comparison" => ">", 
					"value" => $whereData["startAfter"]);
		} 
		
		if (isset($whereData["id"])) {
			$whereArray["{$prefix}Convention.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}Convention.name"] = $whereData["name"];
			}
			if (isset($whereData["startDate"])) {
				$whereArray["{$prefix}Convention.startDate"] = $whereData["startDate"];
			}
			if (isset($whereData["endDate"])) {
				$whereArray["{$prefix}Convention.endDate"] = $whereData["endDate"];
			}
			if (array_key_exists("conventionSeries", $whereData)) {
				if (isset($whereData["conventionSeries"]->id)) {
					$whereArray["{$prefix}Convention.conventionSeriesID"] = $whereData["conventionSeries"]->id;
				} else if ($whereData["conventionSeries"] == null) {
					$whereArray["{$prefix}Convention.conventionSeriesID"] = null;
				}
			}
			if (isset($whereData["hardPlayerCap"])) {
				$whereArray["{$prefix}Convention.hardPlayerCap"] = $whereData["hardPlayerCap"];
			}
			if (isset($whereData["softPlayerCap"])) {
				$whereArray["{$prefix}Convention.softPlayerCap"] = $whereData["softPlayerCap"];
			}
		}
		
		if (isset($whereData["conventionSeries"])) {
			$whereArray = array_merge($whereArray, Convention::createWhereArray($whereData["conventionSeries"], "{$prefix}Convention_conventionSeriesID_"));
		}
		
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array("Convention.startDate" => "ASC");
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
		return array("Tournament" => "conventionID", "Admin" => "conventionID", "Attendee" => "conventionID", "ConventionMap" => "conventionID");
	}

	public static function getForeignKeys() {
		return array("conventionSeriesID" => "ConventionSeries");
	}

	public static function getColumnNames() {
		return array("id", "name", "description", "startDate", "endDate", "address", "latitude", "longitude", "conventionSeriesID", "hardPlayerCap", "softPlayerCap", "signupKey");
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
		return $this->userIsAdmin();
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return true;
	}

	// @DoNotUpdate
	public function userIsAdmin() {
		$user = LoginCredentials::getLoggedInUser();
		return count(Admin::fetch(array("convention" => $this, "user" => $user))) > 0;
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

	// @DoNotUpdate
	public function columnIsViewableByUser($columnName) {
		$user = LoginCredentials::getLoggedInUser();
		switch ($columnName) {
			case 'signupKey':
				if ($this->signupKey == null) {
					return true;
				}
				if (count(Admin::fetch(array("convention" => $this, "user" => $user))) == 0) {
					return false;
				}
				break;
		}
		return $this->isViewableByUser();
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
		if (Tournament::countEntries(array("Tournament.conventionID" => $this->id)) > 0) {
			return "Unable to delete Convention because one or more Tournament is dependent on it.";
		}
		if (Admin::countEntries(array("Admin.conventionID" => $this->id)) > 0) {
			return "Unable to delete Convention because one or more Admin is dependent on it.";
		}
		if (Attendee::countEntries(array("Attendee.conventionID" => $this->id)) > 0) {
			return "Unable to delete Convention because one or more Attendee is dependent on it.";
		}
		if (ConventionMap::countEntries(array("ConventionMap.conventionID" => $this->id)) > 0) {
			return "Unable to delete Convention because one or more Convention Map is dependent on it.";
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
					return "A Convention already exists with that name - you cannot have duplicate entries.";
				}
				$this->name = $clientDataObj->name;
			}
			if (property_exists($clientDataObj, "description")) {
				$this->description = $clientDataObj->description;
			}
			if (isset($clientDataObj->startDate)) {
				$this->startDate = $clientDataObj->startDate;
			}
			if (isset($clientDataObj->endDate)) {
				$this->endDate = $clientDataObj->endDate;
			}
			if (property_exists($clientDataObj, "address")) {
				$this->address = $clientDataObj->address;
			}
			if (property_exists($clientDataObj, "latitude")) {
				$this->latitude = $clientDataObj->latitude;
			}
			if (property_exists($clientDataObj, "longitude")) {
				$this->longitude = $clientDataObj->longitude;
			}
			if (property_exists($clientDataObj, "conventionSeries")) {
				if (isset($clientDataObj->conventionSeries)) {
					if (isset($clientDataObj->conventionSeries->id) && $clientDataObj->conventionSeries->id > 0) {
						$this->conventionSeriesID = $clientDataObj->conventionSeries->id;
					} else {
						$this->conventionSeriesID = (ConventionSeries::create($clientDataObj->conventionSeries))->id;
						$this->conventionSeriesIDJustCreated = true;
					}
				} else {
					$this->conventionSeriesID = null;
				}
			}
			if (property_exists($clientDataObj, "hardPlayerCap")) {
				$this->hardPlayerCap = $clientDataObj->hardPlayerCap;
			}
			if (property_exists($clientDataObj, "softPlayerCap")) {
				$this->softPlayerCap = $clientDataObj->softPlayerCap;
			}
			if (property_exists($clientDataObj, "signupKey")) {
				$this->signupKey = $clientDataObj->signupKey;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->conventionSeries) && ( ! isset($clientDataObj->updateClasses) || (in_array("ConventionSeries", $clientDataObj->updateClasses))) && in_array("conventionSeries", $clientDataObj->fieldsToUpdate) && ! isset($this->conventionSeriesIDJustCreated)) {
				(ConventionSeries::fromDB($this->conventionSeriesID))->updateInDB($clientDataObj->conventionSeries);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("Convention",
				array("name", "description", "startDate", "endDate", "address", "latitude", "longitude", "conventionSeriesID", "hardPlayerCap", "softPlayerCap", "signupKey"),
				array($this->name, $this->description, $this->startDate, $this->endDate, $this->address, $this->latitude, $this->longitude, $this->conventionSeriesID, $this->hardPlayerCap, $this->softPlayerCap, $this->signupKey))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->tournaments) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->tournaments as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Tournament::childFromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->convention = $this;
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
					$clientLinkObj->convention = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->attendees) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->attendees as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Attendee::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->convention = $this;
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
					$clientLinkObj->convention = $this;
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
			delete("Convention")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getConventionSeries() {
		if ($this->conventionSeriesID != null) {
			if ( ! property_exists($this, "conventionSeries")) {
				$this->conventionSeries = ConventionSeries::fromDB($this->conventionSeriesID);
			}
			return $this->conventionSeries;
		}
		return null;
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
