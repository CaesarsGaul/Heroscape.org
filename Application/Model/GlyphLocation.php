<?php

class GlyphLocation extends HS_DatabaseObject {
	protected $id; // Int
	protected $onlineGameID; // Int
	protected $glyphID; // Int
	protected $row; // Int
	protected $col; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["GlyphLocation"])) {
			$OBJECT_MAP["GlyphLocation"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["GlyphLocation"][$id])) {
			$obj = $OBJECT_MAP["GlyphLocation"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["GlyphLocation"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->onlineGame->id)) {
			$clientDataObj->onlineGame = OnlineGame::create($clientDataObj->onlineGame);
		}
		if ( ! isset($clientDataObj->glyph->id)) {
			$clientDataObj->glyph = Glyph::create($clientDataObj->glyph);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("GlyphLocation",
				array("onlineGameID", "glyphID", "row", "col"),
				array($clientDataObj->onlineGame->id,
					$clientDataObj->glyph->id,
					$clientDataObj->row,
					$clientDataObj->col)));
		
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
			$whereArray["{$prefix}GlyphLocation.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("onlineGame", $whereData)) {
				if (isset($whereData["onlineGame"]->id)) {
					$whereArray["{$prefix}GlyphLocation.onlineGameID"] = $whereData["onlineGame"]->id;
				} else if ($whereData["onlineGame"] == null) {
					$whereArray["{$prefix}GlyphLocation.onlineGameID"] = null;
				}
			}
			if (array_key_exists("glyph", $whereData)) {
				if (isset($whereData["glyph"]->id)) {
					$whereArray["{$prefix}GlyphLocation.glyphID"] = $whereData["glyph"]->id;
				} else if ($whereData["glyph"] == null) {
					$whereArray["{$prefix}GlyphLocation.glyphID"] = null;
				}
			}
			if (isset($whereData["row"])) {
				$whereArray["{$prefix}GlyphLocation.row"] = $whereData["row"];
			}
			if (isset($whereData["col"])) {
				$whereArray["{$prefix}GlyphLocation.col"] = $whereData["col"];
			}
		}
		
		if (isset($whereData["onlineGame"])) {
			$whereArray = array_merge($whereArray, OnlineGame::createWhereArray($whereData["onlineGame"], "{$prefix}GlyphLocation_onlineGameID_"));
		}
		if (isset($whereData["glyph"])) {
			$whereArray = array_merge($whereArray, Glyph::createWhereArray($whereData["glyph"], "{$prefix}GlyphLocation_glyphID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("GlyphLocation.name" => "ASC")
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
		return array("onlineGameID" => "OnlineGame", "glyphID" => "Glyph");
	}

	public static function getColumnNames() {
		return array("id", "onlineGameID", "glyphID", "row", "col");
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
			if (isset($clientDataObj->onlineGame, $clientDataObj->onlineGame->id) &&
					$clientDataObj->onlineGame->id > 0) {
					$this->onlineGameID = $clientDataObj->onlineGame->id;
			}
			if (isset($clientDataObj->glyph, $clientDataObj->glyph->id) &&
					$clientDataObj->glyph->id > 0) {
					$this->glyphID = $clientDataObj->glyph->id;
			}
			if (isset($clientDataObj->row)) {
				$this->row = $clientDataObj->row;
			}
			if (isset($clientDataObj->col)) {
				$this->col = $clientDataObj->col;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->onlineGame) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGame", $clientDataObj->updateClasses))) && in_array("onlineGame", $clientDataObj->fieldsToUpdate) && ! isset($this->onlineGameIDJustCreated)) {
				(OnlineGame::fromDB($this->onlineGameID))->updateInDB($clientDataObj->onlineGame);
			}
			if (isset($clientDataObj->glyph) && ( ! isset($clientDataObj->updateClasses) || (in_array("Glyph", $clientDataObj->updateClasses))) && in_array("glyph", $clientDataObj->fieldsToUpdate) && ! isset($this->glyphIDJustCreated)) {
				(Glyph::fromDB($this->glyphID))->updateInDB($clientDataObj->glyph);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("GlyphLocation",
				array("onlineGameID", "glyphID", "row", "col"),
				array($this->onlineGameID, $this->glyphID, $this->row, $this->col))->
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
			delete("GlyphLocation")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getOnlineGame() {
		if ( ! property_exists($this, "onlineGame")) {
			$this->onlineGame = OnlineGame::fromDB($this->onlineGameID);
		}
		return $this->onlineGame;
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
