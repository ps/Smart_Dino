<?php

/*
This page turns on/off the email check for the current user.
 */

session_start();
require('include/db.php');

/*Check if user logged it*/
if (!isset($_SESSION['validUser']))
{
    echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=login.php\">";
    exit();
}

$user = $_SESSION['validUser'];

$data = mysqli_query($con, "SELECT * FROM users WHERE email='$user'");
$row = mysqli_fetch_array($data);
if($row['check_mail']==1)
{
	mysqli_query($con, "UPDATE users SET check_mail='0' WHERE email='$user'");
}
else if($row['check_mail']==0)
{
	mysqli_query($con, "UPDATE users SET check_mail='1' WHERE email='$user'");

}
echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=back.php\">";
?>