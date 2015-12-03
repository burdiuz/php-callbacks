<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks {
  class VariableCallback extends Callback {
    protected $_name;

    public function __construct(string $name) {
      $this->_name = $name;
    }

    public function call(array $args = array()) {
      $value = self::getArgumentValue($args);
      //$name = $this->_name;
      ${$this->_name} = $value;
      return $value;
    }

    static public function getArgumentValue($args) {
      if (!$args || count($args) !== 1) {
        throw new InvalidArgumentException('Must be called with exactly one argument.');
      }
      return $args[0];
    }
  }
}