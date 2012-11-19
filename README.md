### Read Me 

This is your basic, every day validation class.

### Usage

Instansiate the class. The rule() method takes three parameters; the value, the name (for error outputting) and the rules, respectively.
When you use the exec() mathod, it will return __FALSE__ if validated correctly. If not, it will return an array of the errors.

If a field is empty, it will NOT be validated unless the *required* validation rule is set.

You'll find sample usage in the validate.php file.

	require_once 'classes/validate.php';

	$val = new Validate;

	$email     = 'invalid@email';
	$url       = 'invalidUrlHere';
	$ip        = '123123123';
	$firstName = ''; 
	$lastName  = '';

	$val->rule($email, 'Email', 'required|email');
	$val->rule($url, 'URL', 'required|url');
	$val->rule($ip, 'IP Address', 'required|ip');
	$val->rule($firstName, 'First name', 'required');
	$val->rule($lastName, 'Last name', 'min_length[4]');

	$exec = $val->exec();

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

### Validation Rules

__required__ - Value cannot be empty  
__min_length[x]__ - Minimum length should be x or greater  
__max_length[x]__ - Maximum length should be x or less  


### To-do

Add error handling for validation rules that have parameters