<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks {
    interface ICallback {
        public function call(array $args);
        public function __invoke(...$args);
    }
}