<?php
ob_start();
require './assets/includes/config.inc.php';
require MYSQL;
require './assets/includes/form_functions.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Terra Navis | Eco News</title>
    <meta name="description" content="Earthship bio-friendly homes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
</head>
<body>
<!------ Header ------------>
<?php
require './assets/includes/header.inc.php';
require './assets/views/showArticles.inc.php';
$showArticle_errors;

if (isset($_GET['article_id'])) $article_id = $_GET['article_id'];

if (!isset($_GET['article_id'])) {
    echo '<div class="errorPage">';
        echo '<p>That article doesn\'t seem to exist... ';
    echo '</div>';
    require './assets/includes/footer.inc.php';
    echo '</body>
    </html>';
    exit();
}


showArticles('full_article');


?>




<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
