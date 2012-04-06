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
 * Stakabl Uri Class
 *
 * Parses URIs and determines routing
 *
 * @package     Stakabl
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Stakabl Dev Team
 * @link        http://stakabl.com/user-guide/
 */
class StakUri{
	private static $oInstance;

	private function __construct() {}
	
	public static function getInstance() {
		if(!self::$oInstance) {
			self::$oInstance = new self;
		}
		return self::$oInstance;
	}

	public function getParams() {
		$BC =& StakConfig::getInstance();
		$sFullUri = $_SERVER['PATH_INFO'];
		$this->aFullUri = explode('/', trim($sFullUri,'/'));
		// check if a sub folder existing in place of controller
		if (!empty($this->aFullUri[0]) && is_dir($BC->get('webUrl') . 'controller/' . $this->aFullUri[0])) {
			$this->controller = !empty($this->aFullUri[1]) ? $this->aFullUri[1] : 'index';
			$this->action = !empty($this->aFullUri[2]) ? $this->aFullUri[2] : 'index';
		} else {
			$this->controller = !empty($this->aFullUri[0])?$this->aFullUri[0]: $BC->get("route")->default;
			$this->action = !empty($this->aFullUri[1])?$this->aFullUri[1]:'index';
			// lets check to make sure the method exist, otherwise use a params
			if(class_exists($this->getController())) {
				$rc = new ReflectionClass($this->getController());
				if($rc->hasMethod($this->getAction())) {
					unset($this->aFullUri[0]);
					unset($this->aFullUri[1]);
				} else {
					$this->action = 'index'; // force method
					if (!empty($this->aFullUri[1])) {
						unset($this->aFullUri[0]);			
					}
				}
				$this->params = array_chunk($this->aFullUri, 2);
			}
		}
		$this->params = isset($this->params) && count($this->params) > 0 ? $this->params : null;
		return array($this->getController(), $this->action, $this->params);
	}
	
	private function getController() {
		return ucfirst($this->controller) . 'Controller';
	}

	private function getAction() {
		return $this->action;
	}
	
	public function getUrl() {
		return $this->controller . '/' . $this->action ; 
	}
	
	public function getSegment($iPair, $iSegment) {
		return $this->params[$iPair][$iSegment];
	}
	
	public function getSegments() {
		return implode('/', $this->params);
	}
	
	public function redirect($sUrl) {
		$BC =& StakConfig::getInstance();
		header('Location: ' . $BC->get('webUrl') . $sUrl);
	}
}