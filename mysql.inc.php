<?php
DEFINE('DB_HOST', 'localhost');
// detects if online or offline and adjusts values accouringly
$url = $_SERVER['SERVER_NAME'];
if (strpos($url,'com') === false) {
    $online = false;
} else {
    $online = true;
}

DEFINE('DB_NAME', 'analeerose_bpa');

if (isset($user) && ($user === 'admin')) {
    if ($online) {
        DEFINE('DB_USER', 'analeerose_admin_bpa');
        DEFINE('DB_PASSWORD', '3.14NCreme');
    } else {
        DEFINE('DB_USER', 'bpa_admin');
        DEFINE('DB_PASSWORD', '3.14NCreme');
    }
} else {
    if ($online) {
        DEFINE('DB_USER', 'analeerose_view_bpa');
        DEFINE('DB_PASSWORD', '3.14NCream');
    } else {
        DEFINE('DB_USER', 'bpa_view');
        DEFINE('DB_PASSWORD', '3.14NCream');
    }
}

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$dbpdo = new PDO("mysql:host=localhost;dbname=analeerose_bpa", DB_USER, DB_PASSWORD);


function escape_data($data, $dbc) {
    if (get_magic_quotes_gpc()) $data = stripslashes($data);
    return mysqli_real_escape_string ($dbc, trim ($data));
}
