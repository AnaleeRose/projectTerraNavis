<?php
if (isset($_POST['loginBtn'])) { //if they clicked the log in btn
    // track all the errors in this array
    // link to the db
    // check the email
    if (!empty($_POST['email'])) { //check if empty email address
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { //check if valid email address
            $e = escape_data($_POST['email'], $dbc);
        } else {
            $login_errors['email'] = "Please enter a valid email address";
        }
    } else {
        $login_errors['email'] = "Please enter an email address";
    }

    if (!empty($_POST['pwd'])) {
        $p = escape_data($_POST['pwd'], $dbc);
    } else {
        $login_errors['pwd'] = "Please enter your password";
    }

    if (empty($login_errors)) { //if no errors send to db
        $q = "SELECT admin_id FROM adminuser WHERE admin_email = '$e'";
        $r = mysqli_query($dbc, $q);
        if ($r && mysqli_num_rows($r) === 1) { // if email exists
            $admin_pwd = mysqli_fetch_row($r);
            $q = "SELECT info FROM info WHERE admin_id = " . $admin_pwd[0];
            $r = mysqli_query($dbc, $q);
            if ($r) { // if password exists
                $admin_verify_me = mysqli_fetch_row($r);
                if (password_verify($p, $admin_verify_me[0])) { // if password is correct
                    $select = "SELECT a.admin_id AS uid, a.admin_username, a.admin_email, a.profilePic_id, a.light_mode, p.pic_Location FROM `info` i JOIN adminuser a ON a.admin_id = i.admin_id JOIN profilepictures p ON p.profilePic_id = a.profilePic_id WHERE a.admin_email = '$e'";
                    $r2 = mysqli_query($dbc, $select);
                    if (mysqli_num_rows($r2) === 1) { // if all correct, kick into logged in mode and save a ton of info on admin
                        session_regenerate_id();
                        while ($row = mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
                           $_SESSION['uid'] = $row['uid'];
                           $_SESSION['username'] = $row['admin_username'];
                           $_SESSION['email'] = $row['admin_email'];
                           $_SESSION['profilePic_id'] = $row['profilePic_id'];
                           $_SESSION['profilePic_Location'] = $row['pic_Location'];
                           $_SESSION['light_mode'] = $row['light_mode'];
                        }
                        header('Location: index.php');
                    } else {
                        echo "oops";
                    }
                } else { // Incorrect password
                    $login_errors['DoesNotExist'] = 'Incorrect password';
                }
            } else { // something is horribly wrong lol (found the email in the db but not a matching pasword, correct or otherwise...)
                $login_errors['DoesNotExist'] = 'There is no record of that email/password combination...';
            }
        } else { // email does not exist
            $login_errors['DoesNotExist'] = 'There is no record of that email';
        }
    }

}
