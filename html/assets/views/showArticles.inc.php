<?php

function showArticles($displaytype) {
    global $dbc;
    global $article_id;
    global $max_shown;
    global $customQuery;
    $articlesCurrentlyShown = 0;

    $showArticle_errors = [];
    if ($displaytype === 'description_only') {
        $num = 1;
        if (empty($customQuery)) {
            $q = 'SELECT a.*, c.category as category, c.category_id as cat_id FROM articles a JOIN categories c ON a.article_category = c.category_id ORDER BY date_modified DESC LIMIT 10';
        } else {
            $q = $customQuery;
        }
        $r = mysqli_query($dbc, $q);
        if ($r && mysqli_num_rows($r) > 0) {
            while ($row = $r->fetch_assoc()) {
                if ($row['error_flag'] === null && $num <= $max_shown) {
                    $articlesCurrentlyShown++;
                    ?>
                        <section class="article<?= $num; ?> indiArticle mainSection-container">
                        <?php if (isset($row['article_link']) && !empty($row['article_link'])) { ?>
                            <a href="<?= $row['article_link']; ?>" class="indiArticle-imgLink"><img class="indiArticle-img" src="<?= IMG_PATH_HTML . $row['img_name']; ?>" alt="Article Image"></a>
                        <?php } else { ?>
                            <a href="./readArticle.php?article_id=<?= $row['article_id']?>" class="indiArticle-imgLink"><img class="indiArticle-img" src="<?= IMG_PATH_HTML . $row['img_name']; ?>" alt="Article Image"></a>
                        <?php } ?>
                            <div class="indiArticle-content">
                                <a href="./readArticle.php?article_id=<?= $row['article_id']?>" class="indiArticle-titleLink"><h2 class="indiArticle-titleText"><?= $row['article_name']; ?></h2></a>
                                <p class="indiArticle-date"><?= date('F jS, Y', strtotime($row['date_added']));   ?></p>
                                <p class="indiArticle-description"><?= $row['article_description']; ?></p>
                                <div class="categoryReadBtn-container">
                                    <a class="indiArticle-category" href="newsfeed.php?dateSelect=All+Time&categorySelect=<?= $row['cat_id']; ?>&filterSubmitBtn=Filter"><?= $row['category']; ?></a>
                                    <?php if (isset($row['article_link']) && !empty($row['article_link'])) { ?>
                                        <a class="indiArticle-readMore" href="<?= $row['article_link']; ?>">Read Article <img class="ext_link" src="./assets/images/icons/externalLink.svg"></a>
                                    <?php } else { ?>
                                        <!-- <a class="indiArticle-readMore" href="./readArticle.php?article_id=<?= $row['article_id']?>">Read Article <img class="ext_link" src="./assets/images/icons/externalLink.svg"></a> -->
                                        <a class="indiArticle-readMore" href="./readArticle.php?article_id=<?= $row['article_id']?>">Read Article >></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </section>
                    <?php
                    $num++;
                } // END if no error flag
            } // END while
        } elseif (!$r) {
            ob_end_clean();
            require '../admin/assets/includes/header.html';
            require '../admin/assets/includes/error.inc.php';
            $links = ['Return To Home' => 'index.php'];
            produce_error_page('Hmm...something went wrong. We\'ll be sure to fix it soon!', $links);
            require '../admin/assets/includes/footer.html';
            exit();
        } // end if $r
    } elseif ($displaytype === 'full_article') {
        $articlesCurrentlyShown++;
        if (isset($article_id)) {
            $q = 'SELECT a.*,  c.category as category, c.category_id as c_id  FROM `articles` a JOIN categories c ON c.category_id = a.article_category WHERE article_id = ' . $article_id;
            $r = mysqli_query($dbc, $q);
            if ($r && mysqli_num_rows($r) > 0) {
                while ($row = $r->fetch_assoc()) {
                    if ($row['error_flag'] === null) {
                        ?>
                                <a class="readArticle-category" href="newsfeed.php?dateSelect=All+Time&categorySelect=<?= strtolower($row['c_id']); ?>&filterSubmitBtn=Filter"><?= $row['category']; ?></a>
                                <p class="readArticle-date">Posted: <?= date('M j, Y', strtotime($row['date_added'])); ?></p>
                                <div class="readArticle-imgContainer">
                                    <img class="readArticle-img" src="<?= IMG_PATH_HTML . $row['img_name']; ?>" alt="Article Image">
                                    <p class="readArticle-caption"><?= $row['caption']; ?></p>
                                </div>
                                <div class="readArticle-content">
                                    <hr class="readArticle-hr">
                                    <?php
                                        $q = 'SELECT * FROM `article_content` WHERE article_id = ' . $article_id;
                                        $r = mysqli_query($dbc, $q);
                                        if ($r && mysqli_num_rows($r) > 0) {
                                            require './assets/includes/articleBuilder.inc.php';
                                        }
                                    ?>
                                </div>
                        <?php
                    } // END if no error flag
                } // END while
            } else {
                $showArticle_errors['Database'] = 'That article does not exist.';
            } // END if $r
        } else {
            $showArticle_errors['article_id'] = 'That article does not exist.';
        };// END if article_id
    } // END if full_article

    if (isset($showArticle_errors) && !empty($showArticle_errors)) {
        foreach ($showArticle_errors as $key => $value) {
            echo '<p class="error">'. $value . '</p>';
        }
    } // END show errors if

    if ($articlesCurrentlyShown < 1) {
        echo '<p class="noArticles_error">We don\'t have any articles matching those criteria. Check back soon for more content!</p>';
    }
} // END function

function get_c_article_info() {
    global $article_id;
    global $a_name;
    global $a_desc;
    global $dbc;

    if (isset($article_id)) {
        $q = 'SELECT a.article_name as a_name, a.article_description as a_desc FROM `articles` a WHERE article_id = ' . $article_id;
        $r = mysqli_query($dbc, $q);
        if ($r && mysqli_num_rows($r) === 1) {
            while ($row = $r->fetch_assoc()) {
                $a_name = $row['a_name'];
                $a_desc = $row['a_desc'];
            }
        }

    }


}

?>
