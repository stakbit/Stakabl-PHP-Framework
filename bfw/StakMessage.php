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
 * Stakabl Messaging Class
 *
 * Displays success/error messages
 *
 * @package     Stakabl
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Stakabl Dev Team
 * @link        http://stakabl.com/user-guide/
 */
class StakMessage {
	private static $oInstance, $aMessage, $sType;
		
	private function __construct() {}

	public static function getInstance() {
		if(!self::$oInstance) {
			self::$oInstance = new self;
		}
		return self::$oInstance;
	}
	
	public function show() {
		//$B =& StakBase::getBase();
		//$B->validate->showErrors(); // populates message in validation mode
		//$message = implode("<br />", self::$aMessage);
		//include_once $B->config->get('appUrl') . 'view/_messageView.php';
	}
	
	public function success($sMessage) {
		self::$sType = 'success';
		self::$aMessage[] = $sMessage;
	}
	
	public function error($sMessage) {
		self::$sType = 'error';
		self::$aMessage[] = $sMessage;
	}
}