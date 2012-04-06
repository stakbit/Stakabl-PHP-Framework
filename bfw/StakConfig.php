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
 * Stakabl Config Class
 *
 * Manage configuration settings
 *
 * @package     Stakabl
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Stakabl Dev Team
 * @link        http://stakabl.com/user-guide/
 */
class StakConfig {
	private static $oInstance, $aConfig = array();
	
	private function __construct() {}

	public static function getInstance() {
		if(!self::$oInstance) {
			self::$oInstance = new self;
		}
		return self::$oInstance;
	}

	public static function set($aConfig) {
		foreach($aConfig as $k => $v){
			self::$aConfig[$k] = $v;
		}
	}
	
	public function get($sConfItem) {
		// If item is a subaray convert to object to access like this: $this->config->get("route")->default;
		if  (is_array(self::$aConfig[$sConfItem])) {
			return (object) self::$aConfig[$sConfItem];
		} 
		return self::$aConfig[$sConfItem];
	}
}