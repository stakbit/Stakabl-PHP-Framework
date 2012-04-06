<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AboutControllerTests extends \Enhance\TestFixture {
    public function combineTwoStrings() {
        $target = \Enhance\Core::getCodeCoverageWrapper('AboutController');
        $result = $target->combineTwoStrings('First', 'Last');
        \Enhance\Assert::areIdentical('First Last', $result);
    }
    
}

