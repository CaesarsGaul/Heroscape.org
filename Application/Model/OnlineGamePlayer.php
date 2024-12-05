<?php

class OnlineGamePlayer extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $gameID; // Int
	protected $userID; // Int
	protected $playerID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["OnlineGamePlayer"])) {
			$OBJECT_MAP["OnlineGamePlayer"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["OnlineGamePlayer"][$id])) {
			$obj = $OBJECT_MAP["OnlineGamePlayer"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["OnlineGamePlayer"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->game->id)) {
			$clientDataObj->game = OnlineGame::create($clientDataObj->game);
		}
		if (isset($clientDataObj->user) &&
				! isset($clientDataObj->user->id)) {
			$clientDataObj->user = User::create($clientDataObj->user);
		}
		if (isset($clientDataObj->player) &&
				! isset($clientDataObj->player->id)) {
			$clientDataObj->player = Player::create($clientDataObj->player);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("OnlineGamePlayer",
				array("name", "gameID", "userID", "playerID"),
				array($clientDataObj->name,
					$clientDataObj->game->id,
					isset($clientDataObj->user) 
						? $clientDataObj->user->id
						: null,
					isset($clientDataObj->player) 
						? $clientDataObj->player->id
						: null)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->onlineGamePlayerFigures)) {
			foreach ($clientDataObj->onlineGamePlayerFigures as $clientLinkObj) {
				$clientLinkObj->player = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->onlineGameOrderMarkerss)) {
			foreach ($clientDataObj->onlineGameOrderMarkerss as $clientLinkObj) {
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
			$whereArray["{$prefix}OnlineGamePlayer.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}OnlineGamePlayer.name"] = $whereData["name"];
			}
			if (array_key_exists("game", $whereData)) {
				if (isset($whereData["game"]->id)) {
					$whereArray["{$prefix}OnlineGamePlayer.gameID"] = $whereData["game"]->id;
				} else if ($whereData["game"] == null) {
					$whereArray["{$prefix}OnlineGamePlayer.gameID"] = null;
				}
			}
			if (array_key_exists("user", $whereData)) {
				if (isset($whereData["user"]->id)) {
					$whereArray["{$prefix}OnlineGamePlayer.userID"] = $whereData["user"]->id;
				} else if ($whereData["user"] == null) {
					$whereArray["{$prefix}OnlineGamePlayer.userID"] = null;
				}
			}
			if (array_key_exists("player", $whereData)) {
				if (isset($whereData["player"]->id)) {
					$whereArray["{$prefix}OnlineGamePlayer.playerID"] = $whereData["player"]->id;
				} else if ($whereData["player"] == null) {
					$whereArray["{$prefix}OnlineGamePlayer.playerID"] = null;
				}
			}
		}
		
		if (isset($whereData["game"])) {
			$whereArray = array_merge($whereArray, OnlineGame::createWhereArray($whereData["game"], "{$prefix}OnlineGamePlayer_gameID_"));
		}
		if (isset($whereData["user"])) {
			$whereArray = array_merge($whereArray, User::createWhereArray($whereData["user"], "{$prefix}OnlineGamePlayer_userID_"));
		}
		if (isset($whereData["player"])) {
			$whereArray = array_merge($whereArray, Player::createWhereArray($whereData["player"], "{$prefix}OnlineGamePlayer_playerID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("OnlineGamePlayer.name" => "ASC")
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
		return array("OnlineGamePlayerFigure" => "playerID", "OnlineGameOrderMarkers" => "playerID");
	}

	public static function getForeignKeys() {
		return array("gameID" => "OnlineGame", "userID" => "User", "playerID" => "Player");
	}

	public static function getColumnNames() {
		return array("id", "name", "gameID", "userID", "playerID");
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
		if (OnlineGamePlayerFigure::countEntries(array("OnlineGamePlayerFigure.playerID" => $this->id)) > 0) {
			return "Unable to delete Online Game Player because one or more Online Game Player Figure is dependent on it.";
		}
		if (OnlineGameOrderMarkers::countEntries(array("OnlineGameOrderMarkers.playerID" => $this->id)) > 0) {
			return "Unable to delete Online Game Player because one or more Online Game Order Markers is dependent on it.";
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
				$this->name = $clientDataObj->name;
			}
			if (isset($clientDataObj->game, $clientDataObj->game->id) &&
					$clientDataObj->game->id > 0) {
					$this->gameID = $clientDataObj->game->id;
			}
			if (property_exists($clientDataObj, "user")) {
				if (isset($clientDataObj->user)) {
					if (isset($clientDataObj->user->id) && $clientDataObj->user->id > 0) {
						$this->userID = $clientDataObj->user->id;
					} else {
						$this->userID = (User::create($clientDataObj->user))->id;
						$this->userIDJustCreated = true;
					}
				} else {
					$this->userID = null;
				}
			}
			if (property_exists($clientDataObj, "player")) {
				if (isset($clientDataObj->player)) {
					if (isset($clientDataObj->player->id) && $clientDataObj->player->id > 0) {
						$this->playerID = $clientDataObj->player->id;
					} else {
						$this->playerID = (Player::create($clientDataObj->player))->id;
						$this->playerIDJustCreated = true;
					}
				} else {
					$this->playerID = null;
				}
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->game) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGame", $clientDataObj->updateClasses))) && in_array("game", $clientDataObj->fieldsToUpdate) && ! isset($this->gameIDJustCreated)) {
				(OnlineGame::fromDB($this->gameID))->updateInDB($clientDataObj->game);
			}
			if (isset($clientDataObj->user) && ( ! isset($clientDataObj->updateClasses) || (in_array("User", $clientDataObj->updateClasses))) && in_array("user", $clientDataObj->fieldsToUpdate) && ! isset($this->userIDJustCreated)) {
				(User::fromDB($this->userID))->updateInDB($clientDataObj->user);
			}
			if (isset($clientDataObj->player) && ( ! isset($clientDataObj->updateClasses) || (in_array("Player", $clientDataObj->updateClasses))) && in_array("player", $clientDataObj->fieldsToUpdate) && ! isset($this->playerIDJustCreated)) {
				(Player::fromDB($this->playerID))->updateInDB($clientDataObj->player);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("OnlineGamePlayer",
				array("name", "gameID", "userID", "playerID"),
				array($this->name, $this->gameID, $this->userID, $this->playerID))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->onlineGamePlayerFigures) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineGamePlayerFigures as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineGamePlayerFigure::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->player = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->onlineGameOrderMarkerss) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineGameOrderMarkerss as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineGameOrderMarkers::fromDB($clientLinkObj->id);
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
			delete("OnlineGamePlayer")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getGame() {
		if ( ! property_exists($this, "game")) {
			$this->game = OnlineGame::fromDB($this->gameID);
		}
		return $this->game;
	}

	public function getUser() {
		if ($this->userID != null) {
			if ( ! property_exists($this, "user")) {
				$this->user = User::fromDB($this->userID);
			}
			return $this->user;
		}
		return null;
	}

	public function getPlayer() {
		if ($this->playerID != null) {
			if ( ! property_exists($this, "player")) {
				$this->player = Player::fromDB($this->playerID);
			}
			return $this->player;
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
