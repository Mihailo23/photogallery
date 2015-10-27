<?php 

function strip_zeros_from_date($not_formated = '') {
	// first remove the marked zeros
	$no_zeros = str_replace('*0', '', $not_formated);
	// then remove any remaining marks
	$cleared_string = str_replace('*', '', $no_zeros);
	return $cleared_string;
}

function redirect_to( $location = NULL) {
	if ($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}

function output_message($message = "") {
	if (!empty($message)) {
		return "<p class=\"message\">{$message}</p>";
	} else {
		return "";
	}
}

?>