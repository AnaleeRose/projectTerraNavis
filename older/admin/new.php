<?php
ob_start();
session_start();
require './../html/assets/includes/config.inc.php'; // basic definitions used throughout the site
require MYSQL;
require './../html/assets/includes/form_functions.inc.php'; // makes it easy to create forms
require './../html/assets/includes/functions.php';
$media_type = $_GET['media_type'];
if (isset($_GET['addContent'])) $selectedContent = $_GET['addContent'];

if ($media_type === 'article') {
    $expected = ['article_name', 'article_category', 'article_description'];
    $possible = [];
    $element_types = ['p', 'heading2', 'heading3', 'heading4', 'heading5', 'hr', 'ul', 'ol'];
    $required = ['article_name', 'article_category', 'article_description'];
} elseif ($media_type === 'email') {
    $expected = ['email_subject', 'email_msg'];
    $required = ['email_subject', 'email_msg'];
}


$newArticle_errors = [];
$firstLists = [];

// generates all possible values for possible list
$max_on_page = 5;
$max_lists_on_page = 2;
$max_li_on_page = 15;
$list_names;
$listAll;
$last;
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




// ERROR HANDLING ----------------------------------------------------------->
if (isset($_POST['publishMediaBtn'])) {
    if (empty($_POST['article_name'])) $newArticle_errors['article_name'] = "Missing: Name";
    if (empty($_POST['article_category']) || $_POST['article_category'] === 1) $newArticle_errors['article_category'] = "Missing: Category";
    if (empty($_POST['article_description'])) $newArticle_errors['article_description'] = "Missing: Description";

    foreach ($possible as $elementToCheck) {
        if (strpos($elementToCheck, 'l') !== false) {
            if (isset($_POST[$elementToCheck]) && !empty($_POST[$elementToCheck])) {
                // echo $_POST[$elementToCheck];
                $list_type = substr($elementToCheck, 0, 2);
                $list_num = substr($elementToCheck, 3, 1);
                $list_name = $list_type . '_' . $list_num;
                $listAll[$list_name][] = $elementToCheck;
            }
        }

    }

    if (!empty($listAll) && is_array($listAll)) {
        foreach ($listAll as $elementToCheck) {
            $last[] = end($elementToCheck);
        }
    }
}
// print_r($newArticle_errors);



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
                <!-- <input name="addThisContent" type="hidden" class="hidden" id="addThisContent" value="<?php //if (isset($selectedContent)){echo $selectedContent;}?>"> -->
                <hr class="newHr">
<!-- Add content when you click a content link -->
                    <?php require './assets/includes/addContent.php'; ?>
                    <div id="newContent" class="newContent">
                        <?php

                        foreach ($possible as $content) {
                            if (isset($_POST[$content]) && !empty($_POST[$content])) {
                                switch ($content) {
                                    case strpos($content, 'p');
                                        // echo "Paragrah: " . $content;
                                        $options = ['placeholder' => 'Paragraph | Max 1000 characters', 'maxlength' => 1000, 'addtl_classes'=>'Paragraph createInput', 'required' => null];
                                        create_form_input($content, 'textarea', 'Paragraph', $newArticle_errors, $options);
                                        break;

                                    case strpos($content, 'he');
                                        $heading_num = substr($content, 7, 1);
                                        // echo '<p class="formNotice formNotice_Error">' . $content . '</p>';
                                        $element_class = 'h' . $heading_num;
                                        $element_name = 'Heading ' . $heading_num;
                                        $options['maxlength'] = 100;
                                        $options['placeholder'] = $element_name . ' | Max 150 characters ';
                                        $options['addtl_classes'] = $element_class . ' createInput';
                                        create_form_input($content, 'text', $element_name, $newArticle_errors, $options);
                                        break;

                                    case strpos($content, 'hr');
                                        echo '<p class="formNotice formNotice_Error">' . $content . '</p>';
                                        $options['addtl_classes'] = 'hr createInput';
                                        echo '<hr class="newHr">';
                                        create_form_input($content, 'hidden', '', $newArticle_errors, $options);
                                        break;

                                    case (strpos($content, 'ul') !== false);
                                        if (substr($content, 8,2) === '1') { // check if first in list, if so start a fieldset
                                            echo '<fieldset data-max=2>';
                                            echo '<legend>';

                                            if ($list_type = 'ul') {
                                                echo 'Unordered List' . $list_num ;
                                            } elseif ($list_type = 'ol') {
                                                echo 'Ordered List' . $list_num ;
                                            }

                                            echo '</legend>';
                                        }
                                        // create the input
                                        echo '<input name="' . $content . '" class="' . $content . ' ' . substr($content, 0,7) . ' list-item createInput" value="' . $_POST[$content] . '">';

                                        // if the last li, conclude fieldset
                                        if (in_array($content, $last)) {
                                            $listType = substr($content, 0, 2);
                                            $listNum = substr($content, 3, 1);
                                            $listName = $listType . '_' . $listNum;
                                            $btnName = $listName . '_btn';

                                            echo '<p data-list-name="' . $list_name . '"class="addToListBtn ' . $btnName . '">+</p>';
                                            echo '</fieldset>';
                                            echo 'last';
                                        }
                                        break;

                                    default:
                                        echo '<p class="formNotice formNotice_Error">Mistake: ' . $content . '</p>';
                                        break;
                                }
                            }
                        }
                        // print_r($newList);
                        ?>

                    </div>
<!-- END -->
                    <div class="contentTypes">
                        <!-- <input type="submit" formaction="./new.php?media_type=article&addContent=<?php //if (isset($selectedContent)){echo $selectedContent;} else {echo 'p';} ?> -->
                         <!-- " class="contentTypeBtn" name="paragraph" value="Paragraph"> -->
                        <!-- <input type="submit" formaction="./new.php?media_type=article&addContent=p" class="contentTypeBtn" name="paragraph" value="Paragraph"> -->
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
                                <li><p class="contentPhpBtn" data-contentType="ul" data-content_type_id=8>Unordered List</p></li>
                                <li><p class="contentPhpBtn" data-contentType="ol" data-content_type_id=9>Ordered List</p></li>
                            </ul>
                        </div>
                        <p class="contentTypeBtn" id="uploadImg" data-content_type_id=7>Image</p>
                    </div>


                    <input type="submit" name="publishMediaBtn" id="publishBtn" class="adminBtn adminBtn_accent publishBtn" value="Publish Article">
                    <!-- <input type="submit" name="jsSubmitBtn" id="jsSubmitBtn" class="jsSubmitBtn hidden" value="jsSubmitBtn"> -->
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

            </form>
            <?php
            ed();
        ed();
    ed();
require './assets/includes/footer.html';
ob_end_flush();
?>

