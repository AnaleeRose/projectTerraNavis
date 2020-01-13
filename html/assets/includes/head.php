<?php 
$email_errors = [];
if (isset($_POST['emailInput']) && !empty($_POST['emailInput'])) {
	require MYSQL;
  if (filter_var($_POST['emailInput'], FILTER_VALIDATE_EMAIL)) {
  	$v_num = rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
    $stmt = $dbpdo->prepare("INSERT INTO `email_list` (`id`, `email`, `verified`, `verification_number`) VALUES (NULL, :email, '0', :v_num)");
    $stmt->bindParam(':email', $_POST['emailInput'], PDO::PARAM_STR);
    $stmt->bindParam(':v_num', $_POST['emailInput'], PDO::PARAM_INT);
    if ($stmt->execute()) {
    	header("Location: " . BASE_URL . "html/thankyou.php");
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
