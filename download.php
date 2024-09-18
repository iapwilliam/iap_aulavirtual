<?php
header('Content-disposition: attachment; filename='.$_GET["file"]);
header('Content-type:application/force-download');
readfile(urldecode("./".$_GET["file"]));
?>