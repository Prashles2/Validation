<?php

require_once 'classes/validate.php';

$val = new Validate;

$invalidEmail  = 'foo';
$shortPassword = 'sdfsd';
$validEmail    = 'foo@bar.com';
$matchVal      = 'The Red car is blue';
$regexPattern  = '/red/i';

/*
* First method of adding validation rules using pipes
*/

$val->rule($invalidEmail, 'Email', 'required|email'); // Will return false
$val->rule($shortPassword, 'Password', 'min_length[10]|max_length[25]');
$val->rule($validEmail, 'Email2', 'required|email'); // Will return true
$val->rule($matchVal, 'Car', "match_regex[{$regexPattern}]"); // Will return true



/*
* Second method of adding validation rules using arrays
*/

$val1 = new Validate;

$val1->ruleA($invalidEmail, 'Email', array('required','email'));
$val1->ruleA($shortPassword, 'Password', array('min_length' => 10, 'max_length' => 25));		
$val1->ruleA($matchVal, 'Car', array('match_regex' => $regexPattern));							 

$errors = $val->errors();
if (!$errors) {
	echo 'Success!';
}
else {
	foreach ($errors as $error) {
		echo "{$error}<br/>";
	}
}
