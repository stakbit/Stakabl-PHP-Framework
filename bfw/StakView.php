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
 * Stakabl View Class
 *
 * Displays views
 *
 * @package     Stakabl
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Stakabl Dev Team
 * @link        http://stakabl.com/user-guide/
 */
class StakView {
	private static $oInstance, $aData = array();
	
	private function __construct() {}

	public static function getInstance() {
		if(!self::$oInstance) {
			self::$oInstance = new self;
		}
		return self::$oInstance;
	}
	
	public function show($sTemplate, $aData = array()) {
		$B =& StakBase::getBase();
		$this->view     =& $this;
		$this->config   =& $B->config;
		$this->message  =& $B->message;	
		$this->validate =& $B->validate;
		$this->session  =& $B->session;
		$this->input    =& $B->input;
		if (is_array($aData)) {
			self::$aData = array_merge($aData, self::$aData);
			extract(self::$aData);
		}
		include_once $B->config->get('appUrl') . 'view/' . $sTemplate . 'View.php';
	}
	
	private function showDebug() {
		if ($this->config->get('debug')) {
			echo '<pre>POST: ';
			print_r( $this->input->getPost());
			echo '</pre>';
			echo ' <pre>SESSION: ';
			print_r($this->session->getSession());
			echo '</pre>';
		}
	}	
}