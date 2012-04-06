<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class HomeControllerTests extends \Enhance\TestFixture {
    // You can name tests as you like, but they must be public.
    // All public methods other than setUp and tearDown are treated as tests.
    public function addTwoNumbersWith3and2Expect5Test() {
        $target = \Enhance\Core::getCodeCoverageWrapper('HomeController');
        $result = $target->addTwoNumbers(3, 2);
        \Enhance\Assert::areIdentical(5, $result);
    }    
}

