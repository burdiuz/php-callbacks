<?php
/**
 * Created by Oleg Galaburda on 03.12.15.
 */

namespace aw {

  use \PHPUnit_Framework_TestCase as TestCase;

  class CallableQueueTest extends TestCase {
    public $collection;
    public $handler1;
    public $handler2;
    public $handler3;

    public function setUp() {
      $this->collection = new CallableQueue();
      $this->collection[] = $this->handler1 = function($value){
        return $value*2;
      };
      $this->collection[] = $this->handler2 = function($value){
        return $value*3;
      };
      $this->collection[] = $this->handler3 = function($value){
        return $value*4;
      };
    }

    public function test() {
      $collection = $this->collection;
      $this->assertEquals(48, $collection(2));
      unset($this->collection[1]);
      $this->assertEquals(16, $collection(2));
    }

  }
}