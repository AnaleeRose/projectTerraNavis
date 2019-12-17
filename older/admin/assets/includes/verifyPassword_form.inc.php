    <form class="verifyPwdForm generalForm" method="post">
        <h2 class="adminHeading">Please Verify Your Password</h2>
<?php
        $options = ['required' => null, 'addtl_classes' => ''];
        create_form_input('pwd', 'password', 'Password', $verifyPwd_errors, $options);
        echo '<input type="submit" name="verifyPwdBtn" class="adminBtn adminBtn_danger" value="Verify Password">';
?>
         <a href="profile.php" class="adminBtn adminBtn_subtle returnToProfileBtn">Return</a>
    </form>

<?php
?>
