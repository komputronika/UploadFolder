// Global variables
let picker = document.getElementById('picker');
let listing = document.getElementById('listing');
let box = document.getElementById('box');
let elem = document.getElementById("myBar");
let counter = 1;
let total = 0;

// When button input change, process it
picker.addEventListener('change', e => {

    // Reset previous upload
    elem.style.width = "0px";
    listing.innerHTML = "None";

    // Get total of files in that folder
    total = Array.from(e.target.files).length;
    counter = 1;

    // Process every files
    // Note: Array.from() needed for Edge

    for (let file of Array.from(e.target.files)) {

        // Upload a file
        sendFile(file, file.webkitRelativePath);

        /*item = document.createElement('li');
        item.textContent = file.webkitRelativePath;
        listing.appendChild(item);*/

    };

});

sendFile = function(file, path) {

    var item = document.createElement('li');
    var formData = new FormData();
    var request = new XMLHttpRequest();

    request.responseType = 'text';

    // Onload handler
    request.onload = function() {
        if (request.readyState === request.DONE) {
            if (request.status === 200) {
                console.log(request.responseText);

                // Add file name to list
                /* item.textContent = request.responseText;
                listing.appendChild(item); */
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
                listing.innerHTML = "Uploading " + total + " file is done!";
            }
        }
    };

    // Set variable 
    formData.set('myfile', file); // One object file
    formData.set('path', path); // String of file's full path
    formData.set('submit', "Submit");

    // Do request
    request.open("POST", 'upload.php');
    request.send(formData);

};