<?php

class FigureSetSubGroup extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $figureSetID; // Int
	protected $tier; // Int
	protected $order; // Int
	protected $selectedByDefault; // Boolean
	protected $powerRankingListID; // Int

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
		if (isset($clientDataObj->powerRankingList) &&
				! isset($clientDataObj->powerRankingList->id)) {
			$clientDataObj->powerRankingList = PowerRankingList::create($clientDataObj->powerRankingList);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("FigureSetSubGroup",
				array("name", "figureSetID", "tier", "order", "selectedByDefault", "powerRankingListID"),
				array($clientDataObj->name,
					$clientDataObj->figureSet->id,
					$clientDataObj->tier,
					self::countEntries(parent::orderWhereArrayFromClientDataObj($clientDataObj)),
					isset($clientDataObj->selectedByDefault) && $clientDataObj-> selectedByDefault ? true : false,
					isset($clientDataObj->powerRankingList) 
						? $clientDataObj->powerRankingList->id
						: null)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->cards)) {
			foreach ($clientDataObj->cards as $clientLinkObj) {
				$clientLinkObj->figureSetSubGroup = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->releaseSets)) {
			foreach ($clientDataObj->releaseSets as $clientLinkObj) {
				$clientLinkObj->figureSubSetGroup = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->tournamentIncludesFigureSetSubGroups)) {
			foreach ($clientDataObj->tournamentIncludesFigureSetSubGroups as $clientLinkObj) {
				$clientLinkObj->figureSetSubGroup = $this;
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
			if (isset($whereData["tier"])) {
				$whereArray["{$prefix}FigureSetSubGroup.tier"] = $whereData["tier"];
			}
			if (isset($whereData["selectedByDefault"])) {
				$whereArray["{$prefix}FigureSetSubGroup.selectedByDefault"] = $whereData["selectedByDefault"];
			}
			if (array_key_exists("powerRankingList", $whereData)) {
				if (isset($whereData["powerRankingList"]->id)) {
					$whereArray["{$prefix}FigureSetSubGroup.powerRankingListID"] = $whereData["powerRankingList"]->id;
				} else if ($whereData["powerRankingList"] == null) {
					$whereArray["{$prefix}FigureSetSubGroup.powerRankingListID"] = null;
				}
			}
		}
		
		if (isset($whereData["figureSet"])) {
			$whereArray = array_merge($whereArray, FigureSet::createWhereArray($whereData["figureSet"], "{$prefix}FigureSetSubGroup_figureSetID_"));
		}
		if (isset($whereData["powerRankingList"])) {
			$whereArray = array_merge($whereArray, PowerRankingList::createWhereArray($whereData["powerRankingList"], "{$prefix}FigureSetSubGroup_powerRankingListID_"));
		}
		
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array(
			"LENGTH(FigureSetSubGroup.tier)" => "ASC", "FigureSetSubGroup.tier" => "ASC", 
			"LENGTH(FigureSetSubGroup.order)" => "ASC", "FigureSetSubGroup.order" => "ASC"
		);
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
		return array("Card" => "figureSetSubGroupID", "ReleaseSet" => "figureSubSetGroupID", "TournamentIncludesFigureSetSubGroup" => "figureSetSubGroupID");
	}

	public static function getForeignKeys() {
		return array("figureSetID" => "FigureSet", "powerRankingListID" => "PowerRankingList");
	}

	public static function getColumnNames() {
		return array("id", "name", "figureSetID", "tier", "order", "selectedByDefault", "powerRankingListID");
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
		if (Card::countEntries(array("Card.figureSetSubGroupID" => $this->id)) > 0) {
			return "Unable to delete Figure Set Sub Group because one or more Card is dependent on it.";
		}
		if (ReleaseSet::countEntries(array("ReleaseSet.figureSubSetGroupID" => $this->id)) > 0) {
			return "Unable to delete Figure Set Sub Group because one or more Release Set is dependent on it.";
		}
		if (TournamentIncludesFigureSetSubGroup::countEntries(array("TournamentIncludesFigureSetSubGroup.figureSetSubGroupID" => $this->id)) > 0) {
			return "Unable to delete Figure Set Sub Group because one or more Tournament Includes Figure Set Sub Group is dependent on it.";
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
			if (isset($clientDataObj->name)) {
				$this->name = $clientDataObj->name;
			}
			if (isset($clientDataObj->figureSet, $clientDataObj->figureSet->id) &&
					$clientDataObj->figureSet->id > 0) {
					$this->figureSetID = $clientDataObj->figureSet->id;
			}
			if (isset($clientDataObj->tier)) {
				$this->tier = $clientDataObj->tier;
			}
			if (isset($clientDataObj->order)) {
				$this->order = $clientDataObj->order;
			}
			if (isset($clientDataObj->selectedByDefault)) {
				$this->selectedByDefault = $clientDataObj->selectedByDefault;
			}
			if (property_exists($clientDataObj, "powerRankingList")) {
				if (isset($clientDataObj->powerRankingList)) {
					if (isset($clientDataObj->powerRankingList->id) && $clientDataObj->powerRankingList->id > 0) {
						$this->powerRankingListID = $clientDataObj->powerRankingList->id;
					} else {
						$this->powerRankingListID = (PowerRankingList::create($clientDataObj->powerRankingList))->id;
						$this->powerRankingListIDJustCreated = true;
					}
				} else {
					$this->powerRankingListID = null;
				}
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->figureSet) && ( ! isset($clientDataObj->updateClasses) || (in_array("FigureSet", $clientDataObj->updateClasses))) && in_array("figureSet", $clientDataObj->fieldsToUpdate) && ! isset($this->figureSetIDJustCreated)) {
				(FigureSet::fromDB($this->figureSetID))->updateInDB($clientDataObj->figureSet);
			}
			if (isset($clientDataObj->powerRankingList) && ( ! isset($clientDataObj->updateClasses) || (in_array("PowerRankingList", $clientDataObj->updateClasses))) && in_array("powerRankingList", $clientDataObj->fieldsToUpdate) && ! isset($this->powerRankingListIDJustCreated)) {
				(PowerRankingList::fromDB($this->powerRankingListID))->updateInDB($clientDataObj->powerRankingList);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("FigureSetSubGroup",
				array("name", "figureSetID", "tier", "order", "selectedByDefault", "powerRankingListID"),
				array($this->name, $this->figureSetID, $this->tier, $this->order, $this->selectedByDefault, $this->powerRankingListID))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->cards) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->cards as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Card::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->figureSetSubGroup = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
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
		if (isset($clientDataObj->tournamentIncludesFigureSetSubGroups) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->tournamentIncludesFigureSetSubGroups as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = TournamentIncludesFigureSetSubGroup::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->figureSetSubGroup = $this;
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
		
		self::cleanOrder($this->orderWhereArray());
		
		return "";
	}

	/* Getters */
	
	public function getFigureSet() {
		if ( ! property_exists($this, "figureSet")) {
			$this->figureSet = FigureSet::fromDB($this->figureSetID);
		}
		return $this->figureSet;
	}

	public function getPowerRankingList() {
		if ($this->powerRankingListID != null) {
			if ( ! property_exists($this, "powerRankingList")) {
				$this->powerRankingList = PowerRankingList::fromDB($this->powerRankingListID);
			}
			return $this->powerRankingList;
		}
		return null;
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
