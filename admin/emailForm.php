<?php
// ----------------------------------------------------------------------------------------------------------->
// ----------------------------------------------------------------------------------------------------->
// ---------------------------------------------------------------------------------->
// NOTE!!!!!!
// this page is SUPER INCOMPLETE, mostly just testing if I caould send emails to external mail systems on my server...
// ---------------------------------------------------------------------------------->
// ----------------------------------------------------------------------------------------------------------->
// ----------------------------------------------------------------------------------------------------------->


// ob_start tells it not to show anything until everything is done loading so I can interrupt it at any time to load an error page without php getting mad about content already on display
ob_start();

// starts a session lol, aka it tracks information even when you go to a different page within the site
session_start();

 // config sets up a number of vital defnitions and a few functions too
require './../html/assets/includes/config.inc.php';

// toss user back to login page if they're not logged in
check_if_admin();

// connects ya to the db
require MYSQL;

// makes it easy to create forms
require './../html/assets/includes/form_functions.inc.php';

// basic functions used throughout the site
require './../html/assets/includes/functions.inc.php';




// tracks errors
$emailForm_errors = [];
$options = ['required' => null];

// for testing puposes, this information is currently hardcoded and sent to me
$mail_to_send_to = "kaiasnowfall@gmail.com";
$from_email = "savannah@savannahskinner.com";
$sendflag = false;

// if there's content to send, give the go ahead to send the email!
if (!empty($_POST['email']) && !empty($_POST['msg'])) {
    $sendflag = true;
} else {
    $emailForm_errors['empty'] = 'empty';
}

function createEmail($subject, $msg) {
$newMsg = '
    <html>
    <head>
        <title>test</title>
        <style type="text/css">
            :root {
                --color_1: grey;
            }

            html {
                font-family: sans-serif;
            }
            body {
                margin: 0;
            }

            .container {
                padding: 1rem;
            }


            .header {
                width: 85%;
                margin: 0 auto 3rem;
                max-width: 1300px;
            }

            .logo {
                width: 6rem;
            }
        
            .mainHeading {
                font-size: 1.5rem;
                margin-left: 1rem;
            }

            .headingSpace_large, .headingSpace_small {
                opacity: 0;
                font-size: .1px;
                
            }
            
                .headingSpace_large {width: 50%;}
                .headingSpace_small {width: 5%;}

            .unsubBtn {
                border: 2px solid var(--color_1);
                border-radius: 2rem;
                padding: .8rem 1rem;
                text-decoration: none;
            }


            .mainContent {
                width: 80%;
                margin: 0 auto;
                max-width: 1200px;
            }

            .articleHeading {
                font-size: 2rem;
                font-weight: bold;
                padding-bottom: 2rem;
                text-align: center;
            }

            .picture {
                margin: 0 auto;
                width: 50%;
            }

            .content {
                margin: 0 auto;
                width: 40%;
            }

            .readLink {
                text-align: right;
            }

            .margin {width: 5%;}

            .team, .socialLinks, .contact {
                width: 30vw;
            }

            .footer {
                width: 100vw;
                background: var(--color_1)
            }

        </style>
    </head>
    <body>
        <table class="container">
            <table class="header">
                <tr>
                    <th></th>
                    <th></th>
                    <th class="headingSpace_large"></th>
                    <th></th>
                </tr>
                <tr>
                    <td><img class="logo" src="http://localhost/BPA/admin/assets/imgs/leaf_icon.jpg"></td>
                    <td><h1 class="mainHeading">Terra Navis Living</td>
                    <td></td>
                    <td><a href="http://localhost/BPA/admin/" class="unsubBtn">Unsubscribe</a></td>
                </tr>
            </table>
            <table class="mainContent">
                <tr>
                    <th class="margin"></th>
                    <th class="picture"></th>
                    <th class="content"></th>
                    <th class="margin"></th>
                </tr>

                <tr>
                    <td></td>
                    <td class="articleHeading" colspan="2">' . $subject . '</td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td></td>
                    <td><img class="articleImg" src="http://localhost/BPA/admin/assets/imgs/leaf_icon.jpg"></td>
                    <td><p class="articleDescription">' . $msg . '</p></td>
                    <td></td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td><p class="readLink">Read More At Terra Navis >></p></td>
                    <td></td>
                </tr>
            </table>
        </table>
        <table class="footer">
            <tr>
                <th class="team"></th>
                <th class="socialLinks"></th>
                <th class="contact"></th>
            </tr>
            <tr>
                <td class="teamContainer">
                    <h4 class="teamHeading">Meet Our Team</h4>
                    <p class="teamText">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <a href="http://localhost/BPA/admin/" class="readLink">Read More At Terra Navis >></a>
                </td>
                <td>
                    <h3 class="footerArticleHeading">Read Our Latest Articles</h3>
                    <a class="footerTNLink" href="http://localhost/BPA/admin/">Terra Navis Living</a>
                    <div class="socialLinkContainer">
                        <a href="facebok.com">fb</a>
                        <a href="twitter.com">twitter</a>
                        <a href="instagram.com">insta</a>
                    </div>
                    
                </td>
                <td>
                    <p class="teamText">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    
                </td>
            </tr>
        </table>

    </body>
    </html>';
    return $newMsg;
}

if ($sendflag) {
    // create the email and send that bad boi
    $email = $_POST['email'];
    $subject = "THIS IS THE SUBJECT";
    $msg = $_POST['msg'];
    $message = createEmail($subject, $msg);
    $headers = "From: $from_email" . "\r\n" . "Reply-To: $email" . "\r\n" . $bcc_headers;
    $a = mail( $mail_to_send_to, "Message from a contact form", $message, $headers );
    if ($a)
    {
         print("Message was sent, you can send another one");
    } else {
         print("Message wasn't sent, please check that you have changed emails in the bottom");
    }
}
?>
<form method="post" class="genralForm">
<?php

create_form_input('email', 'email', 'Your Email: ', $emailForm_errors, $options);
create_form_input('msg', 'textarea', 'Message: ', $emailForm_errors, $options);

?>
<input type="submit" name="sendEmailBtn" id="sendEmailBtn" class="adminBtn adminBtn_accent sendEmailBtn" value="Send Email">
</form>

