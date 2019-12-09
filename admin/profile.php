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

// creates a back button
include './assets/includes/backBtn.inc.php';


// makes it easy to create common inputs for this page specifically, we only need it if they haven't clicked the button yet since this code is just to rebuild the article into inputs
if (!isset($_POST['publishMediaBtn'])) require './assets/includes/form_functions_edit.inc.php';

// reset this so they have to login again before attempting to change anything important
$_SESSION['relogged_in'] = false;



$pageTitle = 'Profile';
$login_errors = [];
define('COLS', 5);
$pos = 0;
$firstRow = true;
// grab all possible profile pictures
$q = 'SELECT * FROM profilepictures';
$getPictures = mysqli_query($dbc, $q);
if (!$getPictures) {
    $register_errors['profilepictures'] = 'Could not retrieve profile images, defaulting to base image';
}

// if they clickty clicked the submit btn...
if (isset($_POST['saveChangesBtn'])) {
    // ...and they changed their image...
    if ($_SESSION['profilePic_id'] !== $_POST['profilePicChoice'])  {
        $q = 'UPDATE `adminuser` SET `profilePic_id` = ' . $_POST['profilePicChoice'] . ' WHERE `adminuser`.`admin_id` = ' . $_SESSION['uid'];
        $r = mysqli_query($dbc, $q);
        if ($r) {
            // ...and they can find that pic and pic info...
            $q = 'SELECT pic_location FROM profilepictures WHERE profilePic_id = ' . $_POST['profilePicChoice'];
            $r = mysqli_query($dbc, $q);
            if ($r) {
                while ($row = $r->fetch_assoc()) {
                    // ...update the session variables!
                    $newPicLocation = $row['pic_location'];
                    $_SESSION['profilePic_id'] = $_POST['profilePicChoice'];
                    $_SESSION['profilePic_Location'] = $newPicLocation;
                }
                while(mysqli_more_results($dbc)) {
                    // releases mysqli, I think? I don't remembet exactly how this works. I had an issue and this fixes it lol
                    mysqli_next_result($dbc);
                }
                echo '<span class="hidden formNotice formNotice_success">Changes were saved</span>';
            } else {
            echo '<span class="hidden formNotice formNotice_error">Changes could not be saved </span>';
            }
        } else {
            echo '<span class="hidden formNotice formNotice_error">Changes could not be saved </span>';
        }
    }



    // if they changed their light mode...
    if ($_SESSION['light_mode'] !==  $_POST['lightModeInput']) {

        // ...update their info...
        $q = 'UPDATE `adminuser` SET `light_mode` = "' . $_POST['lightModeInput'] . '" WHERE `adminuser`.`admin_id` = ' . $_SESSION['uid'];
        $r = mysqli_query($dbc, $q);
        if ($r) {

            // ...and update the session variables
            $_SESSION['light_mode'] = $_POST['lightModeInput'];
            echo '<span class="hidden formNotice formNotice_success">Changes Were Saved!</span>';
        } else {
            require './assets/includes/error.html';
            require './assets/includes/footer.html';
            exit();
        }
    }
}



// start creating page....
require './assets/includes/header.html';
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';
echo '<p id="serverLightMode" class="hidden">' . $_SESSION['light_mode'] . '</p>';
    require './assets/includes/adminMenu.php';
    require './assets/includes/newsfeed_active.php';
    nd('adminMC_Wrapper', 'noDI');
        nd('adminMainContent', 'mainContent');
            nd('profilePicDiv', 'noID');
                echo '<img class="profilePic" src="assets/profilePictures/';
                if (isset($_SESSION['profilePic_Location'])) {
                    echo $_SESSION['profilePic_Location'];
                } else {
                        echo 'basic.jpg';
                }
                echo '">';
                ?>
                <a class="adminBtn adminBtn_accent changePicBtn">Change Picture</a>
                <table id="chooseThumbTable" class="chooseThumbTable hiddenThumb"> <!-- -->
                    <tr>
                        <?php
                        while ($row = $getPictures->fetch_assoc()) {
                            if ($pos++ % COLS === 0 && !$firstRow) {
                                echo '</tr><tr>';
                            }
                            $firstRow = false;
                            ?>
                        <td><img src="<?= 'assets/profilePictures/' . $row['pic_location']; ?>" alt="<?= str_replace('_', ' ', $row['pic_name']); ?>" class="chooseThumb" data-id="<?= $row['profilePic_id'] ?>"></td>
                    <?php } ;
                        while ($pos++ % COLS) {
                            echo '<td>&nbsp;</td>';
                        }
                    ?>
                    </tr>
                </table>

                <?php
                echo '<p class="muted profileInfo" style="margin-top: -5rem;"><span>' . ucfirst($_SESSION['username']) . '</span></p>';
                echo '<p class="muted profileInfo"><span>' . $_SESSION['email'] . '</span></p>';
                nd("pbtnDiv","noID");
                ?>
                    <a  class="adminBtn adminBtn_switch lightModeBtn"><span class="lightModeBtn_span"></span></a>
                    </form>
                    <a href="editInfo.php" class="adminBtn adminBtn_subtle editInfoBtn" >Edit Info</a>
                    <a href="changePassword.php" class="adminBtn adminBtn_subtle changePwdBtn">Change Password</a>
                    <p class="adminControlsP"><span>Admin Controls</span></p>
                    <a href="register.php" class="adminBtn adminBtn_subtle editAdminsBtn">Create Admin</a>
                    <a href="deleteAdmin.php" class="adminBtn adminBtn_subtle editAdminsBtn">Delete Admin</a>
                    <form action="profile.php" method="post" class="registerForm updatePicForm" name="profilePicForm">
                        <input type="number" name="profilePicChoice" value="<?= $_SESSION['profilePic_id'] ?>" id="profilePicChoice" class="profilePicChoice hidden">
                        <input type="hidden" name="lightModeInput" value="<?= $_SESSION['light_mode'] ?>" id="lightModeInput" class="lightModeInput">
                        <input type="submit" name="saveChangesBtn" id="saveChangesBtn" class="adminBtn adminBtn_submit saveChangesBtn saveChangesBtn_hidden" value="Save Changes">
                    </form>

                <?php
                ed();
            ed();
        ed();
        ed(); ?>

<?php
include './assets/includes/adminPage_end.php';
include './assets/includes/footer.html';

