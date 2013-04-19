<?php
require('/var/www/hackny/twilio/Services/Twilio.php');

$sid = "ACe3fdbbe6b72ca34016c330e12803665b"; // Your Account SID from www.twilio.com/user/account
$token = "5abe0915694f8571e91e729546d829d5"; // Your Auth Token from www.twilio.com/user/account

$client = new Services_Twilio($sid, $token);
$message = $client->account->sms_messages->create(
  '2153374778', // From a valid Twilio number
  'some number here', // Text this number
  "Hello monkey2!"
);

//print $message->sid;
$message->sid;

echo "SHOULD BE DONE!";
?>