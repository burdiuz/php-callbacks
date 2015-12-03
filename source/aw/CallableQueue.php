<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw {

  // will execute one by one passing previous result as next callback argument
  class CallableQueue extends CallableCollection {
    public function __invoke(...$args) {
      $value = $args;
      foreach($this as $callable){
        $value = [$callable(...$value)];
      }
      return $value;
    }
  }
}