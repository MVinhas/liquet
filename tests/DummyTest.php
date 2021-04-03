<?php

use PHPUnit\Framework\TestCase;

final class DummyTest extends TestCase
{
    /**
     * These are not tests, these are only annotations 
     * that can be useful in future tests
     */

     /**
      * public function testNewQueueIsEmpty()
      {
          $queue = new Queue;

          $this->assertEquals(0, $queue->getCount());

          return $queue;
      } 
      
      we just need to put a @depend before the class
      this way we don't have to instanciate Queue again


      @depends testNewQueueIsEmpty
      public function testAnItemIsAddedToTheQueue(Queue $queue)
      {
          //code goes here
      }
      */
}