<?php

require_once 'classes/validate.php';

$val = new Validate;

$invalidEmail  = 'foo';
$shortPassword = 'sdfsd';
$validEmail    = 'foo@bar.com';
$matchVal      = 'The Red car is blue';
$regexPattern  = '/red/i';

$val->rule($invalidEmail, 'Email', 'required|email'); // Will return false
$val->rule($shortPassword, 'Password', 'min_length[10]|max_length[25]');
$val->rule($validEmail, 'Email2', 'required|email'); // Will return true
$val->rule($matchVal, 'Car', "match_regex[{$regexPattern}]"); // Will return true

$errors = $val->errors();
if (!$errors) {
	echo 'Success!';
}
else {
	foreach ($errors as $error) {
		echo "{$error}<br/>";
	}
}
