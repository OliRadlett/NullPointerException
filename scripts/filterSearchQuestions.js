/**
 *
 * Script used to asynchronously download, parse and display the results of a search query from a form on searchq.php
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
     * Function to create and send an asynchronous GET request to downloadsearch.php to get the results of the search query
     *
     * @author Oli Radlett <o.radlett@gmail.com>
     *
    */

    // Get the String value of the contents of the search bar
    let search = document.getElementById("search");
    let query = search.value;

    // Check there is a query
    if (query !== "") {

        // Create a new XMLHTTPRequest object
        httpRequest = new XMLHttpRequest();
        // Create the request URL based on the query assigned above
        url = "/downloadsearchq.php?q=" + query;

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

    } else {

        // Show placeholder text
        let table = document.getElementById("questionsTable");
        wipeTable(table);
        createBlankResult(table, "Search for questions above...");

    }

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
            let response = httpRequest.response;
            let questionArray = response.split("<br/>");

            // Wipe the existing records from the table if any exist
            let table = document.getElementById("questionsTable");
            wipeTable(table);

            // If any results were returned from the database
            // Note, < 3 because the response takes three parts so the request response will always be a multiple of three
            if (questionArray.length < 3) {

                // Create blank results table with error message
                createBlankResult(table, "No results matched your search...")

            } else {

                // Create a new table with the results of the search query
                createElements(questionArray, table);

            }

        } else {

            // Error
            console.log("Error: There was a problem with the request");

        }

    }

}