<?php
/**
 * Created by Oleg Galaburda on 03.12.15.
 */


namespace aw{

  use \Exception;
  use \IteratorAggregate;
  use \ArrayAccess;

  class CallableCollection extends Object implements IteratorAggregate, ArrayAccess {
    use IteratorAggregateItemsArrayTrait;
    use ArrayAccessItemsArrayTrait;

    protected $_items = array();

    public function addItem(callable $item) {
      if ($item === $this) {
        throw new Exception('Collection cannot add itself.');
      } else if ($this->hasItem($item)) {
        throw new Exception('Collection cannot add same item twice.');
      } else {
        $this->_items[] = $item;
      }
    }

    public function setItem(int $index, callable $value) {
      $count = $this->getCount();
      if ($index <= $count) {
        $this->_items[$index] = $value;
      } else {
        throw new Exception('Adding items only allowed with [] operator.');
      }
    }

    public function hasItem(callable $item):bool {
      return (bool)array_search($item, $this->_items, true);
    }

    public function getItemAt(int $index):callable {
      return isset($this->_items[$index]) ? $this->_items[$index] : false;
    }

    public function getItemIndex(callable $item):int {
      return array_search($item, $this->_items, true) || -1;
    }

    public function removeItem(callable $item) {
      $index = $this->getItemIndex($item);
      if ($index !== false) {
        $this->removeItemAt($index);
      }
      return $item;
    }

    public function removeItemAt($index):callable {
      $callback = $this->_items[$index];
      if ($callback) {
        array_splice($this->_items, $index, 1);
      }
      return $callback || false;
    }

    public function removeAll() {
      $this->_items = array();
    }

    /**
     * @public
     * @property items [callable[]]
     */
    public function getItems():array {
      return $this->_items;
    }

    /**
     * @public
     * @property count [int]
     */
    public function getCount():int {
      return count($this->_items);
    }

    public function __destruct() {
      unset($this->_items);
    }
  }
}