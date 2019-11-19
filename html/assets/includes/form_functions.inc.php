<?php
function create_form_input($name, $type, $label = '', $errors = [], $options = array()) {
	$value = false;
	if (isset($_POST[$name])) $value = $_POST[$name];
	if ($value && get_magic_quotes_gpc()) $value = stripcslashes($value);
	if (!empty($label)) {
		echo '<label for="' . $name . '"';
		if (array_key_exists($name, $errors)) echo 'class="text_error"';
		echo '>' . $label . '</label>';
	}

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
		if ((!empty($options)) && (is_array($options)) && (array_key_exists('required', $options))) {echo ' requiredInput';}
		echo '"';
		if ($value) echo 'value="' . htmlspecialchars($value) . '"';
		if (!empty($options) && is_array($options)) {
			foreach ($options as $k => $v) {
                if ($k !== 'addtl_classes') echo " $k=\"$v\"";
			}
		}
		echo '>';

		if (array_key_exists($name, $errors)) echo '<p class="formNotice formNotice_InlineError text_error">' . $errors[$name] . ' </p>';
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
		if ((!empty($options)) && (is_array($options)) && (array_key_exists('required', $options))) {echo ' requiredInput';}
		echo '"';
		if (!empty($options) && is_array($options)) {
			foreach ($options as $k => $v) {
                if ($k !== 'addtl_classes') echo " $k=\"$v\"";
			}
		}
		echo '>';
		if ($value) echo $value;
		echo '</textarea>';
		if (array_key_exists($name, $errors)) echo '<p class="formNotice formNotice_InlineError text_error">' . $errors[$name] . ' </p>';
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
		if ((!empty($options)) && (is_array($options)) && (array_key_exists('required', $options))) {echo ' requiredInput';}
		echo '"';
		if ($value) echo 'value="' . htmlspecialchars($value) . '"';
		if (!empty($options) && is_array($options)) {
			foreach ($options as $k => $v) {
                echo $options['addtl_classes'] . ' ' . $type;
			}
		}
		echo '>';
	} // END type IF-ELSE
} // END create_form_input()
