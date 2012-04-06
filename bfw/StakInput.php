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
 * Stakabl Input Class
 *
 * Pre-processes global input data for security
 *
 * @package     Stakabl
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Stakabl Dev Team
 * @link        http://stakabl.com/user-guide/
 */
class StakInput {
	private  static $oInstance, $aPost;
	
	private function __construct() {}
	
	public static function getInstance() {
		if( !self::$oInstance ) {
			if ($_POST) {
				self::$aPost = $_POST;
				unset($_POST);
			}
			self::$oInstance = new self;
		}
		return self::$oInstance;
	}
	
	public function getPost($sName = null) {
		if (!isset($sName)) {
			return self::$aPost;
		} else {
			return self::$aPost[$sName];
		}
	}
	
	public function setPost($sName, $vVal) {
		self::$aPost[$sName] = $vVal;
	}
}