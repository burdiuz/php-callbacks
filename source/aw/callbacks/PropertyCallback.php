<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks {
	class PropertyCallback extends Callback {
		protected $_name;

		public function __construct(&$target, $name) {
			parent::__construct($target);
			$this->_name = $name;
		}

		public function call($arguments) {
			if (!$arguments || count($arguments) < 1) {
				throw new InvalidArgumentException('Must be called with single argument with updated property value.');
			}
			$value = $arguments[0];
			$result = null;
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