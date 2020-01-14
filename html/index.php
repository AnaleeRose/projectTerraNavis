<?php
require './assets/includes/config.inc.php';
$page = 'Home';
if ($page = 'Home') {
?>
<style type="text/css">
  :root {
      --pageColor: var(--home);
      --pageColor-shade: var(--home-shade);
      --pageColor-link: var(--home-link);
  }
</style>
<?php
}
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
            <stop offset="0" stop-color="var(--pageColor)"/>
            <stop offset="1" stop-color="var(--pageColor-shade)"/>
          </linearGradient>
        </defs>
        <path id="Polygon_24" data-name="Polygon 24" d="M41.5,0,83,61H0Z" transform="translate(61) rotate(90)" fill="url(#linear-gradient)"/>
      </svg>
    </p>

    <div class="mainContent-wrapper">
      <section id="mainSection-one" class="mainSection-container">
          <h3 class="mainSection-heading subheading" data-subheading="one">What is an Earthship?</h3>
          <div class="mainSection-content">
              <p>Earthships are a type of passive solar earth shelter first conceptualized by architect <a href="https://en.wikipedia.org/wiki/Mike_Reynolds_(architect)" target="_blank">Michael Reynolds</a>. They are built with a combination of upcycled and natural resources, like recycled glass bottles, tires packed with earth, and other, reclaimed materials. Reynolds developed the concept to realize three goals:
                  <ul>
                      <li><p>Utilize sustainable architecture and materials which can be recycled or naturally sourced from local environments</p></li>
                      <li><p>Build an "off-the-grid" home that would rely entirely on natural energy sources.</p></li>
                      <li><p>Make the building process feasible for a person without any specialized construction skills.</p></li>
                  </ul>
              </p>
              <a class="mainSection-readMore">Visit Our FAQ</a>

          </div>
      </section>
      ​
      <section id="mainSection-two" class="mainSection-container">
          <h3 class="mainSection-heading subheading" data-subheading="two">Sustainable Living</h3>
          <div class="mainSection-content">
              <p>There’s green, and then there’s <strong>green</strong>! Michael Reynolds dreamed of creating an ultra eco-friendly way of living with his Earthship designs. These principles led to an extreme minimum in waste by using such methods as building with mostly upcycled materials, collecting rain water, using solar and wind energy, implementation of black and grey water systems to feed into outdoor gardens to aid in the growing of ones own food. When all of these concepts are brought together in a single design, you get one of the most eco-friendly home options available to us today.</p>
              <a class="mainSection-readMore">Learn More About Sustainable Living</a>
          </div>
      </section>
      ​
      <section id="mainSection-three" class="mainSection-container">
          <h3 class="mainSection-heading subheading" data-subheading="three">Building Your Earthship</h3>
          <div class="mainSection-content">
              <p>Earthships contain both recycled and natural materials, earning them the label of “carbon-zero” homes. Walls are constructed using the “rammed-earth” method with old tires as the building blocks and glass bottles surrounded by concrete to create bottle-walls that bring natural light into the structure. The front of the earthship contains large glass panels to bring more light in, while also creating a section to act as a greenhouse for the growing of vegetation year round lending to a sustainable source of food. With traditional plumbing and electrical running throughout the earthship, albeit powered by solar and wind energy, this allows for modern living in ultra green home! </p>
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


