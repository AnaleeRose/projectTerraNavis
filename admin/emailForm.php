<?php
// ----------------------------------------------------------------------------------------------------------->
// ----------------------------------------------------------------------------------------------------->
// ---------------------------------------------------------------------------------->
// NOTE!!!!!!
// this page is SUPER INCOMPLETE, mostly just testing if I caould send emails to external mail systems on my server...
// ---------------------------------------------------------------------------------->
// ----------------------------------------------------------------------------------------------------------->
// ----------------------------------------------------------------------------------------------------------->


// ob_start tells it not to show anything until everything is done loading so I can interrupt it at any time to load an error page without php getting mad about content already on display
ob_start();

// starts a session lol, aka it tracks information even when you go to a different page within the site
session_start();

 // config sets up a number of vital defnitions and a few functions too
require './../html/assets/includes/config.inc.php';

// toss user back to login page if they're not logged in
check_if_admin();

// connects ya to the db
require MYSQL;

// makes it easy to create forms
require './../html/assets/includes/form_functions.inc.php';

// basic functions used throughout the site
require './../html/assets/includes/functions.php';



// tracks errors
$emailForm_errors = [];
$options = ['required' => null];

// for testing puposes, this information is currently hardcoded and sent to me
$mail_to_send_to = "analeeskinner@gmail.com";
$from_email = "contact@savannahskinner.com";
$sendflag = false;

// if there's content to send, give the go ahead to send the email!
if (!empty($_POST['email']) && !empty($_POST['msg'])) {
    $sendflag = true;
} else {
    $emailForm_errors['empty'] = 'empty';
}
if ($sendflag) {
    // create the email and send that bad boi
    $email = $_POST['email'] ;
    $message = $_POST['msg'] ;
    $headers = "From: $from_email" . "\r\n" . "Reply-To: $email" . "\r\n" ;
    $a = mail( $mail_to_send_to, "Message from a contact form", $message, $headers );
    if ($a)
    {
         print("Message was sent, you can send another one");
    } else {
         print("Message wasn't sent, please check that you have changed emails in the bottom");
    }
}
?>
<form method="post" class="genralForm">
<?php

create_form_input('email', 'email', 'Your Email: ', $emailForm_errors, $options);
create_form_input('msg', 'textarea', 'Message: ', $emailForm_errors, $options);

?>
<input type="submit" name="sendEmailBtn" id="sendEmailBtn" class="adminBtn adminBtn_accent sendEmailBtn" value="Send Email">
</form>

