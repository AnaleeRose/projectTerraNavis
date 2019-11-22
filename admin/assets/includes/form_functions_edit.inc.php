<?php
function create_form_input_e_ver($name, $type, $label = '', $value, $errors = [], $options = array()) {
    if (!empty($value) && get_magic_quotes_gpc()) $value = stripcslashes($value);
    if (!empty($label)) {
        echo '<label for="' . $name . '"';
        if (array_key_exists($name, $errors)) echo 'class=""';
        echo '>' . $label . '</label>';
    }

// NORMAL INPUT ------------------------------------------------------------->
    if ( ($type === 'text') || ($type === 'password') || ($type === 'email')) {
        echo '<input type="' . $type . '" name="' . $name . '" id="' . $name . '" class="';
        if (!empty($options) && is_array($options)) {
            if (array_key_exists('addtl_classes', $options)){
                echo $options['addtl_classes'] . ' ' . $type;
            } else {
                echo $type;
            }
        } else {
            echo $type;
        }
        echo 'Input createInput';


        if (array_key_exists($name, $errors)) echo ' createFormError ';
        if ((!empty($options)) && (is_array($options)) && (!empty($options['required']))) {echo ' requiredInput';}
        echo '"';
        if (!empty($value)) echo 'value="' . htmlspecialchars($value) . '"';
        if (!empty($options) && is_array($options)) {
            foreach ($options as $k => $v) {
                if ($k !== 'addtl_classes') echo " $k=\"$v\"";
            }
        }
        echo '>';

        if (array_key_exists($name, $errors)) echo '<p class="formNotice formNotice_InlineError ">' . $errors[$name] . ' </p>';

// TEXTAREA INPUT ------------------------------------------------------------->
    } elseif ($type === 'textarea') {
        echo '<textarea name="' . $name . '" id="' . $name . '" class="';
        if (!empty($options) && is_array($options)) {
            if (array_key_exists('addtl_classes', $options)){
                echo $options['addtl_classes'] . ' ' . $type;
            } else {
                echo $type;
            }
        } else {
            echo $type;
        }
        echo 'Input createInput';
        echo '"';
        if (!empty($options) && is_array($options)) {
            foreach ($options as $k => $v) {
                if ($k !== 'addtl_classes') echo " $k=\"$v\"";
            }
        }
        echo '>';
        if ($value) echo htmlspecialchars($value);
        echo '</textarea>';
        if (array_key_exists($name, $errors)) echo '<p class="formNotice formNotice_InlineError ">' . $errors[$name] . ' </p>';
// HIDDEN INPUT ------------------------------------------------------------->
    }  elseif ($type === 'hidden') {
        echo '<input type="' . $type . '" name="' . $name . '" id="' . $name . '" class="';
        if (!empty($options) && is_array($options)) {
            if (array_key_exists('addtl_classes', $options)){
                echo $options['addtl_classes'] . ' ' . $type;
            } else {
                echo $type;
            }
        } else {
            echo $type;
        }
        echo 'Input createInput';

        if (array_key_exists($name, $errors)) echo ' createFormError ';
        if ((!empty($options)) && (is_array($options)) && (!empty($options['required']))) {echo ' requiredInput';}
        echo '"';
        if ($value) echo 'value="' . htmlspecialchars($value) . '"';
        if (!empty($options) && is_array($options)) {
            foreach ($options as $k => $v) {
            }
        }
        echo '>';
    } // END type IF-ELSE
} // END create_form_input()
