var $UpArrow = $("#UpArrow");
var $DownArrow = $("#DownArrow");

$(function(){

  Download();

});

function Download() {

    $.get("../../downloadquestionvotes.php?qid=10&username=admin&=" + Math.random(), function(data) {

      window.current = data;

      switch (data) {

        case "up":
          $("#UpArrow").attr("src", "../../img/up_green.png");
          $("#DownArrow").attr("src", "../../img/down_grey.png");
          break;

        case "down":
          $("#UpArrow").attr("src", "../../img/up_grey.png");
          $("#DownArrow").attr("src", "../../img/down_red.png");
          break;

        default:
          $("#UpArrow").attr("src", "../../img/up_grey.png");
          $("#DownArrow").attr("src", "../../img/down_grey.png");
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

  $.get("../../modifyvote.php?qid=10&username=admin&func=removevote&=" + Math.random(), function(data) {

    Download();

  });

}

function AddUpVote() {

  $.get("../../modifyvote.php?qid=10&username=admin&func=addupvote&=" + Math.random(), function(data) {

    Download();

  });

}

function AddDownVote() {

  $.get("../../modifyvote.php?qid=10&username=admin&func=adddownvote&=" + Math.random(), function(data) {

    Download();

  });

}

function DownToUp() {

  $.get("../../modifyvote.php?qid=10&username=admin&func=removevote&=" + Math.random(), function(data) {

    //Should probably change from delete and re-add to edit

    $.get("../../modifyvote.php?qid=10&username=admin&func=addupvote&=" + Math.random(), function(data) {

      Download();

    });

  });

}

function UpToDown() {

  $.get("../../modifyvote.php?qid=10&username=admin&func=removevote&=" + Math.random(), function(data) {

    //Should probably change from delete and re-add to edit

    $.get("../../modifyvote.php?qid=10&username=admin&func=adddownvote&=" + Math.random(), function(data) {

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
