function SetHeight() {

    var qContainer = document.getElementById("question-container");
    var computedStyle = window.getComputedStyle(qContainer, null);
    var height = computedStyle.height;
    
    document.getElementById("votes").setAttribute("style", "height: " + height);

}