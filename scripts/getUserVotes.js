var qID = GetCookie("current_qid");
window.logged_in = GetCookie("logged_in");

if (window.logged_in == "true") {

    var username = GetCookie("current_username");

}

var $UpArrow = $("#UpArrow");
var $DownArrow = $("#DownArrow");

$(function(){

  Download();

});

function Download() {

    $.get("downloadquestionvotes.php?qid=" + qID + "&username=" + username + "&_=" + Math.random(), function(data) {

      window.current = data;

      switch (data) {

        case "up":
          $("#UpArrow").attr("src", "img/up_green.png");
          $("#DownArrow").attr("src", "img/down_grey.png");
          break;

        case "down":
          $("#UpArrow").attr("src", "img/up_grey.png");
          $("#DownArrow").attr("src", "img/down_red.png");
          break;

        default:
          $("#UpArrow").attr("src", "img/up_grey.png");
          $("#DownArrow").attr("src", "img/down_grey.png");
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

  switch (window.current) {

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

  switch (window.current) {

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
