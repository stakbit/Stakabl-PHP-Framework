<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class TestController extends StakController {
	public function __construct() {
		parent::__construct();
	   StakLoader::loadClass('StakTester')->init();
    }

	public function index() {
	    //$testPath = $_SERVER['DOCUMENT_ROOT'] . '/app/test/'; 
        $testPath = 'app/test/'; 
        
        \Enhance\Core::discoverTests($testPath);
        //\Enhance\Core::runTests();
        \Enhance\Core::runTests(\Enhance\TemplateType::Cli);
        
    }
}