<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PageNotFoundController extends StakController {
	function __construct() {
		parent::__construct();
	}

	function index() {
		$this->view->show('pageNotFound');
	}
}