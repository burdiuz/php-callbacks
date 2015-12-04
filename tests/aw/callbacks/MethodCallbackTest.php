<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks {

  use \PHPUnit_Framework_TestCase as TestCase;

  class MethodTest {
    public function increment($value) {
      return ++$value;
    }

    public function defArgs(...$args) {
      return $args;
    }

    static public function decrement($value) {
      return --$value;
    }
  }

  class MethodCallbackTest extends TestCase {

    public $target;

    public function setUp() {
      $this->target = new MethodTest();
    }

    public function testInstance() {
      $callback = new MethodCallback($this->target, 'increment');
      $this->assertEquals(4, $callback(3));
    }

    public function testDefaultArgs() {
      $callback = new MethodCallback($this->target, 'defArgs', [1, 2, 3, 4]);
      $this->assertEquals(['a', 'b', 3, 4], $callback('a', 'b'));

      $callback = new MethodCallback($this->target, 'increment', [4]);
      $this->assertEquals(5, $callback());
    }

    public function testStatic() {
      $callback = new MethodCallback('\\aw\\callbacks\\MethodTest', 'decrement');
      $this->assertEquals(5, $callback(6));
    }
  }
}