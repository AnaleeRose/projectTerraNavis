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
<article id="mainContent" class="thxPage mainContent">
    <header class="mainHeading_Container">
       <h2 class="mainHeading">Thank you!</h2>
    </header>

    <div class="mainContent-wrapper">
        <section id="mainSection-one" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="one">Thank you!</h3>
            <div class="mainSection-content">
              <?php if ($_GET['p'] == 'n') {  ?>
        				<p>You've been added to the subscription list. We'll be sending you some of the best eco-friendly earthship news!</p>
              <?php } elseif($_GET['p'] == 'cn') { ?>
                <p>You've been added to the subscription list and your message was sent. We'll do our best to respond quickly!</p>
              <?php } elseif($_GET['p'] == 'c') { ?>
                <p>Your message was sent. We'll do our best to respond quickly!</p>
              <?php }?>
                <a class="readmore" href="index.php">Return To Home</a>
            </div>
        </section>
    </div>
</article>

<?php require './assets/includes/footer.inc.php'; ?>

