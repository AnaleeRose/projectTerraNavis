<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
require MYSQL; // connect to db
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php'; // various functions

$pageTitle = 'Edit profile Info';
if (!isset($_GET['edit_type'])) {
    ob_end_clean();
    require './assets/includes/header.html';
    require './assets/includes/error.php';
    $links = ['Return To Home' => 'index.php'];
    produce_error_page('Hmm, something is wrong with that link. Please contact our service team to resolve the issue.', $links);
    require './assets/includes/footer.html';
    exit();
} else {
	$edit_type = $_GET['edit_type'];
}

// page content start
require './assets/includes/header.html';
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';
echo '<p id="serverLightMode" class="hidden">' . $_SESSION['light_mode'] . '</p>';
    require './assets/includes/adminMenu.php';
    require './assets/includes/newsfeed_active.php';
    nd('adminMC_Wrapper', 'noDI');
        nd('adminMainContent', 'mainContent');
if ($edit_type === 'general') {


} elseif ($edit_type === 'changep') {

}

include './assets/includes/adminPage_end.php';
include './assets/includes/footer.html';
