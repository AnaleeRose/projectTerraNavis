
<footer class="mainFooter">
    <div id="f-container">
        <div id="f_teamBlurb-container" class="f_teamBlurb-container f-box">
            <h2 class="f_heading">Meet Our Team</h2>
            <p class="f_teamBlurb">Nick, Noshin, and Savannah. Three students from Francis Tuttle Technology Center who banded together to build a site. We created Terra Navis in hopes of offering a resource to the community while improving their skills. Want to learn more about us and our individual stories?</p>
            <a href="team.php" class="f_teamBlurb-link">Meet Our Team >></a>
        </div>
        <div id="f_newsLetter-container" class="f_newsLetter-container f-box">
            <form method="post" class="f_newsletter-form">
                <label class="f_heading" for="emailInput">Join Our Newsletter!</label>
                <?php if (!empty($email_errors)) { ?>
                  <div class="emailError"><?php foreach ($email_errors as $key => $value) {
                    echo '<p class="emailError-indi">' . $value . '</p>';
                  }?></div>
                <?php } ?>

                <div class="f_emailInput-container">
                    <input id="emailInput" name="emailInput" class="emailInput" type="email" placeholder="youremail@email.com">
                    <button type="submit" class="f_newsletter-btn" name="newsletterSubmitBtn" value="ignore">
                        <span class="a11yText">Sign Up For Newsletter</span>
                        <svg class="f_plusIcon" id="f_plusIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <g id="Group_294" data-name="Group 294" transform="translate(-259.914 -4770)">
                            <path id="Path_55" data-name="Path 55" d="M13773.662,17829v24" transform="translate(-13501.748 -13059)" fill="none" stroke="#322006" stroke-width="5"/>
                            <path id="Path_56" data-name="Path 56" d="M0,0V24" transform="translate(283.914 4782) rotate(90)" fill="none" stroke="#322006" stroke-width="5"/>
                          </g>
                        </svg>
                    </button>
                </div>
            </form>
            <div class="f_socialLinkIcon-container" alt="Francis Tuttle Facebook Account" title="Facebook">
                <a href="<?= INSTAGRAM_LINK; ?>" alt="Francis Tuttle Instagram Link" title="Instagram" class="f_socialLinkIcon">
                    <svg class="f_inIcon" id="f_inIcon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="71.001" height="73.5" viewBox="0 0 71.001 74.825">
                      <defs>
                        <radialGradient id="radial-gradient" cx="0.121" cy="0.059" r="1.068" gradientTransform="matrix(0.625, 0.781, -0.781, 0.625, 0.134, -0.094)" gradientUnits="objectBoundingBox">
                          <stop offset="0" stop-color="#3a2fc4"/>
                          <stop offset="0.3" stop-color="#9b3bac"/>
                          <stop offset="0.616" stop-color="#e56161"/>
                          <stop offset="1" stop-color="#f8c843"/>
                        </radialGradient>
                      </defs>
                      <g id="Group_212" data-name="Group 212" transform="translate(0)">
                        <path id="instagram" d="M64.7,50.919c-.247-5.206-1.436-9.817-5.249-13.616s-8.411-4.988-13.616-5.249c-5.365-.3-21.447-.3-26.812,0-5.191.247-9.8,1.436-13.616,5.235S.414,45.7.153,50.9c-.3,5.365-.3,21.447,0,26.812C.4,82.923,1.589,87.534,5.4,91.334s8.411,4.988,13.616,5.249c5.365.3,21.447.3,26.812,0,5.206-.247,9.817-1.436,13.616-5.249s4.988-8.411,5.249-13.616c.3-5.365.3-21.432,0-26.8Z" transform="translate(6.075 -21.986)" fill="#191541"/>
                        <g id="Group_207" data-name="Group 207">
                          <path id="instagram-2" data-name="instagram" d="M64.753,50.935c-.247-5.21-4.146-13.86-7.963-17.663s-5.708-.958-10.919-1.219c-5.37-.3-21.465-.3-26.835,0-5.2.247-9.811,1.437-13.628,5.239S.415,45.711.154,50.921c-.3,5.37-.3,21.465,0,26.835.247,5.21.6,8.038,4.421,11.841s9.251,6.78,14.461,7.041c5.37.3,21.465.3,26.835,0,5.21-.247,9.826-1.437,13.628-5.254s4.993-8.418,5.254-13.628c.3-5.37.3-21.451,0-26.821Z" transform="translate(3.047 -26.987)" fill="url(#radial-gradient)"/>
                          <path id="instagram-3" data-name="instagram" d="M32.432,47.656A16.661,16.661,0,1,0,49.094,64.318,16.635,16.635,0,0,0,32.432,47.656Zm0,27.494A10.832,10.832,0,1,1,43.264,64.318,10.852,10.852,0,0,1,32.432,75.15ZM53.661,46.975a3.886,3.886,0,1,1-3.886-3.886A3.877,3.877,0,0,1,53.661,46.975ZM64.7,50.919C64.45,45.713,63.261,41.1,59.447,37.3s-8.41-4.988-13.616-5.249c-5.365-.3-21.447-.3-26.812,0-5.191.247-9.8,1.436-13.616,5.235S.414,45.7.153,50.9c-.3,5.365-.3,21.447,0,26.812C.4,82.922,1.589,87.534,5.4,91.333s8.41,4.988,13.616,5.249c5.365.3,21.447.3,26.812,0,5.206-.247,9.817-1.436,13.616-5.249s4.988-8.41,5.249-13.616c.3-5.365.3-21.432,0-26.8ZM57.765,83.473a10.967,10.967,0,0,1-6.177,6.177c-4.278,1.7-14.428,1.305-19.156,1.305s-14.892.377-19.156-1.305A10.967,10.967,0,0,1,7.1,83.473C5.4,79.2,5.794,69.045,5.794,64.318S5.417,49.425,7.1,45.162a10.967,10.967,0,0,1,6.177-6.177c4.278-1.7,14.428-1.305,19.156-1.305s14.892-.377,19.156,1.305a10.967,10.967,0,0,1,6.177,6.177c1.7,4.278,1.305,14.428,1.305,19.156S59.462,79.21,57.765,83.473Z" transform="translate(0.075 -31.825)" fill="#fff"/>
                        </g>
                      </g>
                    </svg>
                </a>
                <a href="<?= TWITTER_LINK; ?>" alt="Francis Tuttle Twitter Link" title="Twitter" class="f_socialLinkIcon">
                    <svg class="f_twIcon" id="f_twIcon" xmlns="http://www.w3.org/2000/svg" width="71.865" height="70.656" viewBox="0 0 71.865 70.656">
                      <g id="Group_210" data-name="Group 210" transform="translate(0.246)">
                        <path id="twitter-square" d="M57.728,32H6.927A6.929,6.929,0,0,0,0,38.927v50.8a6.929,6.929,0,0,0,6.927,6.927h50.8a6.929,6.929,0,0,0,6.927-6.927v-50.8A6.929,6.929,0,0,0,57.728,32ZM50.671,54.918c.029.4.029.823.029,1.227,0,12.513-9.525,26.93-26.93,26.93A26.806,26.806,0,0,1,9.237,78.832a19.942,19.942,0,0,0,2.28.115,18.977,18.977,0,0,0,11.748-4.041,9.478,9.478,0,0,1-8.847-6.567,10.2,10.2,0,0,0,4.272-.173,9.466,9.466,0,0,1-7.577-9.294v-.115a9.459,9.459,0,0,0,4.272,1.2,9.445,9.445,0,0,1-4.214-7.88A9.347,9.347,0,0,1,12.455,47.3a26.876,26.876,0,0,0,19.512,9.9,9.486,9.486,0,0,1,16.15-8.645,18.548,18.548,0,0,0,6-2.28,9.441,9.441,0,0,1-4.156,5.21,18.836,18.836,0,0,0,5.455-1.472A19.923,19.923,0,0,1,50.671,54.918Z" transform="translate(6.963 -26)" fill="#0e2d40"/>
                        <path id="twitter-square-2" data-name="twitter-square" d="M54.859,28.653,6.908,31.982A6.929,6.929,0,0,0-.019,38.91L-3.635,86.051c0,3.825,6.718,10.587,10.543,10.587h50.8a6.929,6.929,0,0,0,6.927-6.927V38.91C64.637,35.085,58.683,28.653,54.859,28.653ZM50.652,54.9c.029.4.029.823.029,1.227,0,12.513-9.525,26.93-26.93,26.93A26.806,26.806,0,0,1,9.217,78.815a19.942,19.942,0,0,0,2.28.115,18.977,18.977,0,0,0,11.748-4.041A9.478,9.478,0,0,1,14.4,68.322a10.2,10.2,0,0,0,4.272-.173,9.466,9.466,0,0,1-7.577-9.294v-.115a9.459,9.459,0,0,0,4.272,1.2,9.445,9.445,0,0,1-4.214-7.88,9.347,9.347,0,0,1,1.284-4.777,26.876,26.876,0,0,0,19.512,9.9A9.486,9.486,0,0,1,48.1,48.536a18.548,18.548,0,0,0,6-2.28,9.441,9.441,0,0,1-4.156,5.21A18.836,18.836,0,0,0,55.4,49.994,19.923,19.923,0,0,1,50.652,54.9Z" transform="translate(3.998 -28)" fill="#174764"/>
                        <g id="Rectangle_153" data-name="Rectangle 153" transform="translate(-0.246 9)" fill="#fff" stroke="#707070" stroke-width="1">
                          <rect width="65" height="45" stroke="none"/>
                          <rect x="0.5" y="0.5" width="64" height="44" fill="none"/>
                        </g>
                        <path id="twitter-square-3" data-name="twitter-square" d="M57.728,32H6.927A6.929,6.929,0,0,0,0,38.927v50.8a6.929,6.929,0,0,0,6.927,6.927h50.8a6.929,6.929,0,0,0,6.927-6.927v-50.8A6.929,6.929,0,0,0,57.728,32ZM50.671,54.918c.029.4.029.823.029,1.227,0,12.513-9.525,26.93-26.93,26.93A26.806,26.806,0,0,1,9.237,78.832a19.942,19.942,0,0,0,2.28.115,18.977,18.977,0,0,0,11.748-4.041,9.478,9.478,0,0,1-8.847-6.567,10.2,10.2,0,0,0,4.272-.173,9.466,9.466,0,0,1-7.577-9.294v-.115a9.459,9.459,0,0,0,4.272,1.2,9.445,9.445,0,0,1-4.214-7.88A9.347,9.347,0,0,1,12.455,47.3a26.876,26.876,0,0,0,19.512,9.9,9.486,9.486,0,0,1,16.15-8.645,18.548,18.548,0,0,0,6-2.28,9.441,9.441,0,0,1-4.156,5.21,18.836,18.836,0,0,0,5.455-1.472A19.923,19.923,0,0,1,50.671,54.918Z" transform="translate(0 -32)" fill="#1da1f2"/>
                      </g>
                    </svg>
                </a>
                <a href="<?= FACEBOOK_LINK; ?>" alt="Francis Tuttle Facebook Link" class="f_socialLinkIcon">
                    <svg class="f_fbIcon" id="f_fbIcon" data-name="Group 206" xmlns="http://www.w3.org/2000/svg" width="69.629" height="70.656" viewBox="0 0 69.629 70.656">
                      <g id="Group_205" data-name="Group 205" transform="translate(4.974 6)">
                        <rect id="Rectangle_155" data-name="Rectangle 155" width="52" height="58" transform="translate(6.656 6.591)" fill="#173067"/>
                        <path id="facebook-square" d="M57.728,96.656H6.927A6.927,6.927,0,0,1,0,89.728v-50.8A6.927,6.927,0,0,1,6.927,32H26.736V53.982H17.643V64.328h9.092v7.886c0,8.97,5.34,13.924,13.519,13.924a55.083,55.083,0,0,0,8.013-.7v-8.8H43.754c-4.447,0-5.833-2.759-5.833-5.59V64.328h9.926L46.259,53.982H37.92V32H57.728a6.927,6.927,0,0,1,6.927,6.927v50.8a6.927,6.927,0,0,1-6.927,6.927Z" transform="translate(0 -32)" fill="#173067"/>
                      </g>
                      <g id="Group_204" data-name="Group 204" transform="translate(0.069 0.42)">
                        <path id="facebook-square-2" data-name="facebook-square" d="M57.713,96.642H6.912c-3.826,0-9.843-5.635-9.843-9.461L-.016,38.914a6.927,6.927,0,0,1,6.927-6.927H26.72V53.968H17.628V64.314H26.72V72.2c0,8.97,5.34,13.924,13.519,13.924a55.082,55.082,0,0,0,8.013-.7v-8.8H43.738c-4.447,0-5.833-2.759-5.833-5.59V64.314h9.926L46.244,53.968H37.9V31.986L56.12,29.42c3.826,0,8.52,5.668,8.52,9.494v50.8a6.927,6.927,0,0,1-6.927,6.927Z" transform="translate(2.931 -29.42)" fill="#5474b9"/>
                      </g>
                      <g id="Group_203" data-name="Group 203">
                        <rect id="Rectangle_155-2" data-name="Rectangle 155" width="52" height="58" transform="translate(6.629 6.591)" fill="#5575b9"/>
                        <path id="facebook-square-3" data-name="facebook-square" d="M57.728,32H6.927A6.927,6.927,0,0,0,0,38.927v50.8a6.927,6.927,0,0,0,6.927,6.927H26.736V74.674H17.643V64.328h9.092V56.442c0-8.97,5.34-13.924,13.519-13.924a55.082,55.082,0,0,1,8.013.7v8.8H43.754c-4.447,0-5.833,2.759-5.833,5.59v6.718h9.926L46.259,74.674H37.92V96.656H57.728a6.927,6.927,0,0,0,6.927-6.927v-50.8A6.927,6.927,0,0,0,57.728,32Z" transform="translate(0 -32)" fill="#fff"/>
                      </g>
                    </svg>
                </a>


            </div>
        </div>
        <div id="f_contactInfo-container" class="f_contactInfo-container f-box">
            <div class="address_box f_contactInfo-box">
                <svg class="f_houseIcon f_contactInfo-icon" id="f_houseIcon" data-name="Group 2" xmlns="http://www.w3.org/2000/svg" width="47.689" height="37.952" viewBox="0 0 47.689 37.952">
                  <path id="Path_3" data-name="Path 3" d="M82.736,120.939,65.728,134.96a.4.4,0,0,1-.015.089.4.4,0,0,0-.015.088v14.2a1.921,1.921,0,0,0,1.893,1.894H78.949V139.87h7.573v11.359H97.881a1.923,1.923,0,0,0,1.894-1.894v-14.2a.416.416,0,0,0-.03-.177Z" transform="translate(-58.891 -113.278)" />
                  <path id="Path_4" data-name="Path 4" d="M47.36,65.482,40.882,60.1V48.03a.912.912,0,0,0-.947-.946H34.256a.911.911,0,0,0-.947.946V53.8l-7.217-6.034a3.669,3.669,0,0,0-4.5,0L.328,65.482A.859.859,0,0,0,0,66.117a.958.958,0,0,0,.207.7L2.044,69a1.009,1.009,0,0,0,.621.326,1.1,1.1,0,0,0,.71-.207L23.844,52.052,44.313,69.12a.912.912,0,0,0,.621.206h.089A1.01,1.01,0,0,0,45.645,69l1.834-2.189a.957.957,0,0,0,.206-.7A.862.862,0,0,0,47.36,65.482Z" transform="translate(0.001 -46.994)" />
                </svg>
                <p>12777 N Rockwell Ave,<br> Oklahoma City, OK 73142</p>
            </div>

            <div class="phone_box f_contactInfo-box">
                <svg class="f_phoneIcon f_contactInfo-icon" id="f_phoneIcon" xmlns="http://www.w3.org/2000/svg" width="29.422" height="50" viewBox="0 0 29.422 50">
                  <g id="smartphone-call" transform="translate(-7.334)">
                    <path id="Path_1" data-name="Path 1" d="M33.335,0H10.755A3.409,3.409,0,0,0,7.334,3.377V46.621A3.41,3.41,0,0,0,10.755,50h22.58a3.408,3.408,0,0,0,3.421-3.377V3.377A3.409,3.409,0,0,0,33.335,0Zm-14.9,2.434h7.224a.409.409,0,1,1,0,.819H18.433a.409.409,0,1,1,0-.819Zm3.612,45.877a1.689,1.689,0,1,1,1.71-1.69A1.7,1.7,0,0,1,22.045,48.311ZM34.376,43.75H9.714V5.356H34.376Z"/>
                  </g>
                </svg>

                <p>1-888-867-5309</p>
            </div>
            <div class="email_box f_contactInfo-box">
                <svg class="f_emailIcon f_contactInfo-icon" id="f_emailIcon" xmlns="http://www.w3.org/2000/svg" width="45.919" height="31.943" viewBox="0 0 45.919 31.943" class="emailIcon">
                  <g id="email-envelope-outline" transform="translate(188 179.889)">
                    <path id="Path_2" data-name="Path 2" d="M45.42,59.111H.5a.5.5,0,0,0-.5.5V90.556a.5.5,0,0,0,.5.5H45.42a.5.5,0,0,0,.5-.5V59.61A.5.5,0,0,0,45.42,59.111Zm-7.6,3.993L22.96,74,8.1,63.1Zm4.1,23.957H3.993V65.048L22.664,78.74a.5.5,0,0,0,.592,0L41.927,65.048V87.061Z" transform="translate(-188 -239)"/>
                  </g>
                </svg>

                <p><?= EMAIL_LINK ?></p>
            </div>
        </div>
    </div>
    <div class="f_copyright-container">
        <p class="f_copyright">&copy; FT BPA Team 2019-2020</p>
    </div>
    <div id="bpaChapterInfo-container" class="bpaChapterInfo-container">
      <div class="bpaChapterInfoHead-container">
        <i class="arrow bpa-arrow"></i>
        <p class="bpaChapterInfo-heading">BPA Information</p>
      </div>
      <div id="bpaChapterInfo-content" class="bpaChapterInfo-content">
        <p>Chapter: 03-0042</p>
        <p>Theme: BPA Bio Friendly Home</p>
        <p>School: Francis Tuttle Technology Center - Rockwell Campus</p>
        <p>Location: Oklahoma City, OK</p>
      </div>
    </div>
</footer>
<script defer>
    // console.log('hullo')
    // bodyText = document.body.innerHTML
    // bodyText.replace(/(^[\s\u200b]*|[\s\u200b]*$)/g, '')
    // document.body.innerHTML = bodyText
</script>
