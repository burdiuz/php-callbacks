<?php

namespace aw\callbacks {
	class FunctionCallback extends Callback {
		private $_name;

		public function __construct($name) {
			$this->_name = $name;
		}

		public function call($arguments) {
			return call_user_func_array($this->_name, $arguments);
		}

		public function __destruct() {
			parent::__destruct();
			unset($this->_name);
		}
	}
}