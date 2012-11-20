<?php

require_once dirname(__FILE__).'/validate/rules.php';
require_once dirname(__FILE__).'/validate/errors.php';

Class Validate {

	private $valErrors = array();

	public function rule($value, $name, $rules, $static = FALSE)
	{
		$rules = explode('|', $rules);

		$response = FALSE;

		foreach ($rules as $rule) {

			if (!strlen($value) && $rule != 'required') {
				break;
			}

			if (preg_match('/\[(.*?)\]/', $rule, $match)) {

				$rule = explode('[', $rule);
				$rule = $rule[0];
				$param = $match[1];
				$call = array($value, $param);
			}
			else {
				$call = array($value);
			}

			$validate = new Rules;
			if (!method_exists($validate, $rule)) {
				throw new Exception("Method {$rule} not found");
			}
			
			$response = call_user_func_array(array($validate, $rule), $call);	

			if (!$response && !$static) {
				$this->valErrors[] = array('rule' => $rule, 'name' => $name, 'param' => (isset($param)) ? $param : null);
			}
			
		}

		return $response;
	}

	public function errors($errorFile = 'validate/errors.english.php')
	{

		$errorFile = dirname(__FILE__)."/{$errorFile}";

		if (empty($this->valErrors)) {
			return false;
		}

		$errors = new Errors($errorFile);

		return $errors->error($this->valErrors);

	}

}