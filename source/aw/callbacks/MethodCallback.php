<?php
namespace aw\callbacks {
	class MethodCallback extends Callback {
		private $_name;

		public function __construct($target, $name) {
			parent::__construct($target);
			$this->_name = $name;
		}

		public function call($arguments) {
			return call_user_func_array(array($this->_target, $this->_name), $arguments);
		}

		public function __destruct() {
			parent::__destruct();
			unset($this->_name);
		}
	}
}