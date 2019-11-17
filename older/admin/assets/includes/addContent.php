<?php

if ($media_type ==='email') {
	header('Location: email.com');
}

// if (isset($selectedContent)) {
// 	if ((strpos($selectedContent, ',') !== false)) {
// 		$addContentArray = explode (',', $selectedContent); 
// 		foreach ($addContentArray as $value) {
// 			$maxOnPage = 5;
// 			$numOnPage = 0;
// 			$newContent_errors = [];
// 			switch ($value) {
// 				case 'p':
// 					$_POST['addThisContent'] = $_POST['addThisContent'] . 'p,';
// 					echo '<p style="color: black;background:white;">$_POST[addThisContent]:' . $_POST['addThisContent'] . '</p>';
// 					// print_r($_POST);
// 					// echo '<p style="color: black;background:white;">Pargraph Type</p>';
// 					// if ($numOnPage <= $maxOnPage) {
// 					// 	$name = 'paragraph' . $numOnPage;
// 			  //           $options = ['required' => null, 'placeholder' => 'Paragraph', 'data-deleted' => 'false'];
// 			  //           create_form_input('$name', 'textarea', 'Paragraph', $newContent_errors, $options);
// 			  //       }
// 					# code...
// 					break;
				
// 				default:
// 					echo '<p style="color: black;background:white;">Unknown Type: ' . $thisContentType . '</p>';
// 					break;
// 			}
// 		}
// 	} else {
// 			$maxOnPage = 5;
// 			$numOnPage = 0;
// 			$newContent_errors = [];
// 			switch ($selectedContent) {
// 				case 'p':
// 					$_POST['addThisContent'] = $_POST['addThisContent'] . 'p,';
// 					echo '<p style="color: black;background:white;">$_POST[addThisContent]:' . $_POST['addThisContent'] . '</p>';
// 					// print_r($_POST);
// 					// echo '<p style="color: black;background:white;">Pargraph Type</p>';
// 					// if ($numOnPage <= $maxOnPage) {
// 					// 	$name = 'paragraph' . $numOnPage;
// 			  //           $options = ['required' => null, 'placeholder' => 'Paragraph', 'data-deleted' => 'false'];
// 			  //           create_form_input('$name', 'textarea', 'Paragraph', $newContent_errors, $options);
// 			  //       }
// 					# code...
// 					break;
				
// 				default:
// 					echo '<p style="color: black;background:white;">Unknown Type: ' . $thisContentType . '</p>';
// 					break;
// 			}
// 	}

// }

// if (isset($selectedContent)) {
// 	if ((strpos($selectedContent, ',') !== false)) {
// 		$addContentArray = explode (',', $selectedContent); 
// 		foreach ($addContentArray as $value) {
// 			detect_create_form($value);
// 		}
// 	} else {
// 		detect_create_form($selectedContent);
// 	}

// }

// function detect_create_form($thisContentType) {
// 	$maxOnPage = 5;
// 	$numOnPage = 0;
// 	$newContent_errors = [];
// 	switch ($thisContentType) {
// 		case 'p':
// 			$_POST['addThisContent'] = $_POST['addThisContent'] . 'p,';
// 			echo '<p style="color: black;background:white;">$_POST[addThisContent]:' . $_POST['addThisContent'] . '</p>';
// 			// print_r($_POST);
// 			// echo '<p style="color: black;background:white;">Pargraph Type</p>';
// 			// if ($numOnPage <= $maxOnPage) {
// 			// 	$name = 'paragraph' . $numOnPage;
// 	  //           $options = ['required' => null, 'placeholder' => 'Paragraph', 'data-deleted' => 'false'];
// 	  //           create_form_input('$name', 'textarea', 'Paragraph', $newContent_errors, $options);
// 	  //       }
// 			# code...
// 			break;
		
// 		default:
// 			echo '<p style="color: black;background:white;">Unknown Type: ' . $thisContentType . '</p>';
// 			break;
// 	}
// }

// --------------------------------------------------------------------------------------------------------------------------------------->

// if (isset($addContentList)) {
// 	if ((strpos($addContentList, ',') !== false)) {
// 		$addContentArray = explode (',', $addContentList); 
// 		foreach ($addContentArray as $value) {
// 			detect_create_form($value);
// 		}
// 	} else {
// 		detect_create_form($addContentList);
// 	}

// }

// function detect_create_form($thisContentType) {
// 	$maxOnPage = 5;
// 	$numOnPage = 0;
// 	$newContent_errors = [];
// 	switch ($thisContentType) {
// 		case 'p':
// 		print_r($_POST);
// 			echo '<p style="color: black;background:white;">Pargraph Type</p>';
// 			if ($numOnPage <= $maxOnPage) {
// 				$name = 'paragraph' . $numOnPage;
// 	            $options = ['required' => null, 'placeholder' => 'Paragraph', 'data-deleted' => 'false'];
// 	            create_form_input('$name', 'textarea', 'Paragraph', $newContent_errors, $options);
// 	        }
// 			# code...
// 			break;
		
// 		default:
// 			echo '<p style="color: black;background:white;">Unknown Type: ' . $thisContentType . '</p>';
// 			break;
// 	}
// }