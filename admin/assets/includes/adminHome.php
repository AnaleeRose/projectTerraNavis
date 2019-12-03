<?php
    // grabs the admin menu
    require './assets/includes/adminMenu.php';
    // grabs the newsfeed include, further explained there. Basically it pulls the most recent articles and emails
    require './assets/includes/newsfeed_active.php';

    // nd stands for new div, aka when i don't want to intterupt php just to add a new div but also don't want to type ot the whole div using echo
    nd('adminMC_Wrapper', 'noID');
        nd('adminMainContent', 'mainContent');
            nd('profilePicDiv', 'noID');
                // create profile img and grab either the user's selected img or the default
                echo '<img class="profilePic" src="assets/profilePictures/';
                if (isset($_SESSION['profilePic_Location'])) {
                    echo $_SESSION['profilePic_Location'];
                } else {
                    echo 'basic.jpg';
                }
                echo '">';
                echo '<a href="profile.php" class="adminBtn adminBtn_accent profileBtn">Profile</a>';
            // ed stands for end div. Easy to echo out but I like consistency. sometimes. Occasionally.
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
// grabs the special footer for the homepage, orignally i had themhere but the div they close are created in an include and it's confusing to see more closing divs than opening ones
include './assets/includes/adminPage_end.php';

// grabs the footer
include './assets/includes/footer.html';

