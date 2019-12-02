<?php
// ob_start tells it not to show anything until everything is done loading so I can intterupt it at any time to load an error page without php getting mad about content already on display
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
require './../html/assets/includes/functions.php';



$pageTitle = 'Change Password';

// relogged_in aka have they verified using their password before accessing seriously important parts of the site?
$relogged_in = $_SESSION['relogged_in'];

// tracks errors
$changeP_errors = [];
// tracks whether the password has been changed (and then we can skip everything and just display a success msg)
$changed = false;
$uid = $_SESSION['uid'];

// sets up a few variables for the password verification page
require './assets/includes/verifyPassword_init.php';

// if they have clicked submit, verified their password, and the password has not already been changed
if (isset($_POST['changePwdBtn']) && $relogged_in && !$changed) {

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
        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            // ...and let them know it was changed!!
            $changed = "Password was changed!";
        } else {
        // if it didn't go through, create an error page and reroute them back

            // throws away everything we've added to the page so far and starts fresh, then it creates an error page!
            ob_end_clean();

            require './assets/includes/header.html';
            require './assets/includes/error.php';
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
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';
echo '<p id="serverLightMode" class="hidden">' . $_SESSION['light_mode'] . '</p>';
    require './assets/includes/adminMenu.php';
    // newsfeedContent_active.php shows the most recent articles and emails
    require './assets/includes/newsfeed_active.php';
    nd('adminMC_Wrapper', 'noDI');
        nd('adminMainContent', 'mainContent');

// if they have verified thir password..
if ($relogged_in) {
    echo '<h2 class="adminHeading">Change Password</h2>';
    // ...and it has already successfully completed
    if ($changed != false) {
        ?>
        <h3 class="successHeading"><?= $changed; ?></h3>
        <a href="profile.php" class="adminBtn adminBtn_subtle returnToProfileBtn">Return To Profile</a>
        <?php
    } else {
        // ...and it hasn't already successfully completed, create the changePassword form
        echo '<form class="generalForm" method="post">';

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

} else {

    // grabs the password verification form and stuffins
    require './assets/includes/verifyPassword_form.php';

}
include './assets/includes/adminPage_end.php';
include './assets/includes/footer.html';
?>
