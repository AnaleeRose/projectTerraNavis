<?php
$numwords = 30;

$q = 'SELECT * FROM `articles` ORDER BY date_added DESC LIMIT 3';
$r = mysqli_query($dbc, $q);
if ($r && mysqli_num_rows($r) > 0) {
    while ($row = $r->fetch_assoc()) {
        $description = $row['article_description'];
        preg_match("/(\S+\s*){0,$numwords}/", $description, $regs);
        $article_description = trim($regs[0]) . '...';
        ?>

<div class="nwBox backShadow_light">
    <h3 class="newsfeedHeading"><?= $row['article_name'] ?></h3>
    <p class="newsfeedDescription"><?= $article_description ?></p>
    <div class="btnBox">
        <a href="editArticle.php?<?php echo 'article_id=' . $row['article_id']?>" class="adminBtn adminBtn_accent editBtn">Edit Article</a>
        <a href="deleteArticle.php?<?php echo 'article_id=' . $row['article_id']?>" class="adminBtn adminBtn_subtle deleteBtn">Delete Article</a>
    </div>
</div>

        <?php
    }
}

$q = 'SELECT * FROM `emails` ORDER BY date_added DESC LIMIT 3';
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
        <a href="editEmail.php?<?php echo 'email_id=' . $row['email_id']?>" class="adminBtn adminBtn_accent editBtn">Edit email</a>
        <a href="deleteEmail.php?<?php echo 'email_id=' . $row['email_id']?>" class="adminBtn adminBtn_subtle deleteBtn">Delete email</a>
    </div>
</div>

        <?php
    }
}

