<?php
session_start();

 // config sets up a number of vital defnitions and a few functions too
require './../html/assets/includes/config.inc.php';

// toss user back to login page if they're not logged in
check_if_admin();

// empty the session array
$_SESSION = [];

// destroy this session
session_destroy();

// idk what this is for lol, I just remember seeing it once and going '...do i need that?'
// setcookie(session_name(), '', time()-3000);


$pageTitle = 'Logout';
require './assets/includes/header.html';
echo '<body id="pageWrapper" class="lmode defaultPage">';
echo DEFAULT_PAGE_BEGIN;
?>
    <h1>Logged Out</h1>
    <p>You are now logged out. You can <a href="./index.php">login again</a> or visit
    <a href="../html/">Terra Nova</a>.</p>
<?php
echo DEFAULT_PAGE_END;
require './assets/includes/footer.html';
?>
