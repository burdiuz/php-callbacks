<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks {
	class FunctionCallback extends Callback {
		/**
		 * Might be name of the function or any callable object.
		 * @var  callable|string
		 */
		private $_func;

		private $_defaultArgs;

		public function __construct($func, array $defaultArgs = array()) {
			$this->_func = $func;
			$this->_defaultArgs = $defaultArgs;
		}

		/**
		 * Note: No need for apply() method, since argument upacking available:
		 * $result = callback->call(...$myArgs);
		 * @param $args
		 * @return mixed
		 */
		public function call(array $args = array()) {
			$result = null;
			$args = $this->_defaultArgs + $args;
			$func = $this->_func;
			if(is_callable($func)){
				$result = $func(...$args);
			}else{
				$result = call_user_func_array($this->_func, $args);
			}
			return $result;
		}

		public function __destruct() {
			unset($this->_func);
		}
	}
}