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

    public function testSet() {
      $this->collection->setItem(0, $this->handler3);
      $this->assertEquals(3, $this->collection->getCount());
      $this->assertSame($this->handler3, $this->collection->getItemAt(0));
      $this->assertNotSame($this->handler1, $this->collection->getItemAt(0));
      $this->assertSame($this->handler2, $this->collection->getItemAt(1));
    }

    public function testSetLastIndex() {
      $this->collection->setItem($this->collection->getCount(), $this->handler3);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetIndexOverflow() {
      $this->collection->setItem(5, $this->handler3);
    }

    public function testShiftIndices() {
      $this->assertEquals(3, $this->collection->getCount());
      $this->assertFalse($this->collection->removeItemAt(3));
      $this->assertTrue($this->collection->removeItemAt(0));
      $this->assertEquals(2, $this->collection->getCount());
      $this->assertSame($this->handler2, $this->collection->getItemAt(0));
      $this->assertSame($this->handler3, $this->collection->getItemAt(1));
      $this->assertTrue($this->collection->removeItemAt(0));
      $this->assertSame($this->handler3, $this->collection->getItemAt(0));
      $this->assertTrue($this->collection->removeItemAt(0));
      $this->assertNull($this->collection->getItemAt(0));
      $this->assertFalse($this->collection->removeItemAt(0));
    }

    public function testList() {
      $this->assertEquals([$this->handler1, $this->handler2, $this->handler3], $this->collection->getItems());
      $this->collection->removeItemAt(0);
      $this->assertEquals([$this->handler2, $this->handler3], $this->collection->getItems());
    }

  }
}