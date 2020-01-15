<header id="mainHeader" class="mainHeader
<?php if (isset($page) && strtolower($page) == 'home') echo 'homePage"';
?>
">
    <div class="navLogo-container">
        <div id="headerLogo-container" class="headerLogo-container">
            <!-- <a  href="index.php"> -->
                <a href="index.php" class="headerLogo-logo"><img src="assets/images/404duck.png" alt="Terra Navis Living Logo"></a>
                <a href="index.php" class="headerLogo-header"><h1>Terra Navis Living</h1></a>
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
      <div class="tempHeaderImg">
        <img src="assets/images/temp.png" alt="Header Image">
    </div>
<!--     <div id="animatedbg">
        <div class="waterFillingBucketContainer">
            <div class="animImg_bucket">
                <p class="animImg_bucket_bgFill"></p>
            </div>
            <div class="animImg_waterSpout">
                <p class="animImg_faucet"></p>
            </div>
        </div>
        <div class="windmillContainer">
            <div class="windmill windmill_1">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="127" height="629.688" viewBox="0 0 127 629.688" class="windmill_base">
                  <defs>
                    <radialGradient id="radial-gradient" cx="0.222" cy="0.36" r="0.667" gradientTransform="translate(0 0)" gradientUnits="objectBoundingBox">
                      <stop offset="0" stop-color="#e4e7e8"/>
                      <stop offset="1" stop-color="#2e393b"/>
                    </radialGradient>
                    <radialGradient id="radial-gradient-2" cx="0.237" cy="0.141" r="0.666" gradientTransform="matrix(0.727, 0.687, -0.584, 0.618, 0.147, -0.109)" gradientUnits="objectBoundingBox">
                      <stop offset="0" stop-color="#ecedee"/>
                      <stop offset="1" stop-color="#545b5d"/>
                    </radialGradient>
                  </defs>
                  <g id="Group_101" data-name="Group 101" transform="translate(-319 -278.363)">
                    <path id="Path_138" data-name="Path 138" d="M17.041,0C34.387,0,48.449,34.919,48.449,77.994L76,618.476H-32L-14.367,77.994C-14.367,34.919-.305,0,17.041,0Z" transform="translate(370 289.575)" fill="url(#radial-gradient)"/>
                    <path id="Path_142" data-name="Path 142" d="M54-16c1.591,0,34.4-6.957,38-6.625C108.275-11.775,119.917-7.546,122,2c2.25,10.3-30.75,17-52,35-.475,20.975-12.565,37-33,37A37,37,0,0,1,0,37C0,16.565.163-11,54-16Z" transform="translate(319 301)" fill="url(#radial-gradient-2)"/>
                  </g>
                </svg>

                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="831.868" height="831.868" viewBox="0 0 831.868 831.868" class="windmill_wings">
                  <defs>
                    <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1" gradientUnits="objectBoundingBox">
                      <stop offset="0" stop-color="#d4dcde"/>
                      <stop offset="1" stop-color="#2e393b"/>
                    </linearGradient>
                  </defs>
                  <g id="Group_103" data-name="Group 103" transform="matrix(0.799, 0.602, -0.602, 0.799, 681.552, -113.205)">
                    <circle id="Ellipse_12" data-name="Ellipse 12" cx="297" cy="297" r="297" transform="translate(-190.689 285.442)" fill="rgba(94,43,43,0)"/>
                    <g id="Group_102" data-name="Group 102" transform="matrix(0.966, 0.259, -0.259, 0.966, 64.125, 44.999)">
                      <path id="Path_143" data-name="Path 143" d="M-10.2,0C-2.495,0,3.755,15.131,3.755,33.8L16,268H-32l7.837-234.2C-24.163,15.131-17.914,0-10.2,0Z" transform="translate(410.557 646.467) rotate(120)" fill="url(#linear-gradient)"/>
                      <path id="Path_144" data-name="Path 144" d="M-10.2,0C-2.495,0,3.755,15.131,3.755,33.8L16,268H-32l7.837-234.2C-24.163,15.131-17.914,0-10.2,0Z" transform="translate(-49.538 632.611) rotate(-120)" fill="url(#linear-gradient)"/>
                      <path id="Path_145" data-name="Path 145" d="M-11.225,0C-3.876,0,2.081,14.423,2.081,32.214L13.753,255.452H-32l7.47-223.238C-24.53,14.423-18.573,0-11.225,0Z" transform="translate(190.634 250.087)" fill="url(#linear-gradient)"/>
                    </g>
                  </g>
                </svg>



                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="78.984" height="85.949" viewBox="0 0 78.984 85.949" class="windmill_nose">
                  <defs>
                    <radialGradient id="radial-gradient" cx="0.286" cy="0.407" r="0.5" gradientUnits="objectBoundingBox">
                      <stop offset="0" stop-color="#fff"/>
                      <stop offset="1" stop-color="#747878"/>
                    </radialGradient>
                  </defs>
                  <ellipse id="Ellipse_10" data-name="Ellipse 10" cx="35" cy="39" rx="35" ry="39" transform="translate(9.506) rotate(7)" fill="url(#radial-gradient)"/>
                </svg>
            </div>

            <div class="windmill windmill_2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="127" height="629.688" viewBox="0 0 127 629.688" class="windmill_base">
                  <defs>
                    <radialGradient id="radial-gradient" cx="0.222" cy="0.36" r="0.667" gradientTransform="translate(0 0)" gradientUnits="objectBoundingBox">
                      <stop offset="0" stop-color="#e4e7e8"/>
                      <stop offset="1" stop-color="#2e393b"/>
                    </radialGradient>
                    <radialGradient id="radial-gradient-2" cx="0.237" cy="0.141" r="0.666" gradientTransform="matrix(0.727, 0.687, -0.584, 0.618, 0.147, -0.109)" gradientUnits="objectBoundingBox">
                      <stop offset="0" stop-color="#ecedee"/>
                      <stop offset="1" stop-color="#545b5d"/>
                    </radialGradient>
                  </defs>
                  <g id="Group_101" data-name="Group 101" transform="translate(-319 -278.363)">
                    <path id="Path_138" data-name="Path 138" d="M17.041,0C34.387,0,48.449,34.919,48.449,77.994L76,618.476H-32L-14.367,77.994C-14.367,34.919-.305,0,17.041,0Z" transform="translate(370 289.575)" fill="url(#radial-gradient)"/>
                    <path id="Path_142" data-name="Path 142" d="M54-16c1.591,0,34.4-6.957,38-6.625C108.275-11.775,119.917-7.546,122,2c2.25,10.3-30.75,17-52,35-.475,20.975-12.565,37-33,37A37,37,0,0,1,0,37C0,16.565.163-11,54-16Z" transform="translate(319 301)" fill="url(#radial-gradient-2)"/>
                  </g>
                </svg>



                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="831.868" height="831.868" viewBox="0 0 831.868 831.868" class="windmill_wings">
                  <defs>
                    <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1" gradientUnits="objectBoundingBox">
                      <stop offset="0" stop-color="#d4dcde"/>
                      <stop offset="1" stop-color="#2e393b"/>
                    </linearGradient>
                  </defs>
                  <g id="Group_103" data-name="Group 103" transform="matrix(0.799, 0.602, -0.602, 0.799, 681.552, -113.205)">
                    <circle id="Ellipse_12" data-name="Ellipse 12" cx="297" cy="297" r="297" transform="translate(-190.689 285.442)" fill="rgba(94,43,43,0)"/>
                    <g id="Group_102" data-name="Group 102" transform="matrix(0.966, 0.259, -0.259, 0.966, 64.125, 44.999)">
                      <path id="Path_143" data-name="Path 143" d="M-10.2,0C-2.495,0,3.755,15.131,3.755,33.8L16,268H-32l7.837-234.2C-24.163,15.131-17.914,0-10.2,0Z" transform="translate(410.557 646.467) rotate(120)" fill="url(#linear-gradient)"/>
                      <path id="Path_144" data-name="Path 144" d="M-10.2,0C-2.495,0,3.755,15.131,3.755,33.8L16,268H-32l7.837-234.2C-24.163,15.131-17.914,0-10.2,0Z" transform="translate(-49.538 632.611) rotate(-120)" fill="url(#linear-gradient)"/>
                      <path id="Path_145" data-name="Path 145" d="M-11.225,0C-3.876,0,2.081,14.423,2.081,32.214L13.753,255.452H-32l7.47-223.238C-24.53,14.423-18.573,0-11.225,0Z" transform="translate(190.634 250.087)" fill="url(#linear-gradient)"/>
                    </g>
                  </g>
                </svg>



                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="78.984" height="85.949" viewBox="0 0 78.984 85.949" class="windmill_nose">
                  <defs>
                    <radialGradient id="radial-gradient" cx="0.286" cy="0.407" r="0.5" gradientUnits="objectBoundingBox">
                      <stop offset="0" stop-color="#fff"/>
                      <stop offset="1" stop-color="#747878"/>
                    </radialGradient>
                  </defs>
                  <ellipse id="Ellipse_10" data-name="Ellipse 10" cx="35" cy="39" rx="35" ry="39" transform="translate(9.506) rotate(7)" fill="url(#radial-gradient)"/>
                </svg>
            </div>
        </div>
    </div> -->
<?php } elseif (1==3) {?>
    <div id="animatedbg"></div>
<?php } ?>
</header>
