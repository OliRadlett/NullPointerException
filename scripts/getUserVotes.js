window.onload = Download;

var qID = GetCookie("current_qid");
window.logged_in = GetCookie("window.logged_in");

if (window.logged_in == "true") {

    var username = GetCookie("current_username");

}

function Download() {

  if (window.logged_in == "true") {

      url = "/downloadquestionvotes.php?qid=" + qID + "&username=" + username;

      Request(url, "GET", DrawArrow)

    } else {

      // Not logged in so draw grey arrows and don't allow voting
      alert("Ugh, don't do that, you ain't logged in");

    }

}

function DrawArrow() {

    if (httpRequest.readyState === XMLHttpRequest.DONE) {

        if (httpRequest.status === 200) {

            var request = httpRequest.response;

            // Just testing returned values, add functionality later
            alert(request);

        }

    }

}

function Up(lastState) {

    switch (lastState) {

        case "green":

            RemoveVote();
            Download();
            break;

        case "red":

            RemoveVote();
            AddVote("up");
            Download();
            break;

        case "grey":

            AddVote("up");
            Download();
            break;

    }

}

function Down(lastState) {

    switch (lastState) {

        case "red":

            RemoveVote();
            Download();
            break;

        case "green":

            RemoveVote();
            AddVote("down");
            Download();
            break;

        case "grey":

            AddVote("down");
            Download();
            break;

    }

}

function AddVote(type) {

    if (window.logged_in) {

        var url = "/modifyvote.php?qid=" + qID + "&username=" + username + "&func=add" + type + "vote";
        Request(url, "GET", 0);

    } else {

        alert("Stop. Stop it pls.");

    }

}

function RemoveVote() {

    if (window.logged_in) {

        var url = "/modifyvote.php?qid=" + qID + "&username=" + username + "&func=removevote";
        Request(url, "GET", 0);

    }

}

function Request(url, method, callback) {

    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {

        console.log("Error: could not create XMLHttpRequest object");
        return false;

    }

    httpRequest.onreadystatechange = callback;

    httpRequest.open(method, url);
    httpRequest.send();

}

// Im tired so this is from w3schools...
function GetCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
