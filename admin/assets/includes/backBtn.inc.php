<?php
$_SESSION['backBtn'][] = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$backBtn_count = count($_SESSION['backBtn']);
if (count($_SESSION['backBtn']) > 1) $backBtn = './' . $_SESSION['backbtn'][$backBtn_count-2];
if (count($_SESSION['backBtn']) > 4) array_splice($_SESSION['backBtn'],0,$backBtn_count-3);