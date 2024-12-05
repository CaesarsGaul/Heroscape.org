<?php

class TerrainPiece extends HS_DatabaseObject {
	protected $id; // Int
	protected $terrainTypeID; // Int
	protected $terrainSizeID; // Int
	protected $image; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["TerrainPiece"])) {
			$OBJECT_MAP["TerrainPiece"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["TerrainPiece"][$id])) {
			$obj = $OBJECT_MAP["TerrainPiece"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["TerrainPiece"][$id] = $obj;
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
			return "A Terrain Piece already exists with that id - you cannot have duplicate entries.";
		}
		
		if ( ! isset($clientDataObj->terrainType->id)) {
			$clientDataObj->terrainType = TerrainType::create($clientDataObj->terrainType);
		}
		if ( ! isset($clientDataObj->terrainSize->id)) {
			$clientDataObj->terrainSize = TerrainSize::create($clientDataObj->terrainSize);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("TerrainPiece",
				array("terrainTypeID", "terrainSizeID", "image"),
				array($clientDataObj->terrainType->id,
					$clientDataObj->terrainSize->id,
					$clientDataObj->image)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->heroscapeSetTerrainPieceQuantitys)) {
			foreach ($clientDataObj->heroscapeSetTerrainPieceQuantitys as $clientLinkObj) {
				$clientLinkObj->terrainPiece = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->heroscapeMapTerrainPieceQuantitys)) {
			foreach ($clientDataObj->heroscapeMapTerrainPieceQuantitys as $clientLinkObj) {
				$clientLinkObj->terrainPIece = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->onlineMapTerrainPieces)) {
			foreach ($clientDataObj->onlineMapTerrainPieces as $clientLinkObj) {
				$clientLinkObj->terrainPiece = $this;
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
			$whereArray["{$prefix}TerrainPiece.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("terrainType", $whereData)) {
				if (isset($whereData["terrainType"]->id)) {
					$whereArray["{$prefix}TerrainPiece.terrainTypeID"] = $whereData["terrainType"]->id;
				} else if ($whereData["terrainType"] == null) {
					$whereArray["{$prefix}TerrainPiece.terrainTypeID"] = null;
				}
			}
			if (array_key_exists("terrainSize", $whereData)) {
				if (isset($whereData["terrainSize"]->id)) {
					$whereArray["{$prefix}TerrainPiece.terrainSizeID"] = $whereData["terrainSize"]->id;
				} else if ($whereData["terrainSize"] == null) {
					$whereArray["{$prefix}TerrainPiece.terrainSizeID"] = null;
				}
			}
			if (isset($whereData["image"])) {
				$whereArray["{$prefix}TerrainPiece.image"] = $whereData["image"];
			}
		}
		
		if (isset($whereData["terrainType"])) {
			$whereArray = array_merge($whereArray, TerrainType::createWhereArray($whereData["terrainType"], "{$prefix}TerrainPiece_terrainTypeID_"));
		}
		if (isset($whereData["terrainSize"])) {
			$whereArray = array_merge($whereArray, TerrainSize::createWhereArray($whereData["terrainSize"], "{$prefix}TerrainPiece_terrainSizeID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("TerrainPiece.name" => "ASC")
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
		return array("HeroscapeSetTerrainPieceQuantity" => "terrainPieceID", "HeroscapeMapTerrainPieceQuantity" => "terrainPIeceID", "OnlineMapTerrainPiece" => "terrainPieceID");
	}

	public static function getForeignKeys() {
		return array("terrainTypeID" => "TerrainType", "terrainSizeID" => "TerrainSize");
	}

	public static function getColumnNames() {
		return array("id", "terrainTypeID", "terrainSizeID", "image");
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
		if (HeroscapeSetTerrainPieceQuantity::countEntries(array("HeroscapeSetTerrainPieceQuantity.terrainPieceID" => $this->id)) > 0) {
			return "Unable to delete Terrain Piece because one or more Heroscape Set Terrain Piece Quantity is dependent on it.";
		}
		if (HeroscapeMapTerrainPieceQuantity::countEntries(array("HeroscapeMapTerrainPieceQuantity.terrainPIeceID" => $this->id)) > 0) {
			return "Unable to delete Terrain Piece because one or more Heroscape Map Terrain Piece Quantity is dependent on it.";
		}
		if (OnlineMapTerrainPiece::countEntries(array("OnlineMapTerrainPiece.terrainPieceID" => $this->id)) > 0) {
			return "Unable to delete Terrain Piece because one or more Online Map Terrain Piece is dependent on it.";
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
			if (isset($clientDataObj->terrainType, $clientDataObj->terrainType->id) &&
					$clientDataObj->terrainType->id > 0) {
					$this->terrainTypeID = $clientDataObj->terrainType->id;
			}
			if (isset($clientDataObj->terrainSize, $clientDataObj->terrainSize->id) &&
					$clientDataObj->terrainSize->id > 0) {
					$this->terrainSizeID = $clientDataObj->terrainSize->id;
			}
			if (property_exists($clientDataObj, "image")) {
				$this->image = $clientDataObj->image;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->terrainType) && ( ! isset($clientDataObj->updateClasses) || (in_array("TerrainType", $clientDataObj->updateClasses))) && in_array("terrainType", $clientDataObj->fieldsToUpdate) && ! isset($this->terrainTypeIDJustCreated)) {
				(TerrainType::fromDB($this->terrainTypeID))->updateInDB($clientDataObj->terrainType);
			}
			if (isset($clientDataObj->terrainSize) && ( ! isset($clientDataObj->updateClasses) || (in_array("TerrainSize", $clientDataObj->updateClasses))) && in_array("terrainSize", $clientDataObj->fieldsToUpdate) && ! isset($this->terrainSizeIDJustCreated)) {
				(TerrainSize::fromDB($this->terrainSizeID))->updateInDB($clientDataObj->terrainSize);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("TerrainPiece",
				array("terrainTypeID", "terrainSizeID", "image"),
				array($this->terrainTypeID, $this->terrainSizeID, $this->image))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->heroscapeSetTerrainPieceQuantitys) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->heroscapeSetTerrainPieceQuantitys as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = HeroscapeSetTerrainPieceQuantity::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->terrainPiece = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->heroscapeMapTerrainPieceQuantitys) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->heroscapeMapTerrainPieceQuantitys as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = HeroscapeMapTerrainPieceQuantity::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->terrainPIece = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->onlineMapTerrainPieces) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineMapTerrainPieces as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineMapTerrainPiece::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->terrainPiece = $this;
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
			delete("TerrainPiece")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getTerrainType() {
		if ( ! property_exists($this, "terrainType")) {
			$this->terrainType = TerrainType::fromDB($this->terrainTypeID);
		}
		return $this->terrainType;
	}

	public function getTerrainSize() {
		if ( ! property_exists($this, "terrainSize")) {
			$this->terrainSize = TerrainSize::fromDB($this->terrainSizeID);
		}
		return $this->terrainSize;
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
