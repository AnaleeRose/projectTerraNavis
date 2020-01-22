<?php 
require 'functions.inc.php';

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
} elseif (isset($_POST['emailInput']) && empty($_POST['emailInput'])) {
    $email_errors[] = "Please enter a valid email address";
}
$this_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
    <script src="assets/js/animations.js" defer></script>
    <script src="assets/js/functionality.js" defer></script>
	<?php if ($page === "c_article") { ?>
		<meta property="fb:app_id" content="484053738969775"/>
		<meta property="og:url"           content="<?= $this_url ?>" />
		<meta property="og:type"          content="website" />
		<meta property="og:title"         content="Terra Navis | <?= $a_name ?>" />
		<meta property="og:description"   content="<?= $a_desc ?>" />
		<meta property="og:image"         content="https://terranavis.life/html/404duck.png" />
	  <script defer>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
	<?php }
		page_colors();
	?>

</head>
