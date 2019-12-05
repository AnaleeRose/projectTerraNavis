 <?php
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
                    $checkFile = true;
                    $random_number = rand(0, 10) . rand(0, 10) . rand(0, 9);
                    $filename = preg_replace('/\s+/', '_', $_POST['article_name']) . '_' . $random_number;
                    $complete_filename = $filename . '.' .$extension;
                    $move = move_uploaded_file($cf['tmp_name'], $destination . $complete_filename);
                    if ($move) {
                        $img_notices[] = $cf['name'] . ' was uploaded';
                        $_POST['img_name'] = $complete_filename;

                        require './assets/includes/imageBrowser.inc.php';

                    } else {
                        $img_errors[] = 'Image could not be uploaded. Please contact our service team.';
                    }
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
