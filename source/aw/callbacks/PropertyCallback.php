<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks {
	class PropertyCallback extends Callback {
		protected $_name;

		public function __construct(&$target, $name) {
			parent::__construct($target);
			if(is_array($target) || is_object($target)){
				throw new InvalidArgumentException('Property target must be an array or object.');
			}
			$this->_name = $name;
		}

		public function call(array $args = array()) {
			$result = null;
			$value = VariableCallback::getArgumentValue($args);
			if(is_array($this->_target)){
				$this->_target[$this->_name] = $value;
			}else{
				$this->_target->{$this->_name} = $value;
			}
			return $this->getValue();
		}

		public function getName() {
			return $this->_name;
		}

		public function getValue() {
			$result = null;
			if(is_array($this->_target)){
				$result = $this->_target[$this->_name];
			}else{
				$result = $this->_target->{$this->_name};
			}
			return $result;
		}

		public function __destruct() {
			parent::__destruct();
			unset($this->_name);
		}
	}
}