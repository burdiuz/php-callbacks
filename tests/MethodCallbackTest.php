<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks {

    use \PHPUnit_Framework_TestCase as TestCase;

    class MethodTest {
        public function increment($value) {
            return ++$value;
        }
    }

    class MethodCallbackTest extends TestCase {

        /**
         * @test
         */
        public function instanceTest() {

        }

        public function staticTest() {

        }
    }
}