/**
 *
 * Script used to asynchronously download, parse and display the results of a search query from a form on searchJobs.php
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
        url = "/downloadsearchjobs.php?q=" + query;

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
        let table = document.getElementById("jobsTable");
        wipeTable(table);
        createBlankResult(table, "Search for jobs above...");

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
            let jobsArray = response.split("<br/>");

            // Wipe the existing records from the table if any exist
            let table = document.getElementById("jobsTable");
            wipeTable(table);

            // If any results were returned from the database
            // Note, < 5 because the response takes five parts so the request response will always be a multiple of three
            if (jobsArray.length < 5) {

                // Create blank results table with error message
                createBlankResult(table, "No results matched your search...")

            } else {

                // Create a new table with the results of the search query
                createJobElements(jobsArray, table);

            }

        } else {

            // Error
            console.log("Error: There was a problem with the request");

        }

    }

}

function createJobElements(jobsArray, table) {


    for (let i = 0; i < jobsArray.length - 1; i += 5) {

        let tr = document.createElement("tr");
        let title = document.createElement("td");
        let location = document.createElement("td");
        let salary = document.createElement("td");
        let tags = document.createElement("td");
        let link = document.createElement("a");
        let titleString = document.createTextNode(jobsArray[i + 1]);
        let locationString = document.createTextNode(jobsArray[i + 2]);
        let salaryString = document.createTextNode("£" + jobsArray[i + 3]);
        let tagsStr = jobsArray[i + 4];
        tagsStr = tagsStr.replace(/,/g, ", ");
        let tagsString = document.createTextNode(tagsStr);

        link.setAttribute("href", "/job.php?id=" + jobsArray[i]);
        link.appendChild(titleString);
        link.setAttribute("style", "text-decoration: none");
        link.setAttribute("style", "color: #0078D7");
        title.appendChild(link);
        location.appendChild(locationString);
        salary.appendChild(salaryString);
        tags.appendChild(tagsString);
        appendChildren(tr, title, location, salary, tags)
        table.appendChild(tr);

    }

}