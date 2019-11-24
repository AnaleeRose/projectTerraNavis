<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
$user = 'admin';
require MYSQL; // connect to db
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php'; // various functions


$pageTitle = 'Delete Admin';
$relogged_in = $_SESSION['relogged_in'];
require './assets/includes/verifyPassword_init.php';
$deleteAdmin_errors = [];
if (isset($_POST['deleteAdminBtn']) && $relogged_in && isset($_POST['agreeToDelete']) && empty($deleteAdmin_errors)) {
	$a_delete_id = (int) $_POST['deleteAdmin_id'];
    $uid = (int) $_SESSION['uid'];
	if ($a_delete_id !== $uid && $a_delete_id != 1){
        $stmt = $dbpdo->prepare("DELETE FROM `adminuser` WHERE `adminuser`.`admin_id` = :a_delete_id");
        $stmt->bindParam(':a_delete_id', $a_delete_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
    		ob_end_clean();
			require './assets/views/adminDeleted.php';
    		exit();
        } else {
		    ob_end_clean();
		    require './assets/includes/header.html';
		    require './assets/includes/error.php';
		    $links = ['Return To Home' => 'index.php'];
		    produce_error_page('Could not delete from the database. Please contact our service team to resolve the issue.', $links);
		    require './assets/includes/footer.html';
		    exit();
        }
	} else {
        if ($a_delete_id === 1) {
    		$deleteAdmin_errors['deleteAdmin_id'] = 'Please select an admin to delete';
    	}

        if ($a_delete_id == $uid) {
            $deleteAdmin_errors['deleteAdmin_id'] = 'Cannot delete admin account in use';
        }
    }
} elseif (isset($_POST['deleteAdminBtn']) && !isset($_POST['agreeToDelete'])) {
	$deleteAdmin_errors['agreeToDelete'] = 'Please verify that you know this cannot be undone';
}
if (!empty($deleteAdmin_errors)) {
    print_r($deleteAdmin_errors);
    print_r($_POST);
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
        <?php
if ($relogged_in) {
        ?>
		<h2 class="adminHeading text_error">Delete Admin</h2>
		<p class=" deleteAdminText">Are you sure you want to delete an admin? This cannot be undone.</p>
        <form class="deleteAdminForm generalForm" method="post">
    		<label for="agreeToDelete" class="text_error agreeToDelete_label">Yes, I want to <span class="bold">permanently</span> delete an admin.
    		<input type="checkbox" name="agreeToDelete" value="Yes" class="agreeToDelete_input" id="agreeToDelete">
    		</label>
    		<?php if (!empty($deleteAdmin_errors['agreeToDelete'])) echo '<p class="formNotice formNotice_InlineError text_error verifyError">' . $deleteAdmin_errors['agreeToDelete'] . '</p>'; ?>
    		<hr class="newHr">
    		<p class=" deleteAdminText">Select an admin to delete:</p>
            <select name="deleteAdmin_id" class="categorySelect" id="deleteAdmin_id">
    	    	<option value="1" selected>Admin Username | Admin Email</option>
    	        <?php
    	        $q = "SELECT `admin_id`, `admin_username`, admin_email FROM `adminuser";
    	        $r = mysqli_query($dbc, $q);
    	        if ($r) {
    	            while ($row = $r->fetch_assoc()) {
    	            	if ($row['admin_id'] != $uid && $row['admin_id'] != 1) {
    		                echo '<option value="' . $row['admin_id'] . '"';
    		                echo '>' . $row['admin_username']. ' | ' . $row['admin_email'] . ' </option>';
    		            }
    	            }
    	        }
    	        ?>
            </select>
            <?php
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
    require './assets/includes/verifyPassword_form.php';
}

include './assets/includes/adminPage_end.php';
include './assets/includes/footer.html';
?>
