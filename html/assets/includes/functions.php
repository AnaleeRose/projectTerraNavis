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



// img uploader ----------------------------------------------------------------------------------------------------->
if (isset($_POST['publishMediaBtn']) && $media_type === 'article')  {
    if (!empty($_FILES['img']['name']) && !empty(trim($_POST['caption'])) && (!isset($_POST['img_location']) || empty($_POST['img_location']))) {
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
		        	if (!isset($img_width)) $img_width = 600;
		        	if (!isset($img_height)) $img_height = 400;
		            $checkFile = true;
		            $filename = preg_replace('/\s+/', '_', preg_replace('/\PL/u', '', $_POST['article_name'])) . '_' . $random_num;
		            $complete_filename = $filename . '.' .$extension;
		            $move = move_uploaded_file($cf['tmp_name'], $destination . $complete_filename);
					list($c_width, $c_height, $c_type, $c_attr) = getimagesize($destination . $complete_filename);
					$size_confirmation = false;
					if ($c_width > 500 && $c_height > 300) {
						echo 'confirmed size';
						$size_confirmation = true;
					} else {
						echo 'cap';
						$img_errors[] = 'Image is too small, please upload a larger version';
					}
		            if ($move && $size_confirmation) {
		            	echo ' resized dat boi';
						$pic_name_location = $destination . $complete_filename;
						switch ($extension) {
							case 'png': 
								$create_img = imagecreatefrompng($pic_name_location);
								$resize_img = imagescale($create_img, $img_width, $img_height);
								$resized_filename = 'resized_' . $complete_filename;
								$newName = $destination . $resized_filename;
								imagepng($resize_img, $newName, 9);
								if (file_exists($destination . $complete_filename)) {
									unlink($destination . $complete_filename);
								}
								break;

							case 'gif': 
								$create_img = imagecreatefromgif($pic_name_location);
								$resize_img = imagescale($create_img, $img_width, $img_height);
								$resized_filename = 'resized_' . $complete_filename;
								$newName = $destination . $resized_filename;
								imagegif($resize_img, $newName, 9);
								if (file_exists($destination . $complete_filename)) {
									unlink($destination . $complete_filename);
								}
								break;

							case 'jpg': 
								$create_img = imagecreatefromjpeg($pic_name_location);
								$resize_img = imagescale($create_img, $img_width, $img_height);
								$resized_filename = 'resized_' . $complete_filename;
								$newName = $destination . $resized_filename;
								imagejpeg($resize_img, $newName, 9);
								if (file_exists($destination . $complete_filename)) {
									unlink($destination . $complete_filename);
								}
								break;

							default: $img_errors[] = 'Unknown picture type: ' . $pic_type ; break;
						}

						if (empty($img_errors)) {
							$directory = new RecursiveDirectoryIterator('./assets/imgs/article_imgs');
							$filter = new DirnameFilter($directory, '/^(?!\.Trash)/'); 
							$filter = new FilenameFilter($filter, '/^(?:' . $resized_filename . ')$/');
							foreach (new RecursiveIteratorIterator($filter) as $file) {
							    if (preg_match('/\.(?:gif|png|jpg|jpeg)$/i', $file)) {
							        $img_location = $file;
							    }
							}
						}

		                $img_notices[] = $cf['name'] . ' was uploaded';
		                $_POST['img_name'] = $resized_filename;
		                $_POST['img_location'] = $destination . $resized_filename;

		                require './assets/includes/imageBrowser.inc.php';

		            }
		        }
		    }
			if (empty($img_location)) $img_errors[] = 'Image could not be uploaded. Please contact our service team.';
		} catch (Exception $e) {
		    echo $e->getMessage();
		}
	}
}



// image browser ----------------------------------------------------------------------------------------------------->






 // img resizer ----------------------------------------------------------------------------------------------------->








