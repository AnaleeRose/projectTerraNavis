<?php
require './assets/includes/config.inc.php';
$page = 'construct';
require './assets/includes/head.php';
?>

<body class="">
<!------ Header ------------>
<?php require './assets/includes/header.inc.php'; ?>
<!-- Main body content -->
<article id="mainContent" class="multiContentPage mainContent">
    <header class="mainHeading_Container">
       <h2 class="mainHeading">Construction</h2>
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
            <h3 class="mainSection-heading subheading" data-subheading="one">Designing Your Earthship</h3>
            <div class="mainSection-content">
               <p>There are several companies that will help you design your earthship. Earthship Biotecture is the leading company in this area, which makes sense because it was founded by Michael Reynolds himself. Another popular company is Pangea Builders. If you choose to go your own route, there are some basic principles to keep in mind.</p>

    	         <p>The shape of your design is an important factor in how sustainable your home will be. A v-shape is generally the way to go, since the slant makes it easier to collect water, and it regulates temperatures better due to being partially underground. However, the materials you plan on using and the topography of your location could make another shape work better for your specific case.</p>

                <img class="wrap" src="./assets/images/blueprint.png">

                <p>When choosing a site for the excavation, you must consider the angle of the sun, as its light its crucial for providing energy through solar panels and for regulating temperatures within the structure. For wind power, obstructions like hills and trees are important to avoid in order to maximize efficiency of energy production.</p>

               
                <p>Another factor to consider is the soil at the location you choose. If you’re planning on growing your own food, the plants obviously need the right soil to be able to thrive. It’s recommended to dig about five feet or more into the ground, depending on conditions such as how wet the climate is (wetter = deeper!). Keep the soil you excavate in good condition, since it will be used later in the construction process.</p>

            </div>
    	</section>

        <section id="mainSection-two" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="two">Building Materials</h3>
            <div class="mainSection-content">
               <p>How you choose the materials to use may be the most important aspect of planning the construction of your home. This is because, while the world has an abundance of renewable materials, the ease with which these materials can be acquired varies greatly. The most common materials are used tires and dirt bags for exterior and load-bearing walls, recycled cans and bottles for interior and upper walls, and trusses or vigas for the roof.</p>

               <img class="wrap" src="./assets/images/tires.png">

               <p>Tires might be the most important material you need, and unfortunately sometimes they can be the hardest to gather. You’re going to need a lot of tires to build an earthship, and the larger you plan on making it, the more you will need. Most of the time, you’ll have to buy them in bulk from used tire dealers and the like. Otherwise, you could spend years trying to gather them yourself. So this will probably be a major aspect of your budget as well.</p>


               <p>Tin cans, plastic bottles, and glass bottles for the interior walls are relatively easy to find. You can contact local waste management facilities to see if they’ll let you gather materials. These things are often discarded all around the world, so just be on the lookout for them wherever you go!</p>

            </div>
    	</section>

        <section id="mainSection-three" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="three">Building Your Earthship</h3>
            <div class="mainSection-content">
               <p>“Rammed-earth” tires will be the main building blocks of the structure, making up most outer walls and supporting interior walls. Since these can be up to 300lbs, they are usually packed with earth right where they’ll sit on the wall. This is usually a two-person job, as one person pours earth into the tires while the other person uses a sledgehammer to pound the dirt into the tires as tightly as possible. The tires should be placed just like normal bricks, with one tire on top between the two tires on bottom. Concrete or clay can be used as filler between tires to reinforce the walls. It’s important to completely cover any tires that will be inside the home with concrete or something similar, because tires continually give off small amounts of toxic gasses!</p>

               <img class="wrap" src="./assets/images/tools.png">

               <p>The interior walls can be made out of tin cans, as they are relatively easy to find and gather. The cans are joined by concrete or mud in a honeycomb pattern. This is where glass bottles can be utilized as well. For any back rooms that will have a hard time getting sunlight, glass bottle walls can be placed in strategic spots to funnel more sunlight wherever you want it to go.</p>

               <p>For the roof, a either a truss or vigas will work. A truss is a structure made by forming a series of triangles with wood or metal poles. Any roofing materials like tin cans and dried grass can be joined to the roofing structure, with the ceiling joined at the bottom.</p>


            </div>
    	</section>

        <section id="mainSection-four" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="four">Building It To Code</h3>
            <div class="mainSection-content">
               <p>One of the greatest challenges to building an earthship is dealing with so many municipal codes and regulations. That’s why a large percentage of earthship dwellers live in new mexico, where there is already a knowledgeable culture and comparatively friendly laws.</p>

               <p>Zoning laws in the U.S. and Canada can be very complex and change depending on which state/county/city you are building in. If you can afford it, a lawyer can help you navigate all of this. However, it is certainly possible to navigate laws yourself. It just requires a lot of research and patience.</p>

               <img class="wrap" src="./assets/images/buildcodes.png">

               <p>In New Mexico, for example, all buildings and structures (with very few exceptions for small projects) require a permit from the building official before beginning construction. Your septic tank and electrical system will require separate permits. And in order to get a building permit, you must get zoning approval and a signature on your permit application.</p>

               <p>There’s far too much information on zoning laws to cover here, so make sure to do some in-depth research before planning your Earthship.</p>

               <p>select</p>
            </div>
        </section>
    </div>
</article>

<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
