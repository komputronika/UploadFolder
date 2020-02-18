# Upload Folder

Pure Javascript, HTML and PHP without any library

This demo allows you to choose a folder via a standard HTML file input. All files (including nested files) inside that folder are added to the input's files list. This script using `webkitdirectory` attribute that compatible with browser Chrome, Edge or Firefox.

Choose a folder, and all files in that folder will be uploaded recursively (Inspiration came from Google Drive).

Supported browser: Chrome, Edge, Firefox, Android, Samsung and other browsers that support [`webkitdirectory`](https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement/webkitdirectory) attribut.

### Installation

1. Download or clone this repo
2. Put the script on your web server's document root
3. Open that folder in browser, eg: http://yourweb/uploadfolder/

### Package Content

1. HTML file that contain input element and user interfaces.
2. CSS file for styling.
3. Javascript file for handling file input and send request to server. 
4. PHP file that accept file from client and save file in server. 

### Screenshot

<a href="https://imgur.com/bCUHbvv"><img src="https://i.imgur.com/bCUHbvv.png" title="source: imgur.com" /></a>

### Core Codes

#### index.html

```html
    <h3>Choose Folder</h3>
    <div class="picker"><input type="file" id="picker" webkitdirectory multiple></div>
    
    ...
    <script src="main.js"></script>
```

#### main.js

```javascript
    // On button input change (picker), process it
    picker.addEventListener('change', e => {
        ...
        // Process every single file
        for (var i = 0; i < picker.files.length; i++) {
            var file = picker.files[i];
            sendFile(file, file.webkitRelativePath);
        }
    });

    // Function to send a file, call PHP backend 
    sendFile = function(file, path) {
        ...
        // Set post variables 
        formData.set('file', file); // One object file
        formData.set('path', path); // String of local file's path 
    
        // Do request
        request.open("POST", 'process.php');
        request.send(formData);
    
    };
```    

#### process.php
```php
    <?php
    require_once("include/upload.class.php");
    
    $up = new Upload();
    $up->set_folder("upload");
    $up->process($_POST["path"], $_FILES["file"]);
    ?>
```
### Todo

* ~~Progress bar~~
* Configurable Javascript
* Composer style PHP class
