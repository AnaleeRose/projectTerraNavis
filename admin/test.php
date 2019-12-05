<?php
// basic functions used throughout the site
require './../html/assets/includes/functions.php';
$dest = './test_folder/';
if (isset($_POST['sub'])) {
	$picture = $_FILES['img'];
	$pic_type = strtolower(strrchr($picture['name'],"."));
	$pic_name = $picture['name'];
	if ($pic_type === 'jpeg') $pic_type = 'jpg';
	$pic_name = $dest . $pic_name;
	move_uploaded_file($picture['tmp_name'], $pic_name);
	$imageQuality="100";
	switch ($pic_type) {
		case '.png': 
			$create_img = imagecreatefrompng($pic_name);
			$resize_img = imagescale($create_img, 500, 400);
			$newName = $dest . 'resizedpng.png';
			$invertScaleQuality = 9 - round(($imageQuality/100) * 9);
			imagepng($resize_img, $pic_name, $invertScaleQuality);
			break;
		case '.gif': 
			$create_img = imagecreatefromgif($pic_name);
			$resize_img = imagescale($create_img, 500, 400);
			$newName = $dest . 'resizedg.gif';
			// move_uploaded_file($resize_img, $newName);
			break;
		case '.jpg': 
			$create_img = imagecreatefromjpg($pic_name);
			$resize_img = imagescale($create_img, 500, 400);
			$newName = $dest . 'resizedj.jpg';
			// move_uploaded_file($resize_img, $newName);
			break;
		default: echo 'unknown ' . $pic_type ; break;
	}
}
?>
<form method="post" enctype="multipart/form-data">
<input type="file" name="img">
<input type="submit" name="sub">
</form>