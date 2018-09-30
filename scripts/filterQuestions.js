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
    url = "/downloadquestions.php?type=" + type;

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

function wipeTable(table) {

    /**
     *
     * Function to wipe an HTML table
     *
     * @param HTML Table: table - A reference to the table to be wiped
     *
     * @author Oli Radlett <o.radlett@gmail.com>
     *
     */

    // Iterate through the nodes in the table, removing each one
    while (table.hasChildNodes()) {

        table.removeChild(table.lastChild);

    }

}

function createElements(questionArray, table) {

    /**
     *
     * Function to append the results returned from the search query to the HTML table
     *
     * @param Array: questionArray - The array of questions returned from the database
     * @param HTML table: table - A reference to the HTML table to append the results to
     *
     * @author Oli Radlett <o.radlett@gmail.com>
     *
     */

    // Iterate though the response array
    // Note += 3 because the response takes three parts so the request response will always be a multiple of three
    for (let i = 0; i < questionArray.length - 1; i += 3) {

        // Create all required elements
        let tr = document.createElement("tr");
        let title = document.createElement("td");
        let score = document.createElement("td");
        let link = document.createElement("a");
        let titleString = document.createTextNode(questionArray[i]);
        let scoreString = document.createTextNode(questionArray[i + 2]);

        // Set the attributes and properties of each element
        // Append the elements to their parents
        link.setAttribute("href", "/question.php?id=" + questionArray[i + 1]);
        link.appendChild(titleString);
        link.setAttribute("style", "text-decoration: none");
        link.setAttribute("style", "color: #0078D7");
        title.appendChild(link);
        score.appendChild(scoreString);
        appendChildren(tr, title, score)
        table.appendChild(tr);

    }

}

function appendChildren(parent, ...children) {

    /**
     *
     * Function to append multiple children to a single parent
     *
     * @param {HTMLElement}: parent, parent element to append the children to
     * @param {...HTMLElement}: An unspecified number of children elements to append to the parent
     *
     * @author Oli Radlett <o.radlett@gmail.com>
     *
     */

    // Iterate through supplied children parameters
    for (let i = 0; i < children.length; i++) {

        // Append child to the parent element
        parent.appendChild(children[i]);

    }

}