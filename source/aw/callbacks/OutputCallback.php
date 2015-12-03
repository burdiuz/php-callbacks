<?php
/**
 * Created by Oleg Galaburda on 03.12.15.
 */

class OutputCallback extends Callback {
  public function __construct() {
  }

  public function call(array $args = array()) {
    echo json_encode($args);
  }
}
