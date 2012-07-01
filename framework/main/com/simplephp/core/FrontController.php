<?php
namespace com\simplephp\core;

use com\simplephp\core\FrontControllerInterface;
use com\simplephp\core\ConfigInterface;

use com\simplephp\core\exception\controller\ControllerMethodNotFoundException;
use com\simplephp\core\exception\controller\ControllerNotFoundException;
use com\simplephp\core\exception\controller\NotAuthorizedException;
use com\simplephp\core\exception\view\ViewNotFoundException;
use com\simplephp\core\exception\cache\CacheNotConnectedException;
use com\simplephp\core\exception\request\RequestMethodNotAllowedException;
use com\simplephp\core\controller\ErrorController;

/**
 * Front controller - this is what makes things tick
 * @author Richard Hoppes
 */
class FrontController implements FrontControllerInterface {

	private $objConfig;

	public function __construct(ConfigInterface $objConfig) {
		$this->objConfig = $objConfig;
	}

	public function run() {
		try {
			$arrControllerPath = $this->getControllerPathFromUrl($_SERVER['PHP_SELF']);

			// Set default controller/method
			$strDefaultControllerName 				= $this->objConfig->getProperty("default_controller");
			$strDefaultControllerMethodName 		= $this->objConfig->getProperty("default_controller_method");

			// Start with default controller/method
			$strControllerName 						= $strDefaultControllerName;
			$strControllerPath 						= "";
			$strControllerMethodName 				= $strDefaultControllerMethodName;

			// Look for controller/method in controller path
			if (sizeof($arrControllerPath) > 0) {

				$intArgumentOffset = 0;

				// Loop through parts separately, build potential controller/method relationships
				$intControllerPathSize = sizeof($arrControllerPath);
				for ( $intPathOffset = $intControllerPathSize; $intPathOffset >= 0; $intPathOffset-- ) {

					// Create controller name, path
					$strControllerName = "";
					$strControllerPath = "";
					for ( $intPathIndex=0; $intPathIndex < $intPathOffset; $intPathIndex++ ) {
						if ($intPathIndex == $intPathOffset - 1) {
							$strControllerName =  $arrControllerPath[$intPathIndex];
						} else {
							$strControllerPath .= ($intPathIndex > 0) ? "/{$arrControllerPath[$intPathIndex]}" : $arrControllerPath[$intPathIndex];
						}
					}

					// Create method name
					$strControllerMethodName = isset($arrControllerPath[$intPathOffset]) ? $arrControllerPath[$intPathOffset] : $strDefaultControllerMethodName;

					// If controller exists...
					if ($this->controllerExists($strControllerPath, $strControllerName)) {
						// 1. Controller -> Method
						if ($this->controllerMethodExists($strControllerName, $strControllerMethodName)) {
							$intArgumentOffset = $intPathOffset + 1;
							break;
						// 2. Controller -> Default Method
						} elseif ($this->controllerMethodExists($strControllerName, $strDefaultControllerMethodName)) {
							$strControllerMethodName = $strDefaultControllerMethodName;
							$intArgumentOffset = $intPathOffset;
							break;
						}
					}
				}

				// Add arguments (anything after the controller/method in the controller path) to the request array
				$intArgumentCount = 0;
				for($intArgumentIndex = $intArgumentOffset; $intArgumentIndex < $intControllerPathSize; $intArgumentIndex++) {
					$_REQUEST['arg_'.$intArgumentCount++] = $arrControllerPath[$intArgumentIndex];
				}
			}
			
			// Instantiate controller and invoke controller method
			if (!$this->controllerExists($strControllerPath, $strDefaultControllerName)) {
				throw new ControllerNotFoundException($strControllerName);
			} elseif (!$this->controllerMethodExists($strControllerName, $strControllerMethodName)) {
				throw new ControllerMethodNotFoundException($strControllerMethodName, $strControllerName);
			} else {
				$strNamespacedControllerName = $this->createNamespacedControllerName($strControllerName);
				$objController = new $strNamespacedControllerName($this->objConfig);
				$objController->$strControllerMethodName();
			}

		} catch (ControllerNotFoundException $e) {
			$objController = new ErrorController($this->objConfig);
			$objController->pageNotFound($e);

		} catch (ControllerMethodNotFoundException $e) {
			$objController = new ErrorController($this->objConfig);
			$objController->pageNotFound($e);

		} catch (ViewNotFoundException $e) {
			$objController = new ErrorController($this->objConfig);
			$objController->pageNotFound($e);

		} catch (NotAuthorizedException $e){
			$objController = new ErrorController($this->objConfig);
			$objController->notAuthorized($e);

		} catch (CacheNotConnectedException $e) {
			$objController = new ErrorController($this->objConfig);
			$objController->internalServerError($e);

		} catch (RequestMethodNotAllowedException $e) {
			$objController = new ErrorController($this->objConfig);
			$objController->methodNotAllowed($e);

		} catch (\Exception $e) {
			$objController = new ErrorController($this->objConfig);
			$objController->general($e);
		}
	}

	private function controllerExists($strControllerPath, $strControllerName) {
		$strFormattedControllerName = $this->createControllerName($strControllerName);
		$strControllerFilePath = $this->createControllerFilePath($strControllerPath, $strFormattedControllerName);
		return file_exists($strControllerFilePath);
	}

	private function controllerMethodExists($strControllerName, $strControllerMethodName) {
		$strNamespacedFormattedControllerName = $this->createNamespacedControllerName($strControllerName);
		return method_exists($strNamespacedFormattedControllerName, $strControllerMethodName);
	}

	private function createControllerName($strValue) {
		return $this->objConfig->getProperty("controller_prefix") . ucfirst(strtolower($strValue)) . $this->objConfig->getProperty("controller_suffix");
	}

	private function createNamespacedControllerName($strValue) {
		return $this->objConfig->getProperty("app_web_controller_namespace") . "\\" . $this->createControllerName($strValue);
	}

	private function createControllerFilePath($strControllerPath, $strControllerName) {
		$strRetVal = "";
		if($strControllerPath) {
			$strRetVal = $this->objConfig->getProperty("app_web_controller_path") .  "/" . $strControllerPath . "/" . $strControllerName . ".php";
		} else {
			$strRetVal = $this->objConfig->getProperty("app_web_controller_path") .  "/" . $strControllerName . ".php";
		}
		return $strRetVal;
	}

	private function getControllerPathFromUrl($strPath) {
		// Break url apart by slashes
		preg_match('/.*index.php(.*)/i', $strPath, $arrRequestParts);

		// Get controller/method path
		$arrControllerParts = array();
		if(isset($arrRequestParts[1])) {
			$arrControllerParts = explode('/', $arrRequestParts[1]);
		}
		$arrControllerPath = array();
		foreach($arrControllerParts as $intIndex => $strValue) {
			if($strValue) {
				// Look for key-value pairs in path, add to request array
				if(preg_match('/(.*)-(.*)/i', $strValue, $arrArgMatches)) {
					$_REQUEST[$arrArgMatches[1]] = $arrArgMatches[2];
				}
				$arrControllerPath[] = $strValue;
			}
		}
		return $arrControllerPath;
	}
}
