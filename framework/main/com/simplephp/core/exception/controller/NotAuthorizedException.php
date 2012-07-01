<?php
namespace com\simplephp\core\exception\controller;

use com\simplephp\core\exception\controller\BaseControllerException;

class NotAuthorizedException extends BaseControllerException {

	public function __construct() {
		parent::__construct('Not Authorized');
	}

}