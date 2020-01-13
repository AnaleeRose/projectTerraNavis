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
            <h3 class="mainSection-heading subheading" data-subheading="one">Verification is On The Way!</h3>
            <div class="mainSection-content">
				<p>We'll email you within 24 hours to verify your address. Once you click the link in the email, we can start sending you some of the best eco-friendly earthship news!</p>
				<a class="readmore" href="index.php">Return To Home</a>
            </div>
        </section>
    </div>
</article>

<?php require './assets/includes/footer.inc.php'; ?>

