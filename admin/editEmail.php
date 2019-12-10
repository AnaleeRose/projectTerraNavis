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
require './../html/assets/includes/functions.inc.php';




// tracks errors
$editEmail_errors = [];

$pageTitle = 'Edit Email';

// the same error msg, but I don't have to ype it twice!
function no_email() {
	ob_end_clean();
    require './assets/includes/header.html';
    require './assets/includes/error.inc.php';
    $links = ['Return To Home' => 'index.php'];
    produce_error_page('That email doesn\'t exist. Please contact our service team to resolve the issue.', $links);
    require './assets/includes/footer.html';
    exit();
}

// if the email id exists, set it to an easier name
if (isset($_GET['email_id']) && !empty($_GET['email_id'])) {
	$email_id = $_GET['email_id'];
} else {
    // if the email id isn't there, throw an error!
	no_email();
}

if (isset($_POST['editEmailBtn'])) {
    // $e_saved = 1;
    // throws an error if either box is empty
    if (empty($_POST['email_subject'])) {
        $newEmail_errors['email_subject'] = 'Missing: Subject';
    } else {
        $e_subject = $_POST['email_subject'];
    }

    if (empty($_POST['email_msg'])) {
        $newEmail_errors['email_msg'] = 'Missing: Message';
    } else {
        $e_msg = $_POST['email_msg'];
    }

    // if there no errors, toss that into the db and send em to the review page so they can decide whether or not they wanna send it
    if (empty($newEmail_errors)) {
        $stmt = $dbpdo->prepare("UPDATE `emails` SET `email_subject` = :e_subject, `email_message` = :e_msg WHERE `email_id` = :e_id");
        $stmt->bindParam(':e_subject', $e_subject, PDO::PARAM_STR);
        $stmt->bindParam(':e_msg', $e_msg, PDO::PARAM_STR);
        $stmt->bindParam(':e_id', $email_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            // if it worked, review that bad boi
            header('Location: view.php?view_type=preview&media_type=email&media_id=' . $email_id);
        } else {
            // if it fails, throw an error
            ob_end_clean();
            require './assets/includes/header.html';
            require './assets/includes/error.inc.php';
            $links = ['Return To Home' => 'index.php'];
            produce_error_page('Could not connect to the database, your email may be salvageable. Please contact our service team to resolve the issue.', $links);
            require './assets/includes/footer.html';
            exit();
        }
    }
}

// grab the details on that email
$q = "SELECT * FROM emails WHERE email_id = " . $email_id;
$r = mysqli_query($dbc, $q);
if ($r) {
	while ($row = $r->fetch_assoc()) {
		$email_subject = $row['email_subject'];
		$email_msg = htmlentities($row['email_message']);
	}
} else {
	no_email();
}

// start creating the page...
require './assets/includes/header.html';
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';
// options that can be passed to create_form_input, this one gives the inputs a required attribute but others do way more
$options = ['required' => null];
    require './assets/includes/adminMenu.inc.php';
    require './assets/includes/newsfeed_active.inc.php';
    nd('adminMC_Wrapper editEmail', 'noDI');
        echo BACK_BTN;
        nd('editEmailPage', 'noID');
            ?>
            <div class="newMediaHeading">
                <h2 class="adminHeading">Edit Email: <?= $email_subject; ?></h2>
                <div class="cornerLinks">
                    <a href="./new.php?media_type=email&clear=true" class="adminBtn adminBtn_danger">Clear Changes</a>
                </div>
               </div>
            <form class="newMediaForm generalForm" method="post">

                <?php
				$options = ['required' => null, 'placeholder' => 'Subject', 'maxlength' => 50, 'addtl_classes' => 'emailInput'];

				$options['value'] = $email_subject;
				create_form_input('email_subject', 'text', 'Subject', $editEmail_errors, $options);


				$options = ['required' => null, 'placeholder' => 'Message | Max 250 characters', 'maxlength' => 250, 'addtl_classes' => 'emailInput'];
                // if they havent tried to submit yet, set the msg to the db's version
				if (isset($_POST['email_msg']) && !empty($_POST['email_msg'])) {
					$options['value'] = $_POST['email_msg'];
				} else {
					$options['value'] = $email_msg;
				}
				create_form_input('email_msg', 'textarea', 'Message', $editEmail_errors, $options);
				?>

				<hr class="newHr">
				<p class="contentTypeBtn linkBtn_email linkGeneratorBtn">Link</p>
				<input type="submit" name="editEmailBtn" id="previewEmailBtn" class="adminBtn adminBtn_accent previewEmailBtn" value="Preview Email">
			</form>
				<div class="linkGenBox">
				    <h5 class="linkGenHeading">Link Generator</h5>
				    <p class="linkLabel">Link Text</p>
				    <p class="linkGenInput linkName" id="linkName" contenteditable="true">My Link</p>
				    <p class="linkLabel">Link URL</p>
				    <p class="linkGenInput linkHref" id="linkHrek" contenteditable="true">https://www.mylink.com</p>
				    <p class="linkGenBtn adminBtn adminBtn_aqua" id="linkGenBtn">Generate Link</p>
				    <p class="linkNote linkNote_subtle">Note: Links should only be used in the main content. They should not be used in the name or description of an article.</p>
				    <div class="generatorInstructions hidden">
				    <h4>Here's your link: </h4>
				    <hr class="linkGenHr">
				        <p class="linkGenOutputReview">The link will say: <span class="linkOutputText linkGen_accent"></span> and will link to <span class="linkOutputHref linkGen_accent"></span>.</p>
				        <p class="linkP" id="linkP">Steps to add to article: </p>
				        <p class="linkP" id="linkP">1) Copy this text:</p>
				        <p class="linkGenOutput linkGen_accent" id="linkGenOutput"></p>
				        <p class="linkP" id="linkP">2) Paste the text where you want the link to be in the final article</p>
				    </div>
				    <p class="linkGenEmptyError hidden">You're missing one or more values. Please fill both of the above boxes before generating the link.</p>
				    <p class="linkGenCloseBtn">➔</p>
				</div>
            <?php
            ed();
        ed();
    ed();
require './assets/includes/footer.html';
ob_end_flush();
?>
