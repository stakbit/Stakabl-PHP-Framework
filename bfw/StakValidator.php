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
 * Stakabl Validator Class
 *
 * Validate common form input
 *
 * @package     Stakabl
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Stakabl Dev Team
 * @link        http://stakabl.com/user-guide/
 */
class StakValidator {
	private static $oInstance;
	
	private function __construct() {}

	public static function getInstance() {
		if(!self::$oInstance) {
			self::$oInstance = new self;
		}
		return self::$oInstance;
	}

	public function setRules($aFormRules) {
		$this->aFormRules = $aFormRules;
	}
	
	public function run() {
		$B =& StakBase::getBase();
		if ($this->aFormRules > 0) {
			foreach($this->aFormRules as $aRules) {
				$aRule = explode('|', $aRules[2]);
				foreach ($aRule as $sRule) {
					if($this->formErrors[$aRules[0]][0]) continue; // process one rule per item
					if ($sRule == 'required') {
						$required = $B->input->getPost($aRules[0]);
						if (empty($required)) {
							$this->formErrors[$aRules[0]][0] = $aRules[1];
							$this->formErrors[$aRules[0]][1][] = $sRule;
						}
					} elseif ($sRule == 'validEmail') {
						$validEmail = $B->input->getPost($aRules[0]);
						if (!$this->validEmail($validEmail)) {
							$this->formErrors[$aRules[0]][0] = $aRules[1];
							$this->formErrors[$aRules[0]][1][] = $sRule;
						}
					}		
				} // inner foreach
			} // end of foreach			
		}
		if (count($this->formErrors) > 0 ) {
			return FALSE;
		}
		return TRUE;
	}
	
	public function showErrors() {
		$B =& StakBase::getBase();
		if ($this->formErrors > 0) {
			foreach ($this->formErrors as $aErrors) {	
				foreach ($aErrors[1] as $sError) {
					if ($sError == 'required') {
						$B->success($aErrors[0] . ' is empty'); 
					} elseif ($sError == 'validEmail') {
						$B->success($aErrors[0] . ' is not a valid email address'); 
					}			
				} // end of inner foreach
			} // end of outer foreach
		}
	}
	
	private function validEmail($address) {
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $address)) ? FALSE : TRUE;
	}
	
	public function sticky($sName) {
		$B =& StakBase::getBase();
		return $B->input->getPost($sName);
	}
	
	public function stickySelected($sName, $sSelectedName) {
		if ($sName == $sSelectedName) {
			return 'selected';
		}
	}

	public function stickyChecked($sName, $sSelectedName) {
		if ($sName == $sSelectedName) {
			return 'checked';
		}
	}
}