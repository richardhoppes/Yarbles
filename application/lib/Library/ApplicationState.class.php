<?php 

class Library_ApplicationState extends State 
{
    protected function __construct()
    {
        $this->setUser(new Model_User());
        $this->setNetflixAuth(new Model_NetflixAuth());
        $this->setFormData(null);

        parent::__construct();
    }

    // TODO: better way of doing this than re-declaring the entire function in the extended applicationState class
    public static function getHandle()
    {
        if(!self::$objState)
        {
            try
            {
                $objSession = Session::getHandle();
                self::$objState = $objSession->getKey('state');
            }
            catch(Exception $e)
            {
                self::$objState = new self();
            }
        }

        return self::$objState;
    }

    public function getUser()
    {
        return $this->getVariable('user');
    }

    public function getNetflixAuth()
    {
        return $this->getVariable('netflixAuth');
    }

    public function getFormData()
    {
        return $this->getVariable('formData');
    }

    public function setUser($objUser)
    {
        $this->setVariable('user', $objUser);
        $this->updateSession();
    }

    public function setNetflixAuth($objNetflixAuth)
    {
        $this->setVariable('netflixAuth', $objNetflixAuth);
        $this->updateSession();
    }

    public function setFormData($objFormData)
    {
        $this->setVariable('formData', $objFormData);
        $this->updateSession();
    }

    public function clearFormData()
    {
        $this->setVariable('formData', null);
        $this->updateSession();
    }

    public function isLoggedIn()
    {
        if($this->getUser())
        {
            if($this->getUser()->getId())
                return true;
            else
                return false;
        }
        else
            return false;
    }

    public function isPremium() {
        $boolRetVal = false;
        if($this->getUser() && $this->getUser()->getPremium()) {
            $boolRetVal = true;
        }
        return $boolRetVal;
    }

    public function requireLogin()
    {
        $objConfig = Config::getHandle();

        if(!$this->isLoggedIn())
        {
            header("Location: " . $objConfig->BASE_URL . "/account/user/loginMulti");
            exit();
        }
    }

    public function requirePremium() {
        if(!$this->isPremium()) {
            throw new Exception_Controller_NotAuthorized();
        }
    }

    public function requireNotPremium() {
        if($this->isPremium()) {
            throw new Exception_Controller_NotAuthorized();
        }
    }

    public function requireAdmin() {
        if(!$this->getUser()->getAdmin()) {
            throw new Exception_Controller_NotAuthorized();
        }
    }

    public function isNetflixAuthorized()
    {
        if($this->getNetflixAuth())
        {
            if($this->getNetflixAuth()->getId())
                return true;
            else
                return false;
        }
        else
            return false;
    }

    public function hasInvalidFormData()
    {
        if($this->getFormData())
        {
            return !$this->getFormData()->isValid();
        }
        else
        {
            return false;
        }
    }

    public function hasValidFormData()
    {
        if($this->getFormData())
        {
            return $this->getFormData()->isValid();
        }
        else
        {
            return false;
        }
    }
	
}