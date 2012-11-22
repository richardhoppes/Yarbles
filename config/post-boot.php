<?php
use yarbles\framework\common\YarblesLocator;
use yarbles\framework\Autoload;

function __autoload($strClass) {
	Autoload::load($strClass);
}

$objFrontController = YarblesLocator::getFrontController();
$objFrontController->dispatch();