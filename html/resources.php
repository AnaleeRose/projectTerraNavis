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
<article id="mainContent" class="multiContentPage mainContent resourcesPage">
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
            <h3 class="mainSection-heading subheading" data-subheading="one">General</h3>
            <div class="mainSection-content">
                <ul class="resourcesList">
                    <li>
                        <a href="https://www.conserve-energy-future.com/earthship-construction-design-and-examples.php">Kukreja, Rinkesh. “What is a Earthship?” Conserve Energy Future</a>
                        <small class="dateSource-info">2017. Web.</small>
                    </li>
                    <li>
                        <a href="https://www.britannica.com/topic/Earthship">Elizabeth R. Purdy. "Earthship", Encyclopædia Britannica, inc.</a>
                        <small class="dateSource-info">2017. Web.</small>
                    </li>

                    <li>
                        <a href="https://waterwisegroup.com/greywater-education/what-is-greywater/">Water Wise Group. "Greywater Education", Water Wise Group, Inc.</a>
                        <small class="dateSource-info">Web.</small>
                    </li>

                    <!-- example resource -->
<!--                     <li>
                        <a href="www.smartcitiesdive.com/ex/sustainablecitiescollective/sustainable-homes-earthship/1156549 ">Resource Name goes here.</a>
                        <small class="dateSource-info">Date, Medium</small>
                    </li> -->
                </ul>
            </div>
        </section>

        <section id="mainSection-two" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="two">Design and Construction</h3>
            <div class="mainSection-content">
                <ul class="resourcesList">
                    <li>
                        <a href="https://www.smartcitiesdive.com/ex/sustainablecitiescollective/sustainable-homes-earthship/1156549">Reynolds, Michael. “Design Principles.” EarthshipGlobal, Earthship Biotecture</a>
                        <small class="dateSource-info">2016. Web.</small>
                    </li>

                </ul>
            </div>
        </section>

<!--         <section id="mainSection-three" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="three">News Sources</h3>
            <div class="mainSection-content">
                <ul class="resourcesList">

                </ul>
            </div>
        </section> -->
        
        <section id="mainSection-four" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="four">Building Codes</h3>
            <div class="mainSection-content">
                <ul class="resourcesList">
                    <li><a href="https://pangeabuilders.com/permits-codes-regulations/">“Permits, Codes & Regulations,” Permits, Pangea Builders</a></li>
                </ul>
            </div>
        </section>

<!--         <section id="mainSection-four" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="four">Site Sources</h3>
            <div class="mainSection-content">
                <ul class="resourcesList">
                    <li> provided by <a href="https://www.flaticon.com/authors/kiranshastry" title="Kiranshastry">Kiranshastry</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></li>
                </ul>
            </div>
        </section> -->
    </div>
</article>


<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
