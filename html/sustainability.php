<?php
require './assets/includes/config.inc.php';
$page = 'Sustain';
if ($page = 'Sustain') {
?>
<style type="text/css">
  :root {
      --pageColor: var(--sustain);
      --pageColor-shade: var(--sustain-shade);
      --pageColor-link: var(--sustain-link);
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
    		    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. Sit amet consectetur adipiscing elit ut. Lacus sed turpis tincidunt id aliquet risus. Maecenas ultricies mi eget mauris pharetra et ultrices. Lorem ipsum dolor sit amet. Viverra justo nec ultrices dui sapien. Egestas maecenas pharetra convallis posuere. Mi sit amet mauris commodo quis imperdiet massa tincidunt.</p>
    		</div>
    	</section>

        <section id="mainSection-two" class="mainSection-container">
    	    <h3 class="mainSection-heading subheading" data-subheading="two">Growing Your Own Food</h3>
            <div class="mainSection-content">
    	    	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. Sit amet consectetur adipiscing elit ut. Lacus sed turpis tincidunt id aliquet risus. Maecenas ultricies mi eget mauris pharetra et ultrices. Lorem ipsum dolor sit amet. Viverra justo nec ultrices dui sapien. Egestas maecenas pharetra convallis posuere. Mi sit amet mauris commodo quis imperdiet massa tincidunt.</p>
    		</div>
    	</section>

        <section id="mainSection-three" class="mainSection-container">
    	    <h3 class="mainSection-heading subheading" data-subheading="three">Water Collection</h3>
            <div class="mainSection-content">
    	        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. Sit amet consectetur adipiscing elit ut. Lacus sed turpis tincidunt id aliquet risus. Maecenas ultricies mi eget mauris pharetra et ultrices. Lorem ipsum dolor sit amet. Viverra justo nec ultrices dui sapien. Egestas maecenas pharetra convallis posuere. Mi sit amet mauris commodo quis imperdiet massa tincidunt.</p>
    		</div>
    	</section>

        <section id="mainSection-four" class="mainSection-container">
            <h3 class="mainSection-heading subheading" data-subheading="four">Recycling</h3>
            <div class="mainSection-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. Sit amet consectetur adipiscing elit ut. Lacus sed turpis tincidunt id aliquet risus. Maecenas ultricies mi eget mauris pharetra et ultrices. Lorem ipsum dolor sit amet. Viverra justo nec ultrices dui sapien. Egestas maecenas pharetra convallis posuere. Mi sit amet mauris commodo quis imperdiet massa tincidunt.</p>
    		</div>
        </section>
    </div>
</article>
<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
