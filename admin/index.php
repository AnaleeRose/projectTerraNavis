<?php
// ob_start tells it not to show anything until everything is done loading so I can interrupt it at any time to load an error page without php getting mad about content already on display
ob_start();

// starts a session, aka it tracks information even when you go to a different page within the site
session_start();

 // config sets up a number of vital defnitions and a few functions too
require './../html/assets/includes/config.inc.php';

// connects to the db
require MYSQL;

// makes it easy to create certain common ino=put types
require './../html/assets/includes/form_functions.inc.php';

// a few useful functions used through the site
require './../html/assets/includes/functions.inc.php';



require './assets/includes/header.html';

// checks if the user is in light mode or dark mode and loads the page accordingly
if (isset($_SESSION['light_mode'])) {
    echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';
} else {
    echo '<body id="pageWrapper" class="lmode defaultPage loginPage">';
}

// tracks errors while logging in
$login_errors = [];


if (isset($_SESSION['uid']) && isset($_SESSION['email'])) {
    // if they're already logged in, show them the homepage
    require './assets/includes/adminHome.inc.php';
} else {
    // if they're not logged in, show them the login page
    require './assets/includes/login_form.inc.php';
    require './assets/includes/login.inc.php';
}
?>




<?php
// grabs the footer
require './assets/includes/footer.html';

// ob flush prints out everything saved by ob_start
ob_end_flush();
?>
