<?php
/**
 * Upload Folder
 *
 * @package     Upload Folder
 * @author      Piepin <piepin@gmail.com>
 * @link        https://github.com/komputronika/UploadFolder
 */

Class UploadFolder 
{

    protected $folder = "upload";
    protected $errors = [];
    protected $log = "log.txt";
    protected $path;
    protected $curdir;
    protected $extensions = "*";
    
    public function __construct() 
    {
        error_reporting( 0 & ~E_WARNING & ~E_STRICT & ~E_NOTICE & ~E_DEPRECATED);
        $this->curdir = getcwd();
    }

    public function set_extensions($extensions) 
    {
        $this->extensions = $extensions;
    }

    public function set_log($log_filename) 
    {
        $this->log = $log_filename;
    }

    public function set_folder($folder_name) 
    {
        $this->folder = $folder_name;
    }

    public function process($path, $files) 
    {
        // Log string
        $log_string     = "";

        // Original path from user's device
        $original_path  = dirname($path); 

        // Extract file's data
        $file_name      = $files['name'];
        $file_size      = $files['size'];
        $file_tmp       = $files['tmp_name'];
        $file_type      = $files['type'];
        $file_ext       = strtolower(end(explode('.',$file_name)));

        // Check for allowed extensions
        if ($this->extensions != "*") {
            if (!in_array($file_ext, $this->extensions)) {
                $this->errors[] = "This file extension ($file_ext) is not allowed.";
            }
        }

        // If not error
        if (empty($this->errors)) {

            // Real server's dir, eg => /var/www/myfolder/upload
            $base = $this->curdir . DIRECTORY_SEPARATOR . $this->folder;
            
            // Upload dir, eg: /var/www/myfolder/upload/MyPictures
            $upload_dir  = $base . DIRECTORY_SEPARATOR . $original_path ;

            // Upload path, eg: /var/www/myfolder/upload/MyPictures/photo1.jpg
            $upload_path = $upload_dir . DIRECTORY_SEPARATOR. basename($file_name) ;

            // Create target dir if not exist    
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0700, true);

            /* 
            $log_string .= "BASE = ".$base."\n";
            $log_string .= "ORIGINAL_PATH = ".$original_path."\n";
            $log_string .= "UPLOAD_PATH  = ".$upload_path."\n"; 
            */

            $log_string .=  "Upload to $upload_path\n";

            $success = move_uploaded_file($file_tmp, $upload_path);
            if ($success) {
                $log_string .= "The file " . basename($file_name) . " has been uploaded\n\n";
            } else {
                $log_string .= "The file " . basename($file_name) . " cannot be uploaded\n\n";
            }

        } else {

            foreach ($this->errors as $error) {
                $log_string .= $error . "\n";
            }

        }
        
        file_put_contents($this->log, $log_string, FILE_APPEND );
        echo $original_path . DIRECTORY_SEPARATOR . basename($file_name); 
    }
}
    
// End of file