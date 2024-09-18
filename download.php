<?php
header('Content-disposition: attachment; filename='.$_GET["file"]);
header('Content-type:application/force-download');
readfile(WEB_ROOT."/homework/".$_GET["file"]);
?>