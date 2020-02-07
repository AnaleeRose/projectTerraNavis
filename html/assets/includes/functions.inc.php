<?php

function nd($class, $id) {
    if (($class !== 'noClass') && ($id !== 'noID')) {
        echo '<div class="' . $class . '" id="'. $id . '">';
    } elseif (isset($class) && $id === 'noID') {
        echo '<div class="' . $class . '">';
    } elseif ($class === 'noClass' && isset($id)) {
        echo '<div id="' . $id . '">';
    }
}

function ed() {
    echo '</div>';
}

function page_colors() {
    global $page;
    echo '<style>
	:root {';
    switch (strtolower($page)) {
    	default:
    		echo "
			      --pageColor: var(--home);
			      --pageColor-shade: var(--home-shade);
			      --pageColor-link: var(--home-link);
			";
			break;
    }

	echo '}</style>';

}

abstract class FilesystemRegexFilter extends RecursiveRegexIterator {
    protected $regex;
    public function __construct(RecursiveIterator $iterate, $regex) {
        $this->regex = $regex;
        parent::__construct($iterate, $regex);
    }
}

class FilenameFilter extends FilesystemRegexFilter {
    public function accept() {
        return (! $this->isFile() || preg_match($this->regex, $this->getFilename()));
    }
}

class DirnameFilter extends FilesystemRegexFilter {
    public function accept() {
        return (! $this->isDir() || preg_match($this->regex, $this->getFilename()));
    }
}

function pullImage($filename) {
	$directory = new RecursiveDirectoryIterator(IMG_PATH);
	$filter = new DirnameFilter($directory, '/^(?!\.Trash)/');
	$filter = new FilenameFilter($filter, '/^(?:' . $filename . ')$/');
	foreach (new RecursiveIteratorIterator($filter) as $file) {
	    if (preg_match('/\.(?:gif|png|jpg|jpeg)$/i', $file)) {
	        $GLOBALS['img_location'] = $file;
	        $GLOBALS['img_name'] = $filename;
	    }
	}
}


// img uploader ----------------------------------------------------------------------------------------------------->
if (!isset($newArticle)) $newArticle = true;

// example ternary op
// $answer = ($newArticle === true ? "new article" : "old article");
// echo $answer;

if (isset($_POST['publishMediaBtn']) && $media_type === 'article')  {
    if (!empty($_FILES['img']['name']) && !empty(trim($_POST['caption']))) {
		 $permitted = [
		    'image/gif',
		    'image/jpeg',
		    'image/jpg',
		    'image/png'
		];

		$max_image_size = 500000;
		$destination = './assets/imgs/article_imgs/';
		$imgCaption = $_POST['caption'];
		$extension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
		$extension = strtolower($extension);
		if (in_array($extension, $permitted)) {
			try {
			    $checkFile = false;
			    $uploaded = current($_FILES);
			    if (isset($uploaded)) {
			        $cf['name'] = $_FILES['img']['name'];
			        $cf['type'] = $_FILES['img']['type'];
			        $cf['tmp_name'] = $_FILES['img']['tmp_name'];
			        $cf['error'] = $_FILES['img']['error'];
			        $cf['size'] = $_FILES['img']['size'];


			        if ($cf['error'] == 1 || $cf['error'] == 2) {
			            $img_errors[] = "Something went wrong... Please try again later!";
			            $checkSize = false;
			        } elseif ($cf['size'] == 0) {
			            $img_errors[] = $cf['name'] . ' is an empty file.';
			            $checkSize = false;
			        } elseif ($cf['size'] > $max_image_size) {
			            $img_errors[] = $cf['name'] . ' exceeds the maximum size
			                for a file (' . $max_image_size . ').';
			            $checkSize = false;
			        } else {
			            $checkSize = true;
			        }

			        if (in_array($cf['type'], $permitted)) {
			            $checkType = true;
			        } else {
			            if (!empty($_FILES['type'])) {
			                $img_errors[] = $cf['name'] . ' is not permitted type of file.';
			            }
			            $checkType = false;
			        }

			        if ($cf['error'] != 0) {
			            $img_errors[] = "Something went wrong... Please try again later!";
			            // stop checking if no file submitted
			            if ($file['error'] != 4) {
			                $img_errors[] = "Something went wrong... Please try again later! Error code: 4";
			            }
			        }

			        if ($checkSize && $checkType && empty($img_errors)) {
			        	if ($newArticle === true && (!isset($_POST['img_location']) || empty($_POST['img_location']))) {
					        $_tempErrors[] = "FINEME NEW ARTICLE";
				        	if (!isset($img_width)) $img_width = 600;
				        	if (!isset($img_height)) $img_height = 400;
				            $checkFile = true;
				            $filename = preg_replace('/\s+/', '_', preg_replace('/\PL/u', '', $_POST['article_name'])) . '_' . $random_num;
				            $complete_filename = $filename . '.' .$extension;
				            $move = move_uploaded_file($cf['tmp_name'], $destination . $complete_filename);
							list($c_width, $c_height, $c_type, $c_attr) = getimagesize($destination . $complete_filename);
							$size_confirmation = false;
							$resize = true;
							if ($c_width > 500 && $c_height > 300) {
								$size_confirmation = true;
								if (($c_width > 600 && $c_height > 400) && ($c_width < 800 && $c_height < 600)) {
									$resize = false;
								}
							} else {
								$img_errors[] = 'Image is too small, please upload a larger version';
							}
				            if ($move && $size_confirmation) {
								$pic_name_location = $destination . $complete_filename;
								if ($extension == 'jpeg') $extension = 'jpg';
								switch ($extension) {
									case 'png':
										$resized_filename = 'resized_' . $complete_filename;
										$create_img = imagecreatefrompng($pic_name_location);
										$resize_img = imagescale($create_img, $img_width, $img_height);
										$newName = $destination . $resized_filename;
										imagepng($resize_img, $newName, 9);
										if (file_exists($destination . $complete_filename)) {
											unlink($destination . $complete_filename);
										}
										imagedestroy($resize_img);
										break;

									case 'gif':
										$resized_filename = 'resized_' . $complete_filename;
										$create_img = imagecreatefromgif($pic_name_location);
										$resize_img = imagescale($create_img, $img_width, $img_height);
										$resized_filename = 'resized_' . $complete_filename;
										$newName = $destination . $resized_filename;
										imagegif($resize_img, $newName);
										if (file_exists($destination . $complete_filename)) {
											unlink($destination . $complete_filename);
										}
										imagedestroy($resize_img);
										break;

									case 'jpg':
										$resized_filename = 'resized_' . $complete_filename;
										$create_img = imagecreatefromjpeg($pic_name_location);
										$resize_img = imagescale($create_img, $img_width, $img_height);
										$newName = $destination . $resized_filename;
										imagejpeg($resize_img, $newName, 100);
										if (file_exists($destination . $complete_filename)) {
											unlink($destination . $complete_filename);
										}
										imagedestroy($resize_img);
										break;

									default: $img_errors[] = 'Unknown picture type: ' . $extension ; break;
								}

								if (empty($img_errors)) {
									pullImage($resized_filename);
									if (empty($img_location) || empty($img_name)) $img_errors[] = 'Something went wrong while uploading that image. Please contact our service team.';
								}

				                $img_notices[] = $cf['name'] . ' was uploaded';
				                $_POST['img_name'] = $resized_filename;
				                $_POST['img_location'] = $destination . $resized_filename;

				            }
				        	} elseif ($newArticle === false) { //new article ver above, edit article ver below
					        	$_tempErrors[] = "FINEME OLD ARTICLE";
								if (!isset($img_width)) $img_width = 600;
					        	if (!isset($img_height)) $img_height = 400;
					            $checkFile = true;
					            if (isset($article_id)) {
						            $q = "SELECT img_name FROM articles WHERE article_id = " . $article_id;
									$r = mysqli_query($dbc, $q);
									if ($r && mysqli_num_rows($r) > 0) {
										$filename = mysql_fetch_assoc($r);
								    } else {
								    	$_tempErrors[] = "FINEME: R WRONG";
								    }
									substr($filename, 0, -4);
								} else {
					            	$filename = preg_replace('/\s+/', '_', preg_replace('/\PL/u', '', $_POST['article_name'])) . '_' . $random_num;
								}

					            $complete_filename = $filename . '.' .$extension;
					            $move = move_uploaded_file($cf['tmp_name'], $destination . $complete_filename);
								list($c_width, $c_height, $c_type, $c_attr) = getimagesize($destination . $complete_filename);
								$size_confirmation = false;
								$resize = true;
								if ($c_width > 500 && $c_height > 300) {
									$size_confirmation = true;
									if (($c_width > 600 && $c_height > 400) && ($c_width < 1000 && $c_height < 800)) {
										$resize = false;
									}
								} else {
									$img_errors[] = 'Image is too small, please upload a larger version';
								}
					            if ($move && $size_confirmation) {
									$pic_name_location = $destination . $complete_filename;
									if ($extension == 'jpeg') $extension = 'jpg';
									switch ($extension) {
										case 'png':
											$resized_filename = 'resized_' . $complete_filename;
											$create_img = imagecreatefrompng($pic_name_location);
											$resize_img = imagescale($create_img, $img_width, $img_height);
											$newName = $destination . $resized_filename;
											imagepng($resize_img, $newName, 9);
											if (file_exists($destination . $complete_filename)) {
												unlink($destination . $complete_filename);
											}
											imagedestroy($resize_img);
											break;

										case 'gif':
											$resized_filename = 'resized_' . $complete_filename;
											$create_img = imagecreatefromgif($pic_name_location);
											$resize_img = imagescale($create_img, $img_width, $img_height);
											$resized_filename = 'resized_' . $complete_filename;
											$newName = $destination . $resized_filename;
											imagegif($resize_img, $newName);
											if (file_exists($destination . $complete_filename)) {
												unlink($destination . $complete_filename);
											}
											imagedestroy($resize_img);
											break;

										case 'jpg':
											$resized_filename = 'resized_' . $complete_filename;
											$create_img = imagecreatefromjpeg($pic_name_location);
											$resize_img = imagescale($create_img, $img_width, $img_height);
											$newName = $destination . $resized_filename;
											imagejpeg($resize_img, $newName, 100);
											if (file_exists($destination . $complete_filename)) {
												unlink($destination . $complete_filename);
											}
											imagedestroy($resize_img);
											break;

										default: $img_errors[] = 'Unknown picture type: ' . $extension ; break;
									}

									if (empty($img_errors)) {
										pullImage($resized_filename);
										if (empty($img_location) || empty($img_name)) $img_errors[] = 'Something went wrong while uploading that image. Please contact our service team.';
									}

					                $img_notices[] = $cf['name'] . ' was uploaded';
					                $_POST['img_name'] = $resized_filename;
					                $_POST['img_location'] = $destination . $resized_filename;

				    	        }
				        } 
			        } // END if basic image checks
			    } // END if uploaded
			} catch (Exception $e) {
			   $_tempErrors[] = $e->getMessage();
			}
		} else {
			$img_errors[] = "Only png, gif, jpg, and jpeg files are accepted";
		} // END appropiate extention if/else
	} // END basic checks
} // END if the button has been pressed and we're dealing wiht an article


if (isset($pageTitle) && strtolower($pageTitle) === 'edit article' && !isset($_POST['publishMediaBtn']) && isset($img_name)) {
	pullImage($img_name);
}



// image browser ----------------------------------------------------------------------------------------------------->






 // img resizer ----------------------------------------------------------------------------------------------------->








