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

### Todo

* ~~Progress bar~~
* Configurable Javascript
* Composer style PHP class
