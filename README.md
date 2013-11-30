Smart Dino
==========
* Smart Dino is a basic web app that, given Gmail credentials along with phone number, will condense a desired email into 250 characters and 
will text it to the provided phone number via Twilio. 
* The app will only text emails with specified keywords/filters. For instance, it can be specifed to only text emails that contain the keyword 
'Rutgers' in the email body, sender, or title. Other emails will not be sent. 
* The idea behind this app came from the fact that we can't be on email 24/7 yet sometimes we are waiting for an important email. By using Smart Dino
a user will be able to see the content of the email when the important/desired email comes via text message.

###Implementation
* A valid Twilio account is required to run the app.
* Valid Twilio credentials need to be inputed in cronCheck.php where specified.
* A mysql database can be constructed via the smSQLsetup.sql and credentials need to be inputted in the db.php file.

###Limitations
* The app only works with Gmail.
* The password used for registration needs to be identical to the one used when loggin into Gmail.*
* The password stored is not encrypted since it needs to be properly passed to connect to Gmail.*

*Yes this is a vulnerability but this app was meant to be a hackathon hack, not necessairly a fully deployed app to the public

