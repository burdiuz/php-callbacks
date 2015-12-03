<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks {
  interface ICallback {
    public function call(array $args);

    /**
     * Callback should be callable
     * @param ...$args
     * @return mixed
     */
    public function __invoke(...$args);
  }
}