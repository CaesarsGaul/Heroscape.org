<?php

class UserCollectionHeroscapeSet extends HS_DatabaseObject {
	protected $id; // Int
	protected $userID; // Int
	protected $heroscapeSetID; // Int
	protected $quantity; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["UserCollectionHeroscapeSet"])) {
			$OBJECT_MAP["UserCollectionHeroscapeSet"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["UserCollectionHeroscapeSet"][$id])) {
			$obj = $OBJECT_MAP["UserCollectionHeroscapeSet"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["UserCollectionHeroscapeSet"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_id($id, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("id" => $id));
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		if (isset($clientDataObj->id) && self::exists(array("id" => $clientDataObj->id))) {
			return "A User Collection Heroscape Set already exists with that id - you cannot have duplicate entries.";
		}
		
		if ( ! isset($clientDataObj->user->id)) {
			$clientDataObj->user = User::create($clientDataObj->user);
		}
		if ( ! isset($clientDataObj->heroscapeSet->id)) {
			$clientDataObj->heroscapeSet = HeroscapeSet::create($clientDataObj->heroscapeSet);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("UserCollectionHeroscapeSet",
				array("userID", "heroscapeSetID", "quantity"),
				array($clientDataObj->user->id,
					$clientDataObj->heroscapeSet->id,
					$clientDataObj->quantity)));
		
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
			$whereArray["{$prefix}UserCollectionHeroscapeSet.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("user", $whereData)) {
				if (isset($whereData["user"]->id)) {
					$whereArray["{$prefix}UserCollectionHeroscapeSet.userID"] = $whereData["user"]->id;
				} else if ($whereData["user"] == null) {
					$whereArray["{$prefix}UserCollectionHeroscapeSet.userID"] = null;
				}
			}
			if (array_key_exists("heroscapeSet", $whereData)) {
				if (isset($whereData["heroscapeSet"]->id)) {
					$whereArray["{$prefix}UserCollectionHeroscapeSet.heroscapeSetID"] = $whereData["heroscapeSet"]->id;
				} else if ($whereData["heroscapeSet"] == null) {
					$whereArray["{$prefix}UserCollectionHeroscapeSet.heroscapeSetID"] = null;
				}
			}
			if (isset($whereData["quantity"])) {
				$whereArray["{$prefix}UserCollectionHeroscapeSet.quantity"] = $whereData["quantity"];
			}
		}
		
		if (isset($whereData["user"])) {
			$whereArray = array_merge($whereArray, User::createWhereArray($whereData["user"], "{$prefix}UserCollectionHeroscapeSet_userID_"));
		}
		if (isset($whereData["heroscapeSet"])) {
			$whereArray = array_merge($whereArray, HeroscapeSet::createWhereArray($whereData["heroscapeSet"], "{$prefix}UserCollectionHeroscapeSet_heroscapeSetID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("UserCollectionHeroscapeSet.name" => "ASC")
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
		return array("userID" => "User", "heroscapeSetID" => "HeroscapeSet");
	}

	public static function getColumnNames() {
		return array("id", "userID", "heroscapeSetID", "quantity");
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
			if (isset($clientDataObj->user, $clientDataObj->user->id) &&
					$clientDataObj->user->id > 0) {
					$this->userID = $clientDataObj->user->id;
			}
			if (isset($clientDataObj->heroscapeSet, $clientDataObj->heroscapeSet->id) &&
					$clientDataObj->heroscapeSet->id > 0) {
					$this->heroscapeSetID = $clientDataObj->heroscapeSet->id;
			}
			if (isset($clientDataObj->quantity)) {
				$this->quantity = $clientDataObj->quantity;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->user) && ( ! isset($clientDataObj->updateClasses) || (in_array("User", $clientDataObj->updateClasses))) && in_array("user", $clientDataObj->fieldsToUpdate) && ! isset($this->userIDJustCreated)) {
				(User::fromDB($this->userID))->updateInDB($clientDataObj->user);
			}
			if (isset($clientDataObj->heroscapeSet) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeSet", $clientDataObj->updateClasses))) && in_array("heroscapeSet", $clientDataObj->fieldsToUpdate) && ! isset($this->heroscapeSetIDJustCreated)) {
				(HeroscapeSet::fromDB($this->heroscapeSetID))->updateInDB($clientDataObj->heroscapeSet);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("UserCollectionHeroscapeSet",
				array("userID", "heroscapeSetID", "quantity"),
				array($this->userID, $this->heroscapeSetID, $this->quantity))->
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
			delete("UserCollectionHeroscapeSet")->
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

	public function getHeroscapeSet() {
		if ( ! property_exists($this, "heroscapeSet")) {
			$this->heroscapeSet = HeroscapeSet::fromDB($this->heroscapeSetID);
		}
		return $this->heroscapeSet;
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
