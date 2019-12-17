<?php
DEFINE('DB_HOST', 'localhost');

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

// connect to the db using mysqli, best for short not ultra important tasks
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// connect to the db using pdo, best for longer or user generated content
$dbpdo = new PDO("mysql:host=localhost;dbname=analeerose_bpa", DB_USER, DB_PASSWORD);

// escapes a string
function escape_data($data, $dbc) {
    if (get_magic_quotes_gpc()) $data = stripslashes($data);
    return mysqli_real_escape_string ($dbc, trim ($data));
}
