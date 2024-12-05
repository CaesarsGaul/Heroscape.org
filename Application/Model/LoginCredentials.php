<?php

class LoginCredentials extends HS_DatabaseObject {
	protected $id; // Int
	protected $userID; // Int
	protected $password; // String
	protected $cookie; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["LoginCredentials"])) {
			$OBJECT_MAP["LoginCredentials"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["LoginCredentials"][$id])) {
			$obj = $OBJECT_MAP["LoginCredentials"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["LoginCredentials"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_userID($userID, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("userID" => $userID));
	}

	public static function fromDB_cookie($cookie, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("cookie" => $cookie));
	}

	// @DoNotUpdate
	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("LoginCredentials",
				array("userID", "password", "cookie"),
				array($clientDataObj->user->id,
					self::hashPassword($clientDataObj->password),
					self::generatecookie(User::fromDB($clientDataObj->user->id)))));
		
		$dbObj = self::fromDB($id);
		
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
			$whereArray["{$prefix}LoginCredentials.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("user", $whereData)) {
				if (isset($whereData["user"]->id)) {
					$whereArray["{$prefix}LoginCredentials.userID"] = $whereData["user"]->id;
				} else if ($whereData["user"] == null) {
					$whereArray["{$prefix}LoginCredentials.userID"] = null;
				}
			}
			if (isset($whereData["password"])) {
				$whereArray["{$prefix}LoginCredentials.password"] = $whereData["password"];
			}
			if (isset($whereData["cookie"])) {
				$whereArray["{$prefix}LoginCredentials.cookie"] = $whereData["cookie"];
			}
		}
		
		if (isset($whereData["user"])) {
			$whereArray = array_merge($whereArray, User::createWhereArray($whereData["user"], "{$prefix}LoginCredentials_userID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("LoginCredentials.name" => "ASC")
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
		return array("id", "userID", "password", "cookie");
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
	public static function userLoggedIn() {
		$closeSession = false;
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			$closeSession = true;
		}
		if ( ! isset($_SESSION['userLoggedIn'])) {
			$_SESSION['userLoggedIn'] = false;
			if (isset($_COOKIE["hs_key"])) {
				$cookie = $_COOKIE["hs_key"];
				
				// DB Query
				$numResults = self::dbConnection()->dbSelectFunction((new MySQLBuilder())->
					select("LoginCredentials", null, "COUNT")->
					innerJoin("User", "User.id", "LoginCredentials.userID")->
					where(array("cookie" => $cookie)));
				
				if ($numResults >= 1) {
					$_SESSION['userLoggedIn'] = true;
				}
			} 
		}
		$userLoggedIn = $_SESSION['userLoggedIn'];
		if ($closeSession) {
			session_write_close();
		}
		return $userLoggedIn;
	}

	// @DoNotUpdate
	public static function getLoggedInUser() {
		$closeSession = false;
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			$closeSession = true;
		}
		if ( ! isset($_SESSION['loggedInUser'])) {
			if (isset($_COOKIE["hs_key"])) {
				$cookie = $_COOKIE["hs_key"];
				$row = self::dbConnection()->dbSelectRow((new MySQLBuilder())->
					select("LoginCredentials")->
					where(array("cookie" => $cookie)));
				
				$_SESSION['loggedInUser'] = User::fromDB($row['userID']);
			} else {
				// Error case
				return null;
			}
		}
		
		$user = $_SESSION['loggedInUser'];
		if ($closeSession) {
			session_write_close();
		}
		//return $_SESSION['loggedInUser'];
		return $user;
	}

	// @DoNotUpdate
	public static function validCredentials($email, $password, $fromREST=false) {
		if (User::exists(array("email" => $email))) {
			$user = User::fromDB_email($email);
			$loginCredentials = self::fromDB_userID($user->id);
			if (password_verify($password, $loginCredentials->password)) {
				return true;
			} else {
				if ( ! $fromREST) {
					alertUser("Your password is incorrect. Try logging in again.");
				}
			}
		} else {
			if ( ! $fromREST) {
				alertUser("No account exists for that email. Try logging in again.");
			}
		}
		return false;
	}

	// @DoNotUpdate
	public function validCredentialsDynamic($password) {
		$user = User::fromDB($this->userID);
		if (password_verify($password, $this->password)) {
			return true;
		}
		return false;
	}

	// @DoNotUpdate
	public static function deleteLoginCookie() {
		if (self::userLoggedIn()) {
			unset($_COOKIE["hs_key"]);
			setcookie("hs_key", "", time() - 3600, '/', ".heroscape.org");
			
			unset($_COOKIE["hs_username"]);
			setcookie("hs_username", "", time() - 3600, '/', ".heroscape.org");
			
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			
			
			if (ini_get("session.use_cookies")) {
				$params = session_get_cookie_params();
				setcookie(session_name(), '', time() - 3600,
					$params["path"], $params["domain"],
					$params["secure"], $params["httponly"]
				);
			}
			
			//session_write_close();
			
			unset($_SESSION['userLoggedIn']);
			unset($_SESSION['loggedInUser']);
			
			setcookie("PHPSESSID", "", time() - 3600, '/');
			
			session_destroy();
			//session_unset();
		}
	}

	// @DoNotUpdate
	public function updatePassword($newPassword) {
		/*session_destroy();
		session_write_close();*/
		$this->password = self::hashPassword($newPassword);
				
		$this->cookie = self::generatecookie(User::fromDB($this->userID));
				
		$GLOBALS['userHasUpdatePermission'] = true;
				
		$this->updateInDB();
				
		unset($GLOBALS['userHasUpdatePermission']);
				
		$this->deleteLoginCookie();
				
		$this->createLoginCookie();
	}

	// @DoNotUpdate
	private static function hashPassword($password) {
		return password_hash($password, PASSWORD_DEFAULT);
	}

	// @DoNotUpdate
	private static function generatecookie($user) {
		// Get timestamp of when user joined
		$salt = "393kdkffjd0sjfm";

		// Create Raw Cookie Value
		$rawcookie = $user->id . $salt . time();
		$cookie = hash('ripemd160', $rawcookie);	
		
		return $cookie;
	}

	/* Public Dynamic Functions */
	
	// @DoNotUpdate
	public function isEditableByUser() {
		$user = LoginCredentials::getLoggedInUser();
		if ($this->userID == $user->id) {
			return true;
		}
		return false;
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return false;
	}

	// @DoNotUpdate
	public static function userCanCreate($implicitObjects=null) {
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

	// @DoNotUpdate
	public function createLoginCookie() {
		if (session_status() != PHP_SESSION_NONE) {
			session_unset();
			session_destroy();
			session_write_close();
		}
		session_start();
		
		unset($_SESSION['userLoggedIn']);
		unset($_SESSION['loggedInUser']);
				
		setcookie("hs_key", $this->cookie, time()+60*60*24*30*12, "/", ".heroscape.org");		
		// Manually set $_COOKIE because we need it for permissions checking 
		$_COOKIE["hs_key"] = $this->cookie;
		
		$user = $this->getUser();
		setcookie("hs_username", $user->userName, time()+60*60*24*30*12, "/", ".heroscape.org");	
		
		// Set User Options
		$userSettingTags = UserSettingTag::fetch(array("user" => $user));
		foreach ($userSettingTags as $userSettingTag) {
			setcookie("hs_setting_".str_replace(' ', '_', $userSettingTag->getUserSetting()->name), $userSettingTag->data, time()+60*60*24*30*12, "/", ".heroscape.org");	
		}
	}

	protected function deleteLinks() {
		// N-1 Links
		
		// N-M Links
		return "";
	}

	/* Inherited DatabaseObject Functions */
	
	// @DoNotUpdate
	public function updateInDB($clientDataObj = null) {
		if ( ! $this->isEditableByUser() && 
				! (isset($GLOBALS['userHasUpdatePermission']) &&
					$GLOBALS['userHasUpdatePermission'])) {
			return "You do not have permission to update this value.";
		}
		
		if ($this->id == null) {
			return "Unknown Error";
		}

		$this->dbUpdate((new MySQLBuilder())->
			update("LoginCredentials",
				array("password", "cookie"),
				array($this->password, $this->cookie))->
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
			delete("LoginCredentials")->
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
