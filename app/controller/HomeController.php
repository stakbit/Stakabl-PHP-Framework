<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class HomeController extends StakController {
	public function __construct() {
		parent::__construct();
		// StakLoader::loadClass('StakTester')->init();
    }

	public function index() {
        //echo  $this->addTwoNumbers(2, 5);	
        //print_r(StakBase::getBase());
		$this->view->show('home');
	}
    
    public function addTwoNumbers($a, $b) {
        return $a + $b;
    }
}