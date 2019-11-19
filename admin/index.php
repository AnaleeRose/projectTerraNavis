<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
require MYSQL;
require './assets/includes/header.html';
if (isset($_SESSION['light_mode'])) {
    echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';
} else {
    echo '<body id="pageWrapper" class="lmode defaultPage">';
}
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php'; // basic functions used throughout the site
$login_errors = [];
if (isset($_SESSION['uid']) && isset($_SESSION['email'])) { // if they're already logged in
    check_if_admin();
    require './assets/includes/adminHome.php';
} else { // if they're not logged in
    require './assets/includes/login_form.inc.php';
    require './assets/includes/login.php';
}
?>




<?php
require './assets/includes/footer.html';
ob_end_flush();
?>
