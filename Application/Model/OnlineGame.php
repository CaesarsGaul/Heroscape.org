<?php

class OnlineGame extends HS_DatabaseObject {
	protected $id; // Int
	protected $created; // Datetime
	protected $mapID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["OnlineGame"])) {
			$OBJECT_MAP["OnlineGame"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["OnlineGame"][$id])) {
			$obj = $OBJECT_MAP["OnlineGame"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["OnlineGame"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->map->id)) {
			$clientDataObj->map = OnlineGameMap::create($clientDataObj->map);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("OnlineGame",
				array("created", "mapID"),
				array($clientDataObj->created,
					$clientDataObj->map->id)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->onlineGamePlayers)) {
			foreach ($clientDataObj->onlineGamePlayers as $clientLinkObj) {
				$clientLinkObj->game = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->onlineGameRounds)) {
			foreach ($clientDataObj->onlineGameRounds as $clientLinkObj) {
				$clientLinkObj->game = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->onlineGameStates)) {
			foreach ($clientDataObj->onlineGameStates as $clientLinkObj) {
				$clientLinkObj->game = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->glyphLocations)) {
			foreach ($clientDataObj->glyphLocations as $clientLinkObj) {
				$clientLinkObj->onlineGame = $this;
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
			$whereArray["{$prefix}OnlineGame.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["created"])) {
				$whereArray["{$prefix}OnlineGame.created"] = $whereData["created"];
			}
			if (array_key_exists("map", $whereData)) {
				if (isset($whereData["map"]->id)) {
					$whereArray["{$prefix}OnlineGame.mapID"] = $whereData["map"]->id;
				} else if ($whereData["map"] == null) {
					$whereArray["{$prefix}OnlineGame.mapID"] = null;
				}
			}
		}
		
		if (isset($whereData["map"])) {
			$whereArray = array_merge($whereArray, OnlineGameMap::createWhereArray($whereData["map"], "{$prefix}OnlineGame_mapID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("OnlineGame.name" => "ASC")
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
		return array("OnlineGamePlayer" => "gameID", "OnlineGameRound" => "gameID", "OnlineGameState" => "gameID", "GlyphLocation" => "onlineGameID");
	}

	public static function getForeignKeys() {
		return array("mapID" => "OnlineGameMap");
	}

	public static function getColumnNames() {
		return array("id", "created", "mapID");
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
		if (OnlineGamePlayer::countEntries(array("OnlineGamePlayer.gameID" => $this->id)) > 0) {
			return "Unable to delete Online Game because one or more Online Game Player is dependent on it.";
		}
		if (OnlineGameRound::countEntries(array("OnlineGameRound.gameID" => $this->id)) > 0) {
			return "Unable to delete Online Game because one or more Online Game Round is dependent on it.";
		}
		if (OnlineGameState::countEntries(array("OnlineGameState.gameID" => $this->id)) > 0) {
			return "Unable to delete Online Game because one or more Online Game State is dependent on it.";
		}
		if (GlyphLocation::countEntries(array("GlyphLocation.onlineGameID" => $this->id)) > 0) {
			return "Unable to delete Online Game because one or more Glyph Location is dependent on it.";
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
			if (isset($clientDataObj->created)) {
				$this->created = $clientDataObj->created;
			}
			if (isset($clientDataObj->map, $clientDataObj->map->id) &&
					$clientDataObj->map->id > 0) {
					$this->mapID = $clientDataObj->map->id;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->map) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGameMap", $clientDataObj->updateClasses))) && in_array("map", $clientDataObj->fieldsToUpdate) && ! isset($this->mapIDJustCreated)) {
				(OnlineGameMap::fromDB($this->mapID))->updateInDB($clientDataObj->map);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("OnlineGame",
				array("created", "mapID"),
				array($this->created, $this->mapID))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->onlineGamePlayers) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineGamePlayers as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineGamePlayer::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->game = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->onlineGameRounds) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineGameRounds as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineGameRound::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->game = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->onlineGameStates) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineGameStates as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineGameState::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->game = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->glyphLocations) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->glyphLocations as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = GlyphLocation::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->onlineGame = $this;
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
			delete("OnlineGame")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getMap() {
		if ( ! property_exists($this, "map")) {
			$this->map = OnlineGameMap::fromDB($this->mapID);
		}
		return $this->map;
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
