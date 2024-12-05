<?php

class OnlineMapTerrainPiece extends HS_DatabaseObject {
	protected $id; // Int
	protected $onlineMapID; // Int
	protected $terrainPieceID; // Int
	protected $level; // Int
	protected $column; // Int
	protected $row; // Int
	protected $direction; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["OnlineMapTerrainPiece"])) {
			$OBJECT_MAP["OnlineMapTerrainPiece"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["OnlineMapTerrainPiece"][$id])) {
			$obj = $OBJECT_MAP["OnlineMapTerrainPiece"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["OnlineMapTerrainPiece"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_id($id, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("id" => $id));
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		if (isset($clientDataObj->id) && self::exists(array("id" => $clientDataObj->id))) {
			return "A Online Map Terrain Piece already exists with that id - you cannot have duplicate entries.";
		}
		
		if ( ! isset($clientDataObj->onlineMap->id)) {
			$clientDataObj->onlineMap = OnlineMap::create($clientDataObj->onlineMap);
		}
		if ( ! isset($clientDataObj->terrainPiece->id)) {
			$clientDataObj->terrainPiece = TerrainPiece::create($clientDataObj->terrainPiece);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("OnlineMapTerrainPiece",
				array("onlineMapID", "terrainPieceID", "level", "column", "row", "direction"),
				array($clientDataObj->onlineMap->id,
					$clientDataObj->terrainPiece->id,
					$clientDataObj->level,
					$clientDataObj->column,
					$clientDataObj->row,
					$clientDataObj->direction)));
		
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
			$whereArray["{$prefix}OnlineMapTerrainPiece.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("onlineMap", $whereData)) {
				if (isset($whereData["onlineMap"]->id)) {
					$whereArray["{$prefix}OnlineMapTerrainPiece.onlineMapID"] = $whereData["onlineMap"]->id;
				} else if ($whereData["onlineMap"] == null) {
					$whereArray["{$prefix}OnlineMapTerrainPiece.onlineMapID"] = null;
				}
			}
			if (array_key_exists("terrainPiece", $whereData)) {
				if (isset($whereData["terrainPiece"]->id)) {
					$whereArray["{$prefix}OnlineMapTerrainPiece.terrainPieceID"] = $whereData["terrainPiece"]->id;
				} else if ($whereData["terrainPiece"] == null) {
					$whereArray["{$prefix}OnlineMapTerrainPiece.terrainPieceID"] = null;
				}
			}
			if (isset($whereData["level"])) {
				$whereArray["{$prefix}OnlineMapTerrainPiece.level"] = $whereData["level"];
			}
			if (isset($whereData["column"])) {
				$whereArray["{$prefix}OnlineMapTerrainPiece.column"] = $whereData["column"];
			}
			if (isset($whereData["row"])) {
				$whereArray["{$prefix}OnlineMapTerrainPiece.row"] = $whereData["row"];
			}
			if (isset($whereData["direction"])) {
				$whereArray["{$prefix}OnlineMapTerrainPiece.direction"] = $whereData["direction"];
			}
		}
		
		if (isset($whereData["onlineMap"])) {
			$whereArray = array_merge($whereArray, OnlineMap::createWhereArray($whereData["onlineMap"], "{$prefix}OnlineMapTerrainPiece_onlineMapID_"));
		}
		if (isset($whereData["terrainPiece"])) {
			$whereArray = array_merge($whereArray, TerrainPiece::createWhereArray($whereData["terrainPiece"], "{$prefix}OnlineMapTerrainPiece_terrainPieceID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("OnlineMapTerrainPiece.name" => "ASC")
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
		return array("onlineMapID" => "OnlineMap", "terrainPieceID" => "TerrainPiece");
	}

	public static function getColumnNames() {
		return array("id", "onlineMapID", "terrainPieceID", "level", "column", "row", "direction");
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
			if (isset($clientDataObj->onlineMap, $clientDataObj->onlineMap->id) &&
					$clientDataObj->onlineMap->id > 0) {
					$this->onlineMapID = $clientDataObj->onlineMap->id;
			}
			if (isset($clientDataObj->terrainPiece, $clientDataObj->terrainPiece->id) &&
					$clientDataObj->terrainPiece->id > 0) {
					$this->terrainPieceID = $clientDataObj->terrainPiece->id;
			}
			if (isset($clientDataObj->level)) {
				$this->level = $clientDataObj->level;
			}
			if (isset($clientDataObj->column)) {
				$this->column = $clientDataObj->column;
			}
			if (isset($clientDataObj->row)) {
				$this->row = $clientDataObj->row;
			}
			if (isset($clientDataObj->direction)) {
				$this->direction = $clientDataObj->direction;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->onlineMap) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineMap", $clientDataObj->updateClasses))) && in_array("onlineMap", $clientDataObj->fieldsToUpdate) && ! isset($this->onlineMapIDJustCreated)) {
				(OnlineMap::fromDB($this->onlineMapID))->updateInDB($clientDataObj->onlineMap);
			}
			if (isset($clientDataObj->terrainPiece) && ( ! isset($clientDataObj->updateClasses) || (in_array("TerrainPiece", $clientDataObj->updateClasses))) && in_array("terrainPiece", $clientDataObj->fieldsToUpdate) && ! isset($this->terrainPieceIDJustCreated)) {
				(TerrainPiece::fromDB($this->terrainPieceID))->updateInDB($clientDataObj->terrainPiece);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("OnlineMapTerrainPiece",
				array("onlineMapID", "terrainPieceID", "level", "column", "row", "direction"),
				array($this->onlineMapID, $this->terrainPieceID, $this->level, $this->column, $this->row, $this->direction))->
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
			delete("OnlineMapTerrainPiece")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getOnlineMap() {
		if ( ! property_exists($this, "onlineMap")) {
			$this->onlineMap = OnlineMap::fromDB($this->onlineMapID);
		}
		return $this->onlineMap;
	}

	public function getTerrainPiece() {
		if ( ! property_exists($this, "terrainPiece")) {
			$this->terrainPiece = TerrainPiece::fromDB($this->terrainPieceID);
		}
		return $this->terrainPiece;
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
