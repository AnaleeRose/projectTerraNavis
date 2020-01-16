<?php
// ob_start tells it not to show anything until everything is done loading so I can interrupt it at any time to load an error page without php getting mad about content already on display
ob_start();

// starts a session lol, aka it tracks information even when you go to a different page within the site
session_start();

 // config sets up a number of vital defnitions and a few functions too
require './../html/assets/includes/config.inc.php';

// connects ya to the db
require MYSQL;

// makes it easy to create forms
require './../html/assets/includes/form_functions.inc.php';

// basic functions used throughout the site
require './../html/assets/includes/functions.inc.php';


$pageTitle = 'Forgot Password';
$forgotP_errors = [];
$send_to_email = false;
$options = ['required' => null];

$r_num = rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
$subject = "Terra Navis Admin | Verifiy Your Account";
$msg = "Your verification code for Terra Navis Admin is " . $r_num . ". Please enter it <a href=\"terranavis.life/admin/forgotPassword.php?v=t\">here</a> to reset your password.";

if (isset($_POST['forgotPwdBtn'])) {
	$email = $_POST['email'];
    $q = "SELECT * FROM adminuser WHERE admin_email = '$email'";
    $r = mysqli_query($dbc, $q);
    if ($r && mysqli_num_rows($r) == 1) {
		$row = $r->fetch_assoc();
		$a_id = $row['admin_id'];
		$q = "UPDATE `adminuser` SET `v_code` = '$r_num', `v_expire` = CURRENT_TIMESTAMP() WHERE `adminuser`.`admin_id` = " . $a_id;
    	$r = mysqli_query($dbc, $q);
		if ($r) {
			$mail_to_send_to = $email;
			$from_email = "savannah@savannahskinner.com";
		    $headers = "MIME-Version: 1.0" . "\r\n" . "Content-type:text/html;charset=UTF-8" . "\r\n" . "From: $from_email" . "\r\n";
		    $send = mail( $mail_to_send_to, $subject, $msg, $headers);
		    // $send = true;
		    if ($send) {
		    	header("Location: forgotPassword.php?v=t");
		    } else {
				$forgotP_errors['email'] = 'Message could not be sent. Please contact our service team.';
		    }

		} else {
    		$forgotP_errors['email'] = "The server is down. Please contact our service team";
		}
    } elseif ($r && mysqli_num_rows($r) !== 1) {
    	$forgotP_errors['email'] = "That user does not exist";
    } else {
    	$forgotP_errors['email'] = "The server is down. Please contact our service team";
    }
} else {

}

if (isset($_GET['v']) && $_GET['v'] = "t") {
	if (isset($_POST['vBtn'])) {
		$v_code = $_POST['v_code'];
		if (is_numeric($v_code) && (strlen((string)$v_code) === 6)) {
			$q = "SELECT * FROM adminuser WHERE v_code = '$v_code' && v_expire >= DATE_SUB(NOW(),INTERVAL 1 HOUR)";
    		$r = mysqli_query($dbc, $q);
    		if ($r && mysqli_num_rows($r) == 1) {
    			$row = $r->fetch_assoc();
				$_SESSION['va_id'] = $row['admin_id'];
				header("Location: f_changePassword.php");

    		} elseif ($r && mysqli_num_rows($r) !== 1) {
    			$forgotP_errors['v_code'] = "User not found or code expired";
    		}
		} else {
    		$forgotP_errors['v_code'] = "Please enter a valid verification code";
		}
	}

}

// start creating the page...
require './assets/includes/header.html';

	echo '<body id="pageWrapper" class="lmode defaultPage defaultPage_centered">';
		    echo '<h2 class="adminHeading">Forgot Password</h2>';
		echo '<form class="generalForm" method="post">';
	if (!isset($_GET['v'])) {

	    // options that can be passed to create_form_input, this one gives the inputs a required attribute

	    // custom function that make it easier to create common inputs, defined in form_functions.inc.php
	    create_form_input('email', 'email', 'Your Email', $forgotP_errors, $options);
	    ?>

	    <input type="submit" name="forgotPwdBtn" id="forgotPwdBtn" class="adminBtn adminBtn_accent forgotPwdBtn" value="Reset Password">
	    <a href="index.php" class="adminBtn adminBtn_subtle returnToProfileBtn">Login</a>

<?php }
	if (isset($_GET['v']) && $_GET['v'] === "t") {
		echo "<p>We've sent a verification code to your email, please enter it here within 1 hour to reset your password.</p>";
	    create_form_input('v_code', 'number', 'Verification Code', $forgotP_errors, $options);
	    echo '<input type="submit" name="vBtn" id="vBtn" class="adminBtn adminBtn_accent forgotPwdBtn" value="Verfy Code">';
	    echo '<a href="index.php" class="adminBtn adminBtn_subtle returnToProfileBtn">Login</a>';
	}

	echo '</form>';
include './assets/includes/adminPage_end.inc.php';
include './assets/includes/footer.html';
?>
