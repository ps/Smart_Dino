<?php
require ('/twilio/Services/Twilio.php');
require('/var/www/hackny/db.php');

$data = mysql_query("SELECT * FROM users");
while($row = mysql_fetch_array($data))
{
	/* connect to gmail */
	$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
	$username = 'paweltestemail@gmail.com';
	$password = 'herpderp123';

	/* try to connect */
	$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

	/* grab emails */
	/*$result = imap_search($connection, 'UNSEEN FROM "me@example.com"');*/
	$emails = imap_search($inbox,'UNSEEN');

	/* if emails are returned, cycle through each... */
	if($emails) {
		
		/* begin output var */
		$output = '\n';
		
		/* put the newest emails on top */
		rsort($emails);
		
		/* for every email... */
		foreach($emails as $email_number) {
			
			/* get information specific to this email */
			$overview = imap_fetch_overview($inbox,$email_number,0);
			$message = imap_fetchbody($inbox,$email_number,2);
			
			/* output the email header information */
			print_r($overview);
			echo "\n";
			print_r($message);

			$c1=strtolower("hell week");
			$c2=strtolower($overview[0]->subject);
			if (strpos($c2,$c1) !== false) 
			{
	    		echo 'ITS HERE';
			}
			
			$output.= 'SEEN:'.($overview[0]->seen ? 'read' : 'unread').'';
			$output.= 'SUBJECT:'.$overview[0]->subject.'\n';
			$output.= 'FROM:'.$overview[0]->from.'\n';
			$output.= 'DATE:'.$overview[0]->date.'\n';
			

			
			/* output the email body */
			$output.= 'MESSAGE:'.$message.'\n';
		}
		
		$my_file ='/var/www/hackny/file.txt';
		$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
		fwrite($handle, $output);

	} 

	/* close the connection */
	imap_close($inbox);
}

?>