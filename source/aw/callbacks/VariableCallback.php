<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks {
    class VariableCallback extends PropertyCallback{
        public function __construct($name) {
            parent::__construct($name);
        }
    }
}