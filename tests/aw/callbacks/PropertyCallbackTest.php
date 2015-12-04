<?php
/**
 * Created by Oleg Galaburda on 03.12.15.
 */

namespace aw\callbacks {

  use \PHPUnit_Framework_TestCase as TestCase;

  class _MyPropertyCallbackObject {
    public $property = 'public property';
    static public $staticProperty = 'static property';
  }

  class PropertyCallbackTest extends TestCase {

    public $obj;

    public function setUp() {
      $this->obj = new _MyPropertyCallbackObject();
    }

    public function testObject() {
      $callback = new PropertyCallback($this->obj, 'property');
      $callback('new value');
      $this->assertEquals('new value', $this->obj->property);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNotAcceptableTarget() {
      $param = false;
      new PropertyCallback($param, 'property');
    }

    public function testStatic() {
      $className = '\\aw\\callbacks\\_MyPropertyCallbackObject';
      $callback = new PropertyCallback($className, 'staticProperty');
      $callback('new value');
      $this->assertEquals('new value', _MyPropertyCallbackObject::$staticProperty);
    }

    public function testStringTargetPassedNotByReference() {
      $className = '\\aw\\callbacks\\_MyPropertyCallbackObject';
      $callback = new PropertyCallback($className, 'staticProperty');
      $className = 'Something Crazy';
      $callback('new value');
      $this->assertEquals('new value', _MyPropertyCallbackObject::$staticProperty);
    }

    public function testArray() {
      $list = array('zero'=>0, 'first'=>1, 'second'=>2, 'third'=>3);
      $callback = new PropertyCallback($list, 'second');
      $callback('new value');
      $this->assertEquals('new value', $list['second']);
    }
  }
}