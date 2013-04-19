<?php
require('/var/www/hackny/db.php');
$email = mysql_real_escape_string($_POST['username']);
$pass = mysql_real_escape_string($_POST['password']);
$num = mysql_real_escape_string($_POST['phone']);

mysql_query("INSERT INTO users VALUES (NULL,'$email', '$pass', '$num', '1')");
echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=login.php\">";

?>