<?php
require './assets/includes/config.inc.php';
require './assets/includes/form_functions.inc.php';


// contact form handling
$contact_errors = [];
 $missing = [];
$suspectMail;
$mailSent = 'false';
$mailSafe = false;
$nameSafe = false;
$msgSafe = false;

$expected = ['c_name', 'c_email', 'cf_joinNewsletter', 'c_msg'];
$required = ['c_name', 'c_email', 'cf_joinNewsletter', 'c_msg'];
$to = OUR_CONTACT_EMAIL;
if (isset($_POST['cf_submit'])) {
    if (filter_var($_POST['c_email'], FILTER_VALIDATE_EMAIL) && (filter_var($_POST['c_email'], FILTER_SANITIZE_EMAIL) === $_POST['c_email'])) {
        $mailSafe = true;
    } else {
        $contact_errors['c_email'] = "Please enter a valid email address";
    }

    if (preg_match('/^[a-zA-Z0-9\s\'\,]{2,}+$/', $_POST['c_name'])) {
        $nameSafe = true;
    } elseif (empty($_POST['c_name'])) {
        $contact_errors['c_name'] = "Please enter your name";
    } else {
        $contact_errors['c_name'] = "Please use only numbers, letters, commas, and apostrophes";
    }

        
    if (!empty($_POST['c_msg'])) { 
        $_POST['c_msg'] = htmlspecialchars($_POST['c_msg']);
        $msgSafe = true;
    } else {
        $contact_errors['c_msg'] = "Please enter a message";
    }


    if ($mailSafe === true && $nameSafe === true && $msgSafe === true) {
        require './assets/includes/process_email.inc.php';
        if (isset($suspectMail) && $suspectMail === true) {
            $contact_errors['name'] = "This message is invalid";
        } 

        $joinChoice = $_POST['cf_joinNewsletter'];

        if (isset($joinChoice) && $joinChoice === "2" && $mailSent === 'true') {
            require MYSQL;
            $q = 'SELECT * FROM `email_list` WHERE `email` = "' . $_POST['c_email'] . '"';
            $r = mysqli_query($dbc, $q);
            if ($r && mysqli_num_rows($r) == 0) {
                $stmt = $dbpdo->prepare("INSERT INTO `email_list` (`id`, `email`) VALUES (NULL, :email)");
                $stmt->bindParam(':email', $_POST['c_email'], PDO::PARAM_STR);
                if ($stmt->execute()) {
                    header("Location: " . BASE_URL . "html/thankyou.php?p=cn");
                }
            } elseif ($r && mysqli_num_rows($r) > 0) {
                    header("Location: " . BASE_URL . "html/thankyou.php?p=cn&subbed");
            } else {
                $contact_errors['major'][] = "Something went wrong, please try again later";
            }
        } 

    }

    if ($mailSent === 'attempted') {
        $contact_errors['major'][] = "Something went wrong, please try again later";
    }

    if ($mailSent === 'true') {
        echo "TWAS SENT";
    }


}

if (!empty($contact_errors)) print_r($contact_errors);
if (!empty($missing)) print_r($missing);
$c_options = ['required' => '', 'contactPage' => ''];
// $c_options = ['contactPage' => ''];

$max_msg_characters = 1200;


$page = 'contact';
require './assets/includes/head.php';
?>

<body class="">
<!------ Header ------------>
<?php require './assets/includes/header.inc.php'; ?>

<!-- Main body content -->
<article id="mainContent" class="multiContentPage mainContent contactPage">
    <header class="mainHeading_Container">
       <h2 class="mainHeading">Contact Us</h2>
    </header>


    <div class="mainContent-wrapper">

    <?php 
    if (!empty($contact_errors)) {
        echo '<div class="majorError-container">';
        if (empty($contact_errors['major'])) {
            echo '<p class="majorError">Please resolve errors before continuing.</p>';
        }
        if (!empty($contact_errors['major'])) {
            if (is_array($contact_errors['major'])) {
                foreach ($contact_errors['major'] as $key => $value) {
                    echo '<p class="majorError">' . $value . '</p>';
                }
            } else {
                echo '<p class="majorError">' . $contact_errors['major'] . '</p>';
            }
        } 
        echo '</div>';
    }
    ?>
        <section class="quoteHeading-container">
            <!-- <p class="quote contact-quote">We value your feedback, feel free to reach out!</p> -->
            <!-- <p class="quote contact-quote">We value your feedback!</p> -->
        </section>

        <section class="contactSidebar-container">
            <h3 class="contactSidebar-header">Our Contact Info</h3>

            <div class="contactSidebar-IconText contactSidebar-home-container">
                <a class="contactSidebar-text" href="https://www.google.com/maps/search/?api=1&query=35.5990429,-97.6419168&query_place_id=ChIJ_XsrK2kDsocR42W3n4UFml8">
                    <svg class="contactSidebar-icon contactSidebar-houseIcon" id="contactSidebar-houseIcon" data-name="Group 2" xmlns="http://www.w3.org/2000/svg" width="47.689" height="37.952" viewBox="0 0 47.689 37.952">
                      <path id="Path_3" data-name="Path 3" d="M82.736,120.939,65.728,134.96a.4.4,0,0,1-.015.089.4.4,0,0,0-.015.088v14.2a1.921,1.921,0,0,0,1.893,1.894H78.949V139.87h7.573v11.359H97.881a1.923,1.923,0,0,0,1.894-1.894v-14.2a.416.416,0,0,0-.03-.177Z" transform="translate(-58.891 -113.278)" />
                      <path id="Path_4" data-name="Path 4" d="M47.36,65.482,40.882,60.1V48.03a.912.912,0,0,0-.947-.946H34.256a.911.911,0,0,0-.947.946V53.8l-7.217-6.034a3.669,3.669,0,0,0-4.5,0L.328,65.482A.859.859,0,0,0,0,66.117a.958.958,0,0,0,.207.7L2.044,69a1.009,1.009,0,0,0,.621.326,1.1,1.1,0,0,0,.71-.207L23.844,52.052,44.313,69.12a.912.912,0,0,0,.621.206h.089A1.01,1.01,0,0,0,45.645,69l1.834-2.189a.957.957,0,0,0,.206-.7A.862.862,0,0,0,47.36,65.482Z" transform="translate(0.001 -46.994)" />
                    </svg>
                </a>
                <a class="contactSidebar-text" href="https://www.google.com/maps/search/?api=1&query=35.5990429,-97.6419168&query_place_id=ChIJ_XsrK2kDsocR42W3n4UFml8">12777 N Rockwell Ave<span class="contactSidebar-secondLineText">Oklahoma City, OK 73142</span></a>
            </div>

            <div class="contactSidebar-IconText contactSidebar-phone-container">
                <a href="tel:+1-888-867-5309">
                    <svg class="contactSidebar-icon contactSidebar-phoneIcon" id="contactSidebar-phoneIcon" xmlns="http://www.w3.org/2000/svg" width="29.422" height="50" viewBox="0 0 29.422 50">
                      <g id="smartphone-call" transform="translate(-7.334)">
                        <path id="Path_1" data-name="Path 1" d="M33.335,0H10.755A3.409,3.409,0,0,0,7.334,3.377V46.621A3.41,3.41,0,0,0,10.755,50h22.58a3.408,3.408,0,0,0,3.421-3.377V3.377A3.409,3.409,0,0,0,33.335,0Zm-14.9,2.434h7.224a.409.409,0,1,1,0,.819H18.433a.409.409,0,1,1,0-.819Zm3.612,45.877a1.689,1.689,0,1,1,1.71-1.69A1.7,1.7,0,0,1,22.045,48.311ZM34.376,43.75H9.714V5.356H34.376Z"/>
                      </g>
                    </svg>
                </a>
                <p class="contactSidebar-text"><a href="tel:+1-888-867-5309">1-888-867-5309</a></p>
            </div>

            <div class="contactSidebar-IconText contactSidebar-email-container">
                <a class="contactSidebar-text"href="mailto:<?= EMAIL_LINK ?>">
                    <svg class="contactSidebar-icon contactSidebar-emailIcon" id="contactSidebar-emailIcon" xmlns="http://www.w3.org/2000/svg" width="45.919" height="31.943" viewBox="0 0 45.919 31.943">
                      <g id="email-envelope-outline" transform="translate(188 179.889)">
                        <path id="Path_2" data-name="Path 2" d="M45.42,59.111H.5a.5.5,0,0,0-.5.5V90.556a.5.5,0,0,0,.5.5H45.42a.5.5,0,0,0,.5-.5V59.61A.5.5,0,0,0,45.42,59.111Zm-7.6,3.993L22.96,74,8.1,63.1Zm4.1,23.957H3.993V65.048L22.664,78.74a.5.5,0,0,0,.592,0L41.927,65.048V87.061Z" transform="translate(-188 -239)"/>
                      </g>
                    </svg>
                </a>
                <a class="contactSidebar-text"href="mailto:<?= EMAIL_LINK ?>"><?= EMAIL_LINK ?></a>
            </div>

        </section>
        <form class="cf-container form-container" method="post">
            <?php
                create_form_input('c_name', 'text', 'Name', $contact_errors, $c_options + ['placeholder' => 'Your name', 'addtl_div_classes' => 'equalWidthContainer']);

                create_form_input('c_email', 'email', 'Email', $contact_errors, $c_options + ['placeholder' => 'Your email', 'addtl_div_classes' => 'equalWidthContainer']);
            ?>
            <div class="cf_inputLabel-container cf_joinNewsletter-container">
                <label for="cf_joinNewsletter">Join Our Newsletter?
                    <p class="requiredWarning cf_requiredWarning">required</p>
                </label>
                <div class="cf_joinChoice-container">
                    <div class="cf_joinChoice-indiContainer">
                        <input class="cf_joinChoice-input" type="radio" name="cf_joinNewsletter" value="2" <?php if (isset($_POST['cf_joinNewsletter'])) {if ($_POST['cf_joinNewsletter'] == 2) echo "checked";} ?>>
                        <span class="customRadioBtn" data-value="2"></span>
                        <p class="cf_joinChoice-text">Sure, I'm in!</p>
                    </div>
                    <div class="cf_joinChoice-indiContainer">
                        <input class="cf_joinChoice-input" type="radio" name="cf_joinNewsletter" value="1" <?php if (isset($_POST['cf_joinNewsletter'])) {if ($_POST['cf_joinNewsletter'] == 1) echo "checked";} else {echo "checked";} ?>>
                        <span class="customRadioBtn"  data-value="1"></span>
                        <p class="cf_joinChoice-text">No, thank you...</p>
                    </div>
                </div>
            </div>

            <?php
                create_form_input('c_msg', 'textarea', 'Message', $contact_errors, $c_options + ['placeholder' => 'Type a message....', 'addtl_div_classes' => 'cf_msgCounter-container', 'maxlength' => $max_msg_characters]);
            ?>
            <input name="cf_submit" id="cf_submit" type="submit" value="Send Email" class="btn cf_btn">
        </form>
</div>
</article>

<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>

</html>
