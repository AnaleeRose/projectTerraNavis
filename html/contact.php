<?php
require './assets/includes/config.inc.php';
require './assets/includes/head.php';
?>
<body>
<!------ Header ------------>
<?php require './assets/includes/header.inc.php'; ?>


<!-- Form Functions -->
<?php require './assets/includes/form_functions.inc.php'; ?>

<!-- Main body content -->
<article id="mainContent">
    <h1 id="contact">Contact Us</h1>

    <section class="contact-icons">
        <h2 class="name">Connect With Us!</h2>
        <a href="<?= FACEBOOK_LINK; ?>"><img id="fb-icon" src="images/" alt="Facebook Icon"></a>
        <a href="<?= TWITTER_LINK; ?>"><img id="twitter-icon" src="images/" alt="Twitter Icon"></a>
        <a href="<?= PININTEREST_LINK; ?>"><img id="pin-icon" src="images/" alt="Pinterest Icon"></a>
    </section>

    <section class="contact-address">
        <img id="home-icon" src="images/" alt="Home Icon">
        <p>12777 N Rockwell Ave.<br>Oklahoma City, OK 73142</p>
    </section>
    <section class="contact-phone">
        <img id="mobile-icon" src="images/" alt="Mobile Icon">
        <p>1-888-867-5309</p>
    </section>
    <section class="contact-email">
        <img id="email-icon" src="images/" alt="Email Icon">
        <p><?= EMAIL_LINK ?></p>
    </section>
</article>

<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
