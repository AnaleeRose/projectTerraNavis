<?php
$pageTitle = "Login";
$options = ['required' => null];
echo '<h1 class="loginHeading">Terra Navis Admin Center</h1>';
echo '<img class="login_profilePic" src="assets/profilePictures/';
if (isset($session['profilePic_Location'])) {
    echo $_SESSION['profilePic_Location'];
} else {
echo 'basic.jpg';
}
echo '">';

nd('loginDiv', 'loginDiv');
if (isset($login_errors['DoesNotExist'])) {
    notice('error', $login_errors['DoesNotExist']);
}
?>
<form action="index.php" method="post" class="loginForm">
    <?php
        create_form_input('email', 'email', 'Email', $login_errors, $options);
        echo REQUIRED;
        create_form_input('pwd', 'password', 'Password', $login_errors, $options);
        echo REQUIRED;

    ?>
    <input type="submit" name="loginBtn" id="loginBtn" class="adminBtn loginBtn" value="Login">
    <a href="forgotPassword.php" class="forgotPBtn adminBtn adminBtn_subtle">Forgot Password</a>
</form>

<?php
ed();
echo '<script defer src="assets/js/borderFormUpdater.js"></script>';

