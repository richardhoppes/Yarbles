<?php
namespace yarbles\framework\exception\http;

use yarbles\framework\exception\http\BaseHttpException;	

class NoConnectionException extends BaseHttpException {

	public function __construct($strMessage = "Unable to connect") {
		parent::__construct($strMessage);
	}

}