<?php

require_once 'classes/validate.php';

$val = new Validate;

$invalidEmail  = 'foo';
$shortPassword = 'sdfsd';
$validEmail    = 'foo@bar.com';

$val->rule($invalidEmail, 'Email', 'required|email'); // Will return false
$val->rule($shortPassword, 'Password', 'min_length[10]|max_length[25]');
$val->rule($validEmail, 'Email2', 'required|email'); // Wil return true

$errors = $val->errors();
if (!$errors) {
	echo 'Success!';
}
else {
	foreach ($errors as $error) {
		echo "{$error}<br/>";
	}
}