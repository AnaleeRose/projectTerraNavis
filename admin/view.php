<?php
// ob_start tells it not to show anything until everything is done loading so I can interrupt it at any time to load an error page without php getting mad about content already on display
ob_start();

// starts a session, aka it tracks information even when you go to a different page within the site
session_start();

 // config sets up a number of vital defnitions and a few functions too
require './../html/assets/includes/config.inc.php';

// toss user back to login page if they're not logged in
check_if_admin();
// connects ya to the db
require MYSQL;

// makes it easy to create forms
require './../html/assets/includes/form_functions.inc.php';
if (!isset($_POST['publishMediaBtn'])) require './assets/includes/form_functions_edit.inc.php';

// basic functions used throughout the site
require './../html/assets/includes/functions.inc.php';



$pageTitle = 'View ' . $_GET['media_type'];
$view_type = $_GET['view_type'];
$media_type = $_GET['media_type'];
$media_id = $_GET['media_id'];
$emailForm_errors = [];

if (isset($_POST['sendEmail'])) {
	$send = true;
} else {
	$send = false;
}

$sent = false;
$prev_sent = false;
$article_name = '';
$article_description = '';
$category = '';
$bcc_headers = '';
// PULL FROM DB ------------------------------------------------------------------------->
if ($media_type === 'article') {
	$q = "SELECT a.*, category FROM articles a JOIN categories c ON a.article_category = c.category_id WHERE article_id = $media_id";
	$r = mysqli_query($dbc, $q);
	if ($r) {
		while ($row = $r->fetch_assoc()) {
			$article_name = $row['article_name'];
			$article_description = $row['article_description'];
			$category = $row['category'];
			$date_added =  date("F j, Y g:i a", strtotime($row["date_added"]));
			$last_modified = date("F j, Y g:i a", strtotime($row["date_modified"]));
			$img_location = IMG_PATH . $row['img_name'];
			$caption = $row['caption'];
		}

	} else {
        ob_end_clean();
        require './assets/includes/header.html';
        require './assets/includes/error.inc.php';
        $links = ['Return To Home' => 'index.php'];
        produce_error_page('That article doesn\'t exist. Please contact our service team to resolve the issue.', $links);
        require './assets/includes/footer.html';
        exit();
	}
} elseif ($media_type === 'email') {
	$q = "SELECT * FROM emails WHERE email_id = $media_id";
		$r = mysqli_query($dbc, $q);
	if ($r) {
		while ($row = $r->fetch_assoc()) {
			$e_subject = $row['email_subject'];
			$e_msg = $row['email_message'];
			$date_created = $row['date_added'];
			$date_sent = $row['date_sent'];
			if (isset($row['date_sent']) && !empty($row['date_sent'])) $prev_sent = true;
		}

		if (!empty($e_subject) && $send) {
			$q = "SELECT * FROM email_list";
			$r = mysqli_query($dbc, $q);
			if ($r) {
				$e_msg = '<html><body><p>' . $e_msg . '</p></body></html>';
				$e_msg = str_replace("\n\r", "</p>\n<p>", $e_msg);
				$first = true;
				while ($row = $r->fetch_assoc()) {
					$email = $row['email'];
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						if ($first) {
							$first = false;
							$bcc_headers .= $email;
						} else {
							$bcc_headers .= ',' . $email;
						}
					}
				}

				if (strlen($bcc_headers) > 5) {
					if (isset($_POST['yourEmail']) && filter_var($_POST['yourEmail'], FILTER_VALIDATE_EMAIL)) {
						$bcc_headers .= ',' . $_POST['yourEmail'];
					} elseif (!empty($_POST['yourEmail']) && !filter_var($_POST['yourEmail'], FILTER_VALIDATE_EMAIL)) {
						$emailForm_errors['yourEmail'] = 'Invalid Email';
					}
					if (empty($emailForm_errors)) {
                        $q = "UPDATE `emails` SET `save_for_later` = '0', `date_sent` = NOW() WHERE email_id = $media_id";
                        $r = mysqli_query($dbc, $q);
                        if ($r) {
    						$mail_to_send_to = "kaiasnowfall@gmail.com";
                                $r = mysqli_query($dbc, $q);
    						$from_email = "savannah@savannahskinner.com";
    					    $headers = "MIME-Version: 1.0" . "\r\n" . "Content-type:text/html;charset=UTF-8" . "\r\n" . "From: $from_email" . "\r\n" . 'Bcc:' .$bcc_headers . "\r\n";
    					    $send = mail( $mail_to_send_to, $e_subject, $e_msg, $headers);
                            // $a = false;
    					    if ($send) {
                                // $previewEmail_errors['notice'] = 'Message was sent!';
                                $sent = true;
    					    } else {
    							$previewEmail_errors[] = 'Message could not be sent. Please contact our service team.';
    					    }
                        } else {
                            $previewEmail_errors[] = 'Message could not be sent, the database could not be reached. Please contact our service team.';
                        }
					} else {
                        print_r($emailForm_errors);
                    }
				}
			}
		}
	} else { // if no email with that id
	    ob_end_clean();
	    require './assets/includes/header.html';
	    require './assets/includes/error.inc.php';
	    $links = ['Return To Home' => 'index.php', 'See All Articles' => 'allArticles.php'];
	    produce_error_page('That link doesn\'t exist. Please contact our service team to resolve the issue.', $links);
	    require './assets/includes/footer.html';
	    exit();
	}

} else { // if no emails
    ob_end_clean();
    require './assets/includes/header.html';
    require './assets/includes/error.inc.php';
    $links = ['Return To Home' => 'index.php', 'See All Articles' => 'allArticles.php'];
    produce_error_page('That link doesn\'t exist. Please contact our service team to resolve the issue.', $links);
    require './assets/includes/footer.html';
    exit();
}

if ($media_type === 'email') {
	$seeAllColor = 'adminBtn_danger';
} else {
	$seeAllColor = 'adminBtn_aqua';
}


//<td>$article_description;</td>

// PREVIEW MEDIA ------------------------------------------------------------------------->

require './assets/includes/header.html';
echo '<script>';
?>
window.addEventListener('load', (event) => {
    allUl = document.querySelectorAll('.printedUl')
    if (allUl.length > 0) {
        allUl[0].style.clear = 'both';
    }
})
<?php

echo '</script>';
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . ' viewPage">';
    require './assets/includes/adminMenu.inc.php';
    require './assets/includes/newsfeed_active.inc.php';
    nd('adminMC_Wrapper', 'noDI');
        echo BACK_BTN;
        nd('newMedia', 'noID');
        ?>
            <div class="newMediaHeading">
                <h2 class="adminHeading"><?= ucfirst($view_type) . ' ' . ucfirst($media_type) ?></h2>
                <div class="cornerLinks">
                <?php
                if ($view_type === 'preview') echo '<a href="editEmail.php?email_id=' . $media_id . '" class="adminBtn adminBtn_aqua editEmailLink">Edit Email</a>';
                if ($media_type === 'email') echo '<a class="adminBtn ' . $seeAllColor .' seeAll seeAllWarningBtn">See All ' . ucfirst($media_type)  . 's</a>';
                if ($media_type === 'article')echo '<a href="all'. ucfirst($media_type) . 's.php" class="adminBtn ' . $seeAllColor .' seeAll">See All ' . ucfirst($media_type)  . 's</a>';
                ?>
                </div>
            </div>
            <div class="hidden leaveWarning">
            	<p>If you leave this page, this email will be saved but not sent. Are you sure you to leave?</p>
            	<a href="./all<?= ucfirst($media_type); ?>s.php" class="adminBtn adminBtn_danger">Yes, save and leave</a>
            	<a class="adminBtn <?php if ($_SESSION['light_mode'] === 'lmode') {echo 'adminBtn_aqua';} else {echo 'adminBtn_subtle';} ?> noLeave">No, return to <?= $media_type;?></a>
            </div>
        <?php
			if ($media_type === 'article') { // IF ARTICLE  -------------------------------------------------->
				?>
				<div class="previewArticleBox">
					<table class="previewTable">
						<tr>
							<th align="left">Name: </th>
							<!-- <th align="left">Description: </th> -->
							<th align="left">Category: </th>
							<th align="left">Date Created: </th>
							<th align="left">Last Modified: </th>
						</tr>
						<tr>
							<td><?= $article_name; ?></td>
							<td><?= $category; ?></td>
							<td><?= $date_added; ?></td>
							<td><?= $last_modified; ?></td>
						</tr>
					</table>

				<?php
				$q = "SELECT * FROM article_content WHERE article_id = $media_id";
				$r = mysqli_query($dbc, $q);
				if ($r) {
					?>
					<h3 class="adminHeading printedHeading articleNameHeading"><?= $article_name; ?></h3>
					<h4 class="categoryHeading"><?= $category; ?></h4>
					<div class="printedArticle>" id="printedArticle">
						<div class="viewImgBox">
							<img class="viewImg" src="<?= $img_location; ?>" alt="<?= $article_name; ?>">
							<p class="printedCaption" ><?= $caption; ?></p>
						</div>
						<div class="articleContent">
					<?php
						require './assets/includes/articleContentBuilder.inc.php';
						echo '</div>';
					}
					?>
						</div>
					</div>
					<hr class="newHr">
					<div class="articleFooter">
						<p>Want to read more articles in the <a class="categoryLink" href="../html/index.php"><?= $category; ?></a> category?</p>
					</div>
				</div>
				<?php
			} elseif ($media_type === 'email') { // ELSEIF EMAIL  -------------------------------------------------->

				?>
				<div class="previewEmailBox">
					<form method="post" class="generalForm">
					<div class="previewEmailBox">
						<h2 class="adminHeading">Subject:</h2>
						<h2 class="adminHeading emailSubject"><?= $e_subject; ?></h2>
						<h2 class="adminHeading">Message: </h2>

						<div class="emailMsg">
							<p class="emailP"><?= str_replace("\n\r", "</p>\n<p class=\"emailP\">", $e_msg) ?></p>
						</div>
							<?php
                            if (isset($previewEmail_errors) && !empty($previewEmail_errors)) {
                                foreach ($previewEmail_errors as $key => $value) {
                                    if ($key === 'notice') {
                                        echo '<p class="formNotice formNotice_success">' . $value . '</p>';
                                    } else {
                                        echo '<p class="formNotice formNotice_InlineError">' . $value . '</p>';
                                    }
                                }
                            }
							?>
					</div>

                    <?php if (!$sent && !$prev_sent) { 
						create_form_input('yourEmail', 'email', 'Your Email', $emailForm_errors);
                    	?>
					   <input type="submit" name="sendEmail" class="adminBtn adminBtn_aqua" id="sendEmailBtn" href="<?= BASE_URL; ?>admin/view.php?view_type=view&media_type=email&media_id=<?= $media_id; ?>&send=true" value="Send Email">
                    <?php } elseif ($sent || $prev_sent) {?>
                        <a class="adminBtn adminBtn_aqua returnToHomeBtn" href="index.php">Return To Home</a>
                    <?php } ?>
					</form>
				</div>
				<?php
			}

            ed();
        ed();
    ed();
require './assets/includes/footer.html';
ob_end_flush();
?>

