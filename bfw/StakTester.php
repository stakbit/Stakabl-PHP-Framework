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
 * Stakabl Tester Class
 *
 * Unit tester class
 *
 * @package     Stakabl
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Stakabl Dev Team
 * @link        http://stakabl.com/user-guide/
 */
class StakTester{	
	private static $oInstance;
	
	private function __construct() {}
	
	public static function getInstance() {
		if(!self::$oInstance) {
			self::$oInstance = new self;
		}
		return self::$oInstance;
	}
	
	function init() {		
		$this->config =& StakBase::getBase()->config;
		if (file_exists( $this->config->get('frameworkUrl') . 'modules/unitTester/EnhanceTestFramework.php')) {
			include_once $this->config->get('frameworkUrl') .  'modules/unitTester/EnhanceTestFramework.php'; 
		}
    }   
}