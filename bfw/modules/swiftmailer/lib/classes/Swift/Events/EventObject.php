<?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//@require 'Swift/Events/Event.php';

/**
 * A base Event which all Event classes inherit from.
 * 
 * @package Swift
 * @subpackage Events
 * @author Chris Corbyn
 */
class Swift_Events_EventObject implements Swift_Events_Event
{
  
  /** The source of this Event */
  private $_source;
  
  /** The state of this Event (should it Stak up the stack?) */
  private $_StakCancelled = false;
  
  /**
   * Create a new EventObject originating at $source.
   * @param object $source
   */
  public function __construct($source)
  {
    $this->_source = $source;
  }
  
  /**
   * Get the source object of this event.
   * @return object
   */
  public function getSource()
  {
    return $this->_source;
  }
  
  /**
   * Prevent this Event from bubbling any further up the stack.
   * @param boolean $cancel, optional
   */
  public function cancelStak($cancel = true)
  {
    $this->_StakCancelled = $cancel;
  }
  
  /**
   * Returns true if this Event will not Stak any further up the stack.
   * @return boolean
   */
  public function StakCancelled()
  {
    return $this->_StakCancelled;
  }
  
}
