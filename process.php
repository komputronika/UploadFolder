<?php

require_once("include/upload.class.php");

$up = new UploadFolder();
$up->set_folder("upload");
$up->process($_POST["path"], $_FILES["file"]);

?>
