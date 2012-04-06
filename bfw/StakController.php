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
 * Stakabl Controller Class
 *
 * Loads critical base objects that are used through the framework
 *
 * @package     Stakabl
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Stakabl Dev Team
 * @link        http://stakabl.com/user-guide/
 */
class StakController extends StakBase{
	public function __construct() {
		parent::__construct();
		$aClass = array('config'   => 'StakConfig',
						'session'  => 'StakSession',
						'input'    => 'StakInput',
						'uri'      => 'StakUri',
						'validate' => 'StakValidator',
						'mailer'   => 'StakMailer',
						'view'	   => 'StakView',
						'message'  => 'StakMessage',
						'module'   => 'StakModule');
		foreach ($aClass as $sKey => $sClass) {
			$this->$sKey = StakLoader::loadClass($sClass);
		}			
	}
}