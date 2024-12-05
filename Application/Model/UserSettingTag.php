<?php

class UserSettingTag extends HS_DatabaseObject {
	protected $id; // Int
	protected $userID; // Int
	protected $userSettingID; // Int
	protected $data; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["UserSettingTag"])) {
			$OBJECT_MAP["UserSettingTag"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["UserSettingTag"][$id])) {
			$obj = $OBJECT_MAP["UserSettingTag"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["UserSettingTag"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->user->id)) {
			$clientDataObj->user = User::create($clientDataObj->user);
		}
		if ( ! isset($clientDataObj->userSetting->id)) {
			$clientDataObj->userSetting = UserSetting::create($clientDataObj->userSetting);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("UserSettingTag",
				array("userID", "userSettingID", "data"),
				array($clientDataObj->user->id,
					$clientDataObj->userSetting->id,
					$clientDataObj->data)));
		
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
			$whereArray["{$prefix}UserSettingTag.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("user", $whereData)) {
				if (isset($whereData["user"]->id)) {
					$whereArray["{$prefix}UserSettingTag.userID"] = $whereData["user"]->id;
				} else if ($whereData["user"] == null) {
					$whereArray["{$prefix}UserSettingTag.userID"] = null;
				}
			}
			if (array_key_exists("userSetting", $whereData)) {
				if (isset($whereData["userSetting"]->id)) {
					$whereArray["{$prefix}UserSettingTag.userSettingID"] = $whereData["userSetting"]->id;
				} else if ($whereData["userSetting"] == null) {
					$whereArray["{$prefix}UserSettingTag.userSettingID"] = null;
				}
			}
			if (isset($whereData["data"])) {
				$whereArray["{$prefix}UserSettingTag.data"] = $whereData["data"];
			}
		}
		
		if (isset($whereData["user"])) {
			$whereArray = array_merge($whereArray, User::createWhereArray($whereData["user"], "{$prefix}UserSettingTag_userID_"));
		}
		if (isset($whereData["userSetting"])) {
			$whereArray = array_merge($whereArray, UserSetting::createWhereArray($whereData["userSetting"], "{$prefix}UserSettingTag_userSettingID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("UserSettingTag.name" => "ASC")
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
		return array("userID" => "User", "userSettingID" => "UserSetting");
	}

	public static function getColumnNames() {
		return array("id", "userID", "userSettingID", "data");
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
		$user = LoginCredentials::getLoggedInUser();
		if ($user != null) {
			return $user->userName == $this->getUser()->userName;
		}
		return false;
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		$user = LoginCredentials::getLoggedInUser();
		if ($user != null) {
			return $user->userName == $this->getUser()->userName;
		}
		return false;
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
			if (isset($clientDataObj->user, $clientDataObj->user->id) &&
					$clientDataObj->user->id > 0) {
					$this->userID = $clientDataObj->user->id;
			}
			if (isset($clientDataObj->userSetting, $clientDataObj->userSetting->id) &&
					$clientDataObj->userSetting->id > 0) {
					$this->userSettingID = $clientDataObj->userSetting->id;
			}
			if (property_exists($clientDataObj, "data")) {
				$this->data = $clientDataObj->data;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->user) && ( ! isset($clientDataObj->updateClasses) || (in_array("User", $clientDataObj->updateClasses))) && in_array("user", $clientDataObj->fieldsToUpdate) && ! isset($this->userIDJustCreated)) {
				(User::fromDB($this->userID))->updateInDB($clientDataObj->user);
			}
			if (isset($clientDataObj->userSetting) && ( ! isset($clientDataObj->updateClasses) || (in_array("UserSetting", $clientDataObj->updateClasses))) && in_array("userSetting", $clientDataObj->fieldsToUpdate) && ! isset($this->userSettingIDJustCreated)) {
				(UserSetting::fromDB($this->userSettingID))->updateInDB($clientDataObj->userSetting);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("UserSettingTag",
				array("userID", "userSettingID", "data"),
				array($this->userID, $this->userSettingID, $this->data))->
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
			delete("UserSettingTag")->
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

	public function getUserSetting() {
		if ( ! property_exists($this, "userSetting")) {
			$this->userSetting = UserSetting::fromDB($this->userSettingID);
		}
		return $this->userSetting;
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
