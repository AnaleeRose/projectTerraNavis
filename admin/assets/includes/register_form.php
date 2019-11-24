<?php
$ptitle = "Register";
nd('registerDiv', 'registerDiv');
$options = ['required' => null];
?>
<div class="profilePicture">
    <img class="profilePic" src="assets/profilePictures/basic.jpg">
    <p class="choosePic">Choose Profile Picture</p>
</div>
    <table id="chooseThumbTable" class="chooseThumbTable hiddenThumb">
        <tr>
            <?php
            // if ($getPictures) {do {
            while ($row = $getPictures->fetch_assoc()) {
                if ($pos++ % COLS === 0 && !$firstRow) {
                    echo '</tr><tr>';
                }
                $firstRow = false;
                ?>
            <td><img src="<?= 'assets/profilePictures/' . $row['pic_location']; ?>" alt="<?= str_replace('_', ' ', $row['pic_name']); ?>" class="chooseThumb" data-id="<?= $row['profilePic_id'] ?>"></td>
        <?php } ;
            while ($pos++ % COLS) {
                echo '<td>&nbsp;</td>';
            }
        ?>
        </tr>
    </table>
<?php
if (isset($register_errors['DoesNotExist'])) {
    echo '<p class="formNotice formNotice_Error">' . $register_errors['DoesNotExist'] . '</p>';
}
?>
<form action="register.php" method="post" class="registerForm" style="margin-top: -8rem">
    <input type="number" name="profilePicChoice" value="1" id="profilePicChoice" class="profilePicChoice hidden registerPPC">
    <?php
        create_form_input('username', 'text', 'Username', $register_errors, $options);
        notice('required', 'Required');
        create_form_input('email', 'email', 'Email', $register_errors, $options);
        notice('required', 'Required');
        create_form_input('pwd', 'password', 'Password', $register_errors, $options);
        notice('required', 'Password must contain at least 6 characters, 1 captital letter, and 1 number');
        create_form_input('pwdC', 'password', 'Confirm Password', $register_errors, $options);
        notice('required', 'Required');

    ?>
    <input type="submit" name="registerBtn" id="registerBtn" class="adminBtn registerBtn" value="Register">
    <a href="profile.php" class="adminBtn adminBtn_subtle registerReturnBtn">Return</a>
</form>

<?php
ed();
echo '<script defer src="assets/js/borderFormUpdater.js"></script>';

