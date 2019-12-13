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
create_form_input('email', 'email', 'Your Email: ', $emailForm_errors, $options);
create_form_input('msg', 'textarea', 'Message: ', $emailForm_errors, $options);

?>
