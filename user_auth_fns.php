<?php

//Function checks if the username and password are valid. Returns true if valid, false otherwise.
function login ($userName2, $password2)
{
	$userName= mysql_real_escape_string($userName2);
	$password= mysql_real_escape_string($userName2);
	$result = mysql_query("SELECT email, password FROM users WHERE email = '$userName' AND password = '$password'");
	if (mysql_num_rows($result) > 0)
		return true;
	else
		return false;
}

//Function checks if the user is valid. Returns true if valid, false otherwise.
function validUser()
{
	if (isset($_SESSION['validUser']))
		return true;
	else 
		return false;
}

?>