<?php
ob_start();
require './assets/includes/config.inc.php';
require MYSQL;
require './assets/includes/form_functions.inc.php';


// contact form handling
$contact_errors = [];
$showArticle_errors = [];
$c_options = ['required' => '', 'contactPage' => ''];
require './assets/views/showArticles.inc.php';



$page = 'News';
if ($page = 'News') {
?>
<style type="text/css">
  :root {
      --pageColor: var(--news);
      --pageColor-shade: var(--news-shade);
      --pageColor-link: var(--news-link);
  }
</style>
<?php
}
require './assets/includes/head.php';
?>

<body class="">
<!------ Header ------------>
<?php require './assets/includes/header.inc.php'; ?>

<!-- Main body content -->
<article id="mainContent" class="multiContentPage mainContent contactPage">
    <header class="mainHeading_Container">
       <h2 class="mainHeading">Newsfeed</h2>
    </header>

    <div class="mainContent-wrapper">
        <?php  showArticles('description_only'); ?>
    </div>
</article>

<!-- NOTE -----------------------*************************************----------------- -->
<!-- This is what it currently looks like, with the added classes. If you want to change them and/or remove them then change it here and lemme know so i can update the code -->
<!-- END NOTE  ------------------*************************************----------------- -->
<!-- <section class="article6">
    <img class="article-img" src="" alt="Article Image">
    <p class="article-date">November 22nd, 2019</p>
    <h2 class="sec-title">Title of Article</h2>
    <p class="article-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. </p>
    <a class="readmore" href="../admin/view.php?view_type=read&media_type=article&media_id=WOOPS">Read More >></a>
</section> -->

<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
