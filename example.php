<?php
/**
 * Created by Oleg Galaburda on 04.12.15.
 */
require_once 'vendor/autoload.php';

$variable = 'value';
$callback = new \aw\callbacks\VariableCallback('variable');
$callback('new value');
echo $variable.PHP_EOL; // new value

function doEcho($param){
  echo 'My name is: '.$param.PHP_EOL;
}

$callback = new \aw\callbacks\FunctionCallback('doEcho');
$callback('####'); // My name is: ####


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