<?php
// assume nothing is suspect
$suspect = false;
// create a pattern to locate suspect phrases
$pattern = '/Content-Type:|Bcc:|Cc:/i';
$mailSent = 'false';

// function to check for suspect phrases
function isSuspect($val, $pattern, &$suspect) {
    global $contact_errors;
    // if the variable is an array, loop through each element
    // and pass it recursively back to the same function
    if (is_array($val)) {
        foreach ($val as $item) {
            isSuspect($item, $pattern, $suspect);
        }
    } else {
        // if one of the suspect phrases is found, set Boolean to true
        if (preg_match($pattern, $val)) {
            $suspect = true;
        }
    }
}
// check the $_POST array and any subarrays for suspect content
isSuspect($_POST, $pattern, $suspect);

if ($suspect) {
    $suspectMail = true;
    return $suspectMail;
}

if (!$suspect) {
    foreach ($_POST as $key => $value) {
        // assign to temporary variable and strip whitespace if not an array
        $temp = is_array($value) ? $value : trim($value);
        // if empty and required, add to $missing array
        if (empty($temp) && in_array($key, $required)) {
            $missing[] = $key;
            $lowercase = substr($key, 3);
            $thisElem = strtoupper(substr($key, 2, 1)) . $lowercase;
            if ($thisElem === 'Msg') $thisElem = "Message";
            $contact_errors[$key] = $thisElem . " is required";
            ${$key} = '';
        } elseif (in_array($key, $expected)) {
            // otherwise, assign to a variable of the same name as $key
            ${$key} = $temp;
        }
    }
}

//validate the user's email
if (!$suspect && !empty($email)) {
    $validemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if (!$validemail) {
        $invalidEmail = true;
        $contact_errors['email'] = 'Please enter a valid email';
    }
}

// go ahead only if not suspect, all required fields OK, and no errors
if (!$suspect && empty($missing) && empty($contact_errors)) {
    //intialyze the $message variable
    $message = '';
    //loop through the $expected array
    foreach($expected as $item) {
        // assign the value of the current item to $val
        if(isset(${$item}) && !empty(${$item})) {
            $val = ${$item};
        } else {
            // if it has no value, assign 'Not selected'
            $val = 'Not Selected';
        }

        //if an array, expand as comma seperated string
        if (is_array($val)) {
            $val = implode(', ', $val);
        }
        // replace underscores and hyphens in the label with spaces
        $item = str_replace(['_', '-'], ' ', $item);
        // add label and value to the message body
        $message .= ucfirst($item).": $val\r\n\r\n";
    }
    // limit line length to 70 characters
    $message = wordwrap($message, 70);
    if (isset($tempMessage)){
        $message .= wordwrap($tempMessage, 70);
    }

    $mail_to_send_to = "savannah@savannahskinner.com";
    $from_email = "savannah@savannahskinner.com";
    $nameEmail = "Contacting Terra Navis Team | " . $c_name;
    // $sendflag = 'send';                      
    // if ($sendflag == 'send') {
    $message .= "| Return Email: " . $c_email . " |";
    $headers = "From: $from_email" . "\r\n" . "Reply-To: $c_email" . "\r\n" ;
    $a = mail( $mail_to_send_to, $nameEmail, $message, $headers);
    if ($a) {
         $mailSent = 'true';
         return $mailSent;
    } else {
         $mailSent = 'attempted';
         return $mailSent;
    }
}
