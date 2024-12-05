<?php

class Card extends HS_DatabaseObject {
	protected $id; // Int
	protected $figureSetID; // Int
	protected $name; // String
	protected $generalID; // Int
	protected $homeworldID; // Int
	protected $speciesID; // Int
	protected $commonality; // String
	protected $hero; // Boolean
	protected $figureCount; // Int
	protected $hexCount; // Int
	protected $classID; // Int
	protected $personalityID; // Int
	protected $sizeID; // Int
	protected $height; // Int
	protected $life; // Int
	protected $move; // Int
	protected $range; // Int
	protected $attack; // Int
	protected $defense; // Int
	protected $points; // Int
	protected $pointsDeltaClassic; // Int
	protected $pointsDeltaVc; // Int
	protected $releaseSetID; // Int
	protected $imageLink; // String
	protected $heroscapersBookLink; // String
	protected $wikiLink; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["Card"])) {
			$OBJECT_MAP["Card"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["Card"][$id])) {
			$obj = $OBJECT_MAP["Card"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["Card"][$id] = $obj;
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
		if ( ! isset($clientDataObj->general->id)) {
			$clientDataObj->general = General::create($clientDataObj->general);
		}
		if ( ! isset($clientDataObj->homeworld->id)) {
			$clientDataObj->homeworld = Homeworld::create($clientDataObj->homeworld);
		}
		if ( ! isset($clientDataObj->species->id)) {
			$clientDataObj->species = Species::create($clientDataObj->species);
		}
		if ( ! isset($clientDataObj->class->id)) {
			$clientDataObj->class = CardClass::create($clientDataObj->class);
		}
		if ( ! isset($clientDataObj->personality->id)) {
			$clientDataObj->personality = Personality::create($clientDataObj->personality);
		}
		if ( ! isset($clientDataObj->size->id)) {
			$clientDataObj->size = Size::create($clientDataObj->size);
		}
		if ( ! isset($clientDataObj->releaseSet->id)) {
			$clientDataObj->releaseSet = ReleaseSet::create($clientDataObj->releaseSet);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("Card",
				array("figureSetID", "name", "generalID", "homeworldID", "speciesID", "commonality", "hero", "figureCount", "hexCount", "classID", "personalityID", "sizeID", "height", "life", "move", "range", "attack", "defense", "points", "pointsDeltaClassic", "pointsDeltaVc", "releaseSetID", "imageLink", "heroscapersBookLink", "wikiLink"),
				array($clientDataObj->figureSet->id,
					$clientDataObj->name,
					$clientDataObj->general->id,
					$clientDataObj->homeworld->id,
					$clientDataObj->species->id,
					$clientDataObj->commonality,
					isset($clientDataObj->hero) && $clientDataObj-> hero ? true : false,
					$clientDataObj->figureCount,
					$clientDataObj->hexCount,
					$clientDataObj->class->id,
					$clientDataObj->personality->id,
					$clientDataObj->size->id,
					$clientDataObj->height,
					$clientDataObj->life,
					$clientDataObj->move,
					$clientDataObj->range,
					$clientDataObj->attack,
					$clientDataObj->defense,
					$clientDataObj->points,
					$clientDataObj->pointsDeltaClassic,
					$clientDataObj->pointsDeltaVc,
					$clientDataObj->releaseSet->id,
					$clientDataObj->imageLink,
					$clientDataObj->heroscapersBookLink,
					$clientDataObj->wikiLink)));
		
		$dbObj = self::fromDB($id);
		
		if (isset($clientDataObj->figureSetSubGroups)) {
			foreach ($clientDataObj->figureSetSubGroups as $tempClientDataObj) {
				CardFigureSetSubGroupLink::create(array(
					"card" => $dbObj,
					"figureSetSubGroup" => FigureSetSubGroup::fromDB($tempClientDataObj->id)));
			}
		}
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->deltaUpdateCosts)) {
			foreach ($clientDataObj->deltaUpdateCosts as $clientLinkObj) {
				$clientLinkObj->card = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->cardPowerRankings)) {
			foreach ($clientDataObj->cardPowerRankings as $clientLinkObj) {
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
			$whereArray["{$prefix}Card.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("figureSet", $whereData)) {
				if (isset($whereData["figureSet"]->id)) {
					$whereArray["{$prefix}Card.figureSetID"] = $whereData["figureSet"]->id;
				} else if ($whereData["figureSet"] == null) {
					$whereArray["{$prefix}Card.figureSetID"] = null;
				}
			}
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}Card.name"] = $whereData["name"];
			}
			if (array_key_exists("general", $whereData)) {
				if (isset($whereData["general"]->id)) {
					$whereArray["{$prefix}Card.generalID"] = $whereData["general"]->id;
				} else if ($whereData["general"] == null) {
					$whereArray["{$prefix}Card.generalID"] = null;
				}
			}
			if (array_key_exists("homeworld", $whereData)) {
				if (isset($whereData["homeworld"]->id)) {
					$whereArray["{$prefix}Card.homeworldID"] = $whereData["homeworld"]->id;
				} else if ($whereData["homeworld"] == null) {
					$whereArray["{$prefix}Card.homeworldID"] = null;
				}
			}
			if (array_key_exists("species", $whereData)) {
				if (isset($whereData["species"]->id)) {
					$whereArray["{$prefix}Card.speciesID"] = $whereData["species"]->id;
				} else if ($whereData["species"] == null) {
					$whereArray["{$prefix}Card.speciesID"] = null;
				}
			}
			if (isset($whereData["commonality"])) {
				$whereArray["{$prefix}Card.commonality"] = $whereData["commonality"];
			}
			if (isset($whereData["hero"])) {
				$whereArray["{$prefix}Card.hero"] = $whereData["hero"];
			}
			if (isset($whereData["figureCount"])) {
				$whereArray["{$prefix}Card.figureCount"] = $whereData["figureCount"];
			}
			if (isset($whereData["hexCount"])) {
				$whereArray["{$prefix}Card.hexCount"] = $whereData["hexCount"];
			}
			if (array_key_exists("class", $whereData)) {
				if (isset($whereData["class"]->id)) {
					$whereArray["{$prefix}Card.classID"] = $whereData["class"]->id;
				} else if ($whereData["class"] == null) {
					$whereArray["{$prefix}Card.classID"] = null;
				}
			}
			if (array_key_exists("personality", $whereData)) {
				if (isset($whereData["personality"]->id)) {
					$whereArray["{$prefix}Card.personalityID"] = $whereData["personality"]->id;
				} else if ($whereData["personality"] == null) {
					$whereArray["{$prefix}Card.personalityID"] = null;
				}
			}
			if (array_key_exists("size", $whereData)) {
				if (isset($whereData["size"]->id)) {
					$whereArray["{$prefix}Card.sizeID"] = $whereData["size"]->id;
				} else if ($whereData["size"] == null) {
					$whereArray["{$prefix}Card.sizeID"] = null;
				}
			}
			if (isset($whereData["height"])) {
				$whereArray["{$prefix}Card.height"] = $whereData["height"];
			}
			if (isset($whereData["life"])) {
				$whereArray["{$prefix}Card.life"] = $whereData["life"];
			}
			if (isset($whereData["move"])) {
				$whereArray["{$prefix}Card.move"] = $whereData["move"];
			}
			if (isset($whereData["range"])) {
				$whereArray["{$prefix}Card.range"] = $whereData["range"];
			}
			if (isset($whereData["attack"])) {
				$whereArray["{$prefix}Card.attack"] = $whereData["attack"];
			}
			if (isset($whereData["defense"])) {
				$whereArray["{$prefix}Card.defense"] = $whereData["defense"];
			}
			if (isset($whereData["points"])) {
				$whereArray["{$prefix}Card.points"] = $whereData["points"];
			}
			if (isset($whereData["pointsDeltaClassic"])) {
				$whereArray["{$prefix}Card.pointsDeltaClassic"] = $whereData["pointsDeltaClassic"];
			}
			if (isset($whereData["pointsDeltaVc"])) {
				$whereArray["{$prefix}Card.pointsDeltaVc"] = $whereData["pointsDeltaVc"];
			}
			if (array_key_exists("releaseSet", $whereData)) {
				if (isset($whereData["releaseSet"]->id)) {
					$whereArray["{$prefix}Card.releaseSetID"] = $whereData["releaseSet"]->id;
				} else if ($whereData["releaseSet"] == null) {
					$whereArray["{$prefix}Card.releaseSetID"] = null;
				}
			}
			if (isset($whereData["imageLink"])) {
				$whereArray["{$prefix}Card.imageLink"] = $whereData["imageLink"];
			}
			if (isset($whereData["heroscapersBookLink"])) {
				$whereArray["{$prefix}Card.heroscapersBookLink"] = $whereData["heroscapersBookLink"];
			}
			if (isset($whereData["wikiLink"])) {
				$whereArray["{$prefix}Card.wikiLink"] = $whereData["wikiLink"];
			}
		}
		
		if (isset($whereData["figureSet"])) {
			$whereArray = array_merge($whereArray, FigureSet::createWhereArray($whereData["figureSet"], "{$prefix}Card_figureSetID_"));
		}
		if (isset($whereData["general"])) {
			$whereArray = array_merge($whereArray, General::createWhereArray($whereData["general"], "{$prefix}Card_generalID_"));
		}
		if (isset($whereData["homeworld"])) {
			$whereArray = array_merge($whereArray, Homeworld::createWhereArray($whereData["homeworld"], "{$prefix}Card_homeworldID_"));
		}
		if (isset($whereData["species"])) {
			$whereArray = array_merge($whereArray, Species::createWhereArray($whereData["species"], "{$prefix}Card_speciesID_"));
		}
		if (isset($whereData["class"])) {
			$whereArray = array_merge($whereArray, CardClass::createWhereArray($whereData["class"], "{$prefix}Card_classID_"));
		}
		if (isset($whereData["personality"])) {
			$whereArray = array_merge($whereArray, Personality::createWhereArray($whereData["personality"], "{$prefix}Card_personalityID_"));
		}
		if (isset($whereData["size"])) {
			$whereArray = array_merge($whereArray, Size::createWhereArray($whereData["size"], "{$prefix}Card_sizeID_"));
		}
		if (isset($whereData["releaseSet"])) {
			$whereArray = array_merge($whereArray, ReleaseSet::createWhereArray($whereData["releaseSet"], "{$prefix}Card_releaseSetID_"));
		}
		
		if (isset($whereData["id"])) {
			$whereArray = array_merge($whereArray, FigureSetSubGroup::createWhereArray($whereData["id"], "{$prefix}Card_id_CardFigureSetSubGroupLink_figureSetSubGroupID_"));
		}
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("Card.name" => "ASC")
		return array();
	}

	public static function getPrimaryKey() {
		return "id";
	}

	public static function getNToMLinkClasses() {
		return array("CardFigureSetSubGroupLink" => "cardID");
	}

	public static function getNToMLinkClassesWithType() {
		return array("CardFigureSetSubGroupLink" => "FigureSetSubGroup");
	}

	public static function getNToMLinkClassesWithJSVariableName() {
		return array("CardFigureSetSubGroupLink" => "figureSetSubGroups");
	}

	public static function getNTo1LinkClasses() {
		return array("DeltaUpdateCost" => "cardID", "CardPowerRanking" => "cardID");
	}

	public static function getForeignKeys() {
		return array("figureSetID" => "FigureSet", "generalID" => "General", "homeworldID" => "Homeworld", "speciesID" => "Species", "classID" => "CardClass", "personalityID" => "Personality", "sizeID" => "Size", "releaseSetID" => "ReleaseSet");
	}

	public static function getColumnNames() {
		return array("id", "figureSetID", "name", "generalID", "homeworldID", "speciesID", "commonality", "hero", "figureCount", "hexCount", "classID", "personalityID", "sizeID", "height", "life", "move", "range", "attack", "defense", "points", "pointsDeltaClassic", "pointsDeltaVc", "releaseSetID", "imageLink", "heroscapersBookLink", "wikiLink");
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
		if (DeltaUpdateCost::countEntries(array("DeltaUpdateCost.cardID" => $this->id)) > 0) {
			return "Unable to delete Card because one or more Delta Update Cost is dependent on it.";
		}
		if (CardPowerRanking::countEntries(array("CardPowerRanking.cardID" => $this->id)) > 0) {
			return "Unable to delete Card because one or more Card Power Ranking is dependent on it.";
		}
		
		// N-M Links
		CardFigureSetSubGroupLink::deleteEntries(CardFigureSetSubGroupLink::fetch(array("card" => $this)));
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
			if (isset($clientDataObj->general, $clientDataObj->general->id) &&
					$clientDataObj->general->id > 0) {
					$this->generalID = $clientDataObj->general->id;
			}
			if (isset($clientDataObj->homeworld, $clientDataObj->homeworld->id) &&
					$clientDataObj->homeworld->id > 0) {
					$this->homeworldID = $clientDataObj->homeworld->id;
			}
			if (isset($clientDataObj->species, $clientDataObj->species->id) &&
					$clientDataObj->species->id > 0) {
					$this->speciesID = $clientDataObj->species->id;
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
			if (isset($clientDataObj->class, $clientDataObj->class->id) &&
					$clientDataObj->class->id > 0) {
					$this->classID = $clientDataObj->class->id;
			}
			if (isset($clientDataObj->personality, $clientDataObj->personality->id) &&
					$clientDataObj->personality->id > 0) {
					$this->personalityID = $clientDataObj->personality->id;
			}
			if (isset($clientDataObj->size, $clientDataObj->size->id) &&
					$clientDataObj->size->id > 0) {
					$this->sizeID = $clientDataObj->size->id;
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
			if (isset($clientDataObj->pointsDeltaClassic)) {
				$this->pointsDeltaClassic = $clientDataObj->pointsDeltaClassic;
			}
			if (isset($clientDataObj->pointsDeltaVc)) {
				$this->pointsDeltaVc = $clientDataObj->pointsDeltaVc;
			}
			if (isset($clientDataObj->releaseSet, $clientDataObj->releaseSet->id) &&
					$clientDataObj->releaseSet->id > 0) {
					$this->releaseSetID = $clientDataObj->releaseSet->id;
			}
			if (property_exists($clientDataObj, "imageLink")) {
				$this->imageLink = $clientDataObj->imageLink;
			}
			if (property_exists($clientDataObj, "heroscapersBookLink")) {
				$this->heroscapersBookLink = $clientDataObj->heroscapersBookLink;
			}
			if (property_exists($clientDataObj, "wikiLink")) {
				$this->wikiLink = $clientDataObj->wikiLink;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->figureSet) && ( ! isset($clientDataObj->updateClasses) || (in_array("FigureSet", $clientDataObj->updateClasses))) && in_array("figureSet", $clientDataObj->fieldsToUpdate) && ! isset($this->figureSetIDJustCreated)) {
				(FigureSet::fromDB($this->figureSetID))->updateInDB($clientDataObj->figureSet);
			}
			if (isset($clientDataObj->general) && ( ! isset($clientDataObj->updateClasses) || (in_array("General", $clientDataObj->updateClasses))) && in_array("general", $clientDataObj->fieldsToUpdate) && ! isset($this->generalIDJustCreated)) {
				(General::fromDB($this->generalID))->updateInDB($clientDataObj->general);
			}
			if (isset($clientDataObj->homeworld) && ( ! isset($clientDataObj->updateClasses) || (in_array("Homeworld", $clientDataObj->updateClasses))) && in_array("homeworld", $clientDataObj->fieldsToUpdate) && ! isset($this->homeworldIDJustCreated)) {
				(Homeworld::fromDB($this->homeworldID))->updateInDB($clientDataObj->homeworld);
			}
			if (isset($clientDataObj->species) && ( ! isset($clientDataObj->updateClasses) || (in_array("Species", $clientDataObj->updateClasses))) && in_array("species", $clientDataObj->fieldsToUpdate) && ! isset($this->speciesIDJustCreated)) {
				(Species::fromDB($this->speciesID))->updateInDB($clientDataObj->species);
			}
			if (isset($clientDataObj->class) && ( ! isset($clientDataObj->updateClasses) || (in_array("CardClass", $clientDataObj->updateClasses))) && in_array("class", $clientDataObj->fieldsToUpdate) && ! isset($this->classIDJustCreated)) {
				(CardClass::fromDB($this->classID))->updateInDB($clientDataObj->class);
			}
			if (isset($clientDataObj->personality) && ( ! isset($clientDataObj->updateClasses) || (in_array("Personality", $clientDataObj->updateClasses))) && in_array("personality", $clientDataObj->fieldsToUpdate) && ! isset($this->personalityIDJustCreated)) {
				(Personality::fromDB($this->personalityID))->updateInDB($clientDataObj->personality);
			}
			if (isset($clientDataObj->size) && ( ! isset($clientDataObj->updateClasses) || (in_array("Size", $clientDataObj->updateClasses))) && in_array("size", $clientDataObj->fieldsToUpdate) && ! isset($this->sizeIDJustCreated)) {
				(Size::fromDB($this->sizeID))->updateInDB($clientDataObj->size);
			}
			if (isset($clientDataObj->releaseSet) && ( ! isset($clientDataObj->updateClasses) || (in_array("ReleaseSet", $clientDataObj->updateClasses))) && in_array("releaseSet", $clientDataObj->fieldsToUpdate) && ! isset($this->releaseSetIDJustCreated)) {
				(ReleaseSet::fromDB($this->releaseSetID))->updateInDB($clientDataObj->releaseSet);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("Card",
				array("figureSetID", "name", "generalID", "homeworldID", "speciesID", "commonality", "hero", "figureCount", "hexCount", "classID", "personalityID", "sizeID", "height", "life", "move", "range", "attack", "defense", "points", "pointsDeltaClassic", "pointsDeltaVc", "releaseSetID", "imageLink", "heroscapersBookLink", "wikiLink"),
				array($this->figureSetID, $this->name, $this->generalID, $this->homeworldID, $this->speciesID, $this->commonality, $this->hero, $this->figureCount, $this->hexCount, $this->classID, $this->personalityID, $this->sizeID, $this->height, $this->life, $this->move, $this->range, $this->attack, $this->defense, $this->points, $this->pointsDeltaClassic, $this->pointsDeltaVc, $this->releaseSetID, $this->imageLink, $this->heroscapersBookLink, $this->wikiLink))->
			where(array("id" => $this->id)));
		
		if ((isset($clientDataObj->updateNtoMLinks) || (isset($clientDataObj->joins, $clientDataObj->joins->{'CardFigureSetSubGroupLink.cardID'}))) && in_array("figureSetSubGroups", $clientDataObj->linksToUpdate)) {
			$links = CardFigureSetSubGroupLink::fetch(array("card" => $this));
			$oldObjs = array();
			foreach ($links as $link) {
				$oldObjs[] = $link->getFigureSetSubGroup();
			}
			$newObjs = array();
			foreach ($clientDataObj->figureSetSubGroups as $clientLinkObj) {
				if (is_object($clientLinkObj) && isset($clientLinkObj->id) && $clientLinkObj->id > 0) {
					$newObjs[] = FigureSetSubGroup::fromDB($clientLinkObj->id);
				}
			}
			subtractOverlap($newObjs, $oldObjs, array("id"));
			foreach ($newObjs as $newObj) {
				CardFigureSetSubGroupLink::create(array("figureSetSubGroup" => $newObj, "card" => $this));
			}
			foreach ($oldObjs as $oldObj) {
				(CardFigureSetSubGroupLink::fromDB(array("figureSetSubGroup" => $oldObj, "card" => $this)))->deleteInDB();
			}
		}
		
		// Update 1-N Links
		if (isset($clientDataObj->deltaUpdateCosts) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->deltaUpdateCosts as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = DeltaUpdateCost::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->card = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->cardPowerRankings) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->cardPowerRankings as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = CardPowerRanking::fromDB($clientLinkObj->id);
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
			delete("Card")->
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

	public function getGeneral() {
		if ( ! property_exists($this, "general")) {
			$this->general = General::fromDB($this->generalID);
		}
		return $this->general;
	}

	public function getHomeworld() {
		if ( ! property_exists($this, "homeworld")) {
			$this->homeworld = Homeworld::fromDB($this->homeworldID);
		}
		return $this->homeworld;
	}

	public function getSpecies() {
		if ( ! property_exists($this, "species")) {
			$this->species = Species::fromDB($this->speciesID);
		}
		return $this->species;
	}

	public function getClass() {
		if ( ! property_exists($this, "class")) {
			$this->class = CardClass::fromDB($this->classID);
		}
		return $this->class;
	}

	public function getPersonality() {
		if ( ! property_exists($this, "personality")) {
			$this->personality = Personality::fromDB($this->personalityID);
		}
		return $this->personality;
	}

	public function getSize() {
		if ( ! property_exists($this, "size")) {
			$this->size = Size::fromDB($this->sizeID);
		}
		return $this->size;
	}

	public function getReleaseSet() {
		if ( ! property_exists($this, "releaseSet")) {
			$this->releaseSet = ReleaseSet::fromDB($this->releaseSetID);
		}
		return $this->releaseSet;
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
