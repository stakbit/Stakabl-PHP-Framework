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
 * Stakabl Model Class
 *
 * Interacts with database
 *
 * @package     Stakabl
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Stakabl Dev Team
 * @link        http://stakabl.com/user-guide/
 */
class StakModel  {
	private static $oInstance;
	private static $dbConnectInstance;
	protected $type = 'model';
	protected function __construct() {}
	
	public static function getInstance() {
		if(!self::$oInstance) {
			self::$oInstance = new self;
		}
		return self::$oInstance;
	}
	
	private static function dbConnectInstance() {
		if( !self::$dbConnectInstance ) {
			$con = mysql_connect("localhost","root","");
			if (!$con) {
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("", $con);
		}	
	}
	
	public static function load ($model) {	
		self::dbConnectInstance();
		$modelLowerCase = strtolower($model);
		$model = ucfirst($model);
		$model = $model . 'Model';
		if(class_exists($model)) {
			return new $model;
		}
	}
	
	public function lastInsertID() {
		return mysql_insert_id ();
	}
	
	public function execute($query = null) {
		return mysql_query($query);
	}
	
	public function getNumRows($rResult) {
		return mysql_num_rows($rResult);
	}
	
	public function getArrayAll($rResult) {
		while($row = mysql_fetch_assoc($rResult)) {
			$aData[] = $row;
		}
		return $aData;
	}
	
	public function getArrayItem($rResult) {
		return  mysql_fetch_assoc($rResult);
	}
}