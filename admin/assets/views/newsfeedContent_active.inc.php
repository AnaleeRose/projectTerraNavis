<?php
$numwords = 30;
$all_articles;
$all_emails;

if (isset($no_articles) && $no_articles) {
    //do nothing
} else {
    if (isset($list_all) && $list_all) {
        if (isset($offset)) {
            $q = 'SELECT * FROM `articles` WHERE `error_flag` IS NULL ORDER BY date_modified DESC LIMIT 25 OFFSET ' . $OFFSET;
        } else {
            $q = 'SELECT * FROM `articles` WHERE `error_flag` IS NULL ORDER BY date_modified DESC LIMIT 25';
        }
    } else {
        $q = 'SELECT * FROM `articles` WHERE `error_flag` IS NULL ORDER BY date_modified DESC LIMIT 15';
    }
    // echo $q;
    $r = mysqli_query($dbc, $q);
    if ($r && mysqli_num_rows($r) > 0) {
        while ($row = $r->fetch_assoc()) {
            $all_articles[] = $row;
        }
        //insert here

    }
}


if (isset($no_emails) && $no_emails) {
    //do nothing
} else {
    if (isset($list_all) && $list_all) {
        $q = 'SELECT * FROM `emails` ORDER BY date_added DESC';
    } else {
        $q = 'SELECT * FROM `emails` ORDER BY date_added DESC LIMIT 8';
    }

    $r = mysqli_query($dbc, $q);
    if ($r && mysqli_num_rows($r) > 0) {
        while ($row = $r->fetch_assoc()) {
            $all_emails[] = $row;
        }

    }
}

function create_article($a_num) {
    global $all_articles;
    global $numwords;
    global $list_all;

    $this_article = $all_articles[$a_num];
    $date_added = strtotime($this_article['date_added']);
    $date_added = date('F jS, Y', strtotime($date_added));
    if (!empty($this_article['date_modified'])) {
        $date_modified = strtotime($this_article['date_modified']);
        $date_modified = date('F jS, Y', strtotime($date_modified));
        if ($date_modified === $date_added) $date_modified = 'Never';
    } else {
        $date_modified = 'Never';
    }
    $description = $this_article['article_description'];
    preg_match("/(\S+\s*){0,$numwords}/", $description, $regs);
    $article_description = trim($regs[0]);
    if (strlen($article_description) > 100) $article_description = $article_description . '...';
    ?>

    <div class="nwBox backShadow_light">
        <h4 class="mediaType">Article</h4>
        <h3 class="newsfeedHeading"><?= $this_article['article_name'] ?></h3>
        <?php
        if (!empty($this_article['date_modified']) && (strtotime($this_article['date_modified']) > strtotime('-3 day'))) echo '<p class="badge badge_accent">New</p>';
        if (isset($list_all) && $list_all) {
            echo '<p class="dateInfo">Created: <span>' . $date_added  . '</span></p>';
            echo '<p class="dateInfo">Modified: <span>' . $date_modified . '</span></p>';
        }
        ?>
        <p class="newsfeedDescription"><?= $article_description ?></p>
        <div class="btnBox">
            <?php
            if (isset($list_all) && $list_all) {
            ?>
            <a href="view.php?view_type=read&media_type=article&media_id=<?php echo $this_article['article_id']; ?>" class="adminBtn adminBtn_aqua viewBtn">View Article</a>
            <?php } ?>
            <a href="editArticle.php?<?php echo 'article_id=' . $this_article['article_id']?>" class="adminBtn adminBtn_aqua editBtn">Edit Article</a>
            <a href="deleteArticle.php?<?php echo 'article_id=' . $this_article['article_id']?>" class="adminBtn adminBtn_danger deleteBtn">Delete Article</a>
        </div>
    </div>

    <?php
    return true;
}

function create_email($e_num) {
    global $all_emails;
    global $numwords;
    global $list_all;

    $this_email = $all_emails[$e_num];
    $e_num++;
    $date_added = strtotime($this_email['date_added']);
    $date_added = date('F jS, Y', strtotime($date_added));
    if (!empty($row['date_sent'])) {
        $date_sent = strtotime($this_email['date_sent']);
        $date_modified = date('F jS, Y', strtotime($date_sent));
    } else {
        $date_sent = 'Never';
    }
    $description = $this_email['email_message'];
    preg_match("/(\S+\s*){0,$numwords}/", $description, $regs);
    $email_message = trim($regs[0]) . '...';
    ?>

        <div class="nwBox emailBox backShadow_light">
            <h4 class="mediaType">Email</h4>
            <h3 class="newsfeedHeading"><?= $this_email['email_subject'] ?></h3>
            <?php
            if ($this_email['save_for_later'] === '1') echo '<p class="badge badge_danger">Not Sent</p>';
            if (!empty($this_email['date_sent']) && (strtotime($this_email['date_sent']) > strtotime('-3 day'))) echo '<p class="badge badge_accent">New</p>' ;
            if (isset($list_all) && $list_all) {
                echo '<p class="dateInfo">Created: <span>' . $date_added  . '</span></p>';
                echo '<p class="dateInfo">Sent: <span>' . $date_sent . '</span></p>';
            }
            ?>
            <p class="newsfeedDescription"><?= $email_message ?></p>
            <div class="btnBox">
                <a href="view.php?view_type=read&media_type=email&media_id=<?= $this_email['email_id']; ?>" class="adminBtn adminBtn_aqua readEmailBtn">Read Email</a>
                <?php
                if ($this_email['save_for_later'] === '1') {
                    ?>
                    <a href="editEmail.php?email_id=<?= $this_email['email_id']; ?>" class="adminBtn adminBtn_accent adminBtn_accent_alt readEmailBtn">Edit Email</a>
                    <?php
                }
                ?>
            </div>
        </div>

    <?php
}


if (isset($no_emails) && $no_emails && isset($no_articles) && $no_articles) {
} else {
    $num = 0;
    while ($num < 8) {
        if (isset($all_articles[$num]) && !empty($all_articles[$num])) {
            create_article($num);
        }

        if (isset($all_emails[$num]) && !empty($all_emails[$num])) {
            create_email($num);
        }
        $num++;
    } // END while stmt

}

if ((isset($no_emails) && $no_emails) && (!isset($no_articles))) { // aka all articles
    foreach ($all_articles as $key => $value) {
        create_article($key);
    }
}

if ((isset($no_articles) && $no_articles) && (!isset($no_emails))) { // aka all articles
    foreach ($all_emails as $key => $value) {
        create_email($key);
    } // END foreach
}

