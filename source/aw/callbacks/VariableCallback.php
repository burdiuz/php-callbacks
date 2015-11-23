<?php

namespace aw\callbacks {
    class VariableCallback extends PropertyCallback{
        public function __construct($name) {
            parent::__construct($GLOBALS, $name);
        }
    }
}