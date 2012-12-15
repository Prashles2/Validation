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


/*
* Require the rules and errors classes
*/

require_once dirname(__FILE__).'/validate/rules.php';
require_once dirname(__FILE__).'/validate/errors.php';

Class Validate {

	/*
	* array $valErrors
	*
	* Where all the validation errors are stored
	*/
	
	private $valErrors = array();
	
	/*
	* Add a new rule to the validation
	* If $static is set to TRUE, the rule will return a successful/failed validation
	* However there will be no error message if the validation fails
	*/

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
	
	/*
	* Same as rule() method but the rules are passed as array
	* in the format $rule => $param
	*
	* Separate from rule() so it can be used separately for different validation fields 
	* to switch between rule() and ruleA()
	*/
	
	public function ruleA($value, $name, $rules = array(), $static = FALSE)
	{

		$response = FALSE;
				
		foreach ($rules as $rule => $param) {
		
			$rule = (is_int($rule)) ? $param : $rule;

			if (!strlen($value) && $rule != 'required') {
				break;
			}
			
			$call = (!strlen($param)) ? array($value) : array($value, $param);

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
	
	/*
	* Returns the errors for all failed validations
	*
	* $errorFile is returns an array of error messages
	*/

	public function errors($errorFile = 'validate/errors.english.php')
	{

		$errorFile = dirname(__FILE__)."/{$errorFile}";

		if (empty($this->valErrors)) {
			return false;
		}

		$errors = new Errors($errorFile);

		return $errors->error($this->valErrors);

	}
	
	/*
	* This method will reset the validation
	* so you don't need to instantiate the class again
	*/
	
	public function reset()
	{
		$this->valErrors = array();
	} 

}