<?php

class HeroscapeMapTerrainPieceQuantity extends HS_DatabaseObject {
	protected $id; // Int
	protected $heroscapeMapID; // Int
	protected $terrainPIeceID; // Int
	protected $quantity; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["HeroscapeMapTerrainPieceQuantity"])) {
			$OBJECT_MAP["HeroscapeMapTerrainPieceQuantity"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["HeroscapeMapTerrainPieceQuantity"][$id])) {
			$obj = $OBJECT_MAP["HeroscapeMapTerrainPieceQuantity"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["HeroscapeMapTerrainPieceQuantity"][$id] = $obj;
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
			return "A Heroscape Map Terrain Piece Quantity already exists with that id - you cannot have duplicate entries.";
		}
		
		if ( ! isset($clientDataObj->heroscapeMap->id)) {
			$clientDataObj->heroscapeMap = HeroscapeMap::create($clientDataObj->heroscapeMap);
		}
		if ( ! isset($clientDataObj->terrainPIece->id)) {
			$clientDataObj->terrainPIece = TerrainPiece::create($clientDataObj->terrainPIece);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeMapTerrainPieceQuantity",
				array("heroscapeMapID", "terrainPIeceID", "quantity"),
				array($clientDataObj->heroscapeMap->id,
					$clientDataObj->terrainPIece->id,
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
			$whereArray["{$prefix}HeroscapeMapTerrainPieceQuantity.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("heroscapeMap", $whereData)) {
				if (isset($whereData["heroscapeMap"]->id)) {
					$whereArray["{$prefix}HeroscapeMapTerrainPieceQuantity.heroscapeMapID"] = $whereData["heroscapeMap"]->id;
				} else if ($whereData["heroscapeMap"] == null) {
					$whereArray["{$prefix}HeroscapeMapTerrainPieceQuantity.heroscapeMapID"] = null;
				}
			}
			if (array_key_exists("terrainPIece", $whereData)) {
				if (isset($whereData["terrainPIece"]->id)) {
					$whereArray["{$prefix}HeroscapeMapTerrainPieceQuantity.terrainPIeceID"] = $whereData["terrainPIece"]->id;
				} else if ($whereData["terrainPIece"] == null) {
					$whereArray["{$prefix}HeroscapeMapTerrainPieceQuantity.terrainPIeceID"] = null;
				}
			}
			if (isset($whereData["quantity"])) {
				$whereArray["{$prefix}HeroscapeMapTerrainPieceQuantity.quantity"] = $whereData["quantity"];
			}
		}
		
		if (isset($whereData["heroscapeMap"])) {
			$whereArray = array_merge($whereArray, HeroscapeMap::createWhereArray($whereData["heroscapeMap"], "{$prefix}HeroscapeMapTerrainPieceQuantity_heroscapeMapID_"));
		}
		if (isset($whereData["terrainPIece"])) {
			$whereArray = array_merge($whereArray, TerrainPiece::createWhereArray($whereData["terrainPIece"], "{$prefix}HeroscapeMapTerrainPieceQuantity_terrainPIeceID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("HeroscapeMapTerrainPieceQuantity.name" => "ASC")
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
		return array("heroscapeMapID" => "HeroscapeMap", "terrainPIeceID" => "TerrainPiece");
	}

	public static function getColumnNames() {
		return array("id", "heroscapeMapID", "terrainPIeceID", "quantity");
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
			if (isset($clientDataObj->heroscapeMap, $clientDataObj->heroscapeMap->id) &&
					$clientDataObj->heroscapeMap->id > 0) {
					$this->heroscapeMapID = $clientDataObj->heroscapeMap->id;
			}
			if (isset($clientDataObj->terrainPIece, $clientDataObj->terrainPIece->id) &&
					$clientDataObj->terrainPIece->id > 0) {
					$this->terrainPIeceID = $clientDataObj->terrainPIece->id;
			}
			if (isset($clientDataObj->quantity)) {
				$this->quantity = $clientDataObj->quantity;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->heroscapeMap) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeMap", $clientDataObj->updateClasses))) && in_array("heroscapeMap", $clientDataObj->fieldsToUpdate) && ! isset($this->heroscapeMapIDJustCreated)) {
				(HeroscapeMap::fromDB($this->heroscapeMapID))->updateInDB($clientDataObj->heroscapeMap);
			}
			if (isset($clientDataObj->terrainPIece) && ( ! isset($clientDataObj->updateClasses) || (in_array("TerrainPiece", $clientDataObj->updateClasses))) && in_array("terrainPIece", $clientDataObj->fieldsToUpdate) && ! isset($this->terrainPIeceIDJustCreated)) {
				(TerrainPiece::fromDB($this->terrainPIeceID))->updateInDB($clientDataObj->terrainPIece);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("HeroscapeMapTerrainPieceQuantity",
				array("heroscapeMapID", "terrainPIeceID", "quantity"),
				array($this->heroscapeMapID, $this->terrainPIeceID, $this->quantity))->
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
			delete("HeroscapeMapTerrainPieceQuantity")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getHeroscapeMap() {
		if ( ! property_exists($this, "heroscapeMap")) {
			$this->heroscapeMap = HeroscapeMap::fromDB($this->heroscapeMapID);
		}
		return $this->heroscapeMap;
	}

	public function getTerrainPIece() {
		if ( ! property_exists($this, "terrainPIece")) {
			$this->terrainPIece = TerrainPiece::fromDB($this->terrainPIeceID);
		}
		return $this->terrainPIece;
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
