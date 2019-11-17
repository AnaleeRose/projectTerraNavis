<?php
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
// $user = 'admin';
require MYSQL;
$q = 'DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateProfilePic`(pid int(6), uid int(11))
BEGIN
	UPDATE `adminuser` SET `profilePic_id` = pid WHERE `adminuser`.`admin_id` = uid;
	SELECT pic_location FROM profilepictures WHERE profilePic_id = pid;
END$$
DELIMITER ;';
$r = mysqli_query($dbc, $q);
if ($r) {
	echo "worked";
} else {
	echo "uh oh";
}
?>