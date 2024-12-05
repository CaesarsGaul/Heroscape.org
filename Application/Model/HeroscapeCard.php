<?php

class HeroscapeCard extends HS_DatabaseObject {
	protected $id; // Int
	protected $figureSetID; // Int
	protected $name; // String
	protected $general; // String
	protected $homeworld; // String
	protected $species; // String
	protected $commonality; // String
	protected $hero; // Boolean
	protected $figureCount; // Int
	protected $hexCount; // Int
	protected $class; // String
	protected $personality; // String
	protected $size; // String
	protected $height; // Int
	protected $life; // Int
	protected $move; // Int
	protected $range; // Int
	protected $attack; // Int
	protected $defense; // Int
	protected $points; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["HeroscapeCard"])) {
			$OBJECT_MAP["HeroscapeCard"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["HeroscapeCard"][$id])) {
			$obj = $OBJECT_MAP["HeroscapeCard"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["HeroscapeCard"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->figureSet->id)) {
			$clientDataObj->figureSet = FigureSet::create($clientDataObj->figureSet);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeCard",
				array("figureSetID", "name", "general", "homeworld", "species", "commonality", "hero", "figureCount", "hexCount", "class", "personality", "size", "height", "life", "move", "range", "attack", "defense", "points"),
				array($clientDataObj->figureSet->id,
					$clientDataObj->name,
					$clientDataObj->general,
					$clientDataObj->homeworld,
					$clientDataObj->species,
					$clientDataObj->commonality,
					isset($clientDataObj->hero) && $clientDataObj-> hero ? true : false,
					$clientDataObj->figureCount,
					$clientDataObj->hexCount,
					$clientDataObj->class,
					$clientDataObj->personality,
					$clientDataObj->size,
					$clientDataObj->height,
					$clientDataObj->life,
					$clientDataObj->move,
					$clientDataObj->range,
					$clientDataObj->attack,
					$clientDataObj->defense,
					$clientDataObj->points)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->figures)) {
			foreach ($clientDataObj->figures as $clientLinkObj) {
				$clientLinkObj->card = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->onlineGameOrderMarkerss)) {
			foreach ($clientDataObj->onlineGameOrderMarkerss as $clientLinkObj) {
				$clientLinkObj->om1Card = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->heroscapeCardPowers)) {
			foreach ($clientDataObj->heroscapeCardPowers as $clientLinkObj) {
				$clientLinkObj->card = $this;
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
			$whereArray["{$prefix}HeroscapeCard.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("figureSet", $whereData)) {
				if (isset($whereData["figureSet"]->id)) {
					$whereArray["{$prefix}HeroscapeCard.figureSetID"] = $whereData["figureSet"]->id;
				} else if ($whereData["figureSet"] == null) {
					$whereArray["{$prefix}HeroscapeCard.figureSetID"] = null;
				}
			}
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}HeroscapeCard.name"] = $whereData["name"];
			}
			if (isset($whereData["general"])) {
				$whereArray["{$prefix}HeroscapeCard.general"] = $whereData["general"];
			}
			if (isset($whereData["homeworld"])) {
				$whereArray["{$prefix}HeroscapeCard.homeworld"] = $whereData["homeworld"];
			}
			if (isset($whereData["species"])) {
				$whereArray["{$prefix}HeroscapeCard.species"] = $whereData["species"];
			}
			if (isset($whereData["commonality"])) {
				$whereArray["{$prefix}HeroscapeCard.commonality"] = $whereData["commonality"];
			}
			if (isset($whereData["hero"])) {
				$whereArray["{$prefix}HeroscapeCard.hero"] = $whereData["hero"];
			}
			if (isset($whereData["figureCount"])) {
				$whereArray["{$prefix}HeroscapeCard.figureCount"] = $whereData["figureCount"];
			}
			if (isset($whereData["hexCount"])) {
				$whereArray["{$prefix}HeroscapeCard.hexCount"] = $whereData["hexCount"];
			}
			if (isset($whereData["class"])) {
				$whereArray["{$prefix}HeroscapeCard.class"] = $whereData["class"];
			}
			if (isset($whereData["personality"])) {
				$whereArray["{$prefix}HeroscapeCard.personality"] = $whereData["personality"];
			}
			if (isset($whereData["size"])) {
				$whereArray["{$prefix}HeroscapeCard.size"] = $whereData["size"];
			}
			if (isset($whereData["height"])) {
				$whereArray["{$prefix}HeroscapeCard.height"] = $whereData["height"];
			}
			if (isset($whereData["life"])) {
				$whereArray["{$prefix}HeroscapeCard.life"] = $whereData["life"];
			}
			if (isset($whereData["move"])) {
				$whereArray["{$prefix}HeroscapeCard.move"] = $whereData["move"];
			}
			if (isset($whereData["range"])) {
				$whereArray["{$prefix}HeroscapeCard.range"] = $whereData["range"];
			}
			if (isset($whereData["attack"])) {
				$whereArray["{$prefix}HeroscapeCard.attack"] = $whereData["attack"];
			}
			if (isset($whereData["defense"])) {
				$whereArray["{$prefix}HeroscapeCard.defense"] = $whereData["defense"];
			}
			if (isset($whereData["points"])) {
				$whereArray["{$prefix}HeroscapeCard.points"] = $whereData["points"];
			}
		}
		
		if (isset($whereData["figureSet"])) {
			$whereArray = array_merge($whereArray, FigureSet::createWhereArray($whereData["figureSet"], "{$prefix}HeroscapeCard_figureSetID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("HeroscapeCard.name" => "ASC")
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
		return array("Figure" => "cardID", "OnlineGameOrderMarkers" => "om1CardID", "HeroscapeCardPower" => "cardID");
	}

	public static function getForeignKeys() {
		return array("figureSetID" => "FigureSet");
	}

	public static function getColumnNames() {
		return array("id", "figureSetID", "name", "general", "homeworld", "species", "commonality", "hero", "figureCount", "hexCount", "class", "personality", "size", "height", "life", "move", "range", "attack", "defense", "points");
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
		if (Figure::countEntries(array("Figure.cardID" => $this->id)) > 0) {
			return "Unable to delete Heroscape Card because one or more Figure is dependent on it.";
		}
		if (OnlineGameOrderMarkers::countEntries(array("OnlineGameOrderMarkers.om1CardID" => $this->id)) > 0) {
			return "Unable to delete Heroscape Card because one or more Online Game Order Markers is dependent on it.";
		}
		if (HeroscapeCardPower::countEntries(array("HeroscapeCardPower.cardID" => $this->id)) > 0) {
			return "Unable to delete Heroscape Card because one or more Heroscape Card Power is dependent on it.";
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
			if (isset($clientDataObj->figureSet, $clientDataObj->figureSet->id) &&
					$clientDataObj->figureSet->id > 0) {
					$this->figureSetID = $clientDataObj->figureSet->id;
			}
			if (isset($clientDataObj->name)) {
				$this->name = $clientDataObj->name;
			}
			if (isset($clientDataObj->general)) {
				$this->general = $clientDataObj->general;
			}
			if (isset($clientDataObj->homeworld)) {
				$this->homeworld = $clientDataObj->homeworld;
			}
			if (isset($clientDataObj->species)) {
				$this->species = $clientDataObj->species;
			}
			if (isset($clientDataObj->commonality)) {
				$this->commonality = $clientDataObj->commonality;
			}
			if (isset($clientDataObj->hero)) {
				$this->hero = $clientDataObj->hero;
			}
			if (isset($clientDataObj->figureCount)) {
				$this->figureCount = $clientDataObj->figureCount;
			}
			if (isset($clientDataObj->hexCount)) {
				$this->hexCount = $clientDataObj->hexCount;
			}
			if (isset($clientDataObj->class)) {
				$this->class = $clientDataObj->class;
			}
			if (isset($clientDataObj->personality)) {
				$this->personality = $clientDataObj->personality;
			}
			if (isset($clientDataObj->size)) {
				$this->size = $clientDataObj->size;
			}
			if (isset($clientDataObj->height)) {
				$this->height = $clientDataObj->height;
			}
			if (isset($clientDataObj->life)) {
				$this->life = $clientDataObj->life;
			}
			if (isset($clientDataObj->move)) {
				$this->move = $clientDataObj->move;
			}
			if (isset($clientDataObj->range)) {
				$this->range = $clientDataObj->range;
			}
			if (isset($clientDataObj->attack)) {
				$this->attack = $clientDataObj->attack;
			}
			if (isset($clientDataObj->defense)) {
				$this->defense = $clientDataObj->defense;
			}
			if (isset($clientDataObj->points)) {
				$this->points = $clientDataObj->points;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->figureSet) && ( ! isset($clientDataObj->updateClasses) || (in_array("FigureSet", $clientDataObj->updateClasses))) && in_array("figureSet", $clientDataObj->fieldsToUpdate) && ! isset($this->figureSetIDJustCreated)) {
				(FigureSet::fromDB($this->figureSetID))->updateInDB($clientDataObj->figureSet);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("HeroscapeCard",
				array("figureSetID", "name", "general", "homeworld", "species", "commonality", "hero", "figureCount", "hexCount", "class", "personality", "size", "height", "life", "move", "range", "attack", "defense", "points"),
				array($this->figureSetID, $this->name, $this->general, $this->homeworld, $this->species, $this->commonality, $this->hero, $this->figureCount, $this->hexCount, $this->class, $this->personality, $this->size, $this->height, $this->life, $this->move, $this->range, $this->attack, $this->defense, $this->points))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->figures) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->figures as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Figure::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->card = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->onlineGameOrderMarkerss) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineGameOrderMarkerss as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineGameOrderMarkers::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->om1Card = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->heroscapeCardPowers) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->heroscapeCardPowers as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = HeroscapeCardPower::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->card = $this;
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
			delete("HeroscapeCard")->
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
