<?php
ob_start();
require './assets/includes/config.inc.php';
require MYSQL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Terra Navis | Eco News</title>
    <meta name="description" content="Earthship bio-friendly homes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<!------ Header ------------>
<?php require './assets/includes/header.php'; ?>
<?php require './assets/includes/form_functions.inc.php'; ?>

<h1 class="page-title">Eco-News!</h1>

<!-- Main body content -->

<!-- NOTE: *******************************************************************
u dont need to hard code any of these, if you're creating them as a template for me. I only need one as an example :D

you will need filler articles to be able to see the php below in action. there's a relatively up to date bpa.sql file (found in the bpa folder, its on github)
make sure you don't have a database named analeerose_bpa yet and then import it into phpmyadmin to get some filler articles.

or you could uncomment out the temp articles and use them to out finish out your styles! whatever works for you


also, the read more links all point to admin's preview page atm, will have to update it soon with it's own article page but it's saturday and im tired lol
 *****************************************************************************-->


<?php
$num = 1;
$q = 'SELECT * FROM `articles` ORDER BY date_modified DESC LIMIT 10';
$r = mysqli_query($dbc, $q);
if ($r && mysqli_num_rows($r) > 0) {
    while ($row = $r->fetch_assoc()) {
        if ($row['error_flag'] === null && $num <= 5) {
            ?>
                <div class="article<?= $num; ?>">
                    <img class="article-img" src="<?= IMG_PATH_HTML . $row['img_name']; ?>" alt="Article Image">
                    <p class="article-date"><?= date('M j, Y', strtotime($row['date_added']));   ?></p>
                    <h2 class="sec-title"><?= $row['article_name']; ?></h2>
                    <p class="article-description"><?= $row['article_description']; ?></p>
                    <a class="readmore" href="../admin/view.php?view_type=read&media_type=article&media_id=<?= $row['article_id']?>">Read More >></a>
                </div>
            <?php
            $num++;
        } // END if no error flag
    } // END while
} elseif (mysqli_num_rows($r) > 0) {
    echo '<p class="error major_error">We don\'t have any articles avaliable at the moment. Check back soon for more content!</p>';
} elseif (!$r) {
    ob_end_clean();
    require '../admin/assets/includes/header.html';
    require '../admin/assets/includes/error.php';
    $links = ['Return To Home' => 'index.php'];
    produce_error_page('Hmm...something went wrong. We\'ll be sure to fix it soon!', $links);
    require '../admin/assets/includes/footer.html';
    exit();
} // end if $r

?>

<!-- <div class="article1">
    <img class="article-img" src="" alt="Article Image">
    <p>November 22nd, 2019</p>
    <h2 class="sec-title">Title of Article</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. </p>
    <p class="readmore">Read More >></p>
</div> -->

<!-- <div class="article2">
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
<div class="article6">
    <img class="article-img" src="" alt="Article Image">
    <p>November 22nd, 2019</p>
    <h2 class="sec-title">Title of Article</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. </p>
    <p class="readmore">Read More >></p>
</div> -->

<!------ Footer ------------>
​<?php require './assets/includes/footer.php'; ?>

</body>
</html>
