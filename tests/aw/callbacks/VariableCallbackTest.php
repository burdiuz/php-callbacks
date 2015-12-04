<?php
/**
 * Created by Oleg Galaburda on 03.12.15.
 */

namespace aw\callbacks {

  use \PHPUnit_Framework_TestCase as TestCase;

  class _MyVariableCallbackObject {
    static public $staticProperty = 'static property';
  }

  class VariableCallbackTest extends TestCase {

    public function test() {
      global $variableTest1;
      $callback = new VariableCallback('variableTest1');
      $callback('TEST 1');
      $this->assertEquals('TEST 1', $variableTest1);
    }

    public function testStatic() {
      $callback = new VariableCallback('\\aw\\callbacks\\_MyVariableCallbackObject::$staticProperty');
      $callback('new value');
      $this->assertEquals('new value', _MyVariableCallbackObject::$staticProperty);
    }
  }
}
namespace {
  $variableTest1 = '1';
}