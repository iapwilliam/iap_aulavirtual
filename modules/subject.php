<?php
if ($_POST) {
	$response = $subject->dt_subjects_request($_POST);
	print_r(json_encode($response));
	exit;
}
