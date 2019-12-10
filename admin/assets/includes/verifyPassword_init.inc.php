<?php
$verifyPwd_errors = [];
if (!isset($uid)) $uid =$_SESSION['uid'];

if (isset($_POST['verifyPwdBtn'])) {
    $pwd = $_POST['pwd'];
    if (empty($_POST['pwd'])) $verifyPwd_errors['pwd'] = 'Please enter your password';
    if (empty($verifyPwd_errors)) {
        $q = "SELECT info FROM info WHERE admin_id = " . $_SESSION['uid'];
        $r = mysqli_query($dbc, $q);
        if ($r) {
            $admin_verify_me = mysqli_fetch_row($r);
            if (password_verify($pwd, $admin_verify_me[0])) {
                $_SESSION['relogged_in']= true;
                $relogged_in = $_SESSION['relogged_in'];
            } else {
                $verifyPwd_errors['pwd'] = 'Incorrect password';
            }
        } else {
            ob_end_clean();
            require './assets/includes/header.html';
            require './assets/includes/error.php';
            $links = ['Return To Home' => 'index.php'];
            produce_error_page('Could not connect to the database. Please contact our service team to resolve the issue.', $links);
            require './assets/includes/footer.html';
            exit();
        }
    } else {
        print_r($verifyPwd_errors);
    }
}
?>
