<?php
require './assets/includes/config.inc.php';
$page = 'Sustain';
require './assets/includes/head.php';
?>

<body class="">
<!------ Header ------------>
<?php require './assets/includes/header.inc.php'; ?>
<!-- Main body content -->
<article id="mainContent" class="multiContentPage mainContent">
    <header class="mainHeading_Container">
	   <h2 class="mainHeading">Sustainability</h2>
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
    	    <h3 class="mainSection-heading subheading" data-subheading="one">Powering Your Earthship</h3>
            <div class="mainSection-content">
              <img src="./assets/images/tires.png">
              <p>One of the big questions about an earthship’s sustainability is, “how do you power an off-grid home?” With the advent of so many different techniques for generating clean, renewable energy, it would seem like a daunting task to pick just one! The answer is probably whatever works best for your particular situation. However, there are two popular forms of power generation you can go with, and a third, more controversial method that’s typically only used as a backup.</p>

              <p>The first (and often the best) option is solar power. As the design of an Earthship makes it ideal for dry/arid locales where the number of sunny days is higher than average, solar energy is the most abundant source of renewable energy for Earthships.</p>

              <p>The second option is wind energy, but it is generally still combined with solar power, as the winds within the typical desert setting of most earthships are not as reliable as that of the sun. Utilizing multiple methods like these allows you to maintain more consistent power generation throughout the year.</p>

              <p>The last method is propane or natural gas. The principles of an Earthship are to be as sustainable as possible, while minimizing waste. As propane and natural gas are not renewable energy sources, this seems to go directly against these principles. However, this method is typically used only as a form of backup power should an unforeseen problem arise that negates your ability to generate power from solar or wind. Specialized batteries may be able to safeguard your energy system as well.</p>
      		</div>
    	</section>

        <section id="mainSection-two" class="mainSection-container">
    	    <h3 class="mainSection-heading subheading" data-subheading="two">Growing Your Own Food</h3>
            <div class="mainSection-content">
      	    	<p>The ability to grow one's own food is a crucial part of the culture of self-reliance that earthships are all about. Most earthships will have a large, windowed area in the front of the structure that is facing out from the earth mound it’s set into. This area is typically used as both a temperature buffer and greenhouse. By having an area of the earthship that gets sun all year round, you maintain a consistent ability to grow your own food!</p>

              <p>To start, create a planting area of soil within the greenhouse area of the earthship. Once this is done you can plant your favorite vegetables or fruits and start your journey of food based self reliance. Even small fruit bearing trees can be planted in some earthship designs! While the greenhouse area of your earthship serves as a great location for year-round growing, you can also utilize the surrounding area outside your home during the Spring and Summer months to grow additional (and more varied) food.</p>
      		</div>
    	</section>

        <section id="mainSection-three" class="mainSection-container">
    	    <h3 class="mainSection-heading subheading" data-subheading="three">Water Collection</h3>
            <div class="mainSection-content">
      	        <p>Now we come to one of the most challenging aspects of living in an earthship: how do you get your water? With the dry and arid nature of the usual earthship locale, water collection can be a daunting task to overcome. Typical rainfall in these locations is less than 11 inches per year, so simple rainwater collection alone will not sustain you. That being said, rainwater collection should still be used to maximize the amount of water you are able to bring in, and storing this water is important, as it can sometimes be months between rainy weather.</p>

                <p>Another, more tedious way to get water for your earthship is to bring outside water into your earthship via water trucks or small, portable water containers that you can fill while you are away from home and bring back with you. This can be a deal breaker for some who are considering building an earthship.</p>

                <p>With proper planning, however, these problems can be avoided altogether. When looking for a location to build an earthship, one of your top priorities should be to find an underground water source where a well can be drilled. Not only is hauling water in a pain, but also costly in the long run, and if it can be avoided, it absolutely should be.</p>
      		</div>
    	</section>

        <section id="mainSection-four" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="four">Recycling</h3>
            <div class="mainSection-content">
              <p>As resources are finite and sometimes hard to come by in the remote locations most earthship-dwellers live in, recycling everything you can is a must. Starting with your most scarce resource, water. There are many ways to recycle your grey and black water waste. Grey water is a bit easier, as it can be stored and reused to flush toilets water your greenhouse plants. The black water (sewer water) can be irrigated into an outdoor garden to fertilize and water outdoor plants.</p>

              <p>A staple of sustainability in an earthship, vegetables and fruit are a large part of your diet. You can compost fruits, vegetables, and any other plants you get rid of, and use them to fertilize your gardens. This especially useful in the greenhouse, as using black water for fertilizer can produce some strong odors, making it better suited for use in well-ventilated environments.</p>
      		</div>
        </section>
    </div>
</article>
<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
