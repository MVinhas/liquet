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

      it is a good pratice to each test be independent, so this should no be needed
      better use setUp (see ControllerTest)

      @depends testNewQueueIsEmpty
      public function testAnItemIsAddedToTheQueue(Queue $queue)
      {
          //code goes here
      }



      getMockBuilder

      use mock, but do not set any method, so the original code runs
      $mock = $this->getMockBuilder(Mailer::class)
                   ->setMethods(null)
                   ->getMock();

                   ->setMethods(['sendMessage']) //Stub sendMessage methods only
      
    
    Mockery - framework for PHPUnit with easily readable code
    

    Data Provider
    @dataProvider titleProvider (before the function declaration)
    
    ******************
    PHP Reflection to test private methods
    $item = new Item;
    $reflector = new ReflectionClass(Item::class)

    $method = $reflector->getMethod('getPrefixedToken');
    $method->setAccessible(true);
    $result = $method->invokeArgs($item), ['example']);
    $this->asserStringStartsWith('example', $result);
    */

      
}