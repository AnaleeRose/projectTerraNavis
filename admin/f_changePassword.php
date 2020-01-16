<?php
// ob_start tells it not to show anything until everything is done loading so I can interrupt it at any time to load an error page without php getting mad about content already on display
ob_start();

// starts a session lol, aka it tracks information even when you go to a different page within the site
session_start();

if (isset($_SESSION['va_id'])) {
    $va_id = $_SESSION['va_id'];
} else {
    header("Location: forgotPassword.php");
}

 // config sets up a number of vital defnitions and a few functions too
require './../html/assets/includes/config.inc.php';

// connects ya to the db
require MYSQL;

// makes it easy to create forms
require './../html/assets/includes/form_functions.inc.php';

// basic functions used throughout the site
require './../html/assets/includes/functions.inc.php';




$pageTitle = 'Change Password';


// tracks errors
$changeP_errors = [];
// tracks whether the password has been changed (and then we can skip everything and just display a success msg)
$changed = false;
$uid = $_SESSION['va_id'];

// sets up a few variables for the password verification page
require './assets/includes/verifyPassword_init.inc.php';

// if they have clicked submit, verified their password, and the password has not already been changed
if (isset($_POST['changePwdBtn']) && !$changed) {

    // regEx (regular expression) matching to make sure the new password has 1 uppercase letter, 1 number, and at least 6 characters total
    $match = '/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])^\w*)\w{6,}$/';

    // if they entered a new password...
    if (!empty($_POST['pwd_new'])) {

        // ...and the password matches the regEx rules
        if (preg_match($match, $_POST['pwd_new']) ) {

            // ...and the new password matchs the confirmation password...
            if ($_POST['pwd_new'] === $_POST['pwd_conf']) {

                // ...hash the password in preparation to toss it into the db
                $p = password_hash($_POST['pwd_new'], PASSWORD_DEFAULT);

            } else {
                // if the password does NOT match the confirmation version, throw an error
                $changeP_errors['pwd_conf'] = 'Passwords do not match.';

            }
        } else {

            // if the password does NOT match the regEx rules, throw an error
            $changeP_errors['pwd_new'] = 'Password does not meet requirements';

        }

    } else {
        // if they didnt even enter a password, throw an error
        $changeP_errors['pwd_new'] = "Please enter a password";
    }



    // if there are no errors...
    if (empty($changeP_errors)) {
        // ...toss that bad boi into the db...
        $stmt = $dbpdo->prepare("UPDATE `info` SET `info` = '$p' WHERE `admin_id` = :admin_id");
        $stmt->bindParam(':admin_id', intval($uid), PDO::PARAM_INT);
        if ($stmt->execute()) {
            // ...and let them know it was changed!!
            $q = "UPDATE `adminuser` SET `v_code` = NULL, `v_expire` = NULL WHERE `adminuser`.`admin_id` = " . $uid;
            $r = mysqli_query($dbc, $q);
            if ($r) {
                $changed = "Password was changed!";
            } else {
                $changeP_errors['pwd_new'] = "The server is down. Please contact our service team";
            }
        } else {
            // if it didn't go through, create an error page and reroute them back

            // throws away everything we've added to the page so far and starts fresh, then it creates an error page!
            ob_end_clean();

            require './assets/includes/header.html';
            require './assets/includes/error.inc.php';
            $links = ['Return To Home' => 'index.php'];
            produce_error_page('Could not connect to the database, your article could not be uploaded. Please contact our service team to resolve the issue.', $links);
            require './assets/includes/footer.html';

            // tells it not to try any of the stuff below, give up and accept ur fate lil buddy
            exit();

        }
    }
}

// start creating the page...
require './assets/includes/header.html';

// loads the page in lmode or dmode depending on their settings
echo '<body id="pageWrapper" class="lmode defaultPage">';

// if they have verified thir password..
echo '<h2 class="adminHeading">Change Password</h2>';
// ...and it has already successfully completed
if ($changed != false) {
    ?>
    <h3 class="successHeading changeSuccessHeading"><?= $changed; ?></h3>
    <a href="index.php" class="adminBtn adminBtn_subtle returnToProfileBtn">Login</a>
    <?php
} else {
    // ...and it hasn't already successfully completed, create the changePassword form
    echo '<form class="generalForm changePForm" method="post">';

        // options that can be passed to create_form_input, this one gives the inputs a required attribute
        $options = ['required' => null];

        // custom function that make it easier to create common inputs, defined in form_functions.inc.php
        create_form_input('pwd_new', 'password', 'New Password', $changeP_errors, $options);

        create_form_input('pwd_conf', 'password', 'Confirm Password', $changeP_errors, $options);

        ?>

        <input type="submit" name="changePwdBtn" class="adminBtn adminBtn_danger" value="Change Password">
        <a href="profile.php" class="adminBtn adminBtn_subtle returnToProfileBtn">Return</a>
        </form>

        <?php
}

include './assets/includes/adminPage_end.inc.php';
include './assets/includes/footer.html';
?>
