<?php

class PlayerArmyCard extends HS_DatabaseObject {
	protected $id; // Int
	protected $playerArmyID; // Int
	protected $cardID; // Int
	protected $quantity; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["PlayerArmyCard"])) {
			$OBJECT_MAP["PlayerArmyCard"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["PlayerArmyCard"][$id])) {
			$obj = $OBJECT_MAP["PlayerArmyCard"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["PlayerArmyCard"][$id] = $obj;
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
			return "A Player Army Card already exists with that id - you cannot have duplicate entries.";
		}
		
		if ( ! isset($clientDataObj->playerArmy->id)) {
			$clientDataObj->playerArmy = PlayerArmy::create($clientDataObj->playerArmy);
		}
		if ( ! isset($clientDataObj->card->id)) {
			$clientDataObj->card = Card::create($clientDataObj->card);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("PlayerArmyCard",
				array("playerArmyID", "cardID", "quantity"),
				array($clientDataObj->playerArmy->id,
					$clientDataObj->card->id,
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
			$whereArray["{$prefix}PlayerArmyCard.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("playerArmy", $whereData)) {
				if (isset($whereData["playerArmy"]->id)) {
					$whereArray["{$prefix}PlayerArmyCard.playerArmyID"] = $whereData["playerArmy"]->id;
				} else if ($whereData["playerArmy"] == null) {
					$whereArray["{$prefix}PlayerArmyCard.playerArmyID"] = null;
				}
			}
			if (array_key_exists("card", $whereData)) {
				if (isset($whereData["card"]->id)) {
					$whereArray["{$prefix}PlayerArmyCard.cardID"] = $whereData["card"]->id;
				} else if ($whereData["card"] == null) {
					$whereArray["{$prefix}PlayerArmyCard.cardID"] = null;
				}
			}
			if (isset($whereData["quantity"])) {
				$whereArray["{$prefix}PlayerArmyCard.quantity"] = $whereData["quantity"];
			}
		}
		
		if (isset($whereData["playerArmy"])) {
			$whereArray = array_merge($whereArray, PlayerArmy::createWhereArray($whereData["playerArmy"], "{$prefix}PlayerArmyCard_playerArmyID_"));
		}
		if (isset($whereData["card"])) {
			$whereArray = array_merge($whereArray, Card::createWhereArray($whereData["card"], "{$prefix}PlayerArmyCard_cardID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("PlayerArmyCard.name" => "ASC")
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
		return array("playerArmyID" => "PlayerArmy", "cardID" => "Card");
	}

	public static function getColumnNames() {
		return array("id", "playerArmyID", "cardID", "quantity");
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
		return $this->getPlayerArmy()->isEditableByUser();
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		
		return $this->getPlayerArmy()->columnIsViewableByUser("army");
		
		//return $this->getPlayerArmy()->isViewableByUser();
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
			if (isset($clientDataObj->playerArmy, $clientDataObj->playerArmy->id) &&
					$clientDataObj->playerArmy->id > 0) {
					$this->playerArmyID = $clientDataObj->playerArmy->id;
			}
			if (isset($clientDataObj->card, $clientDataObj->card->id) &&
					$clientDataObj->card->id > 0) {
					$this->cardID = $clientDataObj->card->id;
			}
			if (isset($clientDataObj->quantity)) {
				$this->quantity = $clientDataObj->quantity;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->playerArmy) && ( ! isset($clientDataObj->updateClasses) || (in_array("PlayerArmy", $clientDataObj->updateClasses))) && in_array("playerArmy", $clientDataObj->fieldsToUpdate) && ! isset($this->playerArmyIDJustCreated)) {
				(PlayerArmy::fromDB($this->playerArmyID))->updateInDB($clientDataObj->playerArmy);
			}
			if (isset($clientDataObj->card) && ( ! isset($clientDataObj->updateClasses) || (in_array("Card", $clientDataObj->updateClasses))) && in_array("card", $clientDataObj->fieldsToUpdate) && ! isset($this->cardIDJustCreated)) {
				(Card::fromDB($this->cardID))->updateInDB($clientDataObj->card);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("PlayerArmyCard",
				array("playerArmyID", "cardID", "quantity"),
				array($this->playerArmyID, $this->cardID, $this->quantity))->
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
			delete("PlayerArmyCard")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getPlayerArmy() {
		if ( ! property_exists($this, "playerArmy")) {
			$this->playerArmy = PlayerArmy::fromDB($this->playerArmyID);
		}
		return $this->playerArmy;
	}

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
