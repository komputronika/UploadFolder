<?php

error_reporting( 0 & ~E_WARNING & ~E_STRICT & ~E_NOTICE & ~E_DEPRECATED);

class Upload {

    protected $folder = "upload";
    protected $post;
    protected $errors = [];
    protected $log = "log.txt";
    protected $path;
    protected $curdir;
    protected $extensions = "*";

    public function __construct() {
        if (!is_dir($this->folder)) mkdir($this->folder, 0700);
        $this->curdir = getcwd();
        unlink("log.txt");
    }

    public function set_extensions($extensions) {

    }

    public function set_log($log_filename) {

    }

    public function set_folder($folder_name) {

    }

    public function process($post) {

    }

}
    

    
    
    //if (!is_dir("upload")) mkdir("upload", 0700);

    $currentDir = getcwd();
    $uploadDirectory = "/upload/";
    
    $errors = []; 

    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

    $fileName = $_FILES['myfile']['name'];
    $fileSize = $_FILES['myfile']['size'];
    $fileTmpName  = $_FILES['myfile']['tmp_name'];
    $fileType = $_FILES['myfile']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit'])) {

        /*if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }*/

        /*if ($fileSize > 2000000) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }*/

        ob_start();
        
        $a = explode("/",$_POST["path"]);
        array_pop($a);
        
        print_r($a);
        
        $path = $currentDir. $uploadDirectory. implode("/", $a);
        
        echo $path."\n\n";
        
        mkdir($path, 0700, true);
        
        $uploadPath = $path . "/" . basename($fileName); 
        
        echo $uploadPath."\n\n";
        
        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                echo "The file " . basename($fileName) . " has been uploaded";
            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
        echo "\n\n";
        
        $output = ob_get_contents();
        ob_end_clean();
        file_put_contents("log.txt", $output, FILE_APPEND );
        
        echo implode("/", $a) . "/" . basename($fileName); 
    }


?>
