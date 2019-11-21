<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
$user = 'admin';
require MYSQL;
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php'; // basic functions used throughout the site
$_SESSION['relogged_in'] = false;


$pageTitle = 'Profile';
$login_errors = [];
define('COLS', 5);
$pos = 0;
$firstRow = true;
$q = 'SELECT * FROM profilepictures';
$getPictures = mysqli_query($dbc, $q);
if (!$getPictures) {
    $register_errors['profilepictures'] = 'Could not retrieve profile images, defaulting to base image';
}
if (!isset($_SESSION['uid']) || !isset($_SESSION['email'])) {
    header('Location: index.php');
} else {
    if (isset($_POST['saveChangesBtn'])) {
        if ($_SESSION['profilePic_id'] !== $_POST['profilePicChoice'])  {
            if (!$online) { //purely because its a simpler way, my server doesn't allow stored procedure though ;-;
                $q = 'CALL updateProfilePic(' . $_POST['profilePicChoice'] . ','  . $_SESSION['uid'] . ')';
                $r = mysqli_query($dbc, $q);
                if ($r) {
                    while ($row = $r->fetch_assoc()) {
                        $newPicLocation = $row['pic_location'];
                        $_SESSION['profilePic_id'] = $_POST['profilePicChoice'];
                        $_SESSION['profilePic_Location'] = $newPicLocation;
                    }
                    while(mysqli_more_results($dbc)) {
                        mysqli_next_result($dbc);
                    }
                    echo '<span class="hidden formNotice formNotice_success">Changes Were Saved!</span>';
                } else {
                    require './assets/includes/error.html';
                    require './assets/includes/footer.html';
                    exit();
                }
            } else {
                $q = 'UPDATE `adminuser` SET `profilePic_id` = ' . $_POST['profilePicChoice'] . ' WHERE `adminuser`.`admin_id` = ' . $_SESSION['uid'];
                $r = mysqli_query($dbc, $q);
                if ($r) {
                    $q = 'SELECT pic_location FROM profilepictures WHERE profilePic_id = ' . $_POST['profilePicChoice'];
                    $r = mysqli_query($dbc, $q);
                    if ($r) {
                        while ($row = $r->fetch_assoc()) {
                            $newPicLocation = $row['pic_location'];
                            $_SESSION['profilePic_id'] = $_POST['profilePicChoice'];
                            $_SESSION['profilePic_Location'] = $newPicLocation;
                        }
                        while(mysqli_more_results($dbc)) {
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
        }

        if ($_SESSION['light_mode'] !==  $_POST['lightModeInput']) {
            $q = 'UPDATE `adminuser` SET `light_mode` = "' . $_POST['lightModeInput'] . '" WHERE `adminuser`.`admin_id` = ' . $_SESSION['uid'];
            $r = mysqli_query($dbc, $q);
            if ($r) {
                $_SESSION['light_mode'] = $_POST['lightModeInput'];
                echo '<span class="hidden formNotice formNotice_success">Changes Were Saved!</span>';
            } else {
                require './assets/includes/error.html';
                require './assets/includes/footer.html';
                exit();
            }
        }
    }

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
                        // if ($getPictures) {do {
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
                    <a href="editInfo.php?edit_type=general" class="adminBtn adminBtn_subtle editInfoBtn" >Edit Info</a>
                    <a href="editInfo.php?edit_type=changep" class="adminBtn adminBtn_subtle changePwdBtn">Change Password</a>
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
}

