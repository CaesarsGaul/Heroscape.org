<?php

class HeroscapeSetTerrainPieceQuantity extends HS_DatabaseObject {
	protected $id; // Int
	protected $heroscapeSetID; // Int
	protected $terrainPieceID; // Int
	protected $quantity; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["HeroscapeSetTerrainPieceQuantity"])) {
			$OBJECT_MAP["HeroscapeSetTerrainPieceQuantity"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["HeroscapeSetTerrainPieceQuantity"][$id])) {
			$obj = $OBJECT_MAP["HeroscapeSetTerrainPieceQuantity"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["HeroscapeSetTerrainPieceQuantity"][$id] = $obj;
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
			return "A Heroscape Set Terrain Piece Quantity already exists with that id - you cannot have duplicate entries.";
		}
		
		if ( ! isset($clientDataObj->heroscapeSet->id)) {
			$clientDataObj->heroscapeSet = HeroscapeSet::create($clientDataObj->heroscapeSet);
		}
		if ( ! isset($clientDataObj->terrainPiece->id)) {
			$clientDataObj->terrainPiece = TerrainPiece::create($clientDataObj->terrainPiece);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeSetTerrainPieceQuantity",
				array("heroscapeSetID", "terrainPieceID", "quantity"),
				array($clientDataObj->heroscapeSet->id,
					$clientDataObj->terrainPiece->id,
					$clientDataObj->quantity)));
		
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
			$whereArray["{$prefix}HeroscapeSetTerrainPieceQuantity.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("heroscapeSet", $whereData)) {
				if (isset($whereData["heroscapeSet"]->id)) {
					$whereArray["{$prefix}HeroscapeSetTerrainPieceQuantity.heroscapeSetID"] = $whereData["heroscapeSet"]->id;
				} else if ($whereData["heroscapeSet"] == null) {
					$whereArray["{$prefix}HeroscapeSetTerrainPieceQuantity.heroscapeSetID"] = null;
				}
			}
			if (array_key_exists("terrainPiece", $whereData)) {
				if (isset($whereData["terrainPiece"]->id)) {
					$whereArray["{$prefix}HeroscapeSetTerrainPieceQuantity.terrainPieceID"] = $whereData["terrainPiece"]->id;
				} else if ($whereData["terrainPiece"] == null) {
					$whereArray["{$prefix}HeroscapeSetTerrainPieceQuantity.terrainPieceID"] = null;
				}
			}
			if (isset($whereData["quantity"])) {
				$whereArray["{$prefix}HeroscapeSetTerrainPieceQuantity.quantity"] = $whereData["quantity"];
			}
		}
		
		if (isset($whereData["heroscapeSet"])) {
			$whereArray = array_merge($whereArray, HeroscapeSet::createWhereArray($whereData["heroscapeSet"], "{$prefix}HeroscapeSetTerrainPieceQuantity_heroscapeSetID_"));
		}
		if (isset($whereData["terrainPiece"])) {
			$whereArray = array_merge($whereArray, TerrainPiece::createWhereArray($whereData["terrainPiece"], "{$prefix}HeroscapeSetTerrainPieceQuantity_terrainPieceID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("HeroscapeSetTerrainPieceQuantity.name" => "ASC")
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
		return array("heroscapeSetID" => "HeroscapeSet", "terrainPieceID" => "TerrainPiece");
	}

	public static function getColumnNames() {
		return array("id", "heroscapeSetID", "terrainPieceID", "quantity");
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
			if (isset($clientDataObj->heroscapeSet, $clientDataObj->heroscapeSet->id) &&
					$clientDataObj->heroscapeSet->id > 0) {
					$this->heroscapeSetID = $clientDataObj->heroscapeSet->id;
			}
			if (isset($clientDataObj->terrainPiece, $clientDataObj->terrainPiece->id) &&
					$clientDataObj->terrainPiece->id > 0) {
					$this->terrainPieceID = $clientDataObj->terrainPiece->id;
			}
			if (isset($clientDataObj->quantity)) {
				$this->quantity = $clientDataObj->quantity;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->heroscapeSet) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeSet", $clientDataObj->updateClasses))) && in_array("heroscapeSet", $clientDataObj->fieldsToUpdate) && ! isset($this->heroscapeSetIDJustCreated)) {
				(HeroscapeSet::fromDB($this->heroscapeSetID))->updateInDB($clientDataObj->heroscapeSet);
			}
			if (isset($clientDataObj->terrainPiece) && ( ! isset($clientDataObj->updateClasses) || (in_array("TerrainPiece", $clientDataObj->updateClasses))) && in_array("terrainPiece", $clientDataObj->fieldsToUpdate) && ! isset($this->terrainPieceIDJustCreated)) {
				(TerrainPiece::fromDB($this->terrainPieceID))->updateInDB($clientDataObj->terrainPiece);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("HeroscapeSetTerrainPieceQuantity",
				array("heroscapeSetID", "terrainPieceID", "quantity"),
				array($this->heroscapeSetID, $this->terrainPieceID, $this->quantity))->
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
			delete("HeroscapeSetTerrainPieceQuantity")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getHeroscapeSet() {
		if ( ! property_exists($this, "heroscapeSet")) {
			$this->heroscapeSet = HeroscapeSet::fromDB($this->heroscapeSetID);
		}
		return $this->heroscapeSet;
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
