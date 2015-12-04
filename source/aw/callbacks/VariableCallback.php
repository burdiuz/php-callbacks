<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks {

  use \InvalidArgumentException;

  class VariableCallback extends Callback {
    protected $_class;
    protected $_name;

    public function __construct(string $name) {
      $name = self::parsePath($name);
      if (is_array($name)) {
        list($this->_class, $this->_name) = $name;
      } else {
        $this->_name = $name;
      }
    }

    public function call(array $args = array()) {
      $value = self::getArgumentValue($args);
      $name = self::parsePath($this->_name);
      if ($this->_class) {
        $className = $this->_class;
        $className::${$this->_name} = $value;
      } else {
        //$GLOBALS[$this->_name] = $value;
        global ${$this->_name};
        ${$this->_name} = $value;
      }
      return $value;
    }

    static public function getArgumentValue($args) {
      if (!$args || count($args) !== 1) {
        throw new InvalidArgumentException('Must be called with exactly one argument.');
      }
      return $args[0];
    }

    static public function parsePath($path) {
      if (preg_match('/^([^:]+)::\\$(.+)$/', $path, $match)) {
        return [$match[1], $match[2], 'class' => $match[1], 'property' => $match[2]];
      }
      return $path;
    }
  }
}