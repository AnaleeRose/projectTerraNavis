<?php
ob_start();
session_start();

require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
require MYSQL;


$pageTitle = 'All Emails';
$list_all = true;
$no_articles = true;
require './assets/includes/header.html';
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php'; // basic functions used throughout the site
$login_errors = [];
if (!isset($_SESSION['uid']) || !isset($_SESSION['email'])) {
header('Location: index.php');
} else {
?>
<?php
    require './assets/includes/adminMenu.php';
    nd('adminMC_Wrapper allPage', 'noID');
        nd('adminMainContent', 'mainContent');
        include './assets/views/newsfeedContent_active.php';
        ed();
    ed(); ?>

<?php
include './assets/includes/adminPage_end.php';
include './assets/includes/footer.html';
}

