<?php
/**
 * Created by Oleg Galaburda on 03.12.15.
 */

namespace aw\callbacks {

  use \PHPUnit_Framework_TestCase as TestCase;

  class OutputCallbackTest extends TestCase {
    public function test() {
      $callback = new OutputCallback();
      ob_start();
      $callback('test string', 1);
      $value = ob_get_contents();
      ob_end_clean();
      $this->assertEquals('["test string",1]', $value);
    }
  }
}