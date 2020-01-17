<?php
$ptitle = "Register";
nd('registerDiv', 'registerDiv');
$options = ['required' => null];
echo "REQEUST: ";
print_r($_REQUEST);
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
print_r($_SESSION);
?>
<div class="profilePicture">
    <img class="profilePic" src="assets/profilePictures/basic.jpg">
    <p class="choosePic">Choose Profile Picture</p>
</div>
    <div id="chooseThumbTable" class="chooseThumbTable hiddenThumb">
        <div class="allProfilePics">
            <?php
            $x = 0;
            while ($row = $getPictures->fetch_assoc()) {
            ?>
                <img src="<?= './assets/profilePictures/' . $row['pic_location']; ?>" alt="<?= str_replace('_', ' ', $row['pic_name']); ?>" class="chooseThumb" data-id="<?= $row['profilePic_id'] ?>">
            <?php } ?>
        </div>
        <p class="bouncingArrow hidden">&rtrif;</p>
    </div>
<?php
if (isset($register_errors['DoesNotExist'])) {
    echo '<p class="formNotice formNotice_Error">' . $register_errors['DoesNotExist'] . '</p>';
}
?>
<input type="text" style="display:none">
<input type="password" style="display:none">
<form action="register.php" method="post" class="registerForm" autocomplete="off">
    <input type="number" name="profilePicChoice" value="1" id="profilePicChoice" class="profilePicChoice hidden registerPPC">
    <?php
        create_form_input('username', 'text', 'Username', $register_errors, $options);
        notice('required', 'Required');
        create_form_input('email', 'email', 'Email', $register_errors, $options);
        notice('required', 'Required');
        echo '<label for="pwd">Password</label><input type="password" name="pwd" id="pwd" class="passwordInput createInput requiredInput" required><small class="formNotice formNotice_Required cutom">Password must contain at least 6 characters, 1 captital letter, and 1 number</small>';
        // create_form_input('pwd', 'password', 'Password', $register_errors, $options);
        // notice('required', 'Password must contain at least 6 characters, 1 captital letter, and 1 number');
        create_form_input('pwdC', 'password', 'Confirm Password', $register_errors, $options);
        notice('required', 'Required');

    ?>
    <input type="submit" name="registerBtn" id="registerBtn" class="adminBtn registerBtn" value="Register">
    <a href="profile.php" class="adminBtn adminBtn_subtle registerReturnBtn">Return</a>
</form>

<?php
ed();
echo '<script defer src="assets/js/borderFormUpdater.js"></script>';

