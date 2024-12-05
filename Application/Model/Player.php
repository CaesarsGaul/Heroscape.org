<?php

class Player extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $userID; // Int
	protected $tournamentID; // Int
	protected $teamCaptainID; // Int
	protected $active; // Boolean

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["Player"])) {
			$OBJECT_MAP["Player"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["Player"][$id])) {
			$obj = $OBJECT_MAP["Player"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["Player"][$id] = $obj;
		}
		return $obj;
	}

	// @DoNotUpdate
	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		if (LoginCredentials::userLoggedIn()) {
			$user = LoginCredentials::getLoggedInUser();
			
			$tournament = Tournament::childFromDB($clientDataObj->tournament->id);
			
			$existingPlayers = Player::fetch(array(
				"user" => $user, 
				"tournament" => $tournament));
			foreach ($existingPlayers as $existingPlayer) {
				$existingPlayer->deleteInDB();
			}
			
			$id = $dbObj->dbInsert((new MySQLBuilder())->
				insert("Player",
					array("userID", "tournamentID"),
					array($user->id,
						$clientDataObj->tournament->id)));
			
			$dbObj = self::fromDB($id);
			
			$dbObj->createInitialLinks($clientDataObj);
			return $dbObj;
		} else {
			return null;
		}
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->players)) {
			foreach ($clientDataObj->players as $clientLinkObj) {
				$clientLinkObj->teamCaptain = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->playerArmys)) {
			foreach ($clientDataObj->playerArmys as $clientLinkObj) {
				$clientLinkObj->player = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->heroscapeGamePlayers)) {
			foreach ($clientDataObj->heroscapeGamePlayers as $clientLinkObj) {
				$clientLinkObj->player = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->bracketEntrys)) {
			foreach ($clientDataObj->bracketEntrys as $clientLinkObj) {
				$clientLinkObj->player = $this;
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
			$whereArray["{$prefix}Player.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}Player.name"] = $whereData["name"];
			}
			if (array_key_exists("user", $whereData)) {
				if (isset($whereData["user"]->id)) {
					$whereArray["{$prefix}Player.userID"] = $whereData["user"]->id;
				} else if ($whereData["user"] == null) {
					$whereArray["{$prefix}Player.userID"] = null;
				}
			}
			if (array_key_exists("tournament", $whereData)) {
				if (isset($whereData["tournament"]->id)) {
					$whereArray["{$prefix}Player.tournamentID"] = $whereData["tournament"]->id;
				} else if ($whereData["tournament"] == null) {
					$whereArray["{$prefix}Player.tournamentID"] = null;
				}
			}
			if (array_key_exists("teamCaptain", $whereData)) {
				if (isset($whereData["teamCaptain"]->id)) {
					$whereArray["{$prefix}Player.teamCaptainID"] = $whereData["teamCaptain"]->id;
				} else if ($whereData["teamCaptain"] == null) {
					$whereArray["{$prefix}Player.teamCaptainID"] = null;
				}
			}
			if (isset($whereData["active"])) {
				$whereArray["{$prefix}Player.active"] = $whereData["active"];
			}
		}
		
		if (isset($whereData["user"])) {
			$whereArray = array_merge($whereArray, User::createWhereArray($whereData["user"], "{$prefix}Player_userID_"));
		}
		if (isset($whereData["tournament"])) {
			$whereArray = array_merge($whereArray, Tournament::createWhereArray($whereData["tournament"], "{$prefix}Player_tournamentID_"));
		}
		if (isset($whereData["teamCaptain"])) {
			$whereArray = array_merge($whereArray, Player::createWhereArray($whereData["teamCaptain"], "{$prefix}Player_teamCaptainID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("Player.name" => "ASC")
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
		return array("Player" => "teamCaptainID", "PlayerArmy" => "playerID", "HeroscapeGamePlayer" => "playerID", "BracketEntry" => "playerID");
	}

	public static function getForeignKeys() {
		return array("userID" => "User", "tournamentID" => "Tournament", "teamCaptainID" => "Player");
	}

	public static function getColumnNames() {
		return array("id", "name", "userID", "tournamentID", "teamCaptainID", "active");
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
		return false;
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		/*return $this->isEditableByUser() || $this->getTournament()->started;*/
		return true;
	}

	// @DoNotUpdate
	public static function userCanCreate($implicitObjects=null) {
		if (LoginCredentials::userLoggedIn()) {
			$user = LoginCredentials::getLoggedInUser();
			if ($user->isVerified()) {
				$tournament = Tournament::childFromDB($implicitObjects->tournament->id);
				$tournamentStartTime = strtotime($tournament->startTime);
				$now = time();
				if ($now < $tournamentStartTime) {
					return true;
				}
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
	protected function deleteLinks() {
		// N-1 Links
		if (PlayerArmy::countEntries(array("PlayerArmy.playerID" => $this->id)) > 0) {
			self::deleteEntries(PlayerArmy::fetch(array("player" => $this)));
		}
		if (Game::countEntries(array("Game.player1ID" => $this->id)) > 0) {
			return "Unable to delete Player because one or more Game is dependent on it.";
		}
		
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
		
		if ($clientDataObj != null) {
			if (isset($clientDataObj->name)) {
				$this->name = $clientDataObj->name;
			}
			if (isset($clientDataObj->active)) {
				$this->active = $clientDataObj->active;
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("Player",
				array("name", "userID", "tournamentID", "teamCaptainID", "active"),
				array($this->name, $this->userID, $this->tournamentID, $this->teamCaptainID, $this->active))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->players) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->players as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Player::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->teamCaptain = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->playerArmys) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->playerArmys as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = PlayerArmy::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->player = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->heroscapeGamePlayers) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->heroscapeGamePlayers as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = HeroscapeGamePlayer::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->player = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->bracketEntrys) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->bracketEntrys as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = BracketEntry::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->player = $this;
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
			delete("Player")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getUser() {
		if ($this->userID != null) {
			if ( ! property_exists($this, "user")) {
				$this->user = User::fromDB($this->userID);
			}
			return $this->user;
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

	public function getTeamCaptain() {
		if ($this->teamCaptainID != null) {
			if ( ! property_exists($this, "teamCaptain")) {
				$this->teamCaptain = Player::fromDB($this->teamCaptainID);
			}
			return $this->teamCaptain;
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
