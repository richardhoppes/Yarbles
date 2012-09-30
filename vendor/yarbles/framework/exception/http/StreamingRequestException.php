<?php
namespace yarbles\framework\exception\http;

use yarbles\framework\exception\http\BaseHttpException;;

class StreamingRequestException extends BaseHttpException {

	public function __construct($strMessage = "Streaming requests are only supported for PUT method") {
		parent::__construct($strMessage);
	}

}