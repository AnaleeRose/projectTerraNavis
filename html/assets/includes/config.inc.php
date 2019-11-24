<?php
$url = $_SERVER['SERVER_NAME'];
if (strpos($url,'com') === false) {
    $online = false;
    if (!defined('LIVE')) define('LIVE', false);
} else {
    $online = true;
    if (!defined('LIVE')) define('LIVE', true);
}

if ($online) {
    define('BASE_URI', '/home/analeerose/bpa-development.savannahskinner.com/');
    define('BASE_URL', 'http://bpa-development.savannahskinner.com/');
} else {
    define('BASE_URI', '/Applications/XAMPP/xamppfiles/htdocs/BPA/');
    define('BASE_URL', 'http://localhost:81/BPA/');
    // define('BASE_URL', 'http://localhost/BPA/');
}

define('PDFS_DIR', BASE_URI . 'pdfs/');
if ($online) {
    define('MYSQL', $_SERVER['DOCUMENT_ROOT'] . '/mysql.inc.php');
} else {
    define('MYSQL', $_SERVER['DOCUMENT_ROOT'] . '/bpa/mysql.inc.php');
}

function error_handler($e_number, $e_message, $e_file, $e_line, $e_vars) {
    $message = "An error occured in script '$e_file' on line '$e_line:\n$e_message\n";
    $message .= "<pre>" .print_r(debug_backtrace(), 1) . "</pre>\n";
    if (!LIVE) {
        echo '<div class="alert alert-danger">' . nl2br($message) . '</div>';
    } else {
        error_log($message, 1, 'savannah@savannahskinner.com', 'From: bpa_development');
        // include_once './assets/includes/error.html';
    } //END of $live IF-ELSE
    return true;

} // END my_error_handler definition

set_error_handler('error_handler');


function notice($level, $msg) {
    if ($level === 'error') {
        echo '<p class="formNotice formNotice_Error">' . $msg . '</p>';

    } elseif ($level === 'required') {
        echo '<small class="formNotice formNotice_Required">' . $msg . '</small>';
    }
}

define('DEFAULT_PAGE_BEGIN', '<div class="defaultDiv lmode">');

define('DEFAULT_PAGE_END', '
    </div>');

define('REQUIRED', '<small class="formNotice formNotice_Required">Required</small>');

$mutedText = ' class="text-muted d-block mt-n2 mb-3" style="font-size:.9rem"';

function check_if_admin() {
    if (!isset($_SESSION['uid']) || !isset($_SESSION['email'])) {
        if ($online) {
            header('Location: http://bpa-development.savannahskinner.com/admin/');
        } else {
            header('Location: ' . BASE_URL . 'admin/');
        }
    }
}
