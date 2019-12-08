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
