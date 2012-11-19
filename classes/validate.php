<?php

Class Validate {

	private $_errors = array();

	public function __construct()
	{
		require_once 'errors.php';
		$this->errorText = $errorText;
	}

	public function rule($value, $name, $inputRules)
	{

		$inputRules = explode('|', $inputRules);
		foreach ($inputRules as $inputRule) {

			if (!strlen($value) && $inputRule != 'required') {
				break;
			}

			if (preg_match('/\[(.*?)\]/', $inputRule, $match)) {

				$rule = explode('[', $inputRule);
				$rule = $rule[0];
				$param = $match[1];
				if (!method_exists($this, $rule)) {
					throw new Exception("Method {$rule} does not exist");
					exit;
				}

				$call = array($value, $param);
			}
			else {
				if (!method_exists($this, $inputRule)) {
					throw new Exception("Method {$inputRule} does not exist");
					exit;
				}
				$rule = $inputRule;
				$call = array($value);
			}

			$response = call_user_func_array(array($this, $rule), $call);

			if ($response) {
				$error = $this->errorText[$rule];
				$replace = array(
					':name' => $name,
					':param' => (isset($param)) ? $param : NULL
				);
				$response = str_replace(array_keys($replace), array_values($replace), $error);

				$this->_errors[] = $response;
			}

		}

	}

	public function exec()
	{
		return (empty($this->_errors)) ? false : $this->_errors;
	}

	/*
	* Rule functions
	*/

	public function min_length($value, $param)
	{
		if (strlen($value) < $param) {
			return true;
		}
		return false;
	}

	public function max_length($value, $param) 
	{
		if (strlen($value) > $param) {
			return true;
		}
		return false;
	}

	public function email($value) 
	{
		return !filter_var($value, FILTER_VALIDATE_EMAIL);
	}

	public function required($value) 
	{
		if (!strlen($value)) {
			return true;
		}
		return false;
	}

	public function ip($value) 
	{
		return !filter_var($value, FILTER_VALIDATE_IP);
	}

	public function match($value, $param)
	{
		return ($value != $param);
	}

	public function match_exact($value, $param) 
	{
		return ($value !== $param);
	}

	public function match_password($value, $param) 
	{
		return ($value !== $param);
	}

	public function alphanum($value)
	{
		return !ctype_alnum($value);
	}

	public function url($value)
	{
		return !filter_var($value, FILTER_VALIDATE_URL);
	}

	public function numeric($value)
	{
		return !(is_numeric($value));
	}

	public function min($value) 
	{
		if ($value < $param) {
			return true;
		}
		return false;
	}

	public function max($value) {
		if ($value > $param) {
			return true;
		}
		return false;
	}

}