<?php

class DeltaUpdateCost extends HS_DatabaseObject {
	protected $id; // Int
	protected $cardID; // Int
	protected $deltaUpdateID; // Int
	protected $points; // Int
	protected $vcPoints; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["DeltaUpdateCost"])) {
			$OBJECT_MAP["DeltaUpdateCost"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["DeltaUpdateCost"][$id])) {
			$obj = $OBJECT_MAP["DeltaUpdateCost"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["DeltaUpdateCost"][$id] = $obj;
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
			return "A Delta Update Cost already exists with that id - you cannot have duplicate entries.";
		}
		
		if ( ! isset($clientDataObj->card->id)) {
			$clientDataObj->card = Card::create($clientDataObj->card);
		}
		if ( ! isset($clientDataObj->deltaUpdate->id)) {
			$clientDataObj->deltaUpdate = DeltaUpdate::create($clientDataObj->deltaUpdate);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("DeltaUpdateCost",
				array("cardID", "deltaUpdateID", "points", "vcPoints"),
				array($clientDataObj->card->id,
					$clientDataObj->deltaUpdate->id,
					$clientDataObj->points,
					$clientDataObj->vcPoints)));
		
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
			$whereArray["{$prefix}DeltaUpdateCost.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("card", $whereData)) {
				if (isset($whereData["card"]->id)) {
					$whereArray["{$prefix}DeltaUpdateCost.cardID"] = $whereData["card"]->id;
				} else if ($whereData["card"] == null) {
					$whereArray["{$prefix}DeltaUpdateCost.cardID"] = null;
				}
			}
			if (array_key_exists("deltaUpdate", $whereData)) {
				if (isset($whereData["deltaUpdate"]->id)) {
					$whereArray["{$prefix}DeltaUpdateCost.deltaUpdateID"] = $whereData["deltaUpdate"]->id;
				} else if ($whereData["deltaUpdate"] == null) {
					$whereArray["{$prefix}DeltaUpdateCost.deltaUpdateID"] = null;
				}
			}
			if (isset($whereData["points"])) {
				$whereArray["{$prefix}DeltaUpdateCost.points"] = $whereData["points"];
			}
			if (isset($whereData["vcPoints"])) {
				$whereArray["{$prefix}DeltaUpdateCost.vcPoints"] = $whereData["vcPoints"];
			}
		}
		
		if (isset($whereData["card"])) {
			$whereArray = array_merge($whereArray, Card::createWhereArray($whereData["card"], "{$prefix}DeltaUpdateCost_cardID_"));
		}
		if (isset($whereData["deltaUpdate"])) {
			$whereArray = array_merge($whereArray, DeltaUpdate::createWhereArray($whereData["deltaUpdate"], "{$prefix}DeltaUpdateCost_deltaUpdateID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("DeltaUpdateCost.name" => "ASC")
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
		return array("cardID" => "Card", "deltaUpdateID" => "DeltaUpdate");
	}

	public static function getColumnNames() {
		return array("id", "cardID", "deltaUpdateID", "points", "vcPoints");
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
			if (isset($clientDataObj->card, $clientDataObj->card->id) &&
					$clientDataObj->card->id > 0) {
					$this->cardID = $clientDataObj->card->id;
			}
			if (isset($clientDataObj->deltaUpdate, $clientDataObj->deltaUpdate->id) &&
					$clientDataObj->deltaUpdate->id > 0) {
					$this->deltaUpdateID = $clientDataObj->deltaUpdate->id;
			}
			if (isset($clientDataObj->points)) {
				$this->points = $clientDataObj->points;
			}
			if (isset($clientDataObj->vcPoints)) {
				$this->vcPoints = $clientDataObj->vcPoints;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->card) && ( ! isset($clientDataObj->updateClasses) || (in_array("Card", $clientDataObj->updateClasses))) && in_array("card", $clientDataObj->fieldsToUpdate) && ! isset($this->cardIDJustCreated)) {
				(Card::fromDB($this->cardID))->updateInDB($clientDataObj->card);
			}
			if (isset($clientDataObj->deltaUpdate) && ( ! isset($clientDataObj->updateClasses) || (in_array("DeltaUpdate", $clientDataObj->updateClasses))) && in_array("deltaUpdate", $clientDataObj->fieldsToUpdate) && ! isset($this->deltaUpdateIDJustCreated)) {
				(DeltaUpdate::fromDB($this->deltaUpdateID))->updateInDB($clientDataObj->deltaUpdate);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("DeltaUpdateCost",
				array("cardID", "deltaUpdateID", "points", "vcPoints"),
				array($this->cardID, $this->deltaUpdateID, $this->points, $this->vcPoints))->
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
			delete("DeltaUpdateCost")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getCard() {
		if ( ! property_exists($this, "card")) {
			$this->card = Card::fromDB($this->cardID);
		}
		return $this->card;
	}

	public function getDeltaUpdate() {
		if ( ! property_exists($this, "deltaUpdate")) {
			$this->deltaUpdate = DeltaUpdate::fromDB($this->deltaUpdateID);
		}
		return $this->deltaUpdate;
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
