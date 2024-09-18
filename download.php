<?php
header('Content-disposition: attachment; filename='.$_GET["file"]);
header('Content-type:application/force-download');
readfile(DOC_ROOT."/homework/".$_GET["file"]);
?>