<?php
$currentNum = 1;
$q = "SELECT * FROM `article_content` WHERE article_id = $article_id";
$r = mysqli_query($dbc, $q);
// if ($r) {
while ($row = $r->fetch_assoc()) {
    $elemName = $row['element_name'];
    // echo 'e: ' . $elemName;
    $elemContents = htmlspecialchars($row['content']);
        switch ($row['element_name']) {
            case strpos($elemName, 'p'):
                $trackElements[$elemName]['content'] = $elemContents;
                $trackElements[$elemName]['id'] = 1;
                $trackElements[$elemName]['order'] = $currentNum;
                $options = ['placeholder' => 'Paragraph | Max 1000 characters', 'maxlength' => 1000, 'addtl_classes'=>'Paragraph createInput', 'required' => null, 'data-content_type_id' => 1];
                create_form_input_e_ver($elemName, 'textarea', 'Paragraph', $elemContents, $newArticle_errors, $options);
                $listAllElements .= $elemName . ',';
                break;

            case strpos($elemName, 'he'): {
                $trackElements[$elemName]['content'] = $elemContents;
                $heading_num = substr($elemName, 7, 1);
                $element_class = 'h' . $heading_num;
                $element_name = 'Heading ' . $heading_num;
                $options['maxlength'] = 100;
                $options['placeholder'] = $element_name . ' | Max 150 characters ';
                $options['addtl_classes'] = $element_class . ' createInput';
                switch ($element_class) {
                    case 'h2';
                        $trackElements[$elemName]['id'] = 2;
                        $trackElements[$elemName]['order'] = $currentNum;
                        $options['data-content_type_id'] = 2;
                        break;

                    case 'h3';
                        $trackElements[$elemName]['id'] = 3;
                        $trackElements[$elemName]['order'] = $currentNum;
                        $options['data-content_type_id'] = 3;
                        break;

                    case 'h4';
                        $trackElements[$elemName]['id'] = 4;
                        $trackElements[$elemName]['order'] = $currentNum;
                        $options['data-content_type_id'] = 4;
                        break;

                    case 'h5';
                        $trackElements[$elemName]['id'] = 5;
                        $trackElements[$elemName]['order'] = $currentNum;
                        $options['data-content_type_id'] = 5;
                        break;
                }
                create_form_input_e_ver($elemName, 'text', $element_name, $elemContents, $newArticle_errors, $options);
                $listAllElements .= $elemName . ',';
                break;
            } // heading

            case strpos($elemName, 'hr');
                $trackElements[$elemName]['content'] = $elemContents;
                $trackElements[$elemName]['id'] = 6;
                $trackElements[$elemName]['order'] = $currentNum;

                $options['addtl_classes'] = 'hr createInput';
                $options['data-content_type_id'] = 6;
                echo '<hr class="newHr">';
                create_form_input_e_ver($elemName, 'hidden', '', $elemContents, $newArticle_errors, $options);
                $listAllElements .= $elemName . ',';
                break;

            case (strpos($elemName, 'ul') !== false);
                $trackElements[$elemName]['content'] = $elemContents;
                $trackElements[$elemName]['id'] = 7;
                $trackElements[$elemName]['order'] = $currentNum;

                $this_list_num = substr($elemName, 3,1);
                $list_type = 'ul_li' ;
                if (substr($elemName, 8,2) === '1') { // check if first in list, if so start a fieldset
                    $trackElements[$elemName]['first_li'] = true;
                    echo '<fieldset data-max=' . $max_lists_on_page . ' class="ul">';
                    echo '<legend>';

                    echo 'Unordered List ' . $this_list_num ;

                    echo '</legend>';
                } // unordered list
                // create the input
                echo '<label for="' . $elemName . '" class="listItemLabel">List Item ' . substr($elemName, 8,2) . '</label>';
                echo '<input name="' . $elemName . '" class="' . $elemName . ' ' . substr($elemName, 0,7) . ' list-item createInput" value="' .$elemContents . '" data-content_type_id=7>';

                // if the last li, conclude fieldset
                if (in_array($elemName, $last)) {
                    $trackElements[$elemName]['last_li'] = true;
                    $listType = substr($elemName, 0, 2);
                    $listNum = substr($elemName, 3, 1);
                    $listName = $listType . '_' . $listNum;
                    $btnName = $listName . '_btn';

                    echo '<p data-list-name="' . $listName . '"class="addToListBtn ' . $btnName . '">+</p>';
                    echo '</fieldset>';
                } // find the last li item if statement
                $listAllElements .= $elemName . ',';
                break;

            case (strpos($elemName, 'ol') !== false);
                $trackElements[$elemName]['content'] = $elemContents;
                $trackElements[$elemName]['id'] = 8;
                $trackElements[$elemName]['order'] = $currentNum;

                $this_list_num = substr($elemName, 3,1);
                if (substr($elemName, 8,2) === '1') { // check if first in list, if so start a fieldset
                    $trackElements[$elemName]['first_li'] = 'true';
                    echo '<fieldset data-max=' . $max_lists_on_page . ' class="ol">';
                    echo '<legend>';

                    echo 'Ordered List ' . $this_list_num ;

                    echo '</legend>';
                }
                // create the input
                echo '<input name="' . $elemName . '" class="' . $elemName . ' ' . substr($elemName, 0,7) . ' list-item createInput" value="' . $elemContents . '" data-content_type_id=8>';

                // if the last li, conclude fieldset
                if (in_array($elemName, $last)) {
                    $trackElements[$elemName]['content'] = $elemContents;
                    $trackElements[$elemName]['last_li'] = true;
                    $listType = substr($elemName, 0, 2);
                    $listNum = substr($elemName, 3, 1);
                    $listName = $listType . '_' . $listNum;
                    $btnName = $listName . '_btn';

                    echo '<p data-list-name="' . $list_name . '"class="addToListBtn ' . $btnName . '">+</p>';
                    echo '</fieldset>';
                }
                $listAllElements .= $elemName . ',';
                break;

            default:
                echo '<p class="formNotice formNotice_Error">Mistake: ' . $elemName . '</p>';
                break;
        } // switch END
        $currentNum++;
} // while END
// } else {echo 'why';} // foreach END


