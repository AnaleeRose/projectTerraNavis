<?php
$numwords = 30;

if (isset($no_articles) && $no_articles) {

} else {
    if (isset($list_all) && $list_all) {
        if (isset($offset)) {
            $q = 'SELECT * FROM `articles` ORDER BY date_modified DESC LIMIT 25 OFFSET ' . $ofset;
        } else {
            $q = 'SELECT * FROM `articles` ORDER BY date_modified DESC LIMIT 25';
        }
    } else {
        $q = 'SELECT * FROM `articles` ORDER BY date_modified DESC LIMIT 3';
    }
    $r = mysqli_query($dbc, $q);
    if ($r && mysqli_num_rows($r) > 0) {
        while ($row = $r->fetch_assoc()) {
            $date_added = $row['date_added'];
            if (!isset($row['error_flag'])) {
                $description = $row['article_description'];
                preg_match("/(\S+\s*){0,$numwords}/", $description, $regs);
                $article_description = trim($regs[0]) . '...';
                ?>

        <div class="nwBox backShadow_light">
            <h3 class="newsfeedHeading"><?= $row['article_name'] ?></h3>
            <p class="newsfeedDescription"><?= $article_description ?></p>
            <div class="btnBox">
                <a href="editArticle.php?<?php echo 'article_id=' . $row['article_id']?>" class="adminBtn adminBtn_accent editBtn">Edit Article</a>
                <a href="deleteArticle.php?<?php echo 'article_id=' . $row['article_id']?>" class="adminBtn adminBtn_danger deleteBtn">Delete Article</a>
            </div>
        </div>

            <?php
            }
        }
    }
}

if (isset($no_emails) && $no_emails) {

} else {
    if (isset($no_limit) && $no_limit) {
        $q = 'SELECT * FROM `emails` ORDER BY date_added DESC';
    } else {
        $q = 'SELECT * FROM `emails` ORDER BY date_added DESC LIMIT 3';
    }

    $r = mysqli_query($dbc, $q);
    if ($r && mysqli_num_rows($r) > 0) {
        while ($row = $r->fetch_assoc()) {
            $description = $row['email_message'];
            preg_match("/(\S+\s*){0,$numwords}/", $description, $regs);
            $email_message = trim($regs[0]) . '...';
            ?>

    <div class="nwBox backShadow_light">
        <h3 class="newsfeedHeading"><?= $row['email_subject'] ?></h3>
        <p class="newsfeedDescription"><?= $email_message ?></p>
        <div class="btnBox">
            <a href="readEmail.php?<?php echo 'email_id=' . $row['email_id']?>" class="adminBtn adminBtn_accent readEmailBtn">Read Email</a>
        </div>
    </div>

            <?php
        }
    }
}

