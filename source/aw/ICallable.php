<?php
namespace aw {
    interface ICallable {
        /**
         * Execute ICallable instance with arguments list passed
         * @param array $arguments list of arguments
         */
        public function call($arguments);

        /**
         * Execute ICallable instance with arguments that was passed to this method
         */
        public function apply();

    }
}