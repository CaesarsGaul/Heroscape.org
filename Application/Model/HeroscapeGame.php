<?php

class HeroscapeGame extends Game {
	protected $gameID; // Int
	protected $mapID; // Int
	protected $wentToTime; // Boolean

	/* Static 'Constructors' */
	
	public static function fromDB($gameID, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["HeroscapeGame"])) {
			$OBJECT_MAP["HeroscapeGame"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["HeroscapeGame"][$gameID])) {
			$obj = $OBJECT_MAP["HeroscapeGame"][$gameID];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("gameID" => $gameID), "Game", $gameID);
			$OBJECT_MAP["HeroscapeGame"][$gameID] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		Game::createGame($dbObj, $clientDataObj);
		
		
		
		if (isset($clientDataObj->map) &&
				! isset($clientDataObj->map->id)) {
			$clientDataObj->map = GameMap::create($clientDataObj->map);
		}
		
		$dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeGame",
				array("gameID", "mapID", "wentToTime"),
				array($dbObj->id,
					isset($clientDataObj->map) 
						? $clientDataObj->map->id
						: null,
					isset($clientDataObj->wentToTime) && $clientDataObj-> wentToTime ? true : false)));
		
		$dbObj = self::fromDB($dbObj->id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->heroscapeGamePlayers)) {
			foreach ($clientDataObj->heroscapeGamePlayers as $clientLinkObj) {
				$clientLinkObj->game = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		parent::createInitialLinks($clientDataObj);
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
		
		if (isset($whereData["gameID"])) {
			$whereArray["{$prefix}HeroscapeGame.gameID"] = $whereData["gameID"];
		}
		else {
			if (array_key_exists("map", $whereData)) {
				if (isset($whereData["map"]->id)) {
					$whereArray["{$prefix}HeroscapeGame.mapID"] = $whereData["map"]->id;
				} else if ($whereData["map"] == null) {
					$whereArray["{$prefix}HeroscapeGame.mapID"] = null;
				}
			}
			if (isset($whereData["wentToTime"])) {
				$whereArray["{$prefix}HeroscapeGame.wentToTime"] = $whereData["wentToTime"];
			}
		}
		
		if (isset($whereData["game"])) {
			$whereArray = array_merge($whereArray, Game::createWhereArray($whereData["game"], "{$prefix}HeroscapeGame_gameID_"));
		}
		if (isset($whereData["map"])) {
			$whereArray = array_merge($whereArray, GameMap::createWhereArray($whereData["map"], "{$prefix}HeroscapeGame_mapID_"));
		}
		
		
		return array_merge($whereArray, parent::createWhereArray($whereData, $prefix));
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("HeroscapeGame.name" => "ASC")
		return array_merge(array(), parent::getOrderBy());
	}

	public static function getPrimaryKey() {
		return "gameID";
	}

	public static function getNToMLinkClasses() {
		return array_merge(array(), parent::getNToMLinkClasses());
	}

	public static function getNToMLinkClassesWithType() {
		return array_merge(array(), parent::getNToMLinkClassesWithType());
	}

	public static function getNToMLinkClassesWithJSVariableName() {
		return array_merge(array(), parent::getNToMLinkClassesWithJSVariableName());
	}

	public static function getNTo1LinkClasses() {
		return array_merge(array("HeroscapeGamePlayer" => "gameID"), parent::getNTo1LinkClasses());
	}

	public static function getForeignKeys() {
		return array_merge(array("mapID" => "GameMap"), parent::getForeignKeys());
	}

	public static function getColumnNames() {
		return array_merge(array("gameID", "mapID", "wentToTime"), parent::getColumnNames());
	}

	public static function getActionNames() {
		return array_merge(array(), parent::getActionNames());
	}

	public function performAction($action) {
		switch ($action->name) {
			default:
				return parent::performAction($action);
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
				return parent::userCanPerformAction($actionName);
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
		if (HeroscapeGamePlayer::countEntries(array("HeroscapeGamePlayer.gameID" => $this->gameID)) > 0) {
			return "Unable to delete Heroscape Game because one or more Heroscape Game Player is dependent on it.";
		}
		
		// N-M Links
		return parent::deleteLinks();
	}

	/* Inherited DatabaseObject Functions */
	
	public function updateInDB($clientDataObj = null) {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to update this value.";
		}
		
		if ($this->gameID == null) {
			return "Unknown Error";
		}
		
		if ($clientDataObj != null) {
			if (property_exists($clientDataObj, "map")) {
				if (isset($clientDataObj->map)) {
					if (isset($clientDataObj->map->id) && $clientDataObj->map->id > 0) {
						$this->mapID = $clientDataObj->map->id;
					} else {
						$this->mapID = (GameMap::create($clientDataObj->map))->id;
						$this->mapIDJustCreated = true;
					}
				} else {
					$this->mapID = null;
				}
			}
			if (isset($clientDataObj->wentToTime)) {
				$this->wentToTime = $clientDataObj->wentToTime;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->map) && ( ! isset($clientDataObj->updateClasses) || (in_array("GameMap", $clientDataObj->updateClasses))) && in_array("map", $clientDataObj->fieldsToUpdate) && ! isset($this->mapIDJustCreated)) {
				(GameMap::fromDB($this->mapID))->updateInDB($clientDataObj->map);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("HeroscapeGame",
				array("mapID", "wentToTime"),
				array($this->mapID, $this->wentToTime))->
			where(array("gameID" => $this->gameID)));
		
		// Update 1-N Links
		if (isset($clientDataObj->heroscapeGamePlayers) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->heroscapeGamePlayers as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = HeroscapeGamePlayer::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->game = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		
		
		return parent::updateInDB($clientDataObj);
	}

	public function deleteInDB() {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to delete this value.";
		}
		
		if ($this->gameID == null) {
			return "Unknown Error";
		}
		
		$deleteLinksMsg = $this->deleteLinks();
		if (strlen($deleteLinksMsg) > 0) {
			return $deleteLinksMsg;
		}
		
		$this->dbDelete((new MySQLBuilder())->
			delete("HeroscapeGame")->
			where(array("gameID" => $this->gameID)));
		
		return parent::deleteInDB();
	}

	/* Getters */
	
	public function getMap() {
		if ($this->mapID != null) {
			if ( ! property_exists($this, "map")) {
				$this->map = GameMap::fromDB($this->mapID);
			}
			return $this->map;
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
