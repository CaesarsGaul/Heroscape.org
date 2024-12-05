<?php

class HeroscapeTournament extends Tournament {
	protected $tournamentID; // Int
	protected $numArmies; // Int
	protected $allowedPointOverlap; // Int
	protected $pointLimit; // Int
	protected $hexLimit; // Int
	protected $figureLimit; // Int
	protected $useDeltaPricing; // Boolean
	protected $includeVC; // Boolean
	protected $includeMarvel; // Boolean

	/* Static 'Constructors' */
	
	public static function fromDB($tournamentID, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["HeroscapeTournament"])) {
			$OBJECT_MAP["HeroscapeTournament"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["HeroscapeTournament"][$tournamentID])) {
			$obj = $OBJECT_MAP["HeroscapeTournament"][$tournamentID];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("tournamentID" => $tournamentID), "Tournament", $tournamentID);
			$OBJECT_MAP["HeroscapeTournament"][$tournamentID] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		Tournament::createTournament($dbObj, $clientDataObj);
		
		
		
		
		$dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeTournament",
				array("tournamentID", "numArmies", "allowedPointOverlap", "pointLimit", "hexLimit", "figureLimit", "useDeltaPricing", "includeVC", "includeMarvel"),
				array($dbObj->id,
					$clientDataObj->numArmies,
					$clientDataObj->allowedPointOverlap,
					$clientDataObj->pointLimit,
					$clientDataObj->hexLimit,
					$clientDataObj->figureLimit,
					isset($clientDataObj->useDeltaPricing) && $clientDataObj-> useDeltaPricing ? true : false,
					isset($clientDataObj->includeVC) && $clientDataObj-> includeVC ? true : false,
					isset($clientDataObj->includeMarvel) && $clientDataObj-> includeMarvel ? true : false)));
		
		$dbObj = self::fromDB($dbObj->id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		parent::createInitialLinks($clientDataObj);
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
		
		if (isset($whereData["tournamentID"])) {
			$whereArray["{$prefix}HeroscapeTournament.tournamentID"] = $whereData["tournamentID"];
		}
		else {
			if (isset($whereData["numArmies"])) {
				$whereArray["{$prefix}HeroscapeTournament.numArmies"] = $whereData["numArmies"];
			}
			if (isset($whereData["allowedPointOverlap"])) {
				$whereArray["{$prefix}HeroscapeTournament.allowedPointOverlap"] = $whereData["allowedPointOverlap"];
			}
			if (isset($whereData["pointLimit"])) {
				$whereArray["{$prefix}HeroscapeTournament.pointLimit"] = $whereData["pointLimit"];
			}
			if (isset($whereData["hexLimit"])) {
				$whereArray["{$prefix}HeroscapeTournament.hexLimit"] = $whereData["hexLimit"];
			}
			if (isset($whereData["figureLimit"])) {
				$whereArray["{$prefix}HeroscapeTournament.figureLimit"] = $whereData["figureLimit"];
			}
			if (isset($whereData["useDeltaPricing"])) {
				$whereArray["{$prefix}HeroscapeTournament.useDeltaPricing"] = $whereData["useDeltaPricing"];
			}
			if (isset($whereData["includeVC"])) {
				$whereArray["{$prefix}HeroscapeTournament.includeVC"] = $whereData["includeVC"];
			}
			if (isset($whereData["includeMarvel"])) {
				$whereArray["{$prefix}HeroscapeTournament.includeMarvel"] = $whereData["includeMarvel"];
			}
		}
		
		if (isset($whereData["tournament"])) {
			$whereArray = array_merge($whereArray, Tournament::createWhereArray($whereData["tournament"], "{$prefix}HeroscapeTournament_tournamentID_"));
		}
		
		
		return array_merge($whereArray, parent::createWhereArray($whereData, $prefix));
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("HeroscapeTournament.name" => "ASC")
		return array_merge(array(), parent::getOrderBy());
	}

	public static function getPrimaryKey() {
		return "tournamentID";
	}

	public static function getNToMLinkClasses() {
		return array_merge(array(), parent::getNToMLinkClasses());
	}

	public static function getNToMLinkClassesWithType() {
		return array_merge(array(), parent::getNToMLinkClassesWithType());
	}

	public static function getNToMLinkClassesWithJSVariableName() {
		return array_merge(array(), parent::getNToMLinkClassesWithJSVariableName());
	}

	public static function getNTo1LinkClasses() {
		return array_merge(array(), parent::getNTo1LinkClasses());
	}

	public static function getForeignKeys() {
		return array_merge(array(), parent::getForeignKeys());
	}

	public static function getColumnNames() {
		return array_merge(array("tournamentID", "numArmies", "allowedPointOverlap", "pointLimit", "hexLimit", "figureLimit", "useDeltaPricing", "includeVC", "includeMarvel"), parent::getColumnNames());
	}

	public static function getActionNames() {
		return array_merge(array(), parent::getActionNames());
	}

	public function performAction($action) {
		switch ($action->name) {
			default:
				return parent::performAction($action);
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
		return parent::isEditableByUser();
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
				return parent::userCanPerformAction($actionName);
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
		return parent::deleteLinks();
	}

	/* Inherited DatabaseObject Functions */
	
	// @DoNotUpdate
	public function updateInDB($clientDataObj = null) {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to update this value.";
		}
		
		if ($this->tournamentID == null) {
			return "Unknown Error";
		}
		
		if ($clientDataObj != null) {
			/*if (isset($clientDataObj->numArmies)) {
				$this->numArmies = $clientDataObj->numArmies;
			}*/
			/*if (isset($clientDataObj->allowedPointOverlap)) {
				$this->allowedPointOverlap = $clientDataObj->allowedPointOverlap;
			}*/
			if (isset($clientDataObj->pointLimit)) {
				$this->pointLimit = $clientDataObj->pointLimit;
			}
			if (property_exists($clientDataObj, "hexLimit")) {
				$this->hexLimit = $clientDataObj->hexLimit;
			}
			if (property_exists($clientDataObj, "figureLimit")) {
				$this->figureLimit = $clientDataObj->figureLimit;
			}
			if (isset($clientDataObj->useDeltaPricing)) {
				$this->useDeltaPricing = $clientDataObj->useDeltaPricing;
			}
			if (isset($clientDataObj->includeVC)) {
				$this->includeVC = $clientDataObj->includeVC;
			}
			if (isset($clientDataObj->includeMarvel)) {
				$this->includeMarvel = $clientDataObj->includeMarvel;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("HeroscapeTournament",
				array(/*"numArmies", *//*"allowedPointOverlap",*/ "pointLimit", "hexLimit", "figureLimit", "useDeltaPricing", "includeVC", "includeMarvel"),
				array(/*$this->numArmies,*/ /*$this->allowedPointOverlap,*/ $this->pointLimit, $this->hexLimit, $this->figureLimit, $this->useDeltaPricing, $this->includeVC, $this->includeMarvel))->
			where(array("tournamentID" => $this->tournamentID)));
		
		return parent::updateInDB($clientDataObj);
	}

	public function deleteInDB() {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to delete this value.";
		}
		
		if ($this->tournamentID == null) {
			return "Unknown Error";
		}
		
		$deleteLinksMsg = $this->deleteLinks();
		if (strlen($deleteLinksMsg) > 0) {
			return $deleteLinksMsg;
		}
		
		$this->dbDelete((new MySQLBuilder())->
			delete("HeroscapeTournament")->
			where(array("tournamentID" => $this->tournamentID)));
		
		return parent::deleteInDB();
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
