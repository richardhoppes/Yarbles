<?
/*
	Example extended class:
	class Library_Session_Value_DisplayFormat extends Session_Value {

		const DISPLAY_FORMAT_DETAIL = "detail";
		const DISPLAY_FORMAT_GRID = "grid";

		public function __construct() {
			$this->strKey = 'dataGridFormat';
			$this->strDefaultValue = self::DISPLAY_FORMAT_DETAIL;
		}
	}
 */
abstract class Session_Value  {

	protected $strKey;
	protected $strDefaultValue;

	public function setValue($strValue) {
		$objSession = Session::getHandle();
		$objSession->setKey($this->strKey, $strValue);
	}

	public function getValue() {
		$objSession = Session::getHandle();

		$retVal = null;
		try {
			$retVal = $objSession->getKey($this->strKey);
		} catch (Exception $e) {
			$retVal = $this->strDefaultValue;
			$this->setValue($this->strDefaultValue);
		}

		return $retVal;
	}

}