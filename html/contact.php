<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Terra Navis | Our Team</title>
    <meta name="description" content="Earthship bio-friendly homes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<!------ Header ------------>
<?php require './assets/includes/header.php'; ?>


<!-- Form Functions -->
<?php require './assets/includes/form_functions.inc.php'; ?>

<!-- Main body content -->
<h1 id="contact">Contact Us</h1>



<div class="contact-icons">
    <h2 class="name">Connect With Us!</h2>
    <a href="<?= FACEBOOK_LINK; ?>"><img id="fb-icon" src="images/" alt="Facebook Icon"></a>
    <a href="<?= TWITTER_LINK; ?>"><img id="twitter-icon" src="images/" alt="Twitter Icon"></a>
    <a href="<?= PININTEREST_LINK; ?>"><img id="pin-icon" src="images/" alt="Pinterest Icon"></a>
</div>

<div class="contact-address">
    <img id="home-icon" src="images/" alt="Home Icon">
    <p>12777 N Rockwell Ave.<br>Oklahoma City, OK 73142</p>
</div>
<div class="contact-phone">
    <img id="mobile-icon" src="images/" alt="Mobile Icon">
    <p>1-888-867-5309</p>
</div>
<div class="contact-email">
    <img id="email-icon" src="images/" alt="Email Icon">
    <p><?= EMAIL_LINK ?></p>
</div>

<!------ Footer ------------>
​<?php require './assets/includes/footer.php'; ?>

</body>
</html>
