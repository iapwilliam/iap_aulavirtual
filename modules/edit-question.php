<?php
	$test->setTestId($_GET["id"]);
	$question = $test->Info();
	$smarty->assign('question', $question);
?>