<?php

class Attendee extends HS_DatabaseObject {
	protected $id; // Int
	protected $userID; // Int
	protected $conventionID; // Int
	protected $signupTime; // Datetime

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["Attendee"])) {
			$OBJECT_MAP["Attendee"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["Attendee"][$id])) {
			$obj = $OBJECT_MAP["Attendee"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["Attendee"][$id] = $obj;
		}
		return $obj;
	}

	// @DoNotUpdate
	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		date_default_timezone_set('UTC');
		
		$user = LoginCredentials::getLoggedInUser();
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("Attendee",
				array("userID", "conventionID", "signupTime"),
				array($user->id,
					$clientDataObj->convention->id,
					date('Y-m-d H:i:s'))));
		
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
			$whereArray["{$prefix}Attendee.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("user", $whereData)) {
				if (isset($whereData["user"]->id)) {
					$whereArray["{$prefix}Attendee.userID"] = $whereData["user"]->id;
				} else if ($whereData["user"] == null) {
					$whereArray["{$prefix}Attendee.userID"] = null;
				}
			}
			if (array_key_exists("convention", $whereData)) {
				if (isset($whereData["convention"]->id)) {
					$whereArray["{$prefix}Attendee.conventionID"] = $whereData["convention"]->id;
				} else if ($whereData["convention"] == null) {
					$whereArray["{$prefix}Attendee.conventionID"] = null;
				}
			}
			if (isset($whereData["signupTime"])) {
				$whereArray["{$prefix}Attendee.signupTime"] = $whereData["signupTime"];
			}
		}
		
		if (isset($whereData["user"])) {
			$whereArray = array_merge($whereArray, User::createWhereArray($whereData["user"], "{$prefix}Attendee_userID_"));
		}
		if (isset($whereData["convention"])) {
			$whereArray = array_merge($whereArray, Convention::createWhereArray($whereData["convention"], "{$prefix}Attendee_conventionID_"));
		}
		
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array("Attendee.signupTime" => "ASC");
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
		return array("userID" => "User", "conventionID" => "Convention");
	}

	public static function getColumnNames() {
		return array("id", "userID", "conventionID", "signupTime");
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
			return $user->id == $this->userID;
		}
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return true;
	}

	// @DoNotUpdate
	public static function userCanCreate($implicitObjects=null) {
		if (isset($implicitObjects->convention) && 
				isset($implicitObjects->convention->id)) {
			$convention = Convention::fromDB($implicitObjects->convention->id);
			if ($convention->hardPlayerCap != null) {
				$numCurrentAttendees = Attendee::countEntries(
					array("Attendee.conventionID" => 
						$implicitObjects->convention->id));
				if ($numCurrentAttendees >= $convention->hardPlayerCap) {
					return false;
				}
			}
			if ($convention->signupKey != null) {
				if (isset($implicitObjects->signupKey)) {
					$signupKey = $implicitObjects->signupKey;
					return $signupKey == $convention->signupKey;
				}
			} else {
				return true;
			}
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

	// @DoNotUpdate
	public function columnIsViewableByUser($columnName) {
		return $this->isViewableByUser();
	}

	// @DoNotUpdate
	public function columnIsEditableByUser($columnName) {
		// Default Behavior
		if ( ! $this->isEditableByUser()) {
			return false;
		}
		switch ($columnName) {
			case 'signupTime':
				return false;
		}
		return true;
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
			if (isset($clientDataObj->user, $clientDataObj->user->id) &&
					$clientDataObj->user->id > 0) {
					$this->userID = $clientDataObj->user->id;
			}
			if (isset($clientDataObj->convention, $clientDataObj->convention->id) &&
					$clientDataObj->convention->id > 0) {
					$this->conventionID = $clientDataObj->convention->id;
			}
			if (isset($clientDataObj->signupTime)) {
				$this->signupTime = $clientDataObj->signupTime;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->user) && ( ! isset($clientDataObj->updateClasses) || (in_array("User", $clientDataObj->updateClasses))) && in_array("user", $clientDataObj->fieldsToUpdate) && ! isset($this->userIDJustCreated)) {
				(User::fromDB($this->userID))->updateInDB($clientDataObj->user);
			}
			if (isset($clientDataObj->convention) && ( ! isset($clientDataObj->updateClasses) || (in_array("Convention", $clientDataObj->updateClasses))) && in_array("convention", $clientDataObj->fieldsToUpdate) && ! isset($this->conventionIDJustCreated)) {
				(Convention::fromDB($this->conventionID))->updateInDB($clientDataObj->convention);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("Attendee",
				array("userID", "conventionID", "signupTime"),
				array($this->userID, $this->conventionID, $this->signupTime))->
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
			delete("Attendee")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getUser() {
		if ( ! property_exists($this, "user")) {
			$this->user = User::fromDB($this->userID);
		}
		return $this->user;
	}

	public function getConvention() {
		if ( ! property_exists($this, "convention")) {
			$this->convention = Convention::fromDB($this->conventionID);
		}
		return $this->convention;
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
