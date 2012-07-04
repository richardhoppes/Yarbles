<?php
namespace com\simplephp\core;

/**
 * Abstract model class
 * @author Richard Hoppes
 */
interface ModelInterface {

	public function load($strQuery = null, $arrVariables = array());

	public function save();

	public function getId();

	public function setId($mxdId);

}