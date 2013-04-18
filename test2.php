<?php

	$my_file ='/var/www/hackny/file2.txt';
	$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
	$time = "\n".time();
	fwrite($handle, $time);

	

?>