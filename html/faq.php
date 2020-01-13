<?php
require './assets/includes/config.inc.php';
$page = 'faq';
if ($page = 'faq') {
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

<article id="mainContent" class="mainContent faqPage">
    <header class="mainHeading_Container">
       <h2 class="mainHeading">Frequently Asked Questions</h2>
    </header>

<!-- Main body content -->
    <div class="mainContent-wrapper">
        <section id="mainSection-one" class="mainSection-container  faq_open">
            <div class="faqHeadingArrow-container" data-value="one">
                <h3 class="mainSection-heading subheading" data-subheading="one">Insert question here.</h3>
                <!-- <img class="triangle" src="" alt="Shape"> -->
                <span class="faqArrow pointArrow"></span>
            </div>
            <div class="mainSection-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. </p>
            </div>
        </section>
        <section id="mainSection-two" class="mainSection-container">
            <div class="faqHeadingArrow-container" data-value="two">
                <h3 class="mainSection-heading subheading" data-subheading="one">Insert question here.</h3>
                <span class="faqArrow pointArrow"></span>
            </div>
            <div class="mainSection-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. </p>
            </div>
        </section>
        <section id="mainSection-three" class="mainSection-container">
            <div class="faqHeadingArrow-container" data-value="three">
                <h3 class="mainSection-heading subheading" data-subheading="one">Insert question here.</h3>
                <span class="faqArrow pointArrow"></span>
            </div>
            <div class="mainSection-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. </p>
            </div>
        </section>
        <section id="mainSection-four" class="mainSection-container">
            <div class="faqHeadingArrow-container" data-value="four">
                <h3 class="mainSection-heading subheading" data-subheading="one">Insert question here.</h3>
                <span class="faqArrow pointArrow"></span>
            </div>
            <div class="mainSection-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. </p>
            </div>
        </section>
    </div>
</article>

<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
