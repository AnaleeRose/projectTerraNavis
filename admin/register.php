<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
require MYSQL;
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php'; // basic functions used throughout the site
// pull all current profile choices


$pageTitle = 'Register';
require './assets/includes/header.html';
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';

    define('COLS', 5);
    $pos = 0;
    $firstRow = true;
    $q = 'SELECT * FROM profilepictures';
    $getPictures = mysqli_query($dbc, $q);
    if (!$getPictures) {
        $register_errors['profilepictures'] = 'Could not retrieve profile images, defaulting to base image';
    }
$register_errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') { //if they clicked the log in btn
    // track all the errors in this array
    // check the email
    if (!empty($_POST['username'])) { //check if empty email address
        if (PREG_MATCH('/^[A-Z 0-9\'.-]{2,45}$/i', $_POST['username'])) { //check if valid email address
            $u = escape_data($_POST['username'], $dbc);
        } else {
            $register_errors['username'] = "Please enter a valid username";
        }
    } else {
        $register_errors['email'] = "Please enter a username";
    }

    if (!empty($_POST['email'])) { //check if empty email address
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { //check if valid email address
            $e = escape_data($_POST['email'], $dbc);
        } else {
            $register_errors['email'] = "Please enter a valid email address";
        }
    } else {
        $register_errors['email'] = "Please enter an email address";
    }

    $match = '/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])^\w*)\w{6,}$/';

    if (!empty($_POST['pwd'])) {
        if (preg_match($match, $_POST['pwd']) ) {
            if ($_POST['pwd'] === $_POST['pwdC']) {
                $p = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
            } else {
                $register_errors['pwdC'] = 'Passwords do not match.';
            }
        } else {
            $register_errors['pwd'] = 'Password does not meet requirements';
        }
    } else {
        $register_errors['pwd'] = "Please enter a password";
    }

    if (empty($_POST['profilePicChoice'])) {
        $pc = 1;
    } else {
       $pc = (int)$_POST['profilePicChoice'];
    }


    if (empty($register_errors)) { //if no errors send to db
        $q = "SELECT admin_email, admin_username FROM adminuser where admin_email='$e' OR admin_username='$u'";
        $r = mysqli_query($dbc, $q);
        $rows = mysqli_num_rows($r);
        if ($rows === 0) {
            $q  = "INSERT INTO adminuser (admin_id,admin_username, admin_email, profilePic_id) VALUES (null, '$u', '$e', $pc)";
            $r = mysqli_query($dbc, $q);
            if (mysqli_affected_rows($dbc) === 1) {
                $last_id = mysqli_insert_id($dbc);
                $q = "INSERT INTO `info` (`pwd_id`, `admin_id`, `info`) VALUES (NULL, $last_id, '$p')";
                $r = mysqli_query($dbc, $q);
                if ($r) {
                    include './assets/includes/registered.php';
                    exit();
                } else {
                    include './assets/includes/error.html';
                }
            }
        } else {
            if ($rows === 2) {
                $register_errors['email'] = 'This email address has already been registered. If you have forgotten your password, please <a href="reset_password.php">Reset Your Password</a>.';
                $register_errors['username'] = 'This username has already been registered. Please try another.';
            } else {
                $row = mysqli_fetch_array($r, MYSQLI_NUM);
                if (($row[0] === $_POST['email']) && ($row[1] === $_POST['username'])) {
                    $register_errors['email'] = 'This email address has already been registered. If you have forgotten your password, please <a href="reset_password.php">Reset Your Password</a>.';
                    $register_errors['username'] = 'This username has already been registered with this email address. If you have forgotten your password, please <a href="reset_password.php">Reset Your Password</a>.';
                } elseif ($row[0] === $_POST['email']) {
                    $register_errors['email'] = 'This email address has already been registered. If you have forgotten your password, please <a href="reset_password.php">Reset Your Password</a>.';
                } elseif ($row[1] === $_POST['username']) {
                    $register_errors['username'] = 'This username has already been registered. Please try another.';
                }
            }
        }

        // $q = "SELECT admin_id FROM adminuser WHERE admin_email = '$e'";
        // $r = mysqli_query($dbc, $q);
        // if ($r) {
        //     $select = "SELECT a.admin_id AS uid, a.username, a.admin_email, a.profilePic_id, p.pic_Location FROM `info` i JOIN adminuser a ON a.admin_id = i.admin_id JOIN profilepictures p ON p.profilePic_id = a.profilePic_id WHERE i.info = '$p'";
        //     echo $select;
        //     $r2 = mysqli_query($dbc, $select);
        //     if (mysqli_num_rows($r2) === 1) {
        //         while ($row = mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
        //             echo $row['uid'];
        //         }
        //     } else {
        //         $register_errors['DoesNotExist'] = 'We have no record of that email/password combination...';
        //     }
        // } else {
        //     echo "eerror";
        //     include './assets/includes/error.html';
        //     exit();
        // }
    }
}
require_once './assets/includes/register_form.php';
?>




<?php
require './assets/includes/footer.html';
ob_end_flush();
?>


