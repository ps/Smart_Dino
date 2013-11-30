<?php
/*
This page adds an email filter for the current user.
 */
session_start();
require('include/db.php');

/*Check if user logged it*/
if (!isset($_SESSION['validUser']))
{
    echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=login.php\">";
    exit();
}

$filterType = mysqli_real_escape_string($con, $_POST['filter']);
$word = mysqli_real_escape_string($con, $_POST['filter_word']);
$userID = mysqli_real_escape_string($con, $_POST['user_id']);

mysqli_query($con, "INSERT INTO filters VALUES (NULL, '$userID', '$filterType', '$word')") or die("Query failed: ".mysqli_error($con));
echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=back.php\">";
?>