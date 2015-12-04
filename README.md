##PHP-Callbacks

Family of Callback Wrappers allowing to store chains of delayed calls that can be started by event.
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