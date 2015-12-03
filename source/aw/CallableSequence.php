<?php
/**
 * Created by Oleg Galaburda on 03.12.15.
 */

namespace aw{

  // will execute all callbacks with same arguments
  class CallableSequence extends CallableQueue {
    public function __invoke(...$args) {
      $value = null;
      foreach ($this as $callable) {
        if (is_callable($callable)) {
          $value = $callable(...$args);
        }
      }
      return $value;
    }
  }
}