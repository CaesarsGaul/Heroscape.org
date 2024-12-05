<?php

class TerrainSize extends HS_DatabaseObject {
	protected $id; // Int
	protected $size; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["TerrainSize"])) {
			$OBJECT_MAP["TerrainSize"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["TerrainSize"][$id])) {
			$obj = $OBJECT_MAP["TerrainSize"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["TerrainSize"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_id($id, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("id" => $id));
	}

	public static function fromDB_size($size, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("size" => $size));
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		if (isset($clientDataObj->id) && self::exists(array("id" => $clientDataObj->id))) {
			return "A Terrain Size already exists with that id - you cannot have duplicate entries.";
		}
		if (isset($clientDataObj->size) && self::exists(array("size" => $clientDataObj->size))) {
			return "A Terrain Size already exists with that size - you cannot have duplicate entries.";
		}
		
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("TerrainSize",
				array("size"),
				array($clientDataObj->size)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->terrainPieces)) {
			foreach ($clientDataObj->terrainPieces as $clientLinkObj) {
				$clientLinkObj->terrainSize = $this;
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
			$whereArray["{$prefix}TerrainSize.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["size"])) {
				$whereArray["{$prefix}TerrainSize.size"] = $whereData["size"];
			}
		}
		
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("TerrainSize.name" => "ASC")
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
		return array("TerrainPiece" => "terrainSizeID");
	}

	public static function getForeignKeys() {
		return array();
	}

	public static function getColumnNames() {
		return array("id", "size");
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
		if (TerrainPiece::countEntries(array("TerrainPiece.terrainSizeID" => $this->id)) > 0) {
			return "Unable to delete Terrain Size because one or more Terrain Piece is dependent on it.";
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
			if (isset($clientDataObj->size)) {
				if (isset($clientDataObj->size) && $this->size != $clientDataObj->size && self::exists(array("size" => $clientDataObj->size))) {
					return "A Terrain Size already exists with that size - you cannot have duplicate entries.";
				}
				$this->size = $clientDataObj->size;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("TerrainSize",
				array("size"),
				array($this->size))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->terrainPieces) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->terrainPieces as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = TerrainPiece::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->terrainSize = $this;
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
			delete("TerrainSize")->
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
