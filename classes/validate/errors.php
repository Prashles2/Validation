<?php

/*
*
* PHP Validation Class
* 
* Supports multiple error files and include multilingual error messages
*
* http://prash.me
* http://github.com/prashles
*
*
* @author Prash Somaiya
*
*/


Class Errors {
	
	/*
	* array $errors
	*
	* All errors in plain-text are stored here
	*/
	
	private $errors    = array();
	
	/*
	* array $errorText
	*
	* Errors messages from the error files are save in here
	*/
	
	private $errorText = array();

	/*
	* Grabs the correct file containing the errors
	*/
	
	public function __construct($errorFile)
	{
		$this->errorText = require $errorFile;
	}
	
	/*
	* Returns an array of errors after replacing any parameters 
	*/

	public function error(array $errors)
	{
		foreach ($errors as $error) {

			$errorMessage = $this->errorText[$error['rule']];

			$replace = array(
				':name' => $error['name'],
				':param' => (!empty($error['param'])) ? $error['param'] : NULL
			);

			$message = str_replace(array_keys($replace), array_values($replace), $errorMessage);

			$this->errors[] = $message;

		}

		return $this->errors;

	}


}