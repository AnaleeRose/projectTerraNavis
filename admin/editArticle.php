<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
require MYSQL; // connect to db
require './assets/includes/form_functions_edit.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php'; // various functions
$media_type = 'article';

// build list of expected, required, and possile post values based on media type
$expected = ['article_name', 'article_category', 'article_description', 'imgs'];
$required = ['article_name', 'article_category'];
$possible = [];
$element_types = ['p', 'heading2', 'heading3', 'heading4', 'heading5', 'hr', 'ul', 'ol']; // we'll build all possible lists from this list l8r
$article_id = $_GET['article_id'];
$allElementsUsed = '';
$q = "SELECT * FROM articles WHERE article_id = $article_id";
$r = mysqli_query($dbc, $q);
if ($r) {
    foreach ($r->fetch_assoc() as $key => $value) {
        $contentName = ':|s|:' . $key . ':|e|:';
        if (isset($_POST[$key])) {
            $_POST[$key] = $_POST[$key] . $contentName;
        } else {
            $_POST[$key] = $value . $contentName;
        }
        $start = strpos($_POST[$key], ':|s|:');
        $start = $start + 5;
        $end = strpos($_POST[$key], ':|e|:');
        $length = $end - $start;
        $key['contents'] = $value;
        $key['content_name'] = substr($_POST[$key], $start, $length);
        echo $key['content_name'] . ' is ' . $key['contents'] . "<br>";
    }
    // while ($row = $r->fetch_assoc()) {
    //     $previous_article_id = $row['article_id'];
    //     // $db_article_name = $row['article_name'];
    //     echo $row;
    //     if (isset($_POST['article_name'])) {
    //         $_POST['article_name'] = $_POST['article_name'] . ':|s|:article_name:|e|:';
    //     } else {
    //         $_POST['article_name'] = $row['article_name'] . ':|s|:article_name:|e|:';
    //     }
    //     if (stristr($_POST['article_name'], 'article_name')) {
    //         // echo '<br> INFO: ' . substr($_POST['article_name'], -20, 22) . '<br>';
    //         $db_article_name['contents'] = $row['article_name'];
    //         $start = strpos($_POST['article_name'], ':|s|:');
    //         $start = $start + 5;
    //         $end = strpos($_POST['article_name'], ':|e|:');
    //         $length = $end - $start;
    //         $db_article_name['content_name'] = substr($_POST['article_name'], $start, $length);
    //         // $db_article_name['content_name'] substr($_POST['article_name'], -20, 22);
    //         print_r($db_article_name);
    //     } else {
    //         echo 'oh noe';
    //     }
    //     // $_POST['article_name']['content'] = $row['article_name'];
    //     // $_POST['article_description']['content'] = $row['article_description'];
    //     // $_POST['article_category']['content'] = $row['article_category'];
    // }

    $q = "SELECT * FROM `article_content` WHERE article_id = $article_id";
    $r = mysqli_query($dbc, $q);
    if ($r) {
        while ($row = $r->fetch_assoc()) {
            $elementName =  $row['element_name'];
            $_POST[$elementName]['content'] = $row['content'];
            $_POST[$elementName]['elementName'] = $elementName;
            $allElementsUsed .= $elementName . ',';
            if (isset($row['is_first_li']) && $row['is_first_li'] === true) {
                $_POST[$elementName]['first_li'] = true;

                $this_element_type = 'li';
            } else {
                echo 'other';
            }
        }
    }
} else {
    echo 'no r';
}
print_r($_POST);
// echo '<br>elementTracker: ';
// print_r($allElementsUsed);
// echo '<br>';
if (!empty($allElementsUsed)) {
    echo 'NOT EMPTY';
    if (!empty($_POST['elementTracker'])) {
        $_POST['elementTracker'] = $_POST['elementTracker'] . $allElementsUsed;
    } else {
        $_POST['elementTracker'] = $allElementsUsed;
    }
} else {
    echo 'woops';
}

?>
<?php

$newArticle_errors = []; //tracks all errors
$firstLists = []; //
if (!isset($trackElements)) $trackElements = []; // tracks element id and order
$at_least_one_element = false;

// generates all possible values for possible list **
$max_on_page = 5;
$max_lists_on_page = 2;
$max_li_on_page = 20;
$list_names;
$listAll = [];
$last = [];

foreach ($element_types as $each_element_type) {
    $x = 1;
    if ($each_element_type === 'ul' || $each_element_type === 'ol') {
        while ($x <= $max_lists_on_page) {
            $list_name = $each_element_type . '_' . $x;
            $list_names[] = $list_name;
            $x++;
        }
    } else {
        while ($x <= $max_on_page) {
            $individual_element =  $each_element_type . '_' . $x ;
            $possible[] = $individual_element;
            $x++;
        }
    }
}

foreach ($list_names as $each_list) {
    $first = false;
    $i = 1;
    while ($i <= $max_li_on_page) {
        $individual_li =  $each_list . '_li_' . $i;
        $possible[] = $individual_li;
        if($first === false) {
            $firstLists[] = $individual_li;
            $first = true;
        }
        $i++;
    }
}

// END possible list generator **

// SPECIAL HANDILING FOR LISTS
// gathers info on all lists/list items
foreach ($possible as $elementToCheck) {
    if (strpos($elementToCheck, 'l') !== false) {
        if (isset($_POST[$elementToCheck]) && !empty($_POST[$elementToCheck])) {
            $list_type = substr($elementToCheck, 0, 2);
            $list_num = substr($elementToCheck, 3, 1);
            $list_name = $list_type . '_' . $list_num;
            $listAll[$list_name][] = $elementToCheck;
        }
    }
}

// notes whish list items are the last of their list
if (!empty($listAll) && is_array($listAll)) {
    foreach ($listAll as $elementToCheck) {
        $last[] = end($elementToCheck);
    }
}


// CHECK PAGE IF SUBMITTED----------------------------------------------------------->
if (isset($_POST['publishMediaBtn'])) {
    // ERROR HANDLING
    // if a required item is empty, toss an error
    if (empty($_POST['article_name']['content'])) $newArticle_errors['article_name'] = "Missing: Name";
    if (empty($_POST['article_category']['content']) || $_POST['article_category']['content'] === 1) $newArticle_errors['article_category'] = "Missing: Category";
    if (empty($_POST['article_description']['content']) || $_POST['article_description']['content'] === 1) $newArticle_errors['article_description'] = "Missing: Description";
    foreach ($possible as $elementToCheck) {
        if (isset($_POST[$elementToCheck]) && !empty($_POST[$elementToCheck])) {
            $at_least_one_element = true;
            break;
        }
    }

    if ($at_least_one_element === false) {
        $newArticle_errors['article_name'] = "No content in article...";
    }




    // grabbing the list of elements from js, stripping it of any spaces, and creating an array from it to use as a guide on the order of the elements

    // IS IT TIME TO SEND TO DB???? ---------------------------------------------->
}





// PAGE HTML ---------------------------------------------------------------->
require './assets/includes/header.html';
echo '<body id="pageWrapper" class="' . $_SESSION['light_mode'] . '">';
$options = ['required' => null];
    require './assets/includes/adminMenu.php';
    require './assets/includes/newsfeed_active.php';
    nd('adminMC_Wrapper', 'noDI');
        nd('newMedia', 'noID');
            // nd('adminMainContent', 'mainContent');
            ?>
            <div class="newMediaHeading">
                <h2 class="adminHeading">Edit Article: <?= $db_article_name['contents'] ?></h2>
                <div class="cornerLinks">
                <?php
                echo '<a href="./new.php?media_type=article&clear=true" class="adminBtn adminBtn_danger">Clear Page</a>';
                ?>
                </div>
                <!-- <a href="new?media_type<?= $media_type ?>&clear=true" class="adminBtn adminBtn_danger">Clear Page</a> -->
            </div>
            <form class="newMediaForm" method="post">
            <?php

                if ($media_type === 'article') {
                    $options = ['required' => null, 'placeholder' => 'Name', 'maxlength' => 50, 'value' => $db_article_name['contents']];
                    create_form_input('article_name', 'text', 'Aricle Name: ', $newArticle_errors, $options);
                    ?>
                    <label for="article_category">Category</label>
                    <select class="categorySelect" required name="article_category" id="article_category">
                        <option value="" disabled selected>Select Category</option>
                    <?php
                    $q = "SELECT * FROM categories";
                    $r = mysqli_query($dbc, $q);
                    if ($r) {
                        while ($row = $r->fetch_assoc()) {
                            echo '<option value="' . $row['category_id'] . '"';
                            if (isset($_POST['article_category'])) echo 'selected';
                            echo '>' . $row['category']. '</option>';
                        }
                    }
                    echo '</select>';
                    if (array_key_exists('article_category', $newArticle_errors)) echo '<p class="formNotice formNotice_InlineError text_error">' . $newArticle_errors['article_category'] . ' </p>';
                    $options = ['required' => null, 'placeholder' => 'Description', 'maxlength' => 250];
                    create_form_input('article_description', 'textarea', 'Description', $newArticle_errors, $options);
                    // create_form_input('addThisContent', 'hidden', '', $newArticle_errors);
                ?>
                <input type="text" id="elementTracker" name="elementTracker" class="hidden" value="<?php if (isset($_POST['elementTracker'])) echo $_POST['elementTracker']; ?> " data-general-max="<?= $max_on_page ;?>" data-max-li="<?= $max_li_on_page ;?>" data-max-lists="<?= $max_lists_on_page ;?>">
                <?php
                    print_r($_POST['elementTracker']);
                    $noSpaceElementTracker = str_replace(' ', '', $_POST['elementTracker']);
                    $elementsUsed = explode(',', $noSpaceElementTracker);
                ?>
                <hr class="newHr">
<!-- Add content when you click a content link -->
                    <div id="newContent" class="newContent">
                        <?php require './assets/includes/contentTypeSwitch_edit.php'; ?>
                    </div>
<!-- check content if you clicked published and send it on it's way! -->
<?php
    if (isset($_POST['publishMediaBtn'])) {
        if (empty($newArticle_errors) && $at_least_one_element === true) {
            // $q = "DELETE FROM `articles` WHERE `articles`.`article_id` = $previous_article_id";
            // $r = mysqli_query($dbc, $q);
            // if ($r) {
                // $a_name = $_POST['article_name'];
                // $a_description = $_POST['article_description'];
                // $a_category = $_POST['article_category'];

                // $stmt = $dbpdo->prepare("INSERT INTO articles (article_id, article_name, article_description, article_category, date_added, date_modified) VALUES (NULL, :a_name, :a_description, :a_category, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                // // bind the paramaters
                // $stmt->bindParam(':a_name', $a_name, PDO::PARAM_STR);
                // $stmt->bindParam(':a_description', $a_description, PDO::PARAM_STR);
                // $stmt->bindParam(':a_category', $a_category, PDO::PARAM_INT);

                // execute the prepared statement
                // if ($stmt->execute()) {
                    // echo 'added';
                    // $article_db_id = $dbpdo->lastInsertId();
                    $article_db_id = 24;
                    foreach ($trackElements as $this_element_name => $this_element_info) {
                        if (strpos($this_element_name, 'l') !== false) {
                            $this_element_id = $this_element_info['id'];
                            $this_element_order = $this_element_info['order'];
                            $this_element_content = $this_element_info['content'];
                            if (isset($this_element_info['first_li'])) {
                                $this_element_first_li = 1;
                            } else {
                                $this_element_first_li = 0;
                            }

                            if (isset($this_element_info['last_li'])) {
                                $this_element_last_li = 1;
                            } else {
                                $this_element_last_li = 0;
                            }
                            echo "INSERT INTO `article_content` (`content_id`, `article_id`, `content_type`, `order_of_content`, `content`, `is_first_li`, `is_last_li`) VALUES (NULL, $article_db_id, $this_element_id, $this_element_order, '$this_element_content', $this_element_first_li, $this_element_last_li)";

                            // $stmt = $dbpdo->prepare("INSERT INTO `article_content` (`content_id`, `article_id`, `content_type`, `order_of_content`, `content`, `is_first_li`, `is_last_li`) VALUES (NULL, :a_db_id, :elem_id, :elem_order, :elem_content, :elem_first_li, :elem_last_li)");
                            // $stmt->bindParam(':a_db_id', $article_db_id, PDO::PARAM_INT);
                            // $stmt->bindParam(':elem_id', $this_element_id, PDO::PARAM_INT);
                            // $stmt->bindParam(':elem_order', $this_element_order, PDO::PARAM_INT);
                            // $stmt->bindParam(':elem_content', $this_element_content, PDO::PARAM_STR);
                            // $stmt->bindParam(':elem_first_li', $this_element_first_li, PDO::PARAM_INT);
                            // $stmt->bindParam(':elem_last_li', $this_element_last_li, PDO::PARAM_INT);
                            // if ($stmt->execute()) {
                            //     echo "<br>_LILILILIGOOD_<br>";
                            // } else {
                            //     print_r($dbpdo->errorInfo());
                            // }
                        } else {

                            $this_element_id = $this_element_info['id'];
                            $this_element_order = $this_element_info['order'];
                            $this_element_content = $this_element_info['content'];
                            echo "INSERT INTO `article_content` (`content_id`, `article_id`, `content_type`, `order_of_content`, `content`) VALUES (NULL, $article_db_id, $this_element_id, $this_element_order, '$this_element_content')";
                            // $stmt = $dbpdo->prepare("INSERT INTO `article_content` (`content_id`, `article_id`, `content_type`, `order_of_content`, `content`) VALUES (NULL, :a_db_id, :elem_id, :elem_order, :elem_content)");
                            // $stmt->bindParam(':a_db_id', $article_db_id, PDO::PARAM_INT);
                            // $stmt->bindParam(':elem_id', $this_element_id, PDO::PARAM_INT);
                            // $stmt->bindParam(':elem_order', $this_element_order, PDO::PARAM_INT);
                            // $stmt->bindParam(':elem_content', $this_element_content, PDO::PARAM_STR);
                            // if ($stmt->execute()) {
                            //     echo "<br>_OTHERGOOD_<br>";
                            // } else {
                            //     echo '<br>_OTHERBAD_<br>';
                            }
                        }
                    // } // foreach END

                    // header('Location: http://localhost:81/bpa/admin/editArticle.php?article_id=' . $article_db_id);

                // } //stmt execute END
            // }
    } // no errors, contents exists check END
} // btn was pushed END
?>
                    <div class="contentTypes">
                        <p data-contentType="p" class="contentTypeBtn contentPhpBtn" data-content_type_id=1>Paragraph</p>
                        <div class="contentTypeList">
                            <p class="contentTypeBtn headerBtn">Header</p>
                            <ol class="headerContentTypes hidden">
                                <li class="contentPhpBtn" data-contentType="h2" data-content_type_id=2>Heading 2</li>
                                <li class="contentPhpBtn" data-contentType="h3" data-content_type_id=3>Heading 3</li>
                                <li class="contentPhpBtn" data-contentType="h4" data-content_type_id=4>Heading 4</li>
                                <li class="contentPhpBtn" data-contentType="h5" data-content_type_id=5>Heading 5</li>
                            </ol>
                        </div>
                        <p class="contentTypeBtn contentPhpBtn" data-contentType="hr" data-content_type_id=6 >Horizontal Line</p>
                        <div class="contentTypeList">
                            <p class="contentTypeBtn listBtn">List</p>
                            <ul class="listContentTypes hidden">
                                <li><p class="contentPhpBtn" data-contentType="ul" data-content_type_id=7>Unordered List</p></li>
                                <li><p class="contentPhpBtn" data-contentType="ol" data-content_type_id=8>Ordered List</p></li>
                            </ul>
                        </div>
                        <label for="imgs" class="contentTypeBtn uploadImgBtn" id="uploadImgBtn" data-content_type_id=9>Image</label>
                        <small class="imgsNotice">Images will be placed automatically, based upon size</small>
                <input type="file" name="imgs" class="hidden" id="imgs" onChange="file_funct" data-content_type_id=9>
                    </div>


                    <input type="submit" name="publishMediaBtn" id="publishBtn" class="adminBtn adminBtn_accent publishBtn" value="Publish Article">
                <?php
                }

                ?>


            </form>
            <?php
            ed();
        ed();
    ed();
require './assets/includes/footer.html';
ob_end_flush();
?>

