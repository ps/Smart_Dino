<?php
//setting up database connection

$con = mysqli_connect("localhost", "<db user>","<db password>") or die("Could not connect: ".mysql_error());
mysqli_select_db($con, "<database>") or die("Could not select db: ".mysql_error());

?>
