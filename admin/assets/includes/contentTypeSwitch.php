<?php
$currentNum = 1;
if (isset($_POST['publishMediaBtn'])) {
    foreach ($elementsUsed as $content) {
        if (isset($_POST[$content]) && !empty($_POST[$content])) {
            switch ($content) {
                case strpos($content, 'p'):
                    $trackElements[$content]['id'] = 1;
                    $trackElements[$content]['order'] = $currentNum;
                    // echo "Paragrah: " . $content;
                    $options = ['placeholder' => 'Paragraph | Max 1000 characters', 'maxlength' => 1000, 'addtl_classes'=>'Paragraph createInput', 'required' => null, 'data-content_type_id' => 1];
                    create_form_input($content, 'textarea', 'Paragraph', $newArticle_errors, $options);
                    break;

                case strpos($content, 'he'): {
                    $heading_num = substr($content, 7, 1);
                    // echo '<p class="formNotice formNotice_Error">' . $content . '</p>';
                    $element_class = 'h' . $heading_num;
                    $element_name = 'Heading ' . $heading_num;
                    $options['maxlength'] = 100;
                    $options['placeholder'] = $element_name . ' | Max 150 characters ';
                    $options['addtl_classes'] = $element_class . ' createInput';
                    switch ($element_class) {
                        case 'h2';
                            $trackElements[$content]['id'] = 2;
                            $trackElements[$content]['order'] = $currentNum;
                            $options['data-content_type_id'] = 2;
                            break;

                        case 'h3';
                            $trackElements[$content]['id'] = 3;
                            $trackElements[$content]['order'] = $currentNum;
                            $options['data-content_type_id'] = 3;
                            break;

                        case 'h4';
                            $trackElements[$content]['id'] = 4;
                            $trackElements[$content]['order'] = $currentNum;
                            $options['data-content_type_id'] = 4;
                            break;

                        case 'h5';
                            $trackElements[$content]['id'] = 5;
                            $trackElements[$content]['order'] = $currentNum;
                            $options['data-content_type_id'] = 5;
                            break;
                    }
                    create_form_input($content, 'text', $element_name, $newArticle_errors, $options);
                    break;
                }

                case strpos($content, 'hr');
                    // echo '<p class="formNotice formNotice_Error">' . $content . '</p>';
                    $trackElements[$content]['id'] = 6;
                    $trackElements[$content]['order'] = $currentNum;

                    $options['addtl_classes'] = 'hr createInput';
                    $options['data-content_type_id'] = 6;
                    echo '<hr class="newHr">';
                    create_form_input($content, 'hidden', '', $newArticle_errors, $options);
                    break;

                case (strpos($content, 'ul') !== false);
                    $trackElements[$content]['id'] = 7;
                    $trackElements[$content]['order'] = $currentNum;

                    $this_list_num = substr($content, 3,1);
                    if (substr($content, 8,2) === '1') { // check if first in list, if so start a fieldset
                        $trackElements[$content]['first_li'] = true;
                        echo '<fieldset data-max=' . $max_lists_on_page . ' class="ul">';
                        echo '<legend>';

                        echo 'Unordered List ' . $this_list_num ;

                        echo '</legend>';
                    }
                    // create the input
                    echo '<input name="' . $content . '" class="' . $content . ' ' . substr($content, 0,7) . ' list-item createInput" value="' . $_POST[$content] . '" data-content_type_id=7>';

                    // if the last li, conclude fieldset
                    if (in_array($content, $last)) {
                        $listType = substr($content, 0, 2);
                        $listNum = substr($content, 3, 1);
                        $listName = $listType . '_' . $listNum;
                        $btnName = $listName . '_btn';

                        echo '<p data-list-name="' . $list_name . '"class="addToListBtn ' . $btnName . '">+</p>';
                        echo '</fieldset>';
                        echo 'last';
                        $trackElements[$content]['last_li'] = true;
                        echo '<br>last_after';
                    }
                    break;

                case (strpos($content, 'ol') !== false);
                    $trackElements[$content]['id'] = 8;
                    $trackElements[$content]['order'] = $currentNum;

                    if (substr($content, 8,2) === '2') {
                        $trackElements[$content]['first_li'] = true;
                        $listType = substr($content, 0, 2);
                        $listNum = substr($content, 3, 1);
                        $listName = $listType . '_' . $listNum;
                        $btnName = $listName . '_btn';

                        echo '<p data-list-name="' . $list_name . '"class="addToListBtn ' . $btnName . '">+</p>';
                        echo '</fieldset>';
                        break;
                    } // check if first in list, if so start a fieldset
                    if (substr($content, 8,2) === '1') { // check if first in list, if so start a fieldset
                        echo '<fieldset data-max=2 class="ol">';
                        echo '<legend>';
                        echo 'Ordered List ' . $list_num ;

                        echo '</legend>';
                    }
                    // create the input
                    echo '<input name="' . $content . '" class="' . $content . ' ' . substr($content, 0,7) . ' list-item createInput" value="' . $_POST[$content] . '" data-content_type_id=8>';

                    // if the last li, conclude fieldset
                    if (in_array($content, $last)) {
                        $trackElements[$content]['last_li'] = true;
                        $listType = substr($content, 0, 2);
                        $listNum = substr($content, 3, 1);
                        $listName = $listType . '_' . $listNum;
                        $btnName = $listName . '_btn';

                        echo '<p data-list-name="' . $list_name . '"class="addToListBtn ' . $btnName . '">+</p>';
                        echo '</fieldset>';
                    }
                    break;

                default:
                    echo '<p class="formNotice formNotice_Error">Mistake: ' . $content . '</p>';
                    break;
            }
            $currentNum++;
        }
    }
}
print_r($trackElements);
