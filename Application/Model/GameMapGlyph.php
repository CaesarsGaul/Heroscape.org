<?php

class GameMapGlyph extends HS_DatabaseObject {
	protected $id; // Int
	protected $gameMapID; // Int
	protected $glyphID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["GameMapGlyph"])) {
			$OBJECT_MAP["GameMapGlyph"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["GameMapGlyph"][$id])) {
			$obj = $OBJECT_MAP["GameMapGlyph"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["GameMapGlyph"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->gameMap->id)) {
			$clientDataObj->gameMap = GameMap::create($clientDataObj->gameMap);
		}
		if ( ! isset($clientDataObj->glyph->id)) {
			$clientDataObj->glyph = Glyph::create($clientDataObj->glyph);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("GameMapGlyph",
				array("gameMapID", "glyphID"),
				array($clientDataObj->gameMap->id,
					$clientDataObj->glyph->id)));
		
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
			$whereArray["{$prefix}GameMapGlyph.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("gameMap", $whereData)) {
				if (isset($whereData["gameMap"]->id)) {
					$whereArray["{$prefix}GameMapGlyph.gameMapID"] = $whereData["gameMap"]->id;
				} else if ($whereData["gameMap"] == null) {
					$whereArray["{$prefix}GameMapGlyph.gameMapID"] = null;
				}
			}
			if (array_key_exists("glyph", $whereData)) {
				if (isset($whereData["glyph"]->id)) {
					$whereArray["{$prefix}GameMapGlyph.glyphID"] = $whereData["glyph"]->id;
				} else if ($whereData["glyph"] == null) {
					$whereArray["{$prefix}GameMapGlyph.glyphID"] = null;
				}
			}
		}
		
		if (isset($whereData["gameMap"])) {
			$whereArray = array_merge($whereArray, GameMap::createWhereArray($whereData["gameMap"], "{$prefix}GameMapGlyph_gameMapID_"));
		}
		if (isset($whereData["glyph"])) {
			$whereArray = array_merge($whereArray, Glyph::createWhereArray($whereData["glyph"], "{$prefix}GameMapGlyph_glyphID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("GameMapGlyph.name" => "ASC")
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
		return array("gameMapID" => "GameMap", "glyphID" => "Glyph");
	}

	public static function getColumnNames() {
		return array("id", "gameMapID", "glyphID");
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
		return $this->getGameMap()->isEditableByUser();
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return true;
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
			if (isset($clientDataObj->gameMap, $clientDataObj->gameMap->id) &&
					$clientDataObj->gameMap->id > 0) {
					$this->gameMapID = $clientDataObj->gameMap->id;
			}
			if (isset($clientDataObj->glyph, $clientDataObj->glyph->id) &&
					$clientDataObj->glyph->id > 0) {
					$this->glyphID = $clientDataObj->glyph->id;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->gameMap) && ( ! isset($clientDataObj->updateClasses) || (in_array("GameMap", $clientDataObj->updateClasses))) && in_array("gameMap", $clientDataObj->fieldsToUpdate) && ! isset($this->gameMapIDJustCreated)) {
				(GameMap::fromDB($this->gameMapID))->updateInDB($clientDataObj->gameMap);
			}
			if (isset($clientDataObj->glyph) && ( ! isset($clientDataObj->updateClasses) || (in_array("Glyph", $clientDataObj->updateClasses))) && in_array("glyph", $clientDataObj->fieldsToUpdate) && ! isset($this->glyphIDJustCreated)) {
				(Glyph::fromDB($this->glyphID))->updateInDB($clientDataObj->glyph);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("GameMapGlyph",
				array("gameMapID", "glyphID"),
				array($this->gameMapID, $this->glyphID))->
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
			delete("GameMapGlyph")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getGameMap() {
		if ( ! property_exists($this, "gameMap")) {
			$this->gameMap = GameMap::fromDB($this->gameMapID);
		}
		return $this->gameMap;
	}

	public function getGlyph() {
		if ( ! property_exists($this, "glyph")) {
			$this->glyph = Glyph::fromDB($this->glyphID);
		}
		return $this->glyph;
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
