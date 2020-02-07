<?php
function create_form_input($name, $type, $label = '', $errors = [], $options = array()) {
	if ((!empty($options)) && (is_array($options)) && (array_key_exists('contactPage', $options))) {echo '<div class="cf_inputLabel-container ';}
	if ((!empty($options)) && (is_array($options)) && (array_key_exists('contactPage', $options)) && (array_key_exists('addtl_div_classes', $options))) {echo $options['addtl_div_classes'] ;}
	if ((!empty($options)) && (is_array($options)) && (array_key_exists('contactPage', $options)) || (array_key_exists('addtl_div_classes', $options))) {echo '">';}
	$value = false;
	if (isset($_POST[$name])) $value = $_POST[$name];
	if ($value && get_magic_quotes_gpc()) $value = stripcslashes($value);
	if (!empty($label)) {
		echo '<label for="' . $name . '"';
		if (array_key_exists($name, $errors)) echo 'class=""';
		echo '>' . $label;

	if ((!empty($options)) && (is_array($options)) && (array_key_exists('required', $options)) && (array_key_exists('contactPage', $options))) {echo '<small class="requiredWarning contact-requiredWarning">required</small>';}

		echo '</label>';
	}

	if ( ($type === 'text') || ($type === 'password') || ($type === 'email')  || ($type === 'number') ) {
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
                if ($k !== 'addtl_classes' && $k !== 'addtl_div_classes' && $k !== 'contactPage') echo " $k=\"$v\"";
			}
		}
		echo '>';

		if (array_key_exists($name, $errors)) echo '<p class="formNotice formNotice_InlineError ">' . $errors[$name] . ' </p>';
	} elseif ($type === 'textarea') {
		if ((!empty($options)) && (is_array($options)) && (array_key_exists('contactPage', $options))) {echo '<div class="cf_msg-container">';}
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
                if ($k !== 'addtl_classes' && $k !== 'addtl_div_classes' && $k !== 'contactPage') echo " $k=\"$v\"";
			}
		}
		echo '>';
		if ($value) {
			echo $value;
		} else {
			if (isset($options['value']) && !empty($options['value'])) echo $options['value'];
		}
		echo '</textarea>';
		if ((!empty($options)) && (is_array($options)) && (array_key_exists('contactPage', $options))) {echo '<span id="characterCounter"></span>';}
		if ((!empty($options)) && (is_array($options)) && (array_key_exists('contactPage', $options))) {echo '</div>';}
		if (array_key_exists($name, $errors)) echo '<p class="formNotice formNotice_InlineError ">' . $errors[$name] . ' </p>';
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
                if ($k !== 'addtl_classes' && $k !== 'addtl_div_classes' && $k !== 'contactPage') echo " $k=\"$v\"";
			}
		}
		echo '>';
	} // END type IF-ELSE
	// if ((!empty($options)) && (is_array($options)) && (array_key_exists('contactPage', $options))) {echo '</div>';}
	if ((!empty($options)) && (is_array($options)) && (array_key_exists('contactPage', $options))) {echo '</div>';}
} // END create_form_input()
