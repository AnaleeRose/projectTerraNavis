<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
require MYSQL; // connect to db
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php'; // various functions

$emailForm_errors = [];
$options = ['required' => null];

// $mail_to_send_to = "name@anydomain.tld" identifies the email address the message will be sent to. It can be any email address, including third-party services like Gmail, Yahoo, etc.
// $from_email = "from@yourdomain.tld" identifies the email address the message will be sent from. It should be a local email address (created in cPanel)
// Reply-To: $email" is the email address of the site visitor, assuming they specify one in the "Your email" field of the contact form. This email is then assigned as the "Reply To" address.


$mail_to_send_to = "analeeskinner@gmail.com";
$from_email = "contact@savannahskinner.com";
$sendflag = false;
if (!empty($_POST['email']) && !empty($_POST['msg'])) {
    echo 'not empty';
    $sendflag = true;
} else {
    echo 'empty';
}
if ($sendflag) {
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

