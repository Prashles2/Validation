# Read Me 

This is your basic, every day validation class.

# Usage

Instantiate the class. The rule() method takes three required parameters; the value, the name (for error outputting) and the rules, respectively. It will also take an optional fourth parameter; set this to true if you want to validate an input statically.  

Each call to the rule() method will return true/false for a successful or failed validation, respectively. 
Use the errors() method to get the errors for all the inputs. The method will return an array of error.

The errors() method takes a parameter for your file with the errors in. By default, it's the english file that comes with the class.

If a field is empty, it will NOT be validated unless the *required* validation rule is set.

You'll find sample usage in the validate.php file.



# Validation Rules

__required__ - Value cannot be empty  
__min_length[x]__ - Minimum length should be x or greater  
__max_length[x]__ - Maximum length should be x or less  
__ip__ - Valid IP address  
__match[x]__ - Value should match x  
__match_exact[x]__ - Value should match x exactly  
__match_password[x]__ - Same as the above, but doesn't show x- good for password confirmation fields  
__alphanum__ - String should be alphanumeric  
__numeric__ - Value should be numeric  
__min[x]__ - Value (number) should be at least x  
__max[x]__ - Value (number) should not be greater than x  
__url__ - Value should be a valid URL  

# Extras

You can change the error messages in 'classes/validate/errors.english.php'. Pretty self-explanatory. You can also make your own file, just follow the format.

# To-do


Add error handling for validation rules that have parameters  
Add more validation rules