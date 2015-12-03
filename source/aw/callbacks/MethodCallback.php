<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks {

	class MethodCallback extends Callback {
		private $_name;
		private $_defaultArgs;

		public function __construct($target, $name, array $defaultArgs = array()) {
			parent::__construct($target);
			$this->_name = $name;
			$this->_defaultArgs = $defaultArgs;
		}

		public function call(array $args = array()) {
			$args = $this->_defaultArgs + $args;
			$callee = $this->_target ? array($this->_target, $this->_name) : $this->_name;
			return call_user_func_array($callee, $args);
		}

		public function __destruct() {
			parent::__destruct();
			unset($this->_name);
		}
	}
}