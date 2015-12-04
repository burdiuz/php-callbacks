<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw {

  use \PHPUnit_Framework_TestCase as TestCase;

  class CallableCollectionAddTest extends TestCase {
    public $collection;
    public function setUp(){
      $this->collection = new CallableCollection();
    }

    public function testCreate() {
      $this->assertTrue(is_array($this->collection->items));
      $this->assertEmpty($this->collection->items);
      $this->assertEquals(0, $this->collection->getCount());
    }

    public function testAddItem() {
      $handler1 = function(){
        return 1;
      };
      $handler2 = function(){
        return 2;
      };
      $this->assertEquals(0, $this->collection->getCount());
      $this->collection->addItem($handler1);
      $this->assertEquals(1, $this->collection->getCount());
      $this->assertSame($handler1, $this->collection->getItemAt(0));
      $this->collection->addItem($handler2);
      $this->assertEquals(2, $this->collection->getCount());
      $this->assertSame($handler2, $this->collection->getItemAt(1));
    }
  }

  class CallableCollectionGetTest extends TestCase {
    public $collection;
    public $handler1;
    public $handler2;
    public $handler3;

    public function setUp(){
      $this->collection = new CallableCollection();
      $this->handler1 = function(){
        return 1;
      };
      $this->collection->addItem($this->handler1);
      $this->handler2 = function(){
        return 2;
      };
      $this->collection->addItem($this->handler2);
      $this->handler3 = function(){
        return 3;
      };
    }

    public function testGet() {
      $this->assertSame($this->handler1, $this->collection->getItemAt(0));
      $this->assertSame($this->handler2, $this->collection->getItemAt(1));
    }

    public function testHas() {
      $this->assertTrue($this->collection->hasItem($this->handler1));
      $this->assertTrue($this->collection->hasItem($this->handler2));
      $this->assertFalse($this->collection->hasItem($this->handler3));
    }

    public function testFindItem() {
      $this->assertEquals(0, $this->collection->getItemIndex($this->handler1));
      $this->assertEquals(1, $this->collection->getItemIndex($this->handler2));
      $this->assertEquals(-1, $this->collection->getItemIndex($this->handler3));
    }

    public function testSet() {
      $this->collection->setItem(0, $this->handler3);
      $this->assertEquals(2, $this->collection->getCount());
      $this->assertSame($this->handler3, $this->collection->getItemAt(0));
      $this->assertNotSame($this->handler1, $this->collection->getItemAt(0));
      $this->assertSame($this->handler2, $this->collection->getItemAt(1));
      $this->collection->setItem(50, $this->handler3);
      $this->assertSame($this->handler3, $this->collection->getItemAt(50));
      $this->assertEquals(3, $this->collection->getCount());
    }

    public function testRemoveItems() {
      $this->collection->addItem($this->handler3);
      $this->assertEquals(3, $this->collection->getCount());
      $this->collection->removeItem($this->handler2);
      $this->assertEquals(2, $this->collection->getCount());
      $this->assertSame($this->handler1, $this->collection->getItemAt(0));
      $this->assertNull($this->collection->getItemAt(1));
      $this->assertSame($this->handler3, $this->collection->getItemAt(2));
      $this->collection->removeItem($this->handler1);
      $this->assertNull($this->collection->getItemAt(0));
      $this->assertNull($this->collection->getItemAt(1));
      $this->assertSame($this->handler3, $this->collection->getItemAt(2));
      $this->collection->removeItem($this->handler3);
      $this->assertEquals(0, $this->collection->getCount());
      $this->assertNull($this->collection->getItemAt(0));
      $this->assertNull($this->collection->getItemAt(1));
      $this->assertNull($this->collection->getItemAt(3));
    }

    public function testPopIndices() {
      $this->collection->addItem($this->handler3);
      $this->assertEquals(3, $this->collection->getCount());
      $this->collection->removeItemAt(2);
      $this->assertEquals(2, $this->collection->getCount());
      $this->assertSame($this->handler1, $this->collection->getItemAt(0));
      $this->assertSame($this->handler2, $this->collection->getItemAt(1));
      $this->collection->removeItemAt(1);
      $this->assertSame($this->handler1, $this->collection->getItemAt(0));
      $this->collection->removeItemAt(0);
      $this->assertSame(null, $this->collection->getItemAt(0));
    }

    public function testClear() {
      $this->collection->removeAll();
      $this->assertEquals(0, $this->collection->getCount());
      $this->assertEquals(null, $this->collection->getItemAt(0));
    }

    public function testList() {
      $this->assertEquals([$this->handler1, $this->handler2], $this->collection->getItems());
      $this->collection->removeItemAt(0);
      $this->assertEquals([1 => $this->handler2], $this->collection->getItems());
    }
  }
}