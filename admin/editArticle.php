<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
$user = 'admin';
require MYSQL; // connect to db
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
if (!isset($_POST['publishMediaBtn'])) require './assets/includes/form_functions_edit.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php'; // various functions
$media_type = 'article';

// build list of expected, required, and possile post values based on media type
$expected = ['article_name', 'article_category', 'article_description', 'imgs'];
$required = ['article_name', 'article_category'];
$possible = [];
$element_types = ['p', 'heading2', 'heading3', 'heading4', 'heading5', 'hr', 'ul', 'ol']; // we'll build all possible lists from this list l8r
$article_id = $_GET['article_id'];
$elementsUsed;

$q = "SELECT * FROM `articles` WHERE article_id = $article_id";
$r = mysqli_query($dbc, $q);
if ($r && mysqli_num_rows($r) > 0) {
    while ($row = $r->fetch_assoc()) {
        if (!isset($_POST['article_name'])) $_POST['article_name'] = $row['article_name'];
        if (!isset($_POST['article_description'])) $_POST['article_description'] = $row['article_description'];
        if (!isset($_POST['article_category']))$_POST['article_category'] = $row['article_category'];
        if (!isset($_POST['date_added'])) $_POST['date_added'] = $row['date_added'];
        $date_added = $row['date_added'];
    }
} else {
    require './assets/includes/header.html';
    require './assets/includes/error.php';
    $links = ['Return To Home' => 'index.php'];
    produce_error_page('There\'s no record of that article. Please contact our service team to resolve the issue.', $links);
    require './assets/includes/footer.html';
    exit();
}

// $q = "SELECT `element_name`, `content_id`, `article_id`, `content_type`, `order_of_content`, `content`, `is_first_li`, `is_last_li` FROM `article_content` WHERE article_id = $article_id";
$q = "SELECT `element_name` FROM `article_content` WHERE article_id = $article_id";
$r = mysqli_query($dbc, $q);
if ($r && mysqli_num_rows($r) > 0) {
    while ($row = $r->fetch_assoc()) {
        $elementToCheck = $row['element_name'];
        if (strpos($elementToCheck, 'l') !== false) {
            $list_type = substr($elementToCheck, 0, 2);
            $list_num = substr($elementToCheck, 3, 1);
            $list_name = $list_type . '_' . $list_num;
            $listAll[$list_name][] = $elementToCheck;
        }
    }
} else {
    require './assets/includes/header.html';
    require './assets/includes/error.php';
    $links = ['Return To Home' => 'index.php'];
    produce_error_page('Something is wrong with the database. Please contact our service team to resolve the issue.', $links);
    require './assets/includes/footer.html';
    exit();
}


$newArticle_errors = []; //tracks all errors
$firstLists = []; //
$listAllElements = '';
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
} // builds a list of all possible values

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


if (!empty($listAll) && is_array($listAll)) {
    foreach ($listAll as $elementToCheck) {
        $last[] = end($elementToCheck);
    }
}


// CHECK PAGE IF SUBMITTED----------------------------------------------------------->
if (isset($_POST['publishMediaBtn'])) {
    // ERROR HANDLING
    // if a required item is empty, toss an error
    if (empty($_POST['article_name'])) $newArticle_errors['article_name'] = "Missing: Name";
    if (empty($_POST['article_category']) || $_POST['article_category'] === 1) $newArticle_errors['article_category'] = "Missing: Category";
    if (empty($_POST['article_description']) || $_POST['article_description'] === 1) $newArticle_errors['article_description'] = "Missing: Description";

    foreach ($possible as $elementToCheck) {
        if (isset($_POST[$elementToCheck]) && !empty($_POST[$elementToCheck])) {
            echo $_POST[$elementToCheck];
            $at_least_one_element = true;
            break;
        }
    }


    if ($at_least_one_element === false) {
        $newArticle_errors['article_name'] = "No content in article...";
    }

    // grabbing the list of elements from js, stripping it of any spaces, and creating an array from it to use as a guide on the order of the elements
    $noSpaceElementTracker = str_replace(' ', '', $_POST['elementTracker']);
    $elementsUsed = explode(',', $noSpaceElementTracker);

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
            ?>
            <div class="newMediaHeading">
                <h2 class="adminHeading">New <?= ucfirst($media_type) ?></h2>
                <div class="cornerLinks">
                <?php
                echo '<a href="./new.php?media_type=article&clear=true" class="adminBtn adminBtn_danger">Clear Page</a>';
                ?>
                </div>
            </div>
            <form class="newMediaForm" method="post">
            <?php

                if ($media_type === 'article') {
                    $options = ['required' => null, 'placeholder' => 'Name', 'maxlength' => 50];
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
                    $options = ['required' => null, 'placeholder' => 'Description', 'maxlength' => 400];
                    create_form_input('article_description', 'textarea', 'Description', $newArticle_errors, $options);
                    echo '<input type="text" name="date_added" id="date_added" class="textInput createInput hidden"' ;
                    if (isset($date_added)) echo ' value="' . $date_added . '"';
                    '>';
                ?>
                <hr class="newHr">
<!-- Add content when you click a content link -->
                    <div id="newContent" class="newContent">
                        <?php
                        if (isset($_POST['publishMediaBtn'])) {
                            require './assets/includes/contentTypeSwitch.php';
                        } else {
                            require './assets/includes/contentTypeSwitch_edit.php';
                        }
                        ?>
                    </div>
<!-- check content if you clicked published and send it on it's way! -->
<?php
    if (isset($_POST['publishMediaBtn'])) {
        if (empty($newArticle_errors) && $at_least_one_element === true) {
            $a_name = $_POST['article_name'];
            $a_description = $_POST['article_description'];
            $a_category = $_POST['article_category'];

            $stmt = $dbpdo->prepare("INSERT INTO articles (article_id, article_name, article_description, article_category, date_added, date_modified) VALUES (NULL, :a_name, :a_description, :a_category, :date_added, CURRENT_TIMESTAMP)");
            // bind the paramaters
            $stmt->bindParam(':a_name', $a_name, PDO::PARAM_STR);
            $stmt->bindParam(':a_description', $a_description, PDO::PARAM_STR);
            $stmt->bindParam(':a_category', $a_category, PDO::PARAM_INT);
            $stmt->bindParam(':date_added', $date_added, PDO::PARAM_STR);

            // // execute the prepared statement
            if ($stmt->execute()) {
                echo 'added';
                $article_db_id = $dbpdo->lastInsertId();
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

                        $stmt = $dbpdo->prepare("INSERT INTO `article_content` (`content_id`, `article_id`, `content_type`, `order_of_content`, `element_name`, `content`, `is_first_li`, `is_last_li`) VALUES (NULL, :a_db_id, :elem_id, :elem_order, :elem_name, :elem_content, :elem_first_li, :elem_last_li)");
                        $stmt->bindParam(':a_db_id', $article_db_id, PDO::PARAM_INT);
                        $stmt->bindParam(':elem_id', $this_element_id, PDO::PARAM_INT);
                        $stmt->bindParam(':elem_order', $this_element_order, PDO::PARAM_INT);
                        $stmt->bindParam(':elem_name', $this_element_name, PDO::PARAM_STR);
                        $stmt->bindParam(':elem_content', $this_element_content, PDO::PARAM_STR);
                        $stmt->bindParam(':elem_first_li', $this_element_first_li, PDO::PARAM_INT);
                        $stmt->bindParam(':elem_last_li', $this_element_last_li, PDO::PARAM_INT);
                        // if ($stmt->execute()) {
                        //     echo "<br>_LILILILIGOOD_<br>";
                        // } else {
                        //     print_r($dbpdo->errorInfo());
                        // }
                    } else {
                        $this_element_id = $this_element_info['id'];
                        $this_element_order = $this_element_info['order'];
                        $this_element_content = $this_element_info['content'];
                        $stmt = $dbpdo->prepare("INSERT INTO `article_content` (`content_id`, `article_id`, `content_type`, `order_of_content`, `element_name`, `content`) VALUES (NULL, :a_db_id, :elem_id, :elem_order, :elem_name, :elem_content)");
                        $stmt->bindParam(':a_db_id', $article_db_id, PDO::PARAM_INT);
                        $stmt->bindParam(':elem_id', $this_element_id, PDO::PARAM_INT);
                        $stmt->bindParam(':elem_name', $this_element_name, PDO::PARAM_STR);
                        $stmt->bindParam(':elem_order', $this_element_order, PDO::PARAM_INT);
                        $stmt->bindParam(':elem_content', $this_element_content, PDO::PARAM_STR);
                        if ($stmt->execute()) {
                            echo "<br>_OTHERGOOD_<br>";
                        } else {
                            echo '<br>_OTHERBAD_<br>';
                        }
                    }
                } // foreach END

                // $stmt = $dbpdo->prepare("DELETE FROM articles WHERE article_id = :a_id");
                // $stmt->bindParam(':a_id', $article_id, PDO::PARAM_STR);
                // if ($stmt->execute()) {
                $q = "DELETE FROM articles WHERE article_id = $article_id";
                $r = mysqli_query($dbc, $q);
                if ($r) {
                    header('Location: ' . BASE_URL . 'admin/editArticle.php?article_id=' . $article_db_id);
                } else {
                    echo("Error description: " . mysqli_error($dbc));
                    // echo "| DELETE FROM articles WHERE article_id = $article_id | ";
                    // echo 'not deleted';
                }
            } else {
                echo 'oh nos';
            } //stmt execute END
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


                    <input type="submit" name="publishMediaBtn" id="publishBtn" class="adminBtn adminBtn_accent publishBtn" value="Edit Article">
                <?php
                }
                ?>
                <input type="text" id="elementTracker" name="elementTracker" class="hidden" value="<?php if (isset($_POST['elementTracker'])) {
                    echo $_POST['elementTracker'];
                } elseif (isset($listAllElements) && !empty($listAllElements)) {
                    echo $listAllElements;
                }
                 ?> " data-general-max="<?= $max_on_page ;?>" data-max-li="<?= $max_li_on_page ;?>" data-max-lists="<?= $max_lists_on_page ;?>">

            </form>
            <?php
            ed();
        ed();
    ed();
require './assets/includes/footer.html';
ob_end_flush();
?>

