<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Stakabl PHP 5 framework
 *
 * An simple open source application development framework for PHP 5
 *
 * @package     Stakabl
 * @author      Stakabl Dev Team
 * @copyright   Copyright (c) 2012, Stakabl
 * @license     http://stakabl.com/license/
 * @link        http://stakabl.com
 * @since       Version 0.5
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Stakabl Loader Class
 *
 * Loads critical system classes
 *
 * @package     Stakabl
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Stakabl Dev Team
 * @link        http://stakabl.com/user-guide/
 */
class StakLoader {
	private static $oInstance, $aConfig, $aObjects;
	
	private function __construct() {}
	
	public static function getInstance() {
		if(!self::$oInstance) {
			self::$oInstance = new self;
		}
		return self::$oInstance;
	}

	public static function loadClass($sClass) {
		if (isset(self::$aObjects[$sClass])) {
			return self::$aObjects[$sClass];
		}
		$reflectionClass = new ReflectionClass($sClass);
		if($reflectionClass->hasMethod('getInstance')) {
			$reflectionMethod = $reflectionClass->getMethod('getInstance');
			if($reflectionMethod->isStatic()) {
				$item = $reflectionMethod->invoke(null);
			}
			self::$aObjects[$sClass] =& $item;
			return self::$aObjects[$sClass];
		}
	}
	
	public static function autoloadBase(&$aConfig) {
		self::$aConfig = $aConfig;
		spl_autoload_register('self::autoloadMain');
	}
	
	private static function autoloadMain($class) {
		if (file_exists(self::$aConfig['frameworkUrl'] . $class . ".php")) {
			include_once(self::$aConfig['frameworkUrl'] . $class . ".php");
		} elseif (file_exists(self::$aConfig['appUrl'] . 'controller/' . $class . ".php")) {
			include_once(self::$aConfig['appUrl'] . 'controller/' . $class . ".php");
		} elseif (file_exists(self::$aConfig['appUrl'] . 'model/' . $class . ".php")) {
			include_once(self::$aConfig['appUrl'] . 'model/' . $class . ".php");
		}
		StakConfig::set(self::$aConfig);
	}
}