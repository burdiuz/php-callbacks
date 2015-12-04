<?php
/**
 * Created by Oleg Galaburda on 03.12.15.
 */

namespace aw{

  use \InvalidArgumentException;
  use \IteratorAggregate;
  use \ArrayAccess;

  class CallableCollection extends Object implements IteratorAggregate, ArrayAccess {
    use IteratorAggregateItemsArrayTrait;
    use ArrayAccessItemsArrayTrait;

    protected $_items = array();

    public function addItem(callable $item) {
      if ($item === $this) {
        throw new InvalidArgumentException('Collection cannot add itself.');
      } else if ($this->hasItem($item)) {
        throw new InvalidArgumentException('Collection cannot add same item twice.');
      } else {
        $this->_items[] = $item;
      }
    }

    public function setItem(int $index, callable $value) {
      $this->_items[$index] = $value;
    }

    public function hasItem(callable $item):bool {
      return is_int(array_search($item, $this->_items, true));
    }

    public function getItemAt(int $index) {
      return isset($this->_items[$index]) ? $this->_items[$index] : null;
    }

    public function getItemIndex(callable $item):int {
      $index = array_search($item, $this->_items, true);
      return is_int($index) ? $index : -1;
    }

    public function removeItem(callable $item) {
      $index = $this->getItemIndex($item);
      if ($index !== false) {
        $this->removeItemAt($index);
      }
      return $item;
    }

    public function removeItemAt($index) {
      $callback = $this->_items[$index];
      unset($this->_items[$index]);
      return $callback;
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