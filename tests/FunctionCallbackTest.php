<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace {
    function increment($arg) {
        return ++$arg;
    }
}

namespace aw\callbacks {

    use \PHPUnit_Framework_TestCase as TestCase;

    class FunctionCallbackTest extends TestCase {
        /**
         * @test
         */
        public function functionNameTest() {
            $callback = new FunctionCallback('\increment');
            $this->assertEquals(3, $callback(2));
        }

        /**
         * @test
         */
        public function closureTest() {
            $callback = new FunctionCallback(function ($value) {
                return ++$value;
            });
            $this->assertEquals(3, $callback(2));
        }

        /**
         * @test
         */
        public function staticTest() {

        }
    }
}