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



$pageTitle = 'Delete Admin';

// relogged_in aka have they verified using their password before accessing seriously important parts of the site?
$relogged_in = $_SESSION['relogged_in'];

// sets up a few variables for the password verification page
require './assets/includes/verifyPassword_init.php';

// tracks errors
$deleteAdmin_errors = [];



// if they clicked the btn, verified their password, checked the agree to delete box AND there are no errors...
if (isset($_POST['deleteAdminBtn']) && $relogged_in && isset($_POST['agreeToDelete']) && empty($deleteAdmin_errors)) {

    // id of the admin to delete
	$a_delete_id = (int) $_POST['deleteAdmin_id'];
    $uid = (int) $_SESSION['uid'];

    // ...and if the admin they're attempting to delete isn't themselves and isn't the first one (the placeholder one)...
	if ($a_delete_id !== $uid && $a_delete_id != 1){
        $stmt = $dbpdo->prepare("DELETE FROM `adminuser` WHERE `adminuser`.`admin_id` = :a_delete_id");
        $stmt->bindParam(':a_delete_id', $a_delete_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            // ...delete that admin and let em know it went well
    		ob_end_clean();
			require './assets/views/adminDeleted.php';
    		exit();
        } else {
            // if they couldn't delete it, throw an error
		    ob_end_clean();
		    require './assets/includes/header.html';
		    require './assets/includes/error.php';
		    $links = ['Return To Home' => 'index.php'];
		    produce_error_page('Could not delete from the database. Please contact our service team to resolve the issue.', $links);
		    require './assets/includes/footer.html';
		    exit();
        }

	} else {
        // if they didnt select an admin (one is the placeholder text for the select), tell them it failed and why
        if ($a_delete_id === 1) {
    		$deleteAdmin_errors['deleteAdmin_id'] = 'Please select an admin to delete';
    	}

        // if they attempt to delete themselves, tell them it failed and why
        if ($a_delete_id == $uid) {
            $deleteAdmin_errors['deleteAdmin_id'] = 'Cannot delete admin account in use';
        }

    }
} elseif (isset($_POST['deleteAdminBtn']) && !isset($_POST['agreeToDelete'])) {

    // if they clicked the btn but didn't agree, make them. They need to know they can't undo this
	$deleteAdmin_errors['agreeToDelete'] = 'Please verify that you know this cannot be undone';

}

// start creating the page...
require './assets/includes/header.html';
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';
echo '<p id="serverLightMode" class="hidden">' . $_SESSION['light_mode'] . '</p>';
    require './assets/includes/adminMenu.php';
    require './assets/includes/newsfeed_active.php';
    nd('adminMC_Wrapper', 'noDI');
        nd('adminMainContent', 'mainContent');
        ?>
        <?php
// if they have already verified their password, load the page
if ($relogged_in) {
        ?>
		<h2 class="adminHeading text_error">Delete Admin</h2>
		<p class=" deleteAdminText">Are you sure you want to delete an admin? This cannot be undone.</p>
        <form class="deleteAdminForm generalForm" method="post">
    		<label for="agreeToDelete" class="text_error agreeToDelete_label">Yes, I want to <span class="bold">permanently</span> delete an admin.
    		<input type="checkbox" name="agreeToDelete" value="Yes" class="agreeToDelete_input" id="agreeToDelete">
    		</label>
            <!-- The php below is just checking for errors for this element and displaying them if they exist -->
    		<?php if (!empty($deleteAdmin_errors['agreeToDelete'])) echo '<p class="formNotice formNotice_InlineError text_error verifyError">' . $deleteAdmin_errors['agreeToDelete'] . '</p>'; ?>
    		<hr class="newHr">
    		<p class=" deleteAdminText">Select an admin to delete:</p>
            <select name="deleteAdmin_id" class="categorySelect" id="deleteAdmin_id">
    	    	<option value="1" selected>Admin Username | Admin Email</option>
    	        <?php
                // grab all the admins from the db
    	        $q = "SELECT `admin_id`, `admin_username`, admin_email FROM `adminuser";
    	        $r = mysqli_query($dbc, $q);
    	        if ($r) {
    	            while ($row = $r->fetch_assoc()) {
                        // only show the admins that are not the first one, to make sure we always have at least one, and isn't the current admin
    	            	if ($row['admin_id'] != $uid && $row['admin_id'] != 1) {
    		                echo '<option value="' . $row['admin_id'] . '"';
    		                echo '>' . $row['admin_username']. ' | ' . $row['admin_email'] . ' </option>';
    		            }
    	            }
    	        }
    	        ?>
            </select>
            <?php
            // displays the deleteAdmin_errors for the select, but has to check if it needs to display just one or many
            if (!empty($deleteAdmin_errors['deleteAdmin_id']) && !is_array($deleteAdmin_errors['deleteAdmin_id'])) {
                echo '<p class="formNotice formNotice_InlineError text_error">' . $deleteAdmin_errors['deleteAdmin_id'] . '</p>';
            } elseif (!empty($deleteAdmin_errors['deleteAdmin_id']) && is_array($deleteAdmin_errors['deleteAdmin_id'])) {
                foreach ($deleteAdmin_errors as $key => $value) {
                    echo '<p class="formNotice formNotice_InlineError text_error">' . $value . '</p>';
                }

            }
            ?>
    		<input type="submit" name="deleteAdminBtn" class="adminBtn adminBtn_danger" value="Delete Admin">
            <a href="profile.php" class="adminBtn adminBtn_subtle returnToProfileBtn">Return</a>
        </form>
<?php
} else {

    // if they haven't verified their password, have them do so
    require './assets/includes/verifyPassword_form.php';
}

include './assets/includes/adminPage_end.php';
include './assets/includes/footer.html';
?>
