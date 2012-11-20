<?php

require_once 'classes/validate.php';

$val = new Validate;

$email     = 'invalid@email';
$url       = 'invalidUrlHere';
$ip        = '123123123';
$firstName = ''; 
$lastName  = 'a';

$val->rule($email, 'Email', 'email');
$val->rule($url, 'URL', 'required|url');
$val->rule($ip, 'IP Address', 'required|ip');
$val->rule($firstName, 'First name', 'required');
$val->rule($lastName, 'Last name', 'min_length[4]');

$exec = $val->errors();

if (!$exec) {
	echo 'Success!';
}
else {
	foreach ($exec as $error) {
		echo "{$error}<br/>";
	}
}

/* Output:
Email should be a valid e-mail address
URL should be a valid URL
IP Address should be a valid IP address
First name is required
*/

/* 
* Rules set, functions respond true or false for each
* Add to errors class
*/