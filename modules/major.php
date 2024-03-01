<?php 
$majors = $major->Enumerate();
$smarty->assign("majors", $majors);
$smarty->assign('mnuMain', 'catalogos');
$smarty->assign('mnuSubmain', 'programas');
