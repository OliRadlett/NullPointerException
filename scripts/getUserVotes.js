window.onload = Download;

var qID = GetCookie("current_qid");
var logged_in = GetCookie("logged_in");

if (logged_in == "true") {

    var username = GetCookie("current_username");

}

function Download() {

  httpRequest = new XMLHttpRequest();

  if (logged_in == "true") {

      url = "/downloadquestionvotes.php?qid=" + qID + "&username=" + username;

      if (!httpRequest) {

          console.log("Error: could not create XMLHttpRequest object");
          return false;

      }

      httpRequest.onreadystatechange = DrawArrow;

      httpRequest.open("GET", url);
      httpRequest.send();

    } else {
      // Not logged in so draw grey arrows and don't allow voting
    }

}

function DrawArrow() {

    if (httpRequest.readyState === XMLHttpRequest.DONE) {

        if (httpRequest.status === 200) {

            var request = httpRequest.response;

            // Just testing returned values, add functionality tommorow
            alert(request);

        }

    }

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
