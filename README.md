##PHP-Callbacks
[![Build Status](https://travis-ci.org/burdiuz/php-callbacks.svg?branch=master)](https://travis-ci.org/burdiuz/php-callbacks)
[![Coverage Status](https://coveralls.io/repos/burdiuz/php-callbacks/badge.svg?branch=master&service=github)](https://coveralls.io/github/burdiuz/php-callbacks?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/568ba879eb4f47003c001399/badge.svg?style=flat)](https://www.versioneye.com/user/projects/568ba879eb4f47003c001399)

Family of Callback Wrappers allowing to store chains of delayed calls that can be started by event.
* FunctionCallback - calls global function or static method.
* MethodCallback - calls instance or static method.
* OutputCallback - outputs all arguments in JSON format.
* PropertyCallback - stores first argument as property value, works with static properties.
* VariableCallback - stores first argument as variable value, works with static properties.
* CallableQueue - calls stored callbacks passing previous result as argument, returns result of last callback.
* CallableSequence - calls stored callbacks with same arguments, returns result of last callback.
```php
$variable = 'value';
$callback = new \aw\callbacks\VariableCallback('variable');
$callback('new value');
echo $variable.PHP_EOL; // new value

function doEcho($param){
  echo 'My name is: '.$param.PHP_EOL;
}

$callback = new \aw\callbacks\FunctionCallback('doEcho');
$callback('####'); // My name is: ####
```
All wrappers are callables, so can be used directly as closure.
CallableCollection accepts any callable including PHP closures.
```php
function multiply4($value){
  return $value*4;
}

$collection = new \aw\CallableQueue();
$collection[] = function($value){
  return $value*2;
};
$collection[] = function($value){
  return $value*3;
};
$collection[] = new \aw\callbacks\FunctionCallback('multiply4');
echo 'Result: '.$collection(2).PHP_EOL; // Result: 48
```