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
 * Stakabl Session Class
 *
 * Sets and gets PHP session
 *
 * @package     Stakabl
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Stakabl Dev Team
 * @link        http://stakabl.com/user-guide/
 */
class StakSession {
	private static $oInstance, $aSession;
	
	private function __construct() {}
	
	public static function getInstance() {
		if( !self::$oInstance ) {
			session_start();
			self::$aSession =& $_SESSION;
			self::$oInstance = new self;
		}
		return self::$oInstance;
	}
	
	public function getSession($sName = null) {
		if(!$sName) {
			return self::$aSession;
		}
		return self::$aSession[$sName];
	}
	
	public function setSession($sName, $vVal) {
		self::$aSession[$sName] = $vVal;
	}
	
	public function deleteSession($sName) {
		unset(self::$aSession[$sName]); 
	}
	
	public function destroySession() {
		session_unset(); 
		session_destroy();  
	}
}