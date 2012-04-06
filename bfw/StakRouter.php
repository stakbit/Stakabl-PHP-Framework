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
 * Stakabl Router Class
 *
 * Parses URIs and determines routing
 *
 * @package     Stakabl
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Stakabl Dev Team
 * @link        http://stakabl.com/user-guide/
 */
class StakRouter{
	private static $oInstance;
	
	private function __construct() {}
	
	public static function getInstance() {
		if(!self::$oInstance) {
			self::$oInstance = new self;
		}
		return self::$oInstance;
	}
	
	public function route() {        
		$this->config = StakConfig::getInstance();
		list($this->controller, $this->action, $this->params) = StakUri::getInstance()->getParams();
	
		if(class_exists($this->controller)) {
			$rc = new ReflectionClass($this->controller);
			if($rc->hasMethod($this->action)) {
				$controller = $rc->newInstance();
				$method = $rc->getMethod($this->action);
				$method->invoke($controller);
			} else {
				$this->routeNotFound('Action');
			}
		} else {
			$this->routeNotFound('Controller');
		} 
	}

	private function routeNotFound($sRoute) {
		header('Location: ' . $this->config->get('webUrl') . 'pageNotFound');
	}
}