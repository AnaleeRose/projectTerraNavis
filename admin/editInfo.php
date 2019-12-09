<?php
// ob_start tells it not to show anything until everything is done loading so I can interrupt it at any time to load an error page without php getting mad about content already on display
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



$pageTitle = 'Edit Profile Info';

// relogged_in aka have they verified using their password before accessing seriously important parts of the site?
$relogged_in = $_SESSION['relogged_in'];

// tracks errors
$editProfile_errors = [];

$uid = $_SESSION['uid'];

// sets up a few variables for the password verification page
require './assets/includes/verifyPassword_init.php';

// if they have clicked submit and verified their password...
if (isset($_POST['editInfoBtn']) && $relogged_in) {
    // just making sure something has changed, and give it the go ahead to run the db code
	$run = false;

    // if the username box is empty, throw an error, otherwise set it to an easier to type variable
	empty($_POST['username']) ? $editProfile_errors['username'] = 'Please enter a username' : $n_username = $_POST['username'];

    // if the email box is empty, throw an error, otherwise set it to an easier to type variable
	empty($_POST['email']) ? $editProfile_errors['email'] = 'Please enter a email' : $n_email = $_POST['email'];

	$_POST['username'] === $_SESSION['username'] ? $update_username = false : $update_username = true;
	$_POST['email'] === $_SESSION['email'] ? $update_email = false : $update_email = true;

    // if they have changed anything, toss and error
	if (!$update_username && !$update_email) {
		$editProfile_errors['username'] = 'Please enter a different username or email';
	} elseif (!$update_username  && $update_email) {

        // if they only changed the email, create the stament to only change that
		$run = true;
		$stmt = $dbpdo->prepare("UPDATE `adminuser` SET `admin_email` = :n_email  WHERE `adminuser`.`admin_id` = :uid");
        $stmt->bindParam(':n_email', $n_email, PDO::PARAM_STR);

	} elseif ($update_username  && !$update_email) {

        // if they only changed the username, create the stament to only change that
		$run = true;
		$stmt = $dbpdo->prepare("UPDATE `adminuser` SET `admin_username` = :n_username  WHERE `adminuser`.`admin_id` = :uid");
        $stmt->bindParam(':n_username', $n_username, PDO::PARAM_STR);

	} elseif ($update_username && $update_email) {

        // if they changed both, create the stament to change both
		$run = true;
		$stmt = $dbpdo->prepare("UPDATE `adminuser` SET `admin_username` = :n_username, `admin_email` = :n_email  WHERE `adminuser`.`admin_id` = :uid");
        $stmt->bindParam(':n_username', $n_username, PDO::PARAM_STR);
        $stmt->bindParam(':n_email', $n_email, PDO::PARAM_STR);

	}

	if ($run) {
	    $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);

	    if ($stmt->execute()) {
            // make sure it worked...
	    	$e = $_POST['email'];
	    	$select = "SELECT a.admin_id AS uid, a.admin_username, a.admin_email, a.profilePic_id, a.light_mode, p.pic_Location FROM `info` i JOIN adminuser a ON a.admin_id = i.admin_id JOIN profilepictures p ON p.profilePic_id = a.profilePic_id WHERE a.admin_email = '$e'";
	    	$r2 = mysqli_query($dbc, $select);
            if (mysqli_num_rows($r2) === 1) {
                // and reset the session variables, as well as regenerating their id, just in case
            	session_regenerate_id();
                while ($row = mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
                   $_SESSION['uid'] = $row['uid'];
                   $_SESSION['username'] = $row['admin_username'];
                   $_SESSION['email'] = $row['admin_email'];
                   $_SESSION['profilePic_id'] = $row['profilePic_id'];
                   $_SESSION['profilePic_Location'] = $row['pic_Location'];
                   $_SESSION['light_mode'] = $row['light_mode'];
                }
            }

            // redirect them back to their profile to see their changes!
	    	header('Location: ' . BASE_URL . 'admin/profile.php');
	    } else {

            // throw an error if something went wrong
		    ob_end_clean();
		    require './assets/includes/header.html';
		    require './assets/includes/error.php';
		    $links = ['Return To Home' => 'index.php'];
		    produce_error_page('Could not edit the database. Please contact our service team to resolve the issue.', $links);
		    require './assets/includes/footer.html';
		    exit();
	    }
	}

}

// start creating the page...
require './assets/includes/header.html';
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';
echo '<p id="serverLightMode" class="hidden">' . $_SESSION['light_mode'] . '</p>';
    require './assets/includes/adminMenu.php';
    require './assets/includes/newsfeed_active.php';
    nd('adminMC_Wrapper', 'noDI');
        nd('adminMainContent', 'mainContent');
if ($relogged_in) {
    echo '<h2 class="adminHeading">Edit Your Profile Information</h2>';
    echo '<form class="editProfileForm generalForm" method="post">';
		$options = ['required' => null, 'addtl_classes' => '', 'value' => $_SESSION['username']];
		create_form_input('username', 'text', 'Username', $editProfile_errors, $options);

		$options = ['required' => null, 'addtl_classes' => '', 'value' => $_SESSION['email']];
		create_form_input('email', 'email', 'Email', $editProfile_errors, $options);
	echo '<input type="submit" name="editInfoBtn" class="adminBtn adminBtn_danger" value="Edit Info">';
    echo '<a href="profile.php" class="adminBtn adminBtn_subtle returnToProfileBtn">Return</a>';
} else { // please relog in
    require './assets/includes/verifyPassword_form.php';
}
include './assets/includes/adminPage_end.php';
include './assets/includes/footer.html';
?>
