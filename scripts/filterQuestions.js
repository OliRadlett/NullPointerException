/**
 *
 * Script used to asynchronously download, parse and display the results of a search query from a
 * form on downloadquestions.php
 *
 * @author Oli Radlett <o.radlett@gmail.com>
 *
 */

// Declare variables
let httpRequest;
let url;

// Set the download function to run on page load
window.onload = download;

function download() {

    /**
     *
     * Function to create and send an asynchronous GET request to downloadquestions.php to get a
     * selection of questions based on the filter buttons
     *
     * @author Oli Radlett <o.radlett@gmail.com>
     *
     */

    // Get the String value of the filter button (in lower case)
    let select = document.getElementById("select");
    let type = select.options[select.selectedIndex].text.toLowerCase();

    // Create a new XMLHttpRequest object
    httpRequest = new XMLHttpRequest();
    // Create the request URL based on the filter button calculated above
    url = "downloadquestions.php?type=" + type;

    // Check for errors with the XMLHttpRequest object
    if (!httpRequest) {

        console.log("Error: could not create XMLHttpRequest object");
        return false;

    }

    // Set the async callback function to output
    httpRequest.onreadystatechange = output;

    // Send the request
    httpRequest.open("GET", url);
    httpRequest.send();

}

function output() {

    /**
     *
     * Function to output the results of the search query in a table. Used as the callback for the Async request
     *
     * @author Oli Radlett <o.radlett@gmail.com>
     *
     */

    // Check if the request is done
    if (httpRequest.readyState === XMLHttpRequest.DONE) {

        // Check that the request executed successfully
        if (httpRequest.status === 200) {

            // Create an array by splitting the request response by HTML line-break
            let request = httpRequest.response;
            let questionArray = request.split("<br/>");

            // Wipe the existing records from the table if any exist
            let table = document.getElementById("questionsTable");
            wipeTable(table);

            // Create a new table using the results returned from the server
            createElements(questionArray, table);

        } else {

            // Error
            console.log("Error: There was a problem with the request");

        }

    }

}