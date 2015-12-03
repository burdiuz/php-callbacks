<?php
/**
 * Created by Oleg Galaburda on 03.12.15.
 */


namespace aw{
  trait IteratorAggregateItemsArrayTrait {
    public function getIterator() {
      foreach($this->_items as $key => $value){
        yield $key => $value;
      }
    }
  }
}