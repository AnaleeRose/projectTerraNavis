<?php
require_once './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
if (isset($pageTitle)) {
    if (($pageTitle === 'All Emails') || ($pageTitle === 'All Articles')) {
        nd('adminHome adminHome_fullWidth', 'noID');
    } else {
        nd('adminHome', 'noID');
    }
} else {
    nd('adminHome', 'noID');
}

    nd('adminMenu', 'mainMenu');
    ?>
    <a href="./profile.php" class="profilePicThumbLink">
        <?php
            echo '<img class="profilePicThumb" src="assets/profilePictures/';
            echo $_SESSION['profilePic_Location'];
            echo '" data-profilePic_id="';
            echo $_SESSION['profilePic_id'];
            echo '" >';
        ?>
    </a>
    <div class="menuLinks">
        <a href="./index.php" class="homeBtn adminBtn adminBtn_subtle" title="Home">Home</a>
        <a href="./new.php?media_type=email" class="newEmailBtn adminBtn adminBtn_aqua" title="Home">New Email</a>
        <a href="./new.php?media_type=article" class="newArticleBtn adminBtn adminBtn_aqua" title="Home">New Article</a>
        <a href="./allEmails.php" class="allEmailsBtn adminBtn adminBtn_aqua" title="Home">All Emails</a>
        <a href="./allArticles.php" class="allArticlesBtn adminBtn adminBtn_aqua" title="Home">All Articles</a>
            <a href="./logout.php" class="logoutBtn adminBtn adminBtn_subtle" >Logout</a>
    </div>


    <?php
    ed();
