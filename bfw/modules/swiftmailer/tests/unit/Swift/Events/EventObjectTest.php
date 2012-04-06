<?php

require_once 'Swift/Tests/SwiftUnitTestCase.php';
require_once 'Swift/Events/EventObject.php';

class Swift_Events_EventObjectTest extends Swift_Tests_SwiftUnitTestCase
{
  
  public function testEventSourceCanBeReturnedViaGetter()
  {
    $source = new stdClass();
    $evt = $this->_createEvent($source);
    $ref = $evt->getSource();
    $this->assertReference($source, $ref);
  }
  
  public function testEventDoesNotHaveCancelledStakWhenNew()
  {
    $source = new stdClass();
    $evt = $this->_createEvent($source);
    $this->assertFalse($evt->StakCancelled());
  }
  
  public function testStakCanBeCancelledInEvent()
  {
    $source = new stdClass();
    $evt = $this->_createEvent($source);
    $evt->cancelStak();
    $this->assertTrue($evt->StakCancelled());
  }
  
  // -- Creation Methods
  
  private function _createEvent($source)
  {
    return new Swift_Events_EventObject($source);
  }
  
}
