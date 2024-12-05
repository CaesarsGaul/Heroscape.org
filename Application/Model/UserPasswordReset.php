<?php

class UserPasswordReset extends HS_DatabaseObject {
	protected $id; // Int
	protected $userID; // Int
	protected $resetKey; // String
	protected $resetRequestTime; // Datetime

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["UserPasswordReset"])) {
			$OBJECT_MAP["UserPasswordReset"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["UserPasswordReset"][$id])) {
			$obj = $OBJECT_MAP["UserPasswordReset"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["UserPasswordReset"][$id] = $obj;
		}
		return $obj;
	}

	// @DoNotUpdate
	public static function fromDB_userID($userID, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("userID" => $userID));
	}

	// @DoNotUpdate
	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("UserPasswordReset",
				array("userID", "resetKey", "resetRequestTime"),
				array($clientDataObj->user->id,
					self::generateRandomString(),
					date('Y-m-d H:i:s'))));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->sendEmailForReset();
		
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
			$whereArray["{$prefix}UserPasswordReset.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("user", $whereData)) {
				if (isset($whereData["user"]->id)) {
					$whereArray["{$prefix}UserPasswordReset.userID"] = $whereData["user"]->id;
				} else if ($whereData["user"] == null) {
					$whereArray["{$prefix}UserPasswordReset.userID"] = null;
				}
			}
			if (isset($whereData["resetKey"])) {
				$whereArray["{$prefix}UserPasswordReset.resetKey"] = $whereData["resetKey"];
			}
			if (isset($whereData["resetRequestTime"])) {
				$whereArray["{$prefix}UserPasswordReset.resetRequestTime"] = $whereData["resetRequestTime"];
			}
		}
		
		if (isset($whereData["user"])) {
			$whereArray = array_merge($whereArray, User::createWhereArray($whereData["user"], "{$prefix}UserPasswordReset_userID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("UserPasswordReset.name" => "ASC")
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
		return array("userID" => "User");
	}

	public static function getColumnNames() {
		return array("id", "userID", "resetKey", "resetRequestTime");
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

	// @DoNotUpdate
	public static function validResetKey($user, $resetKey) {
		return self::countEntries(array("userID" => $user->id, "resetKey" => $resetKey)) > 0;
	}

	// @DoNotUpdate
	private static function generateRandomString() {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 20; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	// @DoNotUpdate
	public function sendEmailForReset($subdomain = null) {
		require_once(Libraries . '/Internal/Email/PHP/Email.php');
		$user = User::fromDB($this->userID);
		$recipients = array($user->email);
		$subject = "Heroscape.org Account Password Reset Request";
		$body = "Looks like you've requested to reset your password for your account at Heroscape.org.
		<br><br>Please follow the below link to reset your password.<br><br>
		https://heroscape.org/account/reset-password/?email={$user->email}&resetKey={$this->resetKey}
		<br><br><hr><br>If you did not request this password reset, do not go to the above link. Instead, <a href='https://heroscape.org/contact'>contact Heroscape.org</a> to alert us of suspicious activity.";
		
		new Email($recipients, $subject, $body);
	}

	/* Public Dynamic Functions */
	
	// @DoNotUpdate
	public function isEditableByUser() {
		return false;
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return false;
	}

	// @DoNotUpdate
	public static function userCanCreate($implicitObjects) {
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
	
	// @DoNotUpdate
	public function updateInDB($clientDataObj = null) {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to update this value.";
		}
		
		if ($this->id == null) {
			return "Unknown Error";
		}
		
		// Nothing to update
		
		return "";
	}

	// @DoNotUpdate
	public function deleteInDB() {
		/*if ( ! $this->isEditableByUser()) {
			return "You do not have permission to delete this value.";
		}*/
		
		if ($this->id == null) {
			return "Unknown Error";
		}
		
		$deleteLinksMsg = $this->deleteLinks();
		if (strlen($deleteLinksMsg) > 0) {
			return $deleteLinksMsg;
		}
		
		$this->dbDelete((new MySQLBuilder())->
			delete("UserPasswordReset")->
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
