<?php
$numwords = 30;

if (isset($no_articles) && $no_articles) {
    //do nothing
} else {
    if (isset($list_all) && $list_all) {
        if (isset($offset)) {
            $q = 'SELECT * FROM `articles` ORDER BY date_modified DESC LIMIT 25 OFFSET ' . $OFFSET;
        } else {
            $q = 'SELECT * FROM `articles` ORDER BY date_modified DESC LIMIT 25';
        }
    } else {
        $q = 'SELECT * FROM `articles` ORDER BY date_modified DESC LIMIT 5';
    }
    // echo $q;
    $r = mysqli_query($dbc, $q);
    if ($r && mysqli_num_rows($r) > 0) {
        while ($row = $r->fetch_assoc()) {
            if (!isset($row['error_flag'])) {
                $date_added = strtotime($row['date_added']);
                $date_added = date("m-d-Y", $date_added);
                if (!empty($row['date_modified'])) {
                    $date_modified = strtotime($row['date_modified']);
                    $date_modified = date("m-d-Y", $date_modified);
                    if ($date_modified === $date_added) $date_modified = 'Never';
                } else {
                    $date_modified = 'Never';
                }
                $description = $row['article_description'];
                preg_match("/(\S+\s*){0,$numwords}/", $description, $regs);
                $article_description = trim($regs[0]);
                if (strlen($article_description) > 100) $article_description = $article_description . '...';
                ?>

        <div class="nwBox backShadow_light">
            <h3 class="newsfeedHeading"><?= $row['article_name'] ?></h3>
            <?php
            if (!empty($row['date_modified']) && (strtotime($row['date_modified']) > strtotime('-3 day'))) echo '<p class="badge badge_accent">New</p>';
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
                <a href="view.php?view_type=read&media_type=article&media_id=<?php echo $row['article_id']; ?>" class="adminBtn adminBtn_aqua viewBtn">View Article</a>
                <?php } ?>
                <a href="editArticle.php?<?php echo 'article_id=' . $row['article_id']?>" class="adminBtn adminBtn_aqua editBtn">Edit Article</a>
                <a href="deleteArticle.php?<?php echo 'article_id=' . $row['article_id']?>" class="adminBtn adminBtn_danger deleteBtn">Delete Article</a>
            </div>
        </div>

            <?php
            }
        }
    }
}

if (isset($no_emails) && $no_emails) {
    //do nothing
} else {
    if (isset($list_all) && $list_all) {
        $q = 'SELECT * FROM `emails` ORDER BY date_added DESC';
    } else {
        $q = 'SELECT * FROM `emails` ORDER BY date_added DESC LIMIT 5';
        // $q = 'SELECT * FROM `emails` WHERE save_for_later != 1 ORDER BY date_sent DESC LIMIT 3';
    }

    $r = mysqli_query($dbc, $q);
    if ($r && mysqli_num_rows($r) > 0) {
        while ($row = $r->fetch_assoc()) {
            $date_added = strtotime($row['date_added']);
            $date_added = date("m-d-Y", $date_added);
            if (!empty($row['date_sent'])) {
                $date_sent = strtotime($row['date_sent']);
                $date_sent = date("m-d-Y", $date_sent);
            } else {
                $date_sent = 'Never';
            }
            $description = $row['email_message'];
            preg_match("/(\S+\s*){0,$numwords}/", $description, $regs);
            $email_message = trim($regs[0]) . '...';
            ?>

    <div class="nwBox emailBox backShadow_light">
        <h3 class="newsfeedHeading"><?= $row['email_subject'] ?></h3>
        <?php
        if ($row['save_for_later'] === '1') echo '<p class="badge badge_danger">Not Sent</p>';
        if (!empty($row['date_sent']) && (strtotime($row['date_sent']) > strtotime('-3 day'))) echo '<p class="badge badge_accent">New</p>' ;
        if (isset($list_all) && $list_all) {
            echo '<p class="dateInfo">Created: <span>' . $date_added  . '</span></p>';
            echo '<p class="dateInfo">Sent: <span>' . $date_sent . '</span></p>';
        }
        ?>
        <p class="newsfeedDescription"><?= $email_message ?></p>
        <div class="btnBox">
            <a href="view.php?view_type=read&media_type=email&media_id=<?= $row['email_id']; ?>" class="adminBtn adminBtn_accent readEmailBtn">Read Email</a>
            <?php
            if ($row['save_for_later'] === '1') {
                ?>
                <a href="editEmail.php?email_id=<?= $row['email_id']; ?>" class="adminBtn adminBtn_danger readEmailBtn">Edit Email</a>
                <?php
            }
            ?>
        </div>
    </div>

            <?php
        }
    }
}

