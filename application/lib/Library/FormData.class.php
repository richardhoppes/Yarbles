<?php 
class Library_FormData {
	
	protected $arrFormData;
	protected $boolValid;
	protected $strMessage;
	
	public function __construct($arrFormData = array(), $boolValid = true, $strMessage = "") 
	{
		$this->arrFormData = $arrFormData;
		$this->boolValid = $boolValid;	
		$this->strMessage = $strMessage;
	}
	
	public function setMessage($strMessage) 
	{
		$this->strMessage = $strMessage;
	}
	
	public function setFormData($arrFormData)
	{
		$this->arrFormData = $arrFormData;
	}
	
	public function setValid()
	{
		$this->boolValid = true;
	}
	
	public function setInvalid()
	{
		$this->boolValid = false;
	}
	
	public function getMessage()
	{
		return $this->strMessage;
	}
	
	public function getFormData()
	{
		return $this->arrFormData;
	}
	
	public function isValid() 
	{
		if($this->boolValid)
			return true;
		else
			return false;
	}
	
}

?>