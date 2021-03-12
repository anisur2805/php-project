<?php
function isChecked( $inputName, $val ) {
	if(isset($_POST[$inputName]) && is_array($_POST[$inputName]) && in_array($val, $_POST[$inputName])) {
		echo " checked ";
	}
}

function isFruits( $val ) {
	if(isset($_POST['fruits']) && is_array($_POST['fruits']) && in_array($val, $_POST['fruits'])) {
		echo " checked ";
	}
}

// Fruits Select
function displayOption( $option ) {
	$selected = "";
	printf("<option value='%s' selected>%s</option>\n", $option, ucwords( $option ) );
	echo $option;
}
// Multiple select options
function displayFoodOption( $options, $selectedValues ) {
	foreach( $options as $option ) {
		$selected = "";
		$option = strtolower($option);

		if(in_array($option, $selectedValues)) {
			$selected = "selected";
		}
		printf("<option value='%s' %s>%s</option>\n", strtolower($option), $selected, ucwords($option));
	}
}
