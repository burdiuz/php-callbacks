<?php
/**
 * Created by Oleg Galaburda on 03.12.15.
 */

namespace aw\callbacks {

  class OutputCallback extends Callback {
    public function __construct() {

    }

    public function call(array $args = array()) {
      echo json_encode($args);
    }
  }
}
