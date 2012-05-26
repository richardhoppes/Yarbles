<?php 
class Library_ApplicationModel extends Model {
	
	protected $boolStateful;
	protected $strStateKey;
	
	public function __construct($strTable, $mxdId = null, $strIdField = 'intId', $boolStateful = false, $strStateKey = null) 
	{
		$this->boolStateful = $boolStateful;
		$this->strStateKey = $strStateKey;
		
		parent::__construct($strTable, $mxdId, $strIdField);
	}
	
	public function load($strQuery = null) 
	{
		parent::load($strQuery);
		
		$this->updateApplicationState();
	}
	
	public function save()
	{
		parent::save();
		
		$this->updateApplicationState();
	}
	
	public function isStateful() 
	{
		if($this->boolStateful && $this->strStateKey)
			return true;
		else
			return false;
	}

	
	public function updateApplicationState() 
	{
		if($this->isStateful())
		{ 
			$strFunction = str_replace("Model_", "", $this->strStateKey);
			$strFunction = str_replace("_", "", $strFunction);
			$strFunction = "set".$strFunction;
			
			$objApplicationState = Library_ApplicationState::getHandle();
			$objApplicationState->$strFunction($this);
		}
	}
	
	// Overrides parent function so the list of child class variables doesn't include variables from this class
	protected function getChildClassVariables() 
	{
		$objReflection = new ReflectionClass($this);
		$arrVars = array_keys($objReflection->getdefaultProperties());
		
		$objReflection = new ReflectionClass(__CLASS__);
		$arrParentVars = array_keys($objReflection->getdefaultProperties());

		$arrChildVars = array();
		foreach ($arrVars as $strKey) {
			if (!in_array($strKey, $arrParentVars)) {
				$arrChildVars[] = $strKey;
			}
		}
		
		return $arrChildVars;
	}
}