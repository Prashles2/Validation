<?php

Class Rules {

	public function min_length($value, $param)
	{
		return !(strlen($value) < $param);
	}

	public function max_length($value, $param) 
	{
		return !(strlen($value) > $param);
	}

	public function email($value) 
	{
		return (filter_var($value, FILTER_VALIDATE_EMAIL));
	}

	public function required($value) 
	{
		return (strlen($value) !== 0);
	}

	public function ip($value) 
	{
		return (filter_var($value, FILTER_VALIDATE_IP));
	}

	public function match($value, $param)
	{
		return ($value == $param);
	}

	public function match_exact($value, $param) 
	{
		return ($value === $param);
	}

	public function match_password($value, $param) 
	{
		return ($value === $param);
	}

	public function alphanum($value)
	{
		return (ctype_alnum($value));
	}

	public function url($value)
	{
		return (filter_var($value, FILTER_VALIDATE_URL));
	}

	public function numeric($value)
	{
		return (is_numeric($value));
	}

	public function min($value) 
	{
		return !($value < $param);
	}

	public function max($value) 
	{
		return !($value > $param);
	}

}