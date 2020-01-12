<?php

// grabs the url
$url = $_SERVER['SERVER_NAME'];

// if it doesn't have com somewhere, we're probably offline so it sets the LIVE variable to false.
if (strpos($url,'com') === false) {
    $online = false;
    if (!defined('LIVE')) define('LIVE', false);
} else {
    // if it has com somewhere, we're probably online so it sets the LIVE variable to true.
    $online = true;
    if (!defined('LIVE')) define('LIVE', true);
}

// base url depending on whether we're online or not
if ($online) {
    define('BASE_URI', '/home/analeerose/bpa-development.savannahskinner.com/');
    define('BASE_URL', 'http://bpa-development.savannahskinner.com/');
} else {

    // define('BASE_URI', '/Applications/XAMPP/xamppfiles/htdocs/projectTerraNavis/');
    // define('BASE_URL', 'http://localhost/projectTerraNavis/');
    define('BASE_URI', 'C:/xampp/htdocs/projectTerraNavis/');
    define('BASE_URL', 'http://localhost:81/BPA/');
}


// where to find mysql.php
if ($online) {
    define('MYSQL', $_SERVER['DOCUMENT_ROOT'] . '/mysql.inc.php');
} else {
    define('MYSQL', BASE_URI . 'mysql.inc.php');
}


// error handler, prints out a message with as much info as possible but only if we're offline.
function error_handler($e_number, $e_message, $e_file, $e_line, $e_vars) {
    $message = "An error occured in script '$e_file' on line '$e_line:\n$e_message\n";
    $message .= "<pre>" . print_r(debug_backtrace(), 1) . "</pre>\n";
    if (!LIVE) {
        echo '<div class="alert alert-danger">' . nl2br($message) . '</div>';
    } else {
        error_log($message, 1, 'savannah@savannahskinner.com', 'From: bpa_development');
        // include_once './assets/includes/error.html';
    } //END of $live IF-ELSE
    return true;

} // END my_error_handler definition

// so php knows to use this error handler and not the built in version
set_error_handler('error_handler');


// funciton that creates a notice, just to make it easier later on
function notice($level, $msg) {
    if ($level === 'error') {
        echo '<p class="formNotice formNotice_Error">' . $msg . '</p>';

    } elseif ($level === 'required') {
        echo '<small class="formNotice formNotice_Required">' . $msg . '</small>';
    }
}

// might delete these, i think i found a different way of doing the same thing and forgot I didn't need these anymore...
define('DEFAULT_PAGE_BEGIN', '<div class="defaultDiv lmode">');

define('DEFAULT_PAGE_END', '
    </div>');

// Just to throw up the lil required tag underneath inputs as quickly as possible while also making it easy to change them at will
define('REQUIRED', '<small class="formNotice formNotice_Required">Required</small>');

// class to creat muted text
$mutedText = ' class="text-muted d-block mt-n2 mb-3" style="font-size:.9rem"';


// checks if the person is an admin by checking if the session includes uid and email
function check_if_admin() {
    if (!isset($_SESSION['uid']) || !isset($_SESSION['email'])) {
        if ($online) {
            header('Location: http://bpa-development.savannahskinner.com/admin/');
        } else {
            header('Location: ' . BASE_URL . 'admin/');
        }
    }
}

define('EMAIL_LINK', 'terranavisliving@gmail.com');
define('TWITTER_LINK', 'https://twitter.com/wddatft');
define('FACEBOOK_LINK', 'https://www.facebook.com/wddatft');
define('PININTEREST_LINK', 'idk_what_a_pininterest_link_looks_like');
define('INSTAGRAM_LINK', 'https://www.instagram.com/webatft/?hl=en');
define('IMG_PATH', './assets/imgs/article_imgs/');
define('IMG_PATH_HTML', '../admin/assets/imgs/article_imgs/');
define('BACK_BTN', '<a href="javascript:history.go(-1)" title="Back" class="backBtn"><span class="backArrow">➔</span></a>');

