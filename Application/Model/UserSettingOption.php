<?php

class UserSettingOption extends HS_DatabaseObject {
	protected $id; // Int
	protected $userSettingID; // Int
	protected $name; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["UserSettingOption"])) {
			$OBJECT_MAP["UserSettingOption"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["UserSettingOption"][$id])) {
			$obj = $OBJECT_MAP["UserSettingOption"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["UserSettingOption"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->userSetting->id)) {
			$clientDataObj->userSetting = UserSetting::create($clientDataObj->userSetting);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("UserSettingOption",
				array("userSettingID", "name"),
				array($clientDataObj->userSetting->id,
					$clientDataObj->name)));
		
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
			$whereArray["{$prefix}UserSettingOption.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("userSetting", $whereData)) {
				if (isset($whereData["userSetting"]->id)) {
					$whereArray["{$prefix}UserSettingOption.userSettingID"] = $whereData["userSetting"]->id;
				} else if ($whereData["userSetting"] == null) {
					$whereArray["{$prefix}UserSettingOption.userSettingID"] = null;
				}
			}
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}UserSettingOption.name"] = $whereData["name"];
			}
		}
		
		if (isset($whereData["userSetting"])) {
			$whereArray = array_merge($whereArray, UserSetting::createWhereArray($whereData["userSetting"], "{$prefix}UserSettingOption_userSettingID_"));
		}
		
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array("UserSettingOption.userSettingID" => "ASC", "UserSettingOption.name" => "ASC");
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
		return array("userSettingID" => "UserSetting");
	}

	public static function getColumnNames() {
		return array("id", "userSettingID", "name");
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
	
	public function isEditableByUser() {
		//$user = LoginCredentials::getLoggedInUser();
		return false; // TODO: temporary only
		// TODO: return $user->TODO();
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
			if (isset($clientDataObj->userSetting, $clientDataObj->userSetting->id) &&
					$clientDataObj->userSetting->id > 0) {
					$this->userSettingID = $clientDataObj->userSetting->id;
			}
			if (isset($clientDataObj->name)) {
				$this->name = $clientDataObj->name;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->userSetting) && ( ! isset($clientDataObj->updateClasses) || (in_array("UserSetting", $clientDataObj->updateClasses))) && in_array("userSetting", $clientDataObj->fieldsToUpdate) && ! isset($this->userSettingIDJustCreated)) {
				(UserSetting::fromDB($this->userSettingID))->updateInDB($clientDataObj->userSetting);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("UserSettingOption",
				array("userSettingID", "name"),
				array($this->userSettingID, $this->name))->
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
			delete("UserSettingOption")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
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
