<?php
namespace yarbles\framework;

interface ModelInterface {

	public function load($strQuery = null, $arrVariables = array());

	public function save();

	public function getId();

	public function setId($mxdId);

}