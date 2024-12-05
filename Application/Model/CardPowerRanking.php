<?php

class CardPowerRanking extends HS_DatabaseObject {
	protected $id; // Int
	protected $cardID; // Int
	protected $powerRankingListID; // Int
	protected $ranking; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["CardPowerRanking"])) {
			$OBJECT_MAP["CardPowerRanking"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["CardPowerRanking"][$id])) {
			$obj = $OBJECT_MAP["CardPowerRanking"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["CardPowerRanking"][$id] = $obj;
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
			return "A Card Power Ranking already exists with that id - you cannot have duplicate entries.";
		}
		
		if ( ! isset($clientDataObj->card->id)) {
			$clientDataObj->card = Card::create($clientDataObj->card);
		}
		if ( ! isset($clientDataObj->powerRankingList->id)) {
			$clientDataObj->powerRankingList = PowerRankingList::create($clientDataObj->powerRankingList);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("CardPowerRanking",
				array("cardID", "powerRankingListID", "ranking"),
				array($clientDataObj->card->id,
					$clientDataObj->powerRankingList->id,
					$clientDataObj->ranking)));
		
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
			$whereArray["{$prefix}CardPowerRanking.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("card", $whereData)) {
				if (isset($whereData["card"]->id)) {
					$whereArray["{$prefix}CardPowerRanking.cardID"] = $whereData["card"]->id;
				} else if ($whereData["card"] == null) {
					$whereArray["{$prefix}CardPowerRanking.cardID"] = null;
				}
			}
			if (array_key_exists("powerRankingList", $whereData)) {
				if (isset($whereData["powerRankingList"]->id)) {
					$whereArray["{$prefix}CardPowerRanking.powerRankingListID"] = $whereData["powerRankingList"]->id;
				} else if ($whereData["powerRankingList"] == null) {
					$whereArray["{$prefix}CardPowerRanking.powerRankingListID"] = null;
				}
			}
			if (isset($whereData["ranking"])) {
				$whereArray["{$prefix}CardPowerRanking.ranking"] = $whereData["ranking"];
			}
		}
		
		if (isset($whereData["card"])) {
			$whereArray = array_merge($whereArray, Card::createWhereArray($whereData["card"], "{$prefix}CardPowerRanking_cardID_"));
		}
		if (isset($whereData["powerRankingList"])) {
			$whereArray = array_merge($whereArray, PowerRankingList::createWhereArray($whereData["powerRankingList"], "{$prefix}CardPowerRanking_powerRankingListID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("CardPowerRanking.name" => "ASC")
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
		return array("cardID" => "Card", "powerRankingListID" => "PowerRankingList");
	}

	public static function getColumnNames() {
		return array("id", "cardID", "powerRankingListID", "ranking");
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
			if (isset($clientDataObj->powerRankingList, $clientDataObj->powerRankingList->id) &&
					$clientDataObj->powerRankingList->id > 0) {
					$this->powerRankingListID = $clientDataObj->powerRankingList->id;
			}
			if (property_exists($clientDataObj, "ranking")) {
				$this->ranking = $clientDataObj->ranking;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->card) && ( ! isset($clientDataObj->updateClasses) || (in_array("Card", $clientDataObj->updateClasses))) && in_array("card", $clientDataObj->fieldsToUpdate) && ! isset($this->cardIDJustCreated)) {
				(Card::fromDB($this->cardID))->updateInDB($clientDataObj->card);
			}
			if (isset($clientDataObj->powerRankingList) && ( ! isset($clientDataObj->updateClasses) || (in_array("PowerRankingList", $clientDataObj->updateClasses))) && in_array("powerRankingList", $clientDataObj->fieldsToUpdate) && ! isset($this->powerRankingListIDJustCreated)) {
				(PowerRankingList::fromDB($this->powerRankingListID))->updateInDB($clientDataObj->powerRankingList);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("CardPowerRanking",
				array("cardID", "powerRankingListID", "ranking"),
				array($this->cardID, $this->powerRankingListID, $this->ranking))->
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
			delete("CardPowerRanking")->
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

	public function getPowerRankingList() {
		if ( ! property_exists($this, "powerRankingList")) {
			$this->powerRankingList = PowerRankingList::fromDB($this->powerRankingListID);
		}
		return $this->powerRankingList;
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
