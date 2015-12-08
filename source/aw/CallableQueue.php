<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw {

  use \InvalidArgumentException;

  // will execute one by one passing previous result as next callback argument
  class CallableQueue extends CallableCollection {

    public function setItem(int $index, callable $value) {
      $count = $this->getCount();
      if ($index <= $count) {
        parent::setItem($index, $value);
      } else {
        throw new InvalidArgumentException('Adding items only allowed with [] operator.');
      }
    }

    public function removeItemAt($index):bool {
      $result = isset($this->_items[$index]);
      if ($result) {
        array_splice($this->_items, $index, 1);
      }
      return $result;
    }

    public function __invoke(...$args) {
      $value = $args;
      foreach ($this as $callable) {
        $value = [$callable(...$value)];
      }
      return $value[0];
    }
  }
}