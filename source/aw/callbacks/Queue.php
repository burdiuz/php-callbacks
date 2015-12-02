<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks;

// will execute one by one passing previous result as next callback argument
use aw\CallableCollection;

class Queue extends CallableCollection implements ICallback {
    public function call(array $args) {

    }
    public function __invoke(...$args) {

    }
}