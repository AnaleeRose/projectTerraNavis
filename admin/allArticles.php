<?php
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
require './../html/assets/includes/functions.inc.php';




$pageTitle = 'All Articles';
require './assets/includes/header.html';

// loads the page in lmode or dmode depending on their settings
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';

// removes the limit on the amount of articles/emails called so we can get a bigger list
$list_all = true;

// we only want articles so...
$no_emails = true;


// start creating the page...
    require './assets/includes/adminMenu.inc.php';
    nd('adminMC_Wrapper allPage', 'noID');
        echo BACK_BTN;
        nd('adminMainContent', 'mainContent');

            // newsfeedContent_active.php shows the most recent articles and emails
            include './assets/views/newsfeedContent_active.inc.php';

        ed();
    ed();

include './assets/includes/adminPage_end.inc.php';
include './assets/includes/footer.html';

