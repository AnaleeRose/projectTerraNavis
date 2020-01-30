<?php
$page = 'faq';
require './assets/includes/config.inc.php';
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
        <section id="mainSection-one" class="mainSection-container">
            <div class="faqHeadingArrow-container" data-value="one">
                <h3 class="mainSection-heading subheading" data-subheading="one">What are the first steps to take before actually starting your build?</h3>
                <!-- <img class="triangle" src="" alt="Shape"> -->
                <span class="faqArrow pointArrow"></span>
            </div>
            <div class="mainSection-content">
                <p>Research, research, and more research! Our site provides a good overview of the steps to take, but you’ll need to dig deeper into each topic if you’re really serious. Start by researching the laws that would apply wherever you’re going to build. Then you’ll need to figure out how to source the materials. That many tires can be hard to find!</p>
            </div>
        </section>
        <section id="mainSection-two" class="mainSection-container">
            <div class="faqHeadingArrow-container" data-value="two">
                <h3 class="mainSection-heading subheading" data-subheading="one">Can it be built by anyone or does it require a professional?</h3>
                <span class="faqArrow pointArrow"></span>
            </div>
            <div class="mainSection-content">
                <p>One of Michael Reynolds’ main goals for earthships was to make it so regular people would be able to build them! So no experience is required, as long as you’re willing to put in the time and effort.</p>
            </div>
        </section>
        <section id="mainSection-three" class="mainSection-container">
            <div class="faqHeadingArrow-container" data-value="three">
                <h3 class="mainSection-heading subheading" data-subheading="one">What are the cons to earthships?</h3>
                <span class="faqArrow pointArrow"></span>
            </div>
            <div class="mainSection-content">
                <ul>
                    <li>They are hard work!</li>
                    <li>The laws for building a home “off the grid” can be obscure and vary by region, so navigating them can be tricky.</li>
                    <li><a href="https://en.wikipedia.org/wiki/Jerusalem_cricket">Jerusalem crickets</a>!</li>
                </ul>
            </div>
        </section>
        <section id="mainSection-four" class="mainSection-container">
            <div class="faqHeadingArrow-container" data-value="four">
                <h3 class="mainSection-heading subheading" data-subheading="one">Can it be built by anyone or does it require a professional?</h3>
                <span class="faqArrow pointArrow"></span>
            </div>
            <div class="mainSection-content">
                <p>It varies significantly depending on the process you use to build it. In theory, earthships can be very low cost, since they are built with natural and upcycled materials. In order to achieve the low-cost variety, however, you need to do all the work and gather all the materials yourself. Even so, <a href="https://archinia.com/earthships/earthship-pros-cons">according to Archinia</a>, “in the US, $150 per square foot will get you a bare-bones earthship.” They go on to say it costs “$225 per square foot to have Earthship Biotecture build your earthship.”</p>
            </div>
        </section>
    </div>
</article>

<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
