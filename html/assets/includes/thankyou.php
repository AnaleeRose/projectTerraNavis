<?php
require './assets/includes/config.inc.php';
$page = 'resources';
if ($page = 'resources') {
?>
<style type="text/css">
  :root {
      --pageColor: var(--resources);
      --pageColor-shade: var(--resources-shade);
      --pageColor-link: var(--resources-link);
  }
</style>
<?php
}
require './assets/includes/head.php';
?>

<body class="">
<!------ Header ------------>
<?php require './assets/includes/header.inc.php'; ?>

<!-- Main body content -->
<article id="mainContent" class="multiContentPage mainContent">
    <header class="mainHeading_Container">
       <h2 class="mainHeading">Thank you!</h2>
    </header>

    <div class="mainContent-wrapper">
        <section id="mainSection-one" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="one">We'll </h3>
            <div class="mainSection-content">
                <ul class="resourcesList">
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                </ul>
            </div>
        </section>
    </div>
</article>
