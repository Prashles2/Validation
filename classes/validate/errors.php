<?php

Class Errors {

	private $errors = array();
	private $errorText;

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