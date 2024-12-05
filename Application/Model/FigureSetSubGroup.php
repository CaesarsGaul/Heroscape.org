<?php

class FigureSetSubGroup extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $figureSetID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["FigureSetSubGroup"])) {
			$OBJECT_MAP["FigureSetSubGroup"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["FigureSetSubGroup"][$id])) {
			$obj = $OBJECT_MAP["FigureSetSubGroup"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["FigureSetSubGroup"][$id] = $obj;
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
			return "A Figure Set Sub Group already exists with that id - you cannot have duplicate entries.";
		}
		
		if ( ! isset($clientDataObj->figureSet->id)) {
			$clientDataObj->figureSet = FigureSet::create($clientDataObj->figureSet);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("FigureSetSubGroup",
				array("name", "figureSetID"),
				array($clientDataObj->name,
					$clientDataObj->figureSet->id)));
		
		$dbObj = self::fromDB($id);
		
		if (isset($clientDataObj->cards)) {
			foreach ($clientDataObj->cards as $tempClientDataObj) {
				CardFigureSetSubGroupLink::create(array(
					"figureSetSubGroup" => $dbObj,
					"card" => Card::fromDB($tempClientDataObj->id)));
			}
		}
		if (isset($clientDataObj->powerRankingLists)) {
			foreach ($clientDataObj->powerRankingLists as $tempClientDataObj) {
				PowerRankingListFigureSetSubGroupLink::create(array(
					"figureSetSubGroup" => $dbObj,
					"powerRankingList" => PowerRankingList::fromDB($tempClientDataObj->id)));
			}
		}
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->releaseSets)) {
			foreach ($clientDataObj->releaseSets as $clientLinkObj) {
				$clientLinkObj->figureSubSetGroup = $this;
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
			$whereArray["{$prefix}FigureSetSubGroup.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}FigureSetSubGroup.name"] = $whereData["name"];
			}
			if (array_key_exists("figureSet", $whereData)) {
				if (isset($whereData["figureSet"]->id)) {
					$whereArray["{$prefix}FigureSetSubGroup.figureSetID"] = $whereData["figureSet"]->id;
				} else if ($whereData["figureSet"] == null) {
					$whereArray["{$prefix}FigureSetSubGroup.figureSetID"] = null;
				}
			}
		}
		
		if (isset($whereData["figureSet"])) {
			$whereArray = array_merge($whereArray, FigureSet::createWhereArray($whereData["figureSet"], "{$prefix}FigureSetSubGroup_figureSetID_"));
		}
		
		if (isset($whereData["id"])) {
			$whereArray = array_merge($whereArray, Card::createWhereArray($whereData["id"], "{$prefix}FigureSetSubGroup_id_CardFigureSetSubGroupLink_cardID_"));
		}
		if (isset($whereData["id"])) {
			$whereArray = array_merge($whereArray, PowerRankingList::createWhereArray($whereData["id"], "{$prefix}FigureSetSubGroup_id_PowerRankingListFigureSetSubGroupLink_powerRankingListID_"));
		}
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("FigureSetSubGroup.name" => "ASC")
		return array();
	}

	public static function getPrimaryKey() {
		return "id";
	}

	public static function getNToMLinkClasses() {
		return array("CardFigureSetSubGroupLink" => "figureSetSubGroupID", "PowerRankingListFigureSetSubGroupLink" => "figureSetSubGroupID");
	}

	public static function getNToMLinkClassesWithType() {
		return array("CardFigureSetSubGroupLink" => "Card", "PowerRankingListFigureSetSubGroupLink" => "PowerRankingList");
	}

	public static function getNToMLinkClassesWithJSVariableName() {
		return array("CardFigureSetSubGroupLink" => "cards", "PowerRankingListFigureSetSubGroupLink" => "powerRankingLists");
	}

	public static function getNTo1LinkClasses() {
		return array("ReleaseSet" => "figureSubSetGroupID");
	}

	public static function getForeignKeys() {
		return array("figureSetID" => "FigureSet");
	}

	public static function getColumnNames() {
		return array("id", "name", "figureSetID");
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
		if (ReleaseSet::countEntries(array("ReleaseSet.figureSubSetGroupID" => $this->id)) > 0) {
			return "Unable to delete Figure Set Sub Group because one or more Release Set is dependent on it.";
		}
		
		// N-M Links
		CardFigureSetSubGroupLink::deleteEntries(CardFigureSetSubGroupLink::fetch(array("figureSetSubGroup" => $this)));
		PowerRankingListFigureSetSubGroupLink::deleteEntries(PowerRankingListFigureSetSubGroupLink::fetch(array("figureSetSubGroup" => $this)));
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
			if (isset($clientDataObj->name)) {
				$this->name = $clientDataObj->name;
			}
			if (isset($clientDataObj->figureSet, $clientDataObj->figureSet->id) &&
					$clientDataObj->figureSet->id > 0) {
					$this->figureSetID = $clientDataObj->figureSet->id;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->figureSet) && ( ! isset($clientDataObj->updateClasses) || (in_array("FigureSet", $clientDataObj->updateClasses))) && in_array("figureSet", $clientDataObj->fieldsToUpdate) && ! isset($this->figureSetIDJustCreated)) {
				(FigureSet::fromDB($this->figureSetID))->updateInDB($clientDataObj->figureSet);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("FigureSetSubGroup",
				array("name", "figureSetID"),
				array($this->name, $this->figureSetID))->
			where(array("id" => $this->id)));
		
		if ((isset($clientDataObj->updateNtoMLinks) || (isset($clientDataObj->joins, $clientDataObj->joins->{'CardFigureSetSubGroupLink.figureSetSubGroupID'}))) && in_array("cards", $clientDataObj->linksToUpdate)) {
			$links = CardFigureSetSubGroupLink::fetch(array("figureSetSubGroup" => $this));
			$oldObjs = array();
			foreach ($links as $link) {
				$oldObjs[] = $link->getCard();
			}
			$newObjs = array();
			foreach ($clientDataObj->cards as $clientLinkObj) {
				if (is_object($clientLinkObj) && isset($clientLinkObj->id) && $clientLinkObj->id > 0) {
					$newObjs[] = Card::fromDB($clientLinkObj->id);
				}
			}
			subtractOverlap($newObjs, $oldObjs, array("id"));
			foreach ($newObjs as $newObj) {
				CardFigureSetSubGroupLink::create(array("card" => $newObj, "figureSetSubGroup" => $this));
			}
			foreach ($oldObjs as $oldObj) {
				(CardFigureSetSubGroupLink::fromDB(array("card" => $oldObj, "figureSetSubGroup" => $this)))->deleteInDB();
			}
		}
		
		if ((isset($clientDataObj->updateNtoMLinks) || (isset($clientDataObj->joins, $clientDataObj->joins->{'PowerRankingListFigureSetSubGroupLink.figureSetSubGroupID'}))) && in_array("powerRankingLists", $clientDataObj->linksToUpdate)) {
			$links = PowerRankingListFigureSetSubGroupLink::fetch(array("figureSetSubGroup" => $this));
			$oldObjs = array();
			foreach ($links as $link) {
				$oldObjs[] = $link->getPowerRankingList();
			}
			$newObjs = array();
			foreach ($clientDataObj->powerRankingLists as $clientLinkObj) {
				if (is_object($clientLinkObj) && isset($clientLinkObj->id) && $clientLinkObj->id > 0) {
					$newObjs[] = PowerRankingList::fromDB($clientLinkObj->id);
				}
			}
			subtractOverlap($newObjs, $oldObjs, array("id"));
			foreach ($newObjs as $newObj) {
				PowerRankingListFigureSetSubGroupLink::create(array("powerRankingList" => $newObj, "figureSetSubGroup" => $this));
			}
			foreach ($oldObjs as $oldObj) {
				(PowerRankingListFigureSetSubGroupLink::fromDB(array("powerRankingList" => $oldObj, "figureSetSubGroup" => $this)))->deleteInDB();
			}
		}
		
		// Update 1-N Links
		if (isset($clientDataObj->releaseSets) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->releaseSets as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = ReleaseSet::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->figureSubSetGroup = $this;
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
			delete("FigureSetSubGroup")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getFigureSet() {
		if ( ! property_exists($this, "figureSet")) {
			$this->figureSet = FigureSet::fromDB($this->figureSetID);
		}
		return $this->figureSet;
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
