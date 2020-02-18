// Global variables
let picker = document.getElementById('picker');
let listing = document.getElementById('listing');
let box = document.getElementById('box');
let elem = document.getElementById("myBar");
let loader = document.getElementById("loader");
let counter = 1;
let total = 0;

// On button input change (picker), process it
picker.addEventListener('change', e => {

    // Reset previous upload progress
    elem.style.width = "0px";
    listing.innerHTML = "None";

    // Get total of files in that folder
    total = picker.files.length;
    counter = 1;

    // Display image animation
    loader.style.display = "block";
    loader.style.visibility = "visible";

    // Process every single file
    for (var i = 0; i < picker.files.length; i++) {
        var file = picker.files[i];
        sendFile(file, file.webkitRelativePath);
    }
});


// Function to send a file, call PHP backend 
sendFile = function(file, path) {

    var item = document.createElement('li');
    var formData = new FormData();
    var request = new XMLHttpRequest();

    request.responseType = 'text';

    // HTTP onload handler
    request.onload = function() {
        if (request.readyState === request.DONE) {
            if (request.status === 200) {
                console.log(request.responseText);

                // Add file name to list
                /* 
                item.textContent = request.responseText;
                listing.appendChild(item); 
                */

                listing.innerHTML = request.responseText + " (" + counter + " of " + total + " ) ";

                // Show percentage
                box.innerHTML = Math.min(counter / total * 100, 100).toFixed(2) + "%";

                // Show progress bar
                elem.innerHTML = Math.round(counter / total * 100, 100) + "%";
                elem.style.width = Math.round(counter / total * 100) + "%";

                // Increment counter
                counter = counter + 1;
            }
            if (counter >= total) {
                listing.innerHTML = "Uploading " + total + " file(s) is done!";
                loader.style.display = "none";
                loader.style.visibility = "hidden";
            }
        }
    };

    // Set post variables 
    formData.set('file', file); // One object file
    formData.set('path', path); // String of local file's path 

    // Do request
    request.open("POST", 'process.php');
    request.send(formData);

};