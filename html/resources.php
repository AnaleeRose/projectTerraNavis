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
       <h2 class="mainHeading">Resources</h2>
    </header>

    <p id="cursor-container" class="cursor-container">
      <svg id="cursor" class="cursor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="61" height="83" viewBox="0 0 61 83">
        <defs>
          <linearGradient id="linear-gradient" x1="0.5" y1="0.315" x2="0.5" y2="1" gradientUnits="objectBoundingBox">
            <stop offset="0" stop-color="var(--cursorColor)"/>
            <stop offset="1" stop-color="var(--cursorColor-shade)"/>
          </linearGradient>
        </defs>
        <path id="Polygon_24" data-name="Polygon 24" d="M41.5,0,83,61H0Z" transform="translate(61) rotate(90)" fill="url(#linear-gradient)"/>
      </svg>
    </p>

    <div class="mainContent-wrapper">
        <section id="mainSection-one" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="one">Design and Construction</h3>
            <div class="mainSection-content">
                <ul class="resourcesList">
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                </ul>
            </div>
        </section>
        <section id="mainSection-two" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="two">Materials</h3>
            <div class="mainSection-content">
                <ul class="resourcesList">
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                </ul>
            </div>
        </section>
        <section id="mainSection-three" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="three">News Sources</h3>
            <div class="mainSection-content">
                <ul class="resourcesList">
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                </ul>
            </div>
        </section>
        <section id="mainSection-four" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="four">Building Codes</h3>
            <div class="mainSection-content">
                <ul class="resourcesList">
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                    <li><a href="">Resource Name goes here.</a></li>
                </ul>
            </div>
        </section>

        <section id="mainSection-four" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="four">Site Sources</h3>
            <div class="mainSection-content">
                <ul class="resourcesList">
                    <li>Icons provided by <a href="https://www.flaticon.com/authors/kiranshastry" title="Kiranshastry">Kiranshastry</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></li>
                </ul>
            </div>
        </section>
    </div>
</article>


<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
