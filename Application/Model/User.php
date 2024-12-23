<?php

class User extends HS_DatabaseObject {
	protected $id; // Int
	protected $userName; // String
	protected $email; // String
	protected $phoneNumber; // String
	protected $firstName; // String
	protected $lastName; // String
	protected $siteAdmin; // Boolean
	protected $verified; // Boolean
	protected $verificationKey; // String
	protected $elo; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["User"])) {
			$OBJECT_MAP["User"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["User"][$id])) {
			$obj = $OBJECT_MAP["User"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["User"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_userName($userName, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("userName" => $userName));
	}

	public static function fromDB_email($email, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("email" => $email));
	}

	// @DoNotUpdate
	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		if (isset($clientDataObj->userName) && self::exists(array("userName" => $clientDataObj->userName))) {
			return "A User already exists with that userName - you cannot have duplicate entries.";
		}
		if (isset($clientDataObj->email) && self::exists(array("email" => $clientDataObj->email))) {
			return "A User already exists with that email - you cannot have duplicate entries.";
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("User",
				array("userName", "email", "phoneNumber", "firstName", "lastName", "verificationKey"),
				array($clientDataObj->userName,
					$clientDataObj->email,
					$clientDataObj->phoneNumber,
					$clientDataObj->firstName,
					$clientDataObj->lastName,
					self::generateRandomString())));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		
		$dbObj->sendEmailConfirmation();
		
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->loginCredentialss)) {
			foreach ($clientDataObj->loginCredentialss as $clientLinkObj) {
				$clientLinkObj->user = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->admins)) {
			foreach ($clientDataObj->admins as $clientLinkObj) {
				$clientLinkObj->user = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->players)) {
			foreach ($clientDataObj->players as $clientLinkObj) {
				$clientLinkObj->user = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->gameMaps)) {
			foreach ($clientDataObj->gameMaps as $clientLinkObj) {
				$clientLinkObj->broughtByUser = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->attendees)) {
			foreach ($clientDataObj->attendees as $clientLinkObj) {
				$clientLinkObj->user = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->userPasswordResets)) {
			foreach ($clientDataObj->userPasswordResets as $clientLinkObj) {
				$clientLinkObj->user = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->glyphs)) {
			foreach ($clientDataObj->glyphs as $clientLinkObj) {
				$clientLinkObj->author = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->userSettingTags)) {
			foreach ($clientDataObj->userSettingTags as $clientLinkObj) {
				$clientLinkObj->user = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->powerRankingLists)) {
			foreach ($clientDataObj->powerRankingLists as $clientLinkObj) {
				$clientLinkObj->author = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->userCollectionHeroscapeSets)) {
			foreach ($clientDataObj->userCollectionHeroscapeSets as $clientLinkObj) {
				$clientLinkObj->user = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
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
	private function sendEmailConfirmation() {
		$recipients = array($this->email);
		$subject = "Heroscape.org Account";
		$body = "This email is to confirm you just created an account at Heroscape.org with the username {$this->userName}.
		<br><br>Please follow the below link to confirm your email address. This is required to access your account on Heroscape.org.<br><br>
		https://heroscape.org/account/verify/?email={$this->email}&verificationKey={$this->verificationKey}";
		
		new Email($recipients, $subject, $body);
	}

	// @DoNotUpdate
	public function isVerified() {
		return $this->verificationKey == null;
	}

	// @DoNotUpdate
	public function isSiteAdmin() {
		return $this->siteAdmin;
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
			$whereArray["{$prefix}User.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["userName"])) {
				$whereArray["{$prefix}User.userName"] = $whereData["userName"];
			}
			if (isset($whereData["email"])) {
				$whereArray["{$prefix}User.email"] = $whereData["email"];
			}
			if (isset($whereData["phoneNumber"])) {
				$whereArray["{$prefix}User.phoneNumber"] = $whereData["phoneNumber"];
			}
			if (isset($whereData["firstName"])) {
				$whereArray["{$prefix}User.firstName"] = $whereData["firstName"];
			}
			if (isset($whereData["lastName"])) {
				$whereArray["{$prefix}User.lastName"] = $whereData["lastName"];
			}
			if (isset($whereData["siteAdmin"])) {
				$whereArray["{$prefix}User.siteAdmin"] = $whereData["siteAdmin"];
			}
			if (isset($whereData["verified"])) {
				$whereArray["{$prefix}User.verified"] = $whereData["verified"];
			}
			if (isset($whereData["verificationKey"])) {
				$whereArray["{$prefix}User.verificationKey"] = $whereData["verificationKey"];
			}
			if (isset($whereData["elo"])) {
				$whereArray["{$prefix}User.elo"] = $whereData["elo"];
			}
		}
		
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("User.name" => "ASC")
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
		return array("LoginCredentials" => "userID", "Admin" => "userID", "Player" => "userID", "GameMap" => "broughtByUserID", "Attendee" => "userID", "UserPasswordReset" => "userID", "Glyph" => "authorID", "UserSettingTag" => "userID", "PowerRankingList" => "authorID", "UserCollectionHeroscapeSet" => "userID");
	}

	public static function getForeignKeys() {
		return array();
	}

	public static function getColumnNames() {
		return array("id", "userName", "email", "phoneNumber", "firstName", "lastName", "siteAdmin", "verified", "verificationKey", "elo");
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
			return $user->id == $this->id;
		}
		return false;
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return true;
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

	// @DoNotUpdate
	public function columnIsViewableByUser($columnName) {
		switch ($columnName) {
			case 'id':
			case 'userName':
			case 'players':
				return true;
		}
		return $this->isEditableByUser();
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
		if (LoginCredentials::countEntries(array("LoginCredentials.userID" => $this->id)) > 0) {
			return "Unable to delete User because one or more Login Credentials is dependent on it.";
		}
		if (Admin::countEntries(array("Admin.userID" => $this->id)) > 0) {
			return "Unable to delete User because one or more Admin is dependent on it.";
		}
		if (Player::countEntries(array("Player.userID" => $this->id)) > 0) {
			return "Unable to delete User because one or more Player is dependent on it.";
		}
		if (GameMap::countEntries(array("GameMap.broughtByUserID" => $this->id)) > 0) {
			return "Unable to delete User because one or more Game Map is dependent on it.";
		}
		if (Attendee::countEntries(array("Attendee.userID" => $this->id)) > 0) {
			return "Unable to delete User because one or more Attendee is dependent on it.";
		}
		if (UserPasswordReset::countEntries(array("UserPasswordReset.userID" => $this->id)) > 0) {
			return "Unable to delete User because one or more User Password Reset is dependent on it.";
		}
		if (Glyph::countEntries(array("Glyph.authorID" => $this->id)) > 0) {
			return "Unable to delete User because one or more Glyph is dependent on it.";
		}
		if (UserSettingTag::countEntries(array("UserSettingTag.userID" => $this->id)) > 0) {
			return "Unable to delete User because one or more User Setting Tag is dependent on it.";
		}
		if (PowerRankingList::countEntries(array("PowerRankingList.authorID" => $this->id)) > 0) {
			return "Unable to delete User because one or more Power Ranking List is dependent on it.";
		}
		if (UserCollectionHeroscapeSet::countEntries(array("UserCollectionHeroscapeSet.userID" => $this->id)) > 0) {
			return "Unable to delete User because one or more User Collection Heroscape Set is dependent on it.";
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
			if (isset($clientDataObj->userName)) {
				if (isset($clientDataObj->userName) && $this->userName != $clientDataObj->userName && self::exists(array("userName" => $clientDataObj->userName))) {
					return "A User already exists with that userName - you cannot have duplicate entries.";
				}
				$this->userName = $clientDataObj->userName;
			}
			if (isset($clientDataObj->email)) {
				if (isset($clientDataObj->email) && $this->email != $clientDataObj->email && self::exists(array("email" => $clientDataObj->email))) {
					return "A User already exists with that email - you cannot have duplicate entries.";
				}
				$this->email = $clientDataObj->email;
			}
			if (property_exists($clientDataObj, "phoneNumber")) {
				$this->phoneNumber = $clientDataObj->phoneNumber;
			}
			if (property_exists($clientDataObj, "firstName")) {
				$this->firstName = $clientDataObj->firstName;
			}
			if (property_exists($clientDataObj, "lastName")) {
				$this->lastName = $clientDataObj->lastName;
			}
			if (isset($clientDataObj->siteAdmin)) {
				$this->siteAdmin = $clientDataObj->siteAdmin;
			}
			if (isset($clientDataObj->verified)) {
				$this->verified = $clientDataObj->verified;
			}
			if (property_exists($clientDataObj, "verificationKey")) {
				$this->verificationKey = $clientDataObj->verificationKey;
			}
			if (property_exists($clientDataObj, "elo")) {
				$this->elo = $clientDataObj->elo;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("User",
				array("userName", "email", "phoneNumber", "firstName", "lastName", "siteAdmin", "verified", "verificationKey", "elo"),
				array($this->userName, $this->email, $this->phoneNumber, $this->firstName, $this->lastName, $this->siteAdmin, $this->verified, $this->verificationKey, $this->elo))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->loginCredentialss) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->loginCredentialss as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = LoginCredentials::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->user = $this;
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
					$clientLinkObj->user = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->players) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->players as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Player::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->user = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->gameMaps) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->gameMaps as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = GameMap::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->broughtByUser = $this;
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
					$clientLinkObj->user = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->userPasswordResets) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->userPasswordResets as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = UserPasswordReset::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->user = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->glyphs) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->glyphs as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Glyph::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->author = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->userSettingTags) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->userSettingTags as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = UserSettingTag::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->user = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->powerRankingLists) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->powerRankingLists as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = PowerRankingList::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->author = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->userCollectionHeroscapeSets) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->userCollectionHeroscapeSets as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = UserCollectionHeroscapeSet::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->user = $this;
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
			delete("User")->
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
