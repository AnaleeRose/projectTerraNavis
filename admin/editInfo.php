<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
require MYSQL; // connect to db
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php'; // various functions
if (isset($_COOKIE['relogged_in']) && (strlen($_COOKIE['relogged_in']) === 32)) {
	$r_id = $_COOKIE['relogged_in'];
} else {
	$r_id = openssl_random_pseudo_bytes(16);
	$r_id = bin2hex($r_id);
}
setcookie('relogged_in', $r_id, time()+(60*60*24*30), '/');

$pageTitle = 'Edit profile Info';
$editProfile_errors = [];
$verifyPwd_errors = [];
$relogged_in = $_SESSION['relogged_in'];
$uid =$_SESSION['uid'];
if (!isset($_GET['edit_type'])) {
    ob_end_clean();
    require './assets/includes/header.html';
    require './assets/includes/error.php';
    $links = ['Return To Home' => 'index.php'];
    produce_error_page('Hmm, something is wrong with that link. Please contact our service team to resolve the issue.', $links);
    require './assets/includes/footer.html';
    exit();
} else {
	$edit_type = $_GET['edit_type'];
}



if (isset($_POST['verifyPwdBtn'])) {
	$pwd = $_POST['pwd'];
	if (empty($_POST['pwd'])) $verifyPwd_errors['pwd'] = 'Please enter your password';
	if (empty($verifyPwd_errors)) {
	    $q = "SELECT info FROM info WHERE admin_id = " . $_SESSION['uid'];
	    $r = mysqli_query($dbc, $q);
	    if ($r) {
	    	$admin_verify_me = mysqli_fetch_row($r);
	    	if (password_verify($pwd, $admin_verify_me[0])) {
	    		$_SESSION['relogged_in']= true;
	    		$relogged_in = $_SESSION['relogged_in'];
	    	} else {
	    		$verifyPwd_errors['pwd'] = 'Incorrect password';
	    	}
	    } else {
		    ob_end_clean();
		    require './assets/includes/header.html';
		    require './assets/includes/error.php';
		    $links = ['Return To Home' => 'index.php'];
		    produce_error_page('Could not connect to the database. Please contact our service team to resolve the issue.', $links);
		    require './assets/includes/footer.html';
		    exit();
	    }
	}
}

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
        ?>
        <form class="editProfileForm" method="post">
        <?php
if ($relogged_in) {
	if ($edit_type === 'general') {
		$options = ['required' => null, 'addtl_classes' => '', 'value' => $_SESSION['username']];
		create_form_input('username', 'text', 'Username', $editProfile_errors, $options);

		$options = ['required' => null, 'addtl_classes' => '', 'value' => $_SESSION['email']];
		create_form_input('email', 'email', 'Email', $editProfile_errors, $options);

	} elseif ($edit_type === 'changep') {

	}
	echo '<input type="submit" name="editInfoBtn" class="adminBtn adminBtn_danger" value="Edit Info">';
} else { // please relog in
?>
		<h2 class="adminHeading">Please Verify Your Password</h2>
<?php
		$options = ['required' => null, 'addtl_classes' => ''];
		create_form_input('pwd', 'password', 'Password', $verifyPwd_errors, $options);
		echo '<input type="submit" name="verifyPwdBtn" class="adminBtn adminBtn_danger" value="Verify Password">';
}
?>
            <a href="profile.php" class="adminBtn adminBtn_aqua backToProfile">Back to Profile</a>
        </form>
<?php
include './assets/includes/adminPage_end.php';
include './assets/includes/footer.html';
?>
