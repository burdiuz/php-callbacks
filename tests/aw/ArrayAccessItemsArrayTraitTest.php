<?php
/**
 * Created by Oleg Galaburda on 03.12.15.
 */

namespace aw {

  use \PHPUnit_Framework_TestCase as TestCase;
  use \ArrayAccess;

  class _ArrayAccessTest implements ArrayAccess {
    use ArrayAccessItemsArrayTrait;

    protected $_items;

    public function __construct(array $list = array()) {
      $this->_items = $list;
    }

    public function getItemAt($offset) {
      return $this->_items[$offset];
    }

    public function addItem($value) {
      return array_push($this->_items, $value);
    }

    public function setItem($offset, $value) {
      $this->_items[$offset] = $value;
    }

    public function removeItemAt($offset) {
      unset($this->_items[$offset]);
    }

    public function getItems():array {
      return $this->_items;
    }

    public function getCount():int {
      return count($this->_items);
    }
  }

  class ArrayAccessItemsArrayTraitTest extends TestCase {
    public $obj;

    public function setUp() {
      $this->obj = new _ArrayAccessTest();
    }

    public function testSet() {
      $this->assertEquals(0, $this->obj->getCount());
      $this->obj[0] = '3';
      $this->obj[2] = '1';
      $this->obj[1] = '2';
      $this->assertEquals(array('3', '2', '1'), $this->obj->getItems());
      $this->assertEquals(3, $this->obj->getCount());
    }

    public function testGet() {
      $this->obj[0] = '3';
      $this->assertEquals('3', $this->obj[0]);
      $this->obj[2] = '1';
      $this->assertEquals('1', $this->obj[2]);
      $this->obj[1] = '2';
      $this->assertEquals('2', $this->obj[1]);
    }

    public function testIsset() {
      $this->obj[0] = '3';
      $this->assertTrue(isset($this->obj[0]));
      $this->assertFalse(isset($this->obj[1]));
      $this->obj[2] = '1';
      $this->obj[1] = '2';
      $this->assertTrue(isset($this->obj[1]));
      $this->assertFalse(isset($this->obj[3]));
    }

    public function testUnset() {
      $this->obj[0] = '3';
      $this->obj[1] = '2';
      $this->obj[2] = '1';
      $this->assertEquals(3, $this->obj->getCount());
      unset($this->obj[2]);
      $this->assertEquals(2, $this->obj->getCount());
      unset($this->obj[1]);
      $this->assertEquals(1, $this->obj->getCount());
      unset($this->obj[0]);
      $this->assertEquals(0, $this->obj->getCount());
    }
  }
}