let httpRequest;
let url;

window.onload = Download;

function Download() {

    let select = document.getElementById("select");
    let type = select.options[select.selectedIndex].text.toLowerCase();

    httpRequest = new XMLHttpRequest();
    url = "/downloadquestions.php?type=" + type;

    if (!httpRequest) {

        console.log("Error: could not create XMLHttpRequest object");
        return false;

    }

    httpRequest.onreadystatechange = Output;

    httpRequest.open("GET", url);
    httpRequest.send();

}

function Output() {

    if (httpRequest.readyState === XMLHttpRequest.DONE) {

        if (httpRequest.status === 200) {
            
            let request = httpRequest.response;
            let questionArray = request.split("<br/>");
            
            let table = document.getElementById("questionsTable");

            while (table.hasChildNodes()) {
                
                table.removeChild(table.lastChild);
            
            }

            createElements(questionArray, table);

        } else {

            console.log("Error: There was a problem with the request");

        }

    }

}

function createElements(questionArray, table) {

    for (let i = 0; i < questionArray.length - 1; i += 3) {

        let tr = document.createElement("tr");
        let title = document.createElement("td");
        let score = document.createElement("td");
        let link = document.createElement("a");
        let titleString = document.createTextNode(questionArray[i]);
        let scoreString = document.createTextNode(questionArray[i + 2]);

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

    for (let i = 0; i < children.length; i++) {

        parent.appendChild(children[i]);

    }

}