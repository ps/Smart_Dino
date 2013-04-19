<?php
require('/var/www/hackny/db.php');

$filterType = mysql_real_escape_string($_POST['filter']);
$word = mysql_real_escape_string($_POST['filter_word']);
$userID = mysql_real_escape_string($_POST['user_id']);

mysql_query("INSERT INTO filters VALUES (NULL, '$userID', '$filterType', '$word')");
echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=back.php\">";
?>