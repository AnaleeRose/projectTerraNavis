<?php
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
if (!isset($_SESSION['username'])) {
    $url = BASE_URL . 'admin/';
    header("Location: $url");
    exit();
}
$_SESSION = [];
session_destroy();
// setcookie(session_name(), '', time()-3000);


$pageTitle = 'Logout';
require './assets/includes/header.html';
echo '<body id="pageWrapper" class="lmode defaultPage">';
echo DEFAULT_PAGE_BEGIN;
?>
    <h1>Logged Out</h1>
    <p>You are now logged out. You can <a href="./index.php">login again</a> or visit
    <a href="#">Terra Nova</a>.</p>
<?php
echo DEFAULT_PAGE_END;
require './assets/includes/footer.html';
?>
