<?php

class FigureSet extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $sDomain; // String
	protected $includeBase; // Boolean
	protected $includeDelta; // Boolean
	protected $includeVC; // Boolean
	protected $googleDocId; // String
	protected $public; // Boolean

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["FigureSet"])) {
			$OBJECT_MAP["FigureSet"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["FigureSet"][$id])) {
			$obj = $OBJECT_MAP["FigureSet"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["FigureSet"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_name($name, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("name" => $name));
	}

	public static function fromDB_sDomain($sDomain, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("sDomain" => $sDomain));
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		if (isset($clientDataObj->name) && self::exists(array("name" => $clientDataObj->name))) {
			return "A Figure Set already exists with that name - you cannot have duplicate entries.";
		}
		if (isset($clientDataObj->sDomain) && self::exists(array("sDomain" => $clientDataObj->sDomain))) {
			return "A Figure Set already exists with that sDomain - you cannot have duplicate entries.";
		}
		
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("FigureSet",
				array("name", "sDomain", "includeBase", "includeDelta", "includeVC", "googleDocId", "public"),
				array($clientDataObj->name,
					$clientDataObj->sDomain,
					isset($clientDataObj->includeBase) && $clientDataObj-> includeBase ? true : false,
					isset($clientDataObj->includeDelta) && $clientDataObj-> includeDelta ? true : false,
					isset($clientDataObj->includeVC) && $clientDataObj-> includeVC ? true : false,
					$clientDataObj->googleDocId,
					isset($clientDataObj->public) && $clientDataObj-> public ? true : false)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->tournaments)) {
			foreach ($clientDataObj->tournaments as $clientLinkObj) {
				$clientLinkObj->figureSet = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->cards)) {
			foreach ($clientDataObj->cards as $clientLinkObj) {
				$clientLinkObj->figureSet = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->figureSetSubGroups)) {
			foreach ($clientDataObj->figureSetSubGroups as $clientLinkObj) {
				$clientLinkObj->figureSet = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->generals)) {
			foreach ($clientDataObj->generals as $clientLinkObj) {
				$clientLinkObj->figureSet = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->homeworlds)) {
			foreach ($clientDataObj->homeworlds as $clientLinkObj) {
				$clientLinkObj->figureSet = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->speciess)) {
			foreach ($clientDataObj->speciess as $clientLinkObj) {
				$clientLinkObj->figureSet = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->cardClasss)) {
			foreach ($clientDataObj->cardClasss as $clientLinkObj) {
				$clientLinkObj->figureSet = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->personalitys)) {
			foreach ($clientDataObj->personalitys as $clientLinkObj) {
				$clientLinkObj->figureSet = $this;
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
			$whereArray["{$prefix}FigureSet.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}FigureSet.name"] = $whereData["name"];
			}
			if (isset($whereData["sDomain"])) {
				$whereArray["{$prefix}FigureSet.sDomain"] = $whereData["sDomain"];
			}
			if (isset($whereData["includeBase"])) {
				$whereArray["{$prefix}FigureSet.includeBase"] = $whereData["includeBase"];
			}
			if (isset($whereData["includeDelta"])) {
				$whereArray["{$prefix}FigureSet.includeDelta"] = $whereData["includeDelta"];
			}
			if (isset($whereData["includeVC"])) {
				$whereArray["{$prefix}FigureSet.includeVC"] = $whereData["includeVC"];
			}
			if (isset($whereData["googleDocId"])) {
				$whereArray["{$prefix}FigureSet.googleDocId"] = $whereData["googleDocId"];
			}
			if (isset($whereData["public"])) {
				$whereArray["{$prefix}FigureSet.public"] = $whereData["public"];
			}
		}
		
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("FigureSet.name" => "ASC")
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
		return array("Tournament" => "figureSetID", "Card" => "figureSetID", "FigureSetSubGroup" => "figureSetID", "General" => "figureSetID", "Homeworld" => "figureSetID", "Species" => "figureSetID", "CardClass" => "figureSetID", "Personality" => "figureSetID");
	}

	public static function getForeignKeys() {
		return array();
	}

	public static function getColumnNames() {
		return array("id", "name", "sDomain", "includeBase", "includeDelta", "includeVC", "googleDocId", "public");
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
		if (Tournament::countEntries(array("Tournament.figureSetID" => $this->id)) > 0) {
			return "Unable to delete Figure Set because one or more Tournament is dependent on it.";
		}
		if (Card::countEntries(array("Card.figureSetID" => $this->id)) > 0) {
			return "Unable to delete Figure Set because one or more Card is dependent on it.";
		}
		if (FigureSetSubGroup::countEntries(array("FigureSetSubGroup.figureSetID" => $this->id)) > 0) {
			return "Unable to delete Figure Set because one or more Figure Set Sub Group is dependent on it.";
		}
		if (General::countEntries(array("General.figureSetID" => $this->id)) > 0) {
			return "Unable to delete Figure Set because one or more General is dependent on it.";
		}
		if (Homeworld::countEntries(array("Homeworld.figureSetID" => $this->id)) > 0) {
			return "Unable to delete Figure Set because one or more Homeworld is dependent on it.";
		}
		if (Species::countEntries(array("Species.figureSetID" => $this->id)) > 0) {
			return "Unable to delete Figure Set because one or more Species is dependent on it.";
		}
		if (CardClass::countEntries(array("CardClass.figureSetID" => $this->id)) > 0) {
			return "Unable to delete Figure Set because one or more Card Class is dependent on it.";
		}
		if (Personality::countEntries(array("Personality.figureSetID" => $this->id)) > 0) {
			return "Unable to delete Figure Set because one or more Personality is dependent on it.";
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
				if (isset($clientDataObj->name) && $this->name != $clientDataObj->name && self::exists(array("name" => $clientDataObj->name))) {
					return "A Figure Set already exists with that name - you cannot have duplicate entries.";
				}
				$this->name = $clientDataObj->name;
			}
			if (isset($clientDataObj->sDomain)) {
				if (isset($clientDataObj->sDomain) && $this->sDomain != $clientDataObj->sDomain && self::exists(array("sDomain" => $clientDataObj->sDomain))) {
					return "A Figure Set already exists with that sDomain - you cannot have duplicate entries.";
				}
				$this->sDomain = $clientDataObj->sDomain;
			}
			if (isset($clientDataObj->includeBase)) {
				$this->includeBase = $clientDataObj->includeBase;
			}
			if (isset($clientDataObj->includeDelta)) {
				$this->includeDelta = $clientDataObj->includeDelta;
			}
			if (isset($clientDataObj->includeVC)) {
				$this->includeVC = $clientDataObj->includeVC;
			}
			if (isset($clientDataObj->googleDocId)) {
				$this->googleDocId = $clientDataObj->googleDocId;
			}
			if (isset($clientDataObj->public)) {
				$this->public = $clientDataObj->public;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("FigureSet",
				array("name", "sDomain", "includeBase", "includeDelta", "includeVC", "googleDocId", "public"),
				array($this->name, $this->sDomain, $this->includeBase, $this->includeDelta, $this->includeVC, $this->googleDocId, $this->public))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->tournaments) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->tournaments as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Tournament::childFromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->figureSet = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->cards) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->cards as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Card::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->figureSet = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->figureSetSubGroups) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->figureSetSubGroups as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = FigureSetSubGroup::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->figureSet = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->generals) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->generals as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = General::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->figureSet = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->homeworlds) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->homeworlds as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Homeworld::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->figureSet = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->speciess) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->speciess as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Species::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->figureSet = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->cardClasss) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->cardClasss as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = CardClass::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->figureSet = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->personalitys) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->personalitys as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Personality::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->figureSet = $this;
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
			delete("FigureSet")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
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
