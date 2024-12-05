<?php

class GameMap extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $number; // Int
	protected $tournamentID; // Int
	protected $broughtByUserID; // Int
	protected $active; // Boolean
	protected $forStreaming; // Boolean
	protected $altOhsGdocId; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["GameMap"])) {
			$OBJECT_MAP["GameMap"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["GameMap"][$id])) {
			$obj = $OBJECT_MAP["GameMap"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["GameMap"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if (isset($clientDataObj->broughtByUser) &&
				! isset($clientDataObj->broughtByUser->id)) {
			$clientDataObj->broughtByUser = User::create($clientDataObj->broughtByUser);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("GameMap",
				array("name", "number", "tournamentID", "broughtByUserID", "active", "forStreaming", "altOhsGdocId"),
				array($clientDataObj->name,
					$clientDataObj->number,
					$clientDataObj->tournament->id,
					isset($clientDataObj->broughtByUser) 
						? $clientDataObj->broughtByUser->id
						: null,
					isset($clientDataObj->active) && $clientDataObj-> active ? true : false,
					isset($clientDataObj->forStreaming) && $clientDataObj-> forStreaming ? true : false,
					$clientDataObj->altOhsGdocId)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->heroscapeGames)) {
			foreach ($clientDataObj->heroscapeGames as $clientLinkObj) {
				$clientLinkObj->map = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->gameMapGlyphs)) {
			foreach ($clientDataObj->gameMapGlyphs as $clientLinkObj) {
				$clientLinkObj->gameMap = $this;
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
			$whereArray["{$prefix}GameMap.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}GameMap.name"] = $whereData["name"];
			}
			if (isset($whereData["number"])) {
				$whereArray["{$prefix}GameMap.number"] = $whereData["number"];
			}
			if (array_key_exists("tournament", $whereData)) {
				if (isset($whereData["tournament"]->id)) {
					$whereArray["{$prefix}GameMap.tournamentID"] = $whereData["tournament"]->id;
				} else if ($whereData["tournament"] == null) {
					$whereArray["{$prefix}GameMap.tournamentID"] = null;
				}
			}
			if (array_key_exists("broughtByUser", $whereData)) {
				if (isset($whereData["broughtByUser"]->id)) {
					$whereArray["{$prefix}GameMap.broughtByUserID"] = $whereData["broughtByUser"]->id;
				} else if ($whereData["broughtByUser"] == null) {
					$whereArray["{$prefix}GameMap.broughtByUserID"] = null;
				}
			}
			if (isset($whereData["active"])) {
				$whereArray["{$prefix}GameMap.active"] = $whereData["active"];
			}
			if (isset($whereData["forStreaming"])) {
				$whereArray["{$prefix}GameMap.forStreaming"] = $whereData["forStreaming"];
			}
			if (isset($whereData["altOhsGdocId"])) {
				$whereArray["{$prefix}GameMap.altOhsGdocId"] = $whereData["altOhsGdocId"];
			}
		}
		
		if (isset($whereData["tournament"])) {
			$whereArray = array_merge($whereArray, Tournament::createWhereArray($whereData["tournament"], "{$prefix}GameMap_tournamentID_"));
		}
		if (isset($whereData["broughtByUser"])) {
			$whereArray = array_merge($whereArray, User::createWhereArray($whereData["broughtByUser"], "{$prefix}GameMap_broughtByUserID_"));
		}
		
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array("GameMap.name" => "ASC");
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
		return array("HeroscapeGame" => "mapID", "GameMapGlyph" => "gameMapID");
	}

	public static function getForeignKeys() {
		return array("tournamentID" => "Tournament", "broughtByUserID" => "User");
	}

	public static function getColumnNames() {
		return array("id", "name", "number", "tournamentID", "broughtByUserID", "active", "forStreaming", "altOhsGdocId");
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
			$tournament = $this->getTournament();
			return $tournament->isEditableByUser();
		} 
		return false;
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return true;
	}

	// @DoNotUpdate
	public static function userCanCreate($implicitObjects=null) {
		if (LoginCredentials::userLoggedIn()) {
			$tournament = Tournament::childFromDB($implicitObjects->tournament->id);
			return $tournament->isEditableByUser();
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
		if (HeroscapeGame::countEntries(array("HeroscapeGame.mapID" => $this->id)) > 0) {
			return "Unable to delete Game Map because one or more Heroscape Game is dependent on it.";
		}
		if (GameMapGlyph::countEntries(array("GameMapGlyph.gameMapID" => $this->id)) > 0) {
			//return "Unable to delete Game Map because one or more Game Map Glyph is dependent on it.";
			self::deleteEntries(GameMapGlyph::fetch(array("gameMap" => $this)));
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
			if (isset($clientDataObj->number)) {
				$this->number = $clientDataObj->number;
			}
			if (isset($clientDataObj->tournament, $clientDataObj->tournament->id) &&
					$clientDataObj->tournament->id > 0) {
					$this->tournamentID = $clientDataObj->tournament->id;
			}
			if (property_exists($clientDataObj, "broughtByUser")) {
				if (isset($clientDataObj->broughtByUser)) {
					if (isset($clientDataObj->broughtByUser->id) && $clientDataObj->broughtByUser->id > 0) {
						$this->broughtByUserID = $clientDataObj->broughtByUser->id;
					} else {
						$this->broughtByUserID = (User::create($clientDataObj->broughtByUser))->id;
						$this->broughtByUserIDJustCreated = true;
					}
				} else {
					$this->broughtByUserID = null;
				}
			}
			if (isset($clientDataObj->active)) {
				$this->active = $clientDataObj->active;
			}
			if (isset($clientDataObj->forStreaming)) {
				$this->forStreaming = $clientDataObj->forStreaming;
			}
			if (property_exists($clientDataObj, "altOhsGdocId")) {
				$this->altOhsGdocId = $clientDataObj->altOhsGdocId;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->tournament) && ( ! isset($clientDataObj->updateClasses) || (in_array("Tournament", $clientDataObj->updateClasses))) && in_array("tournament", $clientDataObj->fieldsToUpdate) && ! isset($this->tournamentIDJustCreated)) {
				(Tournament::childFromDB($this->tournamentID))->updateInDB($clientDataObj->tournament);
			}
			if (isset($clientDataObj->broughtByUser) && ( ! isset($clientDataObj->updateClasses) || (in_array("User", $clientDataObj->updateClasses))) && in_array("broughtByUser", $clientDataObj->fieldsToUpdate) && ! isset($this->broughtByUserIDJustCreated)) {
				(User::fromDB($this->broughtByUserID))->updateInDB($clientDataObj->broughtByUser);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("GameMap",
				array("name", "number", "tournamentID", "broughtByUserID", "active", "forStreaming", "altOhsGdocId"),
				array($this->name, $this->number, $this->tournamentID, $this->broughtByUserID, $this->active, $this->forStreaming, $this->altOhsGdocId))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->heroscapeGames) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->heroscapeGames as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = HeroscapeGame::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->map = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->gameMapGlyphs) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->gameMapGlyphs as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = GameMapGlyph::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->gameMap = $this;
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
			delete("GameMap")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getTournament() {
		if ( ! property_exists($this, "tournament")) {
			$this->tournament = Tournament::childFromDB($this->tournamentID);
		}
		return $this->tournament;
	}

	public function getBroughtByUser() {
		if ($this->broughtByUserID != null) {
			if ( ! property_exists($this, "broughtByUser")) {
				$this->broughtByUser = User::fromDB($this->broughtByUserID);
			}
			return $this->broughtByUser;
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
