<?php
    require './assets/includes/adminMenu.php';
    require './assets/includes/newsfeed_active.php';

    nd('adminMC_Wrapper', 'noDI');
        nd('adminMainContent', 'mainContent');
            nd('profilePicDiv', 'noID');
                echo '<img class="profilePic" src="assets/profilePictures/';
                if (isset($_SESSION['profilePic_Location'])) {
                    echo $_SESSION['profilePic_Location'];
                } else {
                        echo 'basic.jpg';
                }
                echo '">';
                echo '<a href="profile.php" class="adminBtn adminBtn_accent profileBtn">Profile</a>';
            ed(); ?>

            <?php nd('mainLinks', 'noID'); ?>
                <a href="./allEmails.php" class="allEmails">See All Emails</a>
                <a href="./allArticles.php" class="allArticles">See All Articles</a>
                <a href="./newEmail.php" class="newEmail">Create New Email</a>
                <a href="./newArticle.php" class="newArticle">Create New Article</a>
                <a href="http://localhost:81/BPA/admin/view.php?view_type=read&media_type=article&media_id=57" class="">View Template Article</a>

            <?php ed();
        ed();
        ?>
        <?php
include './assets/includes/adminPage_end.php';
include './assets/includes/footer.html';

