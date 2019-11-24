<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
require MYSQL;
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php';

require './assets/includes/header.html';
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';
$options = ['required' => null];
$newArticle_errors = [];
    require './assets/includes/adminMenu.php';
    require './assets/includes/newsfeed_active.php';
    nd('adminMC_Wrapper', 'noDI');
        // nd('adminMainContent', 'mainContent');
        ?>
        <h2 class="adminHeading">New Article</h2>
        <
        <form class="newArticleForm generalForm" method="post">
        <?php
            $options = ['required' => null, 'placeholder' => 'Name'];
            create_form_input('article_name', 'text', ' ', $newArticle_errors, $options);
            echo '<select class="categorySelect" required>';
                    echo '<option value="" disabled selected>Category</option>';
            $q = "SELECT * FROM article_categories";
            $r = mysqli_query($dbc, $q);
            if ($r) {
                while ($row = $r->fetch_assoc()) {
                    echo '<option value="' . $row['article_category_id'] . '">' . $row['article_category']. '</option>';
                }
            }
            echo '</select>';
            $options = ['required' => null, 'placeholder' => 'Description'];
            create_form_input('article_description', 'textarea', '', $newArticle_errors, $options);
            ?>
        </form>
        <?php
        // ed();
    ed();
require './assets/includes/footer.html';
ob_end_flush();
?>

