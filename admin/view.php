<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
$user = 'admin';
require MYSQL; // connect to db
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
if (!isset($_POST['publishMediaBtn'])) require './assets/includes/form_functions_edit.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php'; // various functions
$view_type = $_GET['view_type'];
$media_type = $_GET['media_type'];
$media_id = $_GET['media_id'];
$article_name = '';
$article_description = '';
$category = '';

// PULL FROM DB ------------------------------------------------------------------------->
if ($media_type === 'article') {
	$q = "SELECT a.*, category FROM articles a JOIN categories c ON a.article_category = c.category_id WHERE article_id = $media_id";
	$r = mysqli_query($dbc, $q);
	if ($r) {
		while ($row = $r->fetch_assoc()) {
			$article_name = $row['article_name'];
			$article_description = $row['article_description'];
			$category = $row['category'];
			$date_added = $row['date_added'];
			$last_modified = $row['date_modified'];
		}

	} else {
        ob_end_clean();
        require './assets/includes/header.html';
        require './assets/includes/error.php';
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
		}
	}
} else {
    ob_end_clean();
    require './assets/includes/header.html';
    require './assets/includes/error.php';
    $links = ['Return To Home' => 'index.php', 'See All Articles' => 'allArticles.php'];
    produce_error_page('That link doesn\'t exist. Please contact our service team to resolve the issue.', $links);
    require './assets/includes/footer.html';
    exit();
}

// PREVIEW MEDIA ------------------------------------------------------------------------->

require './assets/includes/header.html';
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';
    require './assets/includes/adminMenu.php';
    require './assets/includes/newsfeed_active.php';
    nd('adminMC_Wrapper', 'noDI');
        nd('newMedia', 'noID');
        ?>
            <div class="newMediaHeading">
                <h2 class="adminHeading"><?= ucfirst($view_type) . ' ' . ucfirst($media_type) ?></h2>
                <div class="cornerLinks">
                <?php
                echo '<a href="./all' . ucfirst($media_type)  . 's.php" class="adminBtn adminBtn_aqua seeAll">See All ' . ucfirst($media_type)  . 's</a>';
                ?>
                </div>
            </div>
            <form class="newMediaForm" method="post">
        <?php
			if ($media_type === 'article') {
				?>
				<div class="previewEmailBox">
					<table class="previewTable">
						<tr>
							<th align="left">Name: </th>
							<th align="left">Description: </th>
							<th align="left">Category: </th>
							<th align="left">Date Created: </th>
							<th align="left">Last Modified: </th>
						</tr>
						<tr>
							<td><?= $article_name; ?></td>
							<td><?= $article_description; ?></td>
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
					<div class="printedArticle>">
					<h3 class="adminHeading printedHeading"><?= $article_name; ?></h3>
				<?php
					require './assets/includes/articleContentBuilder.php';
					echo '</div>';
				}
				?>
				</div>
				<?php
			} elseif ($media_type === 'email') {
				?>
				<div class="previewEmailBox">
					<h2 class="adminHeading">Subject:</h2>
					<h2 class="adminHeading emailSubject"><?= $e_subject; ?></h2>
					<h2 class="adminHeading">Message: </h2>
					<p class="emailMsg"><?= $e_msg; ?></p>
				</div>
				<?php

			}

            ed();
        ed();
    ed();
require './assets/includes/footer.html';
ob_end_flush();
?>

