<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
check_if_admin(); // toss user back to login page if they're not logged in
require MYSQL; // connect to db
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php'; // various functions
$media_type = $_GET['media_type']; // tells it whether to produce the form for emails vs the form for articles

// build list of expected, required, and possile post values based on media type
if ($media_type === 'article') {
    $expected = ['article_name', 'article_category', 'article_description', 'imgs'];
    $required = ['article_name', 'article_category'];
    $possible = [];
    $element_types = ['p', 'heading2', 'heading3', 'heading4', 'heading5', 'hr', 'ul', 'ol']; // we'll build all possible lists from this list l8r
} elseif ($media_type === 'email') {
    $expected = ['email_subject', 'email_msg'];
    $required = ['email_subject', 'email_msg'];
}


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



// CHECK PAGE IF SUBMITTED----------------------------------------------------------->
if (isset($_POST['publishMediaBtn'])) {
    // ERROR HANDLING
    // if a required item is empty, toss an error
    if (empty($_POST['article_name'])) $newArticle_errors['article_name'] = "Missing: Name";
    if (empty($_POST['article_category']) || $_POST['article_category'] === 1) $newArticle_errors['article_category'] = "Missing: Category";
    if (empty($_POST['article_description']) || $_POST['article_description'] === 1) $newArticle_errors['article_description'] = "Missing: Description";
    foreach ($possible as $elementToCheck) {
        if (isset($_POST[$elementToCheck]) && !empty($_POST[$elementToCheck])) {
            $at_least_one_element = true;
            break;
        }
    }

    if ($at_least_one_element === false) {
        $newArticle_errors['article_name'] = "No content in article...";
    }

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
            // nd('adminMainContent', 'mainContent');
            ?>
            <div class="newMediaHeading">
                <h2 class="adminHeading">New <?= ucfirst($media_type) ?></h2>
                <div class="cornerLinks">
                <?php
                if ($media_type === 'article') {
                    echo '<a href="./new.php?media_type=email" class="adminBtn adminBtn_accent">Switch To Email</a>';
                    echo '<a href="./new.php?media_type=article&clear=true" class="adminBtn adminBtn_danger">Clear Page</a>';
                } elseif ($media_type === 'email') {
                    echo '<a href="./new.php?media_type=article" class="adminBtn adminBtn_accent">Switch To Article</a>';
                    echo '<a href="./new.php?media_type=email&clear=true" class="adminBtn adminBtn_danger">Clear Page</a>';
                }
                ?>
                </div>
                <!-- <a href="new?media_type<?= $media_type ?>&clear=true" class="adminBtn adminBtn_danger">Clear Page</a> -->
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
                    $options = ['required' => null, 'placeholder' => 'Description', 'maxlength' => 250];
                    create_form_input('article_description', 'textarea', 'Description', $newArticle_errors, $options);
                    // create_form_input('addThisContent', 'hidden', '', $newArticle_errors);
                ?>
                <hr class="newHr">
<!-- Add content when you click a content link -->
                    <div id="newContent" class="newContent">
                        <?php require './assets/includes/contentTypeSwitch.php'; ?>
                    </div>
<!-- check content if you clicked published and send it on it's way! -->
<?php
    if (isset($_POST['publishMediaBtn'])) {
        if (empty($newArticle_errors) && $at_least_one_element === true) {
            $a_name = $_POST['article_name'];
            $a_description = $_POST['article_description'];
            $a_category = $_POST['article_category'];
            echo 'd: ' . $a_description . '<br>';

            $stmt = $dbpdo->prepare("INSERT INTO articles (article_id, article_name, article_description, article_category, date_added, date_modified) VALUES (NULL, :a_name, :a_description, :a_category, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
            // bind the paramaters
            $stmt->bindParam(':a_name', $a_name, PDO::PARAM_STR);
            $stmt->bindParam(':a_description', $a_description, PDO::PARAM_STR);
            $stmt->bindParam(':a_category', $a_category, PDO::PARAM_INT);

            // execute the prepared statement
            if ($stmt->execute()) {
                echo 'added';
                $article_db_id = $dbpdo->lastInsertId();
                echo $article_db_id;
            } else {
                echo 'crap';
            }


            foreach ($trackElements as $this_element_name => $this_element_info) {
                echo $this_element_name;
                print_r($this_element_info);
            }

        }
    }
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
                } elseif ($media_type === 'email') {
                    $options = ['required' => null, 'placeholder' => 'Subject', 'maxlength' => 50];
                    create_form_input('email_subject', 'text', ' ', $newArticle_errors, $options);
                    $options = ['required' => null, 'placeholder' => 'Message | Max 250 characters', 'maxlength' => 250];
                    create_form_input('email_msg', 'textarea', '', $newArticle_errors, $options);
                    echo '<hr class="newHr">';
                    echo '<input type="submit" name="publishMediaBtn" id="sendEmailBtn" class="adminBtn adminBtn_accent sendEmailBtn" value="Send Email">';
                }
                ?>
                <input type="text" id="elementTracker" name="elementTracker" class="hidden" value="<?php if (isset($_POST['elementTracker'])) echo $_POST['elementTracker']; ?> " data-general-max="<?= $max_on_page ;?>" data-max-li="<?= $max_li_on_page ;?>" data-max-lists="<?= $max_lists_on_page ;?>">

            </form>
            <?php
            ed();
        ed();
    ed();
require './assets/includes/footer.html';
ob_end_flush();
?>

