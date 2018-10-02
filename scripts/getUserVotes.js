let qID = GetCookie("current_qid");

window.logged_in = GetCookie("logged_in");

let username;

if (window.logged_in === "true") {

    username = GetCookie("current_username");

}

let UpArrow = $("#UpArrow");
let DownArrow = $("#DownArrow");

let currentState;

$(function(){

  Download();

});

function Download() {

    $.get("downloadquestionvotes.php?qid=" + qID + "&username=" + username + "&_=" + Math.random(), (data) => {

        currentState = data;

        switch (data) {

            case "up":
                UpArrow.attr("src", "img/up_green.png");
                DownArrow.attr("src", "img/down_grey.png");
                break;

            case "down":UpArrow.attr("src", "img/up_grey.png");
                UpArrow.attr("src", "img/down_red.png");
                break;

            default:UpArrow.attr("src", "img/up_grey.png");
                UpArrow.attr("src", "img/down_grey.png");
                break;

        }

    });

}

function Vote(type) {

    switch (type) {

        case "up":
            Up();
            break;

        case "down":
            Down();
            break;

        default:
            break;

    }

}

function RemoveVote() {

    $.get("modifyvote.php?qid=" + qID + "&username=" + username + "&func=removevote&_=" + Math.random(), function(data) {

        Download();

    });

}

function AddUpVote() {

    $.get("modifyvote.php?qid=" + qID + "&username=" + username + "&func=addupvote&_=" + Math.random(), function(data) {

        Download();

    });

}

function AddDownVote() {

    $.get("modifyvote.php?qid=" + qID + "&username=" + username + "&func=adddownvote&_=" + Math.random(), function(data) {

        Download();

    });

}

function DownToUp() {

    $.get("modifyvote.php?qid=" + qID + "&username=" + username + "&func=removevote&_=" + Math.random(), function(data) {

        //Should probably change from delete and re-add to edit
        $.get("modifyvote.php?qid=" + qID + "&username=" + username + "&func=addupvote&_=" + Math.random(), function(data) {

            Download();

        });

    });

}

function UpToDown() {

    $.get("modifyvote.php?qid=" + qID + "&username=" + username + "&func=removevote&_=" + Math.random(), function(data) {

        //Should probably change from delete and re-add to edit
        $.get("modifyvote.php?qid=" + qID + "&username=" + username + "&func=adddownvote&_=" + Math.random(), function(data) {

            Download();

        });

    });

}

function Up() {

    switch (currentState) {

        case "up":
            RemoveVote();
            break;

        case "down":
            DownToUp();
            break;

        default:
            AddUpVote();
            break;

    }

}

function Down() {

    switch (currentState) {

        case "down":
            RemoveVote();
            break;

        case "up":
            UpToDown();
            break;

        default:
            AddDownVote();
            break;

    }

}

// Function from w3schools.com
function GetCookie(cookie_name) {
    
    let name = cookie_name + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');

    for(let i = 0; i < ca.length; i++) {

        let c = ca[i];

        while (c.charAt(0) === ' ') {

            c = c.substring(1);

        }

        if (c.indexOf(name) === 0) {

            return c.substring(name.length, c.length);

        }

    }

    return null;

}
