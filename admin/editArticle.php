<?php
// ob_start tells it not to show anything until everything is done loading so I can interrupt it at any time to load an error page without php getting mad about content already on display
ob_start();

// starts a session lol, aka it tracks information even when you go to a different page within the site
session_start();

 // config sets up a number of vital defnitions and a few functions too
require './../html/assets/includes/config.inc.php';

// toss user back to login page if they're not logged in
check_if_admin();

// connects ya to the db as admin for delete priveleges
$user = 'admin';
require MYSQL;

// makes it easy to create forms
require './../html/assets/includes/form_functions.inc.php';

// makes it easy to create common inputs for this page specifically, we only need it if they haven't clicked the button yet since this code is just to rebuild the article into inputs
if (!isset($_POST['publishMediaBtn'])) require './assets/includes/form_functions_edit.inc.php';



// ------------------------------->intialize various variables
$media_type = 'article';
$pageTitle = 'Edit Article';

$img_location;
$img_name;
$complete_filename;
$resized_filename;
$img_errors = [];

// basic functions used throughout the site
require './../html/assets/includes/functions.php';

// the minimum inputs expected
$expected = ['article_name', 'article_category', 'article_description', 'imgs'];

// the minimum inputs required
$required = ['article_name', 'article_category', 'article_description'];

// all possible inputs (it's a very long list lol, but I wanted to hard code so you can't make up whatever you want an insert it)
$possible = [];

// we'll build all possible lists from this list l8r
$element_types = ['p', 'heading2', 'heading3', 'heading4', 'heading5', 'hr', 'ul', 'ol'];
$article_id = $_GET['article_id'];
$elementsUsed;

// max amount of any element type on the page
$max_on_page = 10;

// max amount of either list type on the page
$max_lists_on_page = 3;
// total max of list items, for reasons. Might remove this cap later because it was originally for testing purposes
$max_li_on_page = 25;
$list_names;

// tracks the last list item so we know when to but the closing tag
$last = [];

//tracks all errors
$newArticle_errors = [];

$firstLists = [];

// lists all elements, without all the extra stuff $trackElements carries
$listAllElements = '';

// tracks all element ids and order
if (!isset($trackElements)) $trackElements = [];

// to make sure there's at least one element, don't want an empty article
$at_least_one_element = false;

// $listAll = [];

// grab the info about this article from the db
$q = "SELECT * FROM `articles` WHERE article_id = $article_id";
$r = mysqli_query($dbc, $q);
if ($r && mysqli_num_rows($r) > 0) {
    while ($row = $r->fetch_assoc()) {
        // set the _post variables if this is the first time loading the page
        if (!isset($_POST['article_name'])) $_POST['article_name'] = $row['article_name'];
        if (!isset($_POST['article_description'])) $_POST['article_description'] = $row['article_description'];
        if (!isset($_POST['article_category']))$_POST['article_category'] = $row['article_category'];
        if (!isset($_POST['date_added'])) $_POST['date_added'] = $row['date_added'];
        if (!isset($_POST['caption'])) $_POST['caption'] = $row['caption'];
        if (!isset($_POST['img_name'])) $_POST['img_name'] = $row['img_name'];
        if (isset($_POST['img_name'])) {
            $img_name = $_POST['img_name'];
            echo $img_name;
            $img_location = $_POST['img_name'];
        }
    }
} else {
    // if it cant find that article it'll toss an error
    require './assets/includes/header.html';
    require './assets/includes/error.php';
    $links = ['Return To Home' => 'index.php'];
    produce_error_page('There\'s no record of that article. Please contact our service team to resolve the issue.', $links);
    require './assets/includes/footer.html';
    exit();
}

// grabs all the list items tied to that article, we'll need to sort these a little differently than the rest
$q = "SELECT `element_name` FROM `article_content` WHERE article_id = " . $article_id . " && ((content_type = 7) || (content_type = 8))";
$r = mysqli_query($dbc, $q);
if ($r && mysqli_num_rows($r) > 0) {
    while ($row = $r->fetch_assoc()) {
        $elementToCheck = $row['element_name'];
        $list_type = substr($elementToCheck, 0, 2);
        $list_num = substr($elementToCheck, 3, 1);
        $list_name = $list_type . '_' . $list_num;
        $listAll[$list_name][] = $elementToCheck;
    }
} elseif (!$r) {
    // if the query failed it'll toss an error
    require './assets/includes/header.html';
    require './assets/includes/error.php';
    $links = ['Return To Home' => 'index.php'];
    produce_error_page('Something is wrong with the database. Please contact our service team to resolve the issue.', $links);
    require './assets/includes/footer.html';
    exit();
}




// generates all possible element names and adds it to the possible array

foreach ($element_types as $each_element_type) {
    $x = 1;
    // if it's a list, we'll need to handle it a little differently with it's own while loop
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

// checks each list to find the first of the bunch
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



// finds the last list item in each list and adds it to a list
if (!empty($listAll) && is_array($listAll)) {
    foreach ($listAll as $elementToCheck) {
        $last[] = end($elementToCheck);
    }
}



// CHECK PAGE IF SUBMITTED----------------------------------------------------------->
if (isset($_POST['publishMediaBtn'])) {
    // ERROR HANDLING
    // if a required item is empty, toss an error
    if (empty($_POST['article_name'])) {
        $newArticle_errors['article_name'] = "Missing: Name";
    } elseif (strpos($_POST['article_name'], 'a href="') !== false) {
        $newArticle_errors['article_name'] = "Links are not allowed in the name or description.";
    }

    if (empty($_POST['article_category']) || $_POST['article_category'] === 1) {$newArticle_errors['article_category'] = "Missing: Category";}

    if (empty($_POST['article_description']) || $_POST['article_description'] === 1) {
        $newArticle_errors['article_description'] = "Missing: Description";
    } elseif (strpos($_POST['article_description'], 'a href="') !== false) {
        $newArticle_errors['article_description'] = "Links are not allowed in the name or description.";
    }

    // check each possible element to see if at least one is not empty
    foreach ($possible as $elementToCheck) {
        if (isset($_POST[$elementToCheck]) && !empty($_POST[$elementToCheck]) && $at_least_one_element === false) {
            $at_least_one_element = true;
            break;
        }
    }

    // if there isn't any content in the article, throw an error
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
// options that can be passed to create_form_input, this one gives the inputs a required attribute but others do way more
$options = ['required' => null];
    require './assets/includes/adminMenu.php';
    require './assets/includes/newsfeed_active.php';
    nd('adminMC_Wrapper', 'noDI');
        nd('newMedia', 'noID');
            ?>
            <div class="newMediaHeading editPage">
                <h2 class="adminHeading">Edit <?= ucfirst($media_type) ?></h2>
                <div class="cornerLinks">
                <?php
                echo '<a href="deleteArticle.php?article_id=' . $article_id  . '" class="adminBtn adminBtn_danger">Delete Article</a>';
                ?>
                </div>
            </div>
            <form class="newMediaForm generalForm"  method="post" enctype="multipart/form-data">
            <?php

                if ($media_type === 'article') {
                    $options = ['required' => null, 'placeholder' => 'Name', 'maxlength' => 50];
                    create_form_input('article_name', 'text', 'Aricle Name: ', $newArticle_errors, $options);
                    echo REQUIRED;
                    ?>
                    <label for="article_category">Category</label>
                    <select class="categorySelect" required name="article_category" id="article_category">
                        <option value="" disabled selected>Select Category</option>
                    <?php
                    // pull all possible categories from the db
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

                    // definition from config.inc.php that creates a required tag
                    echo REQUIRED;

                    // throw an error if something went wrong with the select (create_form_input usually handles this but since this once was made here, it has to create errors here too)
                    if (array_key_exists('article_category', $newArticle_errors)) echo '<p class="formNotice formNotice_InlineError text_error">' . $newArticle_errors['article_category'] . ' </p>';
                    $options = ['required' => null, 'placeholder' => 'Description', 'maxlength' => 400];
                    create_form_input('article_description', 'textarea', 'Description', $newArticle_errors, $options);
                    echo REQUIRED;

                    // // so we can keep track of when this article was created
                    echo '<input type="text" name="date_added" id="date_added" class="textInput createInput hidden" ';
                    if (isset($_POST['date_added'])) echo ' value="' . $_POST['date_added'] . '"';
                    echo '>';


                    $options = ['required' => null, 'placeholder' => 'Caption', 'maxlength' => 100];
                    create_form_input('caption', 'text', 'Image Caption', $newArticle_errors, $options);
                    if (!empty($img_errors)) {
                        foreach ($img_errors as $key => $value) {
                            echo '<p class="formNotice formNotice_InlineError">' . $value . ' </p>';
                        }
                    }

                    if (!empty($img_notices)) {
                        foreach ($img_notices as $key => $value) {
                            echo '<p class="formNotice formNotice_InlineNotice">' . $value . ' </p>';
                        }
                    }

                    echo '<div class="imgBox">';
                    ?>
                    <input type="text" class="img_location hidden" name="img_location" value="<?=$_POST['img_name'];?>">
                    <img class="showNewImg" src="<?=IMG_PATH . $_POST['img_name'];?>" alt="temp_alt">
                    <?php
                    echo '</div>';

                    echo '<input type="text" class="hidden img_name" name="img_name" ';
                    echo 'value="' . $_POST['img_name'] . '"';
                    echo '>';
                ?>
                <hr class="newHr">
<!-- Add content when you click a content link -->
                    <div id="newContent" class="newContent">
                        <?php
                        // if they have already pushed the button, use the normal element creator
                        if (isset($_POST['publishMediaBtn'])) {
                            require './assets/includes/contentTypeSwitch.php';
                        } else {
                            // if they HAVENT pushed the button, use the customized version of the element creator
                            require './assets/includes/contentTypeSwitch_edit.php';
                        }
                        ?>
                    </div>
<!-- check content if you clicked published and send it on it's way! -->
<?php
    if (isset($_POST['publishMediaBtn'])) {
        // if u have clickty clicked the button and there's at least one piece of content and there's no issues with the image...
        if (empty($newArticle_errors) && empty($img_errors) && $at_least_one_element === true) {
            $a_name = htmlentities($_POST['article_name']);
            $a_description = htmlentities($_POST['article_description']);
            $a_caption = htmlentities($_POST['caption']);
            $a_category = $_POST['article_category'];

            // flags this article for errors so if something goes wrong later on we can findd this specific article more easily
            $noErrors = 1;
            $dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $stmt = $dbpdo->prepare("INSERT INTO articles (article_id, article_name, article_description, article_category, date_added, date_modified, img_name, caption, error_flag) VALUES (NULL, :a_name, :a_description, :a_category, :date_added, CURRENT_TIMESTAMP, :img_name, :a_caption, :error_flag)");

            // bind the paramaters
            $stmt->bindParam(':a_name', $a_name, PDO::PARAM_STR);
            $stmt->bindParam(':a_description', $a_description, PDO::PARAM_STR);
            $stmt->bindParam(':a_category', $a_category, PDO::PARAM_INT);
            $stmt->bindParam(':img_name', $_POST['img_name'], PDO::PARAM_STR);
            $stmt->bindParam(':a_caption', $a_caption, PDO::PARAM_STR);
            $stmt->bindParam(':date_added', $_POST['date_added']);
            $stmt->bindParam(':error_flag', $noErrors, PDO::PARAM_BOOL);

            // ...attempt to add that bad boi to the db...
            if ($stmt->execute()) {
                // if all that nonsense worked, grab that shiny new id
                $article_db_id = $dbpdo->lastInsertId();

                // ...and add each new element...
                foreach ($trackElements as $this_element_name => $this_element_info) {
                    // ...and if it's a list item, add it this way
                    if ((strpos($this_element_name, 'ul') !== false) || (strpos($this_element_name, 'ol') !== false)) {
                        $this_element_id = $this_element_info['id'];
                        $this_element_order = $this_element_info['order'];
                        if (empty($_POST[$this_element_name]))  $this_element_content = '::empty::';
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

                        if (!$stmt->execute()) {

                            // if anything goes wrong, throw an error!
                            ob_end_clean();
                            require './assets/includes/header.html';
                            require './assets/includes/error.php';
                            $links = ['Return To Home' => 'index.php'];
                            produce_error_page('Could not connect to the database, your article could not be uploaded. Please contact our service team to resolve the issue.', $links);
                            require './assets/includes/footer.html';
                            exit();

                        }

                    } else {
                        // ...but if it's NOT a list item, add it this way
                        $this_element_id = $this_element_info['id'];
                        $this_element_order = $this_element_info['order'];
                        $this_element_content = $this_element_info['content'];
                        $stmt = $dbpdo->prepare("INSERT INTO `article_content` (`content_id`, `article_id`, `content_type`, `order_of_content`, `element_name`, `content`) VALUES (NULL, :a_db_id, :elem_id, :elem_order, :elem_name, :elem_content)");
                        $stmt->bindParam(':a_db_id', $article_db_id, PDO::PARAM_INT);
                        $stmt->bindParam(':elem_id', $this_element_id, PDO::PARAM_INT);
                        $stmt->bindParam(':elem_name', $this_element_name, PDO::PARAM_STR);
                        $stmt->bindParam(':elem_order', $this_element_order, PDO::PARAM_INT);
                        $stmt->bindParam(':elem_content', $this_element_content, PDO::PARAM_STR);

                        if (!$stmt->execute()) {

                            // if anything goes wrong, throw an error!
                            ob_end_clean();
                            require './assets/includes/header.html';
                            require './assets/includes/error.php';
                            $links = ['Return To Home' => 'index.php'];
                            produce_error_page('Could not connect to the database, your article could not be uploaded. Please contact our service team to resolve the issue.', $links);
                            require './assets/includes/footer.html';
                            exit(); 

                        }
                    }
                } // foreach END

                $stmt = $dbpdo->prepare("DELETE FROM articles WHERE article_id = :a_id");
                $stmt->bindParam(':a_id', $article_id, PDO::PARAM_STR);
                // ...and if EVERYTHING went well, remove that error flag!
                if ($stmt->execute()) {
                    $stmt = $dbpdo->prepare("UPDATE `articles` SET `error_flag` = NULL WHERE `articles`.`article_id` = :a_id");
                    $stmt->bindParam(':a_id', $article_db_id, PDO::PARAM_STR);
                    if ($stmt->execute()) {
                        header('Location: ' . BASE_URL . 'admin/view.php?view_type=view&media_type=article&media_id=' . $article_db_id);
                    } else {

                        // or throw an error, ya know, if something went wrong
                        ob_end_clean();
                        require './assets/includes/header.html';
                        require './assets/includes/error.php';
                        $links = ['Return To Home' => 'index.php'];
                        produce_error_page('Could not connect to the database, your article may be salvageable. Please contact our service team to resolve the issue.', $links);
                        require './assets/includes/footer.html';
                        exit();
                    }
                } else {

                    // throw an error, ya know, if something went wrong
                    ob_end_clean();
                    require './assets/includes/header.html';
                    require './assets/includes/error.php';
                    $links = ['Return To Home' => 'index.php'];
                    produce_error_page('Could not connect to the database, your article may be partially salvageable. Please contact our service team to resolve the issue.', $links);
                    require './assets/includes/footer.html';
                    exit();
                }
            } else {
                print_r($dbpdo->errorInfo());

                // throw an error, ya know, if something went wrong
                // ob_end_clean();
                // require './assets/includes/header.html';
                // require './assets/includes/error.php';
                // $links = ['Return To Home' => 'index.php'];
                // produce_error_page('Could not connect to the database. Please contact our service team to resolve the issue.', $links);
                // require './assets/includes/footer.html';
                // exit();
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
                        <p class="contentTypeBtn linkBtn linkGeneratorBtn">Link</p>
                        <div class="contentTypeList">
                            <p class="contentTypeBtn listBtn">List</p>
                            <ul class="listContentTypes hidden">
                                <li><p class="contentPhpBtn" data-contentType="ul" data-content_type_id=7>Unordered List</p></li>
                                <li><p class="contentPhpBtn" data-contentType="ol" data-content_type_id=8>Ordered List</p></li>
                            </ul>
                        </div>
                        <label for="imgs" class="contentTypeBtn uploadImgBtn" id="uploadImgBtn" data-content_type_id=9>Image</label>
                        <small class="imgsNotice">Images will be placed automatically, based upon size</small>
                <input type="file" name="imgs" class="hidden" id="imgs" onChange="loadFile(event)" data-content_type_id=9>
                    </div>


                    <input type="submit" name="publishMediaBtn" id="publishBtn" class="adminBtn adminBtn_accent publishBtn" value="Edit Article">
                <?php
                }
                // the code below is just putting some important info out where js can grab and work with it!
                ?>
                <input type="text" id="elementTracker" name="elementTracker" class="hidden" value="<?php if (isset($_POST['elementTracker'])) {
                    echo $_POST['elementTracker'];
                } elseif (isset($listAllElements) && !empty($listAllElements)) {
                    echo $listAllElements;
                }
                 ?> " data-general-max="<?= $max_on_page ;?>" data-max-li="<?= $max_li_on_page ;?>" data-max-lists="<?= $max_lists_on_page ;?>">

            </form>
            <div class="linkGenBox">
                <h5 class="linkGenHeading">Link Generator</h5>
                <p class="linkLabel">Link Text</p>
                <p class="linkGenInput linkName" id="linkName" contenteditable="true">My Link</p>
                <p class="linkLabel">Link URL</p>
                <p class="linkGenInput linkHref" id="linkHrek" contenteditable="true">https://www.mylink.com</p>
                <p class="linkGenBtn adminBtn adminBtn_aqua" id="linkGenBtn">Generate Link</p>
                <p class="linkNote linkNote_subtle">Note: Links should only be used in the main content. They should not be used in the name or description of an article.</p>
                <div class="generatorInstructions hidden">
                <h4>Here's your link: </h4>
                <hr class="linkGenHr">
                    <p class="linkGenOutputReview">The link will say: <span class="linkOutputText linkGen_accent"></span> and will link to <span class="linkOutputHref linkGen_accent"></span>.</p>
                    <p class="linkP" id="linkP">Steps to add to article: </p>
                    <p class="linkP" id="linkP">1) Copy this text:</p>
                    <p class="linkGenOutput linkGen_accent" id="linkGenOutput"></p>
                    <p class="linkP" id="linkP">2) Paste the text where you want the link to be in the final article</p>
                </div>
                <p class="linkGenEmptyError hidden">You're missing one or more values. Please fill both of the above boxes before generating the link.</p>
                <p class="linkGenCloseBtn">➔</p>
            </div>
            <?php
            ed();
        ed();
    ed();
require './assets/includes/footer.html';
ob_end_flush();
?>

