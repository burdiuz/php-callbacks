<?php
/**
 * Created by Oleg Galaburda on 03.12.15.
 */

namespace aw {

  use \PHPUnit_Framework_TestCase as TestCase;

  class CallableSequenceTest extends TestCase {
    public $collection;
    public $handler1;
    public $handler2;
    public $handler3;
    public $handlerArgs1;
    public $handlerArgs3;

    public function setUp() {
      $this->collection = new CallableSequence();
      $this->handler1 = function (...$args) {
        $this->handlerArgs1 = $args;
        return 1;
      };
      $this->collection->addItem($this->handler1);
      $this->handler2 = function (&$arg1, &$arg2) {
        $arg1 += 20;
        $arg2 .= 'YZ';
        return 2;
      };
      $this->collection->addItem($this->handler2);
      $this->handler3 = function (...$args) {
        $this->handlerArgs3 = $args;
        return 3;
      };
      $this->collection->addItem($this->handler3);
    }

    public function test() {
      $collection = $this->collection;
      $this->assertEquals(3, $collection(5, 'AB'));
      $this->assertEquals([5, 'AB'], $this->handlerArgs1);
      $this->assertEquals([25, 'ABYZ'], $this->handlerArgs3);
      $collection->removeItemAt(1);
      $this->assertEquals(3, $collection(5, 'AB'));
      $this->assertEquals([5, 'AB'], $this->handlerArgs3);
    }
  }
}