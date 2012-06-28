<?php

class FrontController {

	private static function createControllerName($strValue) {
		return "Controller_".$strValue;
	}

	private static function createControllerMethodName($strValue) {
		return $strValue;
	}

	private static function createControllerFilePath($strControllerName) {
		$objConfig = Config::getHandle();
		return $objConfig->APP_PATH . "/" . str_replace('_', '/', $strControllerName ) . ".class.php";
	}

	public static function run() {

		$objConfig = Config::getHandle();

		try {
			// Break url apart by slashes
			preg_match('/.*index.php(.*)/i', $_SERVER['PHP_SELF'], $arrRequestParts);

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

			// Set default controller/method
			$strDefaultControllerName = self::createControllerName($objConfig->DEFAULT_CONTROLLER);
			$strDefaultControllerMethodName = self::createControllerMethodName($objConfig->DEFAULT_CONTROLLER_METHOD);

			// Start with default controller/method
			$strControllerName = $strDefaultControllerName;
			$strControllerMethodName = $strDefaultControllerMethodName;

			// Look for controller/method in controller path
			if ( sizeof($arrControllerPath) > 0 ) {

				$intArgumentOffset = 0;

				// Loop through parts separately, build potential controller/method relationships
				$intControllerPathSize = sizeof($arrControllerPath);
				for ( $intPathOffset = $intControllerPathSize; $intPathOffset >= 0; $intPathOffset-- ) {

					// Create controller name
					$strControllerName = "";
					for ( $intPathIndex=0; $intPathIndex < $intPathOffset; $intPathIndex++ ) {
						$strControllerName .= $strControllerName ? "_" . ucfirst($arrControllerPath[$intPathIndex]) : ucfirst($arrControllerPath[$intPathIndex]);
					}
					$strControllerName = self::createControllerName($strControllerName);

					// Create method name
					$strControllerMethodName = isset($arrControllerPath[$intPathOffset]) ? $arrControllerPath[$intPathOffset] : $strDefaultControllerMethodName;
					$strControllerMethodName = self::createControllerMethodName($strControllerMethodName);

					// Check for:
					// 1. controller :: method
					// 2. controller :: default method
					if ( file_exists(self::createControllerFilePath($strControllerName)) ) {
						if ( method_exists($strControllerName, $strControllerMethodName) ) {
							$intArgumentOffset = $intPathOffset + 1;
							break;
						} elseif ( method_exists($strControllerName, $strDefaultControllerMethodName) ) {
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
			if(!file_exists(self::createControllerFilePath($strControllerName))) {
				throw new Exception_Controller_ControllerNotFound($strControllerName);
			} elseif(!method_exists($strControllerName, $strControllerMethodName)) {
				throw new Exception_Controller_ControllerMethodNotFound($strControllerMethodName);
			} else {
				$objController = new $strControllerName();
				$objController->$strControllerMethodName();
			}

		} catch (Exception_Controller_ControllerNotFound $e) {
			$objController = new Controller_Error();
			$objController->pageNotFound($e);

		} catch (Exception_Controller_ControllerMethodNotFound $e) {
			$objController = new Controller_Error();
			$objController->pageNotFound($e);

		} catch (Exception_View_ViewNotFound $e) {
			$objController = new Controller_Error();
			$objController->pageNotFound($e);

		} catch (Exception_Controller_NotAuthorized $e){
			$objController = new Controller_Error();
			$objController->notAuthorized($e);

		} catch (Exception_Cache_NotConnected $e) {
			$objController = new Controller_Error();
			$objController->internalServerError($e);

		} catch (Exception_Request_MethodNotAllowed $e) {
			$objController = new Controller_Error();
			$objController->methodNotAllowed($e);

		} catch (Exception $e) {
			$objController = new Controller_Error();
			$objController->main($e);
		}
	}
}
