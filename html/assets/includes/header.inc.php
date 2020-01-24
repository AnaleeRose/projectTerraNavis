<header id="mainHeader" class="mainHeader
<?php if (isset($page) && strtolower($page) == 'home') echo 'homePage"';
?>
">
    <div class="navLogo-container">
        <div id="headerLogo-container" class="headerLogo-container">
            <!-- <a  href="index.php"> -->
                <a href="index.php" class="headerLogo-logo"><img src="assets/images/logo.png" alt="Terra Navis Living Logo"></a>
                <a href="index.php" class="headerLogo-header"><h1>Terra Navis Living</h1><span class="h1Tagline">A Sustainable Future with Earthships</span></a>
            <!-- </a>          -->
        </div>
        <p class="navBars-container">
          <svg class="navBars" id="navBars" xmlns="http://www.w3.org/2000/svg" width="28.945" height="22" viewBox="0 0 28.945 22">
          <g id="Group_1" data-name="Group 1" transform="translate(-145.5 -86.5)">
            <line id="Line_1" data-name="Line 1" x2="28.945" transform="translate(145.5 88.5)" fill="none" stroke="#322006" stroke-width="4"/>
            <line id="Line_2" data-name="Line 2" x2="28.945" transform="translate(145.5 97.5)" fill="none" stroke="#322006" stroke-width="4"/>
            <line id="Line_3" data-name="Line 3" x2="28.945" transform="translate(145.5 106.5)" fill="none" stroke="#322006" stroke-width="4"/>
          </g>
        </svg>

        </p>
        <div class="mainNav-container">
          <nav id="mainNav" class="mainNav">
                <a href="index.php" class="mainNav-link n_homeLink <?php if (isset($page) && strtolower($page) == 'home') echo 'currentPage';?>" >Home</a>
                <a href="sustainability.php" class="mainNav-link n_sustainLink <?php if (isset($page) && strtolower($page) == 'sustain') echo 'currentPage';?> ">Sustainability</a>
                <a href="construction.php" class="mainNav-link n_constructLink <?php if (isset($page) && strtolower($page) == 'construct') echo 'currentPage';?> ">Construction</a>
                <a href="newsfeed.php" class="mainNav-link n_newsfeedLink <?php if (isset($page) && (strtolower($page) == 'news' || strtolower($page) == 'read')) echo 'currentPage';?>">Newsfeed</a>
                <a href="resources.php" class="mainNav-link n_resourcesLink <?php if (isset($page) && strtolower($page) == 'resources') echo 'currentPage';?>">Resources</a>
                <a href="faq.php" class="mainNav-link n_faqLink <?php if (isset($page) && strtolower($page) == 'faq') echo 'currentPage';?>">FAQ</a>
                <a href="contact.php" class="mainNav-link n_contactLink<?php if (isset($page) && strtolower($page) == 'contact') echo 'currentPage';?>">Contact</a>
          </nav>
        </div>
    </div>
    <!-- Interactive Image -->
  </header>

<?php if (isset($page) && strtolower($page) == 'home') { ?>
      <div class="headerImg-container">
        <div class="plants headerImg-indi" data-hoverable="true">
          <img src="assets/images/mainGraphic/plants.png" alt="Header Image - Plants" data-hoverable="true">
          <div class="headerImg-textBox">
            <p class="tBox-heading">Heading</p>
            <p class="tBox-content">This si some content! Fill it in and have fun!!! What am i talking about? Nonsense, utter nonsense.</p>
          </div>
        </div>
<!-- @media screen and (min-width: 1200px) { -->
  <!-- .headerImg-container { -->

        <div class="solarPanels headerImg-indi" data-hoverable="true">
          <img src="assets/images/mainGraphic/solars.png" alt="Header Image">
          <div class="headerImg-textBox">
            <p class="tBox-heading">NEW Heading</p>
            <p class="tBox-content">This si some content! Fill it in and have fun!!! What am i talking about? Nonsense, utter nonsense. This si some content! Fill it in and have fun!!! What am i talking about? Nonsense, utter nonsense. This si some content! Fill it in and have fun!!! What am i talking about? Nonsense, utter nonsense.</p>
          </div>
        </div>

        <div class="bucketSpout-container headerImg-indi" data-hoverable="true">
          <img src="assets/images/mainGraphic/wellhandle.png" alt="Header Image - spout handle" class="spoutHandle headerImg-indi">
          <img src="assets/images/mainGraphic/well.png" alt="Header Image - bucket & spout" class="bucketSpout headerImg-indi">
          <span class="handleBar"></span>
          <span class="water"></span>
          <div class="headerImg-textBox">
            <p class="tBox-heading">NEW Heading</p>
            <p class="tBox-content">This si some content! Fill it in and have fun!!! What am i talking about? Nonsense, utter nonsense. This si some content! Fill it in and have fun!!! What am i talking about? Nonsense, utter nonsense. This si some content! Fill it in and have fun!!! What am i talking about? Nonsense, utter nonsense.</p>
          </div>
        </div>

        <img src="assets/images/mainGraphic/house.png" alt="Header Image - Earthship Building" class="eShip headerImg-indi" data-hoverable="true">

        <div class="turbines headerImg-indi" data-hoverable="true">
          <img src="assets/images/mainGraphic/turbines.gif" alt="Header Image - turbines">
          <div class="headerImg-textBox">
            <p class="tBox-heading">NEW Heading</p>
            <p class="tBox-content">This si some content! Fill it in and have fun!!! What am i talking about? Nonsense, utter nonsense. This si some content! Fill it in and have fun!!! What am i talking about? Nonsense, utter nonsense. This si some content! Fill it in and have fun!!! What am i talking about? Nonsense, utter nonsense.</p>
          </div>

        </div>

        <img src="assets/images/mainGraphic/eship.gif" alt="Header Image - mobile ver" class="headerImg-mobile">
      </div>
<?php } ?>
</header>
