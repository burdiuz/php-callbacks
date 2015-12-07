<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace {
  function increment($arg) {
    return ++$arg;
  }

  function defArgs(...$args) {
    return $args;
  }
}

namespace aw\callbacks {

  use \PHPUnit_Framework_TestCase as TestCase;

  class Math {
    public function increment($arg) {
      return ++$arg;
    }
    static function decrement($arg) {
      return --$arg;
    }
  }

  class FunctionCallbackTest extends TestCase {

    public function testFunctionName() {
      $callback = new FunctionCallback('\increment');
      $this->assertEquals(3, $callback(2));
    }

    public function testArray() {
      $callback = new FunctionCallback(array(new Math(), 'increment'));
      $this->assertEquals(3, $callback(2));
    }

    public function testClosure() {
      $callback = new FunctionCallback(function ($value) {
        return ++$value;
      });
      $this->assertEquals(3, $callback(2));
    }

    /**
     * @expectedException \Exception
     */
    public function testNonCallableException() {
      $callback = new FunctionCallback('anything crazy');
      $callback(true);
    }

    public function testDefaultParams() {
      $callback = new FunctionCallback('defArgs', [1, 2, 3, 4]);
      $this->assertEquals(['a', 'b', 3, 4], $callback('a', 'b'));
    }

    public function testStatic() {
      $callback = new FunctionCallback('\aw\callbacks\Math::decrement');
      $this->assertEquals(3, $callback(4));
    }
  }
}