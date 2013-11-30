<?php
require('include/db.php');
$email = mysqli_real_escape_string($con, $_POST['username']);
$pass = mysqli_real_escape_string($con, $_POST['password']);
$num = mysqli_real_escape_string($con, $_POST['phone']);

mysqli_query($con, "INSERT INTO users VALUES (NULL,'$email', '$pass', '$num', '1')");
echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=login.php\">";
?>