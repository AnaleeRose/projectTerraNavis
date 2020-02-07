
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
            <div class="f_socialLinkIcon-container">
                <a href="<?= INSTAGRAM_LINK; ?>" title="Instagram" class="f_socialLinkIcon" aria-label="Instagram">
                  <img class="f_inIcon" id="f_inIcon" src="./assets/images/icons/insta.png">
                </a>
                <a href="<?= TWITTER_LINK; ?>" title="Twitter" class="f_socialLinkIcon" aria-label="Twitter">
                  <img class="f_inIcon" id="f_inIcon" src="./assets/images/icons/tw.png">
                </a>
                <a href="<?= FACEBOOK_LINK; ?>" class="f_socialLinkIcon" aria-label="Facebook">
                  <img class="f_inIcon" id="f_inIcon" src="./assets/images/icons/fb.png">
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
                <svg class="f_emailIcon f_contactInfo-icon" id="f_emailIcon" xmlns="http://www.w3.org/2000/svg" width="45.919" height="31.943" viewBox="0 0 45.919 31.943">
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
