<?php
/**
 * Created by Oleg Galaburda on 02.12.15.
 */

namespace aw\callbacks {

    use \Exception;
    use \IteratorAggregate;

    trait CallbackCollection {
        protected $_items = array();

        public function addItem(ICallback $item) {
            if ($item === $this) {
                throw new Exception('Collection cannot add itself.');
            } else if ($this->hasItem($item)) {
                throw new Exception('Collection cannot add same item twice.');
            } else {
                $this->_items[] = $item;
            }
        }

        public function hasItem(ICallback $item):boolean {
            return (boolean)array_search($item, $this->_items, true);
        }

        public function getItemAt(int $index):ICallback {
            return isset($this->_items[$index]) ? $this->_items[$index] : false;
        }

        public function getItemIndex(ICallback $item) {
            return array_search($item, $this->_items, true);
        }

        public function items():array {
            return $this->_items;
        }

        public function removeItem(ICallback $item) {
            $item = false;
            $index = $this->getItemIndex($item);
            if ($index !== false) {
                $item = $this->removeItemAt($index);
            }
            return $item;
        }

        public function removeItemAt($index):ICallback {
            $callback = $this->_items[$index] || false;
            if ($callback) {
                array_splice($this->_items, $index, 1);
            }
            return $callback;
        }

        public function removeAll() {
            $this->_items = array();
        }

        public function __destruct() {
            unset($this->_items);
        }
    }
}