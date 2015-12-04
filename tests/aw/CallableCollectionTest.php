<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw {

  use \PHPUnit_Framework_TestCase as TestCase;

  class CallableCollectionTest extends TestCase {

    /**
     * @test
     */
    public function createTest() {
      $collection = new CallableCollection();
      $this->assertTrue(is_array($collection->items));
      $this->assertEmpty($collection->items);
      $this->assertEquals(0, $collection->count);
    }
  }
}