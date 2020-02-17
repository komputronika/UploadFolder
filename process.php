<?php

require_once("include/upload.class.php");

$up = new Upload();
$up->set_folder("upload");
$up->process($_POST["path"], $_FILES["file"]);

?>
