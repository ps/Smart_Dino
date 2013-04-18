<?php
require('/var/www/hackny/twilio/Services/Twilio.php');
$sid = "ACe3fdbbe6b72ca34016c330e12803665b"; // Your Account SID from www.twilio.com/user/account
$token = "5abe0915694f8571e91e729546d829d5"; // Your Auth Token from www.twilio.com/user/account

$client = new Services_Twilio($sid, $token);
require('/var/www/hackny/db.php');

$data = mysql_query("SELECT * FROM users WHERE check_mail='1'");
while($row = mysql_fetch_array($data))
{
	/* connect to gmail */
	$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
	$username = $row['email'];
	$password = $row['password'];
	$phoneNumba = $row['phone_num'];
	$userid = $row['id'];

	/* try to connect */
	$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

	/* grab emails */
	/*$result = imap_search($connection, 'UNSEEN FROM "me@example.com"');*/
	$emails = imap_search($inbox,'UNSEEN');

	/* if emails are returned, cycle through each... */
	if($emails) {
		
		/* begin output var */
		$output = ' ';
		
		/* put the newest emails on top */
		rsort($emails);
		
		/* for every email... */
		foreach($emails as $email_number) {
			$data2 = mysql_query("SELECT * FROM filters WHERE user_id='$userid'");
			while($row2 = mysql_fetch_array($data2))
			{
				/* get information specific to this email */
				$overview = imap_fetch_overview($inbox,$email_number,0);
				$message = imap_fetchbody($inbox,$email_number,2);

				$pos1 = strrpos($overview[0]->from, "<");
				$pos2 = strrpos($overview[0]->from, ">");
				$emailDudeStuff = substr($overview[0]->from, $pos1+1, $pos2-$pos1-1 );

				$senderLength = strlen($emailDudeStuff);
				$textBody = substr(strip_tags($message), 0, ( (160-13) - $senderLength) );
				$textThis = "Email from ".($emailDudeStuff).": ".$textBody;

				if($row2['filter_type']=="sender")
				{
					$c1=strtolower($row2['filter_text']);
					$c2=strtolower($overview[0]->from);
					if (strpos($c2,$c1) !== false) 
					{

						$messageToText = $client->account->sms_messages->create(
						  '2153374778', // From a valid Twilio number
						  $phoneNumba, // Text this number
						  $textThis
						);
						$messageToText->sid;
						break;
					}
				}
				if($row2['filter_type']=="subject")
				{
					$c1=strtolower($row2['filter_text']);
					$c2=strtolower($overview[0]->subject);
					if (strpos($c2,$c1) !== false) 
					{
			    		$messageToText = $client->account->sms_messages->create(
						  '2153374778', // From a valid Twilio number
						  $phoneNumba, // Text this number
						  $textThis
						);
						$messageToText->sid;
						break;
					}
				}
				if($row2['filter_type']=="message")
				{
					$c1=strtolower($row2['filter_text']);
					$c2=strtolower($message);
					if (strpos($c2,$c1) !== false) 
					{
			    		$messageToText = $client->account->sms_messages->create(
						  '2153374778', // From a valid Twilio number
						  $phoneNumba, // Text this number
						  $textThis
						);
						$messageToText->sid;;
						break;
					}

				}
				if($row2['filter_type']=="all")
				{
					$c1=strtolower($row2['filter_text']);
					$c2=strtolower($overview[0]->from);
					$c3=strtolower($overview[0]->subject);
					$c4=strtolower($message);
					if (strpos($c2,$c1) !== false || strpos($c3,$c1) !== false || strpos($c4,$c1) !== false) 
					{
			    		$messageToText = $client->account->sms_messages->create(
						  '2153374778', // From a valid Twilio number
						  $phoneNumba, // Text this number
						  $textThis
						);
						$messageToText->sid;
						break;
					}
				}
				
				
				
				
				$output.= 'SEEN:'.($overview[0]->seen ? 'read' : 'unread').'';
				$output.= 'SUBJECT:'.$overview[0]->subject.'\n';
				$output.= 'FROM:'.$overview[0]->from.'\n';
				$output.= 'DATE:'.$overview[0]->date.'\n';
			}

			
			/* output the email body */
			$output.= 'MESSAGE:'.$message.'\n';
		}
		

	} 

	/* close the connection */
	imap_close($inbox);
}

?>