<?php
header('Content-disposition: attachment; filename='.$_GET["file"]);
header('Content-type:application/force-download');
readfile(DOC_ROOT."/".$_GET["file"]);
?>