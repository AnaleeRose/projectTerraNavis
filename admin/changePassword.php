<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
require MYSQL; // connect to db
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php'; // various functions


$pageTitle = 'Change Password';
$relogged_in = $_SESSION['relogged_in'];
$changeP_errors = [];
$changed = false;
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
} elseif (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
}
require './assets/includes/verifyPassword_init.php';

if (isset($_POST['changePwdBtn']) && $relogged_in && !$changed) {
    $match = '/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])^\w*)\w{6,}$/';
    if (!empty($_POST['pwd_new'])) {
        if (preg_match($match, $_POST['pwd_new']) ) {
            if ($_POST['pwd_new'] === $_POST['pwd_conf']) {
                $p = password_hash($_POST['pwd_new'], PASSWORD_DEFAULT);
            } else {
                $changeP_errors['pwd_conf'] = 'Passwords do not match.';
            }
        } else {
            $changeP_errors['pwd_new'] = 'Password does not meet requirements';
        }
    } else {
        $changeP_errors['pwd_new'] = "Please enter a password";
    }

    if (empty($changeP_errors)) {
        $q = "UPDATE `info` SET `info` = '$p' WHERE `admin_id` = " . $uid;
        $r = mysqli_query($dbc, $q);
        if ($r) {
            $changed = "Password was changed!";
        } else {
            echo 'crap';
        }
    }
}

// page content start
require './assets/includes/header.html';
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';
echo '<p id="serverLightMode" class="hidden">' . $_SESSION['light_mode'] . '</p>';
    require './assets/includes/adminMenu.php';
    require './assets/includes/newsfeed_active.php';
    nd('adminMC_Wrapper', 'noDI');
        nd('adminMainContent', 'mainContent');
if ($relogged_in) {
    echo '<h2 class="adminHeading">Change Password</h2>';
    if ($changed != false) {
        ?>
        <h3 class="successHeading"><?= $changed; ?></h3>
        <a href="profile.php" class="adminBtn adminBtn_subtle returnToProfileBtn">Return To Profile</a>
        <?php
    } else {
        echo '<form class="generalForm" method="post">';
            $options = ['required' => null];

            create_form_input('pwd_new', 'password', 'New Password', $changeP_errors, $options);

            create_form_input('pwd_conf', 'password', 'Confirm Password', $changeP_errors, $options);

        echo '<input type="submit" name="changePwdBtn" class="adminBtn adminBtn_danger" value="Change Password">';
        echo '<a href="profile.php" class="adminBtn adminBtn_subtle returnToProfileBtn">Return</a>';

        echo '</form>';
    }

} else { // please relog in
    require './assets/includes/verifyPassword_form.php';
}
include './assets/includes/adminPage_end.php';
include './assets/includes/footer.html';
?>
