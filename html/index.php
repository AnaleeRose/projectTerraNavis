<?php
require './assets/includes/config.inc.php';
$page = 'Home';
require './assets/includes/head.php';
?>

<body class="homeBody">
<!------ Header ------------>
<?php require './assets/includes/header.inc.php'; ?>

<!-- Main body content -->
<article id="mainContent" class="homeMainContent mainContent">
    <header class="mainHeading_Container">
        <h2 class="mainHeading">Terra Navis Living</h2>
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
          <h3 class="mainSection-heading subheading hidden" data-subheading="one">What is an Earthship?</h3>
          <div class="mainSection-content">
              <p>Earthships are a type of self-sustainable, eco-friendly home first conceptualized by architect <a href="https://en.wikipedia.org/wiki/Mike_Reynolds_(architect)" target="_blank">Michael Reynolds</a>. These passive-solar shelters are built into the ground with a combination of upcycled and natural resources, like recycled glass bottles, tires packed with earth, and other reclaimed materials. Reynolds developed the concept to realize three goals:</p>
                  <ol>
                      <li><p>Utilize sustainable architecture and materials that can be recycled or naturally sourced from local environments</p></li>
                      <li><p>Build an “off-the-grid” home that would rely entirely on natural energy sources</p></li>
                      <li><p>Make the building process feasible for someone with no specialized construction skills</p></li>
                  </ol>
              <a class="mainSection-readMore" href="faq.php">Visit Our FAQ</a>

          </div>
      </section>
      ​
      <section id="mainSection-two" class="mainSection-container">
          <h3 class="mainSection-heading subheading" data-subheading="two">Sustainable Living</h3>
          <div class="mainSection-content">
              <p>There’s green, and then there’s green. Michael Reynolds dreamed of creating an ultra eco-friendly way of living with his Earthship designs. These principles led to an extreme minimum in waste by building with mostly recycled materials, collecting rainwater, using solar and wind energy, and implementing black and grey water systems to feed into outdoor gardens to aid in the growing of one's own food. When all of these concepts are brought together in a single design, you get one of the most eco-friendly home options available to us today.</p>
              <a class="mainSection-readMore">Learn More About Sustainable Living</a>
          </div>
      </section>
      ​
      <section id="mainSection-three" class="mainSection-container">
          <h3 class="mainSection-heading subheading" data-subheading="three">How is an earthship built?</h3>
          <div class="mainSection-content">
              <p>Most outer walls and load-bearing interior walls are constructed by packing used tires with compacted soil, creating strong building blocks. Some walls utilize aluminum cans, plastic bottles, and especially glass bottles surrounded by concrete to create bottle-walls that allow light to flow through the structure, thus lighting up inner rooms that otherwise wouldn’t have any source of natural light. Many earthships have one section on the exterior with large glass panels to bring more light in and act as a greenhouse for growing vegetation year round, helping to create a sustainable food source. Typically, traditional plumbing and electrical systems are run throughout the earthship--albeit powered by solar and wind energy-- allowing for modern living in an ultra green home!</p>
              <a class="mainSection-readMore">Learn More About Building Earthships</a>
              <div class="bg-img-container">
             </div>
          </div>
      </section>
    </div>
</article>

<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>


