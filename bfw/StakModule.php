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
 * Stakabl Module Class
 *
 * Loads third-party modules
 *
 * @package     Stakabl
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Stakabl Dev Team
 * @link        http://stakabl.com/user-guide/
 */
class StakModule{
	private static $oInstance;

	private function __construct() {}

	public static function getInstance() {
		if(!self::$oInstance) {
			self::$oInstance = new self;
		}
		return self::$oInstance;
	}
	
	public function load ($module) {
		$this->config = StakLoader::loadClass('StakConfig');
		$path  = '/opt/lampp/htdocs/test2/bfw/modules';
		$path2 = '/opt/lampp/htdocs/test2/bfw/modules/simpleblog';
		//$path3 = '/opt/lampp/htdocs/test2/bfw/modules/wordpress/wp-includes';
		set_include_path(get_include_path() . PATH_SEPARATOR . $path . PATH_SEPARATOR . $path2 . PATH_SEPARATOR . $path3 );
		//include_once("/opt/lampp/htdocs/test2/bfw/modules/wordpress/wp-includes/functions.php");
		include_once $this->config->get('frameworkUrl') .  'modules/'. $module . '/index.php';
	}
}