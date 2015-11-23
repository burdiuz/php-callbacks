<?php

namespace aw\callbacks {

	abstract class Callback extends \aw\Object implements ICallback{
		protected $_target;
		public function __construct($target){
			$this->_target = $target;
		}

		public function apply(){
			return $this->call(func_get_args());
		}

		public abstract function call($arguments);

		public function __destruct(){
			unset($this->_target);
		}
	}
}