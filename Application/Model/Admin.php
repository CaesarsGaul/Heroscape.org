<?php

class Admin extends HS_DatabaseObject {
	protected $id; // Int
	protected $userID; // Int
	protected $conventionID; // Int
	protected $tournamentID; // Int
	protected $leagueID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["Admin"])) {
			$OBJECT_MAP["Admin"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["Admin"][$id])) {
			$obj = $OBJECT_MAP["Admin"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["Admin"][$id] = $obj;
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
		if (isset($clientDataObj->convention) &&
				! isset($clientDataObj->convention->id)) {
			$clientDataObj->convention = Convention::create($clientDataObj->convention);
		}
		if (isset($clientDataObj->league) &&
				! isset($clientDataObj->league->id)) {
			$clientDataObj->league = League::create($clientDataObj->league);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("Admin",
				array("userID", "conventionID", "tournamentID", "leagueID"),
				array($clientDataObj->user->id,
					isset($clientDataObj->convention) 
						? $clientDataObj->convention->id
						: null,
					isset($clientDataObj->tournament) 
						? $clientDataObj->tournament->id
						: null,
					isset($clientDataObj->league) 
						? $clientDataObj->league->id
						: null)));
		
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
			$whereArray["{$prefix}Admin.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("user", $whereData)) {
				if (isset($whereData["user"]->id)) {
					$whereArray["{$prefix}Admin.userID"] = $whereData["user"]->id;
				} else if ($whereData["user"] == null) {
					$whereArray["{$prefix}Admin.userID"] = null;
				}
			}
			if (array_key_exists("convention", $whereData)) {
				if (isset($whereData["convention"]->id)) {
					$whereArray["{$prefix}Admin.conventionID"] = $whereData["convention"]->id;
				} else if ($whereData["convention"] == null) {
					$whereArray["{$prefix}Admin.conventionID"] = null;
				}
			}
			if (array_key_exists("tournament", $whereData)) {
				if (isset($whereData["tournament"]->id)) {
					$whereArray["{$prefix}Admin.tournamentID"] = $whereData["tournament"]->id;
				} else if ($whereData["tournament"] == null) {
					$whereArray["{$prefix}Admin.tournamentID"] = null;
				}
			}
			if (array_key_exists("league", $whereData)) {
				if (isset($whereData["league"]->id)) {
					$whereArray["{$prefix}Admin.leagueID"] = $whereData["league"]->id;
				} else if ($whereData["league"] == null) {
					$whereArray["{$prefix}Admin.leagueID"] = null;
				}
			}
		}
		
		if (isset($whereData["user"])) {
			$whereArray = array_merge($whereArray, User::createWhereArray($whereData["user"], "{$prefix}Admin_userID_"));
		}
		if (isset($whereData["convention"])) {
			$whereArray = array_merge($whereArray, Convention::createWhereArray($whereData["convention"], "{$prefix}Admin_conventionID_"));
		}
		if (isset($whereData["tournament"])) {
			$whereArray = array_merge($whereArray, Tournament::createWhereArray($whereData["tournament"], "{$prefix}Admin_tournamentID_"));
		}
		if (isset($whereData["league"])) {
			$whereArray = array_merge($whereArray, League::createWhereArray($whereData["league"], "{$prefix}Admin_leagueID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("Admin.name" => "ASC")
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
		return array("userID" => "User", "conventionID" => "Convention", "tournamentID" => "Tournament", "leagueID" => "League");
	}

	public static function getColumnNames() {
		return array("id", "userID", "conventionID", "tournamentID", "leagueID");
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
			if (property_exists($clientDataObj, "convention")) {
				if (isset($clientDataObj->convention)) {
					if (isset($clientDataObj->convention->id) && $clientDataObj->convention->id > 0) {
						$this->conventionID = $clientDataObj->convention->id;
					} else {
						$this->conventionID = (Convention::create($clientDataObj->convention))->id;
						$this->conventionIDJustCreated = true;
					}
				} else {
					$this->conventionID = null;
				}
			}
			if (property_exists($clientDataObj, "tournament")) {
				if (isset($clientDataObj->tournament)) {
					if (isset($clientDataObj->tournament->id) && $clientDataObj->tournament->id > 0) {
						$this->tournamentID = $clientDataObj->tournament->id;
					} else {
						$this->tournamentID = (Tournament::create($clientDataObj->tournament))->id;
						$this->tournamentIDJustCreated = true;
					}
				} else {
					$this->tournamentID = null;
				}
			}
			if (property_exists($clientDataObj, "league")) {
				if (isset($clientDataObj->league)) {
					if (isset($clientDataObj->league->id) && $clientDataObj->league->id > 0) {
						$this->leagueID = $clientDataObj->league->id;
					} else {
						$this->leagueID = (League::create($clientDataObj->league))->id;
						$this->leagueIDJustCreated = true;
					}
				} else {
					$this->leagueID = null;
				}
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
			if (isset($clientDataObj->tournament) && ( ! isset($clientDataObj->updateClasses) || (in_array("Tournament", $clientDataObj->updateClasses))) && in_array("tournament", $clientDataObj->fieldsToUpdate) && ! isset($this->tournamentIDJustCreated)) {
				(Tournament::childFromDB($this->tournamentID))->updateInDB($clientDataObj->tournament);
			}
			if (isset($clientDataObj->league) && ( ! isset($clientDataObj->updateClasses) || (in_array("League", $clientDataObj->updateClasses))) && in_array("league", $clientDataObj->fieldsToUpdate) && ! isset($this->leagueIDJustCreated)) {
				(League::fromDB($this->leagueID))->updateInDB($clientDataObj->league);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("Admin",
				array("userID", "conventionID", "tournamentID", "leagueID"),
				array($this->userID, $this->conventionID, $this->tournamentID, $this->leagueID))->
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
			delete("Admin")->
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
		if ($this->conventionID != null) {
			if ( ! property_exists($this, "convention")) {
				$this->convention = Convention::fromDB($this->conventionID);
			}
			return $this->convention;
		}
		return null;
	}

	public function getTournament() {
		if ($this->tournamentID != null) {
			if ( ! property_exists($this, "tournament")) {
				$this->tournament = Tournament::childFromDB($this->tournamentID);
			}
			return $this->tournament;
		}
		return null;
	}

	public function getLeague() {
		if ($this->leagueID != null) {
			if ( ! property_exists($this, "league")) {
				$this->league = League::fromDB($this->leagueID);
			}
			return $this->league;
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
