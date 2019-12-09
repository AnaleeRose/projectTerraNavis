<?php
// ob_start tells it not to show anything until everything is done loading so I can interrupt it at any time to load an error page without php getting mad about content already on display
ob_start();

// starts a session lol, aka it tracks information even when you go to a different page within the site
session_start();

 // config sets up a number of vital defnitions and a few functions too
require './../html/assets/includes/config.inc.php';

// connects ya to the db as admin for delete priveleges
$user = 'admin';
require MYSQL;

// a few useful functions used through the site
require './../html/assets/includes/functions.php';

// creates a back button
include './assets/includes/backBtn.inc.php';


// if there is no article id from the url, something went wrong so toss them an error
if (!isset($_GET['article_id'])) {
    require './assets/includes/header.html';
    require './assets/includes/error.php';
    $links = ['Return To Home' => 'index.php'];
    produce_error_page('Hmm, seems like the link is wrong. Please contact our service team to resolve the issue.', $links);
    require './assets/includes/footer.html';
    exit();
} else {
    // otherwise, put the article id in an easier to type variable
	$article_id = $_GET['article_id'];
}

// make sure that article exists, if it doesnt toss an error
$q = "SELECT * FROM articles WHERE article_id = $article_id";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) === 0 && !isset($_GET['delete'])) {
    ob_end_clean();
    require './assets/includes/header.html';
    require './assets/includes/error.php';
    $links = ['Return To Home' => 'index.php'];
    produce_error_page('That article doesn\'t seem to exist. Please contact our service team to resolve the issue.', $links);
    require './assets/includes/footer.html';
    exit();
} else {
    while ($row = $r->fetch_assoc()) {
        $a_name = $row['article_name'];
        $a_category = $row['article_category'];
        $a_description = $row['article_description'];
        $date_created = $row['date_added'];
        $last_modified = $row['date_modified'];
    }
    if (empty($a_name)) $a_name = 'Error';
}


// if the url confirms they want to delete it (aka they clicked the button) then delete the article
if (isset($_GET['delete']) && $_GET['delete'] === 'true') {
    $stmt = $dbpdo->prepare("DELETE FROM articles WHERE article_id = :article_id");
    $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        $q = "SELECT * FROM articles WHERE article_id = $article_id";
        $r = mysqli_query($dbc, $q);
        // make sure it was deleted
        if (mysqli_num_rows($r) == 0) {
            ob_end_clean();
            require './assets/views/articleDeleted.php';
            exit();
        }
    } else {
        // if it didn't work, throw an error
        ob_end_clean();
	    require './assets/includes/header.html';
	    require './assets/includes/error.php';
	    $links = ['Return To Home' => 'index.php', 'See All Articles' => 'allArticles.php'];
	    produce_error_page('Article could not be deleted. Please contact our service team to resolve the issue.', $links);
	    require './assets/includes/footer.html';
	    exit();
    }

}

// start creating the page...
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


