<?
class Library_Session_Value  {

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