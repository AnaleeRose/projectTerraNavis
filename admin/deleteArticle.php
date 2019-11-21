<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
$user = 'admin';
require MYSQL; // connect to db
require './../html/assets/includes/functions.php'; // various functions


if (!isset($_GET['article_id'])) {
    require './assets/includes/header.html';
    require './assets/includes/error.php';
    $links = ['Return To Home' => 'index.php'];
    produce_error_page('Hmm, seems like the link is wrong. Please contact our service team to resolve the issue.', $links);
    require './assets/includes/footer.html';
    exit();
} else {
	$article_id = $_GET['article_id'];
}

$q = "SELECT * FROM articles WHERE article_id = $article_id";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) === 0) {
    ob_end_clean();
	require './assets/views/articleDeleted.php';
    exit();
}

if (isset($_GET['delete']) && $_GET['delete'] === 'true') {
    $q = "DELETE FROM articles WHERE article_id = $article_id";
    $r = mysqli_query($dbc, $q);
    if (!$r) {
        ob_end_clean();
	    require './assets/includes/header.html';
	    require './assets/includes/error.php';
	    $links = ['Return To Home' => 'index.php', 'See All Articles' => 'allArticles.php'];
	    produce_error_page('Article could not be deleted. Please contact our service team to resolve the issue.', $links);
	    require './assets/includes/footer.html';
	    exit();
    }
}


$q = "SELECT * FROM articles WHERE article_id = $article_id";
$r = mysqli_query($dbc, $q);
if ($r && mysqli_num_rows($r) > 0) {
	while ($row = $r->fetch_assoc()) {
		$a_name = $row['article_name'];
		$a_category = $row['article_category'];
		$a_description = $row['article_description'];
		$date_created = $row['date_added'];
		$last_modified = $row['date_modified'];	
	}

	if (empty($a_name)) $a_name = 'Error';
} elseif (mysqli_num_rows($r) == 0) {
    ob_end_clean();
	require './assets/views/articleDeleted.php';
    exit();
}

require './assets/includes/header.html';
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';
    require './assets/includes/adminMenu.php';
    require './assets/includes/newsfeed_active.php';
    echo '<div class="adminMC_Wrapper">';
    	echo '<div class="deletePage">';
?>
			<h2>Delete Article: <?= $a_name ?></h2>
			<p>Are you sure you want to delete this article?</p>
			<table class="deleteTable">
				<tr>
					<th align="left">Article Name</th>
					<th align="left">Category</th>
					<th align="left">Description</th>
					<th align="left">Date Created</th>
					<th align="left">Last Modified</th>
				</tr>
				<tr>
					<td><?= $a_name; ?></td>
					<td><?= $a_category; ?></td>
					<td><?= $a_description; ?></td>
					<td><?= $date_created; ?></td>
					<td><?= $last_modified; ?></td>
				</tr>
			</table>
			<div class="btnContainer">
				<a href="deleteArticle.php?article_id=<?= $article_id ?>&delete=true" class="adminBtn adminBtn_danger deleteArticleBtn">Delete Article</a>
				<a href="allArticles.php" class="adminBtn adminBtn_subtle cancelBtn">Cancel</a>
			</div>
		</div>
	</div>
</div>
<?php
require './assets/includes/footer.html';
?>


