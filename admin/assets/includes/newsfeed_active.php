<?php
require_once './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
require_once MYSQL;


nd('newsfeedContent', 'noID');
    echo '<h2 class="newsfeedHeading">Recent Articles & Emails</h2>';
    require './assets/views/newsfeedContent_active.php';
ed();
