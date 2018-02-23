var httpRequest;
var url;
var table;

function Download(type) {

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

            table = document.getElementById("questions-container2");
            
            while(table.hasChildNodes()) {
                
                table.removeChild(table.firstChild);
            
            }

            for (var i = 2; i < questionArray.length; i+=3) {

                var tr = document.createElement("tr");
                var question = document.createElement("td");
                var filler = document.createElement("td");
                var a = document.createElement("a");
                //var p1 = document.createElement("p");
                var p2 = document.createElement("p");
                var content = document.createTextNode(questionArray[i - 2]);
                var scoreString = questionArray[i] + " votes";
                var votes = document.createTextNode(scoreString);
                
                a.setAttribute("href", "/question.php?id=" + questionArray[i - 1]);
                a.appendChild(content);
                a.setAttribute("class", "title");
                a.setAttribute("style", "color: blue");
                p2.appendChild(votes);
                p2.setAttribute("class", "votes");
                p2.setAttribute("style", "display: inline-block");
                //a.appendChild(p1);
                question.appendChild(a);
                question.appendChild(p2);
                tr.appendChild(question);
                table.appendChild(tr);

            }

            var eList = document.getElementsByClassName("votes");

            for (var i = 0; i < eList.length; i++) {

                var tmp = eList[i].innerHTML;
                tmp = "&emsp;&emsp;&emsp;" + tmp;
                eList[i].innerHTML = tmp;

            }

        } else {

            console.log("Error: There was a problem with the request");

        }

    }

}