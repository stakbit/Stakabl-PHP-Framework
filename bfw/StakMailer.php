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
 * Stakabl Mailer Class
 *
 * Mailer class the uses the SwiftMailer library to send emails
 *
 * @package     Stakabl
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Stakabl Dev Team
 * @link        http://stakabl.com/user-guide/
 */
class StakMailer{	
	private static $oInstance, $smtpHost, $smtpPort, $smtpUser, $smtpPass;

	private function __construct() {}
	
	public static function getInstance() {
		if(!self::$oInstance) {
			self::$oInstance = new self;
		}
		return self::$oInstance;
	}
	
	public function send() {		
		$BC =& StakBase::getBase()->config;
		self::$smtpHost = $BC->get('smtpHost'); 
		self::$smtpPort = $BC->get('smtpPort'); 
		self::$smtpUser = $BC->get('smtpUser'); 
		self::$smtpPass = $BC->get('smtpPass');
		if (file_exists( $this->config->get('frameworkUrl') . 'modules/swiftmailer/lib/swift_required.php')) {
			include_once $this->config->get('frameworkUrl') .  'modules/swiftmailer/lib/swift_required.php'; 
		}
		$transport = Swift_SmtpTransport::newInstance(self::$smtpHost, self::$smtpPort)->setUsername(self::$smtpUser)->setPassword(self::$smtpPass);
		$mailer = Swift_Mailer::newInstance($transport);
		$message = Swift_Message::newInstance($this->sSubject)
																->setFrom($this->aFrom)
																->setTo($this->aTo)
																->setBody($this->sMessage);
		$result = $mailer->send($message);		
	}
	
	public function to($sTo) {
		return $this->aTo[] = $sTo;
	}
	
	public function from($sFrom) {
		return $this->aFrom[func_get_arg(0)] = func_get_arg(1);
	}
	
	public function subject($sSubject) {
		return $this->sSubject = $sSubject;
	}
	
	public function message ($sMessage) {
		return $this->sMessage = $sMessage;
	}
}