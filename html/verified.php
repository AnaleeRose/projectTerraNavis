<?php
$verified = false;
if (isset($_GET['vn'])) {
	require(MYSQL);
	// $v_num = $_GET['vn'];
	// $q = "SELECT * FROM email_list WHERE verification_num = " . $v_num;
	// $r = mysqli_query($dbc,$q);
	// if ($r) {
	// 	$q = "UPDATE `email_list` SET `verified` = '1' WHERE `verification_number` = " . $v_num;
	// 	$r = mysqli_query($dbc, $q);
	// 	if ($r) {
	// 		$verified = true;
	// 	}
	// }
}
require './assets/includes/config.inc.php';
$page = 'resources';
if ($page = 'resources') {
?>
<style type="text/css">
  :root {
      --pageColor: var(--faq);
      --pageColor-shade: var(--faq-shade);
      --pageColor-link: var(--faq-link);
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
      <?php if ($verified == true) { ?>
       	<h2 class="mainHeading">Verified!</h2>
       <?php } else { ?>
       	<h2 class="mainHeading">Hmm...</h2>
       <?php } ?>
    </header>

    <div class="mainContent-wrapper">
        <section id="mainSection-one" class="mainSection-container">
        	<?php if ($verified == true) { ?>
	            <h3 class="mainSection-heading subheading" data-subheading="one">Your Email Has Been Verified</h3>
	            <div class="mainSection-content">
					<p>Thank you for verifying your email. We can't wait to send you updates and earthiship news!</p>
					<a class="readmore" href="index,php">Return To Home</a>
	            </div>
            <?php } else { ?>
	            <h3 class="mainSection-heading subheading" data-subheading="one">Your Email Could Not Be Verified</h3>
	            <div class="mainSection-content">
					<p>Hmm, something went wrong. We will attempt to reach out to you but you can also contact us at our <a href="contact.php">contact page</a> to resolve this issue. Thank you for your patience.</p>
					<a class="readmore" href="index,php">Return To Home</a>
	            </div>
            <?php } ?>
        </section>
    </div>
</article>

<?php require './assets/includes/footer.inc.php'; ?>

