<?php

//Function checks if the username and password are valid. Returns true if valid, false otherwise.
function login ($userName2, $password2, $con)
{
	$userName= mysqli_real_escape_string($con, $userName2);
	$password= mysqli_real_escape_string($con, $password2);
	$result = mysqli_query($con, "SELECT email, password FROM users WHERE email = '$userName' AND password = '$password'");
	if (mysqli_num_rows($result) > 0)
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