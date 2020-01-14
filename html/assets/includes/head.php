<?php 
$email_errors = [];
if (isset($_POST['emailInput']) && !empty($_POST['emailInput'])) {
	require MYSQL;
  if (filter_var($_POST['emailInput'], FILTER_VALIDATE_EMAIL)) {
    $q = 'SELECT * FROM `email_list` WHERE `email` = "' . $_POST['emailInput'] . '"';
    $r = mysqli_query($dbc, $q);
    if ($r && mysqli_num_rows($r) == 0) {
	    $stmt = $dbpdo->prepare("INSERT INTO `email_list` (`id`, `email`) VALUES (NULL, :email)");
	    $stmt->bindParam(':email', $_POST['emailInput'], PDO::PARAM_STR);
	    if ($stmt->execute()) {
	    	header("Location: " . BASE_URL . "html/thankyou.php?p=n");
	    }
    } elseif ($r && mysqli_num_rows($r) > 0) {
    	$email_errors[] = "You are already subscribed";
    } else {
    	$email_errors[] = "Something went wrong, please try again later";
    }
  } else {
    $email_errors[] = "Please enter a valid email address";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Terra Navis Living<?php if (isset($page_title)) echo '| ' . $page_title; ?></title>
    <meta name="description" content="Earthship bio-friendly homes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/revamped.css">
    <script src="assets/js/animations.js" async></script>
    <script src="assets/js/functionality.js" defer></script>
</head>
