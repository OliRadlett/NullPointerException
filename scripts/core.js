/**

 Script to store core functions for use in the other JavaScript files in this project

 @since 30/09/18

 @author Oli Radlett <o.radlett@gmail.com>

*/

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
        link.setAttribute("href", "question.php?id=" + questionArray[i + 1]);
        link.appendChild(titleString);
        link.setAttribute("style", "text-decoration: none");
        link.setAttribute("style", "color: #0078D7");
        title.appendChild(link);
        score.appendChild(scoreString);
        appendChildren(tr, title, score)
        table.appendChild(tr);

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

function createBlankResult(table, msg) {

    /**
     *
     * Function to create a blank results table in the instance that no results are returned from the database
     *
     * @param HTML table: table - A reference to the HTML table to append the error message to
     * @param String: message - The error message to append to the table
     *
     * @author Oli Radlett <o.radlett@gmail.com>
     *
     */

    // Create the elements
    let tr = document.createElement("tr");
    let td1 = document.createElement("td");
    let td2 = document.createElement("td");
    let string = document.createTextNode(msg);
    // Append the elements to their parents
    td1.appendChild(string);
    tr.appendChild(td1);
    tr.appendChild(td2);
    table.appendChild(tr);

}