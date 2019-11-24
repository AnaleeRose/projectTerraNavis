<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
require MYSQL; // connect to db
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php'; // various functions


$pageTitle = 'Edit Profile Info';
$relogged_in = $_SESSION['relogged_in'];
$editProfile_errors = [];
$uid = $_SESSION['uid'];
require './assets/includes/verifyPassword_init.php';

if (isset($_POST['editInfoBtn']) && $relogged_in) {
	$run = false;
	empty($_POST['username']) ? $editProfile_errors['username'] = 'Please enter a username' : $n_username = $_POST['username'];
	empty($_POST['email']) ? $editProfile_errors['email'] = 'Please enter a email' : $n_email = $_POST['email'];
	$_POST['username'] === $_SESSION['username'] ? $update_username = false : $update_username = true;
	$_POST['email'] === $_SESSION['email'] ? $update_email = false : $update_email = true;

	if (!$update_username && !$update_email) {
		$editProfile_errors['username'] = 'Please enter a different username or email';
	} elseif (!$update_username  && $update_email) {
		$run = true;
		$stmt = $dbpdo->prepare("UPDATE `adminuser` SET `admin_email` = :n_email  WHERE `adminuser`.`admin_id` = :uid");
        $stmt->bindParam(':n_email', $n_email, PDO::PARAM_STR);

	} elseif ($update_username  && !$update_email) {
		$run = true;
		$stmt = $dbpdo->prepare("UPDATE `adminuser` SET `admin_username` = :n_username  WHERE `adminuser`.`admin_id` = :uid");
        $stmt->bindParam(':n_username', $n_username, PDO::PARAM_STR);

	} elseif ($update_username && $update_email) {
		$run = true;
		$stmt = $dbpdo->prepare("UPDATE `adminuser` SET `admin_username` = :n_username, `admin_email` = :n_email  WHERE `adminuser`.`admin_id` = :uid");
        $stmt->bindParam(':n_username', $n_username, PDO::PARAM_STR);
        $stmt->bindParam(':n_email', $n_email, PDO::PARAM_STR);
	}

	if ($run) {
	    $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);

	    if ($stmt->execute()) {
	    	$e = $_POST['email'];
	    	$select = "SELECT a.admin_id AS uid, a.admin_username, a.admin_email, a.profilePic_id, a.light_mode, p.pic_Location FROM `info` i JOIN adminuser a ON a.admin_id = i.admin_id JOIN profilepictures p ON p.profilePic_id = a.profilePic_id WHERE a.admin_email = '$e'";
	    	$r2 = mysqli_query($dbc, $select);
            if (mysqli_num_rows($r2) === 1) {
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
	    	header('Location: ' . BASE_URL . 'admin/profile.php');
	    } else {
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

// page content start
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
