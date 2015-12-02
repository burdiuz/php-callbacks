<?php

function one(&$text){
	two($text);
}
function two(&$text){
	three($text);
}
function three(&$text){
	$text1 = &$text;
	$text1 .= '-Value-';
}

$value = 'Init';
one($value);
echo $value;