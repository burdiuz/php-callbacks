<?php
/**
 * Created by Oleg Galaburda on 03.12.15.
 */


namespace aw{
  trait ArrayAccessItemsArrayTrait {
    public function offsetExists($offset) {
      return isset($this->_items[$offset]);
    }

    public function offsetGet($offset) {
      return $this->getItemAt($offset);
    }

    public function offsetSet($offset, $value) {
      if(!is_callable($value)){
        throw new Exception('Only callable values are allowed.');
      }
      if(is_null($offset)){
        $this->addItem($value);
      }else{
        $this->setItem($offset, $value);
      }
    }

    public function offsetUnset($offset) {
      return $this->removeItemAt($offset);
    }
  }
}