<?php

class Figure extends HS_DatabaseObject {
	protected $id; // Int
	protected $cardID; // Int
	protected $imageData; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["Figure"])) {
			$OBJECT_MAP["Figure"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["Figure"][$id])) {
			$obj = $OBJECT_MAP["Figure"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["Figure"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->card->id)) {
			$clientDataObj->card = HeroscapeCard::create($clientDataObj->card);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("Figure",
				array("cardID", "imageData"),
				array($clientDataObj->card->id,
					$clientDataObj->imageData)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->onlineGamePlayerFigures)) {
			foreach ($clientDataObj->onlineGamePlayerFigures as $clientLinkObj) {
				$clientLinkObj->figure = $this;
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
			$whereArray["{$prefix}Figure.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("card", $whereData)) {
				if (isset($whereData["card"]->id)) {
					$whereArray["{$prefix}Figure.cardID"] = $whereData["card"]->id;
				} else if ($whereData["card"] == null) {
					$whereArray["{$prefix}Figure.cardID"] = null;
				}
			}
			if (isset($whereData["imageData"])) {
				$whereArray["{$prefix}Figure.imageData"] = $whereData["imageData"];
			}
		}
		
		if (isset($whereData["card"])) {
			$whereArray = array_merge($whereArray, HeroscapeCard::createWhereArray($whereData["card"], "{$prefix}Figure_cardID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("Figure.name" => "ASC")
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
		return array("OnlineGamePlayerFigure" => "figureID");
	}

	public static function getForeignKeys() {
		return array("cardID" => "HeroscapeCard");
	}

	public static function getColumnNames() {
		return array("id", "cardID", "imageData");
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
		if (OnlineGamePlayerFigure::countEntries(array("OnlineGamePlayerFigure.figureID" => $this->id)) > 0) {
			return "Unable to delete Figure because one or more Online Game Player Figure is dependent on it.";
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
			if (isset($clientDataObj->card, $clientDataObj->card->id) &&
					$clientDataObj->card->id > 0) {
					$this->cardID = $clientDataObj->card->id;
			}
			if (isset($clientDataObj->imageData)) {
				$this->imageData = $clientDataObj->imageData;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->card) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeCard", $clientDataObj->updateClasses))) && in_array("card", $clientDataObj->fieldsToUpdate) && ! isset($this->cardIDJustCreated)) {
				(HeroscapeCard::fromDB($this->cardID))->updateInDB($clientDataObj->card);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("Figure",
				array("cardID", "imageData"),
				array($this->cardID, $this->imageData))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->onlineGamePlayerFigures) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineGamePlayerFigures as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineGamePlayerFigure::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->figure = $this;
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
			delete("Figure")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getCard() {
		if ( ! property_exists($this, "card")) {
			$this->card = HeroscapeCard::fromDB($this->cardID);
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
