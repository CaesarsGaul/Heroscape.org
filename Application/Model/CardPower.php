<?php

class CardPower extends HS_DatabaseObject {
	protected $id; // Int
	protected $cardID; // Int
	protected $order; // Int
	protected $name; // String
	protected $description; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["CardPower"])) {
			$OBJECT_MAP["CardPower"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["CardPower"][$id])) {
			$obj = $OBJECT_MAP["CardPower"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["CardPower"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->card->id)) {
			$clientDataObj->card = Card::create($clientDataObj->card);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("CardPower",
				array("cardID", "order", "name", "description"),
				array($clientDataObj->card->id,
					self::countEntries(parent::orderWhereArrayFromClientDataObj($clientDataObj)),
					$clientDataObj->name,
					$clientDataObj->description)));
		
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
			$whereArray["{$prefix}CardPower.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("card", $whereData)) {
				if (isset($whereData["card"]->id)) {
					$whereArray["{$prefix}CardPower.cardID"] = $whereData["card"]->id;
				} else if ($whereData["card"] == null) {
					$whereArray["{$prefix}CardPower.cardID"] = null;
				}
			}
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}CardPower.name"] = $whereData["name"];
			}
			if (isset($whereData["description"])) {
				$whereArray["{$prefix}CardPower.description"] = $whereData["description"];
			}
		}
		
		if (isset($whereData["card"])) {
			$whereArray = array_merge($whereArray, Card::createWhereArray($whereData["card"], "{$prefix}CardPower_cardID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("CardPower.name" => "ASC")
		return array("LENGTH(CardPower.order)" => "ASC", "CardPower.order" => "ASC");
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
		return array("cardID" => "Card");
	}

	public static function getColumnNames() {
		return array("id", "cardID", "order", "name", "description");
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

	public static function columnsForOrderGroup() {
		// TODO: Fill in the array below
		return array();
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
			if (isset($clientDataObj->order)) {
				$this->order = $clientDataObj->order;
			}
			if (isset($clientDataObj->name)) {
				$this->name = $clientDataObj->name;
			}
			if (isset($clientDataObj->description)) {
				$this->description = $clientDataObj->description;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->card) && ( ! isset($clientDataObj->updateClasses) || (in_array("Card", $clientDataObj->updateClasses))) && in_array("card", $clientDataObj->fieldsToUpdate) && ! isset($this->cardIDJustCreated)) {
				(Card::fromDB($this->cardID))->updateInDB($clientDataObj->card);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("CardPower",
				array("cardID", "order", "name", "description"),
				array($this->cardID, $this->order, $this->name, $this->description))->
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
			delete("CardPower")->
			where(array("id" => $this->id)));
		
		self::cleanOrder($this->orderWhereArray());
		
		return "";
	}

	/* Getters */
	
	public function getCard() {
		if ( ! property_exists($this, "card")) {
			$this->card = Card::fromDB($this->cardID);
		}
		return $this->card;
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
