var httpRequest;
var url;

window.onload = Download;

function Download() {

    var select = document.getElementById("select");
    var type = select.options[select.selectedIndex].text.toLowerCase();

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
            
            var request = httpRequest.response;
            var questionArray = request.split("<br/>");
            
            var table = document.getElementById("questionsTable");

            while (table.hasChildNodes()) {
                
                table.removeChild(table.lastChild);
            
            }

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
                tr.appendChild(title);
                tr.appendChild(score);
                table.appendChild(tr);

            }

        } else {

            console.log("Error: There was a problem with the request");

        }

    }

}