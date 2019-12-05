<?php
// basic functions used throughout the site
require './../html/assets/includes/functions.php';
if (isset($sub)) {
  $pic_type = strtolower(strrchr($picture['name'],"."));
  $pic_name = "original$pic_type";
  move_uploaded_file($picture['tmp_name'], $pic_name);
  if (true !== ($pic_error = @image_resize($pic_name, "100x100$pic_type", 100, 100, 1))) {
    echo $pic_error;
    unlink($pic_name);
  }
  else echo "OK!";
}
?>
<form method="post" enctype="multipart/form-data">
<input type="file" name="img">
<input type="submit" name="sub">
</form>