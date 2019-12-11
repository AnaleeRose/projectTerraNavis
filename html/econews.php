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
?>

<h1 class="page-title">Eco-News!</h1>

<!-- Main body content -->

<?php  showArticles('description_only'); ?>



<div class="article1">
    <img class="article-img" src="" alt="Article Image">
    <p>November 22nd, 2019</p>
    <h2 class="sec-title">Title of Article</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. </p>
    <p class="readmore">Read More >></p>
</div>

<div class="article2">
    <img class="article-img" src="" alt="Article Image">
    <p>November 22nd, 2019</p>
    <h2 class="sec-title">Title of Article</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. </p>
    <p class="readmore">Read More >></p>
</div>
<div class="article3">
    <img class="article-img" src="" alt="Article Image">
    <p>November 22nd, 2019</p>
    <h2 class="sec-title">Title of Article</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. </p>
    <p class="readmore">Read More >></p>
</div>
<div class="article4">
    <img class="article-img" src="" alt="Article Image">
    <p>November 22nd, 2019</p>
    <h2 class="sec-title">Title of Article</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. </p>
    <p class="readmore">Read More >></p>
</div>
<div class="article5">
    <img class="article-img" src="" alt="Article Image">
    <p>November 22nd, 2019</p>
    <h2 class="sec-title">Title of Article</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. </p>
    <p class="readmore">Read More >></p>
</div>


<!-- NOTE -----------------------*************************************----------------- -->
<!-- This is what it currently looks like, with the added classes. If you want to change them and/or remove them then change it here and lemme know so i can update the code -->
<!-- END NOTE  ------------------*************************************----------------- -->
<!-- <div class="article6">
    <img class="article-img" src="" alt="Article Image">
    <p class="article-date">November 22nd, 2019</p>
    <h2 class="sec-title">Title of Article</h2>
    <p class="article-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. </p>
    <a class="readmore" href="../admin/view.php?view_type=read&media_type=article&media_id=WOOPS">Read More >></a>
</div> -->

<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
