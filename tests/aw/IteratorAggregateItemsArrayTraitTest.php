<?php
/**
 * Created by Oleg Galaburda on 03.12.15.
 */

namespace aw {

  use \PHPUnit_Framework_TestCase as TestCase;
  use \IteratorAggregate;

  class _IteratorAggregateTest implements IteratorAggregate {
    use IteratorAggregateItemsArrayTrait;

    protected $_items;

    public function __construct(array $list) {
      $this->_items = $list;
    }
  }

  class IteratorAggregateItemsArrayTraitTest extends TestCase {
    public $list = [1, 2, 3, 4, 9, 0];
    public $obj;

    public function setUp() {
      $this->obj = new _IteratorAggregateTest($this->list);
    }

    public function test() {
      foreach ($this->obj as $key => $value) {
        $this->assertEquals($this->list[$key], $value);
      }
    }
  }
}