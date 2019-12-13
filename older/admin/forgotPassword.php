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
// start creating the page...
require './assets/includes/header.html';

	echo '<body id="pageWrapper" class="lmode defaultPage">';
		    echo '<h2 class="adminHeading">Forgot Password</h2>';
			echo '<form class="generalForm" method="post">';

		    // options that can be passed to create_form_input, this one gives the inputs a required attribute
		    $options = ['required' => null];

		    // custom function that make it easier to create common inputs, defined in form_functions.inc.php
		    create_form_input('email', 'email', 'Your Email', $forgotP_errors, $options);


		    ?>

		    <input type="submit" name="forgotPwdBtn" class="adminBtn adminBtn_accent forgotPwdBtn" value="Reset Password">
		    <a href="index.php" class="adminBtn adminBtn_subtle returnToProfileBtn">Login</a>
		    </form>

<?php
include './assets/includes/adminPage_end.inc.php';
include './assets/includes/footer.html';
?>