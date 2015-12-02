<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks {

	class MethodCallback extends Callback {
		private $_name;

		public function __construct($target, $name) {
			parent::__construct($target);
			$this->_name = $name;
		}

		public function call(array $args = array()) {
			$callee = $this->_target ? array($this->_target, $this->_name) : $this->_name;
			return call_user_func_array($callee, $args);
		}

		public function __destruct() {
			parent::__destruct();
			unset($this->_name);
		}
	}
}