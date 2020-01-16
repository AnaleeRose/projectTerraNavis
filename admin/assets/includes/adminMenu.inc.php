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
                if (isset($_SESSION['profilePic_id'])) {
                    echo '<img class="profilePicThumb" alt="Profile Image" src="assets/profilePictures/';
                    echo $_SESSION['profilePic_Location'];
                    echo '" data-profilePic_id="';
                    echo $_SESSION['profilePic_id'];
                    echo '" >';
                }
            ?>
        </a>
        <div class="menuLinks">
            <a href="./index.php" class="homeBtn adminBtn adminBtn_subtle" title="Home">Home</a>
            <a href="./new.php?media_type=email" class="newEmailBtn adminBtn adminBtn_aqua imgBtn" title="New Email">New Email</a>
            <a href="./new.php?media_type=article" class="newArticleBtn adminBtn adminBtn_aqua imgBtn" title="New Article">New Article</a>
            <a href="./allEmails.php" class="allEmailsBtn adminBtn adminBtn_aqua imgBtn" title="All Emails">All Emails</a>
            <a href="./allArticles.php" class="allArticlesBtn adminBtn adminBtn_aqua imgBtn" title="All Articles">All Articles</a>
                <a href="./logout.php" class="logoutBtn adminBtn adminBtn_subtle" title="Logout">Logout</a>
        </div>


    </div>
    <div class="menuBtnDiv">
        <p class="menuBtn">
            <svg xmlns="http://www.w3.org/2000/svg" height="22.566" viewBox="0 0 30.645 22.566" class="menuBtnSvg_open">
                <g id="Group_142" data-name="Group 142" transform="translate(-317.5 -32.5)">
                    <line id="Line_13" data-name="Line 13" x2="30.645" transform="translate(317.5 34.5)" fill="none" stroke-width="5"/>
                    <line id="Line_14" data-name="Line 14" x2="30.645" transform="translate(317.5 43.783)" fill="none" stroke-width="5"/>
                    <line id="Line_15" data-name="Line 15" x2="30.645" transform="translate(317.5 53.066)" fill="none" stroke-width="5"/>
                </g>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" height="27.07" viewBox="0 0 27.033 27.07" class="menuBtnSvg_close">
                <g id="Group_187" data-name="Group 187" transform="translate(-316.157 -32.879)">
                    <path id="Path_8" data-name="Path 8" d="M.78,14.047,23.566-8.785" transform="translate(317.5 43.783)" fill="none" stroke-width="5"/>
                    <path id="Path_9" data-name="Path 9" d="M.78-8.785,23.566,14.047" transform="translate(317.5 43.783)" fill="none" stroke-width="5"/>
                </g>
            </svg>
        </p>
    </div>
    <?php

