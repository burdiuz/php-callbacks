<?php
namespace aw\callbacks {
    interface ICallback extends ICallable
    {
        /**
         * Return saved data from called method
         * @return any
         */
        public function lastResult();

        public function lastArguments():array;
    }
}