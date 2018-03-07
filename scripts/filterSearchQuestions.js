var httpRequest;
var url;

window.onload = Download;

function Download() {

    var search = document.getElementById("search");
    var query = search.value;

    if (query !== "") {

        httpRequest = new XMLHttpRequest();
        url = "/downloadsearchq.php?q=" + query;

        if (!httpRequest) {

            console.log("Error: could not create XMLHttpRequest object");
            return false;

        }

        httpRequest.onreadystatechange = Output;

        httpRequest.open("GET", url);
        httpRequest.send();

    } else {

        var table = document.getElementById("questionsTable");
        wipeTable(table);
        createBlankResult(table, "Search for questions above...");

    }

}

function Output() {

    if (httpRequest.readyState === XMLHttpRequest.DONE) {

        if (httpRequest.status === 200) {
            
            var request = httpRequest.response;
            var questionArray = request.split("<br/>");
            var table = document.getElementById("questionsTable");

            wipeTable(table);

            if (questionArray.length < 3) {

                createBlankResult(table, "No results matched your search...")

            } else {

                createElements(questionArray, table);

            }

        } else {

            console.log("Error: There was a problem with the request");

        }

    }

}

function wipeTable(table) {

    while (table.hasChildNodes()) {
                
        table.removeChild(table.lastChild);
           
    }

}

function createElements(questionArray, table) {

    for (var i = 0; i < questionArray.length - 1; i += 3) {

        var tr = document.createElement("tr");
        var title = document.createElement("td");
        var score = document.createElement("td");
        var link = document.createElement("a");
        var titleString = document.createTextNode(questionArray[i]);
        var scoreString = document.createTextNode(questionArray[i + 2]);

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

function createBlankResult(table, msg) {

    var tr = document.createElement("tr");
    var td1 = document.createElement("td");
    var td2 = document.createElement("td");
    var string = document.createTextNode(msg);
    td1.appendChild(string);
    tr.appendChild(td1);
    tr.appendChild(td2);
    table.appendChild(tr);

}

function appendChildren(parent, ...children) {

    for (let i = 0; i < children.length; i++) {

        parent.appendChild(children[i]);

    }

}