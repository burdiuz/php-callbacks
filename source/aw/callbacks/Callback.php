<?php

namespace aw\callbacks {

	abstract class Callback extends \aw\Object implements IHandler{
		protected $_target;
		public function __construct($target){
			$this->_target = $target;
		}
		public function call($arguments){
			throw new Exception('Handler Error: Handler.call() method must be overridden');
		}
		public function apply(){
			throw new Exception('Handler Error: Handler.apply() method must be overridden');
		}
		public function caller(){
			return array($this, 'apply');
		}
		public function __destruct(){
			unset($this->_target);
		}
	private var $_lastArgs;
	private var $_lastResult;
	}
}