<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks {
	use \aw\Object;
	abstract class Callback extends Object implements ICallback{
		protected $_target;
		public function __construct(&$target){
			$this->_target = &$target;
		}

		public function __invoke(...$args) {
			return $this->call($args);
		}

		public abstract function call(array $args = array());

		public function __destruct(){
			unset($this->_target);
		}
	}
}